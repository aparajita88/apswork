<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header"><?php //print_r($userData); ?>
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
			
		
	</header>
	
			
					<section class="panel">
						<?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">CREDIT NOTE APPROVAL LIMIT
									</h2></div>					
							<div class="panel-body panel_body_top"><div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >USER TYPE</th>
											<th >LIMIT AMOUNT (INR)</th>
											<th >LIMIT %</th>
										    <th style="width: 108px !important;">Action</th>
										</tr>
									</thead>
									<tbody>
								<?php
								//print_r($business);
									if(!empty($staff_credit))
									{
									
									foreach($staff_credit as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['userTypeName']; ?></td>
											<td><?php echo $row['amount_creditnote']; ?></td>
											<td><?php echo $row['percentage_creditnote']; ?></td>
												
											
										
											
											
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/users/creditnote_edit_staff/<?php echo $row['userTypeId'];?>" ><i class="fa fa-pencil"></i></a>													
															
											</td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="6">No Creditnote is Available.....</td></tr>
											
							
											
									<?php
									}?>
										
									</tbody>
								</table>
								</div>
							</div>
						</section>
				
			<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>


