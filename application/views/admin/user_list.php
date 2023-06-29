<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
$ci =&get_instance();
$ci->load->model('user/WebsiteModel');
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
    tbody tr td{
        color: #1e1f21;
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
            <h3 class="text-primary">User</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">user</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Users Record </h4>
                    <input type="text" value="" id="filter" class="input100">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="users_list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Builds Remaining</th>
                                    <th>Total Domains Built</th>
                                    <th>Account Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!--
                            <form action="#" method="post">
                                <tr>
                                    <td><input type="text" id="id" value=""></td>
                                    <td><input type="text" id="firstname" value=""></td>
                                    <td><input type="text" id="lastname" value=""></td>
                                    <td><input type="text" id="email" value=""></td>
                                    <td></td>
                                    <td><a href="<?php echo base_url() ?>admin/user/get_user_list">filter</a></td>
                                   <!-- <td><input type="button" class="filter" onclick="filter_data();" value="Filter"></td>-->
                                   <!--
                                </tr>
                                </form>
                                -->
                                <?php
										if($users){			
								foreach ($users as $value) {
                                	$used_domains = $ci->WebsiteModel->count_user_domain($value['ID']);
                                ?>
                                    <tr>
                                        <td><?php echo $value['ID']; ?> </td>
                                        <td><span><?php echo ($value['role'] != 'admin' ? 'client' : $value['role']); ?></span></td>
                                        <td><?php echo $value['firstname']; ?> </td>
                                        <td><?php echo $value['lastname']; ?> </td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><span><?php echo $value['allowed_domains']; ?></span></td>
                                        <td><span><?php echo $used_domains; ?></span></td>
                                        <td><span><?php
                                         $user_d = json_encode($this->RegisterModel->check_mysubscription($value['ID']), true);
                                        
                                        $user_d = json_decode($user_d, true);
                                        if($user_d[0]['suspended'] === 1){
                                          ?>Suspended <?php
                                        }else{
                                           ?>Active <?php
                                        } ?>
                                        </span></td>
                                        <td><span><a href="<?php echo base_url() ?>admin/user/edit_user/?action=edit&id=<?php echo $value['ID']; ?>">Edit</a></span> / <span><a id="delete" onclick="return confirm('Are you sure you want to delete this user?');" href="<?php echo base_url() ?>admin/user/edit_user/?action=delete&id=<?php echo $value['ID']; ?>">Remove</a></span>

									   </td>
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
<script>
    function filter_data(){


      var base_url="<?php echo base_url() ?>";

      $.ajax({
         type: "POST",
         url: base_url + "admin/user/get_user_list",
         data: {id: $("#id").val()},
         dataType: "text",
         success:
              function(data){
                //alert(data);  //as a debugging message.
              }

      });
  }
</script>

<?php $this->load->view("admin/common/footer.php"); ?>