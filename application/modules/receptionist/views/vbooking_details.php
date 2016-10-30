<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>
.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
		
		
	</header>

					
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
                        
							<div class="panel-body"><h2 class="panel-title">Booking Details</h2>
								
								<div class="form-group">
								
                               <form name="frmtype" method="post">
												
                                               
                                               <div class="col-md-12" align="right">       
											 <select name="book_type" id="book_type" onchange="fnbktype(this.value);" class="design_select">
                                    			<option value="conference_room">Conference Room</option>
												<option value="meeting_room">Meeting Room</option>
												<option value="locker_room">Locker Room</option>
												<option value="game_room">Play Room</option>
									
                                        </select>
                                        	 </div>
									</form>		
								</div>
							</div>
							<div class="panel-body panel_body_top" id="pnlservicebody">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Client</th>
                                          <th>City</th>
                                          <th>Location</th>
                                          <th>Name</th>
                                          <th>Purpose</th>
                                          <th>Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<tbody>
										
									<?php
									
										if($booking_data)
										{
											$counter=0;
											foreach($booking_data as $row)
											{

												$id=$row['id'];
												$booking_info=json_decode($row['booking_details']);
												$bkinfstr="";
												foreach($booking_info as $key=>$val){
													$bkinfstr.=date('d/m/Y',strtotime($key))."(".implode(',',$val).")".'</br>';
													
												}
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['FirstName']." ".$row['LastName']." (".$row['company_name'].")"; ?></td>
                                    <td><?php echo $row['cites']; ?></td>
                                    <td><?php echo $row['location']?></td>
                                    <td><?php echo $row['conference_room']; ?></td>
                                      <td><?php echo $row['purpose']; ?></td>
                                    <td><?php echo $bkinfstr; ?></td>
                                    <td><?php if($row['is_approved']=="1"){?>
											<strong><font color="green">Booked</font></strong>
                                        <?php }else if($row['is_approved']=="2"){?>
											<strong><font color="red">Rejected</font></strong>
											<?php }else{?>
												<strong><font color="blue">Waiting for Approval</font></strong>
												<?php }?>
												</td>
												
                                    <td class="center hidden-phone">
										
											<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="appbookview('<?php echo $id;?>',$('#book_type').val())" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
</a>
											
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
			
	
			
			
		</section>
		<!--  modal -->
                 <div id="contactModal" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog">
                    
                </div>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	function fntype(val){
		
			$.ajax({
	  url: '<?php echo base_url();?>index.php/manager/get_request_by_type', 
	  type: 'post', 
	  data:"apptype="+val,
	  
	success: function(result) {
		   $("#pnlservicebody").html(result);
		}
	});
	}
	function appbooking(appid,tbname){
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_booking_by_id', 
  type: 'post', 
  data:"appid="+appid+"&tbname="+tbname,
  
success: function(result) {
	//alert(result);
    $("#contactModal").html(result);
    }
});
	}
	function appbookview(appid,tbname){
		//alert(appid);
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_bookingview_by_id', 
  type: 'post', 
  data:"appid="+appid+"&tbname="+tbname,
  
success: function(result) {
	//alert(result);
    $("#contactModal").html(result);
    }
});
	}
	function appbookreject(appid,tbname){
		//alert(appid);
		//alert(tbname);
		var r=confirm('Are you sure you want to reject the booking request?');
		if (r == true) {
		$.ajax({
		  url: '<?php echo base_url();?>index.php/manager/reject_booking', 
		  type: 'post', 
		  data:"appid="+appid+"&tbname="+tbname,
		  
		success: function(result) {
			location.href = "<?php echo base_url();?>index.php/manager/booking_details";
		
			
			}
		});
	}
	}
	function fnbktype(value){
		var url="";
		if(value!="game_room"){
			url="<?php echo base_url();?>index.php/manager/get_booking_details/";
		}else{
			url="<?php echo base_url();?>index.php/manager/get_booking_details_for_game/";
		}
		$.ajax({
		  url: url+value, 
		  success: function(result) {
			  $("#datatable-default").html(result);
			//location.href = "<?php echo base_url();?>index.php/manager/service_request";
		
			
			}
		});
	}
	
</script>

