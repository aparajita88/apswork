<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
		
</div>
		
	</header>
	
			
					<section class="panel">
						<?php if($this->session->flashdata('edit') || $this->session->flashdata('edit1')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit1'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">CAFE TYPE LIST
									<a href="<?php echo $this->config->item('base_url');?>index.php/rooms/add_cafe_types" class="panel-action pull-right" title="Add cafe type"><i class="fa fa-plus"></i></a></h2></div>					
							<div class="panel-body panel_body_top"><div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>
											<th >Type</th>
											<th >Image</th>
											<!---<th>Added By</th>-->
										  
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
								<?php
								//print_r($business);
									if(!empty($cafe_types))
									{
									
									foreach($cafe_types as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['name']; ?></td>
											<?php if($row['parent']!=''){?>
											<td><?php echo $row['parent']; ?></td>
											<?php }else{?>
											<td>------------</td>
											<?php }?>
											<?php if($row['image']!=''){?>
											<td><img src="<?php echo base_url();?>assets/uploads/images/cafe_image/<?php echo $row['image'];?>" width="100" height="100" alt="cafe_image"/></td>
											<?php }else{?>
											<td>------------</td>
											<?php }?>
											
											
										
											
											<td id="statusId<?php echo $row['id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changecafetypeStatus('<?php echo $row['id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/rooms/edit_cafe_types/<?php echo $row['id'];?>" ><i class="fa fa-pencil"></i></a>													
															<a href="<?php echo base_url();?>index.php/rooms/delete_cafe_types/<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="6">No Cafe types  Available.....</td></tr>
											
							
											
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

<?php if($this->session->flashdata('edit')){$this->session->set_flashdata('edit1',$this->session->flashdata('edit')) ?>
	window.location.reload();
	<?php }?>
function changecafetypeStatus(id,status)
{
	
	var table='cafe_types';
	var pid='id';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/changecafetypeStatus", 
      data: { _id:id, _status:status,_table:table,_pid:pid,}, 
      async: false, 
      success: function(data) { 
	  //alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}
function get_location(value)
{
	

	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getlocationbycity", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#location").html(data.trim()); 
      } 
    });
}

function change_room_bylocation(value)
{
	
	
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/business/change_business_bylocation", 
      data: { id:value, }, 
      async: false,      
	  success: function (response)
	  {		
        $("#table_result_ajax").html("");
        $("#table_result_ajax").html(response);         
      } 
    });
}

</script>
 