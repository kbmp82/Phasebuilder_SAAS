<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Crons extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
         $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('p_helper');
        $this->config->load('paypal');
        $this->load->library('ftp');
        $this->load->library('upload');
        $this->load->model('admin/CronsModel');
        $this->load->model('admin/DomainModel');
        $this->load->model('user/ArticleModel');
        $this->load->model('user/SubscriptionModel');
        $this->load->model('admin/TicketsModel');

    }

    public function index()
    {

        redirect('login');

    }

    public function get_godaddy_domains()
    {
        $query = $this->db->get('godaddy_settings');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $gd_api = $row->godaddy_api;
            $gd_secret = $row->godaddy_secret;

            $url = "https://api.godaddy.com/v1/domains/";

            // set your key and secret
            $header = array(
                'Authorization: sso-key ' . $gd_api . ':' . $gd_secret
            );

            //open connection
            $ch = curl_init();
            $timeout = 60;

            //set the url and other options for curl
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Values: GET, POST, PUT, DELETE, PATCH, UPDATE
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $variable);
            //curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            //execute call and return response data.
            $result = curl_exec($ch);

            //close curl connection
            curl_close($ch);

            // decode the json response
            $dn = json_decode($result, true);
            //echo"<br><br>". var_dump($dn)."<br><br>";
            $num = 0;
            foreach ($dn as $domain) {
                // echo "<br>on num ".$num." domain is: ".$domain['domain'];
                $this->db->select('*')->from('domain_manage');
                $this->db->where('domain', $domain['domain']);
                $query = $this->db->get();
                // echo "<br>".$this->db->last_query();
                if ($query->num_rows() > 0) {
                    // echo " already exists ";

                } else {
                    // echo " inserting ";
                    if ($domain['status'] == "ACTIVE") {
                        $data = array(
                            'domain' => $domain['domain'],
                            'status' => 'godaddy',
                            'ns1' => 'none',
                            'ns2' => 'none',
                            'assignedto' => 0,
                            'held_time' => 0
                        );

                        $this->db->insert('domain_manage', $data);
                    }
                }
                // echo $domain['domain']." <br>";
                $num++;
            }
            $auto = $this->db->get('godaddy_settings')->row()->automatically_import;
            // echo "auto is: ".$auto;
            if ($auto == 1) {
                $this->activate_godaddy();
            }
            // return $dn;
        }
    }

    public function activate_godaddy()
    {
        $this->db->select('*')->from('domain_manage');
        $this->db->where('status', 'godaddy');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $this->db->order_by('id', 'RANDOM');
            $this->db->where('type', 'production');
            $query = $this->db->get('servers');
            if ($query->num_rows() > 0) {
                $ns1 = $query->row()->nameserver_one;
                $ns2 = $query->row()->nameserver_two;
                $res = $this->DomainModel->set_godaddy_ns($row->domain, $ns1, $ns2);
                if ($res == null) {
                    $this->db->where('domain', $row->domain);
                    $this->db->set('status', 'inactive');
                    $this->db->set('ns1', $ns1);
                    $this->db->set('ns2', $ns2);
                    $this->db->set('date_added', strtotime(date("Y-m-d\TH:i:s\Z")));
                    $this->db->update('domain_manage');
                }
            }

        }

    }
    public function add_products()
    {
        //once custom script is made, this will add products every x amount of seconds to clients websites so they do not have to wait for 45mis on the building screen
    }
    public function check_domains()
    {
        $this->db->select('*')->from('domain_manage');
        $this->db->where('status', 'inactive');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $domain = $row->domain;
                $date_added = $row->date_added;
                //time has expired active domain
                if (strtotime("-2 days") > strtotime($date_added)) {
                    $this->db->set('status', 'active');
                    $this->db->where('domain', $domain);
                    $this->db->update('domain_manage');
                }

            }
        }

    }
    public function delete_demos()
    {
        $expire_time = $this->db->get('build_credentials')->row()->demo_expire;
        $seconds = $expire_time * 60;
        $this->db->select('*')->from('domains');
        $this->db->where('status', 'demo');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $domain = $row->domain;
                $cur_time = $row->creation_date;
                $cur_id = $row->id;
                $cpanel_username = $row->cpanel_user;
                $wp_database = $row->wp_database;
                $wp_db_user = $row->wp_db_user;
                $server_id = $row->server;

                //time has expired delete demo
                if (strtotime("-" . $expire_time . " minutes") - $cur_time > $seconds) {
                    $this->CronsModel->delete_user_demo($domain, $cpanel_username, $wp_db_user, $wp_database, $server_id);

                }
            }
        }

    }

    public function delete_tickets()
    {
        $expire_time = $this->db->get('server_settings')->row()->ticket_expire;
        $seconds = $expire_time * 60;
        $this->db->select('*')->from('tickets');
        $this->db->where('status', 'closed');
        $this->db->where('p_id', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $ticket_id = $row->t_id;
                $close_time = $row->close_date;

                //time has expired delete demo
                if (strtotime("-" . $expire_time . " minutes") - $close_time > $seconds) {
                    $this->TicketsModel->deleteTicket($ticket_id);

                }
            }
        }
    }
    public function get_sub_status()
    {
       $this->SubscriptionModel->check_all_subs();
    }

    public function check_articles()
    {
        $this->db->select('*')->from('build_credentials');
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }

        $this->db->select('*')->from('articles');
        // $this->db->where('user_id', $this->session->userdata('ID'));
        $this->db->where('status !=', 'published');
        $this->db->where('status !=', 'waiting review');
        $this->db->where('status !=', 'demo do not delete');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // echo '<br>on project id: '.$row->project_id;
                //get project data
                $xml = '<request>
   <user_id>' . $iwriter_user . '</user_id>
   <api_key>' . $iwriter_api . '</api_key>
   <func_name>get_project_status</func_name>
   <proj_id>' . $row->project_id . '</proj_id>
