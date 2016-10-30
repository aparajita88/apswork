<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
		
			
		<style>
		.redmessage{
border:1px solid #f00;
color:#f00;                                                       	
	
}
.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
.redmessage::-moz-placeholder {
    color: #FF0000;
 }

.redmessage::-webkit-input-placeholder 
{
  color: #FF0000;
}
</style>
	</header>
	<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">WORKSPACE ALLOCATIONS</h2></div>					
							<div class="panel-body panel_body_top">
												
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
										  <th style="display: none;">No</th>
										  <th>City</th>
                                          <th>Location</th>
                                          <th>Business Center</th>
                                          <th>Floor</th>
                                          <th>Room No</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Purpose</th>
                                          <th>Total Price</th>
                                          <th>Discount</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<t
									<?php
									
										if($booking_info)
										{
											$counter=0;
											foreach($booking_info as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['location']; ?></td>
                                    <td><?php echo $row['businessName']?></td>
                                    <td><?php echo $row['description']; ?></td>
                                      <td><?php echo implode(", ",json_decode($row['title'])); ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($row['start_date'])); ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($row['end_date'])); ?></td>
                                    <td><?php echo substr($row['purpose'],0,50); ?></td>
                                    <td><i class="fa fa-inr"></i> <?php echo $row['total_price']; ?></td>
                                    <td><?php echo $row['discount']; ?>%</td>
                                    <td class="center hidden-phone">
											<?php if($row['Is_approved_ad']=='1'){?>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#myModalview" onclick="appdiscountprice('<?php echo $id;?>')" title="Approve discount price"><font color="green"><i class="fa fa-check-square-o" style="font-size:18px;"></i></font></a>

										<?php }else if($row['Is_approved_ad']=='2'){?>
											<strong><font color="green">Approved</font></strong>
											<?php }?>
											</td>
								  </tr>								
									  										
        							<?php
											}
										}
									?>	
																	
									</tbody>
								</table>
							</div>
						</section>
					
					
				</section>
			
		<!--  modal -->
                 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Seat Booking</b></h4>
        </div>
        <form id="frmrejbook" name="frmrejbook" method="post" action="<?php echo base_url();?>index.php/manager/rejectseatbook">
			<input type="hidden" name="txtreject" id="txtreject" value=""/>
			<div class="modal-body">
          <p>Do you want to reject this booking?</p>
        </div>
        <div class="modal-footer">
           <button type="submit" class="btn btn-primary" id="rejseatbook">Ok</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </form>
        
      </div>
      
    </div>
  </div>
			
	<!-- model for view -->
	  <div class="modal modal-block-xs fade" id="myModalview" role="dialog">
    
  </div>		
		</section>
	<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	function appseatbook(appid){
		//alert(appid);
		$.ajax({ 
       url: '<?php echo base_url();?>index.php/areadirector/approved_seat_book_byareadirector', 
      type: 'post',
      data: "appid="+appid,
        
        success: function(result)
        {
			//alert(result);
			location.href = "<?php echo base_url();?>index.php/areadirector/dashBoard";
		}
    });
	}
	function appseatreject(appid){
		//alert(appid);
		$.ajax({ 
       url: '<?php echo base_url();?>index.php/areadirector/reject_seat_book_byareadirector', 
      type: 'post',
      data: "appid="+appid,
        
        success: function(result)
        {
			//alert(result);
			location.href = "<?php echo base_url();?>index.php/areadirector/dashBoard";
		}
    });
	}
	function appdiscountprice(id){
		
       $.ajax({ 
       url: '<?php echo base_url();?>index.php/areadirector/approved_discount_byareadirector', 
	      type: 'post',
	      data: "appid="+id,
	        
	        success: function(result)
	        {
				
				$('#myModalview').html(result);
				//location.href = "<?php echo base_url();?>index.php/areadirector/dashBoard";
			}
	    });
	}
</script>
