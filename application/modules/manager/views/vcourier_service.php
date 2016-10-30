<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
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
							<header class="panel-heading">
								<div class="panel-actions">
									
								</div>
						
							<h2 class="panel-title">Request for Courier Services</h2>
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
										<tr class="gradeX">
											<td>Amit Hazra</td>
											<td>Kolkata</td>
											<td>Sec5</td>
											<td>adse</td>
											<td>05/03/2016</td>
											<td>10/03/2016</td>
											 <td class="center hidden-phone">
										<button type="button" class="btn btn-info btn-sm btn-success" data-toggle="modal" data-target="#myModal">Approved</button>
										<button type="button" class="btn btn-info btn-sm btn-danger" data-toggle="modal" data-target="#myModal">Rejected</button>

											</td>
										</tr>
														
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
	function apprequest(appid,retype,tbname){
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_request_by_id', 
  type: 'post', 
  data:"appid="+appid+"&retype="+retype+"&tbname="+tbname,
  
success: function(result) {
	
    $("#contactModal").html(result);
    }
});
	}
	function apprequestview(appid,retype,tbname){
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_requestview_by_id', 
  type: 'post', 
  data:"appid="+appid+"&retype="+retype+"&tbname="+tbname,
  
success: function(result) {
	
    $("#contactModal").html(result);
    }
});
	}
	function appreject(appid,tbname){
		var r=confirm('Are you sure you want to reject the service request');
		if (r == true) {
		$.ajax({
		  url: '<?php echo base_url();?>index.php/manager/reject_request', 
		  type: 'post', 
		  data:"appid="+appid,
		  
		success: function(result) {
			if(tbname="request_stuff_service"){
				location.href = "<?php echo base_url();?>index.php/manager/service_request";
			}
			
			}
		});
	}
	}
</script>

