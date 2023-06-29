<?php
defined('BASEPATH') OR exit('No direct script access allowed');


?>

<?php
$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php"); 
//$this->load->library('javascript/jquery');
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
                        <table class="table" id="subscription11">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Payment Type</th>
                                    <th>Tax</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

<?php 
    if($subscriptions){
foreach ($subscriptions as $value) { ?> 
                                    <tr>
                                        <td><?php echo $value->subscription_id ; ?> </td>
                                        <td><?php echo $value->title; ?></td>
                                        <td><span><?php echo $value->subtitle; ?></span></td>
                                        <td><span><?php echo $value->pay_type; ?></span></td>
                                        <td><span><?php echo $value->tax ; ?></span></td>
                                        
                                        <td><span><a href="<?php echo base_url() ?>admin/subscription/edit_subscription/?action=edit&id=<?php echo $value->id; ?>">edit</a>/</span>
                                            <span><a id="delete" onclick="return confirm('Are you sure you want to delete this subscription?');" href="<?php echo base_url() ?>admin/subscription/edit_subscription/?action=delete&id=<?php echo $value->id; ?>">delete</a></span></td>
                                    </tr>           
<?php }
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