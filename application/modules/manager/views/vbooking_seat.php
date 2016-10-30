<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
		
			<!--<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
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
                        
							<div class="panel-body">
								<h2 class="panel-title">Private Office Bookings<a href="<?php echo $this->config->item('base_url');?>index.php/manager/seat_allocation" class="panel-action pull-right" title="Add Seat"><i class="fa fa-plus"></i></a></h2>
							</div>
							<div class="panel-body panel_body_top" id="pnlservicebody">
								
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											
                                          <th>City</th>
                                          <th>Location</th>
                                          <th>Business Center</th>
                                          <th>Booked For</th>
                                          <th>Floor</th>
                                          <th>Room No</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Total Price<br/>(INR)</th>
                                          <th>Purpose</th>
                                          <th>Status</th>
                                          <th>Action</th>
										</tr>
									</thead>
									
									<?php
									
										if($booking_info)
										{
											$counter=0;
											foreach($booking_info as $row)
											{
                                                
												$id=$row['id'];
                                                $price_details=json_decode($row['price_details']);
                                                
                                                $strprice='';
                                                if($price_details->bookself<>''){
                                                	$strprice.="Bookself: <i class='fa fa-inr'></i>".$price_details->bookself.'<br/>';
                                                }
                                                if($price_details->internalstorage<>''){
                                                	$strprice.="Internal Storage: <i class='fa fa-inr'></i>".$price_details->internalstorage.'<br/>';
                                                }
        										if($price_details->internet<>''){
                                                	$strprice.="Internet: <i class='fa fa-inr'></i>".$price_details->internet.'<br/>';
                                                }
                                                if($price_details->phone<>''){
                                                	$strprice.="Phone: <i class='fa fa-inr'></i>".$price_details->phone.'<br/>';
                                                }
                                                if($price_details->wifi<>''){
                                                	$strprice.="Wifi: <i class='fa fa-inr'></i>".$price_details->wifi.'<br/>';
                                                }

									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['location']; ?></td>
                                    <td><?php echo $row['businessName']?></td>
                                    <td><?php echo $row['company_name']?><br/><?php echo "(".$row['clntname'].")"?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo implode(", ",json_decode($row['title'])); ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($row['start_date'])); ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($row['end_date'])); ?></td>
                                    <td><i class='fa fa-inr'></i> <?php echo $row['total_price']; ?></td>
                                    
                                    <td><?php echo substr($row['purpose'],0,50); ?></td>
                                   <td><?php if($row['IsApproved']=="1"){?>
											<strong><font color="green">ACCEPTED BY CLIENT</font></strong>
                                        <?php }else if($row['IsApproved']=="0"){?>
											<strong><font color="blue">SENT TO CLIENT</font></strong>
											<?php }else if($row['IsApproved']=="2"){?>
											<strong><font color="red">REJECTED BY CLIENT</font></strong>
											<?php }?>
												</td>
                                    
											<td>
											<a href="<?php echo base_url(); ?>index.php/private_office_agreement/vprivate_office_agreement_print/<?= $row['id'] ?>" class="btn pre agreementacceptbtn_print" target="_blank" <?php if($row['book_for_client']==""){?>style="display:none;"<?php }?>>  <i class="fa fa-print"></i> Download Agreement</a>
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
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Price Details</b></h4>
        </div>
            
			<div class="modal-body">
          <p>Price Details:</p>
          <p>Room Price: <span id="roomprice"></span></p>
          <p>Bookself Cost: <span id="bkprice"></span></p>
          <p>Internal Storage Cost: <span id="storeprice"></span></p>
          <p>Internet Cost: <span id="intprice"></span></p>
          <p>Phone Cost: <span id="phoneprice"></span></p>
          <p>Wifi Cost: <span id="wifiprice"></span></p>
          <p>Total Cost: <span id="totalprice"></span></p>
        </div>
        <div class="modal-footer">
           
        </div>
        
        
      </div>
      
    </div>
  </div>

			
		</section>
	<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	function appseatbook(seatid){
		$.ajax({ 
      url: js_site_url+"index.php/manager/approvedseatallocation", 
      type: 'post',
      data: "seatid="+seatid,
        
        success: function(result)
        {
			alert(result);
			//location.reload();
		}
    });
	}
	function seatreject(appid){
		var r=confirm('Are you sure you want to reject the booking request?');
		if (r == true) {
		$.ajax({
		  url: '<?php echo base_url();?>index.php/manager/rejectseatbook', 
		  type: 'post', 
		  data:"txtreject="+appid,
		  
		success: function(result) {
			location.href = "<?php echo base_url();?>index.php/manager/booking_seat";
		
			
			}
		});
	}
	}
	function prcdetails(val1,val2,val3,val4,val5,val6){
		var val7=parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4)+parseInt(val5)+parseInt(val6);
		$('#bkprice').html('<i class="fa fa-inr"></i> '+val1);
		$('#storeprice').html('<i class="fa fa-inr"></i> '+val2);
		$('#intprice').html('<i class="fa fa-inr"></i> '+val3);
		$('#phoneprice').html('<i class="fa fa-inr"></i> '+val4);
		$('#wifiprice').html('<i class="fa fa-inr"></i> '+val5);
        $('#roomprice').html('<i class="fa fa-inr"></i> '+val6);
        $('#totalprice').html('<i class="fa fa-inr"></i> '+val7);
	}
	
</script>
