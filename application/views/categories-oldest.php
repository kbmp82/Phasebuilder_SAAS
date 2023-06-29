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





	$("document").ready(function(){



	  $(".js-ajax-php-json").submit(function(){

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

		  timeout: 400000,

		  url: "<?php echo base_url() ?>website/cats",

		  data: data,



		  beforeSend: function(){
           var theButton = document.getElementById("reserach_cats");
          $("#reserach_cats").attr("disabled", true);
            $("#reserach_cats").css('background','#e7e7e7');

  theButton.innerHTML='<font color="black"><i class="fa fa-spinner fa-spin"></i>    Researching</font>';
          //$("#reserach_cats").prop('disabled', true);
          // $("#reserach_cats").val(<i class="fa fa-circle-o-notch fa-spin"></i> + 'Researching Categories');
		// Show image container
       /*
	  $.LoadingOverlay("show", {

		  fontawesome : "fa fa-spin",

		  size        : "20",

		  text        : "Generating Categories Please Wait..."

	});
     */
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
		      var theButton = document.getElementById("reserach_cats");
           $("#reserach_cats").attr("disabled", false);
          $("#reserach_cats").css('background','#0ca5da');
          $('#reserach_cats').hover(
    function(){
      var $this = $(this);
      $this.data('bgcolor', $this.css('background-color')).css('background-color', '#e7e7e7');
    },
    function(){
      var $this = $(this);
      $this.css('background-color', $this.data('bgcolor'));
    }
  );
  theButton.innerHTML='Research Categories';
         // $("#reserach_cats").prop('disabled', false);
          // $("#reserach_cats").val('Research Categories');
			 // console.log(data);

		// Hide image container

	   //$.LoadingOverlay("hide");

		//$("#loader").hide();

	   }

		});
       }else{
         alert("Fill in all fields to proceed");

       }
		return false;

	  });


		$('#createwebsite').click(function(){


	var selbrands = $("#selbrands").val();

	var selsellers = $("#selsellers").val();

	var selcategories = $("#selcategories").val();

			showChoices();

		   //var site = '';

		  var site_name = document.getElementById('site_name').value;

		 var domain = document.getElementById('domain_name').value;

		//  var domain = $("#sel_domain").val()	;

		  var site_kwd = document.getElementById('site_kwd').value;

		  var node = document.getElementById('node').value;

	//var start_pos = node.indexOf('(') + 1;

	//var end_pos = node.indexOf(')',start_pos);

	//var node = node.substring(start_pos,end_pos)

		  var categories = document.getElementById('categories').value;

	  //e.preventDefault();

   if(categories != ''){
        $.ajax({

		   url: "<?php echo base_url() ?>website/new_user",

		   type: "POST",//type of posting the data

		   dataType: "text",

			timeout: 400000,

		   data:{

				site_name : site_name,

				domain : domain,

				site_kwd : site_kwd,

				node : node,

				categories : categories,

				domain_id :  $("#sel_domain_id").val()

				},

					  beforeSend: function(){
                      var theButton = document.getElementById("createwebsite");
          $("#createwebsite").attr("disabled", true);
            $("#createwebsite").css('background','#e7e7e7');

  theButton.innerHTML='<font color="black"><i class="fa fa-spinner fa-spin"></i>    Building Website</font>';
		// Show image container
     /*
	  $.LoadingOverlay("show", {

		  fontawesome : "fa fa-spin",

		  size        : "20",

		  text        : "Building Website Please Wait. (do not close browser)"



	});
      */
	   // $("#loader").show();

	   },

		   success: function (data) {
                            if(data.indexOf("success") > -1){
      window.location.href = "<?php echo base_url() ?>builds";
}
 if(data.indexOf("timeout") > -1){
      window.location.href = "<?php echo base_url() ?>website";
}
				//console.log(data);

			//$(".the-return").html(data);



		   },

		   error: function(xhr, ajaxOptions, thrownError){

			  //what to do in error

			   console.log('error');

		   },

			complete:function(data){


				console.log(data);

		// Hide image container

	   //	$.LoadingOverlay("hide");

		//$("#loader").hide();

	   }

	  });
      } else {
        alert("Fill in categories to continue");
    }





	});

});

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
	</style>

	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

		<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">



	<?php

		$ci =&get_instance();

	$ci->load->model('user/LoginModel');

	$ci->load->model('user/WebsiteModel');

	$user_id =  $this->session->userdata['ID']  ;



	$userdata = $ci->LoginModel->get_user($user_id);

	$allowed_domains  =  $userdata->allowed_domains ;

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

			

		

				

				<div class="container">

					<div class="row clearfix">

						<div class="col-md-12 column">

							  <div class="row">

								  <div class="col-md-1"></div>

								  <div class="col-md-10" style="margin: 0 auto;">

	<?php

				if($chosen_domain === 0 ){

				?>

	<div class="subscription_ovr alert alert-warning" style="text-align:center">

	  <strong>Warning!</strong>

		<p style="text-align:center;margin-bottom: 26px;">

	You have reached the maximum allowed builds for the current billing period. You may upgrade your subscription to build more or wait until the next period.

		<a href="http://phasebuilder.com/membershipkc/subscription" class="btn btn-success" style="background-color: #1e7e34;border-color: #1c7430;">Upgrade</a></p>

		</div>

	<?php 			}

			else	{

	?>

		<div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">

									

						

										<div class="panel-body">

											<form id="cat_research" action="deploy-website.php" class="js-ajax-php-json" method="post" accept-charset="utf-8">

												<div class="col-md-12">

													<h4><strong>Enter Website Details</strong></h4>
                                                    <p class="pmargn"><font color="red">IMPORTANT:</font> You have <strong><?php echo $time_left; ?></strong> remaining to build your website on this domain and claim it otherwise it will be given to another user and you will be assigned a new one.</p><br /><h5>Rather cherry pick your own domain? Head over to the <strong><a href="<?php echo $this->config->base_url(); ?>Subscription/add_addOns"><font color="blue"><u>Addons</u></font></a></strong> page.</h5>
													<br><p><strong>Domain:	<?php echo $chosen_domain;	  ?></strong></p>

													 <input type="hidden" id="domain_name" value="<?php echo $chosen_domain;	  ?>">

												<div> Allowed Domains: <?php echo $allowed_domains;	  ?> </div>

												<div> Used  Domains : <?php echo $used_domains;	  ?> </div><br />

                                            <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">
                         <label><h4><strong>Display Third Party Ads On Website</strong></h4><p>Show Google Adsense or Amazon Ads on the website.</p></label>
                            <fieldset id="show_ads" style="border: none">
        <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" name="ads" value="no">&nbsp;&nbsp;None
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" name="ads" value="amazon">&nbsp;&nbsp;Amazon Product Ads
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" name="ads" value="google">&nbsp;&nbsp;Google Adsense Ads
    </label>
    </fieldset>

                        </div>
											<div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:97%;" data-validate="Enter Amazon API Key">

														<label><h4><strong>Site Name</strong></h4></label><input value="" id="site_name" class="input100 form-control mediumbox" type="text" name="site_name" placeholder=""><span class="focus-input100"></span>

													</div>

													<div class="form-group wrap-input100 rs1-wrap-input100  m-b-20" style="width:97%;" data-validate="Enter Amazon API Key">

														<label><h4><strong>Site Topic</strong></h4><p>The keyword or phrase used to describe your website topic. Ex: A site selling dog toys, the Niche Keyword would be 'dog toys'.</p></label><input value="" id="site_kwd" class="input100 form-control mediumbox" type="text" name="site_kwd" placeholder=""><span class="focus-input100"></span>

													</div>

													<div style="width: 97%; border: none" class="form-group wrap-input100 rs1-wrap-input100 m-b-20" data-validate="Enter Amazon API Key">

													  	<label><h4><strong>Amazon Category</strong></h4><p>The category on Amazon that best fits your websites topic.</p></label><select id="node" name="node">

															<option value="0">
                                    (select main Amazon category)
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
                                            <div class="catrsrch" style="text-align: center;">
												 <!-- <input class="login100-form-btn" id="reserach_cats" type="submit" name="reserach_cats" value="Research Categories"  /></button> -->
                                                 <button type="submit" class="login100-form-btn" id="reserach_cats">Research Categories</button>
                                            </div>
    												</div>

											</form>
                                            <br />
											<div class="multi_categories" style="display: none;">

												<div class="col-md-12">

												   <label><h4><strong>Select Categories</strong></h4><p>Select the categories you want (ctrl-click to select multiple lines)</p></label>

												</div>

											   <div id="container" class="red">

												  <div class="blue">

												  </div>

												  <div class="blue">

													 <form id=action = "">

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

													 <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20 selected_cats" style="width: 97.5%;">

														<label><h4><strong>Selected Categories</strong></h4></label>

														<div class="top-right">

															<input type="text" class="longbox" id="categories" style="width: 97.5%;"/>

														 </div>

													 </div>

													 <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20">

														<button class="login100-form-btn" style="width:100%" type = "button" onclick = "showChoices()">Add Categories</button>
                                                        </div>
                                                        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20">
														<button class="login100-form-btn-danger" style="width:100%" type = "button" onclick = "clearSelect()">Clear Selections</button>
													 </div><br /><br />

												      <div class="col-md-12 all_btns blue" style="text-align: center;">



			<button type="submit" class="login100-form-btn" id="createwebsite">Build Website</button>








													 </div>

												  </form>

												  </div>

												  <div class="the-return">

												  </div>

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