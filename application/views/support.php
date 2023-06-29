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

.login100-form {

    width: 100% !important;

    padding: 0 !important;

}

</style>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">

   <!-- Page wrapper  -->

        <div class="page-wrapper">

            <!-- Bread crumb -->

            <div class="row page-titles" style="margin:0px !important">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Support</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Support</li>

                    </ol>

                </div>

            </div>

			

			

<div class="container">

    <div class="row clearfix">

        <div class="col-md-12 column">

			  <div class="row">

				  <div class="col-md-1"></div>

                <div class="col-md-10" style="margin: 0 auto;">

                    <div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">

                        <div class="panel-body">

							<div class="error_reported">

						<?php 

							if($this->session->flashdata('credential_success')){

								echo $this->session->flashdata('credential_success');

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

					

<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>support/submit_ticket" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

   

<input type="hidden" value="<?php echo $this->session->userdata('ID'); ?>" name="u_id">
    <input type="hidden" value="initial" name="t_type">
    <input type="hidden" value="0" name="p_id">  

        <div>

             <label>Ticket Subject </label> 

        </div>						

<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20"  data-validate="Enter Ticket Subject" style="width:100%" >

					    



<input value="" id="subject" class="input100 form-control" type="text" name="subject" placeholder="Enter Subject">

	<span class="focus-input100"></span>

				

</div>

	    

	    <div>

             <label>Ticket Details </label> 

        </div>					

		

			<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Enter Ticket Details" style="width:100%">

				 	    

			<textarea style="height: 200px;border-width: px;border: 1px solid;border-color: lightgrey; padding-top: 12px;" rows="10" id="detail" class="textarea_editor input100" name="detail" placeholder="Ticket details">

			</textarea>

			<span class="focus-input100"></span>

			</div>					



						<div class="container-login100-form-btn" style="padding-bottom:40px;">

							<button class="login100-form-btn">

								Submit

							</button>

						</div>



					</form>

                        </div>

                    </div>

                </div>				  

				  <div class="col-md-1"></div>

        	</div>

        </div>

    </div>

</div>

</div>

<script src="<?php echo $this->config->base_url(); ?>signin/vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="<?php echo $this->config->base_url(); ?>signin/js/main.js"></script>

<?php  $this->load->view("common/footer.php"); ?>