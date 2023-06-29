    <?php

    //$this->load->view('functions.php');



    $month_ago = strtotime('-30 days');

    $current_date = strtotime('now');

    defined('BASEPATH') OR exit('No direct script access allowed');



    $this->load->view("common/header.php");

    $this->load->view("common/sidebar.php");

    ?>

    <html>

        <!--script src="http://code.jquery.com/jquery-1.9.1.js"></script-->

         <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.0/dist/loadingoverlay.min.js"></script>

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
 var iframeValue = 0;
 function iframeLoaded(){
        //  document.getElementById('asg_frame').setAttribute('data-isloaded','yes');
        //  iframeValue = 1;
   }
    $("document").ready(function(){

    window.addEventListener("message", receiveMessage, false);
function receiveMessage(event)
{
        var myMsg = event.data;
        if(myMsg == 'yes'){
            iframeValue = 1;
            console.log('message received and data is: '+myMsg);
           // document.getElementById('asg_frame').setAttribute('data-isloaded','yes');
            }
}
        $('#theme_color').colorSelect();
     //global ajax timeout
     $.ajaxSetup({timeout:60000}); //in milliseconds
     $('#loading').show();

      $(".js-ajax-php-json").submit(function(){
       var site_mode = '<?php echo $site_mode ; ?>';
       if(site_mode != "test"){
        var data = {

          "action": "test"

        };

        keyword = document.getElementById("site_kwd");
      browsenode = document.getElementById("node");
       if(keyword.value != '' & browsenode.value != 0){
          	data = $(this).serialize() + "&" + $.param(data);

        $.ajax({

          type: "POST",

          dataType: "json",

         // timeout: 400000,

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
          text        : "  Generating Categories...",
          textColor               : "#fff",

    });

       // $("#loader").show();

       },

          success: function(data) {

          //console.log(data);

              var brand_options = '';

               var seller_options = '';

                var category_options = '';

          for (var i = 0; i < data.length; i++) {

              if(data[i].brand){

                  if(data[i].bsearch){

               brand_options += '<option value="' + data[i].brand + '">' + data[i].brand + '	(' + data[i].bsearch + ')</option>';

               }

               else{

                 brand_options += '<option value="' + data[i].brand + '">' + data[i].brand + '</option>';

                 }





              }

             if(data[i].seller){

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

          //console.log(brand_options);

          $("select#selbrands").html(brand_options);

          //console.log(brand_options);

          $("select#selsellers").html(seller_options);

          //console.log(brand_options);

          $("select#selcategories").html(category_options);

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
        $("#reserach_cats").hide();
       $.LoadingOverlay("hide");

       }

        });
       }else{
         alert("Fill in all fields to proceed");

       }

        return false;
       }else{
        $(".multi_categories").slideDown(1000);
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
              // console.log(data);
               $.LoadingOverlay("hide");
             window.location.href = "<?php echo base_url() ?>website";

           },

           error: function(xhr, ajaxOptions, thrownError){

              //what to do in error

               console.log('error');

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

               console.log('error');

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
              var domain = "demo";
              var domain_id = 0;
          }else{
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

		  var categories = document.getElementById('categories').value;
          var categoriesArray = categories.split(",");

	 // e.preventDefault();

 if(categories != ''){
        $.ajax({

		   url: "<?php echo base_url() ?>website/new_user",

		   type: "POST",//type of posting the data

		   dataType: "text",

			timeout: 200000,

		   data:{

				site_name : site_name,

				domain : domain,

				site_kwd : site_kwd,

				node : node,

				categories : categories,

			  	domain_id :  domain_id,
                theme_color : theme_color,
                theme_color_random : theme_color_random,
                ads_option: ads_option

				},

					  beforeSend: function(){

		// Show image container

	  $.LoadingOverlay("show", {

          image : 'http://phasebuilder.com/membershipkc/main/images/Gears-3s-200px.gif',
          imageAnimation: "",
          backgroundClass : "custom_background",
          direction       : "row",
          text        : "  Building Website...",
          textColor               : "#fff",

    });

	   // $("#loader").show();

	   },

		   success: function (data) {
		       console.log(data);
                            if(data.indexOf(".com") > -1){
                                console.log('.com found setting domain');
                                 successDomain = data;
     // window.location.href = "<?php echo base_url() ?>builds";
}else{
    successDomain = "bad";
    // window.location.href = "<?php echo base_url() ?>website";
}

				//console.log(data);

			//$(".the-return").html(data);



		   },

		   error: function(data){

			  //what to do in error

   // console.log(data);

		   },

			complete:function(data){
			    //console.log(data);
			     var catNum = 1;
              addProducts();

       function addProducts(){
            console.log('adding products '+catNum);
           //main function that starts the process and waits for a TRUE response...if false it calls itself again to repeat
     if(catNum <= categoriesArray.length){
      iframeValue = 0;
     //check if current cateogry array # is less than total elemens in array..if it is, then ++ catNum and execute the iframe to load the forcurl page.
     //$.LoadingOverlay("text", "Adding Products For Category "+catNum);
			$("#asg_frame").attr("src", "http://"+successDomain+"/forcurl"+catNum);
            console.log('http://'+successDomain+'/forcurl'+catNum);
          // call the wait function to check every 5 seconds of the iframe has returned a value of 1. 1 = finished
          $.LoadingOverlay("hide");
          waitFrame();

     }else{
         $.LoadingOverlay("hide");
     }
 }

function waitFrame(){

   setTimeout(function(){
       $.post('checkdone.php', { url: 'http://'+successDomain+'/asgdone.txt' }, function(data) {
    if(data == "done"){
      console.log('products added moving on');
       catNum++;
       timer = 0;
      // waitDelay(10);
          addProducts();
    }else{
      console.log('waiting...');
     waitFrame();
  }
});
   /*  if(iframeValue  === 1)
  {
      console.log('products added moving on');
       catNum++;
       timer = 0;
      // waitDelay(10);
          addProducts();
  }else{
      console.log('waiting..iframeValue = '+iframeValue);
     waitFrame();
  }  */
}, 32000);
}
function waitDelay(waitInterval){

   setTimeout(function(){
     if(timer  === waitInterval)
  {
     console.log('time met timer = '+timer+' waitInterval= '+waitInterval);
  }else{
      timer++;
      console.log('waiting..timer = '+timer);
     waitDelay();
  }
}, 1000);
}
	   }

	  });
      } else {
        alert("Fill in categories to continue");
    }




	});

});

