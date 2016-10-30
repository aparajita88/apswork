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
				<li><span></span></li>--->
			</ol>
</div>
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
	<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
		<section class="panel">
			<div class="panel-body">
			<h2 class="panel-title">Conference Rooms</h2>
			</div>
							<header class="panel-heading">
								<select class="design_select" name="city" id="city"  onchange="get_location(this.value)" >
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
											
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select  class="design_select" name="location" id="location" onchange="get_business(this.value)">
                                    	<option value="0">Select Location</option>
                                      
                                    </select>
                                    <select  class="design_select" name="business" id="business" onchange="change_room_bybusiness(this.value)" >
                                    	<option value="0">Select Business</option>
                                    
                                    </select>
								<div class="panel-actions">
									<a href="<?php echo $this->config->item('base_url');?>index.php/rooms/add_conference" class="panel-action" title="Add Conference"><i class="fa fa-plus"></i></a>
									<!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
								</div>
								<!---<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>--->
						
								<h2 class="panel-title"></h2>
							</header>
							<div class="panel-body">
								<?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
		<div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
								
										<tr>
											<th >Name</th>
											<th >Business Center</th>
											<th >Location</th>
											<th >City</th>
											<th>Icon</th>
											
											<th class="hidden-phone">Status</th>
										    <th style="width: 108px !important;">Actions</th>
										</tr>
									</thead>
									<tbody>
											<?php //print_r($confrence_rooms);
											if(!empty($confrence_rooms)){
		  	foreach($confrence_rooms as $row)
			{
		  ?>
										<tr class="gradeX" id="records_table">
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['businessName']; ?></td>
											<td><?php echo $row['l_name']; ?></td>
											<td><?php echo $row['c_name']; ?></td>
										
											<td><img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>"/></td>
											
											
										
								
											<td id="statusId<?php echo $row['conference_id']; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeroomStatus('<?php echo $row['conference_id']; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="actions">
															<a href="<?php echo base_url();?>index.php/rooms/edit_conference_room/<?php echo $row['conference_id'];?>" ><i class="fa fa-pencil"></i></a>
														<!----	<a title="Add Image" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_images/<?php echo $row['classifiedId'];?>"><i class="fa fa-picture-o"></i></a>
															<a title="Add Video" style="margin-left: 4px;" class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/add_classified_video/<?php echo $row['classifiedId'];?>"><i class="fa fa-play"></i></a>--->
															<a href="<?php echo base_url();?>index.php/rooms/delete_conference_room/<?php echo $row['conference_id'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i></a>
														</td>
										</tr>
										<?php }}else{?>
											
											<tr class="gradex"><td colspan="6">No conference rooms Available.....</td></tr>
											
							
											
											<?php }?>
										
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
function changeroomStatus(id,status)
{
	//alert(id);
	//alert(js_site_url);
	var table='conference_room';
	var pid='conference_id';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/changeroomStatus", 
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
function get_business(value)
{
	//alert(js_site_url);
	//alert(value);
var city = $("#city").val();
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getBusinessByLocation", 
      data: { id:value,city:city, }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#business").html(data.trim()); 
      } 
    });
}
function change_room_bybusiness(value)
{
	//alert(js_site_url);
	//alert(value);
	var roomtype='conference';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/change_room_bybusiness", 
      data: { id:value,roomtype:roomtype, }, 
      async: false,      
	  success: function (response)
	  {		
		//  alert(response);	
        $("#table_result_ajax").html("");
        $("#table_result_ajax").html(response);         
      } 
    });
}

</script>
