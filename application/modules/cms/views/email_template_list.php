<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			<!--<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>-->
			</ol>
</div>
			<!--<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
		
	</header>

					
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body">
								<h2 class="panel-title">Email Templates<a href="<?php echo $this->config->item('base_url');?>index.php/cms/add_email_template" class="panel-action pull-right" title="Add Templates"><i class="fa fa-plus"></i></a></h2>
							</div>
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Title</th>
                                            <th>Template</th>
                                            <th>Created</th>
											
											<th class="hidden-phone">Actions</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
										if($templates)
											//print_r($templates);
										{
											$counter=0;
											foreach($templates as $row)
											{

												$id=$row['emailId'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['title']; ?></td>
                                    <td><?php echo strip_tags($row['description']); ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($row['dateAdded'])); ?></td>        
												
											<td class="actions">
												<a title="Edit" class="demo-basic" href="<?php echo $this->config->item('base_url');?>index.php/cms/edit_email_template/<?php echo $id;?>"><i class="fa fa-edit"></i></a>
												
												<a href="javascript:void(0)" data-toggle="modal" data-target="#contactModal" onclick="templateview('<?php echo $id;?>')" title="View"><font color="blue"></font><i class="fa fa-external-link" style="font-size:18px;"></font></i>
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
			
	
			
			
		</section>
		 <div id="contactModal" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog">
                   
                </div>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function change_page_category_status(id,status)
{
	//alert(js_site_url);
	//alert(status);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/cms/chengestatus", 
      data: { _id:id, _status:status }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}

function templateview(template_id){
		
		$.ajax({
  url: '<?php echo base_url();?>index.php/cms/templateview', 
  type: 'post', 
  data:"template_id="+template_id,
  
success: function(result) {
	
    $("#contactModal").html(result);
    }
});
	}



</script>
