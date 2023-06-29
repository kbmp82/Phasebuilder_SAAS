<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
//$this->load->library('javascript/jquery');
?>

<style>
 .blockit { color: black; font-size: 70px; line-height: 74px; font-weight: 700; margin: 0 5px 24px; padding: 10px; margin: 0 5px 24px; /*font-family: 'Libre Baskerville', serif;*/padding-top: 20px;
    padding-bottom: 50px; }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="<?php echo $this->config->base_url(); ?>video/css/vp2_html5_rightSidePlaylist.css" rel="stylesheet" type="text/css">
<!-- Page wrapper  -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
.n_progress {
    align-items: right;
    text-align: right;
}
.hide{
display: none;
}


</style>


<!-- Page wrapper  -->
<div class="page-wrapper">


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




      <!--  <a href="#" onclick="runTest()">CLICK TEST</a>    -->
       <!-- <center><h2>Watch The Video Below To See What Phase Builder Can Do For You!</h2><video width="768" height="432" controls id="video2"><source src="<?php echo $this->config->base_url(); ?>video/phasebuilder.mp4" type="video/mp4"></video></center><br> -->
    <!--HTML player -->
  <!--   <center>><h2>Watch The Videos Below To See What Phase Builder Can Do For You!</h2><br>
    <div><img src="<?php echo $this->config->base_url(); ?>images/800px_COLOURBOX10166060.png" alt="" style="float: left;margin-top: 200px;margin-left: 74px;"/>
    <div class="">
<div class="vp2_html5_rightSidePlaylist">

<video id="vp2_html5_rightSidePlaylist_UB" width="768" height="432" preload="auto">

<div class="xplaylist">

<ul>
<li class="xtitle">Earn With Phase Builder</li>
<li class="xthumb"><?php echo $this->config->base_url(); ?>video/videos/thumbs/pb-welcome.jpg</li>
<li class="xsources_mp4"><?php echo $this->config->base_url(); ?>video/phasebuilder.mp4</li>
</ul>
<ul>
<li class="xtitle">Income Proof</li>
<li class="xthumb"><?php echo $this->config->base_url(); ?>video/videos/thumbs/pb-welcome.jpg</li>
<li class="xsources_mp4"><?php echo $this->config->base_url(); ?>video/phasebuilder.mp4</li>
</ul>
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


 <!--</div>

</video>
</div></div>
</div> <!-- border -->
 <!--
<br style="clear:both;"></center>
    <!-- HTML player end -->
     <!-- TESTIMONIALS START -->
     <!--    <center><h2 class="blockit">Customers Are Loving Their Results</h2></center>
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
        <!--   <div class="container-login100-form-btn" style="padding-bottom:40px;padding-top:40px;"><p style="text-align:center;margin-bottom: 26px;"><a href="<?php echo $this->config->base_url(); ?>subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;font-size: 2rem;">Upgrade And Start Building Now!</a></p></div>

    <!-- Container fluid  -->
            <div class="container-fluid">

                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php   echo $total_revenue ? $total_revenue : '0' ; ?></h2>
                                    <p class="m-b-0">Gross Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php  echo $active_subs ? $active_subs : '0' ;   ?></h2>
                                    <p class="m-b-0">Active Subscriptions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php  echo $active_domain ? $active_domain[0]['total'] : '0' ; ?></h2>
                                    <p class="m-b-0">Total Domains</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $total_users ? $total_users : '0' ;   ?></h2>
                                    <p class="m-b-0">Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="padding-bottom: 100px">
                            <div class="card-title">
                                <h4>Tickets</h4>
                            </div>
                              <div class="card-body">
                                <div class="current-progress">


                                    <div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">New Tickets</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $open_ticket ? $open_ticket[0]['total'] : '0' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Open Tickets</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $open_ticket ? $open_ticket[0]['open'] : '0' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>






                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
             <div class="col-lg-4">
                        <div class="card">
                            <div class="card-title">
                                <h4>Domains</h4>
                            </div>
                            <div class="card-body">
                                <div class="current-progress">


                                    <div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Total Domains</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $active_domain ? $active_domain[0]['total'] : '0' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Active Domains</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $active_domain ? $active_domain[0]['active'] : '0' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


									<div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Inactive Domains</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $active_domain ? $active_domain[0]['inactive'] : '0' ;   ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

									<div class="progress-content">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-text">Held Domains</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="">
                                                    <div class="">
                                                        <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                          <?php echo $active_domain ? $active_domain[0]['held'] : '0' ;   ?>
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
                    <div class="col-lg-4">
                                                <div class="card">
                                                        <div class="card-title">
                                                                <h4>iWriter</h4>
                                                        </div>
                                                        <div class="card-body">
                                                                <div class="current-progress">


                                                                        <div class="progress-content">
                                                                                <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                                <div class="progress-text">Account Balance</div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                                <div class="">
                                                                                                        <div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <?php echo $article_info ? "$".$article_info['projects'][0]['balance'] : '' ;   ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>


                                    <div class="progress-content">
                                                                                <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                                <div class="progress-text">Articles In Queue</div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                                <div class="">
                                                                                                        <div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <?php echo $article_info ? $article_info['projects'][0]['queued'] : '' ;   ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>


                                    <div class="progress-content">
                                                                                <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                                <div class="progress-text">Awaiting Approval</div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                                <div class="">
                                                                                                        <div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <?php echo $article_info ? $article_info['projects'][0]['pending'] : '' ;   ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                    <div class="progress-content">
                                                                                <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                                <div class="progress-text">Completed Articles</div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                                <div class="">
                                                                                                        <div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                    <?php echo $article_info ? $article_info['projects'][0]['completed'] : '' ;   ?>
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


                                                                                    <div class="row">
                                                                                    <?php


