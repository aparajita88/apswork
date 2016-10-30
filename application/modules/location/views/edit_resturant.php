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
							<div class="panel-body"><h2 class="panel-title">EDIT RESTAURANT :   <?php echo $resturant[0]['name']?></h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/edit_restaurant/<?php echo $resturant[0]['resturantId']?>">
							<fieldset>
                                <input type="hidden" name="resId" value="<?= $resturant[0]['resturantId'] ?>">
                                <input type="hidden" name="reslocId" value="<?= $resturant[0]['Id'] ?>">
                                <input type="hidden" name="hidresname" value="<?php echo $resturant[0]['name'];?>"/>
                                <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">EDIT RESTAURANT *</label>
									<div class="col-md-8">
									<select name="res_loc" id="res_loc" class="form-control">
									<option value="">Select Location</option>
									<?php if($res_loc){
										foreach($res_loc as $row){?>
                                      <option value="<?php echo $row['locationId'];?>" <?php echo(($resturant[0]['locationId']==$row['locationId'])?'selected':"");?>><?php echo $row['name'];?></option>
										<?php }}?>
									</select>
									</div>
								</div> 
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Restaurant Name *</label>
									<div class="col-md-8">
									<input type="text" name="resturantName" id="resturantName"
										   class="form-control" value="<?= $resturant[0]['name'] ?>">
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
			var _resturantName = $("#resturantName").val();
			var res_location = $("#res_loc").val();
			
			if(res_location==""){
                $("#res_loc").attr('placeholder','Please select the location of this hall');
				$("#res_loc").css("border-color","red");
				$("#res_loc").focus();
				e.preventDefault();

			}
			else if (_resturantName == "") {
				$("#resturantName").attr('placeholder','Please enter the resturant name');
				$("#resturantName").css("border-color","red");
				$("#resturantName").focus();
				e.preventDefault();
			}
			
			
		});
	});
</script>
