<?php

class WebsiteModel extends CI_Model
{

    public $domains;

    public function __construct()
    {

        parent::__construct();
        $ci = &get_instance();
        $this->load->helper('p_helper');
        $this->load->helper('array');
        $this->load->library('ftp');
        $this->load->library('upload');
        $this->domains = $this->config->item('domains');

    }

    public function get_site_mode()
    {


        return $this->db->get('server_settings')->row()->site_mode;

    }
    public function get_user_credentials(){
        $query = $this->db->get_where('user_credentials',array('user_id' => $this->session->userdata('ID')));
            return $query->result_array();
    }
    public function add_domain($data, $domain_id)
    {

        $this->db->insert('domains', $data);

        $data = array('status' => 'taken');

        $this->db->where('id', $domain_id);

        $result = $this->db->update('domain_manage', $data);

    }

    public function grab_domain($allowed_domains)
    {
        if ($allowed_domains > 0) {
            $this->db->select('domain,held_time');
            $this->db->where('status', 'held');
            $query = $this->db->get('domain_manage');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    if ($row->held_time <= strtotime('-1 day')) { //hold domain for client for 7 days. If not built within that time release it so another client can use it
                        $data = array(
                            'held_time' => 0,
                            'assignedto' => 0,
                            'status' => 'active'
                        );
                        $this->db->where('domain', $row->domain);
                        $this->db->update('domain_manage', $data);
                    }
                }
            }
            $this->db->select('domain');
            $data = array('assignedto' => $this->session->userdata('ID'), 'status' => 'held');
            $this->db->where($data);
            $query = $this->db->get('domain_manage');
            $row = $query->row();

            if (isset($row)) {
                return $row->domain;
            } else {
                $this->db->select('domain');
                $this->db->where('assignedto', $this->session->userdata('ID'));
                $query = $this->db->get('domain_manage');

                $this->db->select('domain');
                $data = array('assignedto' => 0, 'status' => 'active');
                $this->db->where($data);
                $query = $this->db->get('domain_manage');
                $row = $query->row();

                if (isset($row)) {
                    //$chosen_domain = $row->domain;
                    $data = array(
                        'assignedto' => $this->session->userdata('ID'),
                        'held_time' => strtotime('now'),
                        'status' => 'held'
                    );
                    $this->db->where('domain', $row->domain);
                    $this->db->update('domain_manage', $data);
                    return $row->domain;
                } else {
                    return "No domain availble. Please send a support ticket.";
                }

            }
        } else {
            return 0;
        }
    }

    public function get_time_remaining($domain_name)
    {
        $this->db->select('held_time');
        $data = array('assignedto' => $this->session->userdata('ID'), 'domain' => $domain_name);
        $this->db->where($data);
        $query = $this->db->get('domain_manage');
        $row = $query->row();

        if (isset($row)) {
            $time_remaining = strtotime('now') - $row->held_time;
            $time_remaining = 1 - ceil($time_remaining / (60 * 60 * 24));

            if ($time_remaining == 1) {
                return $time_remaining . " day";
            } else if ($time_remaining > 1) {
                return $time_remaining . " days";
            } else {
                return "1 day";
            }

        }
    }

    public function get_Admin_domain()
    {

        $this->db->order_by('rand()');

        $this->db->limit(1);

        $query = $this->db->get('domain_manage');

        return $query->result();

    }
    public function get_domains()
    {
        $this->db->where('status', 'active');
        $query = $this->db->get('domain_manage');

        return $query->result();

    }
    public function update_domain_status()
    {

        $domain_id = $_POST['domain'];

        $data = array('status' => 'taken');

        $this->db->where('id', $domain_id);

        $result = $this->db->update('domain_manage', $data);

        return $result;

    }

    public function count_user_domain($user_id)
    {

        $this->db->where('user_id', $user_id);

        $query = $this->db->get('domains');

        return $query->num_rows();

    }
     public function reset_domain($domain) {
       $this->db->select('*');
             $this->db->where('domain', $domain);
              $query =  $this->db->get('domain_manage');
              $row = $query->row();
             $ns = $row->ns1;
             //get server credentials using nameserver identifier
                $this->db->select('*');
             $this->db->where('nameserver_one', $ns);
          $query =   $this->db->get('servers');
              $row = $query->row();
           $whmusername = $row->whm_user;
           $token = $row->whm_token;
           $ip = $row->ip;
           //if domain is built get cpanel user
            $this->db->select('*');
             $this->db->where('domain', $domain);
           $query =  $this->db->get('domains');
          if($query->num_rows() > 0) {
              $row = $query->row();
             $cpanel_username = $row->cpanel_user;
              $has_cpanel = true;
          }else{
              //no cpanel user
            $has_cpanel = false;
          }
             $this->db->where('domain', $domain);
           $data = array(
'assignedto' => '0',
'status' => 'active',
'held_time' => '0'
);

           $this->db->update('domain_manage', $data);
            $this->db->where('domain', $domain);
            $this->db->delete('domains');
    if($has_cpanel){
 $query = "https://".$ip.":2087/json-api/removeacct?api.version=1&user={$cpanel_username}";

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm $whmusername:$token";

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $result = curl_exec($curl);

    curl_close($curl);


    }
     }
    public function generate_categories()
    {
        $all_top_results = array();
        $sellers_list = array();
        $sellers_only = array();
        $brands_list = array();
        //$return = $_POST;
        $this->db->select('proxy_crawl')->from('build_credentials');
        $query = $this->db->get();
        $row = $query->row();

        if (isset($row)) {
            $proxy_crawl = $row->proxy_crawl;

        }
        $node = $this->input->post('node');
        $site_kwd = $this->input->post('site_kwd');
        //$return['site_kwd'];

        //$return_search = 'no';
        $return_search = "yes";//$this->input->post('return_count');
        //grab html first run
        $azon_link = urlencode('https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=' . $site_kwd .'&node='.$node);
        $url = "https://api.proxycrawl.com/?token=" . $proxy_crawl . "&url=" . $azon_link . "&format=json";
        $html = json_decode(scrape_url_content($url));
        if($html == ''){
          $html = json_decode(scrape_url_content($url));
        }
//get brands
        if (strpos($html->body, 'Brand</h4>') !== false) {

            $brands = get_string_between($html->body, 'Brand</h4>', '</ul>');
            $brands_list = explode("<label>", $brands);
            array_shift($brands_list);

//get serach results for each brand
            $i = 0;
            foreach ($brands_list as $element) {
                // do{  // limit requests while testing
                $brand_only = get_string_between($element, 's-ref-link-cursor">', '</span>');
                $brand_only = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $brand_only)));
                if (in_array($brand_only, $all_top_results)) {

                } else {
                    if (strpos($brand_only, '.com') !== false) {
                        $brand_only = str_replace(".com", "", $brand_only);
                    }
                    if (strpos($brand_only, '&amp;') !== false) {
                        $brand_only = str_replace("&amp;", "&", $brand_only);
                    }
                    if (strpos($brand_only, '&#039') !== false) {
                        $brand_only = str_replace("&#039", "", $brand_only);
                    }
                    if (strpos($brand_only, "'") !== false) {
                        $brand_only = str_replace("'", "", $brand_only);
                    }
                    if (strpos($brand_only, ',') !== false) {
                        $brand_only = str_replace(",", "", $brand_only);
                    }

                    $brands_phrase = trim($brand_only . " " . $site_kwd);
                    $brands_phrase = ucwords($brands_phrase);
                    if ($return_search == "yes") {
                        $azon_link = urlencode('https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=' . $brands_phrase);
                        $url = "https://api.proxycrawl.com/?token=" . $proxy_crawl . "&url=" . $azon_link . "&format=json";
                        $html_brands = json_decode(scrape_url_content($url));
                        $brands_search_count_text = get_string_between($html_brands->body, 's-result-count">', '</span>');
                        $brands_search_count = find_search_count($brands_search_count_text);
                        if (strpos($brands_search_count, "over") !== false) {
                        $brands_search_count_only = trim(str_replace("over", " ", $brands_search_count));
                    }else{
                       $brands_search_count_only = $brands_search_count;
                    }

                        if($brands_search_count_only > 80 && $brands_search_count_only != ""){
                           //$all_top_results[] = array('brand' => $brands_phrase, 'bsearch' => $brands_search_count);
                           $all_top_results[] = array('brand' => $brands_phrase);
                        }

                    } else {
                        $all_top_results[] = array('brand' => $brands_phrase);
                    }
                    $all_top_results;
                }
                $i++;
            }

        }

