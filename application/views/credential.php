<?php
/*echo "<pre>";
print_r($user_credentials);
echo "</pre>";
exit();*/

$secret_key=$access_key=$affiliate_tag=$publisher_id_leader=$publisher_id_sky=$ads_code='';
if(!empty($user_credentials)){

	$affiliate_tag = $user_credentials[0]->affiliate_tag;
	$publisher_id_leader = $user_credentials[0]->publisher_id_leader;
    $publisher_id_sky = $user_credentials[0]->publisher_id_sky;
	$ads_code = $user_credentials[0]->ads_code;
    $secret_key = $user_credentials[0]->secret_key;
    $access_key = $user_credentials[0]->access_key;
  
    //$google_api_key = $user_credentials[0]->google_api_key;
}
//$admin_key = $user_credentials[0]->admin_key;

 
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
.login100-form {
    width: 100% !important;
    padding: 0 !important;
}
</style>
<script>

 $("document").ready(function(){
     var using_admin = '<?php echo $using_admin; ?>';
if(document.getElementById("access_key").value != '' && using_admin == "yes"){
    document.getElementById("use_backup_keys").checked = true;
 document.getElementById("access_key").disabled = true;
       document.getElementById("secret_key").disabled = true;
       document.getElementById("access_key").value = 'Phase Builder Keys';
       document.getElementById("secret_key").value = 'Phase Builder Keys';


}
if(document.getElementById("affiliate_tag").value != '' && document.getElementById("affiliate_tag").value == 'demo-20'){
   document.getElementById("affiliate_tag").disabled = true;
       document.getElementById("publisher_id_leader").disabled = true;
       document.getElementById("publisher_id_sky").disabled = true;
       document.getElementById("ads_code").disabled = true;
        document.getElementById("use_demo_check").checked = true;
}
});
function checkSpecial(elem){
   if(elem.checked == true){
       document.getElementById("affiliate_tag").disabled = true;
       document.getElementById("publisher_id_leader").disabled = true;
       document.getElementById("publisher_id_sky").disabled = true;
       document.getElementById("ads_code").disabled = true;
       document.getElementById("affiliate_tag").value = 'demo-20';
       document.getElementById("publisher_id_leader").value = 'Adsense ads would be displayed here!';
       document.getElementById("publisher_id_sky").value = 'Adsense ads would be displayed here!';
       document.getElementById("ads_code").value = 'Amazon ads would be displayed here!';

   }else{
        document.getElementById("affiliate_tag").disabled = false;
       document.getElementById("publisher_id_leader").disabled = false;
       document.getElementById("publisher_id_sky").disabled = false;
       document.getElementById("ads_code").disabled = false;
       document.getElementById("affiliate_tag").value = '<?php echo $affiliate_tag; ?>';
          $('#publisher_id_leader').val('<?php echo str_replace("</script>","<\/script>",trim(preg_replace('/\s\s+/', ' ', htmlspecialchars_decode($publisher_id_leader)))); ?>');
         $('#publisher_id_sky').val('<?php echo str_replace("</script>","<\/script>",trim(preg_replace('/\s\s+/', ' ', htmlspecialchars_decode($publisher_id_sky)))); ?>');
         $('#ads_code').val('<?php echo str_replace("</script>","<\/script>",trim(preg_replace('/\s\s+/', ' ', htmlspecialchars_decode($ads_code))));  ?>');


   }

}
function checkKeys(elem){
   if(elem.checked == true){
        document.getElementById("access_key").disabled = true;
       document.getElementById("secret_key").disabled = true;
       document.getElementById("access_key").value = 'Phase Builder Keys';
       document.getElementById("secret_key").value = 'Phase Builder Keys';
       showPopup();
   }else{
       document.getElementById("access_key").disabled = false;
       document.getElementById("secret_key").disabled = false;
       document.getElementById("access_key").value = '';
       document.getElementById("secret_key").value = '';
   }

}
function showPopup(){
     $.confirm({
      smoothContent: true,
    columnClass: 'col-md-5',
    title: 'No API Keys Yet?',
    content: '<center><img src="<?php echo $this->config->base_url(); ?>images/worker-ok.png"></center>'+'<p style="text-align: justify;">It\'s OK! We\'ve got your covered! You can use our keys until you\'ve generated 3 sales (Amazon\'s requirement).</p><br><p style="text-align: justify;">Amazon requires their affiliates to use their own keys, but don\'t manually verify accounts until they have made 3 sales. So you can use ours for the time being. We\'ll occasionally send you reminders to update your keys just in case you forget. Happy building!</p><p style="text-align: justify;"><br><font color="red">Note:</font> You will still need to add your own affiliate tag. We cannot substitute that for you.</p><br><br>',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
    buttons: {
       'confirm': {
                                    text: 'Okay!',
                                    btnClass: 'btn-blue',

                                }

    }
});
}
</script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Build Credentials</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" >Credentials</li>
                    </ol>
                </div>
            </div>
			
			
