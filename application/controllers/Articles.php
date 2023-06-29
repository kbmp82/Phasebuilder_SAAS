<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Articles extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        	$this->load->library('session');

        $this->load->helper('p_helper');
		$this->load->helper('url');
         if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
		$this->load->model('user/ArticleModel');
		$this->load->model('user/LoginModel');
  
	}

	public function index()
	{
	    
	        
	          
		if($this->session->userdata('ID') != ''){
			//$data['res'] = $this->LoginModel->check_mysubscription($this->session->userdata('ID'));


			  $data['domains']	= $this->ArticleModel->get_current_domains() ;
              $data['credits']	= $this->ArticleModel->get_article_credits() ;
              $data['cost']	= $this->ArticleModel->get_article_cost() ;
			$this->load->view('articles',$data);
		}else{
			$this->load->helper('url');
			redirect('login');
		}
	}

    function view_articles(){
        //watiing on support ticket from iwriter to see if there is a way to review an article without logging into the website... Answer: there is not.
          // $this->ArticleModel->update_article_status();
          // $result = $this->ArticleModel->get_projects();
        // echo (string) $result->keyword->review_url;
	      $data['articles']	= $this->ArticleModel->get_current_articles();
           $this->load->view('view_articles',$data);
	}
     function review_article(){
         //not set up yet need to edit this code
         if($this->input->get())
    {
        $id = $this->input->get('id');
        $d_id = $this->input->get('d_id');
        //$project_id = $this->input->get('project_id');
        //$article_id = $this->input->get('article_id');
        $data['review_article']	= $this->ArticleModel->get_review_article($id);
        //var_dump($data['review_article']);

        $data['review_article'][0]['article_body'] = breakLongText(strip_tags($data['review_article'][0]['article_body']), $length = 250, $maxLength = 300);

        $data['cur_domain'] = $this->ArticleModel->get_domain($d_id);
           $this->load->view('review_article',$data);
    }else{
         redirect('articles/view_articles');
    }

	}
    function approve_article(){ // dont use this function now - it is coded into update_article_status
         //not set up yet need to edit this code
         if($this->input->post())
    {
        $id = $this->input->get('id');
        //$project_id = $this->input->get('project_id');
        //$article_id = $this->input->get('article_id');
        //$xml_res	= $this->ArticleModel->approve_article($id);
        //var_dump($xml_res);
        // if($xml_res->status == "ok"){
             $xml_res	= $this->ArticleModel->download_article($id);
        // }
           redirect('articles/view_articles');
    }else{
         redirect('articles/view_articles');
    }

	}
      function post_article(){
         //not set up yet need to edit this code
         if($this->input->post())
    {
             $result	= $this->ArticleModel->post_article();
              if($result){

				$this->session->set_flashdata('articles_update_success', '<span style="float: left; width: 100%;" class="alert alert-success">Article posted successfully.</span>');
			}else{
				$this->session->set_flashdata('articles_update_success', '<span style="float: left; width: 100%;" class="alert alert-danger">Something went wrong.</span>');
			}
           redirect('articles/view_articles');
    }else{
         redirect('articles/view_articles');
    }

	}
	
}
