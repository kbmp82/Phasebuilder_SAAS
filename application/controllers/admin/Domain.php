<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Domain extends Admin_Controller {



    function __construct() {

        parent::__construct();

         	$this->load->library('session');
             if(empty($this->session->userdata['ID']))
         {
         redirect('login');
         }
        if ($this->session->userdata('role') != 'admin') {

            redirect('dashboard');

        }

        $this->load->library('javascript');

        $this->load->model('admin/DomainModel');

		$this->load->model('admin/RegisterModel');

    }



    public function index() {





        $this->load->view('admin/add_domain');

    }


   function manage_domain() {
       $data['domains'] = $this->DomainModel->get_alldomain() ;
       $data['users'] = $this->RegisterModel->get_user_list();
  $this->load->view('admin/manage_domain', $data);
}
    public function add_domain() {

				  $data['users'] = $this->RegisterModel->get_user_list();

        $this->load->view('admin/add_domain',$data);

		

    }

	

	function add_domain_action() {

	

			$data['domains'] = $this->DomainModel->get_alldomain() ;

	//check if file was uploaded
		  if(isset($_FILES['domain'])){
           if ($_FILES['domain']['error'] == UPLOAD_ERR_OK               //checks for errors
      && is_uploaded_file($_FILES['domain']['tmp_name'])) { //checks that file is uploaded
  $contents = file_get_contents($_FILES['domain']['tmp_name']);
}

          $updated	=	$this->DomainModel->add_domain($contents) ;


				if($updated){

	 $this->session->set_flashdata('register_success', '<p class="alert alert-success">Domain(s) added successfully. </p>');

				redirect('admin/domain/add_domain');

				}

				else{

		 $this->session->set_flashdata('register_success', '<p class="alert alert-danger">Domains already exists . </p>');

				redirect('admin/domain/add_domain');

				}

	}

		

	}

	

	function domain_list(){

			

			$data['domains'] = $this->DomainModel->get_alldomain() ;



		$this->load->view('admin/domain_list',$data) ;

		

	}



	

	 public function edit_domain() {

      

	  $domain = $this->input->get('domain', TRUE);



	  if($this->input->get('action')=='delete'){

		  

        $return =	  $this->DomainModel->edit_domain($domain,$this->input->get('action'));

				if($return){


				$this->session->set_flashdata('domain_deleted', '<p class="alert alert-success">Domain deleted successfully. </p>');



					redirect('admin/domain/manage_domain');



				}

	   }else if($this->input->get('action')=='unassign'){
           $return =	  $this->DomainModel->edit_domain($domain,$this->input->get('action'));

				if($return){



				$this->session->set_flashdata('domain_deleted', '<p class="alert alert-success">Domain unassigned successfully. </p>');



					redirect('admin/domain/manage_domain');



				}
       }else if($this->input->get('action')=='test'){
           $return =	  $this->DomainModel->edit_domain($domain,$this->input->get('action'));

				if($return >=200 && $return < 300){



				$this->session->set_flashdata('domain_deleted', '<p class="alert alert-success">Domain is live. </p>');



					redirect('admin/domain/manage_domain');



				}else{
                   $this->session->set_flashdata('domain_deleted', '<p class="alert alert-danger">Domain error, HTTP_CODE: '.$return.' </p>');



					redirect('admin/domain/manage_domain');
				}
       }else if($this->input->get('action')=='assign_ns'){
         $this->db->order_by('id', 'RANDOM');
        $this->db->where('type', 'production');
        $query = $this->db->get('servers');
        if ($query->num_rows() > 0) {
            $ns1 = $query->row()->nameserver_one;
            $ns2 = $query->row()->nameserver_two;
        }
       $res =  $this->DomainModel->set_godaddy_ns($domain,$ns1,$ns2);
        if($res == NULL){
                $this->db->where('domain',$domain);
                $this->db->set('status','inactive');
                $this->db->set('ns1',$ns1);
                $this->db->set('ns2',$ns2);
                $this->db->update('domain_manage');
                	$this->session->set_flashdata('domain_deleted', '<p class="alert alert-success">Domain actived. </p>');



					redirect('admin/domain/manage_godaddy');
            }

       }else{

       

			$id = $this->input->get('id', TRUE);

		$data['users'] = $this->RegisterModel->get_user_list();

        $data['domains'] = $this->DomainModel->get_alldomain();



			$this->load->view('admin/edit_domain', $data);

       

	   }

    }



	

	public function update_domain(){

		$assignedto = $this->input->post("assignedto");
        if($assignedto > 0){
        $held_time = date("Y-m-d\TH:i:s\Z",strtotime('+30 days'));
        if($this->input->post("status") == "Taken"){
            $status = 'taken';
        }else{
           $status = 'held';
        }

        }else{
          $held_time = 0;
        $status = $this->input->post("status");
        }

        $data = array(

            'id' => $this->input->post("domain_id"),

            'domain' => $this->input->post("domain"),

            'ns1' => $this->input->post("ns1"),

            'ns2' => $this->input->post("ns2"),

            'status' => $status,

            'assignedto' => $this->input->post("assignedto"),
            'held_time' => $held_time


        );

       $return =   $this->DomainModel->update_domain($data);

        if($return){



				$this->session->set_flashdata('domain_deleted', '<p class="alert alert-success">Domain updated successfully. </p>');



					redirect('admin/domain/manage_domain');



				}
        

    }


      public function manage_godaddy(){
           $data['godaddy_domains'] = $this->DomainModel->get_godaddy_list() ;
           $this->load->view('admin/manage_godaddy',$data) ;


	 }
		



    





}

