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
							<div class="panel-body"><h2 class="panel-title">EDIT MOVIE HALL:   <?php echo $movie[0]['name']?></h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/edit_movie_hall/<?php echo $movie[0]['hallId']?>">
							<fieldset>
                                <input type="hidden" name="hallId" value="<?= $movie[0]['hallId'] ?>">
                                 
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Movie Name *</label>
									<div class="col-md-8">
									<input type="text" name="hallName" id="hallName"
										   class="form-control" value="<?= $movie[0]['name'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Movie Location *</label>
									<div class="col-md-8">
									<input type="text" name="hall_location" id="hall_location"
										   class="form-control" value="<?= $movie[0]['location'] ?>">
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
			var _hallname = $("#hallName").val();
			var hall_location = $("#hall_location").val();
			
			
			if (_hallname == "") {
				$("#hallName").attr('placeholder','Please enter the hall name');
				$("#hallName").css("border-color","red");
				$("#hallName").focus();
				e.preventDefault();
			}
			else if(hall_location==""){
                $("#hall_location").attr('placeholder','Please give the location of this hall');
				$("#hall_location").css("border-color","red");
				$("#hall_location").focus();
				e.preventDefault();

			}
			
		});
	});
</script>
