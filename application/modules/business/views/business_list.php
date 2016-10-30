<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header"><?php //print_r($userData); ?>
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			
	</header>
	<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
		<section class="panel">
			<div class="panel-body">
			<h2 class="panel-title">Business Centers</h2>
			</div>
			<br>
							<header class="panel-heading">
								<select class="design_select" name="city" id="city"  onchange="get_location(this.value)" >
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
											
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select  class="design_select" name="location" id="location" onchange="change_room_bylocation(this.value)">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($city as $key=>$value) {
											
											
												echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
											
										} ?>
                                    </select>
		
								
	<div class="panel-actions">
									<a href="<?php echo $this->config->item('base_url');?>index.php/business/add_business" class="panel-action" title="Add Business Centers"><i class="fa fa-plus"></i></a>
									<!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
								</div>
						
							</header>							
						<div class="panel-body">
								<?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?>
						</div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?>
						</div>
			<?php } ?><div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>
											<th>City</th>
											<th>Location</th>
											<th>Address</th>
										    <th>Icon</th>
											
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
								<?php
								//print_r($business);
									if(!empty($business))
									{
									
									foreach($business as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['businessName']; ?></td>
											<td><?php echo $row['c_name']; ?></td>
											<td><?php echo $row['l_name']; ?></td>	
											<td class="center hidden-phone"><?php echo $row['address']; ?></td>		
											<?php if($row['s_deleted']==0 && $row['primaryImage']==1 ){ ?>
											<td><img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>"/></td>
											<?php }else{?>
												<td><img src="<?php echo base_url();?>assets/front/images/noimages.jpg"/></td>
												<?php }?>
											
										
											
											<td id="statusId<?php echo $row['business_id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeBusinessStatus('<?php echo $row['business_id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/business/edit_business/<?php echo $row['business_id'];?>" ><i class="fa fa-pencil"></i></a>	
															<a href="<?php echo $this->config->item('base_url');?>index.php/business/add_business_attributes/<?php echo $row['business_id'];?>" class="panel-action" title="Add Business Attributes"><i class="fa fa-plus"></i></a>
															<a href="<?php echo $this->config->item('base_url');?>index.php/business/virtual_attributes_list/<?php echo $row['business_id'];?>" class="panel-action" title="Add Virtual Attributes"><i class="fa fa-hand-o-right"></i></a>
														    <a title="Add Image" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/business/add_business_images/<?php echo $row['business_id'];?>"><i class="fa fa-picture-o"></i></a>
															<a title="Add Video" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/business/add_business_video/<?php echo $row['business_id'];?>"><i class="fa fa-play"></i></a>												
															<a href="<?php echo base_url();?>index.php/business/delete_business/<?php echo $row['business_id'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="6">No Business centers  Available.....</td></tr>
											
							
											
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
/*function changeBusinessStatus(id,val)
{
	var confm=confirm("Are you sure ?");
	if(confm==true)
	{
	//alert(val);
	$.ajaxSetup ({cache: false});
	var loadUrl = js_site_url+"index.php/vendor/statusChangeClassified/"+id+"/"+val;
	//var formdata = $("#addCoursesFrm").serialize();
	//alert(loadUrl);
	$.ajax({
		type: "POST",
		url: loadUrl,
		dataType:"html",
		//data:formdata,
		success:function(responseText)
		{
			//alert(responseText);
			//$("#addCoursesFrm").submit();
			//window.location.href=js_site_url+"courses/coursesList";
			if(responseText=='1'){
			document.getElementById('statusId'+id).innerHTML='Active';
			location.reload();	
			}else{
				
			document.getElementById('statusId'+id).innerHTML='inactive';
			location.reload();	
			}			
			

		},
		error: function(jqXHR, exception) {
	   		return false;
	 }
	});
	//return false;
	}
	else
	{
	return false;
	}
	
}
*/

function changeBusinessStatus(id,status)
{
	//alert(id);
	//alert(js_site_url);
	var table='business_centers';
	var pid='business_id';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/business/changeBusinessStatus", 
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
	//alert(js_site_url);
	//alert(value);

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
	//alert(js_site_url);
	//alert(value);
	
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/business/change_business_bylocation", 
      data: { id:value, }, 
      async: false,      
	  success: function (response)
	  {		//alert(response);	
        $("#table_result_ajax").html("");
        $("#table_result_ajax").html(response);         
      } 
    });
}

</script>
