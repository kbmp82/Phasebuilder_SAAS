<?php
$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php");
$ci =&get_instance();
?>
<style>
.card {
    margin: 15px 44px;
}
a#ticket_detail{
    color:blue ; 
}
#pagination a {
    color: blue;
}
a#currentPage {
    color: black;
    font-style: italic;
    font-size: 17px;
}
</style>
   <!-- Page wrapper  -->
        <div class="page-wrapper">


<div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Tickets</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tickets</li>
                    </ol>
                </div>
            </div>

<div class="row">

		<div class="error_reported">
			<?php 
						if($this->session->flashdata('ticket_delete')){
								echo $this->session->flashdata('ticket_delete');
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
	                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Tickets</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="ticket_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ticket</th> 
                                                <th>From </th>
                                                <th>Subject</th>
                                                <th>Detail</th>

                                                <th>Date</th>
                                                <th>Status</th>
                                              
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php

  // $nb_elem_per_page = 2;
  // $page = isset($_GET['page'])?intval($_GET['page']-1):0;
               
	// $number_of_pages = intval(count($tickets)/$nb_elem_per_page)    +   1 ;     


       if($tickets):
	   
           $count =  1 ;
		
			// $ticket_Reecord =	   array_slice($tickets,$page*$nb_elem_per_page , $nb_elem_per_page) ;
		
           foreach($tickets as $t_val):
               $published_date    =   $t_val['ticket_date'] ;
                $newDate = date("d M-Y", strtotime($published_date));
                $currentDate_time =     date("Y-m-d H:i:s", NOW() );
                              $status  =       $t_val['status'] ;
                                 $ci->load->model('admin/TicketsModel');

                                     $unread  =   $ci->TicketsModel->get_unread($t_val['t_id'],0);
?>
                                            <tr>
                                              	<td><span><?php echo $t_val['t_id'] ;  ?></span> </td>
                                                  <td><span><?php echo ($unread === 1)?"Unread":"Read";  ?></span></td>
											    <td><span><?php echo $t_val['username'] ;  ?></span> </td>
                                                <td><span><?php echo $t_val['subject'] ;  ?></span></td>
                                                <td><span><?php echo $t_val['detail'] ;  ?></span></td>

                                                <td><span><?php echo    $newDate ;  ?></span></td>
                                                 <td>	<span  id="d_status" class="label label-<?php echo  ($status == 'open') ? 'success' : 'danger' ;    ?>"><?php echo  $status ;   ?></span></td>    
                                                <td><span><a href="<?php echo base_url('admin/SupportTickets/ticket_view/')."?id=".$t_val['t_id'] ; ?>" id="ticket_detail" >View</a></span>/
												
												<span><a href="" id="del_tkt" data-id="<?php echo $t_val['t_id'] ; ?>" >Delete</a></span></td>
                                                
                                            </tr>
                                           
                                          <?php 
                                         $count++ ; 
        endforeach ;
		
        ?>
    
    <tfoot><tr>
      <div id='pagination'  class="clearfix vc_col-sm-12" style="text-align: center;" >
				
<?php				
			

			
            // for($i=1    ;   $i<$number_of_pages ;   $i++  ){
	
		// $current		=	($i == $_GET['page'])? 'currentPage'  : '' ;
				?>
            
    <!--       <a href='<?php echo base_url('Support/view_tickets')  ?>/?page=<?=$i?>'   id ="<?php echo $current ;  ?>"><?php echo $i ;  ?></a>
	
	-->
<?php 
			// }
				
	
			
			
?>
		
		
</div>                  
    </tr>
  </tfoot>
  
<?php        
     else:
 ?> 

 <tr>
       <td colspan="6"><p style="    text-align: center;padding: 18px;">No record found</p></td>
                                                
 </tr>

<?php 
     endif ;
?>
   
                                        </tbody>
                     
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>

<script>
$(document).on('click','#del_tkt',function(e){
		e.preventDefault();
		tkt_id	=	$(this).attr('data-id') ;
		
		var answer = confirm('Are you sure you want to delete this?');
		 if (answer)
        {
			$.ajax({
						url: '<?php echo $this->config->base_url();  ?>admin/SupportTickets/deleteticket',
						data: {
							
							't_id' : tkt_id 
							
							}, // change this to send js object
						type: "post",
						success: function(data){
						    location.reload();

						}
				});		
        }
        else
        {
          console.log('cancel');
        }
})
</script>

<?php
$this->load->view("admin/common/footer.php");
?>