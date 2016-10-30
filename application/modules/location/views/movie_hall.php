<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
</div>
			
		
	</header>
<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">MOVIE HALL LIST
							
									<a href="<?php echo $this->config->item('base_url');?>index.php/location/add_movie_hall" class="panel-action pull-right" title="Add Hall"><i class="fa fa-plus"></i></a>
							
							</h2>
							

							</div>	
											
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Hall Name</th>
											<th>Location</th>
                                            <th class="hidden-phone">Status</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if($movie_hall)
										{
											$counter=0;
											foreach($movie_hall as $row)
											{

												$id=$row['hallId'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['location']; ?></td>
									
                                  
                                        
												<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="change_hall_status('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/location/edit_movie_hall/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
											</td>
											<td class="center hidden-phone">
												<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/location/delete_hall/<?php echo $id;?>" title="Delete" class="demo-basic"  onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash"></i></a>
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
function change_hall_status(id,status)
{
	//alert(js_site_url);
	//alert(status);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/location/change_hall_status", 
      data: { _id:id, _status:status }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}
</script>
