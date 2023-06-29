    <?php

    //$this->load->view('functions.php');



    $month_ago = strtotime('-30 days');

    $current_date = strtotime('now');

    defined('BASEPATH') OR exit('No direct script access allowed');



    $this->load->view("common/header.php");

    $this->load->view("common/sidebar.php");

    ?>

    <html>



        <style>

  .custom_background {
    background      : rgba(16, 20, 33, 0.9);
    justify-content : center !important;
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

    .rs1-wrap-input100, .rs2-wrap-input100 {

        float: left;

    }

    select#node {

        background: #ffffff;

        width: 100%;

        height: 40px;

        padding-left: 18px;

        border: 2px solid #e7e7e7;

    }

    .amazon_sellers,.amazon_cats{

        float: left;

        margin-top: 10px;

    }

    label{

        /*font-weight: 600 !important;  */

    }

    .all_btns{

        margin-top: 20px !important;

        float: left;

    }

    #selbrands,#selsellers,#selcategories{

        padding: 5px 8px;

    }

    input#categories,input#categories:focus {

        border: 2px solid #e7e7e7 !important;

        width: 100%;

        padding: 8px;

    }

    .selected_cats{

        float: left;

        width: 100%;

        margin-top: 10px;

    }
p.pmargn {

    margin-top: 15px;
}

