<?php

class DomainModel extends CI_Model{


	public $domain_mgmt;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->domain_mgmt = $this->config->item('domain_manage');
	}

	function add_domain($data){
        $changes = FALSE;
       $domain_list = explode("\n",$data);

      foreach($domain_list as $cur_domain){
          if($cur_domain){


          $cur_domain_list = explode(",",$cur_domain);
          $this->db->select('*')->from('domain_manage');
          $this->db->where('domain',(trim($cur_domain_list[0])));
          $query = $this->db->get();
          if($query->num_rows() > 0){

          }else{
             $domain_data = array(
        'domain' => strtolower(trim($cur_domain_list[0])),
        'status' => 'inactive',
        'ns1' => strtolower($cur_domain_list[1]),
        'ns2' => strtolower($cur_domain_list[2]),
        'assignedto' => 0,
        'held_time' => 0,

);
$this->db->insert('domain_manage', $domain_data);

               // $insert_id = $this->db->insert_id();

          }
           }
            }
            return 1;


    }
	function get_alldomain_by_id($id){
	    $this->db->select('*');
         $this->db->where('assignedto',$id);
         $this->db->where('status !=','held');
         $query = $this->db->get('domain_manage');
         return $query->result_array();
	}
	function get_alldomain(){
			if($this->input->get('action')){
				
				
				$this->db->select('domain_manage.*,username,user_table.ID as user_id')->from('domain_manage')
				->join('user_table','domain_manage.assignedto	=	user_table.ID','left');
				$this->db->where('domain_manage.id',$this->input->get('id'));
				
				

		
			}
			else{
				
		$this->db->select('domain_manage.*,username,user_table.ID as user_id')->from('domain_manage')
				->join('user_table','domain_manage.assignedto	=	user_table.ID','left');
			
		}
			
			$query	=	$this->db->get()  ;
			
			$result	= $query->result_array() ;

			return $result ;		
			
	}
	
	
	  public function edit_domain($domain, $action = "") {
          //get nameserver of domain
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
        if ($action == "delete") {
           //delete domain from DB
            $this->db->where('domain', $domain);
            $this->db->delete('domain_manage');
            $this->db->where('domain', $domain);
            $this->db->delete('domains');
              $this->db->where('domain',$domain);
         $this->db->delete('categories');
          $this->db->where('domain',$domain);
         $this->db->delete('categories_asg');
           if($has_cpanel){
             $query = "https://".$ip.":2087/json-api/removeacct?api.version=1&user=".$cpanel_username;

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



    return "domain deleted";
        }else if($action == "unassign" ){

           $this->db->where('domain', $domain);
           $data = array(
'assignedto' => 0,
'status' => 'active',
'held_time' => 0
);

           $this->db->update('domain_manage', $data);

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
      $this->db->where('domain',$domain);
         $this->db->delete('categories');
          $this->db->where('domain',$domain);
         $this->db->delete('categories_asg');
          $this->db->where('domain', $domain);
            $this->db->delete('domains');

    }
       return "domain unassigned";
        }else if($action == "test" ){

         $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
         $ch=curl_init();
    curl_setopt ($ch, CURLOPT_URL,$domain );
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch,CURLOPT_VERBOSE,false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch,CURLOPT_SSLVERSION,3);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE);
    $page=curl_exec($ch);
    //echo curl_error($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

   /* if ( checkdnsrr($domain.'.', 'ANY') ) {
  return "DNS Record found";
 }
 else {
  return "NO DNS Record found";
 } */
    return $httpcode;

        }else {
            $query = $this->db->get_where('domain_manage', array('domain' => $domain));
            return $query->result_array();
        }
    }
	
	 public function update_domain($data) {
			
			
        $this->db->where('id', $data['id']);
        //$this->db->update('domain_manage', $data);
        return $this->db->update('domain_manage', $data);
	   //	redirect('admin/domain/manage_domain');
    }

  function get_godaddy_list(){
       $this->db->select('*')->from('domain_manage');
          $this->db->where('status','godaddy');
         $query = $this->db->get();
	     return $query->result_array();
  }
  function set_godaddy_ns($domain,$ns1,$ns2){
     $query=$this->db->get('godaddy_settings');
        if($query->num_rows()>0)
        {
            $row = $query->row();
            $gd_api = $row->godaddy_api;
            $gd_secret = $row->godaddy_secret;

    $url = "https://api.godaddy.com/v1/domains/".$domain."/records";

//    $data_string = '[{"data":"64.71.74.33","type":"A","ttl":600,"name":"@"},{"data":"@","type":"CNAME","ttl":600,"name":"www"},{"data":"'.$ns1.'","type":"NS","ttl":600,"name":"@"},{"data":"'.$ns2.'","type":"NS","ttl":600,"name":"@"}]';
$data_string = '[{"data":"'.$ns1.'","type":"NS","ttl":600,"name":"@"},{"data":"'.$ns2.'","type":"NS","ttl":600,"name":"@"}]';
    // set your key and secret
    $header = array(
        'Authorization: sso-key '.$gd_api.':'.$gd_secret
    );

    //open connection
    $ch = curl_init();
    $timeout=60;

    //set the url and other options for curl
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Values: GET, POST, PUT, DELETE, PATCH, UPDATE
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    //curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: sso-key '.$gd_api.':'.$gd_secret,
    'Content-Type: application/json',
    'Accept: application/json'
));
    //execute call and return response data.
    $result = curl_exec($ch);

    //close curl connection
    curl_close($ch);

    // decode the json response
    $dn = json_decode($result, true);
    return $dn;
  }
}
 }
?>
