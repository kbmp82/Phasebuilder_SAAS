<?php
if (isset($this->session->userdata['ID'])) {

$name  = $this->session->userdata['name'];
$email  = $this->session->userdata['email'];

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");

$api_notice = $this->session->userdata('api_notice');
$this->session->set_userdata(array('api_notice' => 1));


?>

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
                                     <div id="welcome" class="desc"><h4>Need Help Getting Started? <a href="javascript:void(0);" onclick="welcomeTour();"><font color="#3366CC">Click Here!</font></a></h4></div>

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



      ?>  <h3 style="margin: 0px;">You are currently in 'Demo' mode. Demo sites will be removed a few days after creation.</h3><br>

	<p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;"> Buy Subscription</a></p>

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
 var keyCheck = <?php echo $check_key; ?>;
 if(keyCheck == 1 && fLogin == 1 && beenNotified == 0){
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

</script>
<?php
if($this->session->userdata['first_login'] == 0){
$this->session->set_userdata(array('first_login' => 1));
 }
 ?>
