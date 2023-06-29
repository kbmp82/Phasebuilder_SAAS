<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");

?>
    <!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script-->
    <style>
        #angelleye-logo { margin:10px 0; }
        thead th { background: #F4F4F4;  }
        th.center {
            text-align:center;
        }
        td.center{
            text-align:center;
        }
        #paypal_errors {
            margin-top:25px;
        }
        .general_message {
            margin: 20px 0 20px 0;
        }
        #angelleye-demo-digital-goods-success-msg {
            display:none;
        }
		.order_info{
			margin-top: 20px;
		}
    </style>
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles" style="margin:0px !important">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Checkout</h3> </div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Checkout</li>
			</ol>
		</div>
	</div>
	
	<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Checkout</h2>
	
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<table class="table table-bordered">
					<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th class="center">Price</th>
						<th class="center">QTY</th>
						<th class="center">Total</th>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach($cart['shopping_cart']['items'] as $cart_item) {
						?>
						<tr>
							<td><?php echo $cart_item['id']; ?></td>
							<td><?php echo $cart_item['name']; ?></td>
							<td class="center"> $<?php echo number_format($cart_item['price'],2); ?></td>
							<td class="center"><?php echo $cart_item['qty']; ?></td>
							<td class="center"> $<?php echo round($cart_item['qty'] * $cart_item['price'],2); ?></td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
			<div class="col-md-12 column order_info">
				<div class="row clearfix">
					<div class="col-md-4 column"> </div>
					<div class="col-md-4 column"> </div>
					<div class="col-md-4 column">
						<table class="table">
							<tbody>
							<tr>
								<td><strong> Subtotal</strong></td>
								<td> $<?php echo number_format($cart['shopping_cart']['subtotal'],2); ?></td>
							</tr>
						<!--	<tr>
								<td><strong>Shipping</strong></td>
								<td>$<?php echo number_format($cart['shopping_cart']['shipping'],2); ?></td>
							</tr>
							<tr>
								<td><strong>Handling</strong></td>
								<td>$<?php echo number_format($cart['shopping_cart']['handling'],2); ?></td>
							</tr>
							<tr>
								<td><strong>Tax</strong></td>
								<td>$<?php echo number_format($cart['shopping_cart']['tax'],2); ?></td>
							</tr>
							-->
							<tr>
								<td><strong>Grand Total</strong></td>
								<td>$<?php echo number_format($cart['shopping_cart']['grand_total'],2); ?></td>
							</tr>
							<tr>
								<td class="center" colspan="2"><a href="<?php echo site_url('subscription/SetExpressCheckout'); ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"></a></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  $this->load->view("common/footer.php"); ?>