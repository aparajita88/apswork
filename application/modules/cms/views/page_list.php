<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
			<section role="main" class="content-body">
					<header class="page-header">
						<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
						<div class="right-wrapper pull-right">
							<!--<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>index.php/users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Page Management</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
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
								<h2 class="panel-title">Page List<a href="<?php echo $this->config->item('base_url');?>index.php/cms/add_page" class="panel-action pull-right" title="Add Feature"><i class="fa fa-plus"></i></a></h2>
							</div>
							<div class="panel-body panel_body_top">
								<!--<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="<?php echo $this->config->item('base_url');?>assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">-->
                               <!--- <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" >----->
										<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
                                            <th>Title</th>
											<th>Category Name</th>
											<th>Sub Category Name</th>
                                            <th>Featured Image</th>
                                            <th>content</th>
                                            <th>Created</th>
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
										if($pages)
										{
											$counter=0;
											foreach($pages as $row)
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
					
					
				</section>
		
				<?php //$this->load->view('right'); ?>
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script>
function change_page_status(id,status)
{
	//alert(id);
	//alert(js_site_url);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/cms/chengepagestatus", 
      data: { _id:id, _status:status }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}
</script>
