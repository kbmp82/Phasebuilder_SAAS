<?php

class CredentialModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->load->model('user/WebsiteModel');
    }
    public function get_error_log(){
     $filename = 'error_log.txt';
    if (file_exists($filename)) {
     $handle = fopen($filename, 'r');
$data = fread($handle,filesize($filename));
fclose($handle);
return $data;
} else {

}

    }
   
    public function get_build_credentials(){
        //$this->db->where('user_id',$user_id);
        $query=$this->db->get('build_credentials');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    public function get_paypal_settings(){
        //$this->db->where('user_id',$user_id);
        $query=$this->db->get('payment_settings');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    public function get_users(){
        $this->db->select('ID,firstname,lastname,username');
        $query=$this->db->get('user_table');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    public function get_domains($user_id){
        $this->db->select('domain,id');
        $this->db->where('assignedto',$user_id);
        $query=$this->db->get('domain_manage');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    public function get_domain_cats($user_id,$domain_mgmt_id){
        $this->db->select('categories');
        $this->db->where('user_id',$user_id);
        $this->db->where('domain_mgmt_id',$domain_mgmt_id);
        $query=$this->db->get('domains');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    public function add_admin_credential($arr){
        //this funciton needs fixed becuase the argument names do not match the form names...
        $this->db->insert('build_credentials', $arr);
        return $insert_id = $this->db->insert_id();
    }
    public function add_paypal_settings($arr){
        $this->db->insert('payment_settings', $arr);
        return $insert_id = $this->db->insert_id();
    }
    public function add_article_credits($user,$creds){
        $this->db->select('article_credits')->from('user_table');
         $this->db->where('ID', $user);
         $query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $current_creds = $row->article_credits;

        }else{
           $current_creds = 0;
        }
      $data = array('article_credits' => $current_creds + $creds);
      $this->db->where('ID', $user);
        $this->db->update('user_table', $data);
        return "success";
    }
    public function get_article_credits($user){
        $this->db->select('article_credits')->from('user_table');
         $this->db->where('ID', $user);
         $query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $current_creds = $row->article_credits;

        }else{

        }
        return $current_creds;
    }
    public function update_admin_credentials($access_key,$secret_key,$affiliate_tag,$google_api,$max_products,$max_categories,$max_product_week,$price_range_min,$price_range_max,$price_basic,$price_premium,$price_elite,$domain_credit,$hold_time,$proxy_crawl,$demo_domain,$demo_pass,$demo_user,$demo_expire,$max_products_category){
        $this->db->set('access_key',$access_key);
        $this->db->set('secret_key',$secret_key);
        $this->db->set('affiliate_tag',$affiliate_tag);
        $this->db->set('google_api',$google_api);
        $this->db->set('max_products',$max_products);
        $this->db->set('max_categories',$max_categories);
         $this->db->set('max_products_category',$max_products_category);
        $this->db->set('max_product_week',$max_product_week);
        $this->db->set('price_range_min',$price_range_min);
        $this->db->set('price_range_max',$price_range_max);
        $this->db->set('price_basic',$price_basic);
        $this->db->set('price_premium',$price_premium);
        $this->db->set('price_elite',$price_elite);
         $this->db->set('hold_time',$hold_time);
          $this->db->set('domain_credit',$domain_credit);
           $this->db->set('proxy_crawl',$proxy_crawl);
           $this->db->set('demo_domain',$demo_domain);
           $this->db->set('demo_cpanel_user',$demo_user);
           $this->db->set('demo_cpanel_pass',$demo_pass);
           $this->db->set('demo_expire',$demo_expire);
          //$this->db->update('build_credentials');
         // $this->db->set('price',$domain_credit);
          //$this->db->where('subscription_id', 4);

        if($this->db->update('build_credentials'))
        {
            return '1';
        }
    }
    public function update_paypal_settings($sandbox,$paypal_sig_live,$paypal_user_live,$paypal_pass_live,$paypal_sig_sand,$paypal_user_sand,$paypal_pass_sand){
        $this->db->set('sandbox',$sandbox);
        $this->db->set('paypal_sig_live',$paypal_sig_live);
        $this->db->set('paypal_user_live',$paypal_user_live);
        $this->db->set('paypal_pass_live',$paypal_pass_live);
        $this->db->set('paypal_sig_sand',$paypal_sig_sand);
        $this->db->set('paypal_user_sand',$paypal_user_sand);
        $this->db->set('paypal_pass_sand',$paypal_pass_sand);

        if($this->db->update('payment_settings'))
        {
            return '1';
        }
    }
    public function get_server_credentials($id=""){
        if($id != ""){
            $query = $this->db->get_where('servers',array('id' => $id));
      if($query->num_rows()>0)
        {
            return $query->result();
        }
        }else{
           $query = $this->db->get('servers');
      if($query->num_rows()>0)
        {
            return $query->result();
        }
        }

    }
    public function get_server_settings(){

     $query = $this->db->get('server_settings');
      if($query->num_rows()>0)
        {
            return $query->result();
        }


    }
    public function update_server_settings($arr){

     $query = $this->db->get('server_settings');
      if($query->num_rows()>0)
        {

        $this->db->update('server_settings', $arr);
        return "success";
        }else{
             $this->db->insert('server_settings', $arr);
        return $insert_id = $this->db->insert_id();
        }


    }
    public function add_new_server($arr){
         //$arr['type'] = 'production';
     $this->db->insert('servers', $arr);
        return $insert_id = $this->db->insert_id();
    }
	
	function save_stripe_payment(){
				
				$mode = preg_replace('/\s+/', '', $_POST['mode']);
				$stripe_username = preg_replace('/\s+/', '', $_POST['stripe_username']);
				$publishable_key_live = preg_replace('/\s+/', '', $_POST['publishable_key_live']);
				$secret_key_live = preg_replace('/\s+/', '', $_POST['secret_key_live']);
				$publishable_key_sandbox = preg_replace('/\s+/', '', $_POST['publishable_key_sandbox']);
				$secret_key_sandbox = preg_replace('/\s+/', '', $_POST['secret_key_sandbox']);

			$data = array(
						'id'	=>	1 ,	
						'mode' =>	$mode ,
						'stripe_username' =>	$stripe_username ,
						'publishable_key_live' =>	$publishable_key_live ,
						'secret_key_live' =>	$secret_key_live,
						'publishable_key_sandbox' =>	$publishable_key_sandbox,
						'secret_key_sandbox' =>	$secret_key_sandbox,
						);
			
			$query = $this->db->query('SELECT * FROM stripe_settings');
			
					
				if($query->num_rows() >= 1){
				
					 $this->db->where('id',1); 
					$result =	  $this->db->update('stripe_settings', $data);
			
				}else{
		
					$result	=	$this->db->insert('stripe_settings',$data) ;
				
				}
				
				 return   $result ;
				
	}
	
	function get_stripe_cred(){
		
		$this->db->select('*') ;
		$query	=	$this->db->get('stripe_settings') ;
		return $query->row() ;
	}
	
	
	function set_payment_status(){
				
		$active =	array('status'=> 1 );
		$inactive	=	array('status'=> 0 );
		
		$this->db->where('id','1');

				if($_POST['payment_status'] == 'stripe'){
			$res	=	$this->db->update('stripe_settings',$active);
					$this->db->update('payment_settings',$inactive);
				}
				if($_POST['payment_status'] == 'paypal'){
			$res	=			$this->db->update('payment_settings',$active);
					$this->db->update('stripe_settings',$inactive);
				}
                	if($_POST['payment_status'] == 'both'){
			$res	=	$this->db->update('stripe_settings',$active);
					$this->db->update('payment_settings',$active);
				}

		return $res	 ;			
				
		//   $this->db->update('stripe_settings') ;    
	}
	
	function get_active_payment(){
            $status = '';
		$query = $this->db->get_where('payment_settings',array('status'=>1));
			
			if($query->num_rows() > 0){
			   $status = 'paypal' ;
			}
			
		$query2 = $this->db->get_where('stripe_settings',array('status'=>1));
				
			if($query2->num_rows() > 0 && $status != ''){
			    $status = 'both' ;
			}else if($query2->num_rows() > 0){
               $status = 'stripe';
			}
			
			return 	$status ;

	}
    function remove_demo($domain){

             $this->db->select('*');
             $this->db->where('domain', $domain);
           $query =  $this->db->get('domains');
             foreach ($query->result() as $row)
{
             $cpanel_username = $row->cpanel_user;
              $db = $row->wp_database;
              $db_user = $row->wp_db_user;
              $server_id = $row->server;
            $subfolder = explode('.', $domain)[0];
             //get whm creds
             $whm['creds'] = $this->WebsiteModel->get_whm_by_id($server_id);

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


        $this->db->where('domain',$domain);
         $this->db->delete('domains');
         $this->db->where('domain',$domain);
         $this->db->delete('categories');
          $this->db->where('domain',$domain);
         $this->db->delete('categories_asg');
          }
        return true;

    }
    //removes demo accounts that are not in domain table
    function remove_demo_abandoned($server_id,$domain,$subdomain){
        echo " <br>inside remove_demo_abandoned ";
           $whm['creds'] = $this->WebsiteModel->get_whm_by_id($server_id);
         //delete subdomain
 $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=delsubdomain&domain=".$domain;

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
     var_dump($res);
    curl_close($curl);

    //unlink sub folder

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Fileman&cpanel_jsonapi_func=fileop&op=unlink&sourcefiles=%2Fpublic_html%2Fdemo%2F".$subdomain."&doubledecode=0";

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


        return true;
    }
    function get_subdomains($server_id){
       $whm['creds'] = $this->WebsiteModel->get_whm_by_id($server_id);
             //get list of subdomains on server

          $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=listsubdomains";
           //$query = "https://" . $whm['creds'][0]->ip . ":2087/execute/DomainInfo/list_domains ";
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
     return json_decode($res, true);
    }
	function get_databases($server_id){

       //get whm creds
             $whm['creds'] = $this->WebsiteModel->get_whm_by_id($server_id);
             //get list of subdomains on server


       //get databases on server
             $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=listdbs";

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
   /*
    echo " <pre>";
        print_r($res);
        echo "</pre>";
        */
   return json_decode($res, true);


 	}
    function remove_database($db,$db_user,$server_id){
      //get whm creds
             $whm['creds'] = $this->WebsiteModel->get_whm_by_id($server_id);
             //get list of subdomains on server


                      //delete DB

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedb&db=".$db;

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
    //echo "<br><br>remove DB is: ".var_dump($result);
           //delete DB User

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=phasebuilder&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedbuser&dbuser=".$db_user;

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
   // echo "<br><br>remove user is: ".var_dump($result);
    }
function get_godaddy_settings(){
        $query=$this->db->get('godaddy_settings');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
}
function update_godaddy_settings($arr){
     $query = $this->db->get('godaddy_settings');
      if($query->num_rows()>0)
        {

        $this->db->update('godaddy_settings', $arr);
        return "success";
        }else{
             $this->db->insert('godaddy_settings', $arr);
        return $insert_id = $this->db->insert_id();
        }
}
}
?>