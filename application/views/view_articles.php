<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");
$ci =&get_instance();
$ci->load->model('user/LoginModel');
$ci->load->model('user/ArticleModel');

$userdata = $ci->LoginModel->check_mysubscription($this->session->userdata['ID']);
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
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">View Articles</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>articles">Articles</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">View Articles</a></li>
                    </ol>
                </div>
            </div>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="row">
                        <div class="col-lg-12">
                                <div class="error_reported">
                        <?php
                            if($this->session->flashdata('articles_update_success')){
                                echo $this->session->flashdata('articles_update_success');
                                ?>
                                    <script>
                                   /* setTimeout(function()
                                    {
                                        jQuery(".error_reported").html("");
                                        jQuery(".error_reported").hide("slow");
                                    },3000);  */
                                    </script>
                        <?php
                            }
                        ?>
                    </div>
                        <div class="card">
                            <div class="card-title">
                                <h4>You have ordered <b><? echo count($articles); ?></b> articles</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="subscription">
                                        <thead>
                                            <tr>

                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Domain</th>
                                               <!-- <th>Requested Rewrites</th> -->
                                                <th>Order Date</th>
                                                <th>Delivery Date</th>
                                                <th>Post URL</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php

    if($articles){foreach($articles as $b_val){
?>
                                            <tr>

                                                <td><?php   echo $b_val['article_title'] ; ?> </td>
                                                <td><?php echo $b_val['type'] ; ?></td>
                                                <td><?php $domain = $ci->ArticleModel->get_domain($b_val['domain_mgmt_id']); echo $domain[0]['domain'];?></td>
                                              <!--  <td><?php echo $b_val['rewrites']; ?></td> -->
                                                <td><?php echo $b_val['creation_date']; ?></td>
                                                <td><?php echo ($b_val['delivery_date'] != 0) ?  $b_val['delivery_date'] :  '0000-00-00' ; ?></td>
                                                <td><?php echo ($b_val['post_url'] != 'pending') ? "<a href='".$b_val['post_url']."' target= '_blank'>".$b_val['post_url']."</a>" : $b_val['post_url']; ?></td>
                                                <td><?php echo $b_val['status']; ?></td>
                                                <td> <?php echo ($b_val['status'] == 'waiting review') ?  '<a href="review_article/?id='.$b_val['id'].'&d_id='.$b_val['domain_mgmt_id'].'">Review</a>'  :  '' ; ?></td>

                                            </tr>
<?php
    }
    }else{
?>

 <tr>
                                                <td colspan="6"><p style="text-align: center;padding: 18px;">No record found</p></td>

                                            </tr>
<?php  }   ?>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>

    <?php  $this->load->view("common/footer.php"); ?>