<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");
?>
	<style>
.panel-heading {
    color: #31708f;
    background-color: #d9edf7 !important;
    border-color: #bce8f1 !important;
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
	
.panel.panel-info {
    border: 1px solid #bce8f1;
	}
	
.panel-body {
    padding: 15px;
}
	
</style>
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">User Profile</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Update Profile</h2>
			
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
			  <div class="row">
				  <div class="col-md-3"></div>
                <div class="col-md-6" style="margin: 0 auto;">
                    <div class="panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
							<div class="error_reported">
						<?php 
							if($this->session->flashdata('profile_update_success')){
								echo $this->session->flashdata('profile_update_success');
								?>
									<script>
									setTimeout(function()
									{
										jQuery(".error_reported").html("");
										jQuery(".error_reported").hide("slow");
									},3000);
									</script>
						<?php
							}
						?>
					</div>
							<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>profile/update" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
								<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20"  data-validate="Type user firstname">
									<label for="email">First Name:</label>
									<input value="<?php echo $user_data->firstname; ?>" id="firstname" class="input100 form-control" type="text" name="firstname" placeholder="First Name"><span class="focus-input100"></span>
								 </div>
								
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user lastname">
									<label for="email">Last Name:</label>
							<input value="<?php echo $user_data->lastname; ?>" id="lastname" class="input100 form-control" type="text" name="lastname" placeholder="Last Name"><span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type username">
							<label for="email">Username:</label>
							<input value="<?php echo $user_data->username; ?>" id="username" class="input100 form-control" type="text" name="username" placeholder="Username">
							<span class="focus-input100"></span>
						</div>					
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Type user email">
							<label for="email">Email:</label>
							<input value="<?php echo $user_data->email; ?>" id="email" class="input100 form-control" type="text" name="email" placeholder="Email" disabled>
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user address" style="width:100%">
							<label for="email">Address:</label>
							<input value="<?php echo $user_data->address; ?>" id="address" class="input100 form-control" type="text" name="address" placeholder="Address">
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user contact number">
							<label for="email">Phone:</label>
							<input value="<?php echo $user_data->phone; ?>" id="phone" class="input100 form-control" type="text" name="phone" placeholder="Contact Number">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user nation">
							<label for="email">Nation:</label>
							<input value="<?php echo $user_data->location; ?>" id="loaction" class="input100 form-control" type="text" name="location" placeholder="Nation">
							<span class="focus-input100"></span>
						</div>


						<div class="container-login100-form-btn" style="padding-bottom:40px;">
							<button class="login100-form-btn">
								Update
							</button>
						</div>

					</form>
                        </div>
                    </div>
                </div>				  
				  <div class="col-md-3"></div>
        	</div>
        </div>
    </div>
</div>
</div>

	<?php  $this->load->view("common/footer.php"); ?>