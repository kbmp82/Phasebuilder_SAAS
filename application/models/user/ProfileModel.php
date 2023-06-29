<?php

class ProfileModel extends CI_Model{


	public $users_table;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->users_table = $this->config->item('users_table');
	}
	
	public function update_profile($user_id,$firstname,$lastname,$email,$new_pass){
	    if (!empty($new_pass)){
          $this->db->set('password',crypt($new_pass,'phaseb2018!~$F'));
	    }
		$this->db->set('firstname',$firstname);
		$this->db->set('lastname',$lastname);
        $this->db->set('email',$email);
		//$this->db->set('username',$username);
		//$this->db->set('address',$address);
		//$this->db->set('phone',$phone);
	   //	$this->db->set('location',$location);
		$this->db->where('ID',$user_id);
		if($this->db->update($this->users_table))
		{
			return '1';
		}
	}
}
?>