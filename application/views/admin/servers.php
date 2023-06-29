<?php
/*echo "<pre>";
print_r($user_credentials);
echo "</pre>";
exit();*/

$max_products=$max_categories=$max_product_week=$price_range_min=$price_range_max='';
if(!empty($build_credentials)){
    $max_products = $build_credentials[0]->max_products;
    $max_categories = $build_credentials[0]->max_categories;
    $max_product_week = $build_credentials[0]->max_product_week;
    $price_range_min = $build_credentials[0]->price_range_min;
    $price_range_max = $build_credentials[0]->price_range_max;
}
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
?>
<script type="text/javascript">

$(document).ready(function($){

});
</script>
    <style>

/* Acordeon styles */
.tab {
  position: relative;
  margin-bottom: 1px;
  width: 100%;
  color: #0ca5da;
  overflow: hidden;
}

label {
  position: relative;
  display: block;
  padding: 0 0 0 1em;

  cursor: pointer;
  font-family: FontAwesome;
}

.tab-content {
  max-height: 0;
  overflow: hidden;
  -webkit-transition: max-height .35s;
  -o-transition: max-height .35s;
  transition: max-height .35s;
}


/* :checked */
input:checked ~ .tab-content {
  max-height: 100em;
}
/* Icon */
label::after {
  position: absolute;
  right:21em;
  top: .3em;
  -webkit-transition: all .35s;
  -o-transition: all .35s;
  transition: all .35s;
}
input[type=checkbox] + label::after {
 /*content: "\f063"; */
 content: "\25BC";
 font-size: 24px;
}

input[type=checkbox]:checked + label::after {
  transform: rotate(180deg);
}
.tab-input {
  position: absolute;
  opacity: 0;
  z-index: -1;
}

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
                    <h3 class="text-primary">Servers</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Servers</li>
                    </ol>
                </div>
            </div>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
             <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Server List </h4>
                    <input type="text" value="" id="filter" class="input100">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="users_list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Alias</th>
                                    <th>WHM Username</th>
                                    <th>WHM Password</th>
                                    <th>Nameserver 1</th>
                                    <th>Nameserver 2</th>
                                    <th>Main IP</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                        if($servers){
                                            $servers = json_encode($servers, true);
                                            $servers = json_decode($servers,true);

                                foreach ($servers as $server) {

                                ?>
                                    <tr>
                                        <td><?php echo $server['id']; ?> </td>
                                        <td><span><?php echo $server['server_alias']; ?></span></td>
                                        <td><?php echo $server['whm_user']; ?> </td>
                                        <td><?php echo $server['whm_pass']; ?> </td>
                                        <td><?php echo $server['nameserver_one']; ?></td>
                                        <td><span><?php echo $server['nameserver_two']; ?></span></td>
                                        <td><span><a href="https://<?php echo $server['ip']; ?>:2087" target="_blank"><?php echo $server['ip']; ?></a></span></td>
                                        <td><span><a href="<?php echo base_url() ?>admin/credential/edit_server/?action=edit&id=<?php echo $server['id']; ?>">Edit</a></span> / <span><a id="delete" onclick="return confirm('Are you sure you want to delete this server?');" href="<?php echo base_url() ?>admin/credential/delete_server/?action=delete&id=<?php echo $server['id']; ?>">Remove</a></span></td>
                                    </tr>
                                <?php }
                                        }
                                else{		?>

                                <tr>
                                    <td colspan="6"><p style="    text-align: center;padding: 18px;">No record found</p></td>

                                </tr>
                                    <?php
                                    }
                                        ?>
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
<script src="<?php echo $this->config->base_url(); ?>signin/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>signin/js/main.js"></script>
<?php  $this->load->view("admin/common/footer.php"); ?>