/* loader */
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: #101421
                url('http://i.stack.imgur.com/FhHRx.gif')
                50% 50%
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal {
    overflow: hidden;
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}
.custom_class_overlay {
    color: #fff;
    white-space : pre-line ;
    font-size     : 40px;
        text-align    : center;
        padding       : 10px;
}


    </style>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
       <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/colorSelect.css">
          <script src="<?php echo $this->config->base_url(); ?>signin/js/colorSelect.js"></script>


    <?php

        $ci =&get_instance();

    $ci->load->model('user/LoginModel');

    $ci->load->model('user/WebsiteModel');

    $user_id =  $this->session->userdata['ID']  ;
     $whm['demo'] = $ci->WebsiteModel->get_build_creds();
      $demoDomain = $whm['demo'][0]->demo_domain;

    $userdata = $ci->LoginModel->get_user($user_id);

    $allowed_domains  =  $userdata->allowed_domains ;
    $domain_credits =   $userdata->domain_credits;
    $used_domains = $ci->WebsiteModel->count_user_domain($user_id);

    //$left_domain =  $allowed_domains - $used_domains ;
    $chosen_domain = $ci->WebsiteModel->grab_domain($allowed_domains);
    $time_left = $ci->WebsiteModel->get_time_remaining($chosen_domain);
    //$user_creds = "";
    $user_creds = json_encode($user_creds);
    $user_creds = json_decode($user_creds);

    ?>



       <!-- Page wrapper  -->

            <div class="page-wrapper">

                <!-- Bread crumb -->

                <div class="row page-titles" style="margin:0px !important">

                    <div class="col-md-5 align-self-center">

                        <h3 class="text-primary">Build Website</h3> </div>

                    <div class="col-md-7 align-self-center">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                            <li class="breadcrumb-item active">Website</li>

                        </ol>

                    </div>

                </div>

                        <h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Website details</h2>








                <div class="container">

                    <div class="row clearfix">

                        <div class="col-md-12 column">

                              <div class="row">

                                  <div class="col-md-1"></div>

                                  <div class="col-md-10" style="margin: 0 auto;">

    <?php

                if($allowed_domains == 0 && $this->session->userdata('account_status') != "Demo"){

                ?>

    <div class="subscription_ovr" style="text-align:center">

      <strong>Warning!</strong>

        <p style="text-align:center;margin-bottom: 26px;">

    You have reached the maximum allowed builds for the current billing period. You may upgrade your subscription to build more or wait until the next billing period.

        <a href="http://phasebuilder.com/membershipkc/subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;">Upgrade</a></p>

        </div>

    <?php 			}elseif(!$user_creds){ ?>
                      <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;" id="domain_reset">
       <center>
      <strong><h2>Oh No!</h2></strong>



    <h3>You have't entered your build credentials in the 'Credentials' tab.<br>We can't build your sites until you do so. </h3><br><a href="http://phasebuilder.com/membershipkc/credential"><h3><font color="blue">Click here to do that now</font></h3></a>.
        </center>
        </div>
       <?php     }else	{

    ?>

        <div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">





                                              <div class="panel-body">
                                                   <?php if($site_mode == "test"){
                                             echo '<div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;" id="domain_reset">
                                         <form enctype="multipart/form-data" class="login100-form validate-form register-form" id="reset_domain_form"  action="" method="" style="padding-top:40px !important;padding-bottom:42px !important;">
                                          <label><h4><strong> Reset Domain (test mode):</strong> </h4></label>';

                                                 $domains_select = "";
                                                   $user_domains = json_encode($user_domains);
                                                   $user_domains = json_decode($user_domains);

                                                     foreach ($user_domains as $domain) {
                                   $domains_select .= '<option value="'.$domain->domain.'">'.$domain->domain.'</option>';
                                  }
                                                     echo '<div class="form-group wrap-input100 m-b-20" style="width:97%">
                                    <label><h4>Choose Domain</h4><p>Select the domain to reset.</p></label>
                                                        <select id="domain_reset" name="domain_reset" class="input100 form-control">

                                                            <option value="">
                                    (Choose Domain)
                                </option>'.$domains_select.'</select></div>



                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 resetdomain" style="width:100%;" style="text-align: center;" >

                                                 <button type="submit" class="login100-form-btn"  id="reset_domain_button">Reset Domain</button>
                                            </div>
                                         </form>
                                </div>';
                                } ?>

                                                 <a href="javascript:void(0);" id="welcome_tour_show_me" style="float:right" onclick="buildTour()"><font color="blue">Show me what to do</font></a>
                                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">

                                                    <label id="helptour-0"><h4><strong> Builds Remaining:</strong> <?php echo ($this->session->userdata('account_status') != "Demo") ? $allowed_domains : '1';	  ?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle-o fa-1" data-toggle="tooltip" title="The number of websites you are allowed to build on the Phase Builder platform. Builds reset each new billing period and unused builds rollover."></i></h4></label>
                                                    <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" id="helptour-1" data-step="1" data-intro="Choose the type of domain you want to use to build your website." style="width:100%">
                         <label><h4><strong>Domain Options</strong></h4><p>Choose an option to build your website.</p></label>
                           <?php if($this->session->userdata('account_status') != "Demo"){  ?>
                             <fieldset id="domain_build_radios" style="border: none">
        <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" id="domain_build" name="domain_build" value="own" onclick="domainOption(this);">&nbsp;&nbsp;Use my own domain
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="domain_build" name="domain_build" value="aged" onclick="domainOption(this);">&nbsp;&nbsp;Provide me a high quality, aged domain (better for SEO rankings)
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="domain_build" name="domain_build" value="cherry" onclick="domainOption(this);">&nbsp;&nbsp;Choose a high quality, aged domain from the Phase Builder domain inventory
    </label>
    </fieldset> <?php
                           }else{       ?>
                               <fieldset id="domain_build_radios" style="border: none" disabled>
        <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" id="domain_build" name="domain_build" value="own">&nbsp;&nbsp;Use my own domain
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="domain_build" name="domain_build" value="aged"  checked="checked">&nbsp;&nbsp;Provide me a high quality, aged domain (aged domains are better for SEO rankings) - (<font color="red">demo mode</font>)
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="domain_build" name="domain_build" value="cherry">&nbsp;&nbsp;Hand pick a high quality, aged domain from the Phase Builder domain inventory
    </label>
    </fieldset>  <?php
                           }  ?>

                        </div>
                                                </div>
                                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">
                        <form id="cat_research" action="deploy-website.php" class="js-ajax-php-json" method="post" accept-charset="utf-8">
                                             <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%; display:none;" id="aged_domain">
                                                    <font color="red">IMPORTANT:</font> You have <strong><?php echo $time_left; ?></strong> remaining to build your website on this domain and claim it otherwise it will be given to another user and you will be assigned a new one.
                                                    <br /><br /><label><h4><strong>Domain:</strong>	<?php echo ($this->session->userdata('account_status') != "Demo") ? $chosen_domain : 'Demo';	  ?></h4></label>

                                                     <input type="hidden" id="domain_name_aged" value="<?php echo $chosen_domain;	  ?>">


                                                </div>
                                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%; display:none;" id="own_domain">
                                                    <font color="red">NAMESERVER SETUP:</font> Before you use your own domain you must change your existing nameservers to <strong>ns3.phase5holdings.com</strong> and <strong>ns4.phase5holdings.com</strong>
                                                    <div class="form-group" style="width:97%;"><br />

                                                        <label><h4><strong>Domain Name</strong></h4></label><input value="" id="own_domain_entry" class="input100 form-control mediumbox" type="text" name="own_domain_entry" placeholder="">

                                                    </div>
                                                    <div style="text-align: center; width:97%;">
            <button type="submit" class="login100-form-btn" id="verify_ns">Verify Namservers</button>
</div>
</div>
<div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%; display:none;" id="own_domain_success">
<label><h4 id="chosen_d_own"></h4></label>
<input type="hidden" id="domain_name_own" value="">
</div>
                                             <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%; display:none;" id="cherry_domain">
                                                 <label><h4><strong> Domain Credits:</strong> <?php echo $domain_credits;	  ?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle-o fa-1" data-toggle="tooltip" title="Domain credits allow you to hand pick a domain from the Phase Builder inventory and can be purchased from the Add-Ons section."></i></h4></label>
                                                 <?php
                                                 $domains_select = "";
                                                 if($domain_credits > 0){
                                                     foreach ($domain_list as $domain) {
                                   $domains_select .= '<option value="'.$domain->id.'">'.$domain->domain.'</option>';
                                  }
                                                     echo '<div class="form-group wrap-input100 m-b-20" style="width:97%">
                                    <label><h4>Choose Domain</h4><p>Select the domain to build.</p></label>
                                                        <select id="domain_name_cherry" name="domain_name_cherry" class="input100 form-control">

                                                            <option value="">
                                    (Choose Domain)
                                </option>'.$domains_select.'</select></div> ';
                                }else{
                                   echo '<div class="form-group wrap-input100 m-b-20" style="width:97%"><h5>Need domain credits? Head over to the <strong><a href="'.$this->config->base_url().'Subscription/add_addOns"><font color="blue"><u>Addons</u></font></a></strong> section.</h5></div>';
                                }
                                ?>



                                </div>


                                            <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" data-step="2" id="helptour-2" data-intro="Decide if you want to display 3rd party advertisements on your website. *Note: You must add your information in the 'Credentials' tab first." style="width:100%">
                         <label><h4><strong>Display Third Party Ads On Website</strong> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle-o fa-1" data-toggle="tooltip" title="These settings can be found in the 'Credentials' section."></i></h4><p>Show Google Adsense or Amazon Ads on the website.</p></label>
                            <fieldset id="show_ads" style="border: none">
        <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" id="ads" name="ads" value="no">&nbsp;&nbsp;None
    </label>
    <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" id="ads" name="ads" value="both">&nbsp;&nbsp;Both Ad Types
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="ads" name="ads" value="amazon">&nbsp;&nbsp;Amazon Product Ads
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="ads" name="ads" value="google">&nbsp;&nbsp;Google Adsense Ads
    </label>
    </fieldset>

                        </div>
                        <div style="width: 97%; border: none" class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" id="helptour-3" data-step="3" data-intro="Choose a theme color for you new website or check the 'Random' box and be surprised!" data-validate="Enter Amazon API Key">

                                                      	<label><h4><strong>Color Theme</strong></h4></label><select id="theme_color" name="theme_color">


                                                                    <option value="#c6b81b">
                                                                           </option>
                                                                    <option value="#d32f2f">
                                                                            </option>
                                                                    <option value="#5c6bc0" selected="selected">
                                                                           </option>
                                                                    <option value="#3d5afe">
                                                                            </option>
                                                                    <option value="#64b5f6">
                                                                            </option>
                                                                            <option value="#0097a7">
                                                                            </option>
                                                                            <option value="#388e3c">
                                                                            </option>
                                                                            <option value="#81c784">
                                                                            </option>
                                                                            <option value="#607d8b">
                                                                            </option>
                                                                            <option value="#e64a19">
                                                                            </option>

                                                        </select>
                                                       &nbsp;&nbsp;&nbsp;<input type="checkbox" style="transform: scale(1.7); margin-top: 19px;" name="theme_color_random" id="theme_color_random" value="random">&nbsp;&nbsp;Random
                                                    </div>
                                            <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" id="helptour-4" data-step="4" data-intro="The title of your website that visitors will see. It's a good idea to use your niche in the title!" style="width:97%;" data-validate="Enter Amazon API Key">

                                                        <label><h4><strong>Site Name</strong></h4><p>Give your new website a name. This will be visible to your website vistors.</p></label><input value="" id="site_name" class="input100 form-control mediumbox" type="text" name="site_name" placeholder=""><span class="focus-input100"></span>

                                                    </div>

                                                    <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" id="helptour-5" data-step="5" data-intro="In the 'Site Topic' field enter the keyword or phrase you would use to find products for your niche on Amazon." style="width:97%;" data-validate="Enter Amazon API Key">

                                                        <label><h4><strong>Amazon Search Keyword</strong></h4><p>The keyword or phrase you would use to search Amazon in order to find products in your niche. Ex: A site selling dog toys, the keyword could be 'dog toys'.</p><p><br><font color="red">IMPORTANT: Use 1 keyword or phrase only. For best result use a single keyword or phrase no longer than 3 words in length.</font></p><p>*If no results are returned, there are no products for that phrase on Amazon.</p></label><input value="" id="site_kwd" class="input100 form-control mediumbox" type="text" name="site_kwd" placeholder=""><span class="focus-input100"></span>

                                                    </div>

                                                    <div style="width: 97%; border: none" class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" id="helptour-6" data-step="6" data-intro="Choose a category that best describes yoru niche" data-validate="Enter Amazon API Key">

                                                      	<label><h4><strong>Amazon Category</strong></h4><p>The category on Amazon that best fits your websites topic.</p></label><select id="node" name="node">

                                                            <option value="0">
                                    (select main Amazon category)
                                </option>
                                <option value="0">
                                    (any)
                                </option>
                                                                    <option value="2858778011">
                                        Amazon Video                                    </option>
                                                                    <option value="2619525011">
                                        Appliances                                    </option>
                                                                    <option value="2350149011">
                                        Apps &amp; Games                                    </option>
                                                                    <option value="2617941011">
                                        Arts, Crafts &amp; Sewing                                    </option>
                                                                    <option value="15690151">
                                        Automotive Parts &amp; Accessories                                    </option>
                                                                    <option value="165796011">
                                        Baby                                    </option>
                                                                    <option value="11055981">
                                        Beauty &amp; Personal Care                                    </option>
                                                                    <option value="1000">
                                        Books                                    </option>
                                                                    <option value="5174">
                                        CDs &amp; Vinyl                                    </option>
                                                                    <option value="2335752011">
                                        Cell Phones &amp; Accessories                                    </option>
                                                                    <option value="7141123011">
                                        Clothing, Shoes &amp; Jewelry                                    </option>
                                                                    <option value="4991425011">
                                        Collectibles &amp; Fine Art                                    </option>
                                                                    <option value="541966">
                                        Computers                                    </option>
                                                                    <option value="14297978011">
                                        Courses                                    </option>
                                                                    <option value="3561432011">
                                        Credit and Payment Cards                                    </option>
                                                                    <option value="163856011">
                                        Digital Music                                    </option>
                                                                    <option value="493964">
                                        Electronics                                    </option>
                                                                    <option value="2238192011">
                                        Gift Cards                                    </option>
                                                                    <option value="16310101">
                                        Grocery &amp; Gourmet Food                                    </option>
                                                                    <option value="11260432011">
                                        Handmade                                    </option>
                                                                    <option value="3760931">
                                        Health, Household &amp; Baby Care                                    </option>
                                                                    <option value="10192820011">
                                        Home &amp; Business Services                                    </option>
                                                                    <option value="1063498">
                                        Home &amp; Kitchen                                    </option>
                                                                    <option value="16310091">
                                        Industrial &amp; Scientific                                    </option>
                                                                    <option value="133141011">
                                        Kindle Store                                    </option>
                                                                    <option value="9479199011">
                                        Luggage &amp; Travel Gear                                    </option>
                                                                    <option value="7175545011">
                                        Luxury Beauty                                    </option>
                                                                    <option value="599858">
                                        Magazine Subscriptions                                    </option>
                                                                    <option value="2625373011">
                                        Movies &amp; TV                                    </option>
                                                                    <option value="11965861">
                                        Musical Instruments                                    </option>
                                                                    <option value="1084128">
                                        Office Products                                    </option>
                                                                    <option value="2972638011">
                                        Patio, Lawn &amp; Garden                                    </option>
                                                                    <option value="2619533011">
                                        Pet Supplies                                    </option>
                                                                    <option value="7301146011">
                                        Prime Pantry                                    </option>
                                                                    <option value="409488">
                                        Software                                    </option>
                                                                    <option value="3375251">
                                        Sports &amp; Outdoors                                    </option>
                                                                    <option value="468240">
                                        Tools &amp; Home Improvement                                    </option>
                                                                    <option value="165793011">
                                        Toys &amp; Games                                    </option>
                                                                    <option value="468642">
                                        Video Games                                    </option>
                                                                    <option value="2983386011">
                                        Wine                                    </option>

                                                        </select>

                                                    </div>
                                                    <!--
                                                    <div style="width: 100%; border: none" class="form-group wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="">

                                                        <input type="checkbox" id="return_count" name="return_count" value="yes" disabled> Grab the number of products for each category result (this can take up to 5 mins) - coming soon!

                                                    </div>
                                                    -->
                                            <div class="catrsrch" style="text-align: center;" >
                                                 <!-- <input class="login100-form-btn" id="reserach_cats" type="submit" name="reserach_cats" value="Research Categories"  /></button> -->
                                                 <button type="submit" class="login100-form-btn helptour" id="helptour-7" data-step="7" data-intro="When ready, click 'Research Categories' and Phase Builder will bring back all the categories for that topic so you can choose the best ones for your website." id="reserach_cats">Research Categories</button>
                                            </div>
                                            </form>
    												</div>


                                            <br />
                                            <div class="multi_categories form-group wrap-input100 rs1-wrap-input100 m-b-20form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="8" data-intro="The categories will be shown filtered into groups in these boxes. Each category you select will become a category on your website populated with products from Amazon. Choose wisely!" style="display: none; width:100%;">

                                                <div class="col-md-12">

                                                   <label><h4><strong>Website Categories</strong></h4><p>Select the categories you want to inlcude on your website. You may select up to 10 categories and each category will contain up to 50 Amazon products.</p><p><font color="red">CTRL + click to select multiple lines</font></p></label>

                                                </div>

                                               <div id="container" class="red">



                                                  <div class="blue">

                                                     <form id="build_site_form" action = "">
                                                     <div id="helptour-8">
                                                     <div class="col-md-12 amazon_brands">

                                                        <label><h4><strong>Amazon Brands</strong></h4></label>

                                                        <select id = "selbrands" style="width: 100%;" multiple = "multiple" size = "5">

                                                        </select>

                                                     </div>

                                                     <div class="col-md-6 amazon_sellers">

                                                        <label><h4><strong>Amazon Sellers</strong></h4></label>

                                                        <select id = "selsellers" style="width: 100%;" multiple = "multiple" size = "5">

                                                        </select>

                                                     </div>

                                                     <div class="col-md-6 amazon_cats">

                                                        <label><h4><strong>Amazon Categories</strong></h4></label>

                                                        <select id = "selcategories" style="width: 100%;" multiple = "multiple" size = "5">

                                                        </select>

                                                     </div>

                                                      </div>
                                                      <br />

                                                     <div id="helptour-9" class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width: 97.5%;">

                                                        <button class="login100-form-btn" style="width:100%" type = "button" onclick = "showChoices()">Use Selected Categories</button>
                                                        </div>
                                                        <div id="helptour-10" class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width: 97.5%;">
                                                        <button class="login100-form-btn-danger" style="width:100%" type = "button" onclick = "clearSelect()">Clear Selections</button>
                                                     </div><div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 selected_cats" style="width: 97.5%;">

                                                        <label><h4><strong>Selected Categories (10 categories max)</strong></h4><p>Each category below will be a category on your website.</p></label>

                                                        <div id="helptour-11" class="top-right">

                                                            <input type="text" class="longbox" id="categories" style="width: 97.5%;"/>

                                                         </div>

                                                     </div><br /><br />

                                                      <div id ="helptour-12" class="col-md-12 all_btns blue" style="text-align: center;">
            <button type="submit" class="login100-form-btn" id="createwebsite">Build Website</button>
</div>

                                                  </form>

                                                  </div>
                                                  <div class="modal"></div>
                                               </div>

                                            </div>

                                        </div>



                                    </div>

                            <?php   }  ?>

                                  </div>

                                  <div class="col-md-1"></div>

                              </div>

                        </div>

                    </div>
               <!-- <iframe id="asg_frame" src="" style="width:0;height:0;border:0; border:none;"></iframe> -->
               <iframe data-isloaded="" id="asg_frame" src="" style="width: 1px;height:1px;"></iframe>

                </div>





    <?php  $this->load->view("common/footer.php"); ?>

 <!--script src="http://code.jquery.com/jquery-1.9.1.js"></script-->

       <!--  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.5/dist/loadingoverlay.min.js"></script> -->

        <script type="text/javascript">


    //from multi-select.html

      function showChoices(){

      //retrieve brands data

      var selbrands = document.getElementById("selbrands");

      //set up output string

      var result = "";

      //result += "<ul> <br>";

      //step through options

      for (i = 0; i < selbrands.length; i++){

       //examine current option

       currentOption = selbrands[i];

       //print it if it has been selected

       if (currentOption.selected == true){

       result += currentOption.value + ",";

       } // end if

      } // end for loop

      //retrieve sellers data

      var selsellers = document.getElementById("selsellers");

      //set up output string

      //result += "<ul> <br>";

      //step through options

      for (i = 0; i < selsellers.length; i++){

       //examine current option

       currentOption = selsellers[i];

       //print it if it has been selected

       if (currentOption.selected == true){

       result += currentOption.value + ",";

       } // end if

      } // end for loop

      //retrieve categories data

      var selcategories = document.getElementById("selcategories");

      //set up output string

      //result += "<ul> <br>";

      //step through options

      for (i = 0; i < selcategories.length; i++){

       //examine current option

       currentOption = selcategories[i];

       //print it if it has been selected

       if (currentOption.selected == true){

       result += currentOption.value + ",";

       } // end if

      } // end for loop

      //finish off the list and print it out

      result = result.substring(0, result.length - 1);



      categories_box = document.getElementById("categories");


      categories_box.value = result;

      } // end showChoices

   function domainOption(mySelection) {
       if(mySelection.value == "own"){
             document.getElementById("own_domain").style.display = "block";
             document.getElementById("aged_domain").style.display = "none";
             document.getElementById("own_domain_success").style.display = "none";
             document.getElementById("cherry_domain").style.display = "none";
       }else if(mySelection.value == "aged"){
           document.getElementById("aged_domain").style.display = "block";
            document.getElementById("own_domain").style.display = "none";
            document.getElementById("own_domain_success").style.display = "none";
            document.getElementById("cherry_domain").style.display = "none";
       }else if(mySelection.value == "cherry"){
           document.getElementById("aged_domain").style.display = "none";
            document.getElementById("own_domain").style.display = "none";
            document.getElementById("own_domain_success").style.display = "none";
            document.getElementById("cherry_domain").style.display = "block";
       }


    //alert('Old value: ' + currentValue);
    //alert('New value: ' + mySelection.value);
    //currentValue = myRadio.value;
}
var timer = 0;
 var waitInterval = 0;
