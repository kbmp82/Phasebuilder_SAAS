<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

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
    }

    public function index() {


        $this->load->view('admin/setting');
    }

   

}
