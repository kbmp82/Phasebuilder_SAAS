<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("common-login-register/header.php");?>
	
	<div class="limiter">
		<div class="container-login100" style="display: initial !important;">
			<div class="wrap-login100">
				
				<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>register/process" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
					<span class="login100-form-title p-b-34">
						Welcome to join us
					</span>
			
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%; border:0px solid !important;" >
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
						<?php 					
                        
							?>
					</div>

					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user firstname">
						<input value="<?php if(!empty($_POST['firstname'])){ echo $_POST['firstname']; } ?>" id="firstname" class="input100" type="text" name="firstname" placeholder="First Name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user lastname">
						<input value="<?php if(!empty($_POST['lastname'])){ echo $_POST['lastname']; } ?>" id="lastname" class="input100" type="text" name="lastname" placeholder="Last Name">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type username">
						<input value="<?php if(!empty($_POST['username'])){ echo $_POST['username']; } ?>" id="username" class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>					
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user email">
						<input value="<?php if(!empty($_POST['email'])){ echo $_POST['email']; } ?>" id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user address" style="width:100%">
						<input value="<?php if(!empty($_POST['address'])){ echo $_POST['address']; } ?>" id="address" class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100"></span>
					</div>

									
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user contact number">
						<input value="<?php if(!empty($_POST['phone'])){ echo $_POST['phone']; } ?>" id="phone" class="input100" type="text" name="phone" placeholder="Contact Number">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user nation">
						<input value="<?php if(!empty($_POST['location'])){ echo $_POST['location']; } ?>" id="loaction" class="input100" type="text" name="location" placeholder="Nation">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user password">
						<input value="<?php if(!empty($_POST['password'])){ echo $_POST['password']; } ?>" id="password" class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user confirm password">
						<input value="<?php if(!empty($_POST['confirmpassword'])){ echo $_POST['confirmpassword']; } ?>" id="confirmpassword" class="input100" type="password" name="confirmpassword" placeholder="Confirm Password">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="container-login100-form-btn" style="padding-bottom:40px;">
						<button class="login100-form-btn">
							Sign Up
						</button>
					</div>

				</form>
<div class="login100-more" style="background-image: url('<?php echo $this->config->base_url(); ?>signin/images/city-wallpaper-18.jpg');z-index:initial;"></div>
				
			</div>
		</div>
	</div>

	<?php $this->load->view("common-login-register/footer.php");?>