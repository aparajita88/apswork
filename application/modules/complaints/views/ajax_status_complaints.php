<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
										
											<th>Subject</th>
											<th>Message</th>
											
											<th>DateAdded</th>
											
                                            <th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									



								<?php //print_r($complaints);?>



																
								
								    <?php 
								    if(!empty($complaints)){			
								    
								    foreach($complaints as $complaint)
								    {
										?>
		                   <tr>
                        
                           <td>    <?php   echo $complaint['subject']; ?>         </td>
                           <td>    <?php   echo $complaint['message'];  ?>        </td>
             
 
 
 
                           <td>    <?php   echo $complaint['dateadded']; ?>       </td>
                     <td id=""  class="center hidden-phone">
												<a title="<?php if($complaint['status']==1){ echo 'closed'; } else{ echo 'open';} ?>" class="demo-basic"  >
												<?php if($complaint['status']==1){ echo 'closed'; } else{ echo 'open';} ?>
												</a>
											</td>
                           <td>
<?php if($this->session->userdata("userTypeId")<>"ut7"){?>							   
 <a onClick="return confirm('Are you sure?');" href="<?php echo site_url('index.php/complaints/delete_complaints') . '/' .
  $complaint['complain_id']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a><?php }else if($complaint['status']<>'1'){?>
	  <a onClick="return confirm('Are you sure to close this Complaints?');" href="<?php echo site_url('index.php/complaints/close_complaints') . '/' .
  $complaint['complain_id']; ?>" title="close"><i class="fa fa-times"></i>
</a> 
  <?php }?>&nbsp;&nbsp;&nbsp;
  <!---<a href="<?php echo base_url();?>index.php/complaints/view_complaints/<?php echo $complaint['complain_id'];?>">View</a>&nbsp;&nbsp;&nbsp;--->

  <!---<a href="<?php echo base_url();?>index.php/complaints/create/<?php echo $complaint['classifiedId'];?>/<?php echo $complaint['complain_id'];?>">Reply</a>&nbsp;&nbsp;&nbsp;--->

                           </td>
                           </tr>
                            
                           <?php }}else{?>
											
											<tr class="gradex"><td colspan="6">No complaints Available.....</td></tr>
											
							
											
											<?php }?>
                          		
				        </table>
								
