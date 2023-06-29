<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaction extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user/LoginModel');
		$this->load->model('user/SubscriptionModel');
        $this->load->helper('url'); 
         if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
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
		if($this->session->userdata('ID') != ''){
			$this->load->view('transaction');
		}else{
			$this->load->helper('url');
			redirect('login');
		}
	}
	
	
}
