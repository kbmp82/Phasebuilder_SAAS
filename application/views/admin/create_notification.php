<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");
$ci =&get_instance();
$ci->load->model('user/LoginModel');
$userdata = $ci->LoginModel->check_mysubscription($this->session->userdata['ID']);
$countdata = count($userdata);

?>
<script>
function checkNote(elem){
   if(elem.value == 'builds_remaining'){
      document.getElementById('builds_remaining_div').style.display = "block";
      document.getElementById('sub_renewal_div').style.display = "none";
      document.getElementById('sub_ending_div').style.display = "none";

   }else if(elem.value == 'sub_ending'){
     document.getElementById('sub_ending_div').style.display = "block";
      document.getElementById('sub_renewal_div').style.display = "none";
      document.getElementById('builds_remaining_div').style.display = "none";
   }else if(elem.value == 'new_builds'){
       cost.innerText = 'Cost: $<?php echo $cost[0]['price_elite'];?>';
        document.getElementById('sub_renewal_div').style.display = "block";
      document.getElementById('sub_ending_div').style.display = "none";
      document.getElementById('builds_remaining_div').style.display = "none";
   }

}

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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Notifications</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>articles">Create Notification</a></li>

                    </ol>
                </div>
            </div>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">


<div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="card panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
                            	<div class="error_reported">
                        <?php
                            if($this->session->flashdata('notification_update_success')){
                                $testing = $this->session->flashdata('notification_update_success');
                                echo $this->session->flashdata('notification_update_success');
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

                                <div class="col-md-12" style="float: left">
                                    <h2>Create Notification</h2><br /><p>Create notifications that will go out to users based on a set criteria.</p>

 <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo site_url('SupportTickets/create_notifications');?>" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

                                     <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
                                    <label><h4>Notification Type</h4></label>
                                   <select id="type" name="type" class="input100 form-control" onchange="checkNote(this)">

                                                            <option value="">
                                    (Choose Your Notification Type)
                                </option>
                                <option value="builds_remaining">Builds Remaining</option>
                                <option value="sub_ending">Subscription Ending</option>
                                 <option value="new_builds">Subscription Renewal</option>
                                </select>
                                </div>
                                <div id="description"style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                    <p id="description_area"></p>

                                </div>
                                <div style="width: 100%; border: none;display:none;" id="builds_remaining_div" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                    <label><h4>How Often To Send Notification (in days)</h4><p>The amount of time that needs to pass between notifications being sent.</p></label>
                                      <input value="" id="builds_remain_days" class="input100 form-control"  type="text" name="builds_remain_days" placeholder="">
                                </div>
                                <div style="width: 100%; border: none;display:none;" id="sub_ending_div" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                    <label><h4>How Many Days Before Subscription Ends</h4><p>The amount of days prior to the subscription ending that the notification will be sent.</p></label>
                                      <input value="" id="sub_ending_days" class="input100 form-control"  type="text" name="sub_ending_days" placeholder="">
                                </div>
                                <div style="width: 100%; border: none;display:none;" id="sub_renewal_div" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                    <label><h4>How Many Days Before  Renewl</h4><p>The amount of days prior to a subscription renewal that the notification will be sent.</p></label>
                                      <input value="" id="sub_renewal" class="input100 form-control"  type="text" name="sub_renewal" placeholder="">
                                </div>
                                    <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                    <label><h4>Notification Name</h4><p>The name to identify the notification. (User will not see this)</p></label>
                                      <input value="" id="name" class="input100 form-control"  type="text" name="name" placeholder="">
                                </div>
                                 <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                <label><h4>Notification Title</h4><p>The subject or title of the notification</p></label>
                                      <input value="" id="title" class="input100 form-control"  type="text" name="title" placeholder="">
                                </div>

                        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:97%;">
                     <label><h3>Notification Message</h3></label><br />
                            <textarea style="border: 1px solid #e6e6e6; padding-top: 12px; width: 100%" rows="5" id="body" class="input100" name="body" ></textarea>

                        </div>


                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="save_notification">
                               Save Notification
                            </button>
                        </div>
                				</form>
                                                    </div>

                        </div>
                    </div>
                </div>
                  <div class="col-md-1"></div>
        	</div>


        </div>
    </div>
</div>
</div>

    <?php  $this->load->view("common/footer.php"); ?>