/*
function beginTour(){
    $(".multi_categories").slideDown(1000);
//var myintro = ;
    introJs().onexit(function() {
        $(".multi_categories").slideUp(1000);

    });
    introJs().setOption("overlayOpacity", 0.5);

    introJs().start();
}  */
       //clear selections

    function clearSelect(){

     $("#selbrands").val([]);

      $("#selcategories").val([]);

       $("#selsellers").val([]);

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



    $userdata = $ci->LoginModel->get_user($user_id);

    $allowed_domains  =  $userdata->allowed_domains ;
    $domain_credits =   $userdata->domain_credits;
    $used_domains = $ci->WebsiteModel->count_user_domain($user_id);

    //$left_domain =  $allowed_domains - $used_domains ;
    $chosen_domain = $ci->WebsiteModel->grab_domain($allowed_domains);
    $time_left = $ci->WebsiteModel->get_time_remaining($chosen_domain);



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

                if($allowed_domains === 0 ){

                ?>

    <div class="subscription_ovr alert alert-warning" style="text-align:center">

      <strong>Warning!</strong>

        <p style="text-align:center;margin-bottom: 26px;">

    You have reached the maximum allowed builds for the current billing period. You may upgrade your subscription to build more or wait until the next billing period.

        <a href="http://phasebuilder.com/membershipkc/subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;">Upgrade</a></p>

        </div>

    <?php 			}

            else	{

    ?>

        <div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">





                                        <div class="panel-body">
                                             <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%;" id="domain_reset">
                                         <form enctype="multipart/form-data" class="login100-form validate-form register-form" id="reset_domain_form"  action="" method="" style="padding-top:40px !important;padding-bottom:42px !important;">

                                                 <label><h4><strong> Reset Domain (test mode):</strong> </h4></label>
                                                 <?php
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
                                </option>'.$domains_select.'</select></div> ';

                                ?>


                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 resetdomain" style="width:100%;" style="text-align: center;" >

                                                 <button type="submit" class="login100-form-btn helptour"  id="reset_domain_button">Reset Domain</button>
                                            </div>
                                         </form>
                                </div>

                                                 <a href="javascript:void(0);" style="float:right" onclick=""><font color="blue">Show me what to do</font></a>
                                                <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">

                                                    <label><h4><strong> Builds Remaining:</strong> <?php echo $allowed_domains;	  ?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-question-circle-o fa-1" data-toggle="tooltip" title="The number of websites you are allowed to build on the Phase Builder platform. Builds reset each new billing period and unused builds rollover."></i></h4></label>
                                                    <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" id="helptour" data-step="1" data-intro="Choose the type of domain you want to use to build your website." style="width:100%">
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
                                                    <br /><br /><label><h4><strong>Domain:</strong>	<?php echo $chosen_domain;	  ?></h4></label>

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
                                   echo '<div class="form-group wrap-input100 m-b-20" style="width:97%"><h5>Need domain credits? Head over to the <strong><a href="<?php echo $this->config->base_url(); ?>Subscription/add_addOns"><font color="blue"><u>Addons</u></font></a></strong> section.</h5></div>';
                                }
                                ?>



                                </div>


                                            <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="2" data-intro="Decide if you want to display 3rd party advertisements on your website. *Note: You must add your information in the 'Credentials' tab first." style="width:100%">
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
                        <div style="width: 97%; border: none" class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="3" data-intro="Choose a theme color for you new website or check the 'Random' box and be surprised!" data-validate="Enter Amazon API Key">

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
                                            <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="4" data-intro="The title of your website that visitors will see. It's a good idea to use your niche in the title!" style="width:97%;" data-validate="Enter Amazon API Key">

                                                        <label><h4><strong>Site Name</strong></h4></label><input value="" id="site_name" class="input100 form-control mediumbox" type="text" name="site_name" placeholder=""><span class="focus-input100"></span>

                                                    </div>

                                                    <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="5" data-intro="In the 'Site Topic' field enter the keyword or phrase you would use to find products for your niche on Amazon." style="width:97%;" data-validate="Enter Amazon API Key">

                                                        <label><h4><strong>Site Topic</strong></h4><p>The keyword or phrase used to describe your website topic. Ex: A site selling dog toys, the Niche Keyword would be 'dog toys'.</p></label><input value="" id="site_kwd" class="input100 form-control mediumbox" type="text" name="site_kwd" placeholder=""><span class="focus-input100"></span>

                                                    </div>

                                                    <div style="width: 97%; border: none" class="form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="6" data-intro="Choose a category that best describes yoru niche" data-validate="Enter Amazon API Key">

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
                                                 <button type="submit" class="login100-form-btn helptour" data-step="7" data-intro="When ready, click 'Research Categories' and Phase Builder will bring back all the categories for that topic so you can choose the best ones for your website." id="reserach_cats">Research Categories</button>
                                            </div>
                                            </form>
    												</div>


                                            <br />
                                            <div class="multi_categories form-group wrap-input100 rs1-wrap-input100 m-b-20form-group wrap-input100 rs1-wrap-input100 m-b-20 helptour" data-step="8" data-intro="The categories will be shown filtered into groups in these boxes. Each category you select will become a category on your website populated with products from Amazon. Choose wisely!" style="display: none; width:100%;">

                                                <div class="col-md-12">

                                                   <label><h4><strong>Select Categories</strong></h4><p>Select the categories you want (ctrl-click to select multiple lines)</p></label>

                                                </div>

                                               <div id="container" class="red">

                                                  <div class="blue">

                                                  </div>

                                                  <div class="blue">

                                                     <form id="build_site_form" action = "">

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


                                                      <br />
                                                     <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width: 97.5%;">

                                                        <button class="login100-form-btn" style="width:100%" type = "button" onclick = "showChoices()">Add Categories</button>
                                                        </div>
                                                        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width: 97.5%;">
                                                        <button class="login100-form-btn-danger" style="width:100%" type = "button" onclick = "clearSelect()">Clear Selections</button>
                                                     </div><div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 selected_cats" style="width: 97.5%;">

                                                        <label><h4><strong>Selected Categories</strong></h4></label>

                                                        <div class="top-right">

                                                            <input type="text" class="longbox" id="categories" style="width: 97.5%;"/>

                                                         </div>

                                                     </div><br /><br />

                                                      <div class="col-md-12 all_btns blue" style="text-align: center;">
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
               <iframe data-isloaded="" id="asg_frame" src="" style="width: 800px;height:500px;"></iframe>

                </div>





    <?php  $this->load->view("common/footer.php"); ?>



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
  /*    localStorage.clear();
      var enjoyhint_script_data = [
        {
          onBeforeStart: function(){
            $('#new-todo').keydown(function(e){
              if(e.keyCode == 13 && $(this).val() !== ''){
                enjoyhint_instance.trigger('new_todo');
              }
            });
          },
          selector:'#new-todo',
          event:'new_todo',
          event_type:'custom',
          description:'Enter task description and press Enter.',
        },
        {
          onBeforeStart: function(){
            $('#new-todo').keydown(function(e){
              if(e.keyCode == 13 && $(this).val() !== ''){
                enjoyhint_instance.trigger('new_todo');
              }
            });
          },
          selector:'#new-todo',
          event:'new_todo',
          event_type:'custom',
          description:'Enter the second task description and press Enter.',
        },
        {
          selector:'#todo-list .toggle:first',
          event:'click',
          description:'Set first task as completed',
          shape:'circle',
          timeout:100
        },
        {
          selector:'#filters li:nth-child(3) a',
          event:'click',
          description:'Select all completed tasks',
        },
        {
          selector:'#todo-list .view:first',
          event_selector:'#todo-list .destroy:first',
          event:'click',
          shape:'circle',
          description:'Remove this task',
          top:20,
          left:510,
          bottom:20,
          right:20
        },
        {
          selector:'#filters li:nth-child(1) a',
          event:'click',
          description:'Back to "All" tasks list',
        }
      ];
      var enjoyhint_instance = null;
      $(document).ready(function(){
        enjoyhint_instance = new EnjoyHint({});
        enjoyhint_instance.setScript(enjoyhint_script_data);
        enjoyhint_instance.runScript();
      });      */
    </script>
