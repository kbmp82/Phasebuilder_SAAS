<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");


$ci =&get_instance();
$ci->load->model('user/SubscriptionModel');
    
    $pay_method =   $ci->SubscriptionModel->get_active_payment() ;

?>
<link rel="stylesheet" type="text/css" href="../assets/css/pricing.css">
<style>
.panel-heading {
    color: #fff;
    background-color: #0e1420 !important;
    border-color: #68686a !important;
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
	
.panel.panel-info {
    border: 1px solid #68686a;
	}
	
.panel-body {
    padding: 15px;
}
	.page-titles h3{
color: #000 !important;
	}
.sub-text-title{
    font-weight: bold;
    font-size: 30px;
    background: -webkit-linear-gradient(#14a5dc, #14a5dc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.sub-text{
    font-weight: bold;
    font-size: 16px;
    background: -webkit-linear-gradient(#fff, #fff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.big-text{
    font-size: 16px;
}
.container{/* max-width:540px */}
@media (min-width:768px){.container{/* max-width:720px */}}
@media (min-width:992px){.container{/* max-width:960px */}}
@media (min-width:1200px)
.container{/* max-width:1140px */}
</style>
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Subscription</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Subscription</li>
                    </ol>
                </div>
            </div>
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Choose A Subscription</h2>
          
<div class="container">
    <div class="row clearfix" style="/* margin-left: -220px; */" >
        <div class="col-md-12 column">
			  <div class="row" style="flex-flow: nowrap;">
			      <div class="beginner">
        <div class="offerTitle">
          <span style="padding-bottom:2vw;">Basic</span>
          <div class="stores">
            <span>1 Store Per Month</span><br>
            <span>1 Free Unique Article Per Month</span>
          </div>
        <!--  <div class="freeTrial">
            <span>Bonus: 5 Days Free Trial</span>
            <p>You Save By Choosing Us</p>
          </div> -->
        </div>
        <div class="price">
          <span style="padding-bottom:4vw;padding-top: 4vw;">$67</span>
          <div class="monthly">
            <span>per month</span>
          </div>
        </div>
        <div class="offersFeatures">
          <span class="seperator"></span>
          <div>
            <img src="../assets/svg/seconds.svg" alt="">
            <span>100% Automatic Build</span>
          </div>
          <div>
            <img src="../assets/svg/subdomains.svg" alt="free domains">
            <span>Free Domains</span>
          </div>
          <div>
            <img src="../assets/svg/articlesw.png" alt="mastermind">
            <span>100% Unique Content System</span>
          </div>
          <div>
            <img src="../assets/svg/amazonw.png" alt="products">
            <span>500 Products Per Site</span>
          </div>
          <div>
            <img src="../assets/svg/fbgroup.svg" alt="category research">
            <span>Category Research Included</span>
          </div>
          <div>
            <img src="../assets/svg/hosting.svg" alt="fast and secure hosting">
            <span>Fast & Secure Hosting</span>
          </div>
          <div>
            <img src="../assets/svg/training.svg" alt="mastermind">
            <span>Mastermind Facebook Group</span>
          </div>
        </div>
        <div class="orderNow">
          <span class="orderButton" id="order1" onclick="submit_basic()">Order Now</span>
        </div>
      </div>
			      <div class="entrepreneur">
        <div class="offerTitle">
          <span style="padding-bottom:2vw;">Expert</span>
          <div class="stores">
            <span>3 Stores Per Month</span><br>
            <span>3 Free Unique Articles Per Month</span>
          </div>
        <!--  <div class="freeTrial">
            <span>Bonus: 5 Days Free Trial</span>
            <p>You Save By Choosing Us</p>
          </div> -->
        </div>
        <div class="price">
          <span style="padding-bottom:4vw;padding-top: 4vw;">$177</span>
          <div class="monthly">
            <span>per month</span>
          </div>
        </div>
        <div class="offersFeatures">
          <span class="seperator"></span>
          <div>
            <img src="../assets/svg/seconds.svg" alt="">
            <span>100% Automatic Build</span>
          </div>
          <div>
            <img src="../assets/svg/subdomains.svg" alt="free domains">
            <span>Free Domains</span>
          </div>
          <div>
            <img src="../assets/svg/articlesw.png" alt="mastermind">
            <span>100% Unique Content System</span>
          </div>
          <div>
            <img src="../assets/svg/amazonw.png" alt="products">
            <span>500 Products Per Site</span>
          </div>
          <div>
            <img src="../assets/svg/fbgroup.svg" alt="category research">
            <span>Category Research Included</span>
          </div>
          <div>
            <img src="../assets/svg/hosting.svg" alt="fast and secure hosting">
            <span>Fast & Secure Hosting</span>
          </div>
          <div>
            <img src="../assets/svg/training.svg" alt="mastermind">
            <span>Mastermind Facebook Group</span>
          </div>
        </div>
        <div class="orderNow">
          <span class="orderButton" id="order2" onclick="submit_expert()">Order Now</span>
        </div>
      </div>
			      <div class="expert">
        <div class="offerTitle">
          <span style="padding-bottom:2vw;">Entrepreneur</span>
          <div class="stores">
            <span>9 Stores Per Month</span><br>
            <span>9 Free Unique Articles Per Month</span>
          </div>
        </div>
        <div class="price">
          <span style="padding-bottom:4vw;padding-top: 4vw;">$447</span>
          <div class="monthly">
            <span>per month</span>
          </div>
        </div>
        <div class="offersFeatures">
          <span class="seperator"></span>
          <div>
            <img src="../assets/svg/seconds.svg" alt="">
            <span>100% Automatic Build</span>
          </div>
          <div>
            <img src="../assets/svg/subdomains.svg" alt="free domains">
            <span>Free Domains</span>
          </div>
          <div>
            <img src="../assets/svg/articlesw.png" alt="mastermind">
            <span>100% Unique Content System</span>
          </div>
          <div>
            <img src="../assets/svg/amazonw.png" alt="products">
            <span>500 Products Per Site</span>
          </div>
          <div>
            <img src="../assets/svg/fbgroup.svg" alt="category research">
            <span>Category Research Included</span>
          </div>
          <div>
            <img src="../assets/svg/hosting.svg" alt="fast and secure hosting">
            <span>Fast & Secure Hosting</span>
          </div>
          <div>
            <img src="../assets/svg/training.svg" alt="mastermind">
            <span>Mastermind Facebook Group</span>
          </div>
        </div>
        <div class="orderNow">
          <span class="orderButton" id="order3" onclick="submit_entre()">Order Now</span>
        </div>
      </div>
				 <?php
				if(!empty($subscriptions)){
					foreach($subscriptions as $subs){
				?>
					<div class="col-md-3" style="max-width: 60%;">
						<?php
						$controller = 'Subscription.php';
						$controller_exists = (file_exists(APPPATH."controllers/".$controller)) ? true : false;
						$panel_class = ($controller_exists) ? ' panel-info' : ' panel-default';
						?>
						
						<div class="panel <?php if(isset($panel_class)) echo $panel_class; ?>" style="width:400px;">
							<div class="panel-heading">
								<center><h2 class="sub-text-title"><?php echo $subs->title; ?></h2></center>
								<center><p class="sub-text"><?php echo $subs->subtitle; ?></p></center>
							</div>
							<div class="panel-body">
								<p><?php echo $subs->description; ?></p>
								<?php if($controller_exists) { ?>
								   Domains Allowed : <?php  echo $subs->domain_number  ;  ?> <br /><br />
						  <?php   $checksubs = $ci->SubscriptionModel->get_subscribed_subscription($subs->subscription_id); ?>

					        <?php   if($pay_method == 'paypal'){  ?>			   
					<!--   Paypal starts  -->
								<form method="post" style="display: flex;justify-content: center;"  action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
									<input type="hidden" name="p_id" value="<?php echo $subs->subscription_id; ?>" id="p_id">
									<input type="hidden" name="p_name" value="<?php echo $subs->title; ?>" id="p_name">
									<input type="hidden" name="qty" value="1" id="qty">
									<input type="hidden" name="price" value="<?php echo $subs->price; ?>" id="price">
									<input type="hidden" name="shipping" value="<?php echo $subs->shipping; ?>" id="shipping">
									<input type="hidden" name="tax" value="<?php echo $subs->tax; ?>" id="tax">
									<input type="hidden" name="pay_type" value="<?php echo $subs->pay_type; ?>" id="pay_type">
									<input type="hidden" name="sub_type" value="<?php echo $subs->sub_type; ?>" id="sub_type">
									<input type="hidden" name="billing_period" value="<?php echo $subs->duration; ?>" id="billing_period">
									<input type="hidden" name="billing_frequency" value="<?php echo $subs->billing_frequency; ?>" id="billing_frequency">
									<input type="hidden" name="billing_cycles" value="<?php echo $subs->billing_cycles; ?>" id="billing_cycles">
									<input type="hidden" name="currency" value="<?php echo $subs->currency; ?>" id="currency">
									<input type="hidden" name="sub_id" value="<?php echo $subs->id; ?>" id="sub_id">
									<input type="hidden" name="description" value="<?php echo implode(' ', array_slice(explode(' ', $subs->description), 0, 15)); ?>" id="description">


							 
								<?php  if($checksubs){  ?>
								   	<button class="btn btn-default btn-block" disabled>Current</button>
								<?php
								}else{
                                         if(isset($user_subscription[0]['amount'])){
                                        if($user_subscription[0]['amount'] < $subs->price){
								?>
									<input type="submit" name="cart" value="Upgrade" class="btn btn-info btn-block big-text">

								<?php }else{ ?>
                                       <input type="submit" name="cart" value="Downgrade" class="btn btn-info btn-block big-text">

								<?php   } 
											}else{ ?>
                                       <input type="submit" name="cart" value="Subscribe" class="btn btn-info btn-block big-text">
								<?php }
								} ?>
							   
								</form>
						<?php  }else{  ?>
								
						<!--   Paypal ends  -->		
						
						<!--   Stripe starts  -->	
							<?php  if($checksubs){  ?>
								   	<button class="btn btn-default btn-block" disabled>Current</button>
								<?php
								}else{
									// Check if subscription exists .... 	
										if(isset($user_subscription[0]['amount'])){
											 if($user_subscription[0]['amount'] < $subs->price){
												 $label = 'Upgrade' ;
											 }
											 else{
												  $label = 'Downgrade' ;
											 }
										}else{
											$label = 'Subscribe' ;
										}	
									
									?>
								
							<form style="display: flex;justify-content: center;" action="<?php echo site_url('subscription/stripe_checkout');?>" method="POST">
							  <script
								src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								data-key="pk_test_zOa8sUBQcpBhF4q4VApUmBcK"
								data-image="http://phasebuilder.com/membershipkc/main/images/pb-logo.png"
								data-name="Phase Builder"
								data-description="<?php echo implode(' ', array_slice(explode(' ', $subs->description), 0, 15)); ?>"
								data-amount="<?php echo $subs->price*100  ; ?>"
								data-label="<?php echo $label ; ?>">
							  </script>
							  	<input type="hidden" name="sub_id" value="<?php echo $subs->subscription_id; ?>">
							  <input type="hidden" name="price" value="<?php echo $subs->price*100  ; ?>">
							  <input type="hidden" name="duration" value="<?php echo $subs->duration; ?>">
							   <input type="hidden" name="plan" value="<?php echo $subs->title; ?>">

							</form>
							
						<?php }
						    }
						?>
						
						<!--   Stripe ends  -->		
								
								
								<?php } else { ?>
									<a class="btn btn-default btn-block" href="https://www.angelleye.com/?s=codeigniter&post_type=product" target="_blank">Download/Buy</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php }
					}
					?>

        	</div>
        </div>
    </div><br><br><br><br><br><br><br><br>

</div>
<form id="cancel" action="<?php echo site_url('subscription/cancel_subscription');?>">
    <center><?php    if(isset($user_subscription[0]['amount'])): ?>
                    Wish to cancel your subscription?<br><a href="#" onclick="document.getElementById('cancel').submit();"><font color="blue">Cancel Subscription</font></a>
                   <!--  <input type="submit" name="cart" value="Cancel Subscription" class="btn btn-danger btn-block big-text" style="width:35%">  -->
                     <?php endif; ?>

                    </center> </form>
</div>

<?php  $this->load->view("common/footer.php"); ?>