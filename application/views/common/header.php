<!DOCTYPE html>
<?php
if($this->session->userdata('ID') == ''){
			redirect('login');
		}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="<?php echo $this->config->base_url(); ?>main/image/png" sizes="16x16" href="images/favicon.png">
    <title>Dashboard</title>
    <!-- Bootstrap Core CSS -->

  <link href="<?php echo $this->config->base_url(); ?>main/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="<?php echo $this->config->base_url(); ?>main/css/lib/calendar2/semantic.ui.min.css" rel="stylesheet">
        <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.css" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.min.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo $this->config->base_url(); ?>main/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->base_url(); ?>main/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url(); ?>main/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url(); ?>main/css/helper.css" rel="stylesheet">
    <link href="<?php echo $this->config->base_url(); ?>main/css/style.css" rel="stylesheet">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
        <link href="<?php echo $this->config->base_url(); ?>main/css/lib/intro/introjs.css" rel="stylesheet">
            <link href="<?php echo $this->config->base_url(); ?>main/css/responsive-testimonals.css" rel="stylesheet">

              <link href="<?php echo $this->config->base_url(); ?>main/css/hopscotch.css" rel="stylesheet" type="text/css" />
           <!--  <link href="<?php echo $this->config->base_url(); ?>main/css/enjoyhint.css" rel="stylesheet" type="text/css" />  -->
           <link rel="stylesheet" type="text/css" href="//oss.maxcdn.com/jquery.trip.js/3.3.3/trip.min.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <!-- <script src="<?php echo $this->config->base_url(); ?>main/js/lib/jquery/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.4/semantic.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI-Calendar/76959c6f7d33a527b49be76789e984a0a407350b/dist/calendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
 <script src="<?php echo $this->config->base_url(); ?>main/js/responsive-testimonals.js"></script>
  <script src="<?php echo $this->config->base_url(); ?>main/js/debugout.js"></script> 


<script>

  $(document).ready(function(){

   $("#subscription").dataTable();
    $('#time').calendar();
    $("#transaction").dataTable();
    $('[data-toggle="tooltip"]').tooltip();
     $('.tooltip').tooltipster();
  });
function noAccess(){
    alert('not available on demo');
}
  </script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122639401-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122639401-1');
</script>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '244406436106442');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=244406436106442&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<style>
.notify-sidebar {
     position: relative;
    top: -12px;
    right: 29px;
}
.notify-sidebar .heartbit {
  position: absolute;
  top: -20px;
  right: -4px;
  height: 25px;
  width: 25px;
  z-index: 10;
  border: 5px solid #ef5350;
  border-radius: 70px;
  -moz-animation: heartbit 1s ease-out;
  -moz-animation-iteration-count: infinite;
  -o-animation: heartbit 1s ease-out;
  -o-animation-iteration-count: infinite;
  -webkit-animation: heartbit 1s ease-out;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
.notify-sidebar .point {
  width: 6px;
  height: 6px;
  -webkit-border-radius: 30px;
  -moz-border-radius: 30px;
  border-radius: 30px;
  background-color: #ef5350;
  position: absolute;
  right: 6px;
  top: -10px;
}
</style>
<script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '459911a110d6a11f7785fedcaebd7baff4ec61cc');
</script>
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->

    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
              <div class="navbar-header" style="background-color: #101421; padding-top: 15px;" >

                    <a class="navbar-brand" href="<?php echo $this->config->base_url();   ?>">

                        <!-- Logo icon -->
                        <img src="<?php echo $this->config->base_url(); ?>main/images/pb-logo.png" alt="homepage" class="dark-logo" />
                        <!--
                        <b><img src="<?php echo $this->config->base_url(); ?>main/images/logo.png" alt="homepage" class="dark-logo" /></b>
                        -->
                        <!--End Logo icon -->

                        <!-- Logo text -->
                        <!--
                        <span><img src="<?php echo $this->config->base_url(); ?>main/images/logo-text.png" alt="homepage" class="dark-logo" /></span>
                        -->
                    </a>

                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                    
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">

                
                  <?php
                            	$ci =&get_instance();
                                 $ci->load->model('admin/TicketsModel');

                            $all_tickets  =   $ci->TicketsModel->get_notification() ;

                                $user_id		=	$this->session->userdata('ID')  ;

                                // $n = count($all_tickets) ;

              ?>
                            
                 
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted" id="notification-tour" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell"></i>
                         
                       <?php    if($all_tickets):?>
								<div class="notify">

								<span class="heartbit"></span>
								<span class="point"></span>
								
								</div>
						<?php endif ; ?>
							</a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn" >
                
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            
                                  <?php

                                            if($all_tickets){
                                                foreach($all_tickets as $ticket):
                                                 $username = $ci->TicketsModel->get_UserByID($ticket['u_id']) ;
                                                $ticket_id = ($ticket['t_type'] == "initial") ? $ticket['t_id'] : $ticket['p_id'];
                                                 //   if($ticket['to_id'] == $user_id){
                                  ?>
                                       <div class="ntf_msg unread_msg" id="<?php echo $ticket_id ;  ?>">
                                            <!-- Message -->
                                            <a class="get_url" id="<?php echo $ticket_id ;  ?>" href="<?php echo $this->config->base_url('Support/ticket_details/?id=')."$ticket_id"  ; ?>#ntfy<?php  echo $ticket_id ; ?>"">
                                                <div class="btn btn-danger btn-circle m-r-10">
                                         <?php
                                            echo $ticket_id ;
                                         ?>
                                         </div>
                                                <div class="mail-contnet">

                                    <h5><?php echo $username;  ?></h5> <span class="mail-desc">
                                        <?php echo $ticket['detail'] ;      ?>
                                        </span> <span class="time"><?php echo $ticket['ticket_date'] ;  ?></span>
                                                </div>
                                            </a>
                                        </div>
                                   <?php  
												  //	}
                                            endforeach ;
											}
                                   ?>
                                            
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->
                        <!-- Messages -->
             
                        <!-- End Messages -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $this->config->base_url(); ?>images/worker.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="<?php echo $this->config->base_url(); ?>profile"><i class="ti-user"></i> Profile</a></li>
                                    <li><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
  <style>
.unread_msg {
    background-color: lightgrey;
}
  </style>

   <script>
   
   /*
	//  $(document).on('click','div .ntf_msg',function(e){
     $(document).on('click','.get_url',function(e){
            e.preventDefault()
            msg_id    =   $(this).attr('id') ;

             $(this).removeClass('unread_msg') ;

            url    =   $(this).attr('href') ;




             $.ajax({
                    url: '<?php echo $this->config->base_url(); ?>Support/update_ticket',
                    data: {
                        'n_id': msg_id
                        },
                    type: "post",
                    success: function(data){
                         console.log('redirecting') ;
                        window.location.href = url ;
                    }
              });
   })
   */
 </script>

        
     