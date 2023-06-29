<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('user/SubscriptionModel') ;
        $this->load->model('user/HomeModel');
         $this->load->library('javascript');
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
        //$data['total_revenue'] =   $this->HomeModel->total_revenue() ;
        // $data['total_users'] =   $this->HomeModel->total_users() ;
        	// $data['active_subs'] =   $this->HomeModel->active_subs() ;
        	    $data['total_domains'] =   $this->HomeModel->total_domains() ;
                    $data['tickets'] =   $this->HomeModel->tickets() ;
                             $data['article_info'] =   $this->HomeModel->iw_info() ;
                    $data['subscription']  =      $this->SubscriptionModel->get_SubscriptionByUser() ;   
                             $data['demo_sites']  =     $this->HomeModel->get_demos() ;
                             $data['check_key'] = $this->HomeModel->check_keys();
        if($this->session->userdata('ID') == ''){
            $this->load->helper('url');
            redirect('login');
        }else{
            $this->load->view('dashboard',$data);
        }
    }




}
