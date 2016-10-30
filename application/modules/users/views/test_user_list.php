<?php $this->load->view('header'); ?>
			<div class="inner-wrapper">
				<?php $this->load->view('left'); ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Users</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>index.php/users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Users</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					
					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="<?php echo $this->config->item('base_url');?>index.php/users/admin/addUser" class="panel-action" title="Add User"><i class="fa fa-plus"></i></a>
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								</div>
						
								<h2 class="panel-title">Users</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="<?php echo $this->config->item('base_url');?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<!--<th>Name</th>-->
											<th>Email</th>
											<th>Phone</th>
											
											<th>User Type</th>
											<th class="hidden-phone">Status</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if($query)
										{
											foreach($query as $row)
											{
												$id=$row['userId'];
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
											<!--<td><?php echo $row['profileName']; ?></td>-->
											<td><?php echo $row['userEmail']; ?></td>
											<?php /*<td><?php if(!empty($row['address1'])){ echo $row['address1']; }else{ echo 'N/A'; } ?></td>*/ ?>
											<td><?php if(!empty($row['phone'])){ echo $row['phone'];  }else{ echo 'N/A'; } ?></td>
											<td>
												<?php
            									$uTypeName = $this->user->uTypeName($row['userTypeId']);
            									if(!empty($uTypeName)){
            										echo $uTypeName[0]['userTypeName'];
            									}
            								?>
											</td>
								
									
											<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeStatusNUser('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/users/admin/editUser/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
											</td>
											<td class="center hidden-phone">
												<a href="javascript:void(0)" title="Delete" class="demo-basic"  onclick="deletenewUser('<?php echo $id;?>');"><i class="fa fa-trash"></i></a>
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
			</div>
	
				<?php $this->load->view('right'); ?>
			
		</section>
		
<?php $this->load->view('footer'); ?>