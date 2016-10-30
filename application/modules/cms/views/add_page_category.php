<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
			
		<section role="main" class="content-body">
					<header class="page-header">
						<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Page Categories</span></li>
								
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<section class="panel">
						<div class="panel-body">
							<!-- <div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							</div> -->
						
							<h2 class="panel-title">Add New Page Categories</h2>
							
						</div>
						
					<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/cms/add_category">
							<fieldset>
                                	
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Category Name *</label>
									<div class="col-md-8">
									<input type="text" name="attiributespeName" id="attiributespeName"
										   class="form-control" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Category Description</label>
									<div class="col-md-8">
										<textarea cols="180" rows="100" id="desc" name="desc" class=""></textarea>
										<script type="text/javascript">
											CKEDITOR.replace( 'desc' );
										</script>
									</div>
								</div>
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Submit</button>
								</div>
							</div>
							</div>
							</form>
				</section>
			
	
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 

<script>
	$(document).ready(function(e){
		$("#submit").click(function(e){
			var _title = $("#attiributespeName").val();
			var _desc = $("#desc").val();
			//alert(_desc);
			if (_title == "") {
				$("#attiributespeName").attr('placeholder','Please enter category name');
				$("#attiributespeName").css("border-color","red");
				$("#attiributespeName").focus();
				e.preventDefault();
			}
		});
	});
</script>
