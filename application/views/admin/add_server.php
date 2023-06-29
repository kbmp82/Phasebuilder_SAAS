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

.rs2-wrap-input100 {
    border-left: 1px solid #e6e6e6 !important;
}
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


</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Servers</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Servers</li>
                        <li class="breadcrumb-item active">Add Server</li>
                    </ol>
                </div>
            </div>

         <h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Add New Server</h2>
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


                            <form enctype="multipart/form-data" class="login100-form validate-form register-form" id="add_server_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/add_server" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
                  <div style="width: 97%; border: none" class="form-group wrap-input100 rs1-wrap-input100 m-b-20">

                                                      	<label><h4><strong>Server Type</strong></h4></label><select id="type" name="type" class="input100 form-control">

                                                                    <option value="production">Select server type
                                                                           </option>
                                                                    <option value="production">Production (client sites)
                                                                           </option>
                                                                    <option value="internal">Internal (personal network)
                                                                           </option>

                                                        </select>

                                                    </div>
                    <div class="form-group  rs2-wrap-input100 m-b-20" style="width:100%;">
                         <label><h4><strong>Server Alias</strong></h4><p>Give the server an alias to identify it.</p></label>
                           <input value="" id="server_alias" class="input100 form-control" type="text" name="server_alias" >

                        </div>
                         <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;">
                                    <label><h4><strong> WHM Username</strong></h4></label>
                                   <input value="" id="whm_user" class="input100 form-control" type="text" name="whm_user" >
                                </div>
                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;">
                                    <label><h4><strong> WHM Password</strong></h4></label>
                                   <input value="" id="whm_pass" class="input100 form-control" type="text" name="whm_pass" >
                                </div>
                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;">
                                <label><h4><strong> WHM Token</strong></h4><p>Before adding a server you must first generate a token.<br>(Go to your WHM >> Home >> Security Center >> Manage API Tokens)</p></label>
                                 <input value="" id="whm_token" class="input100 form-control" type="text" name="whm_token" >
                                </div>
                                <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4><strong> Server IP Address</strong></h4></label>
                                    <input value="" id="ip" class="input100 form-control" type="text" name="ip" >
                                 </div>
                                 <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4><strong> Nameserver 1</strong></h4></label>
                                    <input value="" id="nameserver_one" class="input100 form-control" type="text" name="nameserver_one" >
                                 </div>
                                 <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4><strong> Nameserver 2</strong></h4></label>
                                    <input value="" id="nameserver_two" class="input100 form-control" type="text" name="nameserver_two" >
                                 </div>
                                 <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4><strong> Total Server Processors</strong></h4><p>This can be found at WHM >> Server Status >> Server Information.</p></label>
                                    <input value="" id="cores" class="input100 form-control" type="text" name="cores" >
                                 </div>
                                 <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4><strong> IP List (optional)</strong></h4><p>Import a text file of IP's, one on each line, and the server will rotate through them when assigning cpanel accounts.</p></label>
                            <textarea style="border: 1px solid #e6e6e6; padding-top: 12px; width: 100%" rows="5" id="ip_list" class="input100" name="ip_list" ></textarea>
                                 </div>

                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="add_server_button">
                                Add Server
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