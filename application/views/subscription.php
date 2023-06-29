<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");


$ci =&get_instance();
$ci->load->model('user/SubscriptionModel');

    $pay_method =   $ci->SubscriptionModel->get_active_payment() ;
     $sub_id = $ci->SubscriptionModel->get_subscribed_subscription();
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
.offerTitle>span{
    font-size: 1.7vw;

}
.offersFeatures span, .offersFeatures div {
    font-size: 1.1vw;
    padding: .5vw 0;
}
.stores, .freeTrial {
    font-size: 1.1vw;
    padding-top: .7vw;
    text-align: center;
}
.price>span {
    font-size: 4vw;
    padding-bottom: 3vw;
    padding-top: 2.5vw;
}
.orderButton {
    font-size: 1.1vw;
    border: .18vw solid #ffffff;
    padding: 18px;
    transition-timing-function: ease-in-out;
    text-align: center;
    margin-bottom: 10px;
}
.beginner, .entrepreneur, .expert .hosting{
    margin-top: 50px;
    max-width: 26.5vw;
    border-radius: .5vw;
    padding: 2vw;
    box-shadow: 0 0.4vw 0.8vw 0 rgba(0, 0, 0, 0.2), 0 0.3vw 1vw 0 rgba(0, 0, 0, 0.19);
    transition: box-shadow .2s ease-in-out;
}
.hosting {
    background: linear-gradient(190deg, #14a3dc, #F8D568);
}
.expert{
    margin-right: 2vw;
}
.orderButton_current {
	background: #ffffff;
	border-color: #ffffff;
     font-size: 1.1vw;
    border: .18vw solid #ffffff;
    padding: 18px;
    transition-timing-function: ease-in-out;
    text-align: center;
    margin-bottom: 10px;
    width: 100%;
}

.order1_current {
	color: #8214dc;
}

.order2_current {
	color: #dc1461;
}

.order3_current {
	color: #14dc6e;
}
.order4_current {
	color: #F8D568;
}
.order1:hover {
	color: #8214dc;
}

.order2:hover {
	color: #dc1461;
}

.order3:hover {
	color: #14dc6e;
}
.order4:hover {
	color: #F8D568;
}
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
              <div class="row" style="justify-content: space-evenly;">
                  <div class="beginner">
        <div class="offerTitle" style=" font-size: 2.5vw;">
          <span style="padding-bottom:2vw;">Basic</span>
          <div class="stores">
            <span>1 Store Per Month</span><br>
            <span>3 Free Unique Article Per Month</span>
          </div>
        <!--  <div class="freeTrial">
            <span>Bonus: 5 Days Free Trial</span>
            <p>You Save By Choosing Us</p>
          </div> -->
        </div>
        <div class="price">
          <?php $amount = 77 - (77 * $discount); echo ($discount > 0) ? '<span style="padding-bottom:2vw;padding-top: 2vw;"><strike>$77</strike></span><br><span style="padding-bottom:2vw;padding-top: 2vw;">$'.$amount.'</span>' : '<span style="padding-bottom:2vw;padding-top: 2vw;">$77</span>';?>
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
            <span>Free Aged Domains</span>
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
             <?php if($sub_id != 1){
           echo ($pay_method == 'paypal' || $pay_method == 'both') ? '<span class="orderButton order1" id="order1_p">Subscribe via PayPal</span>' : '';
           echo ($pay_method == 'stripe' || $pay_method == 'both') ? '<span class="orderButton order1" id="order1_s">Subscribe via Stripe</span>' : '';
          }else{
             echo '<span class="orderButton_current order1_current" id="">Current</span>';
          }
          ?>

        </div>
      </div>
                  <div class="entrepreneur" data-toggle="tooltip" title="Most popular! Save 12%.">
        <div class="offerTitle">
          <span style="padding-bottom:2vw;">Pro</span>
          <div class="stores">
            <span>3 Stores Per Month</span><br>
            <span>9 Free Unique Articles Per Month</span>
          </div>
        <!--  <div class="freeTrial">
            <span>Bonus: 5 Days Free Trial</span>
            <p>You Save By Choosing Us</p>
          </div> -->
        </div>
        <div class="price">
            <?php $amount = 217 - (217 * $discount); echo ($discount > 0) ? '<span style="padding-bottom:2vw;padding-top: 2vw;"><strike>$217</strike></span><br><span style="padding-bottom:2vw;padding-top: 2vw;">$'.$amount.'</span>' : '<span style="padding-bottom:2vw;padding-top: 2vw;">$217</span>';?>

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
            <span>Free Aged Domains</span>
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
             <?php if($sub_id != 2){
           echo ($pay_method == 'paypal' || $pay_method == 'both') ? '<span class="orderButton order2" id="order2_p">Subscribe via PayPal</span>' : '';
           echo ($pay_method == 'stripe' || $pay_method == 'both') ? '<span class="orderButton order2" id="order2_s">Subscribe via Stripe</span>' : '';
          }else{
              echo '<span class="orderButton_current order2_current" id="">Current</span>';
          }
          ?>
        </div>
      </div>
                  <div class="expert" data-toggle="tooltip" title="Best deal! Save 25%.">
        <div class="offerTitle">
          <span style="padding-bottom:2vw;">Entrepreneur</span>
          <div class="stores">
            <span>9 Stores Per Month</span><br>
            <span>27 Free Unique Articles Per Month</span>
          </div>
        </div>
        <div class="price">
          <?php $amount = 557 - (557 * $discount); echo ($discount > 0) ? '<span style="padding-bottom:2vw;padding-top: 2vw;"><strike>$557</strike></span><br><span style="padding-bottom:2vw;padding-top: 2vw;">$'.$amount.'</span>' : '<span style="padding-bottom:2vw;padding-top: 2vw;">$557</span>';?>
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
            <span>Free Aged Domains</span>
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
          <?php if($sub_id != 3){
           echo ($pay_method == 'paypal' || $pay_method == 'both') ? '<span class="orderButton order3" id="order3_p">Subscribe via PayPal</span>' : '';
           echo ($pay_method == 'stripe' || $pay_method == 'both') ? '<span class="orderButton order3" id="order3_s">Subscribe via Stripe</span>' : '';
          }else{
             echo '<span class="orderButton_current order3_current" id="">Current</span>';
          }
          ?>
        </div>
      </div>
        <?php if($sub_id != '' && $sub_id != 0){
            ?>
        <div class="hosting">
        <div class="offerTitle">
          <span style="padding-bottom:2vw;">Hosting Only</span>
          <div class="stores">
            <span>We Host Your Websites</span><br>
            <span>No Builds or Free Articles</span>
          </div>
        </div>
        <div class="price">
          <span style="padding-bottom:2vw;padding-top: 2vw;">$12</span>
          <div class="monthly">
            <span>per month</span>
          </div>
        </div>
        <div class="orderNow" style="margin-top: 245%;width: 247px;">
            <?php if($sub_id != 5){
           echo ($pay_method == 'paypal' || $pay_method == 'both') ? '<span class="orderButton order4" id="order4_p">Subscribe via PayPal</span>' : '';
           echo ($pay_method == 'stripe' || $pay_method == 'both') ? '<span class="orderButton order4" id="order4_s">Subscribe via Stripe</span>' : '';
          }else{
             echo '<span class="orderButton_current order4_current" id="">Current</span>';
          }
          ?>
        </div>
      </div>
         <?php } ?>
        	</div>
        </div>
    </div><br><br><br><br><br><br><br><br>

</div>
<form id="cancel" action="<?php echo site_url('subscription/cancel_subscription_link');?>">
    <center><?php    if($sub_id != '' && $sub_id != 0): ?>
                    Wish to cancel your subscription?<br><a href="#" onclick="document.getElementById('cancel').submit();"><font color="blue">Cancel Subscription</font></a>
                   <!--  <input type="submit" name="cart" value="Cancel Subscription" class="btn btn-danger btn-block big-text" style="width:35%">  -->
                     <?php endif; ?>

                    </center> </form>
</div>
 <?php
                if(!empty($subscriptions)){

                    foreach($subscriptions as $subs){

                        if($pay_method == 'paypal' || $pay_method == 'both'){

                          ?>
                    <!--   Paypal starts  -->
                                <form method="post" id="<?php echo "form_p_".$subs->subscription_id; ?>" style="display: flex;justify-content: center;"  action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
                                    <input type="hidden" name="p_id" value="<?php echo $subs->subscription_id; ?>" id="p_id">
                                    <input type="hidden" name="p_name" value="<?php echo $subs->title; ?>" id="p_name">
                                    <input type="hidden" name="qty" value="1" id="qty">
                                    <input type="hidden" name="price" value="<?php $amount = $subs->price - ($subs->price * $discount); echo ($discount > 0 && $subs->subscription_id != 5) ? $amount : $subs->price; ?>" id="price">
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


                                </form>
                                	<!--   Paypal ends  -->
                        <?php  }

                        if($pay_method == 'stripe' || $pay_method == 'both'){  ?>



                        <!--   Stripe starts  -->

                            <form style="display: hidden;justify-content: center;"  action="<?php echo site_url('subscription/stripe_checkout');?>" method="POST">
                              <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="<?php echo ($stripe->mode == "sandbox") ? $stripe->publishable_key_sandbox :  $stripe->publishable_key_live;?>"
                                data-image="http://phasebuilder.com/membershipkc/main/images/stripe-logo.png"
                                data-name="Phase Builder"
                                data-description="<?php echo $subs->title; ?>"
                                data-amount="<?php $amount = ($subs->price - ($subs->price * $discount))*100; echo ($discount > 0 && $subs->subscription_id != 5) ? $amount : $subs->price * 100  ; ?>"
                                data-label="">
                              </script>
                              	<input type="hidden" name="sub_id" value="<?php echo $subs->subscription_id; ?>">
                              <input type="hidden" name="price" value="<?php $amount = ($subs->price - ($subs->price * $discount))*100; echo ($discount > 0 && $subs->subscription_id != 5) ? $amount : $subs->price * 100  ; ?>">
                              <input type="hidden" name="duration" value="<?php echo $subs->duration; ?>">
                               <input type="hidden" name="plan" value="<?php echo $subs->title; ?>">
                               	<button type="submit" id="<?php echo "form_s_".$subs->subscription_id; ?>" > Auto click </button>
                            </form>

                        <?php }
                            }
                        ?>

                        <!--   Stripe ends  -->


                                <?php } ?>
<script>


  $("document").ready(function(){
       <?php echo ($pay_method == 'paypal' || $pay_method == 'both' && $sub_id != 5 && $sub_id != '' && $sub_id != 0) ? 'var form_p_5 = document.getElementById("form_p_5");

document.getElementById("order4_p").addEventListener("click", function () {
  form_p_5.submit();
});' : ''; ?>
       <?php echo ($pay_method == 'stripe' || $pay_method == 'both' && $sub_id != 5 && $sub_id != '' && $sub_id != 0) ? '

document.getElementById("order4_s").addEventListener("click", function () {
 document.getElementById("form_s_5").click() ;
});' : ''; ?>
      <?php echo ($pay_method == 'paypal' || $pay_method == 'both' && $sub_id != 3) ? 'var form_p_3 = document.getElementById("form_p_3");

document.getElementById("order3_p").addEventListener("click", function () {
  form_p_3.submit();
});' : ''; ?>
       <?php echo ($pay_method == 'stripe' || $pay_method == 'both' && $sub_id != 3) ? '

document.getElementById("order3_s").addEventListener("click", function () {
document.getElementById("form_s_3").click() ;
});' : ''; ?>
      <?php echo ($pay_method == 'paypal' || $pay_method == 'both' && $sub_id != 2) ? 'var form_p_2 = document.getElementById("form_p_2");

document.getElementById("order2_p").addEventListener("click", function () {
  form_p_2.submit();
});' : ''; ?>
       <?php echo ($pay_method == 'stripe' || $pay_method == 'both' && $sub_id != 2) ? '

document.getElementById("order2_s").addEventListener("click", function () {
document.getElementById("form_s_2").click() ;
});' : ''; ?>
      <?php echo ($pay_method == 'paypal' || $pay_method == 'both' && $sub_id != 1) ? 'var form_p_1 = document.getElementById("form_p_1");

document.getElementById("order1_p").addEventListener("click", function () {
  form_p_1.submit();
});' : ''; ?>
   <?php echo ($pay_method == 'stripe' || $pay_method == 'both' && $sub_id != 1) ? '

document.getElementById("order1_s").addEventListener("click", function () {
document.getElementById("form_s_1").click() ;
});' : ''; ?>
});
</script>
<?php  $this->load->view("common/footer.php"); ?>