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
                    <h3 class="text-primary">Fund PhasseBuilder Account</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Fund Account</li>
                    </ol>
                </div>
            </div>


<div class="container">

    <div class="row clearfix">
        <div class="col-md-12 column">

              <div class="row">
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
                  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">
                    <h3>Fund PhasseBuilder Account</h3><p>Add funds to the PhaseBuiler PayPal account.</p>
                           <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QHVKK7UMVTAKL">
<table>
<tr><td><input type="hidden" name="on0" value="Amount to Fund">Amount to Fund</td></tr><tr><td><select name="os0">
    <option value="50">50 $50.00 USD</option>
    <option value="100">100 $100.00 USD</option>
    <option value="200">200 $200.00 USD</option>
    <option value="300">300 $300.00 USD</option>
    <option value="500">500 $500.00 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
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