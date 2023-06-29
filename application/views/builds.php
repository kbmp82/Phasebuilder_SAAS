<?php
$this->load->view("common/header.php");
$this->load->view("common/sidebar.php");

$ci =&get_instance();
$ci->load->model('user/LoginModel');
$userdata = $ci->LoginModel->check_mysubscription($this->session->userdata['ID']);
$countdata = count($userdata);

?>
<style>
.card {
    margin: 15px 44px;
}
</style>
   <!-- Page wrapper  -->
        <div class="page-wrapper">


<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Current Builds</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Current builds</li>
                    </ol>
                </div>
            </div>

<div class="row">
	                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>You have <b><? echo count($builds); ?></b> active builds</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="subscription">
                                        <thead>
                                            <tr>

                                                <th>Domain</th>
                                                <th style="width:20%">Site Title</th>
                                                <th style="width:40%">Categories</th>
                                                 <th>Build Date</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
    if($builds){foreach($builds as $b_val){
?>
                                            <tr>

                                                <td><?php  echo $b_val['domain'] ; ?> </td>
                                                <td><?php echo $b_val['site_title'] ; ?></td>
                                                <td><?php echo str_replace(",",", ",$b_val['categories']) ; ?></td>
                                                <td><?php echo date('m-d-Y',$b_val['creation_date']); ?></td>
                                                <td><span><a href="builds/view_builds/?action=view&d_id=<?php echo $b_val['id'] ;  ?>">view</a></span>
                                           <?php echo (strpos($b_val['domain'], 'demo-') !== false) ? '': '<span>  / <a id="delete" onclick="return confirm(\'Are you sure you want to delete this domain? The domain will be erased but you will still have it in your inventory so you can rebuild it.\');" href="builds/view_builds/?action=delete&d_id='.$b_val["id"].'">delete</a></span>'; ?>
										</td>


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

<?php
	$this->load->view("common/footer.php");
?>
<script>
$("document").ready(function(){
   if(hopscotch.getState() == "build-tour:12") {


      $.confirm({
      smoothContent: true,
    columnClass: 'col-md-8',
    title: 'Conrgratulations, You\'ve Built Your First Website!',
    content: '<center><img src="<?php echo $this->config->base_url(); ?>images/worker-hello-done.png"></center>'+'<p>That\'s It! Easy wasn\'t it? </p><p style="text-align: justify;">You can view your new website information and log in details by <strong>clicking on the \'View\' link on the right hand side of the website list</strong>. <br><br>The next step will be to order some 100% unique articles for you new site to give it great content for the search engines and your new visitors (articles are not available in Demo mode).<br><br>That\'s all there is to it. Upgrade to a subscription package and start building your money making affiliate site empire today!<br><br></p>',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
    buttons: {
       'confirm': {
                                    text: 'Okay',
                                    btnClass: 'btn-blue',
                                    action: function () {

                                         hopscotch.endTour(true);
                                    }
                                }

    }
});
}else{
//    alert(hopscotch.getState());
}
 });
</script>