<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
			<section role="main" class="content-body">
					<header class="page-header">
							<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
						
						
					</header>

					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
						<div class="panel-body">
							<!-- <div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							</div> -->
						

							<h2 class="panel-title">Edit User Information</h2>
					

							
						</div>
						
					<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post" action="<?php echo $this->config->item('base_url');?>">
							<fieldset>
                               
								<div class="form-group">
									<label class="col-md-3 control-label" for="firstName">First Name</label>
									<div class="col-md-8">
										<input type="text" name="firstName" id="firstName" class="form-control" value="">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="firstName">Last Name</label>
									<div class="col-md-8">
										<input type="text" name="lastName" id="lastName" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="userEmail">Email-Id</label>
									<div class="col-md-8">
										<input type="text" name="userEmail" id="userEmail" class="form-control" value="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="image">Image</label>
									<div class="col-md-8">
										<input type="file" name="image" id="image"  value="">
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
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>

<script>
	$(document).ready(function(e){
		$("#submit").click(function(e){
			var _title = $("#attiributespeName").val();
		
			//alert(_desc);
			if (_title == "") {
				$("#attiributespeName").attr('placeholder','Please enter city name');
				$("#attiributespeName").css("border-color","red");
				$("#attiributespeName").focus();
				e.preventDefault();
			}
		});
	});
</script>
