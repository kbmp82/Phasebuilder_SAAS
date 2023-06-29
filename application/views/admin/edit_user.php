<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php"); 
//$this->load->library('javascript/jquery');
?>
<script>
  $("document").ready(function(){

  var selected_status = <?php echo (isset($subs[0]['suspended'])) ? $subs[0]['suspended'] : '0'; ?>;
     if(selected_status === 0){
          $("input[name=account_status][value=active]").prop('checked', true);
          $("input[name=account_status][value=suspended]").prop('checked', false);
     }else{
         $("input[name=account_status][value=suspended]").prop('checked', true);
         $("input[name=account_status][value=active]").prop('checked', false);
     }
     var trial_status = <?php echo (isset($trial_days['gateway'])) ? ($trial_days['gateway'] == "trial") ? '1' : '0' : '0'; ?>;
     if(trial_status == 1){
        document.getElementById("trial_mode").checked = true;
     }
      var never_status = <?php echo (isset($never)) ? ($never == 1) ? '1' : '0' : '0'; ?>;
     if(never_status == 1){
        document.getElementById("never_suspend").checked = true;
     }
  });

  function checkChange(elem){
   if(elem.checked == true){
       pass.style.display = "block";
       conf_pass.style.display = "block";
       document.getElementById('pass_changed').value = 'yes';

   }else{
        pass.style.display = "none";
       conf_pass.style.display = "none";
       document.getElementById('pass_changed').value = 'no';
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
    .rs1-wrap-input100, .rs2-wrap-input100 {
        width: 85% !important;
    }
    #pay_type,#type,#sub_type{
        height: 50px !important;
    }
    .rs2-wrap-input100 {
        border-left: 1px solid #e6e6e6 !important;
    }
    .new_user{
            width: 50%;
    }
    .validate-input{
         margin-left: 114px;
    }
    input.input100 {
  height: 35px;
}
label {
    font-weight: 400;
    margin-bottom: -20px;
    margin-top: 1px;
    font-size: 16px;
}

.titledetail {
    text-align: center;
    margin-bottom: 30px;
}

.userLabel {
    font-style: oblique;
    font-size: 20px;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
<!-- Page wrapper  -->

<style>
    .card {
        margin: 15px 200px;
    }
</style>
<!-- Page wrapper  -->
<div class="page-wrapper">


    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">User</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User Management</li>
            </ol>
        </div>
    </div>

   <div class="row">
        <div class="col-lg-12">
            <div class="card new_user" style="margin:15px 350px;">
               <div class="card-body">
               <div class="error_reported">
						<?php
							if($this->session->flashdata('register_success')){
							    $testing = $this->session->flashdata('register_success');
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
		    <div class="titledetail"> <h3>  User Details </h3> </div>
			<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
		<label class="userLabel">Subscriptions</label>

					<?php

					if($subs){
					    foreach($subs as $s_val){

 					  echo "<div class='titlesubs'>   $s_val[title]    </div>" ;


 					     }
 					 }else{

 					  echo "<div class='titlesubs'>No subscriptions Found</div>" ;
 					 } ?>

		</div>



		<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
						<label class="userLabel">Add-Ons</label>


			<?php
					if($addons){
					    $a = 1 ;
					    foreach($addons as $a_val){

 					  echo "$a.<div class='titlesubs'> $a_val[title] </div><br>" ;


 					 $a++ ;    }
 					 }else{

 					  echo "<div class='titlesubs'>No Add-ons Found</div>" ;
 					 } ?>

		</div>


            </div>
                <div class="card-body">
<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/user/update_user" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">


					

      <?php foreach ($user_detail as $value) {


					?>

    <input type="hidden" name="id" value="<?php echo $value['ID'];?>">
        <input type="hidden" name="pass_changed" id="pass_changed" value="no">
        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">
                         <label><h4><strong>Account Status</strong></h4></label>
                            <fieldset id="user_account_radios" style="border: none">
        <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" id="account_status" name="account_status" value="active">&nbsp;&nbsp;Active
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="account_status" name="account_status" value="suspended">&nbsp;&nbsp;Suspended
    </label>
    </fieldset>

                        </div>
				   <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user firstname">
				       	<?php echo form_label('Firstname', '');?>
						<input value="<?php if(!empty($value['firstname'])){ echo $value['firstname']; } ?>" id="firstname" class="input100 form-control" type="text" name="firstname" placeholder="">
						<span class="focus-input100"></span>
					</div>
                                         
					<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user lastname">
					    <?php echo form_label('Lastname', '');?>
						<input value="<?php if(!empty($value['lastname'])){ echo $value['lastname']; } ?>" id="lastname" class="input100 form-control" type="text" name="lastname" placeholder="">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type username">
					    <?php echo form_label('Username', '');?>
						<input value="<?php if(!empty($value['username'])){ echo $value['username']; } ?>" id="username" class="input100 form-control" type="text" name="username" placeholder="">
						<span class="focus-input100"></span>
					</div>
					<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user email">
					    <?php echo form_label('Email', '');?>
						<input value="<?php if(!empty($value['email'])){ echo $value['email']; } ?>" id="email" class="input100 form-control" type="text" name="email" placeholder="">
						<span class="focus-input100"></span>
					</div>
					
					<!--
					<?php echo form_label('Address', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user address" style="width:100%">
						<input value="<?php if(!empty($value['address'])){ echo $value['address']; } ?>" id="address" class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100"></span>
					</div>


					<?php echo form_label('Phone', '');?><div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user contact number">
						<input value="<?php if(!empty($value['phone'])){ echo $value['phone']; } ?>" id="phone" class="input100" type="text" name="phone" placeholder="Contact Number">
						<span class="focus-input100"></span>
					</div>
					<?php echo form_label('Location', '');?><div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type user nation">
						<input value="<?php if(!empty($value['location'])){ echo $value['location']; } ?>" id="loaction" class="input100" type="text" name="location" placeholder="Nation">
						<span class="focus-input100"></span>
					</div>
					 -->
                     <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user firstname">
				       	<?php echo form_label('Domain Builds Available', '');?>
						<input value="<?php if(!empty($value['allowed_domains'])){ echo $value['allowed_domains']; } ?>" id="allowed_domains" class="input100 form-control" type="text" name="allowed_domains" placeholder="0">
						<span class="focus-input100"></span>
					</div>
					<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user password">

                    <input id="change_pass" type="checkbox" class="form-group"style="transform: scale(1.4)" onchange="checkChange(this)">&nbsp;&nbsp;&nbsp;<?php echo form_label('Change Password', '');?>
					</div>
                    <div id="pass" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" style="display: none;" data-validate="Type user password">
                        <?php echo form_label('New Password', '');?>
						<input value="" id="passwordc" class="input100 form-control" type="text" name="passwordc" placeholder="">
						<span class="focus-input100"></span>
					</div>

                    <div id ="conf_pass" style="display: none;" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user confirm password">
                        <?php echo form_label('Confirm pass', '');?>
						<input value="" id="confirmpassword" class="input100 form-control" type="text" name="confirmpassword" placeholder="">
						<span class="focus-input100"></span>
					</div>
                     <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user password">

                    <input id="trial_mode" name="trial_mode" type="checkbox" class="form-group"style="transform: scale(1.4)">&nbsp;&nbsp;&nbsp;<?php echo form_label('Trial Mode', '');?><br><p>Grants full account access for time period specified. Afterward, account status will revert to Demo.</p>
					</div>
                    <div id="trial_days" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user password">
                        <?php echo form_label('Trial Days Remaining', '');?>
						<input value="<?php if(!empty($trial_days['days'])){ echo $trial_days['days']; }else{ echo '0';} ?>" id="trial_days_left" class="input100 form-control" type="text" name="trial_days_left" placeholder="">
						<span class="focus-input100"></span>
					</div>
                    <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">

                    <input id="never_suspend" name="never_suspend" type="checkbox" class="form-group"style="transform: scale(1.4)">&nbsp;&nbsp;&nbsp;<?php echo form_label('Never Suspend Account', '');?><br><p>Once subscription runs out this option will prevent the user account from being suspended and domains deleted. No builds allowed however sites will keep being hosted. (for use with grandfathered members)</p>
					</div>
					<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
				       	<?php echo form_label('Subscription Discount (%)', '');?><br><p>Grants the user a subscription discount in the specified amount. Disounts will be applied on the 'Upgrade Membership' tab.</p>
						<input value="<?php if(!empty($value['discount'])){ echo $value['discount']; } ?>" id="discount" class="input100 form-control" type="text" name="discount">
						<span class="focus-input100"></span>
					</div>
                                        <?php }?>
					<div class="container-login100-form-btn" style="padding-bottom:40px;">
						<button class="login100-form-btn">
							Update User
						</button>
					</div>

				</form>
                </div>


        </div>
    </div>
</div>
</div>

<?php $this->load->view("admin/common/footer.php"); ?>