//get sellers
        if (strpos($html->body, 'Seller</h4>') !== false) {
            $sellers = get_string_between($html->body, 'Seller</h4>', '</ul>');
            $sellers_list = explode("<label>", $sellers);
            array_shift($sellers_list);
            $i = 0;
            foreach ($sellers_list as $element) {

                $sellers_only = get_string_between($element, 's-ref-link-cursor">', '</span>');
                $sellers_only = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $sellers_only)));
                if (in_array($sellers_only, $all_top_results)) {

                } else {

                    if (strpos($sellers_only, '.com') !== false) {
                        $sellers_only = str_replace(".com", "", $sellers_only);
                    }
                    if (strpos($sellers_only, '&amp;') !== false) {
                        $sellers_only = str_replace("&amp;", "&", $sellers_only);
                    }
                    if (strpos($sellers_only, '&#039') !== false) {
                        $sellers_only = str_replace("&#039", "", $sellers_only);
                    }
                    if (strpos($sellers_only, "'") !== false) {
                        $sellers_only = str_replace("'", "", $sellers_only);
                    }
                    if (strpos($sellers_only, ',') !== false) {
                        $sellers_only = str_replace(",", "", $sellers_only);
                    }

                    $sellers_phrase = trim($sellers_only . " " . $site_kwd);
                    $sellers_phrase = ucwords($sellers_phrase);
                    if ($return_search == "yes") {
                        $azon_link = urlencode('https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=' . $sellers_phrase);
                        $url = "https://api.proxycrawl.com/?token=" . $proxy_crawl . "&url=" . $azon_link . "&format=json";
                        $html_sellers = json_decode(scrape_url_content($url));
                        $sellers_search_count_text = get_string_between($html_sellers->body, 's-result-count">', '</span>');
                        $sellers_search_count = find_search_count($sellers_search_count_text);
                         if (strpos($sellers_search_count, "over") !== false) {
                        $sellers_search_count_only = trim(str_replace("over", " ", $sellers_search_count));
                    }else{
                       $sellers_search_count_only = $sellers_search_count;
                    }

                        if($sellers_search_count_only > 80 && $sellers_search_count_only != ""){
                         // $all_top_results[] = array('seller' => $sellers_phrase, 'ssearch' => $sellers_search_count);
                           $all_top_results[] = array('seller' => $sellers_phrase);
                        }

                    } else {
                        $all_top_results[] = array('seller' => $sellers_phrase);

                    }
                    $all_top_results;

                }
                $i++;

            }
        }

        //get search terms
        $search_terms = get_string_between($html->body, '<ul class="a-unordered-list a-nostyle a-vertical s-ref-indent', '</ul>');

        $search_list = explode('<span class="a-list-item">', $search_terms);
        array_shift($search_list);

        $i = 0;

        foreach ($search_list as $element) {
            $good_item = true;
            // echo "element: ".$element."<br /><br />";
            //do{  // limit requests while testing
            $search_only = get_string_between($element, 'a-color-base">', '</span>');
            $search_only = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $search_only)));
            if (in_array($search_only, $all_top_results)) {

            } else {
                if (strlen($search_only) < 3) {
                    $good_item = false;
                    //echo "no text<br>";
                }
                if (strstr($search_only, '& Up') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, '& Up') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, '&Amp; Up') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, '$') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, 'Used') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, 'New') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, 'Category') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, 'See more') !== false) {
                    $good_item = false;
                }
                if (strstr($search_only, '\n') !== false) {
                    $good_item = false;
                    // echo "new line found<br>";
                }

                if ($good_item == true) {

                    if (strpos($search_only, '.com') !== false) {
                        $search_only = str_replace(".com", "", $search_only);
                    }
                    if (strpos($search_only, '&amp;') !== false) {
                        $search_only = str_replace("&amp;", "&", $search_only);
                    }
                    if (strpos($search_only, '&#039') !== false) {
                        $search_only = str_replace("&#039", "", $search_only);
                    }
                    if (strpos($search_only, "'") !== false) {
                        $search_only = str_replace("'", "", $search_only);
                    }
                    if (strpos($search_only, ',') !== false) {
                        $search_only = str_replace(",", "", $search_only);
                    }

                    $search_phrase = trim($search_only);
                    $search_phrase = ucwords($search_phrase);
                    if ($return_search == "yes") {
                        $azon_link = urlencode('https://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Daps&field-keywords=' . $search_phrase);
                        $url = "https://api.proxycrawl.com/?token=" . $proxy_crawl . "&url=" . $azon_link . "&format=json";
                        $html_search = json_decode(scrape_url_content($url));
                        $search_count_text = get_string_between($html_search->body, 's-result-count">', '</span>');
                        $search_search_count = find_search_count($search_count_text);
                         if (strpos($search_search_count, "over") !== false) {
                        $search_search_count_only = trim(str_replace("over", " ", $search_search_count));
                    }else{
                       $search_search_count_only = $search_search_count;
                    }

                        if($search_search_count_only > 80 && $search_search_count_only != ""){
                          //$all_top_results[] = array('scategory' => $search_phrase, 'csearch' => $search_search_count);
                          $all_top_results[] = array('scategory' => $search_phrase);
                        }

                    } else {
                        $all_top_results[] = array('scategory' => $search_phrase);
                    }

                    $all_top_results;

                }

            }
            $i++;
            // }while($i < 10 && $i < count($search_list));
        }

