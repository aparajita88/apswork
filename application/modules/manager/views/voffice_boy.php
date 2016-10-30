<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			<!---<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>--->
			</ol>
</div>
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>

					
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<header class="panel-heading">
								<div class="panel-actions">
									<!--<a href="<?php //echo $this->config->item('base_url');?>index.php/receptionist/add_visitor" class="panel-action" title="Add Location"><i class="fa fa-plus"></i></a>-->
									<!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
								</div>
						
							<h2 class="panel-title">Office Boy</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Client</th>
                                          <th>City</th>
                                          <th>Location</th>
                                          <th>Description</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<tbody>
									<?php
									//print_r($location);
										if($office_boy)
										{
											$counter=0;
											foreach($office_boy as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>
                                    <td><?php echo $row['cites']; ?></td>
                                    <td><?php echo $row['location']?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php if($row['start_date']<>'0000-00-00'){echo date('d/m/Y',strtotime($row['start_date']));} ?></td>
                                    <td><?php if($row['end_date']<>'0000-00-00'){echo date('d/m/Y',strtotime($row['end_date'])); }?></td>
                                    <td><?php if($row['IsApproved']=="1"){?>
											<strong><font color="green">Approved</font></strong>
                                        <?php }else if($row['IsApproved']=="2"){?>
											<strong><font color="red">Rejected</font></strong>
											<?php }else{?>
												<strong><font color="blue">Waiting for Approval</font></strong>
												<?php }?>
												</td>
                                    <td class="center hidden-phone">
										<?php if($row['IsApproved']=="0"){?>
										<a href="javascript:void(0)" class="hidden-sm btn btn-success" data-toggle="modal" data-target="#contactModal" onclick="apprequest('<?php echo $id;?>','<?php echo $row['stuff_type'];?>')">Approve</a>
										<a href="javascript:void(0)" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal" onclick="appreject('<?php echo $id;?>')">Reject</a>
										<?php }else{?>
											<a href="javascript:void(0)" class="hidden-sm btn btn-info" data-toggle="modal" data-target="#contactModal" onclick="apprequestview('<?php echo $id;?>','<?php echo $row['stuff_type'];?>')">view</a>
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
                 <div id="contactModal" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog">
                    
                </div>
			
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	function apprequest(appid,retype){
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_request_by_id', 
  type: 'post', 
  data:"appid="+appid+"&retype="+retype,
  
success: function(result) {
    $("#contactModal").html(result);
    }
});
	}
	function apprequestview(appid,retype){
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_requestview_by_id', 
  type: 'post', 
  data:"appid="+appid+"&retype="+retype,
  
success: function(result) {
	
    $("#contactModal").html(result);
    }
});
	}
	function appreject(appid){
		var r=confirm('Are you sure you want to reject the service request');
		if (r == true) {
		$.ajax({
		  url: '<?php echo base_url();?>index.php/manager/reject_request', 
		  type: 'post', 
		  data:"appid="+appid,
		  
		success: function(result) {
			location.href = "<?php echo base_url();?>index.php/manager/office_boy";
			}
		});
	}
	}
</script>


