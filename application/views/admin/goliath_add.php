<?php
defined('BASEPATH') or exit('No direct script access allowed');

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
?>
<script type="text/javascript">
function getDomains() {
    //var userSelect = document.getElementById("gol_user");
    //var userID = userSelect.options[userSelect.selectedIndex].value;
    $.ajax(
        {

        url: "<?php echo base_url(); ?>admin/credential/get_domains",

        type: "POST", //type of posting the data

        dataType: "text",

        timeout: 400000,

        data: {

            user: $("#gol_user").val(),

            },
        beforeSend: function() {
                //console.log($("#gol_user").val() +' ' + $("#gol_domain").val());

            },
        success: function (data) {

                let dropdown = $('#gol_domain');

                dropdown.empty();

                dropdown.append('<option selected="true" disabled>Select user domain</option>');
                dropdown.prop('selectedIndex', 0);

                // Populate dropdown with list of provinces
                var domainsArray = data;
                $.each(JSON.parse(domainsArray), function (key, entry)
                    {
                        dropdown.append($('<option></option>').attr('value', entry.id).text(entry.domain));
                    }
                )

            },

        error: function(xhr, ajaxOptions, thrownError) {

                //what to do in error

                //  console.log('error');

            },

        complete: function(data) {

                //   console.log(data);

            }

        }
    );

}
function getCategories() {
    $.ajax(
        {

        url: "<?php echo base_url(); ?>admin/credential/get_domain_cats",

        type: "POST", //type of posting the data

        dataType: "text",

        timeout: 400000,

        data: {

            user: $("#gol_user").val(),

            domain_id: $("#gol_domain").val()

            },
        beforeSend: function() {
                //console.log($("#gol_user").val() +' ' + $("#gol_domain").val());

            },
        success: function (data) {

                let dropdown = $('#gol_domain_cat');

                dropdown.empty();

                dropdown.append('<option selected="true" disabled>Select domain category</option><option value="all">All</option>');
                dropdown.prop('selectedIndex', 0);
                var cats = data.split(',');
                // Populate dropdown with list of provinces

                cats.forEach(function(entry)
                    {
                        dropdown.append($('<option></option>').attr('value', entry).text(entry));
                    }
                );

            },

        error: function(xhr, ajaxOptions, thrownError) {

                //what to do in error

                // console.log('error');

            },

        complete: function(data) {

                //   console.log(data);
            }

        }                                                                                       
    );

}
$(document).ready(function($)
    {

    }
);
</script>
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
                    <h3 class="text-primary">Goliath Settings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Goliath Settings</li>
                    </ol>
                </div>
            </div>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
              <div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="panel card <?php if (isset($panel_class)) {
    echo $panel_class;
}
?>">
                        <div class="panel-body">
                            <div class="error_reported">
                        <?php
if ($this->session->flashdata('credential_success')) {
    echo $this->session->flashdata('credential_success');
    ?>
                                    <script>
                                    setTimeout(function()
                                    	{
                                    		jQuery(".error_reported").html("");
                                    		jQuery(".error_reported").hide("slow");
                                    	}, 3000
                                    );
                                    </script>
                        <?php
}
?>
                    </div>
                    <h3>Add Products To A Users Domain</h3>
                            <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/goliath_add" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
                         <div class="form-group  rs2-wrap-input100 m-b-20" data-validate="Enter Adsense Publisher ID">
                         <label><h4><strong> User</strong></h4><p>Select the user whose domain will receive new products.</p></label>
                            <select id="gol_user" name="gol_user" class="input100 form-control" onchange = "getDomains()">

                                                            <option value="">
                                    (Select user)
                                </option>
                                <?php

foreach ($users as $user) {?>
                                 <option value="<?php echo $user->ID; ?>"><?php echo $user->firstname; ?> <?php echo $user->lastname; ?> (<?php echo $user->username; ?>)</option>
                                  <?php }?>
                                </select>

                        </div>
                         <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" >
                                    <label><h4><strong> User Domain</strong></h4><p>Select the domain the products will be posted on.</p></label>
                                                        <select id="gol_domain" name="gol_domain" class="input100 form-control" onchange = "getCategories()">

                                                            <option value="">
                                    (Select users domain)
                                </option>
                                </select>
                                </div>
                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" >
                                <label><h4><strong> Domain Category</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle-o fa-2" data-toggle="tooltip" title=" Selecting 'All' will spread the products out amoungst all categories."></i></h4><p>Select the category the products will be posted under.</p></label>
                                                        <select id="gol_domain_cat" name="gol_domain_cat" class="input100 form-control">

                                                            <option value="">
                                    (Select domain category)
                                </option>
                                </select>
                                </div>
                                <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20"  data-validate="Enter Amazon API Key">
                            <label><h4><strong> Amount of Products To Add </strong></h4></label>
                                    <input value="" id="gol_products" class="input100 form-control" type="text" name="gol_products" >
                                 </div>
                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="goliath_add">
                                Add Products
                            </button>
                        </div>

                    </form>
                        </div>
                    </div>
                </div>
                  <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo $this->config->base_url(); ?>signin/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo $this->config->base_url(); ?>signin/js/main.js"></script>
<?php $this->load->view("admin/common/footer.php");?>
