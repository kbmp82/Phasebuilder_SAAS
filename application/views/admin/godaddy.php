<?php
/*echo "<pre>";
print_r($user_credentials);
echo "</pre>";
exit();*/


defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
?>
<script type="text/javascript">

$(document).ready(function($){

});
</script>
    <style>

/* Acordeon styles */
.tab {
  position: relative;
  margin-bottom: 1px;
  width: 100%;
  color: #0ca5da;
  overflow: hidden;
}

label {
  position: relative;
  display: block;
  padding: 0 0 0 1em;

  cursor: pointer;
  font-family: FontAwesome;
}

.tab-content {
  max-height: 0;
  overflow: hidden;
  -webkit-transition: max-height .35s;
  -o-transition: max-height .35s;
  transition: max-height .35s;
}


/* :checked */
input:checked ~ .tab-content {
  max-height: 100em;
}
/* Icon */
label::after {
  position: absolute;
  right:21em;
  top: .3em;
  -webkit-transition: all .35s;
  -o-transition: all .35s;
  transition: all .35s;
}
input[type=checkbox] + label::after {
 /*content: "\f063"; */
 content: "\25BC";
 font-size: 24px;
}

input[type=checkbox]:checked + label::after {
  transform: rotate(180deg);
}
.tab-input {
  position: absolute;
  opacity: 0;
  z-index: -1;
}

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
<script>
$(document).ready(function($){
    var auto = <?php echo $godaddy_settings[0]->automatically_import;?>;
     if(auto == 1){
        document.getElementById("automatically_import").checked = true;
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
                    <h3 class="text-primary">GoDaddy Settings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">GoDaddy Settings</li>
                    </ol>
                </div>
            </div>

<div class="container">
     <div class="row clearfix">
        <div class="col-md-12 column">
              <div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="panel card <?php if (isset($panel_class)) {
    echo $panel_class;
}
?>">
                        <div class="panel-body">
                            <div class="error_reported">
                        <?php
if ($this->session->flashdata('credential_success')) {
    echo $this->session->flashdata('credential_success');
    ?>
                                    <script>
                                    setTimeout(function()
                                    	{
                                    		jQuery(".error_reported").html("");
                                    		jQuery(".error_reported").hide("slow");
                                    	}, 3000
                                    );
                                    </script>
                        <?php
}
?>
                    </div>

                            <h3>GoDaddy Settings</h3><p>These settings control which GoDaddy account is used for domain management.</p>
                             <form enctype="multipart/form-data" class="login100-form validate-form register-form" id="update_godaddy_settings_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/update_godaddy_settings" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

                         <div class="form-group rs1-wrap-input100 validate-input m-b-20" style="width:100%;" >
                          <input type="checkbox" style="transform: scale(1.5); margin-top: 19px;" name="automatically_import" id="automatically_import" value="yes">&nbsp;&nbsp;Automatically Import New Domains Into The System <br><p>If unchecked, domains will need to be manually imported from the Domains->GoDaddy Domains tab.</p>
                           <!--<input type="checkbox" style="transform: scale(1.5); margin-top: 19px;" name="clean_up" id="clean_up" value="yes">&nbsp;&nbsp;Remove All Abandonded Resources&nbsp;&nbsp;(Removes all demo accounts that are not in the database but still remain on the server from testing/debugging) -->
                         </div>
                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;">
                                    <label><h4> <strong>GoDaddy API Key </strong></h4><p>This is the GoDaddy Production key.</p></label>
                                   <input value="<?php echo ($godaddy_settings) ? ($godaddy_settings[0]->godaddy_api) ? $godaddy_settings[0]->godaddy_api : '' : '' ?>" id="godaddy_api" class="input100 form-control" type="text" name="godaddy_api" >
                                </div>
                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;">
                                   <label><h4> <strong>GoDaddy API Secret Key </strong></h4><p>This is the GoDaddy Production secret key.</p></label>
                                   <input value="<?php echo ($godaddy_settings) ? ($godaddy_settings[0]->godaddy_secret) ? $godaddy_settings[0]->godaddy_secret : '' : '' ?>" id="godaddy_secret" class="input100 form-control" type="text" name="godaddy_secret" >
                                </div>

                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="update_server_settings">
                                Update Settings
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
<script>

function checkThis(checkbox){
 if (checkbox.checked) {
    document.getElementById("clean_up").disabled = true;
  } else {
    document.getElementById("clean_up").disabled = false;
  }
}
</script>
<?php  $this->load->view("admin/common/footer.php"); ?>