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
                            <div class="panel-body">
                             <h2 class="panel-title">Request for Services<a href="<?php echo $this->config->item('base_url');?>index.php/request/add_request_courier" class="panel-action pull-right" title="Add Request for Client"><i class="fa fa-plus"></i></a>
                            </h2>
                            </div> 
                            <div class="panel-body panel_body_top">
                        		<div class="form-group">
                               <form name="frmtype" method="post">
                               <div class="col-md-12" align="right">       
                                 <select name="req_type" id="req_type" onchange="fntype(this.value);" class="design_select">
                                    <option value="courier">Courier Service</option>
                                    <?php 
                                    if(!empty($staff_type))
                                        {
                                            
                                            foreach($staff_type as $row)
                                            {
                                            	if($row['stuff_type']!='legal support' &&  $row['stuff_type']!='phone reception' && $row['stuff_type']!='secretarial support' && $row['stuff_type']!=""){
                                            	?>
                                                <option value="<?php echo $row['stuff_type'];?>"><?php echo $row['stuff_type'];?></option>
                                        <?php }}}?>
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
                                          <th>Description</th>
                                          <th>Destination</th>
                                          <th>Request Type</th>
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
									
										if($courier_support)
										{
											$counter=0;
											foreach($courier_support as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['cites']; ?></td>
                                    <td><?php echo $row['location']?></td>
                                    <td><?php echo((strlen($row['package_description'])>50)?substr($row['package_description'],0,48)."..":$row['package_description']); ?></td>
                                      <td><?php echo $row['destination']; ?></td>
                                    <td><?php echo $row['courier']; ?></td>
                                    <td><?php if($row['IsApproved']=="1"){?>
											<strong><font color="green">CLOSED</font></strong>
                                        <?php }else if($row['IsApproved']=="2"){?>
											<strong><font color="red">Rejected</font></strong>
											<?php }else{?>
												<strong><font color="blue">OPEN</font></strong>
												<?php }?>
												</td>
												
                                    <td class="center hidden-phone">
										<?php if($row['IsApproved']=="0"){?>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequest('<?php echo $id;?>','request_courier_service')" title="CLOSED"><font color="green"><i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</a>&nbsp;
										<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="appreject('<?php echo $id;?>','request_courier_service')"
																						  title="Reject"><i class="fa fa-ban" style="font-size:18px;"></i></a>
										<?php }else{?>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequestview('<?php echo $id;?>','request_courier_service')" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
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
	function apprequest(appid,tbname){
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_request_by_id', 
  type: 'post', 
  data:"appid="+appid+"&tbname="+tbname,
  
success: function(result) {
	//alert(result);
    $("#contactModal").html(result);
    }
});
	}
	function apprequestview(appid,tbname){
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/manager/get_requestview_by_id', 
  type: 'post', 
  data:"appid="+appid+"&tbname="+tbname,
  
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
		  data:"appid="+appid+"&tbname="+tbname,
		  
		success: function(result) {
			location.href = "<?php echo base_url();?>index.php/manager/service_request";
		
			
			}
		});
	}
	}
	
</script>

