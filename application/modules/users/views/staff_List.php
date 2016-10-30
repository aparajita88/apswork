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
							<div class="panel-body">
									
									<!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
						
								<h2 class="panel-title">Staff User List<a href="<?php echo $this->config->item('base_url');?>index.php/users/add_staff" class="panel-action pull-right" title="Add Staff"><i class="fa fa-plus"></i></a></h2>
							</div>
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Staff Type</th>
											<th>Location</th>
											<th>City</th>
											<th>discount</th>
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
                                  
                                     	<td><?php echo $row['userEmail']; ?></td>  
                                     	
                                     	<td><?php echo $row['phone']; ?></td>  
                                     		<td><?php echo $row['userTypeName']; ?></td>   
                                     		<td><?php echo $row['l_name']; ?></td>   
                                     		<td><?php echo $row['c_name']; ?></td>
                                     		<td><?php echo(($row['discount']<>0)?$row['discount'].'%':"");?> </td>   
												<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeuserStatus('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/users/edit_staff/<?php echo $id;?>" ><i class="fa fa-pencil"></i></a>													
															<a href="<?php echo base_url();?>index.php/users/delete_staff/<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
											</td>
								  </tr>									
									  										
        							<?php
											}
										}
																		
									else{?>
											
											<tr class="gradex"><td colspan="8">No Staff user  Available.....</td></tr>
											
							
											
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
