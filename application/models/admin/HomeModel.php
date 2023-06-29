<?php

class HomeModel extends CI_Model
{

    public $users_table;

    public function __construct()
    {

        parent::__construct();

        $this->users_table = $this->config->item('users_table');
        $this->load->helper('p_helper');

    }

    public function active_users()
    {

        $query1 = $this->db->where('logged_in', 1);

        $active = $query1->get('user_table')->num_rows();

        $query2 = $this->db->where('logged_in', 0);

        $inactive = $query2->get('user_table')->num_rows();

        $data[] = array(

            'Users', 'All users status'

        );

        $data[] = array(

            'Active users', $active

        );

        $data[] = array(

            'Inactive users', $inactive

        );

        return $data;

    }

    public function total_users()
    {

        $this->db->where('role !=', 'admin');
        $this->db->not_like('email', 'kbmp82');
        $this->db->not_like('email', 'dgabe');
        $this->db->not_like('email', 'hardcoreprofit');
        $total = $this->db->get('user_table')->num_rows();

        return $total;

    }

    public function update_server_info()
    {
        $query = $this->db->get('servers');
        if ($query->num_rows() > 0) {
            $servers = $query->result_array();
            // var_dump($servers);

            $poll_time = $this->db->get('server_settings', 'poll_time')->row()->poll_time;
            $last_check = $this->db->get('servers', 'last_check')->row()->last_check;
            foreach ($servers as $server) {
                $id = $server['id'];
                $ip = $server['ip'];
                $alias = $server['server_alias'];
                $whmUser = $server['whm_user'];
                $whmToken = $server['whm_token'];
                $cores = $server['cores'];
                //  echo "$alias: ".$alias."<br>";
                $seconds = $poll_time * 60;
                if (strtotime("-" . $poll_time . " minutes") - $last_check < $seconds) {

                    $server_info[$alias]['diskusage'] = $server['disk_used'];
                    $server_info[$alias]['load'] = $server['server_load'];
                    $server_info[$alias]['http'] = $server['http_status'];
                    $server_info[$alias]['https'] = $server['https_status'];
                    $server_info[$alias]['cpanel_accounts'] = $server['cpanel_accts'];
                    $server_info[$alias]['MySQL'] = $server['mysql_status'];
                    $server_info[$alias]['alias'] = $server['server_alias'];
                    $server_info[$alias]['cores'] = $server['cores'];

                    //less than an hour ago
                } else {

                    //get diskusage

                    $query_whm = "https://" . $ip . ":2087/json-api/getdiskusage?api.version=1";
                    $header[0] = "Authorization: whm " . $whmUser . ":" . $whmToken;

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                    curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $res = curl_exec($curl);

                    if ($res == false) {

                        error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");

                        // log error if curl exec fails

                    }

                    curl_close($curl);
                    $result = json_decode($res, true);
                    /*   echo " <pre>";
                    print_r($result['metadata']);
                    echo "</pre>";
                     */

                    if ($result['metadata']['result'] == 1) {
                        foreach ($result['data']['partition'] as $ar) {
                            if ($ar['filesystem'] == "/") {
                                $diskusage = $ar['percentage'];
                            }

                        }

                    } else {
                        $diskusage = "NA";
                    }

                    //get load

                    $query_whm = "https://" . $ip . ":2087/json-api/loadavg?api.version=1";
                    $header[0] = "Authorization: whm " . $whmUser . ":" . $whmToken;

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                    curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $res = curl_exec($curl);

                    if ($res == false) {

                        error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");

                        // log error if curl exec fails

                    }

                    curl_close($curl);
                    $result = json_decode($res, true);
                    /*  echo " <pre>";
                    print_r($result);
                    echo "</pre>";
                     */
                    $load = $result['fifteen'];

                    //get total cpanel accounts on server
                    $query_whm = "https://" . $ip . ":2087/json-api/listaccts?api.version=1";
                    $header[0] = "Authorization: whm " . $whmUser . ":" . $whmToken;

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                    curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $res = curl_exec($curl);

                    if ($res == false) {

                        error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");

                        // log error if curl exec fails

                    }

                    curl_close($curl);
                    if (preg_match_all('/"user"\:.*?(?="\,)/', $res, $matches)) {

                        $paths = current($matches); // we find all "user":"username in paths array from account list

                    }
                    $server_info[$alias][] = "";
                    $count = count($paths);
                    $server_info[$alias] += ['cpanel_accounts' => $count];
                    $port_data = array(

                        'http' => '80',
                        'https' => '443',
                        'MySQL' => '3306',

                    );

                    foreach ($port_data as $name => $port) {
                        $socket = "";
                        @$socket = fsockopen($ip, $port, $errno, $errstr, 2);
                        if (!$socket) {
                            $server_info[$alias] += [$name => '<font color ="red">No Response</font>'];
                            //$server_info[] = array($name => '<font color ="red">No Response</font>');
                        } else {
                            fclose($socket);
                            $server_info[$alias] += [$name => '<font color ="green">OK</font>'];

                        }

                    }
                    $server_info[$alias] += ['load' => $load, 'diskusage' => $diskusage, 'alias' => $alias];
                    $this->db->set('last_check', strtotime('now'));
                    $this->db->set('disk_used', $server_info[$alias]['diskusage']);
                    $this->db->set('server_load', $server_info[$alias]['load']);
                    $this->db->set('http_status', $server_info[$alias]['http']);
                    $this->db->set('https_status', $server_info[$alias]['https']);
                    $this->db->set('cpanel_accts', $server_info[$alias]['cpanel_accounts']);
                    $this->db->set('mysql_status', $server_info[$alias]['MySQL']);
                    $this->db->where('id', $id);
                    $this->db->update('servers');
                    $server_info[$alias]['cores'] = $server['cores'];

                }

            }
            return $server_info;

        }

    }

