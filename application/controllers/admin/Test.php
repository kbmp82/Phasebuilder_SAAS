<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Admin_Controller {

    function __construct() {
        parent::__construct();

       
    }
    
    
    function index(){
        
        $this->load->view('admin/test') ;
        
    }
    
    
    
    
}