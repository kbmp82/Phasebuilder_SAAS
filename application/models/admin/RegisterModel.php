<?php

class RegisterModel extends CI_Model {

    public $users_table;

    public function __construct() {
        parent::__construct();

        $this->users_table = $this->config->item('users_table');
    }

    function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->users_table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    function check_mysubscription($userid) {
        $this->db->where('user_id', $userid);
        $query = $this->db->get('user_subscription');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    function check_transaction($userid) {
        $this->db->where('user_id', $userid);
        $query = $this->db->get('transactions');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    function add_user($data) {
         $data['password'] = crypt($data['password'],'phaseb2018!~$F');
        $this->db->insert($this->users_table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_user_list($id="") {
        if($id!=""){
            $this->db->where('id', $id);
            $query = $this->db->get('user_table');
        }else{
        $query = $this->db->get('user_table');
        }
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

 public function edit_user($id, $action = "") {

        if ($action == "delete") {
            $this->db->where('id', $id);
            $this->db->delete('user_table');
            redirect('admin/user/get_user_list');
        } else {
            $query = $this->db->get_where('user_table', array('id' => $id));
            return $query->result_array();
        }
    }
     public function update_user($data,$id) {


        $this->db->where('ID', $id);
        $this->db->update('user_table', $data);
        //redirect('admin/user/get_user_list');
    }
    function insert_transaction($data) {
        $this->db->insert('transactions', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function insert_mysubscription($data) {
        $this->db->insert('user_subscription', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function user_activate($key) {
        $this->db->set('confirm', '1');
        $this->db->where('randomnum', $key);
        if ($this->db->update($this->users_table)) {
            return '1';
        }
    }

    public function get_user($user_id) {
        $query = $this->db->get_where($this->users_table, array('ID' => $user_id));
        if ($query->num_rows())
            return $query->row();
        return false;
    }
    function get_trial_status($id){

        $this->db->select('*');
        $this->db->where('user_id',$id);
        $query = $this->db->get('user_subscription');
        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }
     function get_never_suspend($id){

        $this->db->select('*');
        $this->db->where('ID',$id);
        $query = $this->db->get('user_table');
        if($query->num_rows() > 0){
            return $query->row()->never_suspend;
        }else{
            return 0;
        }
    }
    function update_trial_days($id,$days_left){
        if($days_left === 0){
          $this->db->select('*');
        $this->db->where('user_id',$id);
        $this->db->where('gateway','trial');
        $query = $this->db->get('user_subscription');
        if($query->num_rows() > 0){
          $this->db->where('user_id',$id);
           $this->db->where('gateway','trial'); 
           $this->db->delete('user_subscription');
        }
        }else{
            $end_date = date("Y-m-d\TH:i:s\Z",strtotime("+".$days_left." days"));
         $this->db->select('*');
        $this->db->where('user_id',$id);
        $query = $this->db->get('user_subscription');
        if($query->num_rows() > 0){

             $this->db->set('end_date',$end_date);
             $this->db->where('user_id',$id);
             $this->db->update('user_subscription');

        }else{
             $data = array(
            'start_date' => date("Y-m-d\TH:i:s\Z"),
            'end_date' => $end_date,
            'subscription_id' => 0,
            'amount' => 0,
            'payment_profile_id' => 0,
            'next_bill_date' => $end_date,
            'amt_billed' => 0,
            'status' => "active",
             'suspended' => 0,
            'suspended_end_date' => "none",
             'gateway' => "trial",
             'stripe_cust_id' => "none",
             'user_id' => $id,
        );
        $this->db->insert('user_subscription',$data);
        }

        }


    }
    function get_subscriptionsByid(){
        
         $userid  = $this->input->get('id') ;

	   
	    
	   $this->db->select('*')->from('user_subscription us')->join('subscriptions s','us.subscription_id = s.id') ;

    	$this->db->where('us.user_id', $userid);
    	$this->db->where('sub_type','main');



            $query = $this->db->get();

          return         $query->result_array() ;
		
		
    }    
    
      function get_addonsByid(){
        
         $userid  = $this->input->get('id') ;
	           
	   
	    
	   $this->db->select('*')->from('user_subscription us')->join('subscriptions s','us.subscription_id = s.id') ;
	   
    	$this->db->where('us.user_id', $userid);
    	$this->db->where('sub_type','addon');

    	
    	
            $query = $this->db->get();  
            
          return         $query->result_array() ;
		
		
    }   
    
}

?>
