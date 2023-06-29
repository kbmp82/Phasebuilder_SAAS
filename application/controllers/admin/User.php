<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

    function __construct() {
        parent::__construct();
        	$this->load->library('session');
             if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
        if ($this->session->userdata('role') != 'admin') {
            redirect('dashboard');
        }
        $this->load->library('javascript');
        $this->load->model('admin/RegisterModel');
        $this->load->model('user/SubscriptionModel');
     
    }

    public function index() {

        $this->load->view('admin/new_user');
    }

    public function get_user_list() {

       
        if($this->input->post('id')){
            $data['users'] = $this->RegisterModel->get_user_list($this->input->post('id'));
        }else{
            $data['users'] = $this->RegisterModel->get_user_list();
        }
        $this->load->view('admin/user_list', $data);
    }

    function add_user() {

        $date = date("Y-m-d");
        $rand = rand(1, 99999);
        $data = '';
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            //'address' => $this->input->post('address'),
            //'phone' => $this->input->post('phone'),
           // 'location' => $this->input->post('location'),
            'password' => $this->input->post('password'),
            'registerdate' => $date,
            'randomnum' => $rand,
        );


        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/user_list');
        } else {

            $email_exist = $this->RegisterModel->check_email($this->input->post('email'));

            if ($email_exist == '0') {

                $this->form_validation->set_rules('password', 'password', 'required|callback_UserPassword');

                if ($this->form_validation->run() == TRUE) {
                    $insert_id = $this->RegisterModel->add_user($data);
                    if (!empty($insert_id)) {
                        $this->session->set_flashdata('register_success', '<p class="alert alert-success">Registration successful. <a href="' . $this->config->base_url() . 'login">Click here for login</p></a>');
                        $this->load->view('new_user');
                    }

                    redirect('admin/user/get_user_list');
                } else {

                    $this->load->view('new_user');
                }
            } else {
                $this->session->set_flashdata('register_error', '<p class="alert alert-danger">Email already exist.</p>');
                $this->load->view('new_user');
            }
        }
    }

    public function edit_user() {
         $id = $this->input->get('id', TRUE);

        $data['subs']    =    $this->RegisterModel->get_subscriptionsByid() ;
        $trial =  $this->RegisterModel->get_trial_status($id);
        $data['never']    =    $this->RegisterModel->get_never_suspend($id) ;
        if(!empty($trial)){
            if($trial[0]['gateway'] == "trial"){
                $data['trial_days']['gateway'] = "trial";
                //$data['trial_days'] = get_days_between($trial[0]['end_date'],date("Y-m-d\TH:i:s\Z"));
                $data['trial_days']['days'] = get_days_between($trial[0]['end_date'],date("Y-m-d\TH:i:s\Z",strtotime("+1 days")));
            }else{
               $data['trial_days']['days'] = 0;
               $data['trial_days']['gateway'] = $trial[0]['gateway'];
            }
        }else{
               $data['trial_days']['days'] = 0;
                $data['trial_days']['gateway'] = "none";
            }
         $data['addons']    =    $this->RegisterModel->get_addonsByid() ;

        

        if ($this->input->get('action') == 'delete') {
            $this->RegisterModel->edit_user($id, $this->input->get('action'));
        } else {
            $id = $this->input->get('id', TRUE);

            $data['user_detail'] = $this->RegisterModel->edit_user($id, $this->input->get('action'));
          
            $this->load->view('admin/edit_user', $data);
        }
    }

    public function update_user() {
  $id=$this->input->post('id');
  if(isset($_POST['trial_mode'])){
     $this->RegisterModel->update_trial_days($id,$this->input->post('trial_days_left'));
  }else{
     $this->RegisterModel->update_trial_days($id,0);
  }
  if(isset($_POST['never_suspend'])){

     $this->db->set('never_suspend',1);
     $this->db->where('ID',$id);
     $this->db->update('user_table');
      unset($_POST['never_suspend']);
  }else{
    $this->db->set('never_suspend',0);
     $this->db->where('ID',$id);
     $this->db->update('user_table');
  }
      if($this->input->post('pass_changed') == "yes"){
          $password = crypt($this->input->post('passwordc'),'phaseb2018!~$F');
          $conf_password = crypt($this->input->post('confirmpassword'),'phaseb2018!~$F');
          if($password == $conf_password){
             $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'discount' => $this->input->post('discount'),
            //'address' => $this->input->post('address'),
            //'phone' => $this->input->post('phone'),
           // 'location' => $this->input->post('location'),
            'password' => $password,

            'allowed_domains' => $this->input->post('allowed_domains'),
        );
          }else{
             $this->session->set_flashdata('register_success', '<span style="float: left; width: 100%;" class="alert alert-danger">Passwords do not match.</span>');
             redirect('admin/user/edit_user/?action=edit&id='.$id);
          }
        }else{
          $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'discount' => $this->input->post('discount'),
            //'address' => $this->input->post('address'),
            //'phone' => $this->input->post('phone'),
           // 'location' => $this->input->post('location'),
            'allowed_domains' => $this->input->post('allowed_domains'),
        );
        }

         $this->RegisterModel->update_user($data,$id);
         if($this->input->post('account_status') == "suspended"){
           $this->db->select('suspended');
                     $this->db->from('user_subscription');
   $this->db->where('user_id',$id);
   $status_acct = $this->db->get()->row()->suspended;
   if($status_acct == 0){
 $this->SubscriptionModel->suspendAccount($id,'TOS');
     $data = array(
                            'status' => 'taken'
                            );
                            $this->db->where('user_id', $id);
                            $this->db->update('domains', $data);
   }
         }else{
              $this->db->select('suspended');
                     $this->db->from('user_subscription');
   $this->db->where('user_id',$id);
  $q = $this->db->get();
  if($q->num_rows() > 0){
    $status_acct = $q->row()->suspended;
   if($status_acct == 1){
 $this->SubscriptionModel->unsuspendAccount($id);
     $data = array(
                            'status' => 'taken'
                            );
                            $this->db->where('user_id', $id);
                            $this->db->update('domains', $data);
   }
   }
         }
         	$this->session->set_flashdata('register_success', '<span style="float: left; width: 100%;" class="alert alert-success">User updated.</span>');
             redirect('admin/user/edit_user/?action=edit&id='.$id);
    }
    function UserPassword() {
        $password = $this->input->post('password');
        $confirm_pass = $this->input->post('confirmpassword');
        if ($confirm_pass != $password) {
            $this->form_validation->set_message('UserPassword', '<p class="alert alert-danger">Your Password does not match.</p>');
            return false;
        } else {
            return true;
        }
    }

}
