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
							<div class="panel-body"><h2 class="panel-title">Visitor List
							
							<a href="<?php echo $this->config->item('base_url');?>index.php/receptionist/add_visitor" class="panel-action pull-right" title="Add Location"><i class="fa fa-plus"  ></i></a>
							
							</h2>
							

							</div>	
											
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Visitor Name</th>
                                          <th>Phone</th>
                                          <th>Address</th>
                                          <th>In Time</th>
                                          <th>Out Time</th>
                                          <th>Contact Name</th>
                                           <th>Client Name</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php
									//print_r($location);
										if($visitor_list)
										{
											$counter=0;
											foreach($visitor_list as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo ((strlen($row['address'])<=100)?$row['address']:substr($row['address'],0,100)."..."); ?></td>
                                    <td><?php echo $row['in_time']; ?></td>
                                    <td><?php echo $row['out_time']; ?></td>
									<td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>	
									<td><?php echo $row['company_name']; ?></td>			
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/receptionist/edit_visitor/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
											</td>
											<td class="center hidden-phone">
												<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/receptionist/delete_visitor/<?php echo $id;?>" title="Delete" class="demo-basic"  onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash"></i></a>
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

