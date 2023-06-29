<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");


$ci =&get_instance();
$ci->load->model('user/SubscriptionModel');

    $pay_method =   $ci->SubscriptionModel->get_active_payment() ;
     $sub_id = $ci->SubscriptionModel->get_subscribed_subscription();

?>
<link rel="stylesheet" type="text/css" href="http://phasebuilder.com/assets/css/pricing.css">
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

                    <h3 class="text-primary">Addons</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Addons</li>

                    </ol>

                </div>

            </div>



            <h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Choose your Add-Ons</h2>



<div class="container">
    <div class="row clearfix" style="/* margin-left: -220px; */" >
        <div class="col-md-12 column">
              <div class="row" style="flex-flow: nowrap;">
                  <div class="beginner">
        <div class="offerTitle" style=" font-size: 2.5vw;">
          <span style="padding-bottom:2vw;">Domain Credits</span>
          <div class="stores">
            <span>Handpick The Domain Of Your Choice</span><br>
          </div>
        <!--  <div class="freeTrial">
            <span>Bonus: 5 Days Free Trial</span>
            <p>You Save By Choosing Us</p>
          </div> -->
        </div>
        <p style="font-size: 1vw;color: #fff;margin-top:20px;">Domain credits allow you to choose any domain from our inventory of aged, high quality, domains.</p><p style="font-size: 1vw;color: #fff;"> Each time you handpick a domain it cost 1 credit.</p><p style="font-size: 1vw;color: #fff;">You will be able to select your domain on the 'New Builds' page.</p>
        <div class="price">
          <span style="padding-bottom:2vw;padding-top: 2vw;">$5</span>
          <div class="monthly">
            <span>per credit</span>
          </div>
        </div>
        <div class="offersFeaturesCenter">
          <span class="seperator"></span>
           <!--  <center>

          <span style="color:#fff">Credits To Purchase </span><br>
             <input style="align-items: center;margin-top: 10px;color: #000;text-align: center;"  type="text" class="input-lg" name="credits" id="credits"/>
           </center> -->

          <!--<div>
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
          </div> -->
        </div>
        <div class="orderNow">
           <span class="orderButton order1" id="order4_p">Pay With PayPal</span>
          <span class="orderButton order1" id="order4_s">Pay With Stripe</span>


        </div>
      </div>

                 <?php

                if(!empty($add_ons)){
                     // var_dump($add_ons);
                    foreach($add_ons as $subs){

                  if($pay_method == 'paypal' || $pay_method == 'both'){

                          ?>
                    <!--   Paypal starts  -->
                                <form method="post" id="<?php echo "form_p_".$subs->subscription_id; ?>" style="display: flex;justify-content: center;"  action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
                                    <input type="hidden" name="p_id" value="<?php echo $subs->subscription_id; ?>" id="p_id">
                                    <input type="hidden" name="p_name" value="<?php echo $subs->title; ?>" id="p_name">
                                    <input type="hidden" name="qty" value="1" id="qty">
                                    <input type="hidden" name="price" value="<?php echo $subs->price; ?>" id="PayPalPrice">
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

                            <form style="display: none;justify-content: center;"  action="<?php echo site_url('subscription/stripe_checkout');?>" method="POST">
                              <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="<?php echo ($stripe->mode == "sandbox") ? $stripe->publishable_key_sandbox :  $stripe->publishable_key_live;?>"
                                data-image="http://phasebuilder.com/membershipkc/main/images/stripe-logo.png"
                                data-name="Phase Builder"
                                data-description="<?php echo $subs->title; ?>"
                                data-amount="<?php echo $subs->price*100  ; ?>"
                                data-label="">
                              </script>
                              	<input type="hidden" name="sub_id" value="<?php echo $subs->subscription_id; ?>">
                              <input type="hidden" id="stripePrice" name="price" value="<?php echo $subs->price*100  ; ?>">
                              <input type="hidden" name="duration" value="<?php echo $subs->duration; ?>">
                               <input type="hidden" name="plan" value="<?php echo $subs->title; ?>">
                               	<button  type="submit" id="<?php echo "form_s_".$subs->subscription_id; ?>" > Auto click </button>
                            </form>

                        <?php }
                            }
                        ?>

                        <!--   Stripe ends  -->


                                <?php } ?>



        	</div>

        </div>

    </div>

</div>

</div>
<?php  $this->load->view("common/footer.php"); ?>
 <script>


  $("document").ready(function(){

      <?php echo ($pay_method == 'paypal' || $pay_method == 'both' && $sub_id != 4) ? 'var form_p_4 = document.getElementById("form_p_4");

document.getElementById("order4_p").addEventListener("click", function () {
  form_p_4.submit();
});' : ''; ?>
       <?php echo ($pay_method == 'stripe' || $pay_method == 'both' && $sub_id != 4) ? '

document.getElementById("order4_s").addEventListener("click", function () {
document.getElementById("form_s_4").click() ;
});' : ''; ?>

});
/*
var typingTimer;                //timer identifier
var doneTypingInterval = 2000;  //time in ms, 5 second for example
var $input = $('#credits');

//on keyup, start the countdown
$('#credits').keyup(function(){
    clearTimeout(typingTimer);
    if ($('#credits').val()) {
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    }
});

//on keydown, clear the countdown
$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping () {
  var credits = document.getElementById("credits").value;
  alert('credits is: '+credits);
  var stripePrice = <?php echo $subs->price*100  ; ?> * credits;
   var PayPalPrice = <?php echo $subs->price  ; ?> * credits;
   document.getElementById("stripePrice").value = stripePrice;
   document.getElementById("PayPalPrice").value = PayPalPrice;
   alert(document.getElementById("PayPalPrice").value);
    alert(document.getElementById("stripePrice").value);
}  */
</script>
