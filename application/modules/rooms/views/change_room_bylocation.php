		<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr><th >Name</th>
											<th >Business Center</th>
											<th >Location</th>
											<th >City</th>
											<th>Icon</th>
											
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
											<?php //print_r($result);
											if(!empty($result)){
		  	foreach($result as $row)
			{
		  ?>
										<tr class="gradeX" id="records_table">
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['businessName']; ?></td>
											<td><?php echo $row['l_name']; ?></td>
											<td><?php echo $row['c_name']; ?></td>
										
											<td><img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>"/></td>
											
											
										
											<td id="statusId<?php echo $row['id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeroomStatus('<?php echo $row['id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/rooms/<?php echo $edit;?>/<?php echo $row['id'];?>" ><i class="fa fa-pencil"></i></a>
														<!----	<a title="Add Image" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_images/<?php echo $row['classifiedId'];?>"><i class="fa fa-picture-o"></i></a>
															<a title="Add Video" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_video/<?php echo $row['classifiedId'];?>"><i class="fa fa-play"></i></a>--->
															<a href="<?php echo base_url();?>index.php/rooms/<?php echo $delete;?>/<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
														</td>
										</tr>
										<?php }}else{?>
											
											<tr class="gradex"><td colspan="6">No  rooms Available.....</td></tr>
											
							
											
											<?php }?>
										
									</tbody>
								</table>
