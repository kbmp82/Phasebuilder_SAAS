<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Credential extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
$this->load->library('ftp');
$this->load->library('upload');
		$this->load->model('user/LoginModel');
		$this->load->model('user/CredentialModel');
		$this->load->helper('url');
        $this->load->helper('p_helper');
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
$this->load->helper('directory');
			$data['user_credentials'] = $this->CredentialModel->get_user_credentials($this->session->userdata('ID'));

            $admin_key = $this->db->get('build_credentials')->row()->access_key;
            $data['using_admin'] = "no";
            if($data['user_credentials'] && $data['user_credentials'][0]->access_key == $admin_key){

             $data['user_credentials'][0]->access_key = 'Phase Builder Keys';
            $data['user_credentials'][0]->secret_key = 'Phase Builder Keys';
            $data['using_admin'] = "yes";
            }
           // $data['user_credentials'][0]->admin_key = $admin_key;
			$this->load->view('credential',$data);
		}else{
			redirect('login');
		}
	}
	function add_demo_creds(){
      if($this->session->userdata('ID') != ''){
		    if($_POST['access_key'] == "Phase Builder Keys"){
		        echo "it does";
              $_POST['access_key'] = $this->db->get('build_credentials')->row()->access_key;
              echo $this->db->get('build_credentials')->row()->access_key;
               $_POST['secret_key'] = $this->db->get('build_credentials')->row()->secret_key;

		    }else{
               $azon_url = call_azon_api('dog toys', $_POST['affiliate_tag'], $_POST['secret_key'], $_POST['access_key']);
               $result = scrape_url_content($azon_url);

              // echo get_string_between($result, '<message>', '</message>');
               if (strpos($result, 'ASIN') == false){
                 $_POST['access_key'] = $this->db->get('build_credentials')->row()->access_key;
               $_POST['secret_key'] = $this->db->get('build_credentials')->row()->secret_key;
               }

            }
             $this->db->select('*')->from('user_credentials');
             $this->db->where('user_id',$this->session->userdata('ID'));
             $query = $this->db->get();
             if($query->num_rows() > 0){
              $this->db->set('affiliate_tag',$_POST['affiliate_tag']);
              $this->db->set('access_key',$_POST['access_key']);
              $this->db->set('secret_key',$_POST['secret_key']);
              $this->db->where('user_id',$this->session->userdata('ID'));
              $this->db->update('user_credentials');
             }else{
                $this->db->insert('user_credentials', array('user_id'=> $this->session->userdata('ID'), 'affiliate_tag' => $_POST['affiliate_tag'],'publisher_id_leader' => '','ads_code' => '','publisher_id_sky' => '','secret_key' => $_POST['secret_key'],'access_key' => $_POST['access_key']));
             }
             $this->session->set_userdata(array('has_cred'=>1));
	}
    }
	public function add()
	{
	   // var_dump($_POST);
		if($this->session->userdata('ID') != ''){
		    if($this->input->post('use_backup_keys')){
              $_POST['access_key'] = $this->db->get('build_credentials')->row()->access_key;
               $_POST['secret_key'] = $this->db->get('build_credentials')->row()->secret_key;
               $this->session->set_userdata(array('api_notice' => 1));
		    }
            if($this->input->post('use_demo_check')){
             $_POST['affiliate_tag'] ='demo-20';
                      $_POST['publisher_id_leader'] = 'Adsense ads would be displayed here!';
                      $_POST['publisher_id_sky'] = 'Adsense ads would be displayed here!';
                      $_POST['ads_code'] = 'Amazon ads would be displayed here!';
		    }
		    if($_POST['affiliate_tag'] == '' || $_POST['access_key'] == '' || $_POST['secret_key'] == ''){
              	$this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please fill in required fields.</span>');
                redirect('credential');
		    }else{
               if(!$this->input->post('use_backup_keys')){
               $azon_url = call_azon_api('dog toys', $_POST['affiliate_tag'], $_POST['secret_key'], $_POST['access_key']);
               $result = scrape_url_content($azon_url);

              // echo get_string_between($result, '<message>', '</message>');
               if (strpos($result, 'ASIN') == false){
                   $xml = simplexml_load_string($result, null, LIBXML_NOCDATA);

                 $this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">There is a problem with your Amazon API Keys.<br><br> Amazon response: '.$xml->Error->Message.'.</span>');
                redirect('credential');
               }
               }


			$arr = '';
			$user_data = $this->CredentialModel->get_user_credentials($this->session->userdata('ID'));
			if(!empty($user_data)){
			   //	$res = $this->CredentialModel->update_credentials($this->session->userdata('ID'), $_POST['api_key'],$_POST['access_key'],$_POST['affiliate_tag'],$_POST['publisher_id'],$_POST['ads_code']);
               $res = $this->CredentialModel->update_credentials($this->session->userdata('ID'), $_POST['affiliate_tag'],$_POST['publisher_id_leader'],$_POST['ads_code'],$_POST['publisher_id_sky'],$_POST['secret_key'],$_POST['access_key']);


                if(!empty($res)){
					$this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials updated successfully.</span>');
				}else{
					$this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');
				}
				redirect('credential');
			}else{
			          unset($_POST['_wysihtml5_mode']);


                   /*  if($this->input->post('use_demo_check')){
                      $_POST['affiliate_tag'] ='demo-20';
                      $_POST['publisher_id_leader'] = 'Adsense ads would be displayed here!';
                      $_POST['publisher_id_sky'] = 'Adsense ads would be displayed here!';
                      $_POST['ads_code'] = 'Amazon ads would be displayed here!';
                      	$arr = $_POST;
                     }else{

                         	$arr = $_POST;
                     }

                      if($this->input->post('use_backup_keys')){
              $_POST['access_key'] = $this->db->get('build_credentials')->row()->access_key;
               $_POST['secret_key'] = $this->db->get('build_credentials')->row()->secret_key;
               $this->session->set_userdata(array('api_notice' => 1));
		    }  */

					$res = $this->CredentialModel->add_credential( $_POST['affiliate_tag'],$_POST['publisher_id_leader'],$_POST['ads_code'],$_POST['publisher_id_sky'],$_POST['secret_key'],$_POST['access_key']);
					if(!empty($res)){
						$this->session->set_flashdata('credential_success', '<span style="float: left; width: 100%;" class="alert alert-success">Credentials added successfully.</span>');
					}else{
						$this->session->set_flashdata('credential_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please try again.</span>');
					}
					redirect('credential');
				}
        }
        }else{
			redirect('login');
		}

	}

	
}

