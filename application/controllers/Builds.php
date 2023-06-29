<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Builds extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); 
        if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }


		$this->load->model('user/BuildModel');
		$this->load->model('user/LoginModel');

	}

	public function index()
	{   
	    
	        
	          
		if($this->session->userdata('ID') != ''){
			$data['res'] = $this->LoginModel->check_mysubscription($this->session->userdata('ID'));
			
			  $data['builds']	= $this->BuildModel->get_current_builds() ;
			  
			$this->load->view('builds',$data);
		}else{
			$this->load->helper('url');
			redirect('login');
		}
	}
	
	function view_builds(){
	    if($this->input->get('action') == "view"){
              $data['res']	= $this->BuildModel->get_build() ;
              $this->load->view('view_builds',$data);
	    }elseif($this->input->get('action') == "delete"){
             $data['res']	= $this->BuildModel->delete_build() ;
             redirect('builds');
	    }else{
           redirect('builds');
	    }



	}
	
	
}
