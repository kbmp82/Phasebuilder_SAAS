<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends Admin_Controller {

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
        $this->load->model('user/SubscriptionModel');
    }

    public function index() {


        $this->load->view('admin/dashboard_view');
    }

    public function add_subscription() {

        $this->load->view('admin/add_subscription');
    }

    public function get_subscription_list() {

       
        $data['subscriptions'] = $this->SubscriptionModel->get_all_subscriptions();
        //$this->load->view('subscription',$data);

        $this->load->view('admin/get_subscription', $data);
    }
    
     public function get_addons_list() {

       
        $data['subscriptions'] = $this->SubscriptionModel->get_all_add_ons();
        //$this->load->view('subscription',$data);

        $this->load->view('admin/get_subscription', $data);
    }
    

    public function edit_subscription() {
        $id = $this->input->get('id', TRUE);
       if($this->input->get('action')=='delete'){
           $this->SubscriptionModel->edit_subscription($id,$this->input->get('action'));
       }
       else{
        $id = $this->input->get('id', TRUE);

        $data['sub_detail'] = $this->SubscriptionModel->edit_subscription($id,$this->input->get('action'));

        $this->load->view('admin/edit_subscription', $data);
       }
    }
    

    public function update_subscription() {

        $data = array(
            'subscription_id' => $this->input->post("sub_id"),
            'title' => $this->input->post("title"),
            'subtitle' => $this->input->post("subtitle"),
            'duration' => $this->input->post("duration"),
            'pay_type' => $this->input->post("pay_type"),
            'sub_type' => $this->input->post("sub_type"),
             'domain_number' => $this->input->post("domain_number"),
            'billing_frequency' => $this->input->post("b_frequency"),
            'billing_cycles' => $this->input->post("b_cycles"),
            'currency' => $this->input->post("currency"),
            'price' => $this->input->post("price"),
            'shipping' => $this->input->post("shipping"),
            'tax' => $this->input->post("tax"),
            'image' => $this->input->post("profile_pic"),
            'description' => $this->input->post("desc")
        );
         $this->SubscriptionModel->update_subscription($data);
        
    }

}
