						
						<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Client</th>
                                          <th>City</th>
                                          <th>Location</th>
                                          <th>Name</th>
                                          <th>Purpose</th>
                                          <th>Booking Datails</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<tbody>
									<?php
									    
										if($booking_data)
										{
											$counter=0;
											foreach($booking_data as $row)
											{

												$id=$row['id'];
												$booking_info=json_decode($row['booking_details']);
												$bkinfstr="";
												foreach($booking_info as $key=>$val){
													$bkinfstr.=date('d/m/Y',strtotime($key))."(".implode(',',$val).")".'</br>';
													
												}
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['FirstName']." ".$row['LastName']." (".$row['company_name'].")"; ?></td>
                                    <td><?php echo $row['cites']; ?></td>
                                    <td><?php echo $row['location']?></td>
                                    <td><?php echo $row['conference_room']; ?></td>
                                      <td><?php echo $row['purpose']; ?></td>
                                    <td><?php echo $bkinfstr; ?></td>
                                    <td><?php if($row['is_approved']=="1"){?>
											<strong><font color="green">Booked</font></strong>
                                        <?php }else if($row['is_approved']=="2"){?>
											<strong><font color="red">Rejected</font></strong>
											<?php }else{?>
												<strong><font color="blue">Waiting for Approval</font></strong>
												<?php }?>
												</td>
												
                                  <td class="center hidden-phone">
										<?php if($row['is_approved']=="0" && $this->session->userdata("userTypeId")=='ut7'){?>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="appbooking('<?php echo $id;?>',$('#book_type').val())" title="Approve"><font color="green"><i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</a>&nbsp;
										<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="appbookreject('<?php echo $id;?>',$('#book_type').val())" title="Reject"><font color="red"><i class="fa fa-times" style="font-size:18px;"></i></font>
</a>
										<?php }else{?>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="appbookview('<?php echo $id;?>',$('#book_type').val())" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
</a>
											<?php }?>
											</td>
								  </tr>								
									  										
        							<?php
											
										}
									}else{
									?>
									<tr><td colspan="10"><strong>No Data Available</strong></td></tr>	
									<?php }?>
						</tbody>											
								
		<script src="<?php echo $this->config->item('base_url');?>/html/admin1/assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="<?php echo $this->config->item('base_url');?>/html/admin1/assets/javascripts/tables/examples.datatables.tabletools.js"></script>
