<?php

class Forgot extends CI_Controller{

	function index(){
		$this->load->view('forgot');
	}
	
	
	function process(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_exists');		
		if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('forgot');
                }else{
                
            $to_email = $this->input->post('email');
			$this->load->model('user/ForgotModel');
			$user = $this->ForgotModel->get_user_by_email($to_email);
			$slug = md5($user->ID . $user->email . date('Ymd'));
			
			
		    $from_email = $this->config->item('from_email');
		    $from_name = $this->config->item('from_name');
			
			
			$this->email->from($from_email, $from_name); 
			$this->email->to($to_email); 
			$this->email->subject('Reset your Password');
			$this->email->message('To reset your password please click the link below and follow the instructions:
                        '.$this->config->base_url().'forgot/reset/'. $user->ID .'/'. $slug.'
			If you did not request to reset your password then please just ignore this email and no changes will occur.
			Note: This reset code will expire after '. date('j M Y') .'.');	
						
                  
		         //Send mail 
		         if($this->email->send()){ 
		         	 $this->session->set_flashdata("email_sent","Email sent successfully."); 
		         	 $this->load->view('forgot');		        
				 }else {
		         	$this->session->set_flashdata("email_sent_error","Error in sending Email."); 		         
		                  $this->load->view('forgot');
				 }
                }
	}
	
	public function email_exists($email)
	{
		$this->load->model('user/ForgotModel');
		 
		if($this->ForgotModel->get_user_by_email($email)){
			return true;
		} else {
			$this->form_validation->set_message('email_exists', 'We couldn\'t find that email address in our system.');
			return false;
		}
	}
	
	public function reset()
	{
		// Redirect to your logged in landing page here
		//if(logged_in()) redirect('auth/dash');
		
		$data["success"] = false;
		$user_id = $this->uri->segment(3);		
		if(!$user_id) show_error('Invalid reset code.');
		$hash = $this->uri->segment(4);

		if(!$hash) show_error('Invalid reset code.');
		
		$this->load->model('user/LoginModel');
		$this->load->model('user/ForgotModel');
		
		$user = $this->LoginModel->get_user($user_id);
		if(!$user) show_error('Invalid reset code.');
		$slug = md5($user->ID . $user->email . date('Ymd'));
		if($hash != $slug) show_error('Invalid reset code.');
		
		$this->config->item('password_min_length');
	
		$this->form_validation->set_rules('password', 'Password', 'required|min_length['. $this->config->item('password_min_length') .']');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
		
		if($this->form_validation->run()){
			
			$this->ForgotModel->reset($user->ID, $this->input->post('password'));
			$data['success'] = true;
			$this->session->set_flashdata("Password_Reset","Password resert successfully");
		}
		
		$this->load->view('reset', $data);
	}
	

}

?>
