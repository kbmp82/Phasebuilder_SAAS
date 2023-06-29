<?php
if (isset($this->session->userdata['ID'])) {
	
$name  = $this->session->userdata['name'];	
$email  = $this->session->userdata['email'];		
$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
?>
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Home</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                       
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
				
		<div class="row">
				<div class="col-lg-12">
                        <div class="card" style="margin:0px !important;">
                            <div class="card-body">
                                <div class="card-two">
                                    <header>
                                        <div class="avatar">
                                            <img src="http://tivratech.in/membershipkc/main/images/users/5.jpg" alt="<?php echo $name; ?>">
                                        </div>
                                    </header>

                                    <h3><?php echo $name; ?></h3>
                                    <div class="desc">
                                        Welcome back ! We are happy to see you.
                                    </div>
	<p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;"> Buy Subscription</a></p>
                                    <div class="contacts">
                                        <a href=""><i class="fa fa-plus"></i></a>
                                        <a href=""><i class="fa fa-whatsapp"></i></a>
                                        <a href="email:<?php echo $email; ?>"><i class="fa fa-envelope"></i></a>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>

<?php
$this->load->view("admin/common/footer.php");
} else {
   header("location: login");
}
?>