var maxProducts = <?php echo $build_creds[0]['max_products']; ?>;
var maxProductsCat = <?php echo $build_creds[0]['max_products_category']; ?>;
var all_brands_sellers = new Array();
    $("document").ready(function(){
        var bugout = new debugout();

     $("input[name=domain_build][value=aged]").prop('checked', true);
      document.getElementById("aged_domain").style.display = "block";
            document.getElementById("own_domain").style.display = "none";
            document.getElementById("own_domain_success").style.display = "none";
            document.getElementById("cherry_domain").style.display = "none";
     $("input[name=ads][value=no]").prop('checked', true);
    window.addEventListener("message", receiveMessage, false);
function receiveMessage(event)
{
        var myMsg = event.data;
        if(myMsg == 'yes'){
            iframeValue = 1;
            bugout.log('message received and data is: '+myMsg);
           // document.getElementById('asg_frame').setAttribute('data-isloaded','yes');
            }
}
        $('#theme_color').colorSelect();
     //global ajax timeout
     $.ajaxSetup({timeout:60000}); //in milliseconds
     $('#loading').show();
function titleCase(str) {
   var splitStr = str.toLowerCase().split(' ');
   for (var i = 0; i < splitStr.length; i++) {
       // You do not need to check if i is larger than splitStr length, as your for does that for you
       // Assign it back to the array
       splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
   }
   // Directly return the joined string
   return splitStr.join(' ');
}


      $(".js-ajax-php-json").submit(function(){
       var site_mode = '<?php echo $site_mode ; ?>';
       if(site_mode != "test"){
        var data = {

          "action": "test"

        };

      var keyword = document.getElementById("site_kwd");

      browsenode = document.getElementById("node");
       if(keyword.value != '' & browsenode.value != 0){
          	data = $(this).serialize() + "&" + $.param(data);

        $.ajax({

          type: "POST",

          dataType: "json",

          timeout: 400000,

          url: "<?php echo base_url() ?>website/cats",

          data: data,

          beforeSend: function(){
             /*
           var theButton = document.getElementById("reserach_cats");
          $("#reserach_cats").attr("disabled", true);
            $("#reserach_cats").css('background','#e7e7e7');

  theButton.innerHTML='<font color="black"><i class="fa fa-spinner fa-spin"></i>    Researching</font>';
          //$("#reserach_cats").prop('disabled', true);
          // $("#reserach_cats").val(<i class="fa fa-circle-o-notch fa-spin"></i> + 'Researching Categories');
        // Show image container
       */
      $.LoadingOverlay("show", {
          image : 'http://phasebuilder.com/membershipkc/main/images/Gears-3s-200px.gif',
          imageAnimation: "",
          backgroundClass : "custom_background",
          direction       : "row",
          textClass   : "custom_class_overlay",
          text: "  Generating Categories...\n\n\n\n (Please Do Not Close Browser)"



    });

       // $("#loader").show();

       },

          success: function(data) {

          bugout.log(data);

              var brand_options = '';

               var seller_options = '';
                var seller ='';
                var category_options = '';
                var brand ='';
                var res ='';
                var keyStart ='';
                var theKeyword = '';
          for (var i = 0; i < data.length; i++) {
             // bugout.log('BRAND IS: '+data[i].brand);
              if(data[i].brand){
                  all_brands_sellers.push(data[i].brand);
                 //   brand = data[i].brand.toLowerCase();

                 //  theKeyword = keyword.value.toLowerCase();

// keyStart = brand.indexOf(theKeyword) - 1;

    // res = brand.substring(0, keyStart);
    // res =  titleCase(res);
                  if(data[i].bsearch){

               brand_options += '<option value="' + data[i].brand + '">' + data[i].brand + '	(' + data[i].bsearch + ')</option>';

               }

               else{

                 brand_options += '<option value="' + data[i].brand + '">' + data[i].brand + '</option>';

                 }





              }

             if(data[i].seller){
                 all_brands_sellers.push(data[i].seller);
                  // seller = data[i].seller.toLowerCase();
                  // bugout.log('seller IS: '+seller);
                 //  theKeyword = keyword.value.toLowerCase();

 //keyStart = seller.indexOf(theKeyword) - 1;

    // res = seller.substring(0, keyStart);
   //  res =  titleCase(res);
                 if(data[i].ssearch){

            seller_options += '<option value="' + data[i].seller + '">' +  data[i].seller + '	(' + data[i].ssearch + ')</option>';

            }

            else{

                 seller_options += '<option value="' + data[i].seller + '">' +  data[i].seller + '</option>';

            }

            }

             if(data[i].scategory){

                 if(data[i].csearch){

            category_options += '<option value="' + data[i].scategory + '">' + data[i].scategory + '	(' + data[i].csearch + ')</option>';

            }

            else{

              category_options += '<option value="' + data[i].scategory + '">' + data[i].scategory + '</option>';

            }



            }

          }

          //bugout.log(brand_options);

          $("select#selbrands").html(brand_options);

         // bugout.log(brand_options);

          $("select#selsellers").html(seller_options);

         // bugout.log(brand_options);

          $("select#selcategories").html(category_options);
            // bugout.log(category_options);
          $(".multi_categories").slideDown(1000);

             /*

              for (var i=0;i<data.length;i++) {

                   $(".the-return").append(

            data[i].brand + "	" + data[i].search + "<br>"

          );

     }

    */



          },

          complete:function(data){
              bugout.log(data);
        $("#reserach_cats").hide();
       $.LoadingOverlay("hide");
        if(hopscotch.getState() == "build-tour:7") {
             //buildTour2();
             hopscotch.nextStep();
        }
       }

        });
       }else{
         alert("Fill in all fields to proceed");

       }

        return false;
       }else{

        $(".multi_categories").slideDown(1000);
        if(hopscotch.getState() == "build-tour:7") {
            // buildTour2();
             hopscotch.nextStep();
        }
         return false;
       }
      });
      //reset domain
      $('#reset_domain_button').click(function(e){

          var domain = $('#domain_reset option:selected').val();

      e.preventDefault();

    $.ajax({

           url: "<?php echo base_url() ?>/website/reset_domain",

           type: "POST",//type of posting the data

           dataType: "text",

           data:{
                domain: domain
                },
           beforeSend: function(){

		// Show image container

	  $.LoadingOverlay("show", {

          image : 'http://phasebuilder.com/membershipkc/main/images/Gears-3s-200px.gif',
          imageAnimation: "",
          backgroundClass : "custom_background",
          direction       : "row",
          text        : "  Resetting Domain...",
          textColor               : "#fff",

    });

	   // $("#loader").show();

	   },

           success: function (data) {
              // bugout.log(data);
               $.LoadingOverlay("hide");
             window.location.href = "<?php echo base_url() ?>website";

           },

           error: function(xhr, ajaxOptions, thrownError){

              //what to do in error

               bugout.log('error');

           },

            complete:function(data){
       }

      });

    });
      //verify namservers
      	$('#verify_ns').click(function(){

          var domain = document.getElementById('own_domain_entry').value;
          if(domain.indexOf('http://') > 0){
            var domain_fixed =  domain.replace('http://','');
          }else{
             var domain_fixed =  domain;
          }

      //e.preventDefault();

   if(domain_fixed != ''){
        $.ajax({

           url: "<?php echo base_url() ?>website/verify_ns",

           type: "POST",//type of posting the data

           dataType: "text",

            timeout: 400000,

           data:{
                domain_ns : domain_fixed,
                },

                      beforeSend: function(){
                      var theButton = document.getElementById("verify_ns");
          $("#verify_ns").attr("disabled", true);
            $("#verify_ns").css('background','#e7e7e7');

  theButton.innerHTML='<font color="black"><i class="fa fa-spinner fa-spin"></i>    Verifying Namservers</font>';
       },

           success: function (data) {
                            if(data.indexOf("ns3.phase5holdings.com") > -1 && data.indexOf("ns4.phase5holdings.com") > -1){

           var domain = document.getElementById('own_domain_entry').value;
          if(domain.indexOf('http://') > 0){
            var domain_fixed =  domain.replace('http://','');
          }else{
             var domain_fixed =  domain;
          }
          document.getElementById('chosen_d_own').innerHTML = "<strong>Domain:</strong> " + domain_fixed;
          document.getElementById('domain_name_own').value = domain_fixed;
       document.getElementById("own_domain").style.display = "none";
        document.getElementById("own_domain_success").style.display = "block";
}else{
    alert('Nameservers not verified. If you just changed them try again in 24 hours.')
}


           },

           error: function(xhr, ajaxOptions, thrownError){

              //what to do in error

               bugout.log('error');

           },

            complete:function(data){
             var theButton = document.getElementById("verify_ns");
           $("#verify_ns").attr("disabled", false);
          $("#verify_ns").css('background','#0ca5da');
          $('#verify_ns').hover(
    function(){
      var $this = $(this);
      $this.data('bgcolor', $this.css('background-color')).css('background-color', '#e7e7e7');
    },
    function(){
      var $this = $(this);
      $this.css('background-color', $this.data('bgcolor'));
    }
  );
  theButton.innerHTML='Verify Nameservers';

       }

      });
      } else {
        alert("Fill in your domain to continue");
    }

    });
       //build the website
        $('#createwebsite').click(function(e){
            var testResult;
           // var domainResult = array();
            var successDomain = '';
       e.preventDefault();
     var demo = '<?php echo $this->session->userdata('account_status');?>';
	var selbrands = $("#selbrands").val();

	var selsellers = $("#selsellers").val();

	var selcategories = $("#selcategories").val();

		   //	showChoices();

		   //var site = '';

		  var site_name = document.getElementById('site_name').value;
          if(demo == "Demo"){
              var domainType = "Demo";
              var subdomain = "demo-<?php echo $user_id; ?>"+Math.random().toString(36).substr(2, 6);
              var domain = subdomain+'.<?php echo $demoDomain; ?>';
              //alert(domain);
              var domain_id = 0;
          }else{
              var subdomain = 'none';
              var domainType = "reg";
              var domain_id = $("#sel_domain_id").val();
             var radioSelection = document.querySelector('input[name="domain_build"]:checked').value;
         if(radioSelection == "own"){
                var domain = document.getElementById('own_domain_entry').value;
         }else if(radioSelection == "aged"){
                var domain = document.getElementById('domain_name_aged').value;
         }else if(radioSelection == "cherry"){
                var domain = document.getElementById('domain_name_cherry').value;
         }
          }



		//  var domain = $("#sel_domain").val()	;

		  var site_kwd = document.getElementById('site_kwd').value;
          var ads_option = document.querySelector('input[name="ads"]:checked').value;

		  var node = document.getElementById('node').value;
           if(document.getElementById("theme_color_random").checked == true){
                var theme_color_random = "random";
           }else{
             var theme_color_random = "no";
           }

          var e = document.getElementById("theme_color");
          var theme_color = e.options[e.selectedIndex].value;

	//var start_pos = node.indexOf('(') + 1;

	//var end_pos = node.indexOf(')',start_pos);

	//var node = node.substring(start_pos,end_pos)
          var categories = '';
          var categoriesArray = '';
		  categories = document.getElementById('categories').value;

          var categoriesArray = categories.split(",");
          var tempKeyASG = '';
          var tempKey = '';

          for (var y = 0; y < categoriesArray.length; y++) {
            for (var z = 0; z < all_brands_sellers.length; z++) {

                   if(all_brands_sellers[z] == categoriesArray[y]){

                     tempKeyASG = categoriesArray[y]+' '+site_kwd+'-ASG';
                      tempKey = categoriesArray[y];

                     categories =  categories.replace(tempKey, tempKeyASG);

                   }
           }
           }


	 // e.preventDefault();

 if(categories != '' && ads_option != '' && site_kwd != ''){
      $.confirm({
      smoothContent: true,
    columnClass: 'col-md-5',
    title: 'Before we begin...',
    content: '<center><img src="<?php echo $this->config->base_url(); ?>images/builder.png"></center>'+'<p>Our builders work fast but <strong>these sites can take up to 60 minutes to build</strong>. During this time please do not close the browser.</p><br><br>',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
    buttons: {
       'confirm': {
                                    text: 'Proceed',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                     $.ajax({

          url: "<?php echo base_url() ?>website/test_keys",

           dataType: "text",

           beforeSend: function(){
            bugout.log('sending CATEGORIES: '+categories);
		// Show image container

	  $.LoadingOverlay("show", {

          image : 'http://phasebuilder.com/membershipkc/main/images/Gears-3s-200px.gif',
          imageAnimation: "",
          backgroundClass : "custom_background",
          direction       : "row",
         // text        : "  Testing API Keys...",
         // textColor               : "#fff",
          textClass   : "custom_class_overlay",
          text: "Testing API Keys..."

    });

	   },

           success: function (data) {
               bugout.log('data is: '+data);
             testResult = data.trim();

           },

           error: function(xhr, ajaxOptions, thrownError){

              //what to do in error

               bugout.log('error');

           },

            complete:function(data){
               if(testResult == 1){
                   bugout.log('access keys are good..building website: '+domain);
                          $.ajax({

		   url: "<?php echo base_url() ?>website/new_user",

		   type: "POST",//type of posting the data

		   dataType:"text",

			timeout: 200000,

		   data:{

				site_name : site_name,

				domain : domain,
                domainType: domainType,
				site_kwd : site_kwd,
                 subdomain: subdomain,
				node : node,
                radioSelection: radioSelection,
				categories : categories,

			  	domain_id :  domain_id,
                theme_color : theme_color,
                theme_color_random : theme_color_random,
                ads_option: ads_option

				},

					  beforeSend: function(){

		// Show image container

       $.LoadingOverlay("text", "Building Website... \n\n\n\n(Do Not Close Browser)");

	   // $("#loader").show();

	   },

		   success: function (data) {


	    bugout.log(data);

             if(data.indexOf("wordpress success") > -1){
                               // $.LoadingOverlay("hide");
                                bugout.log('wordpress installed successfully');
                                successDomain = true;
     // window.location.href = "<?php echo base_url() ?>builds";
}else{
     successDomain = false;
    bugout.log('wordpress not installed: '+data);
   // successDomain = "bad";
    // window.location.href = "<?php echo base_url() ?>website";
}

				//bugout.log(data);

			//$(".the-return").html(data);



		   },

		   error: function(data){

			  //what to do in error

   // bugout.log(data);

		   },

			complete:function(data){
			    if(domain != '' && successDomain != false){
			    if(demo == "Demo"){
                 maxProductsCat = 10;
			    }
			    //bugout.log(data);
			     var catNum = 1;
                 var catID = 0;
                 var catName;
                 var postsAdded;
                 var checkCounter = 0;
                 var increment = getIncrement();
                 bugout.log('increment is: '+increment);
                 var remainingCats = categoriesArray.length;
                  var percent = 0;
                   var totalRounds  =  maxProductsCat / maxProducts;
                  var rounds = 1;
                  if(totalRounds % 1 != 0){
                      totalRounds = Math.trunc(totalRounds) + 1;
                  }
                  var catObj = {};
                  for (var i = 0; i < categoriesArray.length; i++) {
                      catName = categoriesArray[i];
                   catObj[catName] = 0;
                    bugout.log('queueing categories.  catName is: '+catName+' and catObj[catName] is '+catObj[catName]);
                    //bugout.log(catObj.catName);
                  }

              addProducts();
function getIncrement(){
       var total_products = categoriesArray.length * maxProductsCat;
       var single_result = (10 / total_products) * 100;
       incrementValue = single_result / 30;
       return incrementValue;
}
       function addProducts(){
              // $.LoadingOverlay("hide");

           //check if category elements is in array and if total products added to category is laess than max allowed
     if(catNum <= categoriesArray.length){
         bugout.log('adding products '+catNum);
            bugout.log('total rounds is '+totalRounds);
            bugout.log('on round '+rounds);
         catName = categoriesArray[catID];
         bugout.log('category is '+catName+' and catID is: '+catID);
         bugout.log('catObj[catName] is '+catObj[catName]+' and maxProductsCat is: '+maxProductsCat);
        if(catObj[catName] < maxProductsCat){
            $.LoadingOverlay("text", "Adding Products... "+percent+"%"+"\n\n\n\n(Do Not Close Browser)");
		   $("#asg_frame").attr("src", "http://"+domain+"/forcurl"+catNum);
           // bugout.log('http://'+successDomain+'/forcurl'+catNum);
          // call the wait function to check every 5 seconds of the iframe has returned a value of 1. 1 = finished
          checkCounter = 0;
          waitFrame();

        }else{
            bugout.log('cat is at max product of: '+maxProductsCat);
            catID++;
            catNum++;
          remainingCats--;
          addProducts();
        }

     }else{
         bugout.log('done with round '+rounds);
         rounds++;
         if(rounds <= totalRounds && remainingCats > 0){
           catNum = 1;
           catID = 0;
           addProducts();
         }else{
             if(demo == "Demo"){
                 $.ajax({
          url: "<?php echo base_url() ?>website/finished_demo"
        });
                  $.LoadingOverlay("hide");
            window.location.href = "<?php echo base_url() ?>builds";
			    }else{
                    $.LoadingOverlay("hide");
            window.location.href = "<?php echo base_url() ?>builds";
			    }


         }

     }
 }

function waitFrame(){

   setTimeout(function(){
       if(checkCounter == 5){

       $.ajax({
                 type: "POST",
                   //	timeout: 40000,
                // url: "http://"+successDomain+"/asg.txt",
               url: "<?php echo base_url() ?>website/update_asg_status",
                 dataType: "text",
                 data:{ domain: domain },
                 success: function (data) {
                      bugout.log("asg data is: "+data);
                     if(data.indexOf("message") > -1){
                         var obj = JSON.parse(data);
                        // bugout.log(data);
                        if(obj['message'].indexOf('No products found') > -1){
                             bugout.log("No products found in message...message is: "+obj['message']+' setting postsAdded to 0');
                            postsAdded = 0;
                        }else if(obj['message'].indexOf('No new products found') > -1){
                            bugout.log("No new products found in message...message is: "+obj['message']+' setting postsAdded to 0');
                            postsAdded = 0;
                        }else if(obj['status'] == 'error'){
                            bugout.log("error with posting products...message is: "+obj['message']+' setting postsAdded to 0');
                            postsAdded = 0;
                        }else{
                           postsAdded = obj['message'].match("Finished. (.*) posts added successfully.");
            postsAdded = postsAdded[1];
            bugout.log("grabbing posts added....postsAdded = "+postsAdded);
                       }
                        //add total posts to category product count
             if(postsAdded < maxProducts){
                 bugout.log("postsAdded is less than maxProucts..postsAdded was: "+postsAdded+' and maxProducts is: '+maxProducts);
                //catName = categoriesArray[catID];
                catObj[catName] = maxProductsCat;
            }else{
                bugout.log('catObj[catName] updated. Total posts BEFOR was: '+catObj[catName]);
                var currentCatNum =  parseInt(catObj[catName]);

                catObj[catName] = currentCatNum + parseInt(postsAdded);
                bugout.log('Total posts AFTER is: '+catObj[catName]+' and catName is: '+catName);

            }

    // bugout.log('total posts: '+postsAdded);
    // var category = categoriesArray[catID];
                        // bugout.log(' category is: '+category);
                         $.when(updateCategories()).then(moveOn);


    }else{
     checkCounter = 0;
     waitFrame();
  }
		   }

             });
             }else{
              checkCounter++;
              percent = percent + increment;
              if(percent > 100){
                  var entireLog = bugout.getLog();
               $.ajax({
                 type: "POST",
                   //	timeout: 40000,
                 url: "<?php echo base_url() ?>website/save_log",
		   dataType: "text",
		   data:{ entireLog : entireLog},
             });
              }
             $.LoadingOverlay("text", "Adding Products... "+Math.round(percent)+"%"+"\n\n\n\n(Do Not Close Browser)");
      bugout.log('percent is: '+Math.round(percent));
       waitFrame();
             }



}, 1000);
}
function updateCategories(){
    bugout.log('updating catName is: '+catName);
return $.ajax({
                 type: "POST",
                   //	timeout: 40000,
                 url: "<?php echo base_url() ?>website/update_products_stats",
		   dataType: "text",
		   data:{ added : postsAdded,
            cat : catName,
            domain: domain },
             });
}
function moveOn(data){
    bugout.log('percent data is: '+data);
                percent = parseInt(data);
                bugout.log('percent is: '+percent);
               // bugout.log('products added moving on: '+data);
                catNum++;
                catID++;
       timer = 0;
       waitInterval = 3;
       waitDelay();

          addProducts();
}
function waitDelay(){
   setTimeout(function(){
     if(timer == waitInterval)
  {
  }else{
      timer++;
     // bugout.log('waiting: '+timer);
     waitDelay();
  }
}, 1000);
}
}else{
         bugout.log('domain is missing!');
            var entireLog = bugout.getLog();
               $.ajax({
                 type: "POST",
                   //	timeout: 40000,
                 url: "<?php echo base_url() ?>website/save_log",
		   dataType: "text",
		   data:{ entireLog : entireLog},
             });
         $.LoadingOverlay("hide");
         //window.location.href = "<?php echo base_url() ?>builds";
     }
}

	  });
               }else{
                   $.LoadingOverlay("hide");
                // window.location.href = "<?php echo base_url() ?>credential";
               }
       }

      });

                                    }
                                },
                                'cancel': function () {

                                }

    }
});
      } else {
        alert("Fill in all details to continue");
    }




	});

});

       //clear selections

    function clearSelect(){

     $("#selbrands").val([]);

      $("#selcategories").val([]);

       $("#selsellers").val([]);
       $("#categories").val('');
    }

     //select box select/deselect

    $(function(){

        $("#selbrands option").prop("selected", false);

        $("#selbrands option").prop("selected", true);

        $("#selcategories option").prop("selected", false);

        $("#selcategories option").prop("selected", true);

        $("#selsellers option").prop("selected", false);

        $("#selsellers option").prop("selected", true);



    });


    </script>



    <script>



            $(document).on('change','#sel_domain',function(){



                    sel_val	=	$(this).val() ;

                    var domain = $("#sel_domain option:selected").html();



                        $('#mydomain').html(domain) ;





                        // $.ajax(	{

                                // url: 'Website/update_domain_status',

                                // data: {

                                        // 'domain': sel_val

                                        // },

                                // type: "post",

                                // success: function(data){



                                        // $('#sel_domain').html(data) ;

                                // }

                              // });





            })

        </script>
