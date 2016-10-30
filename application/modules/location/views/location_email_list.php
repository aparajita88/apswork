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
							<div class="panel-body"><h2 class="panel-title">Community Managers LIST</h2></div>					
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
										  <th>Admin Email</th>
										  <th>Community Manager</th>
											<th>Location Name</th>
                                          <th>City Name</th>
                                          
											
											<th class="hidden-phone">Edit</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
									//print_r($location);
										if($location)
										{
											$counter=0;
											foreach($location as $row)
											{

												$id=$row['locationId'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['admin_name']; ?></td>
									<td><?php echo $row['name']; ?></td>
                                   <td><?php echo $row['c_name']; ?></td>

												<!---<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="change_location_status('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>--->
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/location/edit_location_email/<?php echo $id;?>/<?php echo $row['cityId'];?>"><i class="fa fa-edit"></i></a>
											</td>
											<!----<td class="center hidden-phone">
												<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/location/delete_location/<?php echo $id;?>/<?php echo $row['cityId'];?>" title="Delete" class="demo-basic"  onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash"></i></a>
											</td>--->
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
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function change_location_status(id,status)
{
	//alert(js_site_url);
	//alert(id);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/location/change_location_status", 
      data: { _id:id, _status:status }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}
</script>
