<?php
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
ul.sub_names li {
    list-style: none !important;
}
.subs_headings{
text-align: center;
}
.book_btn{
width: 100% !important;
}
</style>
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Upgrades</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Upgrades</li>
                    </ol>
                </div>
            </div>
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Your Upgrades</h2>
			
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
			  <div class="row">
				  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="card panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">							
							<?php
							$sub_names = '';
							if(!empty($res)){
							?>
								<h3>Active Membership :-</h3>
								<?php
								echo '<ul class="sub_names">';
									foreach($res as $sub_ids){
										$sub_names = $this->SubscriptionModel->get_subname_by_id($sub_ids);
										echo "<li>".$sub_names."</li>";
									}
								echo "</ul>";
								}else{
									$res = array();
								}
									echo "<h3 class='subs_headings'>Available Subscriptions :-</h3>";
							echo "<div class='row'>";
							foreach($subscriptions as $subs){
								if((!in_array($subs->id,$res)) && $subs->sub_type != 'addon'){
								?>
							<div class="col-md-4" style="float: left">
								<?php
								$controller = 'Subscription.php';
								$controller_exists = (file_exists(APPPATH."controllers/".$controller)) ? true : false;
								$panel_class = ($controller_exists) ? ' panel-info' : ' panel-default';
								?>
								<div class="panel <?php if(isset($panel_class)) echo $panel_class; ?>">
									<div class="panel-heading">
										<h3><?php echo $subs->title; ?></h3>
										<p><?php echo $subs->subtitle; ?></p>
									</div>
									<div class="panel-body">
										<p><?php echo $subs->description; ?></p>
										<?php if($controller_exists) { ?>
										<form method="post" style="display: flex;justify-content: center;" action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
											<input type="hidden" name="p_id" value="<?php echo $subs->subscription_id; ?>" id="p_id">
											<input type="hidden" name="p_name" value="<?php echo $subs->title; ?>" id="p_name">
											<input type="hidden" name="qty" value="1" id="qty">
											<input type="hidden" name="price" value="<?php echo $subs->price; ?>" id="price">
											<input type="hidden" name="shipping" value="<?php echo $subs->shipping; ?>" id="shipping">
											<input type="hidden" name="tax" value="<?php echo $subs->tax; ?>" id="tax">
											<input type="hidden" name="pay_type" value="<?php echo $subs->pay_type; ?>" id="pay_type">
											<input type="hidden" name="billing_period" value="<?php echo $subs->duration; ?>" id="billing_period">
											<input type="hidden" name="billing_frequency" value="<?php echo $subs->billing_frequency; ?>" id="billing_frequency">
											<input type="hidden" name="billing_cycles" value="<?php echo $subs->billing_cycles; ?>" id="billing_cycles">
											<input type="hidden" name="currency" value="<?php echo $subs->currency; ?>" id="currency">
											<input type="hidden" name="sub_id" value="<?php echo $subs->id; ?>" id="sub_id">
											<input type="hidden" name="description" value="<?php echo implode(' ', array_slice(explode(' ', $subs->description), 0, 15)); ?>" id="description">
											<input type="submit" name="cart" value="Buy" class="btn btn-primary m-b-10 m-l-5 book_btn">
										</form>
										<?php } else { ?>
											<a class="btn btn-default btn-block" href="https://www.angelleye.com/?s=codeigniter&post_type=product" target="_blank">Download/Buy</a>
										<?php } ?>
									</div>
								</div>
							</div>
								<?php
								}
							}
							echo "</div>";
							echo "<div class='row'>";
							if(!empty($subscriptions_addons)){
								echo "<h3 class='subs_headings' style='float: left;width: 100%;padding-left: 14px;'>Extra Add-Ons :-</h3>";
								foreach($subscriptions_addons as $addons){
									if((!in_array($addons->id,$res))){
								?>
									<div class="col-md-4" style="float: left">
										<?php
										$controller = 'Subscription.php';
										$controller_exists = (file_exists(APPPATH."controllers/".$controller)) ? true : false;
										$panel_class = ($controller_exists) ? ' panel-info' : ' panel-default';
										?>
										<div class="panel <?php if(isset($panel_class)) echo $panel_class; ?>">
											<div class="panel-heading">
												<h3><?php echo $addons->title; ?></h3>
												<p><?php echo $addons->subtitle; ?></p>
											</div>
											<div class="panel-body">
												<p><?php echo $addons->description; ?></p>
												<?php if($controller_exists) { ?>
												<form method="post" action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
													<input type="hidden" name="p_id" value="<?php echo $addons->subscription_id; ?>" id="p_id">
													<input type="hidden" name="p_name" value="<?php echo $addons->title; ?>" id="p_name">
													<input type="hidden" name="qty" value="1" id="qty">
													<input type="hidden" name="price" value="<?php echo $addons->price; ?>" id="price">
													<input type="hidden" name="shipping" value="<?php echo $addons->shipping; ?>" id="shipping">
													<input type="hidden" name="tax" value="<?php echo $addons->tax; ?>" id="tax">
													<input type="hidden" name="pay_type" value="<?php echo $addons->pay_type; ?>" id="pay_type">
													<input type="hidden" name="billing_period" value="<?php echo $addons->duration; ?>" id="billing_period"> 
													<input type="hidden" name="billing_frequency" value="<?php echo $addons->billing_frequency; ?>" id="billing_frequency">
													<input type="hidden" name="billing_cycles" value="<?php echo $addons->billing_cycles; ?>" id="billing_cycles">
													<input type="hidden" name="currency" value="<?php echo $addons->currency; ?>" id="currency">
													<input type="hidden" name="sub_id" value="<?php echo $addons->id; ?>" id="sub_id">
													<input type="hidden" name="description" value="<?php echo implode(' ', array_slice(explode(' ', $addons->description), 0, 15)); ?>" id="description">
													<input type="submit" name="cart" value="Buy" class="btn btn-primary m-b-10 m-l-5 book_btn">
												</form>
												<?php } else { ?>
													<a class="btn btn-default btn-block" href="https://www.angelleye.com/?s=codeigniter&post_type=product" target="_blank">Download/Buy</a>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								}
								}
							}
							echo "</div>";
							?>
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