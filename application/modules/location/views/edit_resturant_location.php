<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

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
							<div class="panel-body"><h2 class="panel-title">EDIT RESTAURANT LOCATION :   <?php echo $res_loc[0]['name']?></h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/edit_restaurant_location/<?php echo $res_loc[0]['locationId']?>">
							<fieldset>
                                <input type="hidden" name="location_id" value="<?= $res_loc[0]['locationId'] ?>">
                                 
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Location *</label>
									<div class="col-md-8">
									<input type="text" name="locationName" id="locationName"
										   class="form-control" value="<?= $res_loc[0]['name'] ?>">
									</div>
								</div>
								
								
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Update</button>
								</div>
							</div>
							</div>
							</form>
				</section>
			
	
				
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>

<script>
	$(document).ready(function(e){
		$("#submit").click(function(e){
			var _locname = $("#locationName").val();
					
			if (_locname == "") {
				$("#locationName").attr('placeholder','Please enter the hall name');
				$("#locationName").css("border-color","red");
				$("#locationName").focus();
				e.preventDefault();
			}
			
			
		});
	});
</script>
