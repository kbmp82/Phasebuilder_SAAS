<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");
$ci =&get_instance();
$ci->load->model('user/LoginModel');
$userdata = $ci->LoginModel->check_mysubscription($this->session->userdata['ID']);
$countdata = count($userdata);

?>
<script>
function showDiv(elem){
   if(elem.value == 'price_basic'){

      if(document.getElementById('a_credits').value > 0){
           document.getElementById('price').value = 'free';
           cost.style.display = "none";
           document.getElementById('credit_applied').style.display = "block";
      }else{
         document.getElementById('price').value = <?php echo $cost[0]['price_basic'];?>;
         cost.innerText = 'Cost: $<?php echo $cost[0]['price_basic'];?>';
         document.getElementById('credit_applied').style.display = "none";
      }

      document.getElementById('p_name').value = 'Article Creation - Basic';
      document.getElementById('description').value = 'Phase Builder basic article';
   }else if(elem.value == 'price_premium'){
      cost.innerText = 'Cost: $<?php echo $cost[0]['price_premium'];?>';
      document.getElementById('credit_applied').style.display = "none";
      cost.style.display = "block";
     document.getElementById('price').value = <?php echo $cost[0]['price_premium'];?>;
      document.getElementById('p_name').value = 'Article Creation - Premium';
      document.getElementById('description').value = 'Phase Builder premium article';
   }else if(elem.value == 'price_elite'){
       cost.innerText = 'Cost: $<?php echo $cost[0]['price_elite'];?>';

      document.getElementById('price').value = <?php echo $cost[0]['price_elite'];?>;
      document.getElementById('credit_applied').style.display = "none";
      cost.style.display = "block";
      document.getElementById('p_name').value = 'Article Creation - Elite';
      document.getElementById('description').value = 'Phase Builder elite article';

   }else{

   }

}
function showOptions(elem){
   if(elem.value == 'create_self'){
      title.style.display = "block";
       amazon_url_div.style.display = "block";
      // instructions.style.display = "none";
       keyword.style.display = "block";
       special_ins_div.style.display = "block";
       document.getElementById("order_article").disabled = false;
       document.getElementById("agree_article").checked = false;
   }else{
      title.style.display = "none";
      keyword.style.display = "none";
      // instructions.style.display = "none";
       auto.style.display = "block";
       special_ins.style.display = "none";
        document.getElementById("order_article").disabled = true;
        document.getElementById("agree_article").checked = false;
        document.getElementById("special_ins_check").checked = false;
   }

}
//says it needs to fill in article title and other fields on submit so need to fix that
function checkSpecial(elem){
   if(elem.checked == true){
      instructions.style.display = "block";

   }else{
       instructions.style.display = "none";
   }

}
function checkAgree(elem){
   if(elem.checked == true){
       document.getElementById("order_article").disabled = false;

   }else{
        document.getElementById("order_article").disabled = true;
   }

}
</script>
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
.login100-form {
    width: 100% !important;
    padding: 0 !important;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Order Articles</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>articles">Articles</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order Articles</a></li>
                    </ol>
                </div>
            </div>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

                                    <?php
            if($domains){
?>
<div class="row">
				  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="card panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
                            	<div class="error_reported">
						<?php
							if($this->session->flashdata('articles_update_success')){
							    $testing = $this->session->flashdata('articles_update_success');
								echo $this->session->flashdata('articles_update_success');
								?>
									<script>
									setTimeout(function()
									{
										jQuery(".error_reported").html("");
										jQuery(".error_reported").hide("slow");
									},3000);
									</script>
						<?php
							}
						?>
					</div>

                                <div class="col-md-12" style="float: left">
									<h2>Order An Article</h2><br /><p><h4><strong>Article Credits:  </strong><?php echo $credits[0]['article_credits'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle-o fa-1" data-toggle="tooltip" title="Each credit is good for a free 'Basic' article. Article credits renew at the beginning of each new billing period"></i></h4> </p><br />
                                    <p><strong>Basic:</strong> A unique article written for search engines with decent readability (some grammatical errors may occur)</p>
                                    <p><strong>Premium:</strong> A unique article with great readability written by a proven writer (little to no grammatical errors)</p>
                                    <p><strong>Elite:</strong> A unique article written by a top level writer to please visitors and search engines alike</p>
 <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo site_url('subscription/checkout');?>" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

									<input type="hidden" name="p_id" value="100" id="p_id">
                                    <input type="hidden" name="a_credits" value="<?php echo $credits[0]['article_credits'];?>" id="a_credits">
									<input type="hidden" name="p_name" value="" id="p_name">

									<input type="hidden" name="qty" value="1" id="qty">

									<input type="hidden" name="price" value="" id="price">

									<input type="hidden" name="shipping" value="0" id="shipping">

									<input type="hidden" name="tax" value="0" id="tax">

									<input type="hidden" name="pay_type" value="fixed" id="pay_type">

                                    <input type="hidden" name="sub_type" value="article" id="sub_type">

									<input type="hidden" name="billing_period" value="day" id="billing_period">

									<input type="hidden" name="billing_frequency" value="1" id="billing_frequency">

									<input type="hidden" name="billing_cycles" value="0" id="billing_cycles">

									<input type="hidden" name="currency" value="USD" id="currency">

									<input type="hidden" name="sub_id" value="100" id="sub_id">

									<input type="hidden" name="description" value="" id="description">
                                    <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
                                    <label><h4>Domain</h4><p>Select the domain the article will be posted on.</p></label>
                                                        <select id="article_domain" name="article_domain" class="input100 form-control">

                                                            <option value="">
                                    (Choose Your Domain)
                                </option>
                                <?php
                               foreach ($domains as $domain) { ?>
                                 <option value="<?php echo $domain['id']; ?>"><?php echo $domain['domain']; ?></option>
                                  <?php } ?>
                                </select>
                                </div>
                                    <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
                                    <label><h4>Article Type</h4></label>
                                   <select id="article_type" name="article_type" class="input100 form-control" onchange="showDiv(this)">

                                                            <option value="">
                                    (Choose Your Article Type)
                                </option>
                                <option value="price_basic">Basic</option>
                                <option value="price_premium">Premium</option>
                                 <option value="price_elite">Elite</option>
                                </select>
                                </div>

                                <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20">
                                    <label><h4>Article Creation Method</h4></label>
                                   <select id="article_creation" name="article_creation" class="input100 form-control" onchange="showOptions(this)">

                                                            <option value="">
                                    (Choose Option)
                                </option>
                                <option value="create_self">I want to add my own article details</option>
                                <option value="create_auto" disabled>Hands off (coming soon!)</option>
                                </select>

                                <p id="auto" style="display: none;"><br /><font color="red">AGREE TO TERMS:</font><br /><input id="agree_article" type="checkbox" onchange="checkAgree(this)"> I understand that by letting the Phase Builder system create an article for me I have no say in which product is chosen for the article topic. I understand that the system will, based on my websites categories, choose a randon product from Amazon that has at least a 4 star rating and a minimum price of $20.</p>
                                </div>
                                <div class="form-group rs1-wrap-input100 validate-input m-b-20" id="keyword" style="width:100%; display: none;">
                         <label><h4>Article Keyword</h4><p>Insert the keyword you want the article to be focused around for SEO purposes. For product reviews this is normally the full product name. <br>(<font color="red">One keyword or phrase only</font>)</p></label>
                            <input value="" id="article_keyword" class="input100 form-control"  type="text" name="article_keyword" placeholder="">

                        </div>
                                <div class="form-group rs1-wrap-input100 validate-input m-b-20" id="title" style="width:100%; display: none;">
                         <label><h4>Article Title</h4><p>Give your article a title. This should contain the article keyword for SEO purposes.</p></label>
                            <input value="" id="article_title" class="input100 form-control"  type="text" name="article_title">

                        </div>
                        <div class="form-group rs1-wrap-input100 validate-input m-b-20" id="amazon_url_div" style="width:100%; display: none;">
                         <label><h4>Amazon Product URL</h4><p>Paste in the URL to the product on Amazon.com</p><p><font color="red">* ENTER THE FULL PRODUCT URL, NO SHORTLINKS</font></p><p>Example url: https://www.amazon.com/Garmin-Navigator-Lifetime-Directions-Foursquare/dp/B01A1HL9Z6/</p></label>
                            <input value="" id="amazon_url" class="input100 form-control"  type="text" name="amazon_url">

                        </div>
                        <div class="form-group rs1-wrap-input100 validate-input m-b-20" id="special_ins_div" style="width:100%; display: none;">
                          <p id="special_ins"><br /><input id="special_ins_check" type="checkbox" onchange="checkSpecial(this)"> Add special instructions for the writer</p>
                        </div>


                        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" id="instructions" style="width:100%; display: none;">
                     <label><h3>Article Instructions</h3><br><p>Explain what to write the article about and any other details you feel are important.</p></label><br />
                            <textarea style="border: 1px solid #e6e6e6; padding-top: 12px; width: 100%" rows="5" id="article_ins" class="input100" name="article_ins" ></textarea>

                        </div>

  <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">
  <h3 id="cost" style="display: block;">Cost: $0.00</h3>
  <h3 id="credit_applied" style="display: none;">Cost: $0.00&nbsp;&nbsp; - <font color="red">(article credit applied)</font></h3>
</div>
                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="order_article">
                                Order Article
                            </button>
                        </div>
                				</form>
                                                    </div>

                        </div>
                    </div>
                </div>
                  <div class="col-md-1"></div>
        	</div>
            <?php
     }else{
         ?>
         <div><br /><br /><br /><br /><br /><br /><center><h2>You Have No Websites To Order Articles For</h2></center></div>
     <?php }
                ?>

        </div>
    </div>
</div>
</div>

	<?php  $this->load->view("common/footer.php"); ?>