<?php

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credential extends CI_Controller {



    public function __construct(){

        parent::__construct();
        $this->load->library('session');
         if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }


        $this->load->helper('p_helper');

$this->load->library('ftp');

$this->load->library('upload');

        $this->load->model('admin/CredentialModel');

        $this->load->helper('url');

    }



    public function index()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['build_credentials'] = $this->CredentialModel->get_build_credentials();

            $this->load->view('admin/credential',$data);

        }else{

            redirect('login');

        }

    }

    public function servers(){

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['servers'] = $this->CredentialModel->get_server_credentials();

            $this->load->view('admin/servers',$data);

        }else{

            redirect('login');

        }

    }

    public function server_settings(){

       if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['server_settings'] = $this->CredentialModel->get_server_settings();

            $this->load->view('admin/server_settings',$data);

        }else{

            redirect('login');

        }

    }
       function fund_account(){
          $this->load->view('admin/fund_account');
       }
      public function update_server_settings(){

                    if(isset($_POST['clean_up'])){
                       $this->cleanup_servers();
                       unset($_POST['clean_up']);
                    }
                     if(isset($_POST['remove_demos'])){
                          $this->remove_all_demos() ;
                          unset($_POST['remove_demos']);
                         //$this->cleanup_servers();
                    }

                    $arr = $_POST;

                    if($this->CredentialModel->update_server_settings($arr)){

                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Server settings updated successfully.</span>');

                    }else{

                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                    }

                    redirect('admin/credential/server_settings') ;

    }

    public function add_server(){



        if($this->session->userdata('ID') != ''){

            if(isset($_POST['server_alias'])){



                 $arr = '';



           if (!empty($_FILES['ip_list']) && $_FILES['ip_list']['error'] == UPLOAD_ERR_OK               //checks for errors

      && is_uploaded_file($_FILES['ip_list']['tmp_name'])) { //checks that file is uploaded

  $contents = file_get_contents($_FILES['ip_list']['tmp_name']);



  $ip_list = str_replace("\n", ",", $contents);



}else{

            $ip_list = "none";

    }



$_POST['ip_list'] =  $ip_list;

                    $arr = $_POST;

               $res = $this->CredentialModel->add_new_server($arr);

                    if(!empty($res)){

                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Server added successfully.</span>');

                    }else{

                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                    }

                    redirect('admin/credential/add_server');

            }else{

               $this->load->view('admin/add_server');

            }



        }else{

            redirect('login');

        }

    }

    public function edit_server(){

       if(isset($_GET['action']) && $_GET['action'] == "edit"){

           $data['servers'] = $this->CredentialModel->get_server_credentials($_GET['id']);

             $this->load->view('admin/edit_server',$data);

    }else if(isset($_GET['action']) && $_GET['action'] == "delete"){



    }else{



          $arr = '';

           /*  $data['servers'] = $this->CredentialModel->get_server_credentials($_POST['id']);

             //var_dump($data['servers']);

           if ($_FILES['ip_list']['error'] == UPLOAD_ERR_OK               //checks for errors

      && is_uploaded_file($_FILES['ip_list']['tmp_name'])) { //checks that file is uploaded

  $contents = file_get_contents($_FILES['ip_list']['tmp_name']);

  if($data['servers'][0]->ip_list != 'none'){

        $ip_list = $data['servers'][0]->ip_list.','.preg_replace("'\r?\n'",",", $contents);

$ip_list=explode(",",$ip_list);

$ip_list = array_unique($ip_list);



$ip_list = array_filter($ip_list, 'myFilter');

$ip_list = implode(',',$ip_list );

  }else{

       $ip_list = preg_replace("'\r?\n'",",", $contents);

  }



}else{

            $ip_list = "none";

    }



$_POST['ip_list'] =  $ip_list; */

                     if(isset($_POST['server_status'])){
                   $_POST['server_status'] = 1;
  }else{
        $_POST['server_status']  = 0;
  }

                    $arr = $_POST;

                     $arr['type'] = 'production';

                    $this->db->where('id',$_POST['id']);

                    if($this->db->update('servers',$arr)){

                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Server updated successfully.</span>');

                    }else{

                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                    }

                    redirect('admin/credential/edit_server?action=edit&id='.$_POST['id']) ;

            }



    }



     public function goliath_settings()

    {

        if($this->session->userdata('ID') != ''){

            $arr = '';

            $user_data = $this->CredentialModel->get_build_credentials();

            if(!empty($user_data)){

                $res = $this->CredentialModel->update_admin_credentials($user_data[0]->access_key,$user_data[0]->secret_key,$user_data[0]->affiliate_tag,$user_data[0]->google_api,$_POST['max_products'],$_POST['max_categories'],$_POST['max_product_week'],$_POST['price_range_min'],$_POST['price_range_max'],$user_data[0]->price_basic,$user_data[0]->price_premium,$user_data[0]->price_elite,$user_data[0]->domain_credit,$user_data[0]->hold_time,$user_data[0]->proxy_crawl,$user_data[0]->demo_domain,$user_data[0]->demo_cpanel_pass,$user_data[0]->demo_cpanel_user,$user_data[0]->demo_expire,$_POST['max_products_category'],$user_data[0]->iwriter_api,$user_data[0]->iwriter_user);

                if(!empty($res)){

                    $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Goliath settings updated successfully.</span>');

                }else{

                    $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                }

                redirect('admin/credential/goliath');

            }else{

                      unset($_POST['_wysihtml5_mode']);



                    $_POST['access_key'] = "none";

                    $_POST['secret_key'] = "none";

                    $_POST['affiliate_tag'] = "none";

                    $_POST['google_api'] = "none";

                    $_POST['price_basic'] = 0;

                    $_POST['price_premium'] = 0;

                    $_POST['price_elite'] = 0;

                    $_POST['domain_credit'] = 0;

                    $_POST['domain_hold'] = 0;

                     $_POST['proxy_crawl'] = "none";
                     $_POST['iwriter_api'] ='none';
                     $_POST['iwriter_user'] = 'none';

                    $arr = $_POST;

                    $res = $this->CredentialModel->add_admin_credential($arr);

                    if(!empty($res)){

                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Goliath settings added successfully.</span>');

                    }else{

                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                    }

                    redirect('admin/credential/goliath');

                }

        }else{

            redirect('login');

        }

    }

    public function add()

    {

        if($this->session->userdata('ID') != ''){

            $arr = '';

            $user_data = $this->CredentialModel->get_build_credentials();

            if(!empty($user_data)){

                $res = $this->CredentialModel->update_admin_credentials($_POST['access_key'],$_POST['secret_key'],$_POST['affiliate_tag'],$_POST['google_api'],$user_data[0]->max_products,$user_data[0]->max_categories,$user_data[0]->max_product_week,$user_data[0]->price_range_min,$user_data[0]->price_range_max,$user_data[0]->price_basic,$user_data[0]->price_premium,$user_data[0]->price_elite,$_POST['domain_credit'],$_POST['domain_hold'],$_POST['proxy_crawl'],$_POST['demo_domain'],$_POST['demo_pass'],$_POST['demo_user'],$_POST['demo_expire'],$user_data[0]->max_products_category,$user_data[0]->iwriter_api,$user_data[0]->iwriter_user);

                if(!empty($res)){

                    $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials updated successfully.</span>');

                }else{

                    $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                }

                redirect('admin/credential');

            }else{

                      unset($_POST['_wysihtml5_mode']);

                    $_POST['max_products'] = 0;

                    $_POST['max_categories'] = 0;

                     $_POST['max_products_category'] = 0;

                    $_POST['max_product_week'] = 0;

                    $_POST['price_range_min'] = 0;

                    $_POST['price_range_max'] = 0;

                    $_POST['price_basic'] = 0;

                    $_POST['price_premium'] = 0;

                    $_POST['price_elite'] = 0;
                     $_POST['iwriter_api'] ='none';
                     $_POST['iwriter_user'] = 'none';
                      $_POST['proxy_crawl'] = "none";

                    $arr = $_POST;

                    $res = $this->CredentialModel->add_admin_credential($arr);

                    if(!empty($res)){

                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials added successfully.</span>');

                    }else{

                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                    }

                    redirect('admin/credential');

                }

        }else{

            redirect('login');

        }

    }

    public function add_payments_paypal()

        {

                if($this->session->userdata('ID') != ''){

                        $arr = '';

                        $user_data = $this->CredentialModel->get_paypal_settings();

                        if(!empty($user_data)){

                                $res = $this->CredentialModel->update_paypal_settings($_POST['sandbox'],$_POST['paypal_sig_live'],$_POST['paypal_user_live'],$_POST['paypal_pass_live'],$_POST['paypal_sig_sand'],$_POST['paypal_user_sand'],$_POST['paypal_pass_sand']); 

                                if(!empty($res)){

                                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Payment settings updated successfully.</span>');

                                }else{

                                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                                }

                                redirect('admin/credential/paypal_payment');

                        }else{



                                        $arr = $_POST;

                                        $res = $this->CredentialModel->add_paypal_settings($arr);

                                        if(!empty($res)){

                                                $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials added successfully.</span>');

                                        }else{

                                                $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                                        }

                                        redirect('admin/credential/paypal_payment');

                                }

                }else{

                        redirect('login');

                }

        }

    public function article_settings()

        {

                if($this->session->userdata('ID') != ''){

                        $arr = '';

                        $user_data = $this->CredentialModel->get_build_credentials();

                        if(!empty($user_data)){

                                $res = $this->CredentialModel->update_admin_credentials($user_data[0]->access_key,$user_data[0]->secret_key,$user_data[0]->affiliate_tag,$user_data[0]->google_api,$user_data[0]->max_products,$user_data[0]->max_categories,$user_data[0]->max_product_week,$user_data[0]->price_range_min,$user_data[0]->price_range_max,$_POST['price_basic'],$_POST['price_premium'],$_POST['price_elite'],$user_data[0]->domain_credit,$user_data[0]->hold_time,$user_data[0]->proxy_crawl,$user_data[0]->demo_domain,$user_data[0]->demo_cpanel_pass,$user_data[0]->demo_cpanel_user,$user_data[0]->demo_expire,$user_data[0]->max_products_category,$_POST['iwriter_api'], $_POST['iwriter_user']);

                                if(!empty($res)){

                                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials updated successfully.</span>');

                                }else{

                                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                                }

                                redirect('admin/credential/articles');

                        }else{

                                            unset($_POST['_wysihtml5_mode']);

                                        $_POST['max_products'] = 0;

                                        $_POST['max_categories'] = 0;

                                        $_POST['max_product_week'] = 0;

                                        $_POST['max_products_category'] = 0; 

                                        $_POST['price_range_min'] = 0;

                                        $_POST['price_range_max'] = 0;

                                        $_POST['access_key'] = "none";

                                        $_POST['secret_key'] = "none";

                                        $_POST['google_api'] = "none";

                                        $_POST['affiliate_tag'] = "none";

                                        $_POST['domain_credit'] = 0;

                                        $_POST['proxy_crawl'] = "none";

                    $_POST['domain_hold'] = 0;

                    $_POST['demo_cpanel_pass'] = "none";

                    $_POST['demo_cpanel_user'] = "none";

                    $_POST['demo_domain'] = "none";

                    $_POST['demo_expire'] = 0;

                                        $arr = $_POST;

                                        $res = $this->CredentialModel->add_admin_credential($arr);

                                        if(!empty($res)){

                                                $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials added successfully.</span>');

                                        }else{

                                                $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                                        }

                                        redirect('admin/credential/articles');

                                }

                }else{

                        redirect('login');

                }

        }

       public function articles()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['build_credentials'] = $this->CredentialModel->get_build_credentials();

             $data['users'] = $this->CredentialModel->get_users();

            $this->load->view('admin/articles',$data);

        }else{

            redirect('login');

        }

    }

    public function article_credits()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $res = $this->CredentialModel->add_article_credits($this->input->post('article_user'),$this->input->post('article_creds'));

                if(!empty($res)){

                    $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Article credits added successfully.</span>');

                }else{

                    $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                }

                redirect('admin/credential/articles');

        }else{

            redirect('login');

        }

    }

   public function goliath()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['build_credentials'] = $this->CredentialModel->get_build_credentials();

            $data['users'] = $this->CredentialModel->get_users();

            $this->load->view('admin/goliath',$data);

        }else{

            redirect('login');

        }

    }

    public function paypal_payment()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['paypal_credentials'] = $this->CredentialModel->get_paypal_settings();

            $this->load->view('admin/payments',$data);

        }else{

            redirect('login');

        }

    }

    /*

     public function goliath_add()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['users'] = $this->CredentialModel->get_users();



            $this->load->view('admin/goliath_add',$data);

        }else{

            redirect('login');

        }

    }

    */

     public function get_domain_cats()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $user_id = $this->input->post('user');

            $domain_mgmt_id = $this->input->post('domain_id');

           $data = $this->CredentialModel->get_domain_cats($user_id,$domain_mgmt_id);

            //var_dump($data);

            $result = $data[0]->categories;

            echo $result;

        }else{

            redirect('login');

        }

    }

    public function get_domains()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $user_id = $this->input->post('user');

          $data['domains'] = $this->CredentialModel->get_domains($user_id);

            //var_dump($data);

            echo json_encode($data['domains']);

        }else{

            redirect('login');

        }

    }

    public function get_article_credits()

        {

                if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

                        $user_id = $this->input->post('user');

                    $data['credits'] = $this->CredentialModel->get_article_credits($user_id);

                        //var_dump($data);

                        echo $data['credits'];

                }else{

                        redirect('login');

                }

        }

        

    function stripe_payment(){

		

		$data['stripe']		=	$this->CredentialModel->get_stripe_cred() ;

        $this->load->view('admin/stripe_payment',$data) ;        

        

    }   



	function save_stripe_payment(){

		$res =	$this->CredentialModel->save_stripe_payment() ;

	

		if(!empty($res)){

                       $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Payment settings updated successfully.</span>');

            }

			else{

                  $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

           }

			 

			redirect('admin/credential/stripe_payment') ;

		}

		

	function set_payment(){

	  $data['status']	=	$this->CredentialModel->get_active_payment() ;	

//	    $data['status'] = 'helllooo' ;

		  $this->load->view('admin/set_payment',$data) ;

	}	

	

	function set_payment_status(){

		

        $res	=	$this->CredentialModel->set_payment_status() ;

    	

	    if(!empty($res)){

                       $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Payment settings updated successfully.</span>');

            }

			else{

                  $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

           }

			 

			redirect('admin/credential/set_payment') ;

	    

	}

	//this funciton will remove all subdomains,databases,database users that are not inside the domains table.
    //cleans up all abandoned files on the servers
   function cleanup_servers(){
             $this->db->select('*')->where('type', 'demo');
        $query = $this->db->get('servers');
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row)
{
             $server_id = $row->id;
             $subdomain_list = $this->CredentialModel->get_subdomains($server_id);
              //var_dump($subdomain_list);
               foreach  ($subdomain_list['cpanelresult']['data'] as $key){
                 //  var_dump($key);
                 $this->db->select('*');
                 $this->db->where('domain',$key['domain']);
                $query = $this->db->get('domains');

                if ($query->num_rows() < 1) {
                  //  echo "<br>domain not found in table<br>";
                $this->CredentialModel->remove_demo_abandoned($server_id,$key['domain'],$key['subdomain']);
                }
                // echo "<br><br>domain is: ".$key['domain'];
                // echo "<br><br>".var_dump($key['userlist']);
             }
             $database_list = $this->CredentialModel->get_databases($server_id);
            // var_dump($database_list);

             foreach  ($database_list['cpanelresult']['data'] as $key){
                 if($key['userlist'][0]['db'] != "phasebui_membershipkc_new"){
//echo "<br>di is: ".                     $key['userlist'][0]['db'];
                 $this->db->select('*');
                 $this->db->where('wp_database',$key['userlist'][0]['db']);
               $query =  $this->db->get('domains');
                if ($query->num_rows() < 1) {
                   // echo "<br>db not in table";
                   $this->CredentialModel->remove_database($key['userlist'][0]['db'],$key['userlist'][0]['user'],$server_id);
                }else{

                }
                }
             }
}
        }


   }
   function remove_all_demos(){
       $this->db->select('*')->from('domains');
       $this->db->like('domain', 'demo-');
       $query = $this->db->get();

       foreach ($query->result() as $row)
{
        $domain = $row->domain;
        $this->CredentialModel->remove_demo($domain) ;
}
$this->cleanup_servers();
   }
   public function godaddy_settings()

    {

        if($this->session->userdata('ID') != ''){

$this->load->library('ftp');

$this->load->library('upload');

$this->load->helper('directory');

            $data['godaddy_settings'] = $this->CredentialModel->get_godaddy_settings();

            $this->load->view('admin/godaddy',$data);

        }else{

            redirect('login');

        }

    }
    public function update_godaddy_settings(){
         if(isset($_POST['automatically_import'])){
                      $_POST['automatically_import'] = 1;
                    }else{
                      $_POST['automatically_import'] = 0;
                    }
       $arr = $_POST;

                    if($this->CredentialModel->update_godaddy_settings($arr)){

                        $this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">GoDaddy settings updated successfully.</span>');

                    }else{

                        $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');

                    }

                    redirect('admin/credential/godaddy_settings') ;
    }
    public function error_log(){
      if($this->session->userdata('ID') != ''){

            $data['log'] = $this->CredentialModel->get_error_log();

            $this->load->view('admin/errorlog',$data);

        }else{

            redirect('login');

        }
    }
     public function delete_error_log(){
     $filename = 'error_log.txt';
    if (file_exists($filename)) {
    unlink($filename);
}
$this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Log deleted.</span>');
 redirect('admin/credential/error_log') ;
}
 }


