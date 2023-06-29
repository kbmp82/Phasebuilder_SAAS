	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	?>

	<?php

	$this->load->view("admin/common/header.php");
	$this->load->view("admin/common/sidebar.php"); 
	//$this->load->library('javascript/jquery');
	?>

	<style>
	button.btnSubmit.btn.btn-success.form-control {
		margin-top: 9px;
	   
	}

	</style>

	<!-- Page wrapper  -->


	<div class="page-wrapper">


		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-primary">Reporting</h3> </div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
					<li class="breadcrumb-item active">Reporting</li>
				</ol>
			</div>
		</div>

	 <?php
	 

	  $ci =&get_instance();

	$ci->load->model('admin/ReportingModel');

	$transaction = $ci->ReportingModel->get_Transactions();
	   

	 ?>
	   
	   
	   
		  <!-- Container fluid  -->
				<div class="container-fluid">
					<!-- Start Page Content -->
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Data Export</h4>
									<h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

									<div class="table-responsive m-t-40">
										
										
										<form method="post" name="filterSearch">      
											   <div class="row">
												
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">From Date</label>
									   <input type="date" class="form-control"  name="fromdate" id="from" placeholder="dd/mm/yyyy">
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">To Date</label>
														<input type="date"  name="todate" class="form-control"  id="to" placeholder="dd/mm/yyyy">
													</div>
												</div>
												
										  <div class="col-md-2">
											  <div class="form-group">
											   <label class="control-label"></label>
															<button class="btnSubmit btn btn-success form-control">Submit</button>
												</div>
											</div>  
										  
								
								<?php
								$monday = strtotime("last monday");
								$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
								 
								$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
								 
								$this_week_sd = date("Y-m-d",$monday);
								$this_week_ed = date("Y-m-d",$sunday);
								 
							  
								?>
								</div>
									   </form> 
									   
					   <form method="post" action="">
							   <div class="row table_space">
						
					    <div class="col-md-2">     
							
								<input type="hidden" value="<?php echo $this_week_ed ; ?>" name="currentDay">    
							<button name="currentday" value="" class="btn btn-success">Current Day</button>
						</div> 
						
								  
						 <div class="col-md-2">     
								<input type="hidden" value="<?php echo  $this_week_sd ;  ?>" name="weekstarted">    
								<input type="hidden" value="<?php echo $this_week_ed ; ?>" name="weeksend">    
							<button name="currentweek" value="" class="btn btn-success">Current Week</button>
						</div> 
								
							 <div class="col-md-3">     
								  <button name="currentmonth" value="<? echo date('m'); ?>" class="btn btn-success">Current month</button>
								</div>  
											
								<div class="col-md-2">     
										  <button name="lastmonth" value="" class="btn btn-success">Last month</button>
							   </div>  
											
								<div class="col-md-3">     
									<button name="lastdays" value="" class="btn btn-success">Last 14 days</button>
								</div>  
						</div>
					   </form>
					   
					   
										<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
											  
									   
											<thead>
												<tr>
													<th># </th>
													<th>TransactionID</th>

													<th>Subscription Name</th>
													
													<th>Adons</th>
													
													<th>Order Date</th>

													<th>Amount Paid</th>

													<th>Currency</th>

													<th>Payment Status</th>
												</tr>
											</thead>
										
											<tbody>
												<?php
													
													if($transaction){
														$i = 1 ;    
															foreach($transaction as $t_val){
												?>
											 
												<tr>
													
													<td><?php echo $i ;  ?></td>
													
													<td><?php echo $t_val->transaction_id ;    ?></td>
													
													<td><?php echo $t_val->title ;  ?></td>
													<td><?php echo $t_val->subtitle ;  ?></td>
													<td><?php echo $t_val->order_time ;  ?></td>
													<td><?php echo $t_val->amount ;  ?></td>
													<td><?php echo $t_val->currency_code ;  ?></td>
													<td><?php echo $t_val->payment_status ;  ?></td>
											   
												</tr>
											
											<?php 
														  $i++ ;    }
														  
												  }
												 ?>    
											 
											</tbody>
											
												<tfoot>
												<tr>
													  <th># </th>
													 <th>TransactionID</th>

													<th>Subscription Name</th>
													
													<th>Adons</th>

													<th>Order Date</th>

													<th>Amount Paid</th>

													<th>Currency</th>

													<th>Payment Status</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						  
						  
						</div>
					</div>
					<!-- End PAge Content -->
				</div>
				<!-- End Container fluid  -->
	   
	   
	   
	   </div>
	   


	<?php $this->load->view("admin/common/footer.php"); ?>


	<script>

	</script>
