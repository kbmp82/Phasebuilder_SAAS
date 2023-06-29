<?php

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Website extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->model('user/WebsiteModel');
        $this->load->model('user/ArticleModel');
		$this->load->model('admin/DomainModel');

		$this->load->helper('url');
        $this->load->library('ftp');
        $this->load->library('upload');
          if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
	}
	
	public function index()
	{   
		if($this->session->userdata('ID') != ''){
	
		$this->load->library('ftp');
		$this->load->library('upload');

         $data['build_creds'] =  $this->WebsiteModel->get_build_credentials() ;
         $data['user_creds'] =  $this->WebsiteModel->get_user_credentials() ;
		$data['domain'] = $this->WebsiteModel->get_Admin_domain() ;
        $data['domain_list'] = $this->WebsiteModel->get_domains() ;
        $data['site_mode'] = $this->WebsiteModel->get_site_mode() ;
        $data['user_domains'] = $this->DomainModel->get_alldomain_by_id($this->session->userdata('ID'));
		$this->load->view('categories',$data);
			
		}else{
			redirect('login');
		}
	}
	 public function reset_domain(){
       if($this->session->userdata('ID') != ''){
               $this->WebsiteModel->reset_domain($this->input->post('domain')) ;


		}else{
			redirect('login');
		}
	 }
	public function cats()
	{
		if($this->session->userdata('ID') != ''){
               echo $this->WebsiteModel->generate_categories() ;


		}else{
			redirect('login');
		}
	}
    public function verify_ns()
	{
		if($this->session->userdata('ID') != ''){
		    //echo $this->input->post('domain_ns');
              echo $this->WebsiteModel->verify_ns();


		}else{
			redirect('login');
		}
	}
    public function test_keys(){
     echo $this->WebsiteModel->test_keys();
    // echo $result;
    }
  	public function new_user()
	{

	    $this->load->library('ftp');
		if($this->session->userdata('ID') != ''){
		    //create dir to store user files
         $users_dir = $this->session->userdata['ID'] . "_tempdir";
          if (file_exists($users_dir)) {
              deleteDir($users_dir);
        $this->session->unset_userdata('users_dir');
}
      mkdir($users_dir);
      $this->session->set_userdata('users_dir', $users_dir);

		    //$key_test = $this->WebsiteModel->test_keys();
                   if($this->input->post('domainType') == "Demo"){

              $website_type = "demo";
               $this->db->where('user_id', $this->session->userdata('ID'));
           $this->db->where('status', 'demo');
		   $query = $this->db->get('domains');
           if($query->num_rows() > 0){
               $result = $this->WebsiteModel->delete_user_demo();
               if($result){
                  $result = $this->WebsiteModel->create_demo();
               }

           }else{

             $result =$this->WebsiteModel->create_demo();
              }

	    }else{
           // echo "website is not demo";
          //$this->db->where('user_id', $this->session->userdata('ID'));
          // $this->db->where('status !=', 'demo');
		  $website_type = "reg";
           $result = $this->WebsiteModel->create_cpanel();

	    }

             if($result != 1){
                 echo "result did not equal 1. Result is: ".var_dump($result);
                  if($this->input->post('domainType') == "Demo"){
                      $this->WebsiteModel->delete_user_demo();
                  }else{
                      $this->WebsiteModel->reset_domain_noreassign($this->input->post('domain')) ;
                  }
                      echo "restarting new user";
                      $this->new_user();
                           // echo "fail - reason: ".var_dump($result);
                    }else{
                        echo "cpanel and new user setup successful.";
                           if($website_type != "demo"){
                          $this->decrement_build_credits();
                          }
                            $output = ($website_type == "reg") ? $this->WebsiteModel->deploy_wordpress(false,$this->input->post('domain')) : $this->WebsiteModel->deploy_wordpress(true,$this->input->post('domain'));
                            if(strpos($output,"failed to deploy wordpress") == false){
                                 //update theme
                          $result = ($website_type == "reg") ? $this->WebsiteModel->update_azn_theme($this->input->post('domain'),false) : $this->WebsiteModel->update_azn_theme($this->input->post('domain'),true);
                            if($result != "fail"){
                               //update ASG credentials
                            $result = ($website_type == "reg") ? $this->WebsiteModel->update_asg($this->input->post('domain'),false) : $this->WebsiteModel->update_asg($this->input->post('domain'),true);

                             if($result != "fail"){
                                 //add products

                          $result = ($website_type == "reg") ? $this->WebsiteModel->add_pages($this->input->post('domain'),false) : $this->WebsiteModel->add_pages($this->input->post('domain'),true);
                         //post demo article if demo
                         if($website_type == "demo"){
                            $result = $this->ArticleModel->post_demo_article($this->input->post('domain'));
                           // echo $result;
                         }
                        // exit;
                            //free up held domain if user used their own or cherry picked
                           if($this->input->post('radioSelection') =="own") {
                              $this->WebsiteModel->removeHeldStatus();
                           }else if($this->input->post('radioSelection') =="cherry") {
                           $this->WebsiteModel->removeHeldStatus();
                           $this->WebsiteModel->decrement_domain_credits();
                           }
                           //clean up and remove copied files from server
                          $this->WebsiteModel->clean_up();
                     echo "wordpress success";
                         // echo 'demo-3tgfagt.phasebuilder.com';
                           }
                            }
                          }else{

                     echo $output;
                          }


                    }




			//$this->load->view('new_user');
		}else{
			redirect('login');
		}
	}
     /*	public function new_user()
	{

       echo $this->WebsiteModel->add_products('http://demo-3mtenjc.phasebuilder.com');

	}   */

   function add_products(){
       echo $this->WebsiteModel->add_products($this->input->post('domain'),$this->input->post('num'));
   }
   function update_asg_status(){
       echo $this->WebsiteModel->update_asg_status($this->input->post('domain'));
   }
    function update_products_stats(){
        $cat = $this->input->post('cat');
       // echo " POST cat is: ".$cat;
        $products_added = $this->input->post('added');
        $domain = $this->input->post('domain');
       $this->WebsiteModel->update_category_stats($cat,$products_added,$domain);
     echo  $this->WebsiteModel->update_product_stats($domain);
   }
   function finished_tour(){
       $this->db->set('completed_tour',1);
        $this->db->where('ID',$this->session->userdata('ID'));
        $this->db->update('user_table');
   }
   function finished_demo(){
       $this->db->set('built_demo',1);
        $this->db->where('ID',$this->session->userdata('ID'));
        $this->db->update('user_table');
   }
	function update_domain_status(){

		// $result	= $this->WebsiteModel->update_domain_status() ;

		// $data['domains'] = $this->WebsiteModel->get_Admin_domain() ;
				// if($data){
					// foreach($data['domains'] as  $domain){
						// print "<option>select domain</option>" ;
						// print "<option>$domain[domain]</option>" ;
					// }
				// }
 	}
     function decrement_build_credits(){


         if($this->session->userdata('ID') != ''){

          $this->db->where('ID',$this->session->userdata('ID'));
         $query=$this->db->get('user_table');
         if($query->num_rows()>0)
 {
     //currently set up to grab a single row as we think each user will nly have 1 subscription. If more are added will need to change the code to look for each subscription
  $row = $query->row();
  $allowedDomains =  $row->allowed_domains;
 // $articleCredits = $row->article_credits;

         $data = array(
                            'allowed_domains' => $allowedDomains - 1,
                            //'article_credits' => $domain_number + $articleCredits,
                            );
     $this->db->where('ID',$this->session->userdata('ID'));
     $this->db->update('user_table', $data);
     }
     }else{
       	$this->load->helper('url');
            redirect('login');
     }
    }
    function save_log(){
        if($this->session->userdata('ID') != ''){
         $this->db->where('ID',$this->session->userdata('ID'));
         $query=$this->db->get('user_table');
         if($query->num_rows()>0){
           $row = $query->row();
           $log = "\n\n\n\n USER ID: ".$this->session->userdata('ID');
           $log .= "\n\n Name: ".$row->firstname." ".$row->lastname;
           $log .= "\n\n Username: ".$row->username;
 }
    $log .= "\n\n\n\n".$this->input->post('entireLog');
    $filename = $this->session->userdata('ID').'_error_log.txt';
    if (file_exists($filename)) {
      $handle = fopen($filename, 'a');
fwrite($handle, $log);
fclose($handle);  
} else {
$handle = fopen($filename, 'w');
fwrite($handle, $log);
fclose($handle);
}
    }
    }
}


