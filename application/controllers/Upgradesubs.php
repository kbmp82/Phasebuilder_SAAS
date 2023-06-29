<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upgradesubs extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('user/UpgradeModel');
		$this->load->model('user/LoginModel');
		$this->load->model('user/SubscriptionModel');
	}

	public function index()
	{
		if($this->session->userdata('ID') != ''){
		$this->load->model('user/UpgradeModel');
		$this->load->model('user/LoginModel');
		$this->load->model('user/SubscriptionModel');
			$result = $this->LoginModel->check_mysubscription($this->session->userdata('ID'));
			if(!empty($result)){
				foreach($result as $ids){
					$id[] = $ids->subscription_id;
				}
				$unique_id = array_unique($id);
				$data['result'] = $unique_id;
			}
			$data['subscriptions'] = $this->SubscriptionModel->get_all_subscriptions();
			$data['subscriptions_addons'] = $this->SubscriptionModel->get_all_subscriptions_addons();
			$this->load->view('upgrade',$data);
		}else{
			$this->load->helper('url');
          
		   	redirect('login');
		}
	}
}

