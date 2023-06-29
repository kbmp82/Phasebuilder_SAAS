<?php

class ForgotModel extends CI_Model{
	
	public $users_table;
	
	public function __construct()
	{
		parent::__construct();
		$this->users_table = $this->config->item('users_table');
	}
	
	
	
	public function get_user_by_email($email)
	{
		$query = $this->db->get_where($this->users_table, array('email' => $email));
		
		if($query->num_rows()) return $query->row();
		return false;
	}
	
	public function reset($user_id, $pwd)
	{
		$this->db->where('ID', $user_id);
        $pwd = crypt($pwd,'phaseb2018!~$F');
		$this->db->update($this->users_table, array('password' => $pwd));
	}

}

?>
