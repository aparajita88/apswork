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

			<h2 class="panel-title">Virtual office List:  <?php echo $business_name[0]['businessName']?><a href="<?php echo $this->config->item('base_url');?>index.php/business/add_virtual_attributes/<?php echo $business_name[0]['business_id'];?>" class="panel-action pull-right" title="Add Virtual Offices"><i class="fa fa-plus"></i></a></h2>
			</div>
			<br>
														
						<div class="panel-body">
								<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?>
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
											<th>Details</th>
											<th>Price</th>
											<th>Onetime Price</th>
											
											
											
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
								<?php
								//print_r($business);
									if(!empty($office))
									{
									
									foreach($office as $row)
									{
								     ?>
										<tr class="gradeX">
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['details']; ?></td>
											<td><?php echo $row['price']; ?></td>
											<td><?php echo $row['onetime_price']; ?></td>	
										
											
											
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/business/edit_virtual_office/<?php echo $row['id'];?>" ><i class="fa fa-pencil"></i></a>	
															
											</td>
										</tr>
									<?php
									}
								}
								else{?>
											
											<tr class="gradex"><td colspan="6">No Virtual Offices  Available.....</td></tr>
											
							
											
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
