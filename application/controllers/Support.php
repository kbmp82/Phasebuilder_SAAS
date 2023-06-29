<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Support extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		   $this->load->helper('form');
        $this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user/Supportmodel');
		$this->load->model('admin/TicketsModel');
         if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
	}



	public function index()
	{   
			$this->load->view('support');
		
	
	}
	
	
	 function update_ticket(){
	     
	   $this->Supportmodel->update_ticket() ;
        
    }
    

	function submit_ticket(){
            
        unset($_POST['_wysihtml5_mode']) ;
                
	   $insert =   $this->Supportmodel->submit_ticket() ;
	            if($insert){
	               redirect('/support/view_tickets/?page=1', 'refresh');
	            }
	}
	
	
	function view_tickets(){
    
        $data['tickets']	=     $this->Supportmodel->get_tickets() ;
               
	       	$this->load->view('view_tickets',$data);
	}
	
	
	function ticket_details(){
	    
    	$data['ticket'] = $this->TicketsModel->get_ticketByid() ;
        $data['replies']  =    $this->TicketsModel->get_ticket_reply() ;
       
      $this->load->view('single_ticket',$data) ;
	    
	}
	
	 
	 function add_ticket_reply(){
	         $ticket_id = $this->input->get('id');
	      
	   $result =  $this->Supportmodel->add_ticket_reply() ;
	            if($result){
	        //       redirect('/support/ticket_details/?id='.$ticket_id, 'refresh');  
	               redirect("support/ticket_details/?id=$ticket_id#bottom") ;
	                                 

	            }
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
