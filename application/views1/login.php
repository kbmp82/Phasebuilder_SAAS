<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("common-login-register/header.php");?>
	
	<div class="limiter">
		<div class="container-login100" style="display:inherit !important;">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo $this->config->base_url(); ?>login/process" method="post" > 
					<span class="login100-form-title p-b-34">
						Account Login
					</span>
					<?php //if(! empty(@msg)){ echo $msg;} ?> 
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user email">
						<input id="username" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-182">
						<span class="txt1">
							Forgot
						</span>

						<a href="<?php echo $this->config->base_url(); ?>forgot" class="txt2">
							 password?
						</a><br>
						<a href="<?php echo $this->config->base_url(); ?>register" class="txt3">
							Sign Up
						</a>
					</div>

				</form>

				<div class="login100-more" style="background-image: url('<?php echo $this->config->base_url(); ?>signin/images/bg-01.jpg');"></div>
			</div>
		</div>
	</div>

	<?php $this->load->view("common-login-register/footer.php");?>