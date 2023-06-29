  <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>

                        <li> <a class="" href="<?php echo $this->config->base_url(); ?>dashboard" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                        </li>

<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>admin"><i class="fa fa-th-large"></i> Home</a></li>



<li class="nav-label"><a class="has-arrow" href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Subscription</a>
<ul aria-expanded="false" class="collapse" style="height: auto;">
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>website">Lists</a></li>
		<li class="sub_menus"><a href="<?php echo $this->config->base_url(); ?>admin/subscription/add_subscription">Add new</a></li>
	</ul></li>
	
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="ti-user"></i>User Management</a></li>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="ti-user"></i>Role Admin</a></li>

<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="fa fa-asterisk"></i>Transactions</a></li>



<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>login/logout"><i class="fa fa-cog"></i>Settings</a></li>

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