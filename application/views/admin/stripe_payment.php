<?php

defined('BASEPATH') OR exit('No direct script access allowed');



$this->load->view("admin/common/header.php");

$this->load->view("admin/common/sidebar.php");



	if(isset($stripe)){

	

		$mode  =  $stripe->mode ;

		$stripe_username  =  $stripe->stripe_username ;

		$publishable_key_live  =  $stripe->publishable_key_live ;

		$secret_key_live  =  $stripe->secret_key_live ;

		$publishable_key_sandbox  =  $stripe->publishable_key_sandbox ;

		$secret_key_sandbox  =  $stripe->secret_key_sandbox ;

	

	

	}



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



        float: left;



    }



</style>

<script>

$(document).ready(function($){

    var Sandbox = '<?php echo $sandbox;?>';

    if(Sandbox != ''){

        $('select').find("option[value="+ Sandbox +"]").attr('selected','selected');

    }



});

</script>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">

   <!-- Page wrapper  -->

        <div class="page-wrapper">

            <!-- Bread crumb -->

            <div class="row page-titles" style="margin:0px !important">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Payment Settings</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Stripe Settings</li>

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

                    <h3>Stripe Settings</h3><p>These settings will affect which Stripe account and Stripe Sandbox account (testing account) are used to process payments.</p>

                            <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/save_stripe_payment" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">



                          <div class="form-group rs1-wrap-input100 validate-input m-b-20" style="width:100%;" >

                            <label><h4> <strong>Stripe Mode </strong></h4><p>Set to 'Sandbox' for testing and 'Live' to accept real payments.</p></label>

                             <select id="sandbox" name="mode" class="input100 form-control">

								<option value="sandbox"> (select Stripe mode) </option>

									<option value="sandbox" <?php  echo ($mode == 'sandbox' ) ? 'selected' : '' ; ?>>Sandbox </option>

                                 <option value="live" <?php  echo ($mode == 'live' ) ? 'selected' : '' ; ?>>  Live	</option>

								</select>

                            </div>



                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;">

                         <label><h4> <strong>Stripe Username Live </strong></h4></label>



                         <input value="<?php echo isset($stripe_username) ? $stripe_username : '' ;   ?>" id="stripe_username" class=" form-control" type="text" name="stripe_username" placeholder=""><span class="focus-input100"></span>

						 

                        </div>



                        <div class="form-group  rs1-wrap-input100 validate-input m-b-20" style="width:100%;">

                         <label><h4> <strong>Stripe Publishable Key Live </strong></h4></label>

                            <input value="<?php echo isset($publishable_key_live) ? $publishable_key_live : '' ;   ?>" id="publishable_key_live" class=" form-control" type="password" name="publishable_key_live" placeholder="">

                            <span class="focus-input100"></span>

                        </div>



                        <div class="form-group rs2-wrap-input100 validate-input m-b-20" style="width:100%;" >

                          <label><h4> <strong>Stripe Secret Key Live </strong></h4></label>

                            <input value="<?php echo isset($secret_key_live) ? $secret_key_live : '' ;   ?>" id="secret_key_live" class=" form-control" type="text" name="secret_key_live" ><span class="focus-input100"></span>

                        </div>



                         <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Amazon Access Key">

                         <label><h4> <strong>Stripe Publishable Key Sandbox </strong></h4></label>



                         <input value="<?php echo isset($publishable_key_sandbox) ? $publishable_key_sandbox : '' ;   ?>" id="publishable_key_sandbox" class=" form-control" type="text" name="publishable_key_sandbox" placeholder=""><span class="focus-input100"></span>

                        </div>



                        <div class="form-group  rs1-wrap-input100 validate-input m-b-20" style="width:100%;">

                         <label><h4> <strong>Stripe Secret Key Sandbox </strong></h4></label>

                            <input value="<?php echo isset($secret_key_sandbox) ? $secret_key_sandbox : '' ;   ?>" id="secret_key_sandbox" class=" form-control" type="password" name="secret_key_sandbox" placeholder="">

                            <span class="focus-input100"></span>

                        </div>



                       

						

                        <div class="container-login100-form-btn" style="padding-bottom:40px;">

                            <button class="login100-form-btn">

                                Save Settings

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

<?php  $this->load->view("admin/common/footer.php"); ?>