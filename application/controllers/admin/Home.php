<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

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
        $this->load->model('user/SubscriptionModel');
         $this->load->model('admin/HomeModel');
        
    }

    public function index() {
        
        $data['activeUser'] =   $this->HomeModel->active_users() ;
         $data['activeSubs'] =   $this->HomeModel->active_subs() ;
         
        
         
         $this->load->view('admin/home',$data);
    }
   
   

}
