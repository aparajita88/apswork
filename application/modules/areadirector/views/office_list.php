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
							<header class="panel-heading">
								<!---<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>--->
						
								<h2 class="panel-title">OFFICE SPACES</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>
											<th>Icon</th>
											<th>Address</th>
											<th class="hidden-phone">Description</th>
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
											<?php //print_r($classified);
											if(!empty($classified)){
		  	foreach($classified as $row)
			{
		  ?>
										<tr class="gradeX">
											<td><?php echo $row['classifiedName']; ?></td>
											<?php if($row['s_deleted']==0 && $row['primaryImage']==1 ){ ?>
											<td><img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>"/></td>
											<?php }else{?>
												<td><img src="<?php echo base_url();?>assets/front/images/noimages.jpg"/></td>
												<?php }?>
											<td><?php echo $row['address']; ?></td>
										
											  <td class="center hidden-phone"><?php echo substr(strip_tags($row['longDescription']),0,200).'......'; ?></td>
											<td id="statusId<?php echo $row['classifiedId']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeClassifiedStatus('<?php echo $row['classifiedId']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/vendor/edit_classified/<?php echo $row['classifiedId'];?>" ><i class="fa fa-pencil"></i></a>
															<a title="Add Image" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_images/<?php echo $row['classifiedId'];?>"><i class="fa fa-picture-o"></i></a>
															<a title="Add Video" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_video/<?php echo $row['classifiedId'];?>"><i class="fa fa-play"></i></a>
															<a href="<?php echo base_url();?>index.php/vendor/delete_classified/<?php echo $row['classifiedId'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
														</td>
										</tr>
										<?php }}else{?>
											
											<tr class="gradex"><td colspan="6">No Office Available.....</td></tr>
											
							
											
											<?php }?>
										
									</tbody>
								</table>
							</div>
						</section>
				
			<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>

<script>
function changeClassifiedStatus(id,val)
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



</script>
