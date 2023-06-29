<?php
if (isset($this->session->userdata['ID'])) {

$name  = $this->session->userdata['name'];
$email  = $this->session->userdata['email'];

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");

$api_notice = $this->session->userdata('api_notice');
$this->session->set_userdata(array('api_notice' => 1));


?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="<?php echo $this->config->base_url(); ?>video/css/vp2_html5_rightSidePlaylist.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>video/js/jquery.mousewheel.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url(); ?>video/js/jquery.touchSwipe.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url(); ?>video/js/vp2_html5_rightSidePlaylist.js" type="text/javascript"></script>
<script src="<?php echo $this->config->base_url(); ?>video/js/screenfull.min.js" type="text/javascript" charset="utf-8"></script>
<!-- must have -->

<script>
$(function() {

$('#vp2_html5_rightSidePlaylist_UB').vp2_html5_rightSidePlaylist_Video({
skin: 'universalWhite',
seekBarAdjust:240,
borderWidth: 3  

});


});
</script>
 <style>
 .nosee{
  background: transparent;
    border: none !important;
    font-size:0;
    display:none;

 }
 .blockit { color: black; font-size: 70px; line-height: 74px; font-weight: 700; margin: 0 5px 24px; padding: 10px; margin: 0 5px 24px; /*font-family: 'Libre Baskerville', serif;*/padding-top: 20px;
    padding-bottom: 50px; }
 </style>
   <!-- Page wrapper  -->
   <div id="dialogoverlay"></div>
   <div id="dialogbox"></div>
   <div>
       <div id ="dialoghead"></div>
       <div id ="dialogbody"></div>
       <div id ="dialogfoot"></div>
   </div>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                                        <center><h2>Welcome To Phase Builder, <?php echo $name; ?>!</h2></center><br />

                                    </header>


<?php


   if($subscription){
     ?>
     <div class="desc">
         <h4>Current Subscription: <?php echo $subscription ;  ?> (<?php  echo ($this->session->userdata('account_status') == "Good") ? "<font color='green'>Active</font>" : "<font color='red'>".$this->session->userdata('profile_status')."</font>";  ?>)</h4>
                                    </div>


                                    <?php
    if($this->session->userdata('account_status') == "Good"){
?>

	<p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" id="upgrade_btn" class="btn btn-success demo" style="background-color: #1e7e34;border-color: #1c7430;">Upgrade / Downgrade</a></p>
	<?php }else if($this->session->userdata('account_status') == "Cancelled"){ ?>
   <center><p><font color="red">ATTENTION!</font> <font color="black">Your Subscription Is Inactive And your Account Will Be Suspended At The End Of The Current Billing Cycle: <?php echo date('m-d-Y',strtotime($this->session->userdata('next_bill_date'))); ?></p><p>If you do you not wish to build anymore sites using the Phase Builder system but would like us to host your sites so they remain active, sign up for a 'hosting only' package <a href="http://phasebuilder.com/membershipkc/Subscription"><font color="blue">HERE</font></a>.</font></p></center>
	<br /><p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;"> Buy Subscription</a></p>
  <?php }else if($this->session->userdata('account_status') == "Suspended"){ ?>
     <center><p><strong><font color="red">Your Subscription Is Inactive And Your Account And Your Domains Have Been Suspended.</font></strong></p><p>If you do not choose a subscription to continue using Phase Builder by <?php echo date('m-d-Y',strtotime($this->session->userdata('suspended_end_date'))); ?>, your account and domains will be removed from the system.</p><p>If you wish to move your domains off of the Phase Builder platform and onto your own servers send in a ticket to support.</p></center>
	<br /><br /><p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;"> Buy Subscription</a></p>
  <?php }
    }else{



      ?>  <center><h2>Watch The Video Below To See What Phase Builder Can Do For You!</h2><!--<video width="768" height="432" controls id="video2"><source src="<?php echo $this->config->base_url(); ?>video/phasebuilder.mp4" type="video/mp4"></video></center>--><br>
      <!--HTML player -->
    <div><img src="<?php echo $this->config->base_url(); ?>images/800px_COLOURBOX10166060.png" alt="" style="float: left;margin-top: 200px;margin-left: 22px;"/>
    <div class="">
<div class="vp2_html5_rightSidePlaylist">

<video id="vp2_html5_rightSidePlaylist_UB" width="768" height="432" preload="auto">

<div class="xplaylist">

<ul>
<li class="xtitle">Earn With Phase Builder</li>
<li class="xthumb"><?php echo $this->config->base_url(); ?>video/videos/thumbs/pb-welcome.jpg</li>
<li class="xsources_mp4"><?php echo $this->config->base_url(); ?>video/phasebuilder.mp4</li>
</ul>
<!--<ul>
<li class="xtitle">Income Proof</li>
<li class="xthumb"><?php echo $this->config->base_url(); ?>video/videos/thumbs/pb-welcome.jpg</li>
<li class="xsources_mp4"><?php echo $this->config->base_url(); ?>video/phasebuilder.mp4</li>
</ul>  -->
<ul>
<li class="xtitle">Creating A Website</li>
<li class="xthumb"><?php echo $this->config->base_url(); ?>video/videos/thumbs/creating.jpg</li>
<li class="xsources_mp4"><?php echo $this->config->base_url(); ?>video/createwebsite.mp4</li>
</ul>
<!--<ul>
<li class="xtitle">Creating An Article</li>
<li class="xthumb"><?php echo $this->config->base_url(); ?>video/videos/thumbs/pb-welcome.jpg</li>
<li class="xsources_mp4"><?php echo $this->config->base_url(); ?>video/phasebuilder.mp4</li>
</ul> -->


</div>

</video>
</div></div>
</div> <!-- border -->

<br style="clear:both;"></center>
    <!-- HTML player end -->
      <!-- TESTIMONIALS START -->
         <center><h2 class="blockit">Customers Are Loving Their Results</h2></center>
        <div  style="/*background: linear-gradient(0deg, #f2f2f2, #ff4a4a 100%) no-repeat;*/">
         <div class="responsive-testimonals responsive-testimonals--layout-row">

                <div class="responsive-testimonals__list">
                    <div class="responsive-testimonals__item responsive-testimonals__item--layout-order-2 responsive-testimonals__item--align-aside-center" style="margin-left: 250px;margin-right: 250px;/* flex-basis:20%; */">
                        <div class="responsive-testimonals__aside">
                            <div class="responsive-testimonals__img-box responsive-testimonals__rounded-full">
                                <img class="responsive-testimonals__img responsive-testimonals__rounded-full" src="<?php echo $this->config->base_url(); ?>main/images/Adam_720.jpg" width="142" height="142" alt="">
                            </div>
                        </div>
                        <div class="responsive-testimonals__content responsive-testimonals__rounded-4" style="background-color: #eee;">
                            <div class="responsive-testimonals__content-body">
                                <div class="responsive-testimonals__title">Adam Tansey</div>
                                <div class="responsive-testimonals__subtitle" style="font-style: italic;">ENG Operator</div>
                                <div class="responsive-testimonals__desc">
                                   I've been a Phase Builder customer for a few months and the customer service is top notch. My sites earnings are increasing monthly and the simplicity of this platform makes creating my affiliate websites a breeze.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="responsive-testimonals__item responsive-testimonals__item--layout-order-1 responsive-testimonals__item--align-aside-center" style="margin-left: 250px;margin-right: 250px;/* flex-basis:20%; */">
                        <div class="responsive-testimonals__aside">
                            <div class="responsive-testimonals__img-box responsive-testimonals__rounded-full">
                                <img class="responsive-testimonals__img responsive-testimonals__rounded-full" src="<?php echo $this->config->base_url(); ?>main/images/erikchavez.jpg" width="142" height="142" alt="">
                            </div>
                        </div>
                        <div class="responsive-testimonals__content responsive-testimonals__rounded-4"style="background-color: #eee;">
                            <div class="responsive-testimonals__content-body">
                                <div class="responsive-testimonals__title">Erik Chavez</div>
                                <div class="responsive-testimonals__subtitle"style="font-style: italic;">Administrator</div>
                                <div class="responsive-testimonals__desc">
                                    Phase Builder does an amazing job at building websites. The sites look just as good if not better than other services I have used in the past and the customer support is always quick to answer any questions. A handful of my sites are now reaching the $50 a month in earnging and I can't wait to watch my income grow as I continue building. This service is wroth every penny.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="responsive-testimonals responsive-testimonals--layout-row">

                <div class="responsive-testimonals__list">
                     <div class="responsive-testimonals__item responsive-testimonals__item--layout-order-2 responsive-testimonals__item--align-aside-center" style="margin-left: 250px;margin-right: 250px;/* flex-basis:20%; */">
                        <div class="responsive-testimonals__aside">
                            <div class="responsive-testimonals__img-box responsive-testimonals__rounded-full">
                                <img class="responsive-testimonals__img responsive-testimonals__rounded-full" src="<?php echo $this->config->base_url(); ?>main/images/tammy.jpg" width="142" height="142" alt="">
                            </div>
                        </div>
                        <div class="responsive-testimonals__content responsive-testimonals__rounded-4"style="background-color: #eee;">
                            <div class="responsive-testimonals__content-body">
                                <div class="responsive-testimonals__title">Tammy McKinley</div>
                                <div class="responsive-testimonals__subtitle"style="font-style: italic;">Administrative Assistant</div>
                                <div class="responsive-testimonals__desc">
                                    I currently have 9 websites and they have generated 22 orders in my Amazon Associates account. I couldn't be happier, thank you PB!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="responsive-testimonals__item responsive-testimonals__item--layout-order-1 responsive-testimonals__item--align-aside-center" style="margin-left: 250px;margin-right: 250px;/* flex-basis:20%; */">
                        <div class="responsive-testimonals__aside">
                            <div class="responsive-testimonals__img-box responsive-testimonals__rounded-full">
                                <img class="responsive-testimonals__img responsive-testimonals__rounded-full" src="<?php echo $this->config->base_url(); ?>main/images/tonyw.jpg" width="142" height="142" alt="">
                            </div>
                        </div>
                        <div class="responsive-testimonals__content responsive-testimonals__rounded-4"style="background-color: #eee;">
                            <div class="responsive-testimonals__content-body">
                                <div class="responsive-testimonals__title">Tony Weathers</div>
                                <div class="responsive-testimonals__subtitle"style="font-style: italic;">Pest Control Technician</div>
                                <div class="responsive-testimonals__desc">
                                    I joined the Phase Builder platform a little over a month ago and my site is already making me $3 - $5 a day and I haven't done anything with the site. No SEO, no social media posting, no effort on my end. I can't wait until I have 100 of these!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
           <!-- TESTIMONIALS END -->
    <div class="container-login100-form-btn" style="padding-bottom:40px;padding-top:40px;"><p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;font-size: 2rem;">Upgrade And Start Building Now!</a></p></div>

	<?php  }?>
                                    <div>
                                        <center><a href="support" id="support"><i class="fa fa-envelope fa-2"></i> Need Support? Shoot Us A Message!</a></center>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>



                <div class="row" style="margin-left: 70px;">
                    <div class="col">
                        <div class="card" style="float: left; margin-right: 20px; width:30%;">
                                                        <div class="card-title">
                                                                <h4>Builds</h4>
                                                        </div>
                                                            <div class="card-body" style="margin-right: -70px;">
                                                                <div class="current-progress">


                                                                        <div class="progress-content">
                                                                                <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                                <div class="progress-text">Builds Used</div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                                <div class="">
                                                                                                        <div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <?php echo $total_domains ? $total_domains[0]['total'] : '0' ; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <div class="progress-content">
                                                                                <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                                <div class="progress-text">Builds Available</div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                                <div class="">
                                                                                                        <div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <?php echo $total_domains ? $total_domains[0]['allowed'] : '0' ; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>
                                                </div>
                        <div class="card" style="float: left; margin-right: 20px; width:30%;">
                            <div class="card-title">
                                <h4>Articles</h4>
                            </div>
                              <div class="card-body" style="margin-right: -70px;">
                                <div class="current-progress">


                                    <div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Total</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $article_info ? $article_info['article_stats']['total'] : '' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Queued</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $article_info ? $article_info['article_stats']['queued'] : '' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Waiting Review</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $article_info ? $article_info['article_stats']['review'] : '' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="float: left; margin-right: 20px; width:30%;">
                            <div class="card-title">
                                <h4>Tickets</h4>
                            </div>
                              <div class="card-body" style="margin-right: -70px;">
                                <div class="current-progress">


                                    <div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Total</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $tickets ? $tickets[0]['total'] : '' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Open</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $tickets ? $tickets[0]['open'] : '' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    </div>
<?php
$this->load->view("common/footer.php");
} else {
   header("location: login");
}
?>
<script>
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

 var beenNotified = <?php echo $api_notice; ?>;
 var fLogin = <?php echo $this->session->userdata['first_login']; ?>;
  var isDemo = '<?php echo $this->session->userdata('account_status'); ?>';
  var hasCreds = <?php echo $this->session->userdata('has_cred'); ?>;
 //alert(fLogin);
 if(fLogin == 0 && isDemo != 'Demo'){
      $.confirm({
      smoothContent: true,
    columnClass: 'col-md-5',
    title: 'Welcome!',
    content: '<center><img src="<?php echo $this->config->base_url(); ?>/images/worker-hello.png"></center>'+'<p>Welcome to Phase Builder, since this is your first time here let\'s take a quick tour and get you acquainted with our system. </p><br><br>',
                            theme: 'modern',
                            closeIcon: false,
                            animation: 'scale',
                            type: 'blue',
    buttons: {
       'confirm': {
                                    text: 'OK!, Let\'s Go!',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                           welcomeTour();

                                    }
                                }

    }
});
}
if(isDemo == 'Demo' && hasCreds == 0){
      $.confirm({
    title: 'Let\'s Set Up Your Account!',
    content: '<h3>Add Your Amazon Details Below.</h3><br>' +
    '<form action="" class="formName"><input type="hidden" class="user_id" name="user_id" id="user_id" value="<?php echo $this->session->userdata('ID'); ?>">' +

                           '<input id="use_backup_keys" class="use_backup_keys" style="float: left;" name="use_backup_keys" type="checkbox" onchange="checkKeys(this)"><span style="float: left;">&nbsp;I don\'t have Amazon API Keys</span>'+
                            '<br><div class="form-group  rs2-wrap-input100  m-b-20" id="access_key_tour" style="width:93%;" data-validate="Enter Amazon Access Key" >'+
                            '<label style="float: left;text-align: left;"><h4><strong>Amazon Access Key</strong></h4><p>Need help getting your keys? <a href="https://docs.aws.amazon.com/AWSECommerceService/latest/GSG/GettingStarted.html" target="_blank"><font color="blue">Click Here</font></a></p></label>'+
                                    '<input value="" id="access_key" class="access_key input100 form-control" type="text" name="access_key" placeholder="Amazon API Key"><span class="focus-input100"></span>'+
                                 '</div>'+

                        '<div class="form-group  rs2-wrap-input100  m-b-20" id="secret_key_tour" style="width:93%;" data-validate="Enter Amazon Access Key" >'+
                         '<label style="float: left;text-align: left;"><h4><strong>Amazon Secret Key</strong></h4></label>'+
                            '<input value="" id="secret_key" class="secret_key input100 form-control" type="text" name="secret_key" placeholder="Amazon Access Key"><span class="focus-input100"></span>'+
                        '</div>'+
                        '<div class="form-group  rs1-wrap-input100 validate-input m-b-20" id="affiliate_tag_tour"style="width:93%;">'+
                         '<label style="float: left;text-align: left;"><h4><strong>Amazon Affiliate Tag</strong></h4><p>Your affiliate tag, also known as "Associates ID", is used by Amazon to give you credit for the sale when a visitor makes a purchase from your website.</p></label>'+
                            '<input value="" id="affiliate_tag" class="affiliate_tag input100 form-control" type="text" name="affiliate_tag" placeholder="Amazon Affiliate Tag">'+
                            '<span class="focus-input100"></span>'+
                        '</div>'+
    '</form><br><br><br><br>',
     theme: 'modern',
     boxWidth: '30%',
     useBootstrap: false,
     theme: 'modern',
     type: 'blue',
     bgOpacity: 1,
    buttons: {
        formSubmit: {
            text: 'Submit & Build Demo',

            btnClass: 'btn-blue',

            action: function () {
                var affiliate_tag = this.$content.find('.affiliate_tag').val();
                var access_key = this.$content.find('.access_key').val();
                var secret_key = this.$content.find('.secret_key').val();
                var user_id = this.$content.find('.user_id').val();


                if(!affiliate_tag){
                    $.alert('Please provide affiliate_tag all information.');
                    return false;
                }
                if(!access_key){
                    $.alert('Please provide access_key all information.');
                    return false;
                }
                if(!secret_key){
                    $.alert('Please provide secret_key all information.');
                    return false;
                }
                $.ajax(	{
                   url: 'credential/add_demo_creds',
                    data:{

                    affiliate_tag : affiliate_tag,
            access_key : access_key,
            secret_key: secret_key,
            publisher_id_leader: '',
            publisher_id_sky: '',
            ads_code: '',
            user_id: user_id
             },
                    type: "post",
                    success: function(data){
                         console.log(data);
                           $.confirm({
      smoothContent: true,
   columnClass: 'col-lg-12',
    title: 'We\'re Building Your Demo Site!',
    bgOpacity: 1,
    content: '<h3>While You Wait Watch This Short Video And Learn How Phase Builder Creates You A Passive Income</h3><p><video width="768" height="432" autoplay id="video"><source src="<?php echo $this->config->base_url(); ?>video/phasebuilder.mp4" type="video/mp4"></video></p><br><br>',
                            theme: 'modern',
                            closeIcon: false,
                            animation: 'scale',
                            type: 'blue',

    buttons: {
       'confirm': {
                                    text: '&nbsp;',
                                    btnClass: 'nosee',


                                }

    },
    onContentReady: function () {
        var self = this;
        setTimeout(function () {
              $.confirm({
      smoothContent: true,
      bgOpacity: 1,
    title: 'Your Demo Site Is Ready!',
    content: '<p style="text-align: justify;">Thanks for your patience. Now that you understand how powerful Phase Builder is for building a passive income let\'s take a look at a demo and see what a high converting affiliate site looks like!',
                            theme: 'modern',
                            closeIcon: false,
                            animation: 'scale',
                            type: 'blue',

    buttons: {
       'confirm': {
                                    text: 'Let\'s See It!',
                                    btnClass: 'btn-blue',
                                    action: function(){
                                        window.open('http://demo-32dududv.phasebuilder.com', '_blank');
                                        window.location = "<?php echo $this->config->base_url(); ?>Subscription";
                                    }
                                }

    }
});
        }, 129000);
    },
});

                    }
                    });
            }
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});
}
 var keyCheck = <?php echo $check_key; ?>;
 if(keyCheck == 1 && fLogin == 1 && beenNotified == 0  && isDemo != 'Demo'){
  $.confirm({
      smoothContent: true,
    columnClass: 'col-md-5',
    title: 'No API Keys Yet?',
    content: '<center><img src="<?php echo $this->config->base_url(); ?>images/worker-ok.png"></center>'+'<p style="text-align: justify;">It\'s OK! We\'ve got your covered! You can use our keys until you\'ve generated 3 sales (Amazon\'s requirement).</p><br><p style="text-align: justify;">Amazon requires their affiliates to use their own keys, but don\'t manually verify accounts until they have made 3 sales. So you can use ours for the time being. We\'ll occasionally send you reminders to update your keys just in case you forget. Happy building!</p><br><br>',
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

function welcomeTour(){
    hopscotch.endTour(true);
 //alert(hopscotch.getState());
    // Define the tour!
    var tour = {
            id: "welcome-tour",
            steps: [
             {
                    title: "Tutorial",
                    content: "Before we begin, if you ever get lost you can replay this tutorial by clicking here!",
                    target: "welcome",
                    placement: "right",
                     yOffset: '-15px',
                    xOffset: '-620px'

                },
                {
                    title: "Credentials",
                    content: "This is where you add your website build information such as your Amazon affiliate tag and Google Adsense ID. <br>You\'ll want to do this first thing!",
                    target: "credentials-tour",
                    placement: "right",

                },
                {
                    title: "Builds",
                    content: "This is where you go when you want to build a new website or view all the websites you\'ve already built.",
                    target: "builds-tour",
                    placement: "right",

                },
                {
                    title: "Articles",
                    content: "Inside here you can order researched, high quality, 100% unique articles and also post them to your websites.",
                    target: "articles-tour",
                    placement: "right",

                },
                {
                    title: "My Account",
                    content: "From here you can edit your profile information, view your current subscription, and transaction history.",
                    target: "account-tour",
                    placement: "right",

                },
                {
                    title: "Support",
                    content: "If you ever need any help just click here and shoot us a ticket!",
                    target: "support-tour",
                    placement: "right",

                },
                {
                    title: "Upgrade Membership",
                    content: "You can upgrade, downgrade, and cancel your current subscription from here.",
                    target: "upgrade-tour",
                    placement: "right",

                },
                {
                    title: "Notifications",
                    content: "This your notification area. Whenever you receive a notification this will be blinking red. Just click on the bell icon to view your message!",
                    target: "notification-tour",
                    placement: "left",
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
                {
                    title: "Credentials",
                    content: "Remember, before you can build a site you need to add your credentials. Let's do that now. Go ahead and click the 'Credentials' tab.",
                    target: "credentials-tour",
                    placement: "right",
              showNextButton: false

                }
            ]
        };

        // Start the tour!
        hopscotch.startTour(tour);

}
$(document).ready(function () {
  $('.responsive-testimonals').responsiveTestimonals();
});
</script>
<?php
if($this->session->userdata['first_login'] == 0){
$this->session->set_userdata(array('first_login' => 1));
 }
 ?>
