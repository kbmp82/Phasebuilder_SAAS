<?php

class BuildModel extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function get_current_builds(){

	$this->db->select('*')->from('domains') ;
         $this->db->order_by("creation_date", "desc");
	    $this->db->where('user_id',$this->session->userdata('ID')) ;


		$query	=	$this->db->get()  ;

			$result	= $query->result_array() ;

			return $result ;

	}

 public function delete_build(){
 //if domain is built get cpanel user


           $this->db->select('*');
             $this->db->where('id', $this->input->get('d_id'));

           $query =  $this->db->get('domains');
          if($query->num_rows() > 0) {
              $row = $query->row();
             $cpanel_username = $row->cpanel_user;
             $domain = $row->domain;
              $has_cpanel = true;
              $credits_used = true;
          }else{
              //no cpanel user
            $has_cpanel = false;
            $credits_used = false;
          }
          $this->db->select('*');
             $this->db->where('domain', $domain);
            // $this->db->where('status !=', 'active');
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
            $this->db->where('domain', $domain);
            $this->db->delete('domains');
         $this->db->where('domain',$domain);
         $this->db->delete('categories');
          $this->db->where('domain',$domain);
         $this->db->delete('categories_asg');

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
    //increment build credits so they can rebuild domain
    if($credits_used){
    $this->db->where('ID',$this->session->userdata('ID'));
         $query=$this->db->get('user_table');
         if($query->num_rows()>0)
 {
     //currently set up to grab a single row as we think each user will nly have 1 subscription. If more are added will need to change the code to look for each subscription
  $row = $query->row();
  $allowedDomains =  $row->allowed_domains;
 // $articleCredits = $row->article_credits;

         $data = array(
                            'allowed_domains' => $allowedDomains + 1,
                            //'article_credits' => $domain_number + $articleCredits,
                            );
     $this->db->where('ID',$this->session->userdata('ID'));
     $this->db->update('user_table', $data);
      }
      }
      //reset any domains that are currently held for the user before resetting status of this
        $this->db->set('status','active');
        $this->db->set('held_time',0);
        $this->db->set('assignedto',0);
     $this->db->where('status','held');
     $this->db->where('assignedto',$this->session->userdata('ID'));
      $this->db->update('domain_manage');
      //set this domain held time to 30 days so they can rebuild it
 $held_time = date("Y-m-d\TH:i:s\Z",strtotime("+30 days"));
 // $held_time = strtotime("+30 days");
     $this->db->set('held_time',$held_time);
     $this->db->set('status','held');
      $this->db->set('assignedto',$this->session->userdata('ID'));
     $this->db->where('domain',$domain);
      $this->db->update('domain_manage');

      return 1;
 }
public function get_build(){
		
	$this->db->select('*')->from('domains') ;

	    $this->db->where('id',$this->input->get('d_id')) ;


		$query	=	$this->db->get()  ;
			
			$result	= $query->result_array() ;

			return $result ;	
			
	}
	
}
?>