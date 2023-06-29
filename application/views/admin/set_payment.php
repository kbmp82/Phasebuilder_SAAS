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



        float: left;



    }



</style>





<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">

   <!-- Page wrapper  -->

        <div class="page-wrapper">

            <!-- Bread crumb -->

            <div class="row page-titles" style="margin:0px !important">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Payment Gateway</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Payment Gateway</li>

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

                    <label><h3> Payment Gateway </h3><p>These settings will effect which payment gateway is used to process payments.</p></label>

                            <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/set_payment_status" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
                              <div class="form-group rs1-wrap-input100 validate-input m-b-20" style="width:100%;" >


                              <label><h4> <strong>Active Payment Gateway</strong></h4><p>Choose which payment gateway to process payments with.</p></label>
                             <select id="payment_status" name="payment_status" class="input100 form-control">

                                <option value=""> (select payment gateway) </option>

                                    <option value="paypal" <?php  echo ($status == 'paypal' ) ? 'selected' : '' ; ?>> PayPal </option>

                                 <option value="stripe" <?php  echo ($status == 'stripe' ) ? 'selected' : '' ; ?>> Stripe 	</option>

                                 <option value="both" <?php  echo ($status == 'both' ) ? 'selected' : '' ; ?>>  Both	</option>

                                </select>
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