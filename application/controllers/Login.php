<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->library('session');
		$this->load->model('user/LoginModel');
        //$this->load->helper('url');
        	$this->load->model('user/SubscriptionModel') ;
           // $this->load->model('user/HomeModel');
          	// Load PayPal library
        $config = $this->SubscriptionModel->get_paypal_credentials();
	   	$this->load->library('paypal/paypal_pro', $config);
	    
        
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

                $this->load->view('login');


		}else{
		    redirect('dashboard');
        //$this->SubscriptionModel->get_sub_status();
		 // $data['subscription']  =     $this->SubscriptionModel->get_SubscriptionByUser() ;
          // $data['total_domains'] =   $this->HomeModel->total_domains() ;
                   // $data['tickets'] =   $this->HomeModel->tickets() ;
                           //  $data['article_info'] =   $this->HomeModel->iw_info() ;

		   //	$this->load->view('dashboard',$data);
		}
	}

	  public function process(){
		    
		    
		 $email = $this->input->post('email');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('login');
                }
                else
                {
					
		  
						$this->form_validation->set_rules('password', 'Password', 'required|callback_verifyUser');
							if ($this->form_validation->run() == TRUE)
						{
							    $this->load->helper('url');
							    
					     
							 if($this->session->userdata('role') == 'admin'){
							 	 redirect('admin/dashboard') ;
							 }else{
							     $has_creds =  $this->LoginModel->get_user_creds();
                                // echo "has cred= ".$has_creds;
		                        $first_login = $this->db->get_where('user_table', array('ID' => $this->session->userdata('ID')))->row()->first_login;
  $this->session->set_userdata(array('first_login' => $first_login,'api_notice' => 0,'has_cred'=>$has_creds));
  if($first_login == 0){
      $this->db->set('first_login', 1);
      $this->db->where('ID', $this->session->userdata('ID'));
     $this->db->update('user_table');
  }

                               $this->SubscriptionModel->get_sub_status();
                               // $this->session->set_userdata(array());
			                    //$this->load->view('dashboard',$data);
                                //$this->session->set_userdata('last_page', current_url());
                                if($this->session->userdata('last_page') != ''){
                                   // echo "last page is: ".$this->session->userdata('last_page');
                                    redirect($this->session->userdata('last_page'));
                                }else{
                                  redirect('dashboard');
                                }

							 }

								
								
						}else{
							//$this->load->helper('url');
							$this->load->view('login');
						}
					
                }
		      
      }
	
	function dashboard(){
		if($this->session->userdata('ID') == ''){
			$this->load->helper('url');
			redirect('login');
		}else{
			$this->load->view('dashboard');
		}
	}

  function completeTour(){
      $this->session->set_userdata(array('first_login' => 1));
  }
	function verifyUser(){
	    $email = $this->input->post('email');
		$password = $this->input->post('password');
			if ($this->LoginModel->login($email,$password))
				{
					$user_details = $this->LoginModel->check_email($email);
				
				    $name = $user_details[0]->firstname." ".$user_details[0]->lastname;
				
					$newdata = array(
					   'ID'  => $user_details[0]->ID,
						'name'  => $name,
						'email'  => $email,
						'role' => $user_details[0]->role,
					   'logged_in' => TRUE
					);
					$this->session->set_userdata($newdata);
					return true;
				}
				else
				{
					$this->form_validation->set_message('verifyUser', 'Incorrect Email or Password. Please try again.');
						return false;
				}
	}
	
	function logout()
	{
		$user_data = $this->session->all_userdata();
			 
	    	$this->LoginModel->logout() ;
			
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
		$this->session->sess_destroy();
		$this->load->helper('url');
		redirect(base_url());
	}
	
	
	
}
