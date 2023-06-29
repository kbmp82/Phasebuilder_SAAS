<?php

defined('BASEPATH') OR exit('No direct script access allowed');





?>



<?php

$this->load->view("admin/common/header.php");

$this->load->view("admin/common/sidebar.php"); 

//$this->load->library('javascript/jquery');



$ci =&get_instance();



$ci->load->model('user/LoginModel');



$userdata = $ci->LoginModel->get_transaction();



$countdata = count($userdata);



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

    .login100-form {

        width: 100% !important;

        padding: 0 !important;

    }

    .rs1-wrap-input100, .rs2-wrap-input100 {

        width: 100% !important;

    }

    #pay_type,#type,#sub_type{

        height: 50px !important;

    }

    .rs2-wrap-input100 {

        border-left: 1px solid #e6e6e6 !important;

    }

</style>

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">

<!-- Page wrapper  -->



<style>

    .card {

        margin: 15px 44px;

    }

</style>

<!-- Page wrapper  -->

<div class="page-wrapper">





<div class="row page-titles">



                <div class="col-md-5 align-self-center">



                    <h3 class="text-primary">User Transaction</h3> </div>



                <div class="col-md-7 align-self-center">



                    <ol class="breadcrumb">



                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>



                        <li class="breadcrumb-item active">User transaction</li>



                    </ol>



                </div>



            </div>



    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-title">

                     <h4>Transaction History </h4>

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table" id="subscription11">

                            <thead>

                                <tr>

                                       <th>#</th>



                                                <th>TransactionID</th>



                                                <th>Subscription Name</th>



                                                <th>Order Date</th>



                                                <th>Amount Paid</th>



                                                <th>Currency</th>

                                                <th>Customer</th>

                                                <th>Payment Type</th>

                                    

                                </tr>

                            </thead>

                            <tbody>



<?php



$ci->load->model('user/SubscriptionModel');







if(!empty($userdata)){



$counter = 1;



foreach($userdata as $data){



$sub_id=   $data->subscriptionid ;
 $user_id = $data->user_id;
 $username = $ci->SubscriptionModel->get_user_name($user_id);

//  $name = $this->SubscriptionModel->get_subname_by_id();



 ?>

                                 

                                            <tr>



                                                <td><span><?php echo $counter; ?></span> </td>



                                                <td><span><?php echo $data->transaction_id; ?></span></td>



                                                <td><span><?php echo $data->title; ?></span></td>



                                                <td><span><?php echo $data->order_time; ?></span></td>



                                                <td><span><?php echo $data->amount; ?></span></td>



                                                <td><span><?php echo $data->currency_code; ?></span></td>

                                                <td><span><?php echo $username->firstname." ".$username->lastname; ?></span></td>

                                                <td><span><?php echo $data->payment_type; ?></span></td>



                                            </tr>         

<?php 

$counter++ ;

}

}

else{

?>                                         



                            <tr>



                                                <td colspan="6"><p style="    text-align: center;padding: 18px;">No record found</p></td>



                                                



                                            </tr>

<?php  } ?>                                

                          </tbody>



                                    </table>



                                </div>



                            </div>



                        </div>



                    </div>



                </div>



</div>



<?php $this->load->view("admin/common/footer.php"); ?>