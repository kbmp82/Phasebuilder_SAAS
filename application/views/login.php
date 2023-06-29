<?php
// ECHO "DATA IS: ".$this->session->userdata('last_page');
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("common-login-register/header.php");
 $CI =& get_instance();

        $CI->load->library("user_agent");

?>

	<div class="limiter" >
		<div class="container-login100" style="display:inherit !important; background-color: #101421;">
		    <!-- Logo icon -->
                        <center><img src="<?php echo $this->config->base_url(); ?>main/images/pb-login.png" alt="phasebuilder" style="padding-top: 65px;"/></center>
			<center><div>


				<form class="login100-form validate-form" action="<?php echo $this->config->base_url(); ?>login/process" method="post" >
<div class="error_reported" style="width: 100%;">
							   <?php
							   	if(!empty(validation_errors())){
						     echo validation_errors();
							}else{

							if(!empty($this->session->flashdata('register_success'))){
								echo "<style>p.alert.alert-danger{display:none;}</style>";
						          echo $this->session->flashdata('register_success');
						         $_POST = array();

							}
								if(!empty($this->session->flashdata('register_error'))){
						                echo $this->session->flashdata('register_error');

							}


						}
							   ?>
					</div>
					<span class="login100-form-title p-b-34">
					  <?php   echo ($CI->agent->is_mobile())? '<font color="#ffffff">It Appears You Are Using A Mobile Device.<br>Phase Builder Must Be Accessed On A Desktop Computer</font> ': '<font color="#ffffff">Account Login</font>' ; ?>
					</span>
					<?php //if(! empty(@msg)){ echo $msg;} ?> 
				 <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user email">
					   <?php   echo ($CI->agent->is_mobile())? '<input id="username" class="input100" type="text" name="email" placeholder="Email" disabled>': '<input id="username" class="input100" type="text" name="email" placeholder="Email">' ; ?>

					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
					    <?php   echo ($CI->agent->is_mobile())? '<input class="input100" type="password" name="password" placeholder="Password" disabled>': '<input class="input100" type="password" name="password" placeholder="Password">' ; ?>

					</div>

					<div class="container-login100-form-btn">
						 <?php   echo ($CI->agent->is_mobile())? '<button class="login100-form-btn" disabled>Sign in</button>': '<button class="login100-form-btn">Sign in</button>' ; ?>
					</div>
                    	</form><br /><br />
					<div class="w-full text-center p-t-27 p-b-182">
						<span class="txt1">
							Forgot
						</span>

						<a href="<?php echo $this->config->base_url(); ?>forgot" class="txt2">
							 password?
						</a><br>
						<a href="http://phasebuilder.com#DEMO" class="txt3">
							Sign Up
						</a>
					</div>



				<!--<div class="login100-more" style="background-image: url('<?php echo $this->config->base_url(); ?>signin/images/bg-01.jpg');"></div> -->
			</div></center>
		</div>
	</div>

	<?php $this->load->view("common-login-register/footer.php");?>