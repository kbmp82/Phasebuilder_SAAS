<?php
/*echo "<pre>";
print_r($user_credentials);
echo "</pre>";
exit();*/

$price_basic=$price_premium=$price_elite='';
if(!empty($build_credentials)){

    $price_basic = $build_credentials[0]->price_basic;
    $price_premium = $build_credentials[0]->price_premium;
    $price_elite = $build_credentials[0]->price_elite;
    $iwriter_api = $build_credentials[0]->iwriter_api;
    $iwriter_user = $build_credentials[0]->iwriter_user;

}
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
?>
<script>
function getCredits() {
   //var userSelect = document.getElementById("article_user");
    //var userID = userSelect.options[userSelect.selectedIndex].value;

    $.ajax(
        {

        url: "<?php echo base_url(); ?>admin/credential/get_article_credits",

        type: "POST", //type of posting the data

        dataType: "text",

        timeout: 400000,

        data: {

            user: $("#article_user").val(),

            },
        beforeSend: function() {
                //console.log($("#gol_user").val() +' ' + $("#gol_domain").val());

            },
        success: function (data) {
                  var theSpan = document.getElementById("cur_creds");
                theSpan.innerHTML= '<strong>Current Credits Owned: '+data+'</strong>';



            },

        error: function(xhr, ajaxOptions, thrownError) {

                //what to do in error

                //  console.log('error');

            },

        complete: function(data) {

                  //console.log(data);

            }

        }
    );

}
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
    right:20em;
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
                    <h3 class="text-primary">Article Settings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Article Settings</li>
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
                     <div class="tab">
      <input id="tab-one" type="checkbox" name="tabs" class="tab-input">
      <label for="tab-one"><h3>Add Article Credits To User Account</h3></label>
      <div class="tab-content">

                            <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/article_credits" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
                         <div class="form-group  rs2-wrap-input100 m-b-20" style="width:100%;">
                         <label><h4><strong> User</strong></h4><p>Select the user who will receive the credits.</p></label>
                            <select id="article_user" name="article_user" class="input100 form-control" onchange = "getCredits()">

                                                            <option selected="true" value="" disabled>
                                    (Select user)
                                </option>
                                <?php

foreach ($users as $user) {?>
                                 <option value="<?php echo $user->ID; ?>"><?php echo $user->firstname; ?> <?php echo $user->lastname; ?> (<?php echo $user->username; ?>)</option>
                                  <?php }?>
                                </select>

                        </div>

                                <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4 id="cur_creds"><strong> Current Credits Owned: </strong></h4></label>

                                 </div>
                                <div class="form-group  rs1-wrap-input100 wrap-input100 m-b-20" style="width:100%;">
                            <label><h4><strong> Amount of Credits To Add </strong></h4></label>
                                    <input value="" id="article_creds" class="input100 form-control" type="text" name="article_creds" >
                                 </div>
                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="credits_add">
                                Add Credits
                            </button>
                        </div>

                    </form>
                    </div>
                    </div>
                        </div>
                    </div>
                </div>
                  <div class="col-md-1"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row clearfix">
        <div class="col-md-12 column">
              <div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
                    <h3>Article Settings</h3><p>These settings will affect the article prices and account used.</p>
                            <form class="login100-form validate-form register-form" id="register_form"  action="<?php echo $this->config->base_url(); ?>admin/credential/article_settings" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">
                             <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
                         <label><h4> <strong>iWriter API Key </strong></h4><p>You must email iwriter support and ask for an API key.</p></label>
                            <input value="<?php echo $iwriter_api; ?>" id="iwriter_api" class="input100 form-control" type="text" name="iwriter_api" >
                            <span class="focus-input100"></span>
                        </div>
                         <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
                         <label><h4> <strong>iWriter Username</strong></h4><p>iWriter username that the is registered to.</p></label>
                            <input value="<?php echo $iwriter_user; ?>" id="iwriter_user" class="input100 form-control" type="text" name="iwriter_user" >
                            <span class="focus-input100"></span>
                        </div>
                            <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
                         <label><h4> <strong>Basic Article Cost ($3.50 base) </strong></h4><p>The price a user will be charged for a basic article.</p></label>
                            <input value="<?php echo $price_basic; ?>" id="price_basic" class="input100 form-control" type="text" name="price_basic" placeholder="5.50">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
                         <label><h4> <strong>Premium Article Cost ($6.50 base) </strong></h4><p>The price a user will be charged for a premium article.</p></label>
                            <input value="<?php echo $price_premium; ?>" id="price_premium" class="input100 form-control" type="text" name="price_premium" placeholder="8">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="form-group  rs2-wrap-input100 validate-input m-b-20" style="width:100%;" data-validate="Enter Adsense Publisher ID">
                         <label><h4> <strong>Elite Article Cost ($11.50 base) </strong></h4><p>The price a user will be charged for an elite article.</p></label>
                            <input value="<?php echo $price_elite; ?>" id="price_elite" class="input100 form-control" type="text" name="price_elite" placeholder="13">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn">
                                Save Settings
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
<?php  $this->load->view("admin/common/footer.php"); ?>