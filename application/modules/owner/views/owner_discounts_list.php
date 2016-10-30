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
							<div class="panel-body"><h2 class="panel-title">DISCOUNT REQUEST</h2></div>					
							<div class="panel-body panel_body_top">
							
								<!--<div class="panel-actions">
									<form name="frmtype" method="post">
								<div class="col-md-3">
								<select name="req_type" id="req_type" onchange="fntype(this.value);">
									
								</select>
								<label>Request Type</label>
								</div>
							</form>
								</div>-->
						
							
						<!---	<div class="panel-body" id="pnlservicebody">--->
								
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Client</th>
                                          <th>Company</th>
                                          <th>Discounts</th>
                                          <th>Detailes</th>
                                          <th>Date Added</th>
                                         
                                          <th>Status</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<tbody>
										<!--<tr class="gradeX">
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
										</tr>-->
									<?php
									
										if($discount_data)
										{
											$counter=0;
											foreach($discount_data as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['FirstName']; ?>    <?php echo $row['LastName']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['discounts']?></td>
                                    <td><?php echo((strlen($row['details'])>50)?substr($row['details'],0,48)."..":$row['details']); ?></td>
                                      <td><?php echo $row['dateAdded']; ?></td>
                                   
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
										<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequest('<?php echo $id;?>','1')" title="Approve"><font color="green"><i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</a>&nbsp;
										<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="appreject('<?php echo $id;?>')" title="Reject"><font color="red"><i class="fa fa-times" style="font-size:18px;"></i></font>
</a>
										<?php }else{?>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequestview('<?php echo $id;?>')" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
</a>
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
	function apprequest(appid,val){
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/owner/apprequest', 
  type: 'post', 
  data:"appid="+appid+"&isApproved="+val,
  
success: function(result) {
	//alert(result);
    $("#contactModal").html(result);
    }
});
	}
	function apprequestview(appid,tbname){
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/owner/appview', 
  type: 'post', 
  data:"appid="+appid+"&tbname="+tbname,
  
success: function(result) {
	
    $("#contactModal").html(result);
    }
});
	}
	function appreject(appid){
		var r=confirm('Are you sure you want to reject the service request');
		if (r == true) {
		$.ajax({
		  url: '<?php echo base_url();?>index.php/owner/reject_discount', 
		  type: 'post', 
		  data:"appid="+appid,
		  
		success: function(result) {
			location.href = "<?php echo base_url();?>index.php/owner/discounts_list";
		
			
			}
		});
	}
	}
	
</script>

