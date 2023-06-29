<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("common-login-register/header.php");
$this->load->helper('url');
$currentURL = current_url();
?>
	
	<div class="limiter">
		<div class="container-login100" style="display:inherit !important;">
			<div class="wrap-login100">
				<form class="login100-form validate-form forgot_form" action="<?php echo $currentURL; ?>" method="post" > 
					<span class="login100-form-title p-b-34">
						Reset Password
					</span>
				
						<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%;border:0px solid #fff !important;">
					       <?php 


if(!empty($this->session->flashdata('Password_Reset'))){
						echo '<div class="alert alert-success">';
						          echo $this->session->flashdata('Password_Reset');
						      
                                                   echo '</div>';
							}

                                	
	                	    ?>
<div class="p_error"></div>
                            </div>    
					<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user password">
						<div><input  id="password" class="input100" type="password" name="password" placeholder="Password"></div>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user confirm password">
						<input  id="confirmpassword" class="input100" type="password" name="confirmpassword" placeholder="Confirm Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Reset
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-182">
						<a href="<?php echo $this->config->base_url(); ?>login" class="txt3">
							Login
						</a> / 
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