<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
   
     if($this->session->userdata('role') != 'admin'){
     		redirect('dashboard') ;	
     }
  }

  public function index()
  {
  	
  	
  	 $this->load->view('admin/dashboard_view');
  }

  
  public function add_subscription(){
  
 	$this->load->view('admin/add_subscription');
  }
  
}