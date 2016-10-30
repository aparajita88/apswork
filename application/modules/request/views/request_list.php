<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
			
		
	</header>

					
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body">
									
							<h2 class="panel-title">Request List</h2>		
						
								
							</div>
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Name</th>
											<th>Hourly Price</th>
											<th>Day Price</th>
											
											
											
										
											<th style="width: 108px !important;">Actions</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
										if($query)
										{
											//print_r($query);
											$counter=0;
											foreach($query as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['name']; ?></td>
                                  
                                     	<td><?php echo $row['hourly_price']; ?></td>  
                                     	
                                     	<td><?php echo $row['day_price']; ?></td>  
                                     		
												
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/request/edit_request/<?php echo $id;?>" ><i class="fa fa-pencil"></i></a>													
															
											</td>
								  </tr>									
									  										
        							<?php
											}
										}
																		
									else{?>
											
											<tr class="gradex"><td colspan="8">No Vendor user  Available.....</td></tr>
											
							
											
									<?php
									}?>
										
										
									</tbody>
								</table>
							</div>
						</section>
					
					
				</section>
			
	
			
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function changeuserStatus(id,status)
{
	//alert(js_site_url);
	//alert(id);
	var table='vendor';
	var pid='id';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/users/changeuserStatus", 
      data: { _id:id, _status:status,_table:table,_pid:pid,}, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}

</script>
