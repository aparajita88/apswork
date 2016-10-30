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
							<div class="panel-body"><h2 class="panel-title">ADD Restaurant Location</h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/add_restaurant_location">
							<fieldset>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Location *</label>
									<div class="col-md-8">
									<input type="text" name="res_location" id="res_location" class="form-control">
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
			
	
				</section>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 

<script>
	$(document).ready(function(e){
		$("#submit").click(function(e){
			var res_location = $("#res_location").val();
			if(res_location==""){
                $("#res_location").attr('placeholder','Please enter the location');
				$("#res_location").css("border-color","red");
				$("#res_location").focus();
				e.preventDefault();

			}
			
		});
	});
</script>