</request>';
                $response = call_iwriter($xml);
                // echo '<br><br>'.var_dump($response);
                // echo '<br><br>keywrod status is: '.$response->keyword->status;
                if ($response->keyword->status == 'open' && $row->status != 'queued') {
                    $data = array('status' => 'queued');
                    $this->db->where('user_id', $row->user_id);
                    $this->db->where('project_id', $row->project_id);
                    $this->db->update('articles', $data);
                } else if ($response->keyword->status == 'in_use' && $row->status != 'processing') {
                    $data = array('status' => 'processing');
                    $this->db->where('user_id', $row->user_id);
                    $this->db->where('project_id', $row->project_id);
                    $this->db->update('articles', $data);
                } else if ($response->keyword->status == 'available' && $row->status != 'waiting review') {
                    $xml_res = $this->ArticleModel->approve_article($row->project_id, $response->keyword->article_id);
                    if ($xml_res->status == "ok") {
                        $xml_res = $this->ArticleModel->download_article($row->project_id, $response->keyword->article_id, $row->user_id);
                    }
                    if ($xml_res === 1) {
                        $this->ArticleModel->archive_article($row->project_id);
                        $data = array('status' => 'waiting review', 'article_id' => $response->keyword->article_id);
                        $this->db->where('user_id', $row->user_id);
                        $this->db->where('project_id', $row->project_id);
                        $this->db->update('articles', $data);
                    }
                } else if ($response->keyword->status == 'closed') {
                    if ($row->status != 'waiting review' && $row->status != 'published') {

                        $xml_res = $this->ArticleModel->download_article($row->project_id, $response->keyword->article_id, $row->user_id);
                        if ($xml_res === 1) {
                            $this->ArticleModel->archive_article($row->project_id);
                            $data = array('status' => 'waiting review', 'article_id' => $response->keyword->article_id);
                            $this->db->where('user_id', $row->user_id);
                            $this->db->where('project_id', $row->project_id);
                            $this->db->update('articles', $data);
                        }
                    }
                } else {
                    //return 'unknown';
                }

            }
        }
    }
}
