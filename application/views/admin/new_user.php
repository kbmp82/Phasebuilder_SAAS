<?php
defined('BASEPATH') OR exit('No direct script access allowed');


?>

<?php
$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php"); 
//$this->load->library('javascript/jquery');
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
    .login100-form {
        width: 100% !important;
        padding: 0 !important;
    }
    .rs1-wrap-input100, .rs2-wrap-input100 {
        width: 100% !important;
    }
    #pay_type,#type,#sub_type{
        height: 50px !important;
    }
    .rs2-wrap-input100 {
        border-left: 1px solid #e6e6e6 !important;
    }
    .validate-input{
         margin-left: 114px;
    }
    label {
    font-weight: 400;
    margin-bottom: -20px;
    margin-top: 1px;
    font-size: 16px;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
<!-- Page wrapper  -->

<style>
    .card {
        margin: 15px 200px;
    }
</style>
<!-- Page wrapper  -->
<div class="page-wrapper">


    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">User</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User Management</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card new_user">

                <div class="card-body">
<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/user/add_user" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
					
			
					
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

					
					<?php echo form_label('Firstname', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user firstname">
						<input value="<?php if(!empty($_POST['firstname'])){ echo $_POST['firstname']; } ?>" id="firstname" class="input100" type="text" name="firstname" placeholder="First Name">
						<span class="focus-input100"></span>
					</div>
					<?php echo form_label('Lastname', '');?><div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user lastname">
						<input value="<?php if(!empty($_POST['lastname'])){ echo $_POST['lastname']; } ?>" id="lastname" class="input100" type="text" name="lastname" placeholder="Last Name">
						<span class="focus-input100"></span>
					</div>
					
					
					<?php echo form_label('Username', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type username">
						<input value="<?php if(!empty($_POST['username'])){ echo $_POST['username']; } ?>" id="username" class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>					
					<?php echo form_label('Email', '');?><div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user email">
						<input value="<?php if(!empty($_POST['email'])){ echo $_POST['email']; } ?>" id="email" class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>
					
					
					<?php echo form_label('Address', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user address" style="width:100%">
						<input value="<?php if(!empty($_POST['address'])){ echo $_POST['address']; } ?>" id="address" class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100"></span>
					</div>

									
					<?php echo form_label('Phone', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user contact number">
						<input value="<?php if(!empty($_POST['phone'])){ echo $_POST['phone']; } ?>" id="phone" class="input100" type="text" name="phone" placeholder="Contact Number">
						<span class="focus-input100"></span>
					</div>
					<?php echo form_label('Location', '');?><div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user nation">
						<input value="<?php if(!empty($_POST['location'])){ echo $_POST['location']; } ?>" id="loaction" class="input100" type="text" name="location" placeholder="Nation">
						<span class="focus-input100"></span>
					</div>
					
					
					<?php echo form_label('Password', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user password">
						<input value="<?php if(!empty($_POST['password'])){ echo $_POST['password']; } ?>" id="password" class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					<?php echo form_label('Confirm pass', '');?><div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user confirm password">
						<input value="<?php if(!empty($_POST['confirmpassword'])){ echo $_POST['confirmpassword']; } ?>" id="confirmpassword" class="input100" type="password" name="confirmpassword" placeholder="Confirm Password">
						<span class="focus-input100"></span>
					</div>
					
					
					<?php echo form_label('Firstname', '');?><div class="container-login100-form-btn" style="padding-bottom:40px;">
						<button class="login100-form-btn">
							Add User
						</button>
					</div>

				</form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view("admin/common/footer.php"); ?>