    public function active_subs()
    {
        $this->db->where('status', 'active');
        $this->db->where('gateway !=', 'trial');
        $this->db->where('subscription_id !=', 0);

        $query = $this->db->get('user_subscription');
        if ($query->num_rows() > 0) {
            $active = $query->num_rows();
        } else {
            $active = 0;
        }

        return $active;

    }

    public function active_domain()
    {

        $total = $this->db->get('domain_manage')->num_rows();

        $query1 = $this->db->where('status', 'active');

        $active = $query1->get('domain_manage')->num_rows();

        $query2 = $this->db->where('status', 'inactive');

        $inactive = $query2->get('domain_manage')->num_rows();

        $query3 = $this->db->where('status', 'held');

        $held = $query3->get('domain_manage')->num_rows();

        $data[] = array(

            'total' => $total,

            'active' => $active,

            'inactive' => $inactive,

            'held' => $held

        );

        return $data;

    }

    public function open_tickets()
    {

        //     $query1 = $this->db->where_not_in('admin_read',1);

        $this->db->where(array('status' => 'open', 'p_id' => 0, 'admin_read' => 0));

        $NewTickets = $this->db->get('tickets')->num_rows();

        $this->db->where(array('status' => 'open', 'p_id' => 0));

        $openTickets = $this->db->get('tickets')->num_rows();

        $data[] = array(

            'open' => $openTickets,

            'total' => $NewTickets

        );

        return $data;

    }

    public function c_revenue()
    {

        //  select month(`order_time`) as themonth , SUM(`amount`)

//from transactions group  by month(`order_time`) ;datepart(yyyy, [date]) as [year]

        function paid($tag)
        {

            return array(

                'paid' => $tag['amount'],

                'theyear' => $tag['theyear'],

                'themonth' => $tag['themonth'],

            );

        }

        function pending($tag)
        {

            return array(

                'pending' => $tag['amount'],

                'theyear' => $tag['theyear'],

                'themonth' => $tag['themonth'],

            );

        }

        $this->db->select_sum('amount');

        $this->db->select("month(order_time) themonth,year(order_time) theyear")->from('transactions');

        $this->db->where('payment_status', 'Completed');

        $this->db->group_by('year(order_time)');

        $this->db->group_by('month(order_time)');

        $array = $this->db->get()->result_array();

        $array = array_map("paid", $array);

        $this->db->select_sum('amount');

        $this->db->select("month(order_time) themonth,year(order_time) theyear")->from('transactions');

        $this->db->where_not_in('payment_status', 'Completed');

        $this->db->group_by('year(order_time)');

        $this->db->group_by('month(order_time)');

        $array_pending = $this->db->get()->result_array();

        $array_pending = array_map("pending", $array_pending);

        $new_array = array_merge($array, $array_pending);

        $data[] = array(

            'Year', 'Revenue paid ', 'Revenue pending'

        );

        foreach ($new_array as $res) {

            $monthNum = $res['themonth'];

            $dateObj = DateTime::createFromFormat('!m', $monthNum);

            $monthName = $dateObj->format('F'); // March

            $yearDate = $monthName . '-' . $res['theyear'];

            $paid = isset($res['paid']) ? $res['paid'] : null;

            $pending = isset($res['pending']) ? $res['pending'] : null;

            $data[] = array($yearDate, $paid, $pending);

        }

        return $data;

    }

    public function total_revenue()
    {

        $this->db->select('*');

        $this->db->from('transactions');

        // $this->db->where('payment_status','Completed') ;

        $records = $this->db->get()->result_array();

        $total_sum = '';

        foreach ($records as $row) {

            $total_sum += $row['amount'];

        }

        return $total_sum;

    }

    public function iw_info()
    {
        $this->db->select('*')->from('build_credentials');
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }
       // echo $iwriter_api;
       // echo"<br><br>".$iwriter_user;
        //get balance
        $xml = '<request>
   <user_id>' . $iwriter_user . '</user_id>
   <api_key>' . $iwriter_api . '</api_key>
   <func_name>get_balance</func_name>
</request>';
        $response = call_iwriter($xml);
        // var_dump($response)."<br /><br />";
        $balance = $response->available;

        //get project data
        $xml = '<request>
   <user_id>' . $iwriter_user . '</user_id>
   <api_key>' . $iwriter_api . '</api_key>
   <func_name>get_projects</func_name>
   <show_archived>1</show_archived>
</request>';
        $response = call_iwriter($xml);
       // var_dump($response);
        $articles_queued = 0;
        $completed_articles = 0;
        $waiting_approval = 0;
        foreach ($response->project as $project) {
            if ((string) $project->open != 0) {

                $articles_queued++;
            } else if ((string) $project->pending_review != 0) {

                $waiting_approval++;
            } else {

                $completed_articles++;
            }

        }
        $articles['projects'][0] = array(
            'balance' => $balance,
            'completed' => $completed_articles,
            'queued' => $articles_queued,
            'pending' => $waiting_approval,
        );

        return $articles;
    }

}

?>


