<?php
                            	$ci =&get_instance();
                                 $ci->load->model('admin/TicketsModel');

                            $all_tickets  =   $ci->TicketsModel->get_notification() ;

                                // $n = count($all_tickets) ;

              ?>
<?php if($this->session->userdata('account_status') == "Suspended"){ ?>
  <!-- Left Sidebar  -->
        <div class="left-sidebar" style="background-color: #101421; padding-top: 25px;">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" style="background-color: #101421; padding-top: 50px;">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>

                        <li> <a class="" href="<?php echo $this->config->base_url(); ?>dashboard" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
<!--
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>dashboard"><i class="fa fa-th-large"></i> Home</a></li>
-->

<li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-globe" aria-hidden="true"></i>
 My Builds</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>builds"> Current Builds</a></li>
</ul></li>
<li class="nav-label"><a class="has-arrow" href="#"><i class="ti-user"></i> My Account</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>profile"> Profile</a></li>
            <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>Subscription/my_subscriptions"> Subscription</a></li>
               <!--	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>Subscription/my_addons"><i class="fa fa-bar-chart"></i> Add-Ons</a></li> -->
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>transaction"> Transaction History</a></li>

    </ul>
</li>

<li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-ticket" style="font-size:24px"></i> Support <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a>
<ul aria-expanded="false" class="collapse" style="height: auto;">

        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>support"> Add Support</a></li>

    	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>support/view_tickets"> View Tickets <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a></li>

    </ul>
</li>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>Subscription"><i class="fa fa-asterisk"></i>Upgrade Membership</a></li>
 <li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
     <style>.sidebar-nav ul li.nav-label {
    padding: 7px 14px 0px 20px;
}</style>
<?php }elseif($this->session->userdata('account_status') == "Demo") { ?>
  <!-- Left Sidebar  -->
        <div class="left-sidebar" style="background-color: #101421; padding-top: 25px;">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" style="background-color: #101421; padding-top: 50px;">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>

                        <li> <a class="" href="<?php echo $this->config->base_url(); ?>dashboard" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
<!--
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>dashboard"><i class="fa fa-th-large"></i> Home</a></li>
-->


<li class="nav-label" id="credentials-tour"><a href="<?php echo $this->config->base_url(); ?>credential"><i class="fa fa-table"></i> Credentials</a></li>
<li class="nav-label" id="builds-tour"><a class="has-arrow" href="#"><i class="fa fa-globe" aria-hidden="true"></i>
 My Builds</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
    <li class="sub_menus"><a href="http://demo-32dududv.phasebuilder.com" target="_blank"> View Demo</a></li>
        <li id="welcome_tour_build" class="sub_menus"><a href="#" onclick="noAccess()"> New Build</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>builds"> Current Builds</a></li>
    </ul></li>

<li class="nav-label"id="articles-tour" ><a class="has-arrow" href="#"><i class="fa fa-newspaper-o"></i> My Articles</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>articles">Order Articles</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>articles/view_articles">View Articles</a></li>
    </ul></li>
 <li class="nav-label" id="addons-tour"><a href="#" onclick="noAccess()"><i class="fa fa-adn"></i> Add-Ons</a></li>



<li class="nav-label" id="account-tour"><a class="has-arrow" href="#"><i class="ti-user"></i> My Account</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>profile"> Profile</a></li>
    </ul>
</li>

<li class="nav-label" id="support-tour"><a class="has-arrow" href="#"><i class="fa fa-ticket" style="font-size:24px"></i> Support <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a>
<ul aria-expanded="false" class="collapse" style="height: auto;">

        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>support"> Submit Ticket</a></li>

    	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>support/view_tickets"> View Tickets <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a></li>

    </ul>
</li>
 <li class="nav-label" id="upgrade-tour"><a href="<?php echo $this->config->base_url(); ?>Subscription"><i class="fa fa-asterisk"></i>Upgrade Membership</a></li>
 <li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
     <style>.sidebar-nav ul li.nav-label {
    padding: 7px 14px 0px 20px;
}</style>
<?php }else{ ?>
  <!-- Left Sidebar  -->
        <div class="left-sidebar" style="background-color: #101421; padding-top: 25px;">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" style="background-color: #101421; padding-top: 50px;">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>

                        <li> <a class="" href="<?php echo $this->config->base_url(); ?>dashboard" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
<!--
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>dashboard"><i class="fa fa-th-large"></i> Home</a></li>
-->
<?php if($this->session->userdata('role') == 'admin'){ ?>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>subscription/subscription_add"><i class="fa fa-newspaper-o"></i> Add Subscription</a></li>
<?php }else{ ?>


<li class="nav-label" id="credentials-tour"><a href="<?php echo $this->config->base_url(); ?>credential"><i class="fa fa-table"></i> Credentials</a></li>
<li class="nav-label" id="builds-tour"><a class="has-arrow" href="#"><i class="fa fa-globe" aria-hidden="true"></i>
 My Builds</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
        <li class="sub_menus" id="welcome_tour_build"><a href="<?php echo $this->config->base_url(); ?>website"> New Build</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>builds"> Current Builds</a></li>
    </ul></li>

<?php } ?>
<li class="nav-label" id="articles-tour"><a class="has-arrow" href="#"><i class="fa fa-newspaper-o"></i> My Articles</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>articles">Order Articles</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>articles/view_articles">View Articles</a></li>
    </ul></li>
 <li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>Subscription/add_addOns"><i class="fa fa-adn"></i> Add-Ons</a></li>



<li class="nav-label" id="account-tour"><a class="has-arrow" href="#"><i class="ti-user"></i> My Account</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>profile"> Profile</a></li>
            <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>Subscription/my_subscriptions"> Subscription</a></li>
               <!--	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>Subscription/my_addons"><i class="fa fa-bar-chart"></i> Add-Ons</a></li> -->
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>transaction"> Transaction History</a></li>


    </ul>
</li>

<li class="nav-label" id="support-tour"><a class="has-arrow" href="#"><i class="fa fa-ticket" style="font-size:24px"></i> Support <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a>
<ul aria-expanded="false" class="collapse" style="height: auto;">

        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>support"> Submit Ticket</a></li>

    	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>support/view_tickets"> View Tickets <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a></li>

    </ul>
</li>
 <li class="nav-label" id="upgrade-tour"><a href="<?php echo $this->config->base_url(); ?>Subscription"><i class="fa fa-asterisk"></i>Upgrade Membership</a></li>
 <li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
     <style>.sidebar-nav ul li.nav-label {
    padding: 7px 14px 0px 20px;
}</style>
<?php } ?>
