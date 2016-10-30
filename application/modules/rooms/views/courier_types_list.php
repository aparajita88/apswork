<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header"><?php //print_r($userData); ?>
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
						<?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">COURIER TYPE LIST
									<a href="<?php echo $this->config->item('base_url');?>index.php/rooms/add_courier_types" class="panel-action pull-right" title="Add courier types"><i class="fa fa-plus"></i></a></h2></div>					
							<div class="panel-body panel_body_top"><div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>
											
										<!---	<th>Added By</th>--->
										  
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
								<?php
								//print_r($business);
									if(!empty($courier_types))
									{
									
									foreach($courier_types as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['name']; ?></td>
											
											<!---<td class="center hidden-phone"><?php echo $row['userEmail']; ?></td>--->		
											
										
											
											<td id="statusId<?php echo $row['id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changecouriertypeStatus('<?php echo $row['id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/rooms/edit_courier_types/<?php echo $row['id'];?>" ><i class="fa fa-pencil"></i></a>													
															<a href="<?php echo base_url();?>index.php/rooms/delete_courier_types/<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="6">No courier types  Available.....</td></tr>
											
							
											
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

function changecouriertypeStatus(id,status)
{
	//alert(id);
	//alert(js_site_url);
	var table='game_types';
	var pid='id';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/changegametypeStatus", 
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
