<?php

class RegisterModel extends CI_Model{


	public $users_table;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->users_table = $this->config->item('users_table');
	}

	function login($email,$pass){
	
		$this->db->select('email','password');
		$this->db->from($this->users_table);
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		
		$query = $this->db->get();
		
		
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		}
		
	
	}
	
	function check_email($email){
		$this->db->where('email',$email);
		$query=$this->db->get($this->users_table);
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}
	

       function check_mysubscription($userid){
		$this->db->where('user_id',$userid);
		$query=$this->db->get('user_subscription');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}

function check_transaction($userid){
		$this->db->where('user_id',$userid);
		$query=$this->db->get('transactions');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}


	function add_user($data){
           
		$this->db->insert($this->users_table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

function insert_transaction($data){
		$this->db->insert('transactions', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
}

function insert_mysubscription($data){
		$this->db->insert('user_subscription', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
}
	
	function user_activate($key){
		$this->db->set('confirm','1');
		$this->db->where('randomnum',$key);
		if($this->db->update($this->users_table))
		{
			return '1';
		}
	}
	
	public function get_user($user_id)
	{
		$query = $this->db->get_where($this->users_table, array('ID' => $user_id));
		if($query->num_rows()) return $query->row();
		return false;
	}


}

?>
