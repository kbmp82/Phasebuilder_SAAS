<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
    	$this->load->library('session');
        if(empty($this->session->userdata['ID']))
    {
    redirect('login');
    }
		$this->load->model('user/LoginModel');
		$this->load->model('user/ProfileModel');
		$this->load->helper('url');
	}
	
	function index(){
		if($this->session->userdata('ID') == ''){
			redirect('login');
		}else{
			$data['user_data'] = $this->LoginModel->get_user($this->session->userdata('ID'));
	    	$this->load->view('admin/profile',$data);
		}
	}
	
	function update(){
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $verify_new_pass = $_POST['verify_new_pass'];
		//$username = $_POST['username'];
		//$address = $_POST['address'];
	   //	$phone = $_POST['phone'];
		//$location = $_POST['location'];
		$user_id = $this->session->userdata('ID');
		
		$res = $this->ProfileModel->update_profile($user_id,$firstname,$lastname);
		if($res == 1){
			$this->session->set_flashdata('profile_update_success', '<span style="float: left; width: 100%;" class="alert alert-success">Your profile is updated.</span>');
			redirect('admin/profile');
		}else{
			$this->session->set_flashdata('profile_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');
			redirect('admin/profile');
		}
	}
}
?>