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
    
    <div class="ba_white">
    <section class="panel custom_boxes">
        			<div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel_active panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/i1.png"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $count_classified; ?></div>
                                            <div class="big">Office Space</div>
                                        </div>
                                    </div>
                                </div>
                               <a href="<?php echo base_url(); ?>index.php/vendor/office_list">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right fa_circle1"><i class="fa fa-angle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel  panel-primary panel_green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/i2.png"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $count_complaints;?></div>
                                            <div class="big">Complaints</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>index.php/complaints">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right fa_circle1"><i class="fa fa-angle-right fa-angle-right1 "></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                     </div>
    </section>
    
    <div class="clearfix"></div>
	
		<section class="panel custom_datatable">
							<header class="panel-heading panel_heading">
								<div class="panel-actions">
									<a href="<?php echo base_url(); ?>index.php/vendor/office_list" class="panel-action pull-right pull_right" > Show All</a>
									 
								</div>
						
								<h2 class="panel-title">Latest Office Space</h2>
							</header>
							<div class="panel-body panel_body2">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th width="15.2%">Name</th>
											<th width="15.2%">Icon</th>
											<th width="15.2%">Address</th>
											<th width="15.2%">Description</th>
											<th width="15.2%">Date Added</th>
                                           
                                            <th width="8%">Status</th>
                                            <th width="8%">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($classified)){
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
                                          	<td><?php echo $row['dateAdded']; ?></td>
                                           <?php if($row['status']=='1'){?>
                                           <td style="text-align:center">
                                            <a class="on-default edit-row" href="#">
                                            	<i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/ac1.png"></i>
                                            </a> 
                                            </td>
                                           <?php }else{?>
											    <td style="text-align:center">
                                            <a class="on-default edit-row" href="#">
                                            	<i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/ac2.png"></i>
                                            </a> 
                                            </td>
                                            <?php }?>
                                            <td style="text-align:center"> 
                                            	<a class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/edit_classified/<?php echo $row['classifiedId'];?>">
                                                <i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/ac6.png"></i>
                                                </a>
                                            	<a class="on-default edit-row" href="<?php echo base_url();?>index.php/vendor/delete_classified/<?php echo $row['classifiedId'];?>"onclick="return confirm('Are you sure you want to delete')">
                                                <i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/ac3.png"></i>
                                                </a>
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
    </div>        
            
            <style>
			.ba_white {background: #fff none repeat scroll 0 0; padding: 30px 30px 0;}
			.custom_datatable .panel_body2 {  box-shadow: 0 0 2px 2px #eeeeee;}
			.panel_heading { background:#347ab8;}
			.panel_heading h2 { color:#fff;}
			.pull_right { float:right;}
			.pull_right { width: 57px !important; color:#fff !important;}
			.pull_right:hover { background:none !important; color:#fff !important; } 
			.custom_datatable .datatables-header, .custom_datatable .datatables-footer  { display:none !important;}
			.custom_datatable i.fa  { font-size:16px !important;}
			.custom_datatable table { border:0 !important;}
			.custom_datatable table th { border-left:0 !important;}
			.custom_datatable table th:last-child { border-right:0 !important;}
			.custom_datatable table tr:last-child td { border-bottom:0 !important;}
			.custom_datatable table tr td:last-child  { border-right:0 !important;}
			
			.custom_boxes .huge { font-size:32px;}
			.custom_boxes .big {font-size: 20px;  margin-top: 10px;}
			.custom_boxes  .panel-footer {
					 	 background: #fff none repeat scroll 0 0;
						color: #000 !important;
						font-size: 14px;
						margin-top: 0 !important;
						padding: 15px !important;
						text-transform: uppercase;}
						
		.custom_boxes .fa-angle-right {   background: #0088cc none repeat scroll 0 0;
			border-radius: 50%;
			color: #fff;
			height: 17px;
			line-height: 16px;
			text-align: center;
			width: 17px;
			}
		.custom_boxes .fa-angle-right1 { background-color: #5cb85c !important;}	
		
		.custom_boxes .panel_active {
			box-shadow: 0 0 5px 2px #ccc;
		}
		.custom_boxes .panel-primary   { border:1px solid #0088CC;}
		.custom_boxes .panel_green .panel-heading {  border-color: #5cb85c !important; background-color: #5cb85c !important;}
		 .custom_boxes .panel_green {border:1px solid #5cb85c !important;}
			</style>
			


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
