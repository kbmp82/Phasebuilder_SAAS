<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$this->load->view("functions.php");
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

                    <h3 class="text-primary">Add Domains</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Domain</li>

                        <li class="breadcrumb-item active">Add Domains</li>

                    </ol>

                </div>

            </div>

			

			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Import Domains</h2>

			

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

							if($this->session->flashdata('register_success')){

								echo $this->session->flashdata('register_success');

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

                        <h3>Import Domain(s)</h3>
                    	<form enctype="multipart/form-data" class="login100-form validate-form register-form" id="register-form"  action="<?php echo $this->config->base_url(); ?>admin/domain/add_domain_action" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

                                <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription Id">
<label> Choose Domain List (separated by new line) </label><p><strong>File structure is:</strong> domain.com,nameserver1,nameserver2</p><br>
<input class="form-control" type="file" name="domain" id="domain_name" >
                            </div>

						<div class="container-login100-form-btn" style="padding-bottom:40px;">

							<button class="login100-form-btn">

								Import Domains

							</button>

						</div>



					</form>


                         <!-- old form code
							<form enctype="multipart/form-data" class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/domain/add_domain_action" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

								<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription Id">

								

<input value="" id="domain_name" class="input100 form-control" type="text" name="domain" placeholder="Domain name"><span class="focus-input100"></span>

							

							</div>

								

						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type subscription title">

							<input value="" id="ns1" class=" form-control" type="text" name="ns1" placeholder="ns1"><span class="focus-input100"></span>

						</div>





						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription subtitle">

							<input value="" id="ns2" class=" form-control" type="text" name="ns2" placeholder="ns2">

							<span class="focus-input100"></span>

						</div>					

						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select payment type">

							<select name="status" id="status" class="form-control">

								<option value="">Status</option>

								<option value="active">Active</option>

								<option value="inactive">Inactive</option>

							</select>

							<span class="focus-input100"></span>

						</div>		

						<label> Assign Client </label>						

						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select duration">

							

							<select name="assignedto" id="assignedto" class="form-control">

								<option value="">Select client</option>

							<?php    

							if($users){ 

									foreach($users as $uval){

							?>	

								<option value="<?php echo $uval['ID'] ;   ?>"> <?php echo $uval['username'] ;  ?>  </option>

							<?php  } }?>	

							</select>

							<span class="focus-input100"></span>

						</div>		

						

						<div class="container-login100-form-btn" style="padding-bottom:40px;">

							<button class="login100-form-btn">

								Add Domain

							</button>

						</div>



					</form>
                      -->
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