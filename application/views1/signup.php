<?php $this->load->view("common/header.php");?>
<style>
.form-group{
	float: left;
}
.alert{
float: left;
width: 100%;
}
</style>
<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
     <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
		
                    <div class="col-lg-7">
                        <div class="login-content card">
                            <div class="login-form">
							<div class="card-header" style="background-color:#5c4ac7; margin-bottom:20px;">
                                <h4 class="m-b-0 text-white">Welcome to join us</h4>
                            </div>
                                
                                <div class="error_reported col-md-12">
                                	<?php echo validation_errors(); ?>
                                		
                                </div>
                                
                                <div class="error_reported col-md-12">
                                	<?php 
                                		if($this->session->flashdata('register_success')){
                                			echo $this->session->usderdata('register_success');
                               		}
                                	?>
                                </div>	
                                <form method="post" action="<?php echo base_url();?>vlogger/login/register">
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> ID</label>
                                        <input type="text" name="signup_id" value="<?php if(!empty($_POST['signup_id'])){ echo $_POST['signup_id']; } ?>" class="form-control" placeholder="ID or email" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Shorten ID:</label> <button type="button"  alt=" 5 letters and uniquness" >Confirm</button>
                                        <input type="text" name="name_initial" value="<?php if(!empty($_POST['name_initial'])){ echo $_POST['name_initial']; } ?>" class="form-control" maxlength="5" size="5" placeholder="Shorten ID (5 Letters)" required>
                                    </div>									
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> User Name</label>
                                        <input type="text" name="user_name" value="<?php if(!empty($_POST['user_name'])){ echo $_POST['user_name']; } ?>" class="form-control"  required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Email</label>
                                        <input type="email" name="email" value="<?php if(!empty($_POST['email'])){ echo $_POST['email']; } ?>" class="form-control" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Confirm Password</label>
                                        <input type="password" name="confirm_pass" class="form-control"  required>
                                    </div>
<!--						
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span>YouTube Channel</label>
                                        <input type="text" name="channel" value="<?php if(!empty($_POST['channel'])){ echo $_POST['channel']; } ?>" class="form-control" placeholder="Channel">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Main Video</label>
                                        <input type="text" name="main_video" value="<?php if(!empty($_POST['main_video'])){ echo $_POST['main_video']; } ?>" class="form-control" placeholder="YouTude video ID (11 letters)">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Language</label>
                                        <input type="text" name="language" value="<?php if(!empty($_POST['language'])){ echo $_POST['language']; } ?>" class="form-control" placeholder="Language" >
                                    </div>									
                                    <div class="form-group col-md-12">
                                        <label><span class="text-danger">*</span> Nation</label>
                                        <input type="text" name="nation" value="<?php if(!empty($_POST['nation'])){ echo $_POST['nation']; } ?>" class="form-control" placeholder="Nationality">
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label>Location</label>
                                        <input type="hidden" name="location" value="<?php if(!empty($_POST['location'])){ echo $_POST['location']; } ?>" class="form-control" placeholder="Location" >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Address</label>
                                        <input type="hidden" name="address" value="<?php if(!empty($_POST['address'])){ echo $_POST['address']; } ?>" class="form-control" placeholder="Address" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Contact Number</label>
                                        <input type="hidden" name="tel" value="<?php if(!empty($_POST['tel'])){ echo $_POST['tel']; } ?>" class="form-control" placeholder="Contact" >
                                    </div>									
                                    <div class="form-group col-md-12">
                                        <label>Gender</label>
                                        <input type="hidden" name="gender" value="<?php if(!empty($_POST['gender'])){ echo $_POST['gender']; } ?>" class="form-control" placeholder="Location" >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Field Work</label>
                                        <input type="hidden" name="work" value="<?php if(!empty($_POST['work'])){ echo $_POST['work']; } ?>" class="form-control" placeholder="Field Work" >
                                    </div>
-->
                                    <div style="clear: both" class="checkbox col-md-12">
                                        <label>
										<input type="checkbox" name="agree" required> Agree the <a target="_blank" href="<?php echo base_url() ?>terms-policy/terms.txt">terms and policy</a>
									</label>
                                    </div>
									
									
                                    <div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register A Vlogger</button>
									</div>
                                    <div class="register-link m-t-15 text-center">
                                        <p>Already have account ? <a href="<?php echo base_url();?>vlogger/login"> Sign in</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="<?php echo base_url();?>js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url();?>js/lib/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url();?>js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url();?>js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url();?>js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url();?>js/custom.min.js"></script>



</body></html>