/*$response = array(
'arBrands' => $brand_results,
'arSellers' => $seller_results,
'arSearch'  => $search_results
);*/

        return json_encode($all_top_results);
    }
    public function get_whm()
    {
        $this->db->order_by('id', 'RANDOM');
        $this->db->where('type', 'production');
        $query = $this->db->get('servers');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function get_demo_whm()
    {
        $this->db->order_by('id', 'RANDOM');
        $this->db->where('type', 'demo');
        $query = $this->db->get('servers');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function get_whm_by_id($id)
    {
        $query = $this->db->get_where('servers',array('id' => $id));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function get_build_creds()
    {
      $query = $this->db->get('build_credentials');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
  /*  public function create_addon()
    {


        //https://hostname.example.com:2087/cpsess###########/json-api/cpanel?cpanel_jsonapi_user=user&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=AddonDomain&cpanel_jsonapi_func=addaddondomain&dir=addondomain%2Fhome%2Fdir&newdomain=addondomain.com&subdomain=subdomain.example.com
        /******************************

        This function creates an addon domain for

        the users cpanel account and creates a new database,

        database user, and dds user to database.

        To use this script you must create

        a token in WHM (under Manage Tokens).

         *******************************/

   /*     $whm['creds'] = $this->get_whm();

        // $token = $this->config->item('whm_token');

        //$ip = $this->config->item('whm_ip');

        $userid = $this->session->userdata['ID'];

        $domain = $this->input->post('domain');

        $domain_end = stripos($domain, ".", 0);
          $theme_color = $this->input->post('theme_color');
        $theme_color_random = $this->input->post('theme_color_random');
        if($theme_color_random == "random"){
          $theme_color = "random";
        }
        $domain_no_ext = substr($domain, 0, $domain_end);
        $title = $this->input->post('site_name');

        $categories = $this->input->post('categories');

        $node = $this->input->post('node');

        $site_kwd = $this->input->post('site_kwd');

        $query1 = $this->db->get_where('domain_manage', array('assignedto' => $this->session->userdata('ID'), 'domain' => $domain, 'status' => 'held'));
        $query2 = $this->db->get_where('domains', array('user_id' => $this->session->userdata('ID')));
        $row1 = $query1->row();
        $row2 = $query2->row();

        if (isset($row1)) {
            $domain_id = $row1->id;
        }
        if (isset($row2)) {
            $username = $row2->cpanel_user;
            $password = $row2->cpanel_pass;

            // create new addon domain

            $keep_trying_account = true;

            do {

                $keep_trying = true;

                $query_whm = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=" . $username . "&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=AddonDomain&cpanel_jsonapi_func=addaddondomain&dir=" . $domain_no_ext . "%2Fhome%2Fdir&newdomain=" . $domain . "&subdomain=" . $domain_no_ext . "." . $domain;
                $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

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
                if ($result['cpanelresult']['event']['result'] == 1) {
                    $keep_trying_account = false;
                } else {

                }

            } while ($keep_trying_account == true);

            sleep(3);
            //set up database for WP isntallation
            //check if username is longer than 8 characters and truncate it, creates database prefix

            $db_user_count = strlen($username);

            if ($db_user_count > 8) {

                $db_prefix = substr($username, 0, 8);

            } else {

                $db_prefix = $username;

            }

            //generate required credentials

            $db_suffix = generateRandomString(5);

            $user_suffix = generateRandomString(3);

            $db_name = $db_prefix . "_" . $db_suffix;

            $db_user = $db_prefix . "_user" . $user_suffix;

            //create db

            $query_whm = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/create_database?name=" . $db_name;

            $curl = curl_init(); // Create Curl Object

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

            curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

            $header[0] = "Authorization: Basic " . base64_encode($username . ":" . $password) . "\n\r";

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

            curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

            $result = curl_exec($curl);

            curl_close($curl);

            //create db user

            $keep_trying_user_acct = true;

            do {

                $keep_trying = true;

                do {

                    $db_pass = generateStrongPassword(12, false, 'luds');

                    $count = preg_match_all('/[\'^£$%&*()}{~><>,|=_+¬-]/', $db_pass);

                    if ($count > 3) {

                        $keep_trying = false;

                    }

                } while ($keep_trying == true);

                $query_whm = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/create_user?name=" . $db_user . "&password=" . $db_pass;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                $header[0] = "Authorization: Basic " . base64_encode($username . ":" . $password) . "\n\r";

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);

                curl_close($curl);

                if (strpos($result, "system does not allow the given password") > 0) {

                } else {

                    $keep_trying_user_acct = false;

                }

            } while ($keep_trying_user_acct == true);

            //add user to db

            $query = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/set_privileges_on_database?database=" . $db_name . "&user=" . $db_user . "&privileges=ALL";

            $curl = curl_init(); // Create Curl Object

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

            curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

            $header[0] = "Authorization: Basic " . base64_encode($username . ":" . $password) . "\n\r";

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

            curl_setopt($curl, CURLOPT_URL, $query); // execute the query

            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

            $result = curl_exec($curl);
            curl_close($curl);
            $json = json_decode($result, true); //true makes it return an array
            if ($json['status'] == 1) {
                $d_array = array(

                    'user_id' => $this->session->userdata['ID'],

                    'domain' => $domain,

                    'status' => 'open',

                    'blog_installed' => 'Yes',

                    'articles_created' => 0,

                    'articles_published' => 0,

                    'creation_date ' => 0,

                    'site_title ' => $title,

                    'cpanel_user' => $username,

                    'cpanel_pass' => $password,

                    'node' => $node,

                    'site_kwd' => $site_kwd,

                    'categories' => $categories,

                    'wp_database' => $db_name,

                    'wp_db_user' => $db_user,

                    'wp_db_pass' => $db_pass,

                    'domain_mgmt_id' => $domain_id,

                    'theme_color'  => $theme_color

                );
                $this->db->insert('domains', $d_array);

                return true;
            } else {
                return 0;
            }
        } else {
            return 0;
        }

    }   */
   public function delete_user_demo(){

             $this->db->select('*');
             $this->db->like('domain', 'demo');
             $this->db->where('status', 'demo');
             $this->db->where('user_id', $this->session->userdata['ID']);
           $query =  $this->db->get('domains');
             foreach ($query->result() as $row)
{
             $cpanel_username = $row->cpanel_user;
              $db = $row->wp_database;
              $db_user = $row->wp_db_user;
             $domain = $row->domain;
              $server_id = $row->server;
            $subfolder = explode('.', $domain)[0];
             //get whm creds
             $whm['creds'] = $this->get_whm_by_id($server_id);

  //delete subdomain
 $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=delsubdomain&domain=".$domain;

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);
  // $result = json_decode($res, true);
                  //delete DB

                    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedb&db=".$db;

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);
  // $result = json_decode($res, true);

           //delete DB User

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedbuser&dbuser=".$db_user;

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);
 //  $result = json_decode($res, true);
    //unlink sub folder

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Fileman&cpanel_jsonapi_func=fileop&op=unlink&sourcefiles=%2Fpublic_html%2Fdemo%2F".$subfolder."&doubledecode=0";

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);


   $result = json_decode($res, true);
    /*  echo " <pre>";
        print_r($result);
        echo "</pre>";
   */


        $this->db->where('status','demo');
         $this->db->where('user_id', $this->session->userdata['ID'] );
         $this->db->delete('domains');
         $this->db->where('domain',$domain);
         $this->db->delete('categories');
          }
        return true;

    }


 public function create_demo()
    {

         //creates a subdomain and installs wp on it
         $whm['creds'] = $this->get_demo_whm();

         $whm['demo'] = $this->get_build_creds();
         $cp_username = $whm['demo'][0]->demo_cpanel_user;
         $cp_password = $whm['demo'][0]->demo_cpanel_pass;
        // $cp_username =  "digitgardens";
        // $cp_password =  "4ab767a089@)!*";
        $userid = $this->session->userdata['ID'];
         $ads_option = $this->input->post('ads_option');
        $title = $this->input->post('site_name');
        $theme_color = $this->input->post('theme_color');
        $theme_color_random = $this->input->post('theme_color_random');
        if($theme_color_random == "random"){
          $colors = array("#c6b81b", "#d32f2f", "#5c6bc0","#3d5afe", "#64b5f6", "#0097a7","#388e3c", "#81c784", "#607d8b","#e64a19");
                    $rand_key = array_rand($colors,1);
                    $theme_color = $colors[$rand_key];
        }
        $categories = $this->input->post('categories');
        $categories_array = explode(',',$categories);
        $categories = '';
        $cat_counter =0;
        foreach($categories_array as $cat){
            if($cat_counter < 10){
                $categories .= $cat.',';
            }
            $cat_counter++;
        }

        $node = $this->input->post('node');

        $site_kwd = $this->input->post('site_kwd');
         $subdomain = strtolower("demo-".$userid.generateRandomString(6));
          $domain = $subdomain.".".$whm['demo'][0]->demo_domain;
           //$domain = $subdomain.".digitgardens.com";
            // create new addon domain

            $keep_trying_account = true;

            do {

                $keep_trying = true;
                //$query_whm = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=digitgardens&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=addsubdomain&domain=".$subdomain."&rootdomain=digitgardens.com&dir=%2Fpublic_html%2Fdemo%2F".$subdomain."&disallowdot=1";
               // echo" QUERY: ".$query_whm." ";
                $query_whm = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=addsubdomain&domain=".$subdomain."&rootdomain=".$whm['demo'][0]->demo_domain."&dir=%2Fpublic_html%2Fdemo%2F".$subdomain."&disallowdot=1";
                $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

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
                if ($result['cpanelresult']['event']['result'] == 1) {
                    $keep_trying_account = false;
                } else {

                }

            } while ($keep_trying_account == true);

            sleep(3);
            //set up database for WP isntallation
            $db_user_count = strlen($cp_username);
              if ($db_user_count > 8) {

                $db_prefix = substr($cp_username, 0, 8);

            } else {

                $db_prefix = $cp_username;

            }
            //generate required credentials

            $db_suffix = generateRandomString(5);

            $user_suffix = generateRandomString(3);

            $db_name = $db_prefix . "_" . $db_suffix;

            $db_user = $db_prefix . "_user" . $user_suffix;

            //create db

            $query_whm = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/create_database?name=" . $db_name;

            $curl = curl_init(); // Create Curl Object

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

            curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

            $header[0] = "Authorization: Basic " . base64_encode($cp_username . ":" . $cp_password) . "\n\r";

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

            curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

            $result = curl_exec($curl);

            curl_close($curl);
        /*       echo " <pre>";
        print_r($result);
        echo "</pre>";
         */
            //create db user

            $keep_trying_user_acct = true;

            do {

                $keep_trying = true;

                do {

                    $db_pass = generateStrongPassword(12, false, 'luds');

                    $count = preg_match_all('/[\'^£$%&*()}{~><>,|=_+¬-]/', $db_pass);

                    if ($count > 3) {

                        $keep_trying = false;

                    }

                } while ($keep_trying == true);

                $query_whm = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/create_user?name=" . $db_user . "&password=" . $db_pass;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                $header[0] = "Authorization: Basic " . base64_encode($cp_username . ":" . $cp_password) . "\n\r";

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);

                curl_close($curl);
          /*         echo " <pre>";
        print_r($result);
        echo "</pre>"; */

                if (strpos($result, "system does not allow the given password") > 0) {

                } else {

                    $keep_trying_user_acct = false;

                }

            } while ($keep_trying_user_acct == true);

            //add user to db

            $query = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/set_privileges_on_database?database=" . $db_name . "&user=" . $db_user . "&privileges=ALL";

            $curl = curl_init(); // Create Curl Object

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

            curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

            $header[0] = "Authorization: Basic " . base64_encode($cp_username . ":" . $cp_password) . "\n\r";

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

            curl_setopt($curl, CURLOPT_URL, $query); // execute the query

            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

            $result = curl_exec($curl);
            curl_close($curl);
         /*    echo " <pre>";
        print_r($result);
        echo "</pre>";   */
            $json = json_decode($result, true); //true makes it return an array
            if ($json['status'] == 1) {
                $d_array = array(

                    'user_id' => $this->session->userdata['ID'],

                    'domain' => $domain,

                    'status' => 'open',

                    'blog_installed' => 'Yes',

                    'articles_created' => 0,

                    'articles_published' => 0,

                    'creation_date ' => 0,

                    'site_title ' => $title,

                    'cpanel_user' => $cp_username,

                    'cpanel_pass' => $cp_password,

                    'node' => $node,

                    'site_kwd' => $site_kwd,

                    'categories' => $categories,

                    'wp_database' => $db_name,

                    'wp_db_user' => $db_user,

                    'wp_db_pass' => $db_pass,

                    'domain_mgmt_id' => 0,

                    'theme_color' => $theme_color,

                    'ads_option' => $ads_option,

                    'server' => $whm['creds'][0]->id,

                    'wp_user' => "none",

                    'wp_pass' => "none",

                    'products_progress' => 0

                );
                $this->db->insert('domains', $d_array);

                return 1;
            } else {
                return $json;
            }


    }
    public function create_cpanel()
    {

        /******************************

        This function creates a new cpanel account on WHM

        and creates a new database, database user, and

        adds user to database.

        To use this script you must create

        a token in WHM (under Manage Tokens).

         *******************************/

        //$whmusername = $this->config->item('whm_user');

        // $token = $this->config->item('whm_token');

        // $ip = $this->config->item('whm_ip');
        $whm['creds'] = $this->get_whm();
        $userid = $this->session->userdata['ID'];

        $domain = $this->input->post('domain');

        $domain_end = stripos($domain, ".", 0);
         $theme_color = $this->input->post('theme_color');
                $theme_color_random = $this->input->post('theme_color_random');
                 if($theme_color_random == "random"){
          $colors = array("#c6b81b", "#d32f2f", "#5c6bc0","#3d5afe", "#64b5f6", "#0097a7","#388e3c", "#81c784", "#607d8b","#e64a19");
                    $rand_key = array_rand($colors,1);
                    $theme_color = $colors[$rand_key];
        }
        $domain_no_ext = substr($domain, 0, $domain_end);
        $domain_no_ext_fixed = str_replace("-","",$domain_no_ext);
        $domain_no_ext_fixed = str_replace("_","",$domain_no_ext_fixed);
        $title = $this->input->post('site_name');
         $ads_option = $this->input->post('ads_option');
        $categories = $this->input->post('categories');
         $categories_array = explode(',',$categories);
        $categories = '';
        $cat_counter =0;
        foreach($categories_array as $cat){
            if($cat_counter < 10){
                $categories .= $cat.',';
            }
            $cat_counter++;
        }
        $node = $this->input->post('node');

        $site_kwd = $this->input->post('site_kwd');
        $data = array('assignedto' => $this->session->userdata('ID'), 'domain' => $domain, 'status' => 'held');

        $query = $this->db->get_where('domain_manage', $data);
        if ($query->num_rows() > 0) {


       $row = $query->row();
            $domain_id = $row->id;

            $good_username = false;

            do {

                $username = strtolower(generateRandomString(4) . substr($domain_no_ext_fixed, 0, 4));
                //$header[0] = "Authorization: whm $whmusername:$token";
                $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

                //query account list to check if account has been created already to avoid errors in adding account

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, "https://" . $whm['creds'][0]->ip . ":2087/json-api/listaccts?api.version=1");

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);

                if (preg_match_all('/"user"\:.*?(?="\,)/', $result, $matches)) {

                    $paths = current($matches); // we find all "user":"username in paths array from account list

                }

                $count = count($paths);

                $paths = str_replace('"user":', '', $paths, $count); //replace all strings in array "user": to blank

                $paths = str_replace('"', '', $paths, $count); //replace all strings in array " to blank so final product should be just usernames in the array

                if (in_array($username, $paths)) {

                } else {

                    $good_username = true;

                }

                curl_close($curl);

            } while ($good_username == false);

            // create new cPanel account

            $keep_trying_account = true;

            do {

                $keep_trying = true;

                do {

                    $password = generateStrongPassword(12, false, 'luds');

                    $count = preg_match_all('/[\'^£$%&*()}{~><>,|=_+¬-]/', $password);

                    if ($count < 3) {

                        $keep_trying = false;

                    }

                } while ($keep_trying == true);

                $query_whm = "https://" . $whm['creds'][0]->ip . ":2087/json-api/createacct?api.version=1&username=" . $username . "&domain=" . $domain . "&plan=default&featurelist=default&password=" . $password . "&ip=n&cgi=1&hasshell=1&contactemail=phasebrands@gmail.com&cpmod=paper_lantern&maxftp=5&maxsql=5&maxpop=10&maxlst=5&maxsub=1&maxpark=1&maxaddon=1&bwlimit=500&language=en&useregns=1&hasuseregns=1&reseller=0&forcedns=1&mailbox_format=mdbox&mxcheck=local&max_email_per_hour=500&max_defer_fail_percentage=80&owner=root";
                $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);
                $json = json_decode($result, true);




                if ($result == false) {

                    error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");

                    // log error if curl exec fails

                }

                curl_close($curl);

                if (strpos($result, "password you selected cannot be used") > 0) {

                } else {

                    $keep_trying_account = false;

                }

            } while ($keep_trying_account == true);
             if ($json['metadata']['result'] == 1) {
            sleep(3);

            //check if username is longer than 8 characters and truncate it, creates database prefix

            $db_user_count = strlen($username);

            if ($db_user_count > 8) {

                $db_prefix = substr($username, 0, 8);

            } else {

                $db_prefix = $username;

            }

            //generate required credentials

            $db_suffix = generateRandomString(5);

            $user_suffix = generateRandomString(3);

            $db_name = $db_prefix . "_" . $db_suffix;

            $db_user = $db_prefix . "_user" . $user_suffix;

            //create db

            $query_whm = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/create_database?name=" . $db_name;

            $curl = curl_init(); // Create Curl Object

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

            curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

            $header[0] = "Authorization: Basic " . base64_encode($username . ":" . $password) . "\n\r";

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

            curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

            $result = curl_exec($curl);

            curl_close($curl);
           $json = json_decode($result, true);

            if ($json['status'] == 1) {



            //create user

            $keep_trying_user_acct = true;

            do {

                $keep_trying = true;

                do {

                    $db_pass = generateStrongPassword(12, false, 'luds');

                    $count = preg_match_all('/[\'^£$%&*()}{~><>,|=_+¬-]/', $db_pass);

                    if ($count > 3) {

                        $keep_trying = false;

                    }

                } while ($keep_trying == true);

                $query_whm = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/create_user?name=" . $db_user . "&password=" . $db_pass;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                $header[0] = "Authorization: Basic " . base64_encode($username . ":" . $password) . "\n\r";

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);

                curl_close($curl);
                $json = json_decode($result, true);

                if (strpos($result, "system does not allow the given password") > 0) {

                } else {

                    $keep_trying_user_acct = false;

                }

            } while ($keep_trying_user_acct == true);

            //add user to db

            $query = "https://" . $whm['creds'][0]->ip . ":2083/execute/Mysql/set_privileges_on_database?database=" . $db_name . "&user=" . $db_user . "&privileges=ALL";

            $curl = curl_init(); // Create Curl Object

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

            curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

            $header[0] = "Authorization: Basic " . base64_encode($username . ":" . $password) . "\n\r";

            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

            curl_setopt($curl, CURLOPT_URL, $query); // execute the query

            curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

            $result = curl_exec($curl);
            curl_close($curl);
            $json = json_decode($result, true);
            //check if email is added, if not delete domain
             $query_whm = "https://" . $whm['creds'][0]->ip . ":2087/json-api/accountsummary?api.version=1&user=".$username;
                $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);
                $json = json_decode($result, true);
                if($json['data']['acct'][0]['email'] != ""){

                $d_array = array(

                    'user_id' => $this->session->userdata['ID'],

                    'domain' => $domain,

                    'status' => 'open',

                    'blog_installed' => 'Yes',

                    'articles_created' => 0,

                    'articles_published' => 0,

                    'creation_date ' => 0,

                    'site_title ' => $title,

                    'cpanel_user' => $username,

                    'cpanel_pass' => $password,

                    'node' => $node,

                    'site_kwd' => $site_kwd,

                    'categories' => $categories,

                    'wp_database' => $db_name,

                    'wp_db_user' => $db_user,

                    'wp_db_pass' => $db_pass,

                    'domain_mgmt_id' => $domain_id,

                    'theme_color' => $theme_color,

                    'ads_option' => $ads_option,

                    'server' => $whm['creds'][0]->id,

                    'wp_user' => "none",

                    'wp_pass' => "none",

                    'products_progress' => 0

                );
                $insertID = $this->db->insert('domains', $d_array);
                $this->db->set('status','taken');
                $this->db->where('assignedto',$this->session->userdata['ID']);
                $this->db->update('domain_manage');
                return 1;
            } else {
               echo "1st else: ". var_dump($json);
            }
           }else {
                echo " domain is: ".$domain;
               echo "2nd else: ".
                var_dump($json);
            }
            }else {
                echo "3rd else: ".
                var_dump($json);
            }
        } else {
            echo "4th else: ";
            var_dump($query);
        }
    }
    public function verify_ns()
    {

        $dns_result = dns_get_record($this->input->post('domain_ns'), DNS_NS);
        return json_encode($dns_result);
    }

 /*   public function deploy_wordpress()
    {

        $query = $this->db->get_where('domains', array('user_id' => $this->session->userdata('ID'), 'status' => 'open'));
        $row = $query->row();

        if (isset($row)) {

            $domain = $row->domain;
            $db_user = $row->wp_db_user;
            $db_pass = $row->wp_db_pass;
            $db_name = $row->wp_database;
            $title = $row->site_title;
            $categories = $row->categories;
            $node = $row->node;
            $site_kwd = $row->site_kwd;
            $username = $row->cpanel_user;
            $password = $row->cpanel_pass;
            $domain_id = $row->domain_mgmt_id;
            $theme_color = $row->theme_color;
            $ads_option = $row->ads_option;
            //generate WP Password

            $keep_trying_wp = true;

            do {

                $wp_password = generateStrongPassword(12, false, 'luds');

                $count = preg_match_all('/[\'^£$%&*()}{~><>,|=_+¬-]/', $wp_password);

                if ($count < 3) {

                    $keep_trying_wp = false;

                }

            } while ($keep_trying_wp == true);

            //upload wp setup file to domain
           //replace credentials
            $string_to_replace = "#CREDENTIALS#";

            $replace_with = "\$db_name = '" . $db_name . "';

    \$db_user = '" . $db_user . "';

    \$db_pass = '" . $db_pass . "';

    \$domain  = '" . $domain . "';

    \$title  = '" . $title . "';

    \$categories  = '" . $categories . "';

    \$node  = '" . $node . "';

    \$wp_password  = '" . $wp_password . "';

    \$site_kwd  = '" . $site_kwd . "';";

            $file_name = "setup_wp_" . $this->session->userdata['ID'] . "_" . uniqid();

            copy('http://phasebuilder.com/membershipkc/temp/setup_wp.txt', $file_name . ".txt");
            replace_string_in_file($file_name . ".txt", $string_to_replace, $replace_with, $file_name . ".txt");
            //replace theme color

                if($theme_color == "random"){
                    $colors = array("#c6b81b", "#d32f2f", "#5c6bc0","#3d5afe", "#64b5f6", "#0097a7","#388e3c", "#81c784", "#607d8b","#e64a19");
                    $theme_color = array_rand($colors,1);
                }
                         $string_to_replace = "#THEMECOLOR#";
                        $replace_with = $theme_color;
                          replace_string_in_file($file_name . ".txt", $string_to_replace, $replace_with, $file_name . ".txt");
                          //replace top ads code
                          switch($ads_option) {
    case 'no':
     $ads = '';
     break;
    case 'amazon':
    $ads = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->ads_code;
    if(!empty($ads)){

    }else{
        $ads = '';
    }
        break;
    case 'google':
     $ads_code = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->publisher_id;
    if(!empty($ads)){
        $ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- AZ 336x280 -->
<ins class="adsbygoogle"
    style="display:inline-block;width:336px;height:280px"
    data-ad-client="ca-'.$ads_code.'"
    data-ad-slot="4664319386"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
    }else{
        $ads = '';
    }
        break;
    default:
        $color_type = null;
        break;
}
                          $string_to_replace = "#TOPADCODE#";
                                                $replace_with = $ads;
                                                    replace_string_in_file($file_name . ".txt", $string_to_replace, $replace_with, $file_name . ".txt");
//replace bottom ads code
$string_to_replace = "#BOTTOMADCODE#";
                                                $replace_with = $ads;
                                                    replace_string_in_file($file_name . ".txt", $string_to_replace, $replace_with, $file_name . ".php");
            // set up basic connection

            $config['hostname'] = "ftp." . $domain;
            $config['username'] = $username . "@" . $domain;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
            sleep(5);
            if ($this->ftp->connect($config)) {
                $this->ftp->upload($file_name . ".php", '/public_html/setup_wp.php', 'ascii', 0775);

                // check if a file exist

                $setup_exists = false;

                //   $path = "/public_html/"; //the path where the file is located

                $file = "setup_wp.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use

                $contents_on_server = $this->ftp->list_files('/public_html/'); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $setup_exists = true;

                } else {

                    var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();

                //clean up

                unlink($file_name . ".php");

                unlink($file_name . ".txt");

            } else {
                $setup_exists = false;
            }

            if ($setup_exists == true) {

                //execute wordpress setup on remote domain

                $keep_trying_setup = true;

                do {

                    $query = "http://" . $domain . "/setup_wp.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);

                    curl_close($curl);

                    //check if setup was executed
                    if ($this->ftp->connect($config)) {

                        // check if a file exist

                        $file = "xmlrpc.php"; //the file you are looking for

                        $check_file_exist = $file; //combine string for easy use

                        $contents_on_server = $this->ftp->list_files('/public_html/'); //Returns an array of filenames from the specified directory on success or FALSE on error.

                        // Test if file is in the ftp_nlist array

                        if (in_array($check_file_exist, $contents_on_server)) {

                            $keep_trying_setup = false;

                        }

                        // close the connection

                        $this->ftp->close();

                    } else {
                        $keep_trying_setup = false;
                    }

                } while ($keep_trying_setup == true);

                sleep(5);
                //check if website was created successfully

                $url = 'http://' . $domain . '/wp-login.php';

                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $data = curl_exec($ch);
                curl_close($ch);

                if (strpos($data, "Log In") > 0) {

                    $website_verified = true;
                    $keep_trying_verify = false;

                } else {

                    $website_verified = false;

                }

                if ($website_verified == true) {
                    //website installed! Redirect user to Current Builds page
                    //store information into database

                    $data = array('status' => 'taken', 'wp_pass' => $wp_password, 'wp_user' => 'admin','creation_date' => strtotime('now'));
                    $this->db->where('domain', $domain);
                    $this->db->update('domains', $data);

                    $data = array('status' => 'taken');
                    $this->db->where('domain', $domain);
                    $this->db->update('domain_manage', $data);

                    $data = array('allowed_domains' => 'allowed_domains-1');
                    $this->db->where('ID', $this->session->userdata('ID'));
                    $this->db->update('user_table', $data);

                    if ($this->input->post('domain_build') == "cherry") {
                        $data = array('domain_credits' => 'domain_credits-1');
                        $this->db->where('ID', $this->session->userdata('ID'));
                        $this->db->update('user_table', $data);
                    }
                    echo "success";

                } else {
                    //website did not install, remove from cpanel and redirect user to New Build page :(
                    echo "fail";
                }

            }

        }
    } */
     public function deploy_wordpress($is_demo)
    {
        //create dir to store user files
         $users_dir = $this->session->userdata['ID'] . "_" . uniqid();

      mkdir($users_dir);
      $this->session->set_userdata('users_dir', $users_dir);
        $query = $this->db->get_where('domains', array('user_id' => $this->session->userdata('ID'), 'status' => 'open'));
        $row = $query->row();

        if (isset($row)) {

            //get the main domain name only
            if($is_demo){
              $domain_only = ltrim(strstr($row->domain, '.'), '.');
            //get the subdomain
            $subdomain = explode('.', $row->domain)[0];
            }else{
                $domain_only = $row->domain;
            }

            $full_domain = $row->domain;
            $db_user = $row->wp_db_user;
            $db_pass = $row->wp_db_pass;
            $db_name = $row->wp_database;
            $title = $row->site_title;
            $categories = $row->categories;
            $node = $row->node;
            $site_kwd = $row->site_kwd;
            $username = $row->cpanel_user;
            $password = $row->cpanel_pass;
            $theme_color = $row->theme_color;
            $ads_option = $row->ads_option;
            $domain_id = 0;
            //return "domain_only: ".$domain_only." | subdomain: ".$subdomain." | full_domain: ".$full_domain." | db_user: ".$db_user." | db_pass: ".$db_pass." | username: ".$username." | password: ".$password ;


            //generate WP Password

            $keep_trying_wp = true;

            do {

                $wp_password = generateStrongPassword(12, false, 'luds');

                $count = preg_match_all('/[\'^£$%&*()}{~><>,|=_+¬-]/', $wp_password);

                if ($count < 3) {

                    $keep_trying_wp = false;

                }

            } while ($keep_trying_wp == true);

            //upload wp setup file to domain

            $string_to_replace = "#CREDENTIALS#";

            $replace_with = "\$db_name = '" . $db_name . "';

    \$db_user = '" . $db_user . "';

    \$db_pass = '" . $db_pass . "';

    \$domain  = '" . $full_domain . "';

    \$title  = '" . $title . "';

    \$categories  = '" . $categories . "';

    \$node  = '" . $node . "';

    \$wp_password  = '" . $wp_password . "';

    \$site_kwd  = '" . $site_kwd . "';";

            $file_name = "setup_wp_" . $this->session->userdata['ID'] . "_" . uniqid();

            copy('http://phasebuilder.com/membershipkc/temp/setup_wp.txt', $users_dir."/".$file_name . ".txt");
            replace_string_in_file($users_dir."/".$file_name . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name . ".php");


            // set up basic connection

            $config['hostname'] = "ftp." . $domain_only;
            $config['username'] = $username . "@" . $domain_only;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
           // echo "FTP setup: ".var_dump($config);
            sleep(5);
            if ($this->ftp->connect($config)) {
            //check if demo site or regular install and set path accordingly
            $path = ($is_demo) ? "/public_html/demo/".$subdomain."/" : "/public_html/";

               // $this->ftp->upload($file_name . ".php", '/public_html/demo/'.$subdomain.'/setup_wp.php', 'ascii', 0775);
               $this->ftp->upload($users_dir."/".$file_name . ".php", $path.'setup_wp.php', 'ascii', 0775);

                // check if a file exist

                $setup_exists = false;

                //   $path = "/public_html/"; //the path where the file is located

                $file = "setup_wp.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use
                $contents_on_server = $this->ftp->list_files($path); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $setup_exists = true;

                } else {

                   // var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();



            } else {
                echo "FTP error".var_dump($config);
               // var_dump('shit connection didnt work');

                $setup_exists = false;
            }

            if ($setup_exists == true) {

                //execute wordpress setup on remote domain

                $keep_trying_setup = true;

                do {

                    $query = "http://" . $full_domain . "/setup_wp.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);

                    curl_close($curl);

                    //check if setup was executed
                    if ($this->ftp->connect($config)) {

                        // check if a file exist

                        $file = "xmlrpc.php"; //the file you are looking for

                        $check_file_exist = $file; //combine string for easy use

                        $contents_on_server = $this->ftp->list_files($path); //Returns an array of filenames from the specified directory on success or FALSE on error.


                        // Test if file is in the ftp_nlist array

                        if (in_array($check_file_exist, $contents_on_server)) {

                            $keep_trying_setup = false;

                        }

                        // close the connection

                        $this->ftp->close();

                    } else {
                        $keep_trying_setup = false;
                    }

                } while ($keep_trying_setup == true);

                sleep(10);
                //check if website was created successfully

                $url = 'http://' . $full_domain . '/wp-login.php';

                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $data = curl_exec($ch);
                curl_close($ch);

                if (strpos($data, "Log In") > 0) {

                    $website_verified = true;
                    $keep_trying_verify = false;

                } else {

                    $website_verified = false;

                }

                if ($website_verified == true) {
                    //website installed! Redirect user to Current Builds page
                    //store information into database
                    $data = array('status' => 'demo', 'wp_pass' => $wp_password, 'wp_user' => 'admin','creation_date' => strtotime('now'));
                    $this->db->where('domain', $full_domain);
                    $this->db->update('domains', $data);
                   //return domain
                   return $full_domain;

                } else {
                    //website did not install, remove from cpanel and redirect user to New Build page :(
                    echo "failed to deploy wordpress";
                }

            }

        }

    }
    public function update_azn_theme($full_domain,$is_demo){
        $users_dir = $this->session->userdata('users_dir');
     $query = $this->db->get_where('domains', array('user_id' => $this->session->userdata('ID'), 'domain' => $full_domain));
        $row = $query->row();
         if($is_demo){
                           $domain_only = ltrim(strstr($full_domain, '.'), '.');
            //get the subdomain
            $subdomain = explode('.', $full_domain)[0];

                        }else{
                                                                    $domain_only = $full_domain;
                                                                }
        if (isset($row)) {


            //get the main domain name only

            $username = $row->cpanel_user;
            $password = $row->cpanel_pass;
            $ads_option = $row->ads_option;
            $theme_color = $row->theme_color;
             $file_name = "write_theme_" . $this->session->userdata['ID'] . "_" . uniqid();
             $file_name_ads = "sidebar_ads_" . $this->session->userdata['ID'] . "_" . uniqid();
    copy('http://phasebuilder.com/membershipkc/temp/write_theme.txt', $users_dir."/".$file_name . ".txt");
    //update theme color
       $string_to_replace = "THEMECOLOR";
                        $replace_with = $theme_color;
                          replace_string_in_file($users_dir."/".$file_name . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name . ".php");
                           $file_name_asg_publisher = "post";
              copy('http://phasebuilder.com/membershipkc/temp/asg_publisher.txt', $users_dir."/".$file_name_asg_publisher . ".txt");
             switch($ads_option){
             case "no":
                   $ads = '';
                   $string_to_replace = "#TOPADCODE#";
                                                $replace_with = $ads;
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".txt");
//replace bottom ads code
$string_to_replace = "#BOTTOMADCODE#";
                                                $replace_with = $ads;
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".php");
                                                    //put regular sidebar
copy('http://phasebuilder.com/membershipkc/temp/sidebar.txt', $users_dir."/".$file_name_ads . ".php");
             break;
              case "both":
                 $ads_code_leader = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->publisher_id_leader;
    if(empty($ads_code_leader)){
        $ads_code_leader = '';
    }
    $string_to_replace = "#TOPADCODE#";
                                                $replace_with = html_entity_decode($ads_code_leader);
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".txt");
$ads_azon = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->ads_code;
    if(empty($ads_azon)){

        $ads_azon = '';
    }
