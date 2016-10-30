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
                                            <div class="huge"><?php echo $count_pages; ?></div>
                                            <div class="big">Pages</div>
                                        </div>
                                    </div>
                                </div>
                               <a href="<?php echo base_url(); ?>index.php/cms/list_page">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right fa_circle1"><i class="fa fa-angle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!----<div class="col-lg-3 col-md-6">
                            <div class="panel  panel-primary panel_green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i><img alt="" src="<?php echo $this->config->item('base_url');?>application/modules/vendor/views/img/i2.png"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $count_cities;?></div>
                                            <div class="big">Cities</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo base_url(); ?>index.php/location/city_list">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right fa_circle1"><i class="fa fa-angle-right fa-angle-right1 "></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                     </div>--->
    </section>
    
    <div class="clearfix"></div>
	
		<section class="panel custom_datatable">
							<header class="panel-heading panel_heading">
								<div class="panel-actions">
									<a href="<?php echo base_url(); ?>index.php/cms/list_page" class="panel-action pull-right pull_right" > Show All</a>
									 
								</div>
						
								<h2 class="panel-title">Latest Pages</h2>
							</header>
							<div class="panel-body panel_body2">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th width="15.2%">Title</th>
											<th width="15.2%">Category Name</th>
											<th width="15.2%">Sub Category Name</th>
											<th width="15.2%">Featured Image</th>
											<th width="15.2%">content</th>
											<th width="15.2%">Created</th>
										    <th class="hidden-phone">Status</th>
											<th class="hidden-phone">Edit</th>
											<th class="hidden-phone">Delete</th>
											
                                           
                                          
										</tr>
									</thead>
									<tbody>
								<?php
									//'<pre>';
									//print_r($pages);
									//'</pre>';
										if($pg)
										{
											$counter=0;
											foreach($pg as $row)
											{

												$id=$row['pageId'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
                                    <td><?php echo $row['title']; ?></td>
									<td><?php echo $row['pageCategoryName']; ?></td>
									<td>
									<?php if($row['subpage_categoryid']=="0"){  ?>
									No Subcategory Of this page
									<?php }else {
									$subcatname=$this->cms_model->getsubcatname($row['subpage_categoryid']);
									//print_r($subcatname);
								    $name=$subcatname[0]['pageCategoryName'];	
								    echo $name;
									} ?>
										</td>
                                    <td>
                                    	<?php if($row['image'] == '' ) {
											echo 'No image available';
										} else {
											echo '<img 
												src="'.$this->config->item('base_url').'assets/uploads/cms/thumbs/'.$row['image'].'" >';
										} ?>
                                    </td>
                                    <td><?php echo substr(strip_tags($row['content']),0,200).'......'; ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['dateAdded'])); ?></td>        
												<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="change_page_status('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>
											<td class="center hidden-phone">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/cms/edit_page/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
											</td>
											<td class="center hidden-phone">
												<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/cms/delete_page/<?php echo $id;?>" title="Delete" class="demo-basic"  onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash"></i></a>
											</td>
								  </tr>									
									  										
        							<?php
											}
										}
									?>						
										
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
