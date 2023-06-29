<?php

class CredentialModel extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_user_credentials($user_id){
		$this->db->where('user_id',$user_id);
		$query=$this->db->get('user_credentials');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	}

    public function add_credential( $affiliate_tag,$publisher_id_leader,$ads_code,$publisher_id_sky,$secret_key,$access_key){
		$this->db->insert('user_credentials', array('user_id'=> $this->session->userdata('ID'), 'affiliate_tag' => $affiliate_tag,'publisher_id_leader' => $publisher_id_leader,'ads_code' => $ads_code,'publisher_id_sky' => $publisher_id_sky,'secret_key' => $secret_key,'access_key' => $access_key));
		return $insert_id = $this->db->insert_id();
	}
	
	public function update_credentials($user_id,$affiliate_tag,$publisher_id_leader,$ads_code,$publisher_id_sky,$secret_key,$access_key){
		//$this->db->set('api_key',$api_key);
	   //$this->db->set('access_key',$access_key);
		$this->db->set('affiliate_tag',trim($affiliate_tag));
        $this->db->set('secret_key',trim($secret_key));
        $this->db->set('access_key',trim($access_key));
        $this->db->set('publisher_id_leader',str_replace("'","",htmlspecialchars($publisher_id_leader)));
        $this->db->set('publisher_id_sky',str_replace("'","",htmlspecialchars($publisher_id_sky)));
		$this->db->set('ads_code',str_replace("'","",htmlspecialchars($ads_code)));
		$this->db->where('user_id',$user_id);
		if($this->db->update('user_credentials'))
		{
			return '1';
		}
	}
}
?>