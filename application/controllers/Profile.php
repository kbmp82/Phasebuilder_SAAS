<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user/LoginModel');
		$this->load->model('user/ProfileModel');
		$this->load->helper('url');
         if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
	}
	
	function index(){
		if($this->session->userdata('ID') == ''){
			redirect('login');
		}else{
			$data['user_data'] = $this->LoginModel->get_user($this->session->userdata('ID'));
			$this->load->view('profile',$data);
		}
	}
	
	function update(){

	     if (!empty($_POST['old_pass']) && !empty($_POST['verify_new_pass']) && !empty($_POST['new_pass'])){
	         $data['user_data'] = $this->LoginModel->get_user($this->session->userdata('ID'));
            foreach ($data as $item) {
    $current_pass = $item->password;

}
             if($current_pass == crypt($_POST['old_pass'],'phaseb2018!~$F')){
                 if($_POST['new_pass'] == $_POST['verify_new_pass']){
                         	$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $verify_new_pass = $_POST['verify_new_pass'];
        $email = $_POST['email'];
		$user_id = $this->session->userdata('ID');
		$res = $this->ProfileModel->update_profile($user_id,$firstname,$lastname,$email,$new_pass);
		if($res == 1){
			$this->session->set_flashdata('profile_update_success', '<span style="float: left; width: 100%;" class="alert alert-success">Your profile is updated.</span>');
			redirect('profile');
		}else{
			$this->session->set_flashdata('profile_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');
			redirect('profile');
		}
                 }else{
                   	$this->session->set_flashdata('profile_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Your passwords do not match.</span>');
			redirect('profile');
                 }

             }else{
                	$this->session->set_flashdata('profile_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Your current password is wrong.</span>');
			redirect('profile');
             }
         }else{
             	$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		//$address = $_POST['address'];
	   //	$phone = $_POST['phone'];
		//$location = $_POST['location'];
		$user_id = $this->session->userdata('ID');
         $new_pass = "";
		$res = $this->ProfileModel->update_profile($user_id,$firstname,$lastname,$email,$new_pass);
		if($res == 1){
			$this->session->set_flashdata('profile_update_success', '<span style="float: left; width: 100%;" class="alert alert-success">Your profile is updated.</span>');
			redirect('profile');
		}else{
			$this->session->set_flashdata('profile_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');
			redirect('profile');
		}
         }

		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/

	}
}
?>