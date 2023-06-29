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

<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>dashboard"><i class="fa fa-th-large"></i> Home</a></li>
<?php if($this->session->userdata('role') == 'admin'){ ?>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>subscription/subscription_add"><i class="fa fa-newspaper-o"></i> Add Subscription</a></li>
<?php }else{ ?>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>mysubscription"><i class="fa fa-bar-chart"></i> Subscription</a></li>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>transaction"><i class="fa fa-table"></i> Transaction</a></li>
<?php } ?>
<li class="nav-label"><a href="<?php echo $this->config->base_url(); ?>profile"><i class="ti-user"></i> Profile</a></li>
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