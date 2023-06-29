 <?php
 $ci =&get_instance();
                                 $ci->load->model('admin/TicketsModel');

                                     $all_tickets  =   $ci->TicketsModel->get_notification() ;
                                     ?> <!-- Left Sidebar  -->
         <div class="left-sidebar" style="background-color: #101421; padding-top: 25px;">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav" style="background-color: #101421; padding-top: 50px;">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>

                        <li> <a class="" href="<?php echo $this->config->base_url(); ?>admin/dashboard" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
<!--
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>admin/Home"><i class="fa fa-th-large"></i> Home</a></li>
-->


 <li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-dot-circle-o"></i>Settings</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
    <li class="sub_menus"><a href="<?php //echo $this->config->base_url(); ?>admin/credential/payments">Payment Settings</a>
            <ul aria-expanded="false" class="collapse" style="height: auto;">
         <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/set_payment">Payment Gateway</a></li>
       	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/paypal_payment">Paypal Settings</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/stripe_payment">Stripe Settings</a></li>
        </ul>
    </li>


		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential">Build Settings</a></li>
		
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/articles">Article Settings</a></li>
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/goliath">Goliath Settings</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/server_settings">Server Settings</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/godaddy_settings">GoDaddy Settings</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/fund_account">Add Funds</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/error_log">Error Log</a></li> 
<!--<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/goliath_add">Goliath Add Products</a></li> -->
	</ul></li>
<li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Subscriptions</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/subscription/get_subscription_list">Subscriptions List</a></li>
				<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/subscription/get_addons_list">Add-Ons List</a></li>

		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/subscription/add_subscription">Add new</a></li>
	</ul></li>
	
<li class="nav-label"><a class="has-arrow" href="<?php echo $this->config->base_url(); ?>admin/User"><i class="ti-user"></i>User Management</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/user/get_user_list">Users</a></li>
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/user">Add user</a></li>
	</ul></li>

<li class="nav-label"><a class="has-arrow" href=""><i class="fa fa-globe"></i>
Domains </a>
<ul aria-expanded="false" class="collapse" style="height: auto;">

    	<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/domain/manage_domain">Manage Domains</a></li>
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/domain/add_domain">Add Domains</a></li>
        <li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/domain/manage_godaddy">GoDaddy Domains</a></li>
	</ul>
	
</li>
<li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-desktop" aria-hidden="true"></i>Servers</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/servers">Manage Servers</a></li>
				<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/credential/add_server">Add New</a></li>
	</ul></li>
<!-- <li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Notifications</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/SupportTickets/create_notifications">Create Notifications</a></li>
				<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/SupportTickets/manage_notifications">Manage Notifications</a></li>
	</ul></li>  -->
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>admin/Transactions"><i class="fa fa-asterisk"></i>Transactions</a></li>

<li class="nav-label"><a  href="<?php echo $this->config->base_url(); ?>admin/SupportTickets" ><i class="fa fa-ticket" style="font-size:24px"></i> Support <?php echo ($all_tickets)?'<div class="notify-sidebar"><span class="heartbit"></span><span class="point"></span></div>':'';?></a>

</li>

<li class="nav-label"><a  href="<?php echo $this->config->base_url(); ?>admin/Reporting" ><i class="fa fa-bar-chart" style="font-size:24px"></i>Reporting</a>

</li>


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
}
</style>