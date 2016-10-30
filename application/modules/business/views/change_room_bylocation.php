		<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>											
											<th >Location</th>
											<th >City</th>
											<th>Address</th>
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
											<td><?php echo $row['businessName']; ?></td>
											
											<td><?php echo $row['c_name']; ?></td>
										    <td><?php echo $row['l_name']; ?></td>
										    <td class="center hidden-phone"><?php echo $row['address']; ?></td>		
											<td><img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>"/></td>
											
											
										
										
											<td id="statusId<?php echo $row['business_id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeBusinessStatus('<?php echo $row['business_id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/business/edit_business/<?php echo $row['business_id'];?>" ><i class="fa fa-pencil"></i></a>
														<!----	<a title="Add Image" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_images/<?php echo $row['classifiedId'];?>"><i class="fa fa-picture-o"></i></a>
															<a title="Add Video" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_video/<?php echo $row['classifiedId'];?>"><i class="fa fa-play"></i></a>--->
															<a href="<?php echo base_url();?>index.php/business/delete_business/<?php echo $row['business_id'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
														</td>
										</tr>
										<?php }}else{?>
											
											<tr class="gradex"><td colspan="7">No  Business Centers Available.....</td></tr>
											
							
											
											<?php }?>
										
									</tbody>
								</table>
