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
							<div class="panel-body"><h2 class="panel-title">REGION LIST
							
									<a href="<?php echo $this->config->item('base_url');?>index.php/location/add_region" class="panel-action pull-right" title="Add Region"><i class="fa fa-plus"></i></a>
							
							</h2>
							

							</div>	
											
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Region Name</th>
                                            <th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if($region)
										{
											$counter=0;
											foreach($region as $row)
											{

												$id=$row['regionId'];

        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['name']; ?></td>
                                    
												
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/location/edit_region/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
											</td>
											<td class="center hidden-phone">
												<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/location/delete_region/<?php echo $id;?>" title="Delete" class="demo-basic"  onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash"></i></a>
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
