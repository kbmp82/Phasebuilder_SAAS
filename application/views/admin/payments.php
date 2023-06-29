<?php
/*echo "<pre>";
print_r($user_credentials);
echo "</pre>";
exit();*/

$sandbox=$pp_sig_live=$pp_user_live=$pp_pass_live=$pp_sig_sand=$pp_user_sand=$pp_pass_sand='';
if(!empty($paypal_credentials)){
    $sandbox = $paypal_credentials[0]->sandbox;
    $paypal_sig_live = $paypal_credentials[0]->paypal_sig_live;
    $paypal_user_live = $paypal_credentials[0]->paypal_user_live;
    $paypal_pass_live = $paypal_credentials[0]->paypal_pass_live;
    $paypal_sig_sand = $paypal_credentials[0]->paypal_sig_sand;
    $paypal_user_sand = $paypal_credentials[0]->paypal_user_sand;
    $paypal_pass_sand = $paypal_credentials[0]->paypal_pass_sand;
}
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
                        <li class="breadcrumb-item active">Payment Settings</li>
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
                    <h3>PayPal Settings</h3><p>These settings will affect which PayPal account and PayPal Sandbox account (testing account) are used to process payments.</p>
                            <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/add_payments_paypal" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

                                <div class="form-group rs1-wrap-input100 validate-input m-b-20" style="width:100%;" >
                            <label><h4> <strong>PayPal Mode </strong></h4><p>Set to 'Sandbox' for testing and 'Live' to accept real payments.</p></label>
                             <select id="sandbox" name="sandbox" class="input100 form-control">

                                                            <option value="sandbox">
                                    (select PayPal mode)
                                </option>
                                                                    <option value="sandbox">
                                        Sandbox                                    </option>
                                                                    <option value="live">
                                        Live                                    </option>


                                                        </select>
                            </div>

                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;">
                         <label><h4> <strong>PayPal Username Live </strong></h4></label>

                         <input value="<?php echo (isset($paypal_user_live)) ? $paypal_user_live : ''; ?>" id="paypal_user_live" class="input100 form-control" type="text" name="paypal_user_live" placeholder=""><span class="focus-input100"></span>
                        </div>

                        <div class="form-group  rs1-wrap-input100 validate-input m-b-20" style="width:100%;">
                         <label><h4> <strong>PayPal Password Live </strong></h4></label>
                            <input value="<?php echo (isset($paypal_pass_live)) ? $paypal_pass_live : ''; ?>" id="paypal_pass_live" class="input100 form-control" type="password" name="paypal_pass_live" placeholder="">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="form-group rs2-wrap-input100 validate-input m-b-20" style="width:100%;" >
                          <label><h4> <strong>PayPal Signiture Live </strong></h4></label>
                            <input value="<?php echo (isset($paypal_sig_live)) ? $paypal_sig_live : ''; ?>" id="paypal_sig_live" class="input100 form-control" type="text" name="paypal_sig_live" ><span class="focus-input100"></span>
                        </div>

                         <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Amazon Access Key">
                         <label><h4> <strong>PayPal Username Sandbox </strong></h4></label>

                         <input value="<?php echo (isset($paypal_user_sand)) ? $paypal_user_sand : ''; ?>" id="paypal_user_sand" class="input100 form-control" type="text" name="paypal_user_sand" placeholder=""><span class="focus-input100"></span>
                        </div>

                        <div class="form-group  rs1-wrap-input100 validate-input m-b-20" style="width:100%;">
                         <label><h4> <strong>PayPal Password Sandbox </strong></h4></label>
                            <input value="<?php echo (isset($paypal_pass_sand)) ? $paypal_pass_sand : ''; ?>" id="paypal_pass_sand" class="input100 form-control" type="password" name="paypal_pass_sand" placeholder="">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="form-group rs2-wrap-input100 validate-input m-b-20" style="width:100%;" >
                          <label><h4> <strong>PayPal Signiture Sandbox </strong></h4></label>
                            <input value="<?php echo (isset($paypal_sig_sand)) ? $paypal_sig_sand : ''; ?>" id="paypal_sig_sand" class="input100 form-control" type="text" name="paypal_sig_sand" ><span class="focus-input100"></span>
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