//replace bottom ads code
$string_to_replace = "#BOTTOMADCODE#";
                                                $replace_with = html_entity_decode($ads_azon);
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".php");
//add wide skyscraper ads to sidebar
$string_to_replace = "#CREDENTIALS#";
 $ads_code_sky = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->publisher_id_sky;
   if(empty($ads_code_sky)){

        $ads_code_sky = '';
    }
      $replace_with = html_entity_decode($ads_code_sky);
      copy('http://phasebuilder.com/membershipkc/temp/sidebar-ads.txt', $users_dir."/".$file_name_ads . ".txt");
            replace_string_in_file($users_dir."/".$file_name_ads . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_ads . ".php");
             break;
              case "google" :
                $ads_code_leader = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->publisher_id_leader;
    if(empty($ads_code_leader)){
        $ads_code_leader = '';
    }
    $string_to_replace = "#TOPADCODE#";
                                                $replace_with = html_entity_decode($ads_code_leader);
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".txt");
//add wide skyscraper ads to sidebar
$string_to_replace = "#CREDENTIALS#";
 $ads_code_sky = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->publisher_id_sky;
   if(empty($ads_code_sky)){

        $ads_code_sky = '';
    }
      $replace_with = html_entity_decode($ads_code_sky);
      copy('http://phasebuilder.com/membershipkc/temp/sidebar-ads.txt', $users_dir."/".$file_name_ads . ".txt");
            replace_string_in_file($users_dir."/".$file_name_ads . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_ads . ".php");
            //replace bottom ads code
