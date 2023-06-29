<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");

?>
    <!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
			<h3 class="text-primary">Payment Complete</h3> </div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Payment Complete</li>
			</ol>
		</div>
	</div>
	
	<h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Payment Complete</h2>
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
					<div class="col-md-4 column">
						<p><strong>Billing Information</strong></p>
						<p>
							<?php
							echo $cart['first_name'] . ' ' . $cart['last_name'] . '<br />' .
								$cart['email'] . '<br />'.
								$cart['phone_number'] . '<br />';
								echo (isset($cart['paypal_transaction_id'])) ? '<p><strong>Transaction ID</strong></p> '.$cart['paypal_transaction_id'] : '<p><strong>Payment Profile ID</strong></p> '.$cart['shopping_cart']['payment_profile_id'] ;
							?>
						</p>
					</div>
					<div class="col-md-4 column">
						<p><strong>Shipping Information</strong></p>
						<p>
							<?php
							echo $cart['shipping_name'] . '<br />' .
								$cart['shipping_street'] . '<br />' .
								$cart['shipping_city'] . ', ' . $cart['shipping_state'] . '  ' . $cart['shipping_zip'] . '<br />' .
								$cart['shipping_country_name'];
							?>
						</p>
					</div>

					<div class="col-md-4 column">
						<table class="table">
							<tbody>
							<tr>
								<td><strong> Subtotal</strong></td>
								<td> $<?php echo number_format($cart['shopping_cart']['subtotal'],2); ?></td>
							</tr>
							<tr>
								<td><strong>Grand Total</strong></td>
								<td>$<?php echo number_format($cart['shopping_cart']['grand_total'],2); ?></td>
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