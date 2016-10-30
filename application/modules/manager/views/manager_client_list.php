<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			<!--<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>-->
			</ol>
</div>
			<!--<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
		
	</header>

				
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">Client User List</h2></div>					
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Contact Name</th>
											<th>Client Name</th>
											<th>Email</th>
											<th>Phone</th>
											
											
											<th>Location</th>
											<th>City</th>
											<th class="hidden-phone">Status</th>
											<th style="width: 108px !important;">Actions</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
										if($query)
										{
											//print_r($query);
											$counter=0;
											foreach($query as $row)
											{

												$id=$row['userId'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['FirstName']; ?>  <?php echo $row['LastName']; ?></td>
                                  	<td><?php echo $row['company_name']; ?></td>	
                                     	<td><?php echo $row['userEmail']; ?></td>  
                                     	
                                     	<td><?php echo $row['phone']; ?></td>  
                                     		
                                     		<td><?php echo $row['l_name']; ?></td>   
                                     		<td><?php echo $row['c_name']; ?></td>   
												<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeuserStatus('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/areadirector/edit_client/<?php echo $id;?>" ><i class="fa fa-pencil"></i></a>													
														
											</td>
								  </tr>									
									  										
        							<?php
											}
										}
																		
									else{?>
											
											<tr class="gradex"><td colspan="8">No Client  Available.....</td></tr>
											
							
											
									<?php
									}?>
										
										
									</tbody>
								</table>
							</div>
						</section>
					
					
				</section>
			
	
			
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function changeuserStatus(id,status)
{
	//alert(js_site_url);
	//alert(id);
	var table='user';
	var pid='userId';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/users/changeuserStatus", 
      data: { _id:id, _status:status,_table:table,_pid:pid,}, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}

</script>
