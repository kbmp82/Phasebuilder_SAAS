<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user/LoginModel');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{   
		if($this->session->userdata('ID') == ''){
			$this->load->view('register');
		}else{
			$this->load->view('dashboard');
		}
	}
	
	function process(){
		
		$date = date("Y-m-d");
		$rand = rand(1111111111,9999999999);
		$data = '';
		$data = array(
			'firstname' => $this->input->post('firstname'),		
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			//'address' => $this->input->post('address'),
			//'phone' => $this->input->post('phone'),
			//'location' => $this->input->post('location'),
			'password' => $this->input->post('password'),		
			'registerdate' => $date,				
			'randomnum' => $rand,
				);
	
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		if ($this->form_validation->run() == FALSE)
			{
					$this->load->view('register');
			}
			else
			{
				$email_exist = $this->LoginModel->check_email($this->input->post('email'));
				if($email_exist == '0'){
					$this->form_validation->set_rules('password', 'password', 'required|callback_UserPassword');
					if ($this->form_validation->run() == TRUE)
					{
					    
					    
						$insert_id = $this->LoginModel->user_register($data);
						
						
						if(!empty($insert_id)){
						    //redirect('login');
						   	$this->session->set_flashdata('register_success', '<p class="alert alert-success">Registration successful! Please login below.</p></a>');
						    $this->load->view('login');
						}

						
					}else{
						$this->load->view('register');
					}
				}else{
					$this->session->set_flashdata('register_error', '<p class="alert alert-danger">Email already exist.</p>');
					$this->load->view('register');
				}
			}
	}
	
	
	function UserPassword(){
		$password = $this->input->post('password');
		$confirm_pass = $this->input->post('confirmpassword');
		if($confirm_pass != $password){
			$this->form_validation->set_message('UserPassword', '<p class="alert alert-danger">Your Password does not match.</p>');
			return false;
		}else{
			return true;
		}
	}

	
	
}