<script>
 function buildTour(){

   var buildTour = {
            id: "build-tour",
            steps: [
                 {
                    title: "Build Credits",
                    content: "These are your build credits. They let you know how many websites you can build each month. Every build requires 1 build credit and credits replenish on each new billing cycle.",
                    target: "helptour-0",
                    placement: "left",
                },
                 {
                    title: "Domain Options",
                    <?php if($this->session->userdata('account_status') != "Demo"){

                   echo 'content: "Choose the type of domain you want to use to build your website. <br><br>You can provide your own or Phase Builder can assign you one from our hand picked, high quality, aged domains inventory (perfect for an SEO boost right out of the gate).",';
                   }else{
                    echo 'content: "Choose the type of domain you want to use to build your website. <br><br>You can provide your own or Phase Builder can assign you one from our hand picked, high quality, aged domains inventory (perfect for an SEO boost right out of the gate).<br><br><font color=\"red\">*You are currently in Demo mode so you will not be able to use those options yet.</font>",';
                   }  ?>
                    target: "helptour-1",
                    placement: "left",
                },
                 {
                    title: "3rd Party Ads",
                    content: "If you want to display 3rd party advertisements on your website choose the option that suites your needs. <br><br>*Note: You must add your 3rd party ads information in the 'Credentials' tab first.",
                    target: "helptour-2",
                    placement: "left",
                },
                 {
                    title: "Theme Color",
                    content: "Choose a theme color for you new website or check the 'Random' box and be surprised!",
                    target: "helptour-3",
                    placement: "left",
                },
                 {
                    title: "Website Title",
                    content: "The title of your website that visitors will see. It's a good idea to use your niche in the title!",
                    target: "helptour-4",
                    placement: "left",
                },
                 {
                    title: "Amazon Search Keyword",
                    content: "In the 'Amazon Search Keyword' field enter the keyword or phrase you would use to find products for your niche on Amazon.",
                    target: "helptour-5",
                    placement: "left",
                },
                 {
                    title: "Site Category",
                    content: "These are the categories on Amazon. Choose a category that best fits your niche.",
                    target: "helptour-6",
                    placement: "left",
                },
                 {
                    title: "Research",
                    content: "When ready, click 'Research Categories' and Phase Builder will bring back all the categories for that topic so you can choose the best ones for your website.",
                    target: "helptour-7",
                    placement: "left",
                    showNextButton: false
                },
                {
                    title: "Categories",
                    content: "These are a list of categories, sellers, and brands related to your keyword phrase on Amazon. <br><br>It is a good idea to stick wtih the ''Amazon Categories' group first, then if you still need more ideas choose from the brands and sellers sections. <br><br><font color='red'>*Hold CTRL when clicking on items to select more than one!</font>",
                    target: "helptour-8",
                    placement: "left",

                },
                {
                    title: "Add Categories",
                    content: "When ready, click the 'Use Selected Categories' button and your selections will be inserted into the 'Selected Categories' box.<br><br>You can select up to 10 categories. Each one you choose will become a category on your website so choose wisely!",
                    target: "helptour-9",
                    placement: "left",

                },
                {
                    title: "Clear Categories",
                    content: "If you want to start over just click the 'Clear Categories' button.",
                    target: "helptour-10",
                    placement: "left",

                },
                {
                    title: "Edit Chosen Categories",
                    content: "From here you can remove any strange character you may see, make any changes to the names you wish, delete categories you decide you don't like, and even type in categories if you have some ideas of your own! ",
                    target: "helptour-11",
                    placement: "left",

                },
                 {
                    title: "Build Your Website",
                    content: "Once you are satisfied with your websites category selection, click the 'Build Website' button and sit back and relax as Phase Builder does all the heavy lifting and hands you a complete website ready to start getting traffic and sales!",
                    target: "helptour-12",
                    placement: "left",
                    showNextButton: false

                }
            ]
        };
         hopscotch.startTour(buildTour);
    /*
        var intro = introJs();
          intro.setOptions({
            steps: [
               {

                    intro: "These are your build credits. They let you know how many websites you can build each month. Every build requires 1 build credit and credits replenish on each new billing cycle.",
                    element: "#helptour-0",

                },
                 {

                    intro: "Choose the type of domain you want to use to build your website. <br><br>You can provide your own or Phase Builder can assign you one from our hand picked, high quality, aged domains inventory (perfect for an SEO boost right out of the gate).",
                    element: "#helptour-1",

                },
                 {

                    intro: "If you want to display 3rd party advertisements on your website choose the option that suites your needs. <br><br>*Note: You must add your 3rd party ads information in the 'Credentials' tab first.",
                    element: "#helptour-2",

                },

              {
                element: '#helptour-3',
                intro: 'Choose a theme color for you new website or check the "Random" box and be surprised!',
                //position: 'left'
              },
              {
                element: '#helptour-4',
                intro: "The title of your website that visitors will see. It's a good idea to use your niche in the title!",
                //position: 'bottom'
              },
              {
                element: '#helptour-5',
                intro: 'In the "Amazon Search Keyword" field enter the keyword or phrase you would use to find products for your niche on Amazon.'
              },
               {
                element: '#helptour-6',
                intro: 'Choose a category that best describes your niche.'
              },
               {
                element: '#helptour-7',
                intro: 'When ready, click "Research Categories" and Phase Builder will bring back all the categories for that topic so you can choose the best ones for your website.'
              },

            ]
          });

          intro.start(); */

      }
    function buildTour2(){

      /*
        var intro2 = introJs();
          intro2.setOptions({
            steps: [
              {
                element: '#helptour-8',
                intro: "These are a list of categories, sellers, and brands related to your keyword phrase on Amazon. <br><br>It is a good idea to stick wtih the categories 1st, then if you still need more ideas choose from the brands and sellers sections. <br><br>*Hold CTRL when clicking on items to select more than one!"
              },
              {
                element: '#helptour-9',
                intro: "When ready, click the 'Use Selected Categories' button and your selections will be inserted into the 'Selected Categories' box.",
                //position: 'right'
              },
              {
                element: '#helptour-11',
                intro: "From here you can remove any strange character you may see, make any changes to the names, and even delete categories you decide you don't like.",
                position: 'bottom'
              },
              {
                element: '#helptour-10',
                intro: "If you want to start over just click the 'Clear Categories' button.",
                //position: 'right'
              },
              {
                element: '#helptour-12',
                intro: "Once you are satisfied with your websites categories selection, click the 'Build Website' button then sit back and relax as Phase Builder does all the heavy lifting and hands you a complete website ready to start getting traffic and sales!",
                //position: 'left'
              }
              ]
          });

          intro2.start(); */
      }
      window.onload = function () {
   if(hopscotch.getState() == "welcome-tour2:6") {
            var tour3 = {
            id: "welcome-tour3",
            steps: [
                 {
                    title: "New Build",
                    content: "Great job saving your credentials! Now we are at the 'New Build' page. This is where you will create your money making affiliate sites.",
                    target: "welcome_tour_build",
                    placement: "right",
                    //showNextButton: false
                   // yOffset: '10px',
                    xOffset: '20px'
                },
                 {
                    title: "Create Your First Website",
                    content: "Anytime you need help with the build process you can click on 'Show Me What To Do'. Go ahead and do that now and let's build your first site!",
                    target: "welcome_tour_show_me",
                    placement: "left",
                    //showNextButton: false
                    //yOffset: '6px',
                   // xOffset: '6px'
                },
            ],
             onEnd: function() {
        $.ajax({
          url: "<?php echo base_url() ?>website/finished_tour"
        });
      }
        };

         hopscotch.startTour(tour3);
        }
        }
        function mytest(){

            $.LoadingOverlay("show", {

          image : 'http://phasebuilder.com/membershipkc/main/images/Gears-3s-200px.gif',
          imageAnimation: "",
          backgroundClass : "custom_background",
          direction       : "row",
          textClass   : "custom_class_overlay",
          text: "Generating Categories...\n\n\n (Please Do Not Close Browser)",


    });
  /*  var count     = 0;
var interval  = setInterval(function(){
    if (count >= 100) {
        clearInterval(interval);
        $.LoadingOverlay("hide");
        return;
    }
    count += 10;
}, 300);  */
        }
    </script>
