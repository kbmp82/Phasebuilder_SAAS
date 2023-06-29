<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SupportTickets extends Admin_Controller {
    
    function __construct(){
        parent::__construct() ;
        	$this->load->library('session');  
         if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
        $this->load->library('javascript');
        $this->load->helper('date');
           $this->load->helper('url');
        $this->load->model('admin/TicketsModel');

    }
    
    
    
    function index(){
        
         $data['tickets'] =     $this->TicketsModel->get_tickets() ;
        $this->load->view('admin/tickets_list',$data) ;
    
        
    }
    
    function update_ticket(){
        
        $this->TicketsModel->update_ticket() ;
        
    }
    
    function ticket_view(){
      
    $data['ticket'] = $this->TicketsModel->get_ticketByid() ;
    $data['replies']  =    $this->TicketsModel->get_ticket_reply() ;
     $this->load->view('admin/single_ticket',$data) ;
        
    }
    function mark_tickets(){
        $ticket_id = $this->input->post('ticket_id');
        $this->TicketsModel->mark_tickets($ticket_id) ;
    }
    
    function add_ticket_reply(){
         $ticket_id  = $this->input->get('id') ;
            
            
      $last_insert = $this->TicketsModel->add_ticket_reply() ;
      
                    if($last_insert){
            
            redirect("admin/SupportTickets/ticket_view/?id=$ticket_id#bottom") ;          
                    }
                    
    }
    
    function change_Status(){
        
          $this->TicketsModel->UpdateStatus() ;
    }
    function create_notifications(){
      $this->load->view('admin/create_notification') ; 
    }
    function deleteticket(){
        
          $data['tickets'] =     $this->TicketsModel->get_tickets() ;
        $result    =    $this->TicketsModel->deleteTicket() ;
        
                if($result){
          	$this->session->set_flashdata('ticket_delete', '<span style="float: left; width: 100%;" class="alert alert-success">Deleted Successfully.</span>');
                    $success = 1 ;
                }
                else{
            $this->session->set_flashdata('ticket_delete', '<span style="float: left; width: 100%;" class="alert alert-success">Failed to delete.</span>');
                  $success = 0 ;
                }
                
            print $success ;
    }
    
    
    
    
    
    
    
    
}