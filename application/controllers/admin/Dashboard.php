<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
     $this->load->library('session');
      if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
     if($this->session->userdata('role') != 'admin'){
     		redirect('dashboard') ;	
     }
     
       $this->load->library('javascript');
        $this->load->model('user/SubscriptionModel');
         $this->load->model('admin/HomeModel');
  }

  public function index()
  {
      
      $data['total_revenue'] =   $this->HomeModel->total_revenue() ;
         $data['total_users'] =   $this->HomeModel->total_users() ;
        	 $data['active_subs'] =   $this->HomeModel->active_subs() ;
        	    $data['active_domain'] =   $this->HomeModel->active_domain() ;
                    $data['open_ticket'] =   $this->HomeModel->open_tickets() ;
                           $data['activeRevenue'] =   $this->HomeModel->c_revenue() ;
                             $data['article_info'] =   $this->HomeModel->iw_info() ;
                             $data['server_info'] =   $this->HomeModel->update_server_info() ;
                              $data['last_check'] = $this->db->get('servers','last_check')->row()->last_check;


 $this->load->view('admin/dashboard',$data);
  }

  public function update_server_stats(){
      $this->db->set('last_check',0);
      $this->db->update('servers') ;
    $this->HomeModel->update_server_info() ;
    $this->index();
  }
    public function dashboard_pie()
  {
  	 $data['activeUser'] =   $this->HomeModel->active_users() ;
         $data['activeSubs'] =   $this->HomeModel->active_subs() ;
  	        $data['activeDomains'] =   $this->HomeModel->active_domain() ;
  	         $data['activeTickets'] =   $this->HomeModel->open_tickets() ;
                  $data['activeRevenue'] =   $this->HomeModel->c_revenue() ;
         
//     echo "<pre>" ; 
//print_R($data['activeRevenue']) ;  
  
 	 $this->load->view('admin/dashboard_view',$data);
  }

  
}