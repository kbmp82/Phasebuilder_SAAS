<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");
//var_dump($review_article);
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
<script type="text/javascript">
   function postOption(mySelection) {
       if(mySelection.value == "publish"){
             document.getElementById("date_time_div").style.display = "none";
             $("#post_article").attr("disabled", false);
       }else if(mySelection.value == "future"){
           document.getElementById("date_time_div").style.display = "block";
           $("#post_article").attr("disabled", false);
       }

}
 $("document").ready(function(){
    var form = document.getElementById("post_article_form");
document.getElementById("post_article").addEventListener("click", function () {
  var article_body = $('#summernote').summernote('code');
  document.getElementById('article_body').value = article_body;

  form.submit();
});


});
</script>

<!DOCTYPE html>
   <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles" style="margin:0px !important">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Review Articles</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>articles/view_articles">View Articles</a></li>
                        <li class="breadcrumb-item active">Review Article</li>
                    </ol>
                </div>
            </div>

            <h2 style="-webkit-box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1);box-shadow: 1px 0 5px rgba(0, 0, 0, 0.1); padding: 10px 14px; margin-top:0px; text-align:center">Your Article Details</h2>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
              <div class="row">
                  <div class="col-md-1"></div>
                <div class="col-md-10" style="margin: 0 auto;">
                    <div class="card panel <?php if(isset($panel_class)) echo $panel_class; ?>">
                        <div class="panel-body">

                				<div class="col-md-12" style="float: left">
                				    <h3>Reviewing Article For: <?php echo strtoupper($cur_domain[0]['domain']); ?></h3>
                                    <p>Review your article and make any changes necessary. Once satisfied choose a publish date and click 'Post Article'. Your article will be posted to the 'Product Reviews' category on your website.</p>
                                         <form accept-charset="utf-8" enctype="multipart/form-data" class="login100-form validate-form register-form" id="post_article_form"  action="<?php echo site_url('articles/post_article');?>" method="post" style="padding-top:40px !important;padding-bottom:42px !important;">

                                   <input type="hidden" name="a_id" value="<?php echo $review_article[0]['id']; ?>" id="a_id">
                                       <input type="hidden" name="asin" value="<?php echo $review_article[0]['asin']; ?>" id="asin">
                                        <textarea style="display:none" rows="5" id="article_body" class="input100" name="article_body" ></textarea>
                                  
                                 <div class="form-group rs1-wrap-input100 validate-input m-b-20" id="title" style="width:100%;">
                         <label><h4><strong>Article Title</strong></h4></label>
                            <input value="<?php echo $review_article[0]['article_title']; ?>" id="article_title" class="input100 form-control"  type="text" name="article_title">

                        </div>
                        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" id="article_body_div" style="width:100%;">
                     <label><h4><strong>Article Body</strong></h4></label>
                     <div id="summernote"><?php foreach($review_article[0]['article_body'] as $section){echo "<p>".str_ireplace($review_article[0]['keyword'],"<b>".$review_article[0]['keyword']."</b>",$section)."</p>";}   ?></div>
    <script>
      $('#summernote').summernote({
        tabsize: 2,
        height: 800,

      });
    </script>

                        </div>
                        <div class="form-group wrap-input100 rs1-wrap-input100 m-b-20" style="width:100%">
                         <label><h4><strong>Post Options</strong></h4></label>
                            <fieldset id="post_radios" style="border: none">
        <label class="radio-inline" style="padding-right: 50px" >
      <input type="radio" style="transform: scale(1.4);" id="post_type" name="post_type" value="publish" onclick="postOption(this);">&nbsp;&nbsp;Post immediately
    </label>
    <label class="radio-inline" style="padding-right: 50px">
      <input type="radio" style="transform: scale(1.4);" id="post_type" name="post_type" value="future" onclick="postOption(this);">&nbsp;&nbsp;Schedule a time and date
    </label>
    </fieldset>
      </div>
      <div class="form-group rs1-wrap-input100 validate-input m-b-20" id="date_time_div" style="display:none; width:50%">
                         <label><h4><strong>Post Date & Time</strong></h4></label><br/>
                         <div class="ui calendar" id="time">
    <div class="ui input left icon">
      <i class="calendar icon"></i>
      <input type="text" placeholder="Date/Time" id="chosen_time" name="chosen_time">
    </div>
  </div>
                        </div>

                        <div class="container-login100-form-btn" style="padding-bottom:40px;">
                            <button class="login100-form-btn" id="post_article">
                               Post Article
                            </button>
                        </div>
                				</form>
                                </div>
                        </div>
                    </div>
                </div>
                  <div class="col-md-1"></div>
        	</div>
        </div>
    </div>
</div>
</div>

    <?php  $this->load->view("common/footer.php"); ?>