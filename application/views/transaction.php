<?php

	

$this->load->view("common/header.php");

 $this->load->view("common/sidebar.php");



$ci =&get_instance();

$ci->load->model('user/LoginModel');

$userdata = $ci->LoginModel->check_transaction($this->session->userdata['ID']);

$countdata = count($userdata);

      

?>

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

                                    <table class="table" id="transaction">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>TransactionID</th>

                                                <th>Transaction Name</th>

                                                <th>Order Date</th>

                                                <th>Amount Paid</th>

                                                <th>Currency</th>

                                                <th>Payment Status</th>

                                            </tr>

                                        </thead>

                                        <tbody>

<?php

$ci->load->model('user/SubscriptionModel');



if(!empty($userdata)){

$counter = 1;

foreach($userdata as $data){

$sub_id=   $data->subscriptionid ;



    //  $name = $this->SubscriptionModel->get_subname_by_id();

                    

?>

                                            <tr>

                                                <td><span><?php echo $counter; ?></span> </td>

                                                <td><span><?php echo $data->transaction_id; ?></span></td>

                                                <td><span><?php echo $data->title; ?></span></td>

                                                <td><span><?php echo $data->order_time; ?></span></td>

                                                <td><span><?php echo $data->amount; ?></span></td>

                                                <td><span><?php echo $data->currency_code; ?></span></td>

                                                <td><span><?php echo $data->payment_status; ?></span></td>

                                            </tr>

                                           

                                          <?php 

$counter = $counter+1;

}

}else{ ?> 



 <tr>

                                                <td colspan="6"><p style="    text-align: center;padding: 18px;">No record found</p></td>

                                                

                                            </tr>





<?php } ?>

                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

</div>



<?php

$this->load->view("common/footer.php");

?>