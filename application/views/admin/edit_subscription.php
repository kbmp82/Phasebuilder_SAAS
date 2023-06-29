<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
$this->load->helper('form');
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
                    <h3 class="text-primary">Edit Subscription</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Subscription</li>
                    </ol>
                </div>
            </div>
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Update Subscription</h2>
			
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
							<form enctype="multipart/form-data" class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/subscription/update_subscription" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
							<?php foreach ($sub_detail as $value) { ?>
                                                                                                            
                                                            <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription Id">
                                                              
									<?php echo form_label('subscription Id', '');?><input value="<?php echo $value['subscription_id']; ?>" id="sub_id" class="input100 form-control" type="text" name="sub_id" placeholder="Subscription ID" readonly><span class="focus-input100"></span>
						            </div>
								
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type subscription title">
							<?php echo form_label('Title', '');?><input value="<?php echo $value['title']; ?>" id="title" class="input100 form-control" type="text" name="title" placeholder="Subscription Title"><span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription subtitle">
							<?php echo form_label('Subtitle', '');?><input value="<?php echo $value['subtitle']; ?>" id="subtitle" class="input100 form-control" type="text" name="subtitle" placeholder="Subscription Subtitle">
							<span class="focus-input100"></span>
						</div>					
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select payment type">
							<?php echo form_label('Payment type', '');?><select name="pay_type" id="pay_type" class="form-control">
								<option value="<?php echo $value['subscription_id']; ?>"><?php echo $value['subscription_id']; ?></option>
								<option value="fixed">Fixed</option>
								<option value="recurring">Recurring</option>
							</select>
							<span class="focus-input100"></span>
						</div>			
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select duration">
							<?php echo form_label('Duration', '');?><select name="duration" id="type" class="form-control">
								
								<option value="<?php echo $value['duration']; ?>"><?php echo $value['duration']; ?></option>
								<option value="Day">Day</option>
								<option value="Week">Week</option>
								<option value="SemiMonth">SemiMonth</option>
								<option value="Year">Year</option>
							</select>
							<span class="focus-input100"></span>
						</div>					
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select subscription type">
							<?php echo form_label('Subscription type', '');?><select name="sub_type" id="sub_type" class="form-control">
								<option value="<?php echo $value['sub_type']; ?>"><?php echo $value['sub_type']; ?></option>
								<option value="main">Main</option>
								<option value="addon">Add-on</option>
							</select>
							<span class="focus-input100"></span>
						</div>


                      <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%" data-validate="Type Domain number">
							<?php echo form_label('domain_number', '');?><input value="<?php echo $value['domain_number']; ?>" id="b_frequency" class="input100 form-control" type="text" name="domain_number" placeholder="No. of domains">
							<span class="focus-input100"></span>
						</div>   


                    

						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="width:100%" data-validate="Type billing frequency">
							<?php echo form_label('frequency', '');?><input value="<?php echo $value['billing_frequency']; ?>" id="b_frequency" class="input100 form-control" type="text" name="b_frequency" placeholder="Billing Frequency">
							<span class="focus-input100"></span>
						</div>


						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Enter billing cycles">
							<?php echo form_label('Billing cycles', '');?><input value="<?php echo $value['billing_cycles']; ?>" id="b_cycles" class="input100 form-control" type="text" name="b_cycles" placeholder="Billing Cycles">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter currency">
							<?php echo form_label('Currency', '');?><input value="<?php echo $value['currency']; ?>" id="currency" class="input100 form-control" type="text" name="currency" placeholder="Currency Code">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter price">
							<?php echo form_label('Price', '');?><input value="<?php echo $value['price']; ?>" id="price" class="input100 form-control" type="text" name="price" placeholder="Price">
							<span class="focus-input100"></span>
						</div>
                        <!--
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter shipping">
							<input value="<?php echo $value['shipping']; ?>" id="shipping" class="input100 form-control" type="text" name="shipping" placeholder="Shipping">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter tax">
							<?php echo form_label('Tax', '');?><input value="<?php echo $value['tax']; ?>" id="tax" class="input100 form-control" type="text" name="tax" placeholder="Tax">
							<span class="focus-input100"></span>
						</div>
                        -->
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Upload Image" style="border: none;border-left: none !important;">
							<input value="<?php echo $value['image']; ?>" id="image" class="" type="file" name="image">
							<span class="focus-input100"></span>
						</div>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Enter dsecription">
							<textarea value="<?php echo $value['description']; ?>" style="width: 100%" placeholder="Description" rows="5" id="desc" class="input100" name="desc"><?php echo $value['description']; ?></textarea>
							<span class="focus-input100"></span>
						</div>

<?php } ?>
						<div class="container-login100-form-btn" style="padding-bottom:40px;">
							<button class="login100-form-btn">
								Update Subscription
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