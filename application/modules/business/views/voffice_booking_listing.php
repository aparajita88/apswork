<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header"><?php //print_r($userData); ?>
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			
	</header>
	<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
		<section class="panel">
			<div class="panel-body">
			<h2 class="panel-title">Virtual Office Bookings
			<a href="<?php echo $this->config->item('base_url');?>index.php/business/voffice" class="panel-action pull-right" title="Add Voffice Booking"><i class="fa fa-plus"></i></a>
			</h2>
			</div>
			<br>
							<!--<header class="panel-heading">
								
						
							</header>-->							
						<div class="panel-body">
								<?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?>
						</div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?>
						</div>
			<?php } ?><div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th>Business Center</th>
											<th>Address</th>
											<th >Virtual Office Type</th>
											<th>Booked For</th>
											<th >Total Price (INR)</th>
											<th>Agreement Date</th>
											<th>Start Date</th>
											<th>End Date</th>
											 <th>Status</th>
											
											
										    <th style="width: 108px !important;">Action</th>
										</tr>
									</thead>
									<tbody>
								<?php
								
									if(!empty($voffice))
									{
									
									foreach($voffice as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['businessName']; ?></td>
											<td><?php echo $row['address']; ?></td>
											<td><?php echo $row['name']; ?></td>	
											<?php if($row['Isclient']=='0'){$booked_for=$this->user->getdetails($row['booked_for']);
											$user_company=$booked_for[0]['company_name'];
											$user_name=$booked_for[0]['FirstName'].' '.$booked_for[0]['LastName'];}
											else{$booked_for=$this->login->getUserProfile($row['booked_for']);
											$user_company=$booked_for['company_name'];
											$user_name=$booked_for['FirstName'].' '.$booked_for['LastName'];} ?>
											<td><?php echo $user_company."<br/>(".$user_name; ?>)</td>		
											<td><?php echo $row['total_price']; ?></td>
											<td><?php echo $row['agreement_date']; ?></td>
											<td><?php echo $row['start_date']; ?></td>
											<td><?php echo $row['end_date']; ?></td>
										
											
											<td><?php if($row['isApproved']=='1'){echo '<strong><font color="green">ACCEPTED BY CLIENT</font></strong>'; }else{ echo '<strong><font color="blue">Sent to Client</font></strong>'; }?></td>
											
											<!--<td class="center hidden-phone">
                                    <a href="javascript:void(0)"  title="View Price Details" data-toggle="modal" data-target="#myModalview"
				       onclick="prcdetails('<?php echo $row['first_month_fee'];?>','<?php echo $row['registration_fee'];?>','<?php echo $row['service_retainer'];?>','<?php echo $row['monthly_payment'];?>','<?php echo $row['total_price'];?>')"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
											
											
											</td>-->
											<td>
											<?php if($row['isApproved']=='1'){?>
											<a href="<?php echo base_url(); ?>index.php/business/voffice_agreement_view_print/<?= $row['id'] ?>" class="btn pre agreementacceptbtn_print" target="_blank"><i class="fa fa-print"></i> Download Agreement</a>
											
											<?php }?></td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="10">No Booking Available.....</td></tr>
											
							
											
									<?php
									}?>
										
									</tbody>
								</table>
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
          <p>First Month Price: <span id="roomprice"></span></p>
          <p>Registration Fee: <span id="bkprice"></span></p>
          <p>Service Retainer: <span id="storeprice"></span></p>
          <p>Monthly Payment: <span id="intprice"></span></p>
          <p>Total Price: <span id="phoneprice"></span></p>
          
        </div>
        <div class="modal-footer">
           
        </div>
        
        
      </div>
      
    </div>
  </div>
						</section>
				
			<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>

<script>
function prcdetails(val1,val2,val3,val4,val5){
	
	
	$('#roomprice').html('<i class="fa fa-inr"></i> '+val1);
	$('#bkprice').html('<i class="fa fa-inr"></i> '+val2);
	$('#storeprice').html('<i class="fa fa-inr"></i> '+val3);
	$('#intprice').html('<i class="fa fa-inr"></i> '+val4);
	$('#phoneprice').html('<i class="fa fa-inr"></i> '+val5);
	}



</script>
