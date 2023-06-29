<?php
/*echo "<pre>";
print_r($user_credentials);
echo "</pre>";
exit();*/

$access_key=$secret_key=$affiliate_tag=$google_api=$proxy_crawl=$price_domain_credit=$domain_hold=$demo_domain=$demo_user=$demo_expire=$demo_pass='';
if(!empty($build_credentials)){
	$access_key = $build_credentials[0]->access_key;
    $google_api = $build_credentials[0]->google_api;
	$secret_key = $build_credentials[0]->secret_key;
	$affiliate_tag = $build_credentials[0]->affiliate_tag;
    $price_domain_credit = $build_credentials[0]->domain_credit;
    $domain_hold = $build_credentials[0]->hold_time;
    $proxy_crawl = $build_credentials[0]->proxy_crawl;
    $demo_pass = $build_credentials[0]->demo_cpanel_pass;
    $demo_user = $build_credentials[0]->demo_cpanel_user;
    $demo_domain = $build_credentials[0]->demo_domain;
    $demo_expire = $build_credentials[0]->demo_expire;
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Build Settings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Build Settings</li>
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
                    <h3>Global Build Settings</h3><p>These settings will affect the site deployment options and article prices.</p>
							<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/add" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

								<div class="form-group rs1-wrap-input100 validate-input m-b-20" style="width:100%;"  data-validate="Enter Amazon API Key">
							<label><h4> <strong>Amazon API Key </strong></h4><p>Global Access Key used for adding products to the websites</p></label>

									<input value="<?php echo $access_key; ?>" id="access_key" class="input100 form-control" type="text" name="access_key" placeholder=""><span class="focus-input100"></span>

                            </div>

						<div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Amazon Access Key">
						 <label><h4> <strong>Amazon Secret Key </strong></h4></label>

                         <input value="<?php echo $secret_key; ?>" id="secret_key" class="input100 form-control" type="text" name="secret_key" placeholder=""><span class="focus-input100"></span>
						</div>

						<div class="form-group  rs1-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Amazon Affiliate Tag">
						 <label><h4> <strong>Amazon Affiliate Tag </strong></h4><p>Global affiliate tag used when populating products. This will be replaced by users own tag during site deployment.</p></label>
							<input value="<?php echo $affiliate_tag; ?>" id="affiliate_tag" class="input100 form-control" type="text" name="affiliate_tag" placeholder="">
							<span class="focus-input100"></span>
						</div>

                        <div class="form-group rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Google API Key">
						  <label><h4> <strong>Google YouTube API Key </strong></h4><p>Google API Key used to add YouTube videos to the product pages.</p></label>
							<input value="<?php echo isset($google_api) ? $google_api : ''  ; ?>" id="google_api" class="input100 form-control" type="text" name="google_api" placeholder="Google YouTube API Key"><span class="focus-input100"></span>
						</div>

                         <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
						 <label><h4> <strong>Domain Credit Cost </strong></h4><p>The price a user will be charged per domain credits which allow them to handpick a domain from the inventory.</p></label>
							<input value="<?php echo $price_domain_credit; ?>" id="domain_credit" class="input100 form-control" type="text" name="domain_credit" placeholder="">
							<span class="focus-input100"></span>
						</div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
						 <label><h4> <strong>Domain Reserve Time (in hours) </strong></h4><p>The amount of time a domain name will be reserved once it has been assigned to a user. After the time is passed the domain will be released back into inventory if it has not been built.</p></label>
							<input value="<?php echo $domain_hold; ?>" id="domain_hold" class="input100 form-control" type="text" name="domain_hold" placeholder="">
							<span class="focus-input100"></span>
						</div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
						 <label><h4> <strong>Proxy Crawl API</strong></h4><p>Used to search Amazon via a proxy server.</p></label>
							<input value="<?php echo $proxy_crawl; ?>" id="proxy_crawl" class="input100 form-control" type="text" name="proxy_crawl" placeholder="">
							<span class="focus-input100"></span>
						</div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;">
						 <label><h4> <strong>Demo Domain</strong></h4><p>Domain to build the demo subdomains on. (must be a domain on the same server as PhaseBuilder.com)</p></label>
							<input value="<?php echo $demo_domain; ?>" id="demo_domain" class="input100 form-control" type="text" name="demo_domain" placeholder="">
							<span class="focus-input100"></span>
						</div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
						 <label><h4> <strong>Demo Cpanel Username</strong></h4></label>
							<input value="<?php echo $demo_user; ?>" id="demo_user" class="input100 form-control" type="text" name="demo_user" placeholder="">
							<span class="focus-input100"></span>
						</div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
						 <label><h4> <strong>Demo Cpanel Password</strong></h4></label>
							<input value="<?php echo $demo_pass; ?>" id="demo_pass" class="input100 form-control" type="text" name="demo_pass" placeholder="">
							<span class="focus-input100"></span>
						</div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" >
						 <label><h4> <strong>Demo Expire Time (in hours)</strong></h4><p>Amount of hours a demo site remains running before it is removed from the system.</p></label>
							<input value="<?php echo $demo_expire; ?>" id="demo_expire" class="input100 form-control" type="text" name="demo_expire" placeholder="">
							<span class="focus-input100"></span>
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