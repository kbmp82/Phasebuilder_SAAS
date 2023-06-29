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
								<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
									<label for="email">Subscription Id:</label>
									<input value="" id="sub_id" class="input100 form-control" type="text" name="sub_id" placeholder=""><span class="focus-input100"></span>
								 </div>
								
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20">
									<label for="email">Title:</label>
							<input value="" id="title" class="input100 form-control" type="text" name="title" placeholder=""><span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
							<label for="email">Subtitle:</label>
							<input value="" id="subtitle" class="input100 form-control" type="text" name="subtitle" placeholder="">
							<span class="focus-input100"></span>
						</div>					
						<div class="form-group wrap-input100 rs2-wrap-input100 ">
							<label for="email">Type:</label>
							<select name="type" id="type" class="form-control">
								<option value="fixed">Fixed</option>
								<option value="day">Day</option>
								<option value="week">Week</option>
								<option value="month">Month</option>
								<option value="year">Year</option>
							</select>
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%">
							<label for="email">Billing Frequency:</label>
							<input value="" id="b_frequency" class="input100 form-control" type="text" name="b_frequency" placeholder="">
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
							<label for="email">Total Billing Cycles:</label>
							<input value="" id="b_cycles" class="input100 form-control" type="text" name="b_cycles" placeholder="">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20">
							<label for="email">Currency:</label>
							<input value="" id="currency" class="input100 form-control" type="text" name="currency" placeholder="">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20">
							<label for="email">Price:</label>
							<input value="" id="price" class="input100 form-control" type="text" name="price">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20">
							<label style="width: 100%" for="email">Upload Image:</label>
							<input value="" id="image" class="input100" type="file" name="image">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20">
							<label style="width: 100%" for="email">Description:</label>
							<textarea value="" style="width: 100%" rows="5" id="desc" class="input100" name="desc"></textarea>
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

	<?php  $this->load->view("common/footer.php"); ?>