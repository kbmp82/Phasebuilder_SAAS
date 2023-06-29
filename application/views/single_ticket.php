<?php

defined('BASEPATH') OR exit('No direct script access allowed');



$this->load->view("common/header.php");

$this->load->view("common/sidebar.php");



$CI =& get_instance() ;

$CI->load->model('user/LoginModel')  ;



?>



<style>

.row.space.admin {

    background: lightyellow;

    }

.row.space {

    margin-bottom: 30px;

    width: 100%;

    height: 100px;

}

small.time {

    margin-left: 20px;

}

.col-sm-10.admin {

    top: 20%;

}

.col-sm-2.text-center.admin {

    position: relative;

    top: 20%;

   

}



	.t_detail {

		float: left;

	}



	div#Aticketstatus {

	float: right;

	}

			

	.sppace {

		padding-top: 2%;

	}



</style>



<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/colorSelect.css">
  

  <!-- Page wrapper  -->

        <div class="page-wrapper">

            <!-- Bread crumb -->

            <div class="row page-titles" style="margin:0px !important">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-primary">Ticket</h3> </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>

                        <li class="breadcrumb-item active">Ticket</li>

                    </ol>

                </div>

            </div>

<?php





$published_date    =   $ticket->ticket_date ;

$username    =   $ticket->username ;

$detail    =   $ticket->detail ;

$newDate = date("d M-Y", strtotime($published_date));

$current_user  = $this->session->userdata('ID') ;

   

       

$currentDate_time =     date("Y-m-d H:i:s", NOW() );



	$status   = $ticket->status ;

?>					

			

<div class="container">

    <div class="row clearfix">

        <div class="col-md-12 column">

			  <div class="row">

				  <div class="col-md-1"></div>

				  

                <div class="col-md-10" style="margin: 0 auto;">

				

                    <div class="panel card <?php if(isset($panel_class)) echo $panel_class; ?>">

					 <div class="panel-body">

				<div id="Aticketstatus"> 

							<span  id="d_status" class="label label-<?php echo  ($status == 'open') ? 'success' : 'danger' ;    ?>"><?php echo  $status ;   ?></span>

		

		</div> 		 

					 		<div class="error_reported">

						<?php 

							if($this->session->flashdata('credential_success')){

								echo $this->session->flashdata('credential_success');

								?>

									<script>

									setTimeout(function()

									{

										jQuery(".error_reported").html("");

										jQuery(".error_reported").hide("slow");

									},3000);

									</script>

						<?php

							}

						?>

					</div>

			    

					

	<div class="ticket">				

	

	<h4><small>RECENT TICKET</small></h4>

      <hr>

      <h2><?php  echo $ticket->subject ;   ?></h2>

      <h5><span class="glyphicon glyphicon-time"></span> Post by  : <?php echo  $username.' , '.$newDate ;  ?> .</h5>

      <h5><span class="label label-success"><?php echo $username ;   ?></span></h5><br>

      <p><?php echo $detail ;  ?></p>

      <hr>

	

	</div>





<?php   if($status == 'open'){ ?>		

      <h4>Leave a Comment:</h4>

 <form method="post" action="<?php echo $this->config->base_url(); ?>Support/add_ticket_reply/?id=<?php echo $_GET['id'] ;  ?>">

 <div class="form-group">
				<!-- <input type="hidden" name="t_id" value="<?php echo $_GET['id'] ;   ?>"> -->
				     <input type="hidden" name="p_id" value="<?php echo $_GET['id'] ;   ?>">

						<input type="hidden" name="u_id" value="<?php echo $this->session->userdata('ID') ;   ?>">
						     <input type="hidden" value="reply" name="t_type">
						  <input type="hidden" name="to_id" value="0"> 
							   <!--	<input type="hidden" name="datetime" value="<?php  echo $currentDate_time ; ?>">  -->
					  <textarea style="height: 200px;border-width: px;border: 1px solid;border-color: lightgrey;"class="form-control" rows="10" name="detail" required></textarea>
					</div>
			 <button type="submit" class="btn btn-success">Submit</button>

			</form>



<?php   } ?>

      <br><br>

      

	<p><span class="badge"><?php  echo count($replies) ; ?></span> Comments:</p><br>





<!--  row starts -->      

    <?php    

            

    if($replies):

            foreach($replies as $r_val) :

                

                

    ?>

     <div  id="ntfy" class="row space <?php echo  ($r_val['u_id'] == $current_user)? 'admin' : '' ;?>">

          

			<div class="col-sm-2 text-center <?php echo  ($r_val['u_id'] != $current_user)? 'admin' : '' ;?>">
                            <?php echo  ($r_val['u_id'] != $current_user)? '<img src="http://phasebuilder.com/membershipkc/images/worker.png" class="img-circle" height="65" width="65" alt="Avatar">' : '' ;?>
							</div>

		<?php

		$user = $CI->LoginModel->get_user($r_val['u_id']) ;

	

		?>

			<div class="col-sm-10 <?php echo  ($r_val['u_id'] == $current_user)? 'admin' : '' ;?>">

				<h4><?php echo $user->username ;  ?><small class="time"> <?php echo   $r_val['ticket_date']; ?></small></h4>

					<p><?php echo $r_val['detail']  ;  ?></p>

						<br>

			</div>

			

	 </div>

	



	

	<?php

	    endforeach ;

	endif ; ?> 

<!--- row ends --->       



	   </div>

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



<div id="bottom"></div>



<script src="<?php echo $this->config->base_url(); ?>signin/vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="<?php echo $this->config->base_url(); ?>signin/js/main.js"></script>
<script>

			$(document).ready(function(){


                 	var 	   ticketId = "<?php  print $_GET['id'] ;  ?>" ;



				$.ajax({
						url: '<?php echo $this->config->base_url();  ?>admin/SupportTickets/mark_tickets',
						data: {
							'ticket_id' : ticketId
							}, // change this to send js object
						type: "post",
						success: function(data){

						}
				});


			})
</script>
<?php  $this->load->view("common/footer.php"); ?>