foreach($server_info as $server){

 ?>

                    <div class="col-lg-4">
                        <div class="card">
 <div class="card-title">
                                <h4><?php echo $server['alias']; ?></h4><br><span style="font-size:12px">Last Updated:  <?php date_default_timezone_set('US/Eastern'); echo date("m-d \@ g:i a", $last_check);?> - <a style="font-size:12px" href="<?php echo $this->config->base_url(); ?>admin/dashboard/update_server_stats"><font color="blue">Update Now</font></a></span>
                            </div>
                            <div class="progress-content">
                                                                                <div class="row">
 <div class="col-lg-8">
</div>
<div class="col-lg-8">
 <div class="progress-text">Load</div>
</div>
<div class="col-lg-4">
<div class="">
<div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                     <?php echo $server['load']; ?> / <?php echo $server['cores']; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>

                                                                                        <div class="col-lg-8">
 <div class="progress-text">Disk Usage</div>
</div>
<div class="col-lg-4">
<div class="">
<div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                     <?php echo $server['diskusage']; ?>%
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
 <div class="progress-text">Cpanel Accounts</div>
</div>
<div class="col-lg-4">
<div class="">
<div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                     <?php echo $server['cpanel_accounts']; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
 <div class="progress-text">HTTP Status</div>
</div>
<div class="col-lg-4">
<div class="">
<div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                     <?php echo $server['http']; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
 <div class="progress-text">HTTPS Status</div>
</div>
<div class="col-lg-4">
<div class="">
<div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                     <?php echo $server['https']; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="col-lg-8">
 <div class="progress-text">MySQL Status</div>
</div>
<div class="col-lg-4">
<div class="">
<div class="">
                                                                                                                <div class="n_progress" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                                                                                     <?php echo $server['MySQL']; ?>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div><br /><br />

                                                                                </div>
                                                                        </div>

                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->



                 <?php } ?>
                 </div>
				  <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Growth Metrics</h4>
                            </div>
                            <div class="flot-container">
                                <div id="totalRevenue" style="width:800px; height: 300px;"></div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->


                </div>

                <!-- End PAge Content -->
            </div>
	</div>

<?php
$encoded_Revenue = json_encode($activeRevenue);

?>

<script>
$(document).ready(function () {
  $('.responsive-testimonals').responsiveTestimonals();
});

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

 function runTest(){
     $.confirm({
    title: 'Let\'s Set Up Your Account!',
    content: '<h3>Add Your Amazon Details Below.</h3><br>' +
    '<form action="" class="formName"><input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('ID'); ?>">' +

                           '<input id="use_backup_keys" style="float: left;" name="use_backup_keys" type="checkbox" onchange="checkKeys(this)"><span style="float: left;">&nbsp;I don\'t have Amazon API Keys</span>'+
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
    buttons: {
        formSubmit: {
            text: 'Submit & Build Demo',

            btnClass: 'btn-blue',

            action: function () {
                var affiliate_tag = this.$content.find('.affiliate_tag').val();
                var access_key = this.$content.find('.access_key').val();
                var secret_key = this.$content.find('.secret_key').val();
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
                   url: 'http://phasebuilder.com/membershipkc/credential/add',
                    data:{ affiliate_tag : affiliate_tag,
            access_key : access_key,
            secret_key: secret_key,
            publisher_id_leader: '',
            publisher_id_sky: '',
            ads_code: '',
            user_id: 91
             },
                    type: "post",
                    success: function(data){

                           $.confirm({
      smoothContent: true,
   columnClass: 'col-lg-12',
    title: 'We\'re Building Your Demo Site!',
    content: '<h3>In The Meantime Watch This Short Video To See How Phase Builder Creates You A Passive Income</h3><p><video width="768" height="432" autoplay id="video"><source src="<?php echo $this->config->base_url(); ?>video/phasebuilder.mp4" type="video/mp4"></video></p><br><br>',
                            theme: 'modern',
                            closeIcon: false,
                            animation: 'scale',
                            type: 'blue',

    buttons: {
       'confirm': {
                                    text: '&nbsp;',
                                    btnClass: 'btn-white',

                                }

    },
    onContentReady: function () {
        var self = this;
        setTimeout(function () {
              $.confirm({
      smoothContent: true,
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

		// revenue
	   google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawRevenue);

      function drawRevenue() {
        var data = google.visualization.arrayToDataTable(

		<?php 	  echo $encoded_Revenue ; ?>
		);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales: 2018-2019',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('totalRevenue'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }


</script>





<?php $this->load->view("admin/common/footer.php"); ?>