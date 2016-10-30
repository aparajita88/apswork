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
							<div class="panel-body"><h2 class="panel-title">ADD RESTAURANT</h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/add_restaurant">
							<fieldset>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Location *</label>
									<div class="col-md-8">
									<select name="res_loc" id="res_loc" class="form-control">
									<option value="">Select Location</option>
									<?php if($res_loc){
										foreach($res_loc as $row){?>
                                      <option value="<?php echo $row['locationId'];?>"><?php echo $row['name'];?></option>
										<?php }}?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Restaurant Name *</label>
									<div class="col-md-8">
									<input type="text" name="resName" id="resName"
										   class="form-control" placeholder="">
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
			var _resName = $("#resName").val();
			var res_loc = $("#res_loc").val();
			if(res_loc==""){
				$("#res_loc").css("border-color","red");
				$("#res_loc").focus();
				e.preventDefault();

			}
			else if (_resName == "") {
				$("#resName").attr('placeholder','Please enter the movie name');
				$("#resName").css("border-color","red");
				$("#resName").focus();
				e.preventDefault();
			}
			
			
		});
	});
</script>
