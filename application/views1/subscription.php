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
	.page-titles h3{
color: #000 !important;
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
			
			<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Choose your subscription</h2>
          
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
			  <div class="row">
                <div class="col-md-3" style="">
                    <?php
                    $controller = 'Subscription.php';
                    $controller_exists = (file_exists(APPPATH."controllers/".$controller)) ? true : false;
                    $panel_class = ($controller_exists) ? ' panel-info' : ' panel-default';
                    ?>
                    <div class="panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-heading">
                            <h3>Express Checkout</h3>
                            <p>BASIC</p>
                        </div>
                        <div class="panel-body">
                            <p>Here we are integrating Express Checkout without any line item details or any extra features. We obtain the user's shipping information so that we can calculate shipping and tax, but otherwise no additional data is included with this checkout demo.</p>
                            <?php if($controller_exists) { ?>
							<form method="post" action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
								<input type="hidden" name="p_id" value="123-ABC" id="p_id">
								<input type="hidden" name="p_name" value="Testing" id="p_name">
								<input type="hidden" name="qty" value="1" id="qty">
								<input type="hidden" name="price" value="10.50" id="price">
								<input type="hidden" name="shipping" value="2" id="shipping">
								<input type="hidden" name="tax" value="1" id="tax">
								<input type="hidden" name="t3" value="W">
								<input type="submit" name="cart" value="Buy" class="btn btn-default btn-block">
							</form>
                            <?php } else { ?>
                                <a class="btn btn-default btn-block" href="https://www.angelleye.com/?s=codeigniter&post_type=product" target="_blank">Download/Buy</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
				<div class="col-md-3" style="">
                    <?php
                    $controller = 'Subscription.php';
                    $controller_exists = (file_exists(APPPATH."controllers/".$controller)) ? true : false;
                    $panel_class = ($controller_exists) ? ' panel-info' : ' panel-default';
                    ?>
                    <div class="panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-heading">
                            <h3>Express Checkout Test</h3>
                            <p>BASIC Test</p>
                        </div>
                        <div class="panel-body">
                            <p>Here we are integrating Express Checkout without any line item details or any extra features. We obtain the user's shipping information so that we can calculate shipping and tax, but otherwise no additional data is included with this checkout demo.</p>
                            <?php if($controller_exists) { ?>
							<form method="post" action="<?php echo site_url('subscription/checkout');?>" name="cart_items">
								<input type="hidden" name="p_id" value="GG-46" id="p_id">
								<input type="hidden" name="p_name" value="Express" id="p_name">
								<input type="hidden" name="qty" value="1" id="qty">
								<input type="hidden" name="price" value="22" id="price">
								<input type="hidden" name="shipping" value="4" id="shipping">
								<input type="hidden" name="tax" value="2" id="tax">
								<input type="hidden" name="t3" value="M">
								<input type="submit" name="cart1" value="Buy" class="btn btn-default btn-block">
							</form>
                            <?php } else { ?>
                                <a class="btn btn-default btn-block" href="https://www.angelleye.com/?s=codeigniter&post_type=product" target="_blank">Download/Buy</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
</div>
</div>
<?php  $this->load->view("common/footer.php"); ?>