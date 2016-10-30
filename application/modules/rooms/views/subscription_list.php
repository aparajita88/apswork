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
							<div class="panel-body"><h2 class="panel-title">SUBSCRIPTIONS
									<a href="<?php echo $this->config->item('base_url');?>index.php/rooms/add_subscription_type" class="panel-action pull-right" title="Add Subscription"><i class="fa fa-plus"></i></a></h2></div>					
							<div class="panel-body panel_body_top"><div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>
											
											<th >Price</th>
										  
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
								<?php
								//print_r($business);
									if(!empty($subscription))
									{
									
									foreach($subscription as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['price']; ?></td>
											
												
											
										
											
											<td id="statusId<?php echo $row['Id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changesubscriptionStatus('<?php echo $row['Id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/rooms/edit_subscription_type/<?php echo base64_encode(base64_encode($row['Id']));?>" ><i class="fa fa-pencil"></i></a>													
															
											</td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="6">No Subscription types  Available.....</td></tr>
											
							
											
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

<script>

function changesubscriptionStatus(id,status)
{
	//alert(id);
	//alert(js_site_url);
	var table='subscription';
	var pid='Id';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/changesubscriptionStatus", 
      data: { _id:id, _status:status,_table:table,_pid:pid,}, 
      async: false, 
      success: function(data) { 
	  //alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}


</script>
