<?php 
									if(!empty($legal_support))
										{
											$counter=0;?>
<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Client</th>
                                          <th>City</th>
                                          <th>Location</th>
                                          <th>Description</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Request Type</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<tbody>
									<?php									
											foreach($legal_support as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['cites']; ?></td>
                                    <td><?php echo $row['location']?></td>
                                    <td><?php echo((strlen($row['description'])>50)?substr($row['description'],0,48)."..":$row['description']); ?></td>
                                      <td><?php if($row['start_date']<>'0000-00-00'){echo date('d/m/Y',strtotime($row['start_date']));} ?></td>
                                    <td><?php if($row['end_date']<>'0000-00-00'){echo date('d/m/Y',strtotime($row['end_date'])); }?></td>
                                    <td><?php echo $row['stuff_type']; ?></td>
                                    <td><?php if($row['IsApproved']=="1"){?>
											<strong><font color="green">CLOSED</font></strong>
                                        <?php }else{?>
												<strong><font color="blue">OPEN</font></strong>
												<?php }?>
												</td>
												
                                    <td class="center hidden-phone">
										<?php if($row['IsApproved']=="0" && $this->session->userdata("userTypeId")=='ut7'){?>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequest('<?php echo $id;?>','request_stuff_service')" title="CLOSED"><font color="green"><i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</a>&nbsp;
										
</a>-->
										<?php }else{?>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequestview('<?php echo $id;?>','request_stuff_service')" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
</a>
											<?php }?>
											</td>
								  </tr>								
									  										
        							<?php
											}?>
									
																	
									</tbody>
								</table>
								<?php }?>
								<?php
									
										if(!empty($courier_support))
										{
											$counter=0;?>
																<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Client</th>
                                          <th>City</th>
                                          <th>Location</th>
                                          <th>Description</th>
                                          <th>Destination</th>
                                          <th>Request Type</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                         
										</tr>
									</thead>
									<tbody>
										
									<?php foreach($courier_support as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['cites']; ?></td>
                                    <td><?php echo $row['location']?></td>
                                    <td><?php echo((strlen($row['package_description'])>50)?substr($row['package_description'],0,48)."..":$row['package_description']); ?></td>
                                      <td><?php echo $row['destination']; ?></td>
                                    <td><?php echo $row['courier']; ?></td>
                                    <td><?php if($row['IsApproved']=="1"){?>
											<strong><font color="green">Approved</font></strong>
                                        <?php }else if($row['IsApproved']=="2"){?>
											<strong><font color="red">Rejected</font></strong>
											<?php }else{?>
												<strong><font color="blue">Waiting for Approval</font></strong>
												<?php }?>
												</td>
												
                                    <td class="center hidden-phone">
										<?php if($row['IsApproved']=="0"){?>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequest('<?php echo $id;?>','request_courier_service')" title="Approve"><font color="green"><i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</a>&nbsp;
										<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" onclick="appreject('<?php echo $id;?>','request_courier_service')" title="Reject"><font color="red"><i class="fa fa-times" style="font-size:18px;"></i></font>
</a>
										<?php }else{?>
											<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="apprequestview('<?php echo $id;?>','request_courier_service')" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
</a>
											<?php }?>
											</td>
								  </tr>								
									  										
        							<?php
										
										}
									?>	
																	
									</tbody>
								</table>
<?php }?>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
