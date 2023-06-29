<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");
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
.admin_login{
color: #007bff!important;
}	
</style>
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Current Builds</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>builds">Current Builds</a></li>
                        <li class="breadcrumb-item active"><?php  echo $res[0]['domain']   ;?></li>
                    </ol>
                </div>
            </div>
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Your Website Details</h2>
			
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
			  <div class="row">
				  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="card panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
							<?php if(!empty($res) && $res != 0){ 
							   ?>
                				<div class="col-md-12" style="float: left">
									<h2><?php  echo strtoupper($res[0]['domain'])   ;?></h2>
                                    <p><font color="red">Important:</font> Do not change the admin password on your websites otherwise Phase Builder will not be able to manage them.</p>
                                    <p><h4>Access Details:</h4></p>
                                    <p>Website Homepage: <a class="link" href="http://<?php  echo $res[0]['domain']   ;?>" target="_blank">http://<?php  echo $res[0]['domain']   ;?>/</a></p>
                                    <p>Admin URL: <a class="link" href="http://<?php  echo $res[0]['domain']   ;?>/wp-login.php" target="_blank">http://<?php  echo $res[0]['domain']   ;?>/wp-login.php</a></p>
									<p>Username: <?php echo $res[0]['wp_user'] ;    ?></p>
									<p>Password: <?php echo $res[0]['wp_pass'] ;    ?></p>
								</div>
                			
							<?php }else{ ?>
							<h3>To create your own panel and get your credentials, <a target="_blank" href="<?php echo base_url() ?>subscription/">Click Here</a> to buy subscription.</h3>
							<?php } ?>
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