<div class="container" id="credentials_page">
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
									},7000);
									</script>
						<?php
                    		}
                    	?>
					</div>
                            <h2>Build Credentials</h2>
							<form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>credential/add" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('ID'); ?>">

                           <input id="use_backup_keys" name="use_backup_keys" type="checkbox" onchange="checkKeys(this)">&nbsp;I don't have Amazon API Keys
                           <p><font color ="red">Important:</font> If you are brand new to the Amazon Affiliate program and have made <strong>less than 3 sales</strong> inside your Amazon Affiliate account, check the 'I don't have Amazon API Keys' box above. Otherwise enter your access and secret keys below.</p>
                            <br><div class="form-group  rs2-wrap-input100  m-b-20" id="access_key_tour" style="width:100%;" data-validate="Enter Amazon Access Key" >
							<label><h4><strong>Amazon Access Key</strong></h4><p>Need help getting your keys? <a href="https://docs.aws.amazon.com/AWSECommerceService/latest/GSG/GettingStarted.html" target="_blank"><font color="blue">Click Here</font></a></p></label>
									<input value="<?php echo $access_key; ?>" id="access_key" class="input100 form-control" type="text" name="access_key" placeholder="Amazon API Key"><span class="focus-input100"></span>
								 </div>

						<div class="form-group  rs2-wrap-input100  m-b-20" id="secret_key_tour" style="width:100%;" data-validate="Enter Amazon Access Key" >
						 <label><h4><strong>Amazon Secret Key</strong></h4></label>
							<input value="<?php echo $secret_key; ?>" id="secret_key" class="input100 form-control" type="text" name="secret_key" placeholder="Amazon Access Key"><span class="focus-input100"></span>
						</div>
                        <?php  if($this->session->userdata('account_status') == "Demo"){ //echo '<div class="form-group  rs1-wrap-input100 validate-input m-b-20" style="width:100%;"><br /><input id="use_demo_check" name="use_demo_check" type="checkbox" onchange="checkSpecial(this)"> Use demo credentials<p>If you dont yet have an Amazon affiliate tag you can test our platform using demo credentials.</p></div>';
                        } ?>
						<div class="form-group  rs1-wrap-input100 validate-input m-b-20" id="affiliate_tag_tour"style="width:100%;">
						 <label><h4><strong>Amazon Affiliate Tag</strong></h4><p>Your affiliate tag, also known as associates ID, is used by Amazon to give you credit for the sale when a visitor makes a purchase from your website.</p></label>
							<input value="<?php echo $affiliate_tag; ?>" id="affiliate_tag" class="input100 form-control" type="text" name="affiliate_tag" placeholder="Amazon Affiliate Tag">
							<span class="focus-input100"></span>
						</div>
                         <!--
                        <div class="form-group rs2-wrap-input100  m-b-20" data-validate="Enter Google API Key">
						  <label> Google Api Key </label>
							<input value="<?php echo isset($google_api_key) ? $google_api_key : ''  ; ?>" id="google_api_key" class="input100 form-control" type="text" name="google_api_key" placeholder="Google Api Key"><span class="focus-input100"></span>
						</div>
                         -->
						<div class="form-group  rs2-wrap-input100  m-b-20" id ="adsense_tour_leader" style="width:100%;" >
						 <label><h4><strong> Adsense 728 x 90 Large leaderboard </strong>(optional)</h4> <p>If you want Google Adsense ads on your website insert your large leaderboard (728 x 90) full html code below.</p></label>
                         <textarea style="border: 1px solid #e6e6e6; padding-top: 12px;" rows="5" id="publisher_id_leader" class="input100" name="publisher_id_leader" placeholder="Adsense Code"><?php echo htmlspecialchars_decode(stripslashes($publisher_id_leader)); ?></textarea>


							<span class="focus-input100"></span>
						</div>
                         <div class="form-group  rs2-wrap-input100  m-b-20" id ="adsense_tour_sky" style="width:100%;">
						 <label><h4><strong> Adsense 160x600 Wide skyscraper </strong>(optional)</h4><p>If you want Google Adsense ads on your website insert your wide skyscraper (160x600) full html code below.</p></label>
                         <textarea style="border: 1px solid #e6e6e6; padding-top: 12px;" rows="5" id="publisher_id_sky" class="input100" name="publisher_id_sky" placeholder="Adsense Code"><?php echo htmlspecialchars_decode(stripslashes($publisher_id_sky)); ?></textarea>


							<span class="focus-input100"></span>
						</div>

						<div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" id="amazon_ads_tour" style="width:100%;"  style="width:100%">
					 <label><h4><strong> Amazon Ads Code</strong> (optional)</h4>Need Your Ads Code? <a href="https://affiliate-program.amazon.com/home/ads/adcode/recommendation" target="_blank"><font color="blue">Click Here!</font></a><p>If you want Amazon ads on your website insert your ad code below (full HTML code) .</p></label>
							<textarea style="border: 1px solid #e6e6e6; padding-top: 12px;" rows="5" id="ads_code" class="input100" name="ads_code" placeholder="Amazon Ads Code"><?php echo htmlspecialchars_decode(stripslashes($ads_code)); ?></textarea>
							<span class="focus-input100"></span>
						</div>

						<div class="container-login100-form-btn" style="padding-bottom:40px;" id="save_tour">
							<button class="login100-form-btn">
								Save Credentials
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
<?php  $this->load->view("common/footer.php"); ?>

