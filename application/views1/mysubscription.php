<?php
	
$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");

$ci =&get_instance();
$ci->load->model('user/LoginModel');
$userdata = $ci->LoginModel->check_mysubscription($this->session->userdata['ID']);
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
                    <h3 class="text-primary">User Subscription</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">user subscription</li>
                    </ol>
                </div>
            </div>

<div class="row">
	                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Subscription Record </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>StartDate</th>
                                                <th>EndTime</th>
                                                <th>Amount Paid</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
if(!empty($userdata)){
$counter = 1;
foreach($userdata as $data){

if($data->subscription_id == 1){ $name = 'Testing'; }else{ $name = 'Express';}

?>
                                            <tr>
                                                <td><?php echo $counter; ?> </td>
                                                <td><?php echo $name; ?></td>
                                                <td><span><?php echo $data->start_date; ?></span></td>
                                                <td><span><?php echo $data->end_date; ?></span></td>
                                                <td><span><?php echo $data->amount; ?></span></td>
                                                <td><span class="badge badge-success">Open</span></td>
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