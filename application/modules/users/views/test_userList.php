<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
			
         <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName']; ?></h2>
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
								<div class="panel-actions">
									<!--<a href="<?php echo $this->config->item('base_url');?>index.php/users/add_user" class="panel-action" title="Add Feature"><i class="fa fa-plus"></i></a>-->
									<!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
								</div>
						
								<h2 class="panel-title">User List</h2>
							</div>
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Name</th>
											<th>Email</th>
											<th>Contact No</th>
											<th>Location</th>
                                            <th>City</th>
                                            
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
										</tr>
									</thead>
									<tbody>
											<?php
											//print_r($query);
											if($query)
											{
												foreach($query as $row)
												{
													$id=$row['userId'];
											
											?>	
											<tr id="del<?php echo $id;?>" class="gradeX">
											<td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>
											<td><?php echo $row['userEmail'];?></td>
											<!--<td><?php if($row['image']!=""){?><img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['image']; ?>" width="80"/>
												<?php }?><?php if($row['image']==""){
													 echo 'N/A';}?></td>-->
										    <td><?php echo $row['phone']; ?></td>
										    <td><?php echo $row['l_name']; ?></td>
										    <td><?php echo $row['c_name']; ?></td>
											<!--<td><input type="submit" class="btn btn-primary" name="acc_activate" value="Activate Account"></td>-->
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic"   href="<?php echo $this->config->item('base_url');?>index.php/users/edit_user/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
											</td>
											<td class="center hidden-phone">
												<a title="Delete" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/users/delete_user/<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
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
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function change_city_status(id,status)
{
	//alert(js_site_url);
	//alert(id);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/location/change_city_status", 
      data: { _id:id, _status:status }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}
</script>
