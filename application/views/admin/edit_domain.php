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
                    <h3 class="text-primary">Edit Domain</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Domain</li>
                        <li class="breadcrumb-item active">Edit Domain</li>
                    </ol>
                </div>
            </div>
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Edit domain</h2>
			
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
							if($this->session->flashdata('updated_success')){
								echo $this->session->flashdata('updated_success');
								?>
									<script>
									setTimeout(function()
									{
										jQuery(".error_reported").html("");
										jQuery(".error_reported").hide("slow");
									},3000);
									</script>
						<?php
							} ?>
						
					</div>
				<form enctype="multipart/form-data" class="login100-form validate-form register-form" id="edit_domain"  action="<?php echo $this->config->base_url(); ?>admin/domain/update_domain" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
			<?php  if($domains){ foreach($domains as $dval){   ?>

                <div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription Id">
                <h2><?php echo $dval['domain']; ?></h2>
				<input type="hidden" value="<?php echo  $dval['id'] ? $dval['id'] : ""    ; ?>" name="domain_id">

				<input type="hidden" value="<?php echo  $dval['domain'] ?  $dval['domain'] :  ""; ?>" id="domain_name" class="input100 form-control" type="text" name="domain" ><span class="focus-input100"></span>

				</div>
						<label> Nameserver 1 </label>
						<div class="form-group wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type subscription title">
							<input value="<?php echo  $dval['ns1'] ? $dval['ns1'] :  ""  ; ?>" id="ns1" class=" form-control" type="text" name="ns1" placeholder="ns1"><span class="focus-input100"></span>
						</div>

                          <label> Nameserver 2 </label>
						<div class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type subscription subtitle">
							<input value="<?php echo  $dval['ns2'] ?  $dval['ns2'] : ""; ?>" id="ns2" class=" form-control" type="text" name="ns2" placeholder="ns2">
							<span class="focus-input100"></span>
						</div>
                        <label> Domain Status </label>
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select payment type">
							<select name="status" id="status" class="form-control">
								<option value="">Status</option>
								

					<option <?php echo 	($dval['status'] == 'active' ? "selected" : false);	?>			 value="active">Active</option>
					<option <?php echo 	($dval['status'] == 'inactive' ? "selected" : false);	?>		 value="inactive">Inactive</option>
                     <option <?php echo 	($dval['status'] == 'taken' ? "selected" : false);	?>		 value="taken">Taken</option>
							</select>
							<span class="focus-input100"></span>
						</div>		
						<label> Assign Client </label>
						<div class="form-group wrap-input100 rs2-wrap-input100 " data-validate="Select duration">
							
							<select name="assignedto" id="assignedto" class="form-control">
								<option value="">Select client</option>
							<?php    
							if($users){
									$a_user	=	$dval['user_id'] ? $dval['user_id'] :  "" ;
								if($a_user){
									echo "<option selected value='$a_user' >".$dval['username']." - ".$dval['firstname']." ".$dval['lastname']." </option>"	 ;
										}
							
							foreach($users as $uval){
								if($uval['ID'] != $dval['user_id']){
							echo "<option selected value='".$uval['ID']."' >".$uval['username']." - ".$uval['firstname']." ".$uval['lastname']." </option>"	 ;

								}				
								} }
							?>	
							</select>
							<span class="focus-input100"></span>
						</div>		
					<?php   }  // main forloop
				}	// main  if	?>	
						<div class="container-login100-form-btn" style="padding-bottom:40px;">
							<button class="login100-form-btn">
								Update Domain
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