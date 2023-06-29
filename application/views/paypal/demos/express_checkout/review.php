<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Angell EYE - PayPal CodeIgniter Library Demo - Express Checkout - Review Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Angell EYE">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>

<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div id="header" class="row clearfix">
                <div class="col-md-6 column">
                    <div id="angelleye-logo">
                        <a href="<?php echo site_url('paypal/demos/intro');?>"><img class="img-responsive" alt="Angell EYE PayPal CodeIgniter Library Demo" src="https://www.angelleye.com/images/paypal-codeigniter-library-demo-header.png"></a>
                    </div>
                </div>
            </div>
            <h2 align="center">Express Checkout - Review Order</h2>
            <div class="alert alert-info">
                <p>Here we display a final review to the buyer now that we've calculated shipping, handling, and tax. The billing and shipping information provided here is what we obtained in the GetExpressCheckoutDetails response.</p>
            </div>
            <div class="alert alert-info">
                <p>The payment has not been processed at this point because we have not yet called the final DoExpressCheckoutPayment API call. That is what will happen when we click the "Complete Order" button below.</p>
            </div>
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
            <div class="row clearfix">
                <div class="col-md-4 column">
                    <p><strong>Billing Information</strong></p>
                    <p>
                        <?php
                        echo $cart['first_name'] . ' ' . $cart['last_name'] . '<br />' .
                            $cart['email'] . '<br />'.
                            $cart['phone_number'] . '<br />';
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
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td>$<?php echo number_format($cart['shopping_cart']['grand_total'],2); ?></td>
                        </tr>
                        <tr>
                            <td class="center" colspan="2">
                                <a class="btn btn-primary btn-block" href="<?php echo site_url('paypal/demos/express_checkout/DoExpressCheckoutPayment'); ?>">Complete Order</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>