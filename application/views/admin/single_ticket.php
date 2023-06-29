	<?php
			defined('BASEPATH') OR exit('No direct script access allowed');

			 if($this->session->userdata('role') == 'admin'){
			$this->load->view("admin/common/header.php");
			$this->load->view("admin/common/sidebar.php");
				 }  else{
			$this->load->view("common/header.php");
			$this->load->view("common/sidebar.php");	     
					 
				 }


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

	h4.sppace.commentForm {
		margin-bottom: 3%;
	}
	</style>

			<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
				<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
			  
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


			$current_user  = $this->session->userdata('ID') ;
			$username    =   $ticket->username ;
			$detail    =   $ticket->detail ;

			$published_date    =   $ticket->ticket_date ;
			$newDate = date("d M-Y", strtotime($published_date));
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
							
			<li class="nav-item dropdown " >
									<a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bars" style="margin-right: 7px;"></i>Change Status</a>
									<div class="dropdown-menu animated zoomIn">
										<a class="dropdown-item selectstatus" data-value="closed" href="#"><i class="fa fa-close" style="font-size:16px;color:red"></i> Close </a>
										<a class="dropdown-item selectstatus" data-value="open" href="#"><i class="fa-folder-open"></i> Open </a>
									   
									</div>
			</li>
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
							
								
				<div class="ticket col-md-6 t_detail">				
					
							<h4 class="sppace"><small>RECENT TICKET</small></h4>
							  <hr>
							  <h2 class="sppace"><?php echo $ticket->subject ;   ?></h2>
							  <h5 class="sppace"><span class="glyphicon glyphicon-time"></span> Post by  : <?php echo  $username.' , '.$newDate ;  ?> .</h5>
							  <h5 class="sppace"><span class="label label-success"><?php echo $username ;   ?></span></h5><br>
							  <p class="sppace"><?php echo $detail ;  ?></p>
							  <hr>
					
					<h4 class="sppace commentForm">Leave a Comment:</h4> 
				<p><span class="badge"><?php  echo count($replies) ; ?></span> Comments:</p><br>
				</div>
					
	
		
			<form method="post" name="commentForm" class="commentForm" action="<?php echo $this->config->base_url(); ?>admin/SupportTickets/add_ticket_reply/?id=
			<?php echo $_GET['id'] ;  ?>"> 
			

			 <div class="form-group">
				<!-- <input type="hidden" name="t_id" value="<?php echo $_GET['id'] ;   ?>"> -->
				     <input type="hidden" name="p_id" value="<?php echo $_GET['id'] ;   ?>">
						<input type="hidden" name="u_id" value="<?php echo $this->session->userdata('ID') ;   ?>">
						     <input type="hidden" value="reply" name="t_type">
						 <input type="hidden" name="to_id" value="<?php echo $ticket->u_id ;  ?>">
							   <!--	<input type="hidden" name="datetime" value="<?php  echo $currentDate_time ; ?>">  -->
					  <textarea style="height: 200px;border-width: px;border: 1px solid;border-color: lightgrey;"class="form-control" rows="10" name="detail" required></textarea>
					</div>
			 <button type="submit" class="btn btn-success">Submit</button>

			</form>

				
				


			<!--  row starts -->      
				<?php   
				  //   echo "<pre>" ;
					//  print_R($replies) ;
					//    echo "</pre>" ;      
						
				if($replies):  
						foreach($replies as $r_val) :

							
				?>
                  <div id="ntfy" class="row space <?php echo  ($r_val['u_id'] == $current_user)? 'admin' : '' ;?> ">

					   <div class="col-sm-2 text-center <?php echo  ($r_val['u_id'] == $current_user)? 'admin' : '' ;?>">
                            <?php echo  ($r_val['u_id'] == $current_user)? '<img src="http://phasebuilder.com/membershipkc/images/worker.png" class="img-circle" height="65" width="65" alt="Avatar">' : '' ;?>
							</div>
					<?php
					$user = $CI->LoginModel->get_user($r_val['u_id']) ;
				
					?>
						<div class="col-sm-10 <?php echo  ($r_val['u_id'] == $current_user)? 'admin' : '' ;?>">
							<h4><?php echo $user->username ;  ?><small class="time"> <?php echo  $r_val['ticket_date']; ?></small></h4>
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

				var CheckStatus = "<?php  print $status  ?>" ;

						if(CheckStatus == 'open'){
							$('.commentForm').show();
						}else{

								$('.commentForm').hide();
						}
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
			
	$(document).on('click','a.selectstatus',function(e){
						
			e.preventDefault();
								
			var		value		=	$(this).attr('data-value');
							
			var 	   ticketId = "<?php  print $_GET['id'] ;  ?>" ;
								
			

				$.ajax({
						url: '<?php echo $this->config->base_url();  ?>admin/SupportTickets/change_Status',
						data: {
							'status': value,
							't_id' : ticketId 
							
							}, // change this to send js object
						type: "post",
						success: function(data){
						   //document.write(data); just do not use document.write
							$('#d_status').text(data) ;
							
									if(data == 'open'){
										
										$('.commentForm').show();
										 $("#d_status").addClass("label-success");
										 $("#d_status").removeClass("label-danger") ;	
									}
									else{
										
										$('.commentForm').hide();
										  $("#d_status").removeClass("label-success");
										 $("#d_status").addClass("label-danger") ;	
									}
						}
				});
			})
</script>

	<?php  

	$this->load->view("admin/common/footer.php"); 

	?>