<script>
var tour2 = {
            id: "welcome-tour2",
            steps: [
             {
                    title: "Amazon Access Key",
                    content: "This your Amazon access key that you get when you sign up for the Amazon Product API.<br><br>It allows us to pull products from Amazon and populate your website. If you are brand new to the Amazon affiliate program and haven't made any sales yet check the 'I don't have Amazon API Keys' box.",
                    target: "access_key_tour",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                 {
                    title: "Amazon Secret Key",
                    content: "This is the second peice of information from your Amazon API credentials.",
                    target: "secret_key_tour",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                 {
                    title: "Affiliate Tag",
                    content: "This your Amazon affiliate tag. It is how you get credit for all the sales that are generated through your websites.<br><br> If you don't have an affilaite tag yet and just want to see how our platform works you can use the demo credentials by clicking the box labeled 'Use demo credentials'.",
                    target: "affiliate_tag_tour",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                 {
                    title: "Adsense Leader Board Ads",
                    content: "If you want to display Google Adsense on your websites as an extra way to earn, add your full leaderboard (970 x 90) Adsense HTML code in this box.",
                    target: "adsense_tour_leader",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                 {
                    title: "Adsense Sky Scraper Ads",
                    content: "This is your second Adsense ad, add your full skyscraper (160x600) Adsense HTML code in this box.",
                    target: "adsense_tour_sky",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                {
                    title: "Adsense Sky Scraper Ads",
                    content: "If you want to give your site an extra chance to turn visitors into buyers you can add Amazon Ads onto your webpage. Enter the full ads HTML code in this box.",
                    target: "amazon_ads_tour",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                 {
                    title: "Save It!",
                    content: "When you're ready to proceed click 'Save Credentials'.",
                    target: "save_tour",
                    placement: "left",
              showNextButton: false
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
            ]/*,
            onEnd: function(){

                 hopscotch.endTour(false);

            }  */
        };
 if (hopscotch.getState() == "welcome-tour:8") {

         hopscotch.startTour(tour2);

        }else if(hopscotch.getState() == "welcome-tour2:6") {
            window.location.href = "<?php echo base_url() ?>website";
        }

</script>