$string_to_replace = "#BOTTOMADCODE#";
                                                $replace_with = '';
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".php");

              break;
              case "amazon":
              $ads = '';
                 $string_to_replace = "#TOPADCODE#";
                                                $replace_with = '';
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".txt");
$ads_azon = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->ads_code;
    if(empty($ads_azon)){

        $ads_azon = '';
    }
//replace bottom ads code
$string_to_replace = "#BOTTOMADCODE#";
                                                $replace_with = html_entity_decode($ads_azon);
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".php");
 //put regular sidebar
copy('http://phasebuilder.com/membershipkc/temp/sidebar.txt', $users_dir."/".$file_name_ads . ".php");
             break;
             default:
                     $ads = '';
                   $string_to_replace = "#TOPADCODE#";
                                                $replace_with = $ads;
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".txt");
//replace bottom ads code
$string_to_replace = "#BOTTOMADCODE#";
                                                $replace_with = $ads;
                                                    replace_string_in_file($users_dir."/".$file_name_asg_publisher . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg_publisher . ".php");
                                                    //put regular sidebar
copy('http://phasebuilder.com/membershipkc/temp/sidebar.txt', $users_dir."/".$file_name_ads . ".php");

             }
  $file_name_azon_style = "style";
              copy('http://phasebuilder.com/membershipkc/temp/style.txt', $users_dir."/".$file_name_azon_style . ".txt");
              $string_to_replace = "THEMECOLOR";
                        $replace_with = $theme_color;
                          replace_string_in_file($users_dir."/".$file_name_azon_style . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_azon_style . ".txt");

                        // copy('http://phasebuilder.com/membershipkc/temp/pb-icon-wp.png', $users_dir."/pb-icon-wp.png");

            // set up basic connection

            $config['hostname'] = "ftp." . $domain_only;
            $config['username'] = $username . "@" . $domain_only;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
            sleep(5);
            //check if demo site or regular install and set path accordingly
            $path = ($is_demo) ? "/public_html/demo/".$subdomain."/" : "/public_html/";
            if ($this->ftp->connect($config)) {
                $this->ftp->upload($users_dir."/".$file_name . ".php", $path.'write_theme.php', 'ascii', 0775);
                $this->ftp->upload($users_dir."/".$file_name_ads . ".php", $path.'wp-content/themes/azonity_bcbiz/sidebar.php', 'ascii', 0775);
                 $this->ftp->upload($users_dir."/".$file_name_azon_style . ".txt", $path.'wp-content/themes/azonity_bcbiz/style.css', 'ascii', 0775);
                 // $this->ftp->upload($users_dir."/pb-icon-wp.png", $path.'wp-content/themes/azonity_bcbiz/images/pb-icon-wp.png', 'ascii', 0775);
                   $this->ftp->upload($users_dir."/".$file_name_asg_publisher. ".php", $path.'wp-content/plugins/associate_goliath/template/'.$file_name_asg_publisher. ".php", 'ascii', 0775);
                $file_exists = false;

                //   $path = "/public_html/"; //the path where the file is located

                $file = "write_theme.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use

                $contents_on_server = $this->ftp->list_files($path); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $file_exists = true;

                } else {

                   // var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();


               if(file_exists($file_name_ads . ".txt")){
                   unlink($file_name_ads . ".txt");
               }

            } else {
               // var_dump('shit connection didnt work');

                $file_exists = false;
            }

            if ($file_exists == true) {

                //execute wordpress setup on remote domain

                $keep_trying_setup = true;


                     //run ads code
                    $query = "http://" . $full_domain . "/write_theme.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);

                    curl_close($curl);
                    return "success";

        }else{
            return "fail";
        }
    }
    }
    public function test_keys(){
       // echo "inside test keys";
        $this->db->select('*');
         $this->db->where('user_id',$this->session->userdata('ID'));
        $query = $this->db->get('user_credentials');
        $row = $query->row();
        //echo "query is: ".$query;
        if (isset($row)) {
        $affiliate_tag = $row->affiliate_tag;
    $access_key = $row->access_key;
    $secret_key = $row->secret_key;
   // echo " affiliate_tag: ".$affiliate_tag;
   // echo " access_key: ".$access_key;
   // echo " secret_key: ".$secret_key;
    $azon_url = call_azon_api('dog toys', $affiliate_tag, $secret_key, $access_key);
               $result = scrape_url_content($azon_url);
              // return $result;
               if (strpos($result, 'ASIN') == false){
                 $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">There is a problem with your Amazon API Keys.</span>');
                return $result;
               }else{
                   return 1;
               }
               }
    }
    public function update_asg($full_domain,$is_demo){
        $users_dir = $this->session->userdata('users_dir');
        //get the main domain name only
           if($is_demo){
                $domain_only = ltrim(strstr($full_domain, '.'), '.');
                //get the subdomain
                $subdomain = explode('.', $full_domain)[0];

                                }else{
                                  $domain_only = $full_domain;
                                }
                                $this->db->select('*');
                                 $this->db->where('user_id',$this->session->userdata('ID'));
                                $query = $this->db->get('user_credentials');
                                $row = $query->row();
                                 if (isset($row)) {
        $affiliate_tag = $row->affiliate_tag;
    $access_key = $row->access_key;
    $secret_key = $row->secret_key;
    }
         $query = $this->db->get('build_credentials');
        $row = $query->row();

        if (isset($row)) {

    $google_api = $row->google_api;
    $weekly = $row->max_product_week;
    $min_price = $row->price_range_min;
    $max_products = $row->max_products;
    $max_price = $row->price_range_max;
    }
    $this->db->select('*');
     $this->db->where('user_id',$this->session->userdata('ID'));
     $this->db->where('domain', $full_domain);
     $query = $this->db->get('domains');
     $row = $query->row();
     if (isset($row)) {
      $node = $row->node;
      $username = $row->cpanel_user;
      $password = $row->cpanel_pass;


     //replace file contents
     $string_to_replace = "#CREDENTIALS#";

            $replace_with = "\$affiliate_tag = '" . $affiliate_tag . "';

    \$access_key = '" . $access_key . "';

    \$secret_key = '" . $secret_key . "';

    \$google_api  = '" . $google_api . "';

    \$weekly  = '" . $weekly . "';

    \$min_price  = '" . $min_price . "';

    \$max_products  = '" . $max_products . "';

    \$max_price  = '" . $max_price . "';

    \$node  = '" . $node . "';";
           //copy update_asg
            $file_name = "update_asg_" . $this->session->userdata['ID'] . "_" . uniqid();
            copy('http://phasebuilder.com/membershipkc/temp/update_asg.txt', $users_dir."/".$file_name . ".txt");
            replace_string_in_file($users_dir."/".$file_name . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name . ".php");
            //copy add_products
             //replace file contents for add products
           // $replace_with = "\$weekly  = '" . $weekly . "';";
           // $file_name_products = "add_products_" . $this->session->userdata['ID'] . "_" . uniqid();
           // copy('http://phasebuilder.com/membershipkc/temp/add_products.txt', $file_name_products . ".txt");
           // replace_string_in_file($file_name_products . ".txt", $string_to_replace, $replace_with, $file_name_products . ".php");

            // set up basic connection

            $config['hostname'] = "ftp." . $domain_only;
            $config['username'] = $username . "@" . $domain_only;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
            sleep(5);
            //check if demo site or regular install and set path accordingly
            $path = ($is_demo) ? "/public_html/demo/".$subdomain."/" : "/public_html/";
            if ($this->ftp->connect($config)) {
                $this->ftp->upload($users_dir."/".$file_name . ".php", $path.'update_asg.php', 'ascii', 0775);
              //  $this->ftp->upload($file_name_products . ".php", $path.'add_products.php', 'ascii', 0775);
                // check if a file exist

                $file_exists = false;

                //   $path = "/public_html/"; //the path where the file is located

                $file = "update_asg.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use

                $contents_on_server = $this->ftp->list_files($path); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $file_exists = true;

                } else {

                   // var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();





            } else {
               // var_dump('shit connection didnt work');

                $file_exists = false;
            }

            if ($file_exists == true) {
              $query = "http://" . $full_domain . "/update_asg.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);
                    curl_close($curl);

                    return $result;
        }else{
             return "fail";
        }
       }else{
           return "fail";
       }
}


    public function add_pages($full_domain,$is_demo){
     $users_dir = $this->session->userdata('users_dir');
     //get the main domain name only
           if($is_demo){
                                $domain_only = ltrim(strstr($full_domain, '.'), '.');
                                //get the subdomain
                                $subdomain = explode('.', $full_domain)[0];

                                                                }else{
                                                                    $domain_only = $full_domain;
                                                                }
            //get weekly
            $query = $this->db->get('build_credentials');
        $row = $query->row();

        if (isset($row)) {
    $weekly = $row->max_product_week;
    }
    //get affiliate tag
    $afilliate_tag = $this->db->get_where('user_credentials', array('user_id' => $this->session->userdata('ID')))->row()->affiliate_tag;
    //get cpanel details
            $this->db->select('*');
     $this->db->where('user_id',$this->session->userdata('ID'));
     $this->db->where('domain', $full_domain);
     $query = $this->db->get('domains');
     $row = $query->row();
     if (isset($row)) {
      $node = $row->node;
      $username = $row->cpanel_user;
      $password = $row->cpanel_pass;
      $wp_password = $row->wp_pass;
      $categories = explode(",",$row->categories);
      $all_cats = $row->categories;
     // echo "all_cats: ".$all_cats
      $curCat = 0;
      //make a diretory to store all users files

      //for each category copy file from source location into folder to edit it before uploading to wordpress site
     $onetime_pages = '';
      $forcurls_pages = '';
      foreach($categories as $cat){
          ++$curCat;

         // echo $cat;
         // $file_name = "onetime_" . $curCat.$this->session->userdata['ID'] . "_" . uniqid();
         //  $file_name_curl = "forcurl_" . $curCat.$this->session->userdata['ID'] . "_" . uniqid();
           $file_name = 'onetime'.$curCat;
           $file_name_curl = 'forcurl'.$curCat;
         $onetime_pages .= 'onetime'.$curCat.'.php,';
         $forcurls_pages .= 'forcurl'.$curCat.'.php,';
         copy('http://phasebuilder.com/membershipkc/temp/onetime.txt', $users_dir."/".$file_name . ".txt");
          copy('http://phasebuilder.com/membershipkc/temp/forcurl.txt', $users_dir."/".$file_name_curl . ".txt");
             //replace placeholders with users information
              $string_to_replace = "#CREDENTIALS#";
      $replace_with = "\$weekly  = '" . $weekly . "';

    \$password  = '" . $wp_password . "';

    \$client_tag  = '" . $afilliate_tag . "';

    \$cat  = '" . trim($cat) . "';";
      //Generate unique file name so no overwrites happen between users
            replace_string_in_file($users_dir."/".$file_name . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name . ".txt");
            $string_to_replace = "#NUM#";

      //Generate unique file name so no overwrites happen between users
            replace_string_in_file($users_dir."/".$file_name . ".txt", $string_to_replace, $curCat, $users_dir."/".$file_name . ".php");
             $string_to_replace = "#FNUM#";

      //Generate unique file name so no overwrites happen between users
            replace_string_in_file($users_dir."/".$file_name_curl . ".txt", $string_to_replace, $curCat, $users_dir."/".$file_name_curl . ".txt");
             $string_to_replace = "#FPAGE#";

      //Generate unique file name so no overwrites happen between users
            replace_string_in_file($users_dir."/".$file_name_curl . ".txt", $string_to_replace, 'onetime'.$curCat, $users_dir."/".$file_name_curl . ".php");
      }




           // $file_name_ot = "create_pages_" . $this->session->userdata['ID'] . "_" . uniqid();

            // $file_name_count = "checkcount_" . $this->session->userdata['ID'] . "_" . uniqid();
              $file_name_ot = "create_pages";

             $file_name_count = "checkcount";
            //copy source file that creates the onetime page and sets the page template in wordpress
            copy('http://phasebuilder.com/membershipkc/temp/create_pages.txt', $users_dir."/".$file_name_ot . ".txt");
            $string_to_replace = "#ONETIMES#";
      $replace_with = "\$onetime_list  = '" . $onetime_pages . "';";
      replace_string_in_file($users_dir."/".$file_name_ot . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_ot . ".txt");
      $string_to_replace = "#FORCURLS#";
      $replace_with = "\$forcurl_list  = '" . $forcurls_pages . "';";
      replace_string_in_file($users_dir."/".$file_name_ot . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_ot . ".php");

            copy('http://phasebuilder.com/membershipkc/temp/checkcount.txt', $users_dir."/".$file_name_count . ".txt");
            //copy htaccess file for CORS enable
            $file_name_access = "htaccess.txt";
             copy('http://phasebuilder.com/membershipkc/temp/htaccess.txt', $users_dir."/".$file_name_access);
              $file_name_ini = "phpini.txt";
             copy('http://phasebuilder.com/membershipkc/temp/phpini.txt', $users_dir."/".$file_name_ini);
              $file_name_asg = "ProgressAjaxController";
              copy('http://phasebuilder.com/membershipkc/temp/asg.txt', $users_dir."/".$file_name_asg . ".txt");
             replace_string_in_file($users_dir."/".$file_name_asg . ".txt", $string_to_replace, $replace_with, $users_dir."/".$file_name_asg . ".php");

              $file_name_azon_func = "functions";
              copy('http://phasebuilder.com/membershipkc/temp/azon_func.txt', $users_dir."/".$file_name_azon_func . ".php");
              $file_name_asg_candy_button = "candyButton";
              copy('http://phasebuilder.com/membershipkc/temp/candyButton.txt', $users_dir."/".$file_name_asg_candy_button . ".phtml");
              $file_name_asg_candy = "candy";
              copy('http://phasebuilder.com/membershipkc/temp/candy.txt', $users_dir."/".$file_name_asg_candy . ".phtml");

            // set up basic connection

            $config['hostname'] = "ftp." . $domain_only;
            $config['username'] = $username . "@" . $domain_only;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
            sleep(5);
             //check if demo site or regular install and set path accordingly
            $path = ($is_demo) ? "/public_html/demo/".$subdomain."/" : "/public_html/";
            if ($this->ftp->connect($config)) {
               // $curOT = 0;
              //  $curF = 0;
                $files = scandir($users_dir);
foreach($files as $file) {
    if (strpos($file, 'onetime') !== false) {
     if (strpos($file, 'php') !== false) {
     // ++$curOT;
     //upload onetime page template.

        // $this->ftp->upload($users_dir."/".$file, $path.'wp-content/themes/azonity_bcbiz/onetime'.$curOT.'.php', 'ascii', 0775);
         $this->ftp->upload($users_dir."/".$file, $path.'wp-content/themes/azonity_bcbiz/'.$file, 'ascii', 0775);
         }
}elseif (strpos($file, 'forcurl') !== false) {
     if (strpos($file, 'php') !== false) {
    //  ++$curF;
     //upload onetime page template.

         //$this->ftp->upload($users_dir."/".$file, $path.'wp-content/themes/azonity_bcbiz/forcurl'.$curF.'.php', 'ascii', 0775);
          $this->ftp->upload($users_dir."/".$file, $path.'wp-content/themes/azonity_bcbiz/'.$file, 'ascii', 0775);
         }
}elseif (strpos($file, $file_name_ot) !== false) {
     if (strpos($file, 'php') !== false) {
         //upload onetime.php -> this file creates the wordpress page 'addproducts' and set the template for it to 'Add Products'
      // $this->ftp->upload($users_dir."/".$file_name_ot . ".php", $path.'create_pages.php', 'ascii', 0775);
      $this->ftp->upload($users_dir."/".$file_name_ot . ".php", $path.$file, 'ascii', 0775);
      }
}elseif (strpos($file, $file_name_count) !== false) {

       //upload checkcount.php -> this file gets the post count for use when adding products
        $this->ftp->upload($users_dir."/".$file_name_count . ".txt", $path.'checkcount.php', 'ascii', 0775);


}elseif (strpos($file, $file_name_access) !== false) {

       //upload checkcount.php -> this file gets the post count for use when adding products
       // $this->ftp->upload($users_dir."/".$file_name_count . ".txt", $path.'checkcount.php', 'ascii', 0775);
       $this->ftp->upload($users_dir."/".$file_name_access, $path.'.htaccess', 'ascii', 0775);

}elseif (strpos($file, $file_name_asg_candy_button) !== false) {

         //edits the buy now button size
       $this->ftp->upload($users_dir."/".$file, $path.'wp-content/plugins/associate_goliath/template/includes/'.$file, 'ascii', 0775);

}elseif (strpos($file, $file_name_asg_candy) !== false) {

        //edits the amazon image size
       $this->ftp->upload($users_dir."/".$file, $path.'wp-content/plugins/associate_goliath/template/includes/'.$file, 'ascii', 0775);

}elseif (strpos($file, $file_name_ini) !== false) {

       //upload checkcount.php -> this file gets the post count for use when adding products
       // $this->ftp->upload($users_dir."/".$file_name_count . ".txt", $path.'checkcount.php', 'ascii', 0775);
       $this->ftp->upload($users_dir."/".$file_name_ini, $path.'php.ini', 'ascii', 0775);

}elseif (strpos($file, $file_name_azon_func) !== false) {

       //upload checkcount.php -> this file gets the post count for use when adding products
       // $this->ftp->upload($users_dir."/".$file_name_count . ".txt", $path.'checkcount.php', 'ascii', 0775);
       $this->ftp->upload($users_dir."/".$file, $path.'wp-content/themes/azonity_bcbiz/'.$file, 'ascii', 0775);

}elseif (strpos($file, $file_name_asg) !== false) {
         if (strpos($file, 'php') !== false) {
       //upload checkcount.php -> this file gets the post count for use when adding products
       // $this->ftp->upload($users_dir."/".$file_name_count . ".txt", $path.'checkcount.php', 'ascii', 0775);
       $this->ftp->upload($users_dir."/".$file_name_asg. ".php", $path.'wp-content/plugins/associate_goliath/application/controllers/'.$file, 'ascii', 0775);
       }
}

}








                // check if a file exist

                $file_exists = false;

                //  check and make sure onetime is uploaded properly

                $file = "create_pages.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use

                $contents_on_server = $this->ftp->list_files($path); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $file_exists = true;

                } else {

                   // var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();


            } else {


                $file_exists = false;
            }
             //if onetime.php was found on new wordpress site, connect to it via cURL and run it to create the new onetime page
            if ($file_exists == true) {
              //add page addproducts
               $query = "http://" . $full_domain . "/create_pages.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);


                     curl_close($curl);
                     /*

                     */


                    return $result;
    }else{
        return "fail";
    }
    }else{
       return "fail";
    }
    }
    public function add_products($domain,$num){

    }
    public function update_category_stats($cat,$products_added,$domain){
        $this->db->select('max_products_category,max_products')->from('build_credentials');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
       $row = $query->row();
       $max_prods_cat = $row->max_products_category;
        $max_prods = $row->max_products;
       }
       if($this->session->userdata('account_status') == "Demo"){
         $max_prods_cat = 10;
       }
        $this->db->select('products_added');
       $this->db->where('domain',$domain);

        $this->db->where('category',$cat);
        $query = $this->db->get('categories');
        if ($query->num_rows() > 0) {
           // echo "CATEGORY ALREADY EXISTS: ".$cat;
       $row = $query->row();
            $current_products = $row->products_added;
        $total_products = $current_products + $products_added;
         if($total_products >= $max_prods_cat || $products_added < $max_prods){
              $percent = 100;
         }else{
              $percent = ($total_products / $max_prods_cat) * 100;
         }
          $this->db->set('status',$percent);
        $this->db->where('domain',$domain);
        $this->db->where('category',$cat);
        $this->db->update('categories');
        }else{

        if($products_added < $max_prods){
               $percent = 100;
        }else{
           $percent = ($products_added / $max_prods_cat) * 100;
        }

           $data = array(
        'status' => $percent,
        'products_added' => $products_added,
        'category' => $cat,
        'domain' => $domain,
);

 $this->db->insert('categories', $data);
        }
    }
    public function update_product_stats($domain){

        $this->db->select('categories')->from('domains');
       $this->db->where('domain',$domain);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
       $row = $query->row();
            $all_cats = explode(",",$row->categories);
            $total_cats = sizeof($all_cats);
            $total_percents = 0;
            foreach ($all_cats as $cat){
             $this->db->select('status');
             $this->db->where('domain',$domain);
             $this->db->where('category',$cat);
             $query = $this->db->get('categories');
              if ($query->num_rows() > 0) {
                   $row = $query->row();
                 $percent = $row->status;
              }else{
                   $percent = 0;
              }


             $total_percents = $total_percents + $percent;
            }
            $overall_percentage =  $total_percents / $total_cats;
           // echo " overall_percentage_rounded before round: ". $overall_percentage_rounded;
            $round = explode(".", $overall_percentage);
            $overall_percentage_rounded = $round[0];
            if($overall_percentage_rounded === 1){
                $overall_percentage_rounded = 100;
            }
          $this->db->set('products_progress',$overall_percentage_rounded);
        $this->db->where('domain',$domain);
        $this->db->update('domains');
        echo $overall_percentage_rounded;
        }else{

        }

    }

    public function clean_up(){
        deleteDir($this->session->userdata('users_dir'));
                     }

    public function get_build_credentials(){

	$this->db->select('*')->from('build_credentials') ;
		$query	=	$this->db->get()  ;

			$result	= $query->result_array() ;

			return $result ;

	}
    public function update_asg_status($domain){
      $query = "http://" . $domain . "/asg.txt";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);


                     curl_close($curl);
                     /*

                     */


                    return $result;
    }
}

?>


