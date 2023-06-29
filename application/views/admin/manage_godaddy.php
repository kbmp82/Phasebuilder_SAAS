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
            <h3 class="text-primary">Manage GoDaddy Domains</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">GoDaddy Domains</li>
            </ol>
        </div>
    </div>

    <div class="row">
     <div class="col-md-6" style="margin: 0 auto;">
                <div class="error_reported">
                        <?php
                            if($this->session->flashdata('domain_deleted')){
                                echo $this->session->flashdata('domain_deleted');
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
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Go Daddy Domains </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="subscription">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Domain</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

<?php
            if($godaddy_domains){
                // echo "<pre>" ;
                // print_R($domains) ;
                // echo "</pre>" ;
    foreach ($godaddy_domains as $value) { ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?> </td>
                                        <td><?php echo $value['domain']; ?></td>
                                     <td><span><a href="<?php echo base_url() ?>admin/domain/edit_domain/?action=assign_ns&domain=<?php echo $value['domain']; ?>">activate</a> / </span>
                                            <span><a id="delete" onclick="return confirm('Are you sure you want to delete this domain from the system?');" href="<?php echo base_url() ?>admin/domain/edit_domain/?action=delete&domain=<?php echo $value['domain']; ?>">delete</a></span>
                                        </td>

                                    </tr>
            <?php } }
                    else{
                ?>

                                <tr>
                                    <td colspan="6"><p style="    text-align: center;padding: 18px;">No record found</p></td>

                                </tr>
                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo site_url('admin/domain/activate_godaddy');?>" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
                    <button class="login100-form-btn" id="activate_all">
                                Activate All Domains
                            </button></form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin/common/footer.php"); ?>