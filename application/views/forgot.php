<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("common-login-register/header.php");
?>
	
	<div class="limiter">
		<div class="container-login100" style="display:inherit !important; background-color: #101421;">
        <!-- Logo icon -->
                        <center><img src="<?php echo $this->config->base_url(); ?>main/images/pb-login.png" alt="phasebuilder" style="padding-top: 65px;"/></center>
        <center><div>
				<form class="login100-form validate-form" action="<?php echo $this->config->base_url(); ?>forgot/process" method="post" > 
					<span class="login100-form-title p-b-34">
						<font color="#fff">Forgot Password</font>
					</span>
				
						<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%;border:0px solid #fff !important;">
					       <?php 
                                	
                 
                        		if($this->session->flashdata('email_sent')){
                        			echo '<div class="alert alert-success">';
                        			echo $this->session->flashdata('email_sent');
                        			echo '</div>';
                               		}elseif($this->session->flashdata('email_sent_error')){
	                			echo '<div class="alert alert-danger">';
	                			echo $this->session->flashdata('email_sent');
	                			echo '</div>';
	                       		}else{
	                       		
	                       		if(validation_errors() != false) { 
	                                	echo '<div class="alert alert-danger">';
	                                    echo validation_errors(); 
	                                	echo '</div>';
                                	}
	                       		
	                       		}
	                	?>
                            </div>    
					
					
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user email" style="width:100%;">
					<input id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Send
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-182">
						<a href="<?php echo $this->config->base_url(); ?>login" class="txt3">
							Login
						</a> / 
						<a href="http://phasebuilder.com" class="txt3">
							Sign Up
						</a>
					</div>

				</form>

			</div></center>
		</div>
	</div>

	<?php $this->load->view("common-login-register/footer.php");?>