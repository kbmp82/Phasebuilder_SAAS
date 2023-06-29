<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
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
                    <div class="card panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
							<div class="error_reported">
						<?php 
							if($this->session->flashdata('subscription_inserted')){
								echo $this->session->flashdata('subscription_inserted');
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
							<form enctype="multipart/form-data" class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>subscription/add_sub" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
								<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription Id">
									<input value="" id="sub_id" class="input100 form-control" type="text" name="sub_id" placeholder="Subscription ID"><span class="focus-input100"></span>
								 </div>
								
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type subscription title">
							<input value="" id="title" class="input100 form-control" type="text" name="title" placeholder="Subscription Title"><span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription subtitle">
							<input value="" id="subtitle" class="input100 form-control" type="text" name="subtitle" placeholder="Subscription Subtitle">
							<span class="focus-input100"></span>
						</div>					
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select payment type">
							<select name="pay_type" id="pay_type" class="form-control">
								<option value="">Select payment type</option>
								<option value="fixed">Fixed</option>
								<option value="recurring">Recurring</option>
							</select>
							<span class="focus-input100"></span>
						</div>			
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select duration">
							<select name="type" id="type" class="form-control">
								<option value="">Select duration</option>
								<option value="Day">Day</option>
								<option value="Week">Week</option>
								<option value="SemiMonth">SemiMonth</option>
								<option value="Year">Year</option>
							</select>
							<span class="focus-input100"></span>
						</div>					
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select subscription type">
							<select name="sub_type" id="sub_type" class="form-control">
								<option value="">Select subscription type</option>
								<option value="main">Main</option>
								<option value="addon">Add-on</option>
							</select>
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%" data-validate="Type billing frequency">
							<input value="" id="b_frequency" class="input100 form-control" type="text" name="b_frequency" placeholder="Billing Frequency">
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Enter billing cycles">
							<input value="" id="b_cycles" class="input100 form-control" type="text" name="b_cycles" placeholder="Billing Cycles">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter currency">
							<input value="" id="currency" class="input100 form-control" type="text" name="currency" placeholder="Currency Code">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter price">
							<input value="" id="price" class="input100 form-control" type="text" name="price" placeholder="Price">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter shipping">
							<input value="" id="shipping" class="input100 form-control" type="text" name="shipping" placeholder="Shipping">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter tax">
							<input value="" id="tax" class="input100 form-control" type="text" name="tax" placeholder="Tax">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Upload Image" style="border: none;border-left: none !important;">
							<input value="" id="image" class="input100" type="file" name="image">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter dsecription">
							<textarea value="" style="width: 100%" placeholder="Description" rows="5" id="desc" class="input100" name="desc"></textarea>
							<span class="focus-input100"></span>
						</div>


						<div class="container-login100-form-btn" style="padding-bottom:40px;">
							<button class="login100-form-btn">
								Add Subscription
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
<script src="<?php echo $this->config->base_url(); ?>signin/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>signin/js/main.js"></script>
	<?php  $this->load->view("admin/common/footer.php"); ?>