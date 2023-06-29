<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Angell EYE - PayPal CodeIgniter Library Demo - Express Checkout - Order Cancelled</title>
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
            <h2 align="center">Order Cancelled</h2>
            <div class="alert alert-info">
                <p>Here we display a cancelled order notice to the buyer.</p>
            </div>
            <div class="alert alert-info">
                <p>The payment has not been processed at this point because we cancelled the payment.</p>
            </div>
            <a class="btn btn-primary" href="<?php echo site_url('paypal/demos/intro');?>">Start over</a>
        </div>
    </div>
</div>
</body>
</html>