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
							<div class="panel-body"><h2 class="panel-title">EDIT MOVIE :   <?php echo $movie[0]['name']?></h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/edit_movie/<?php echo $movie[0]['movieId']?>">
							<fieldset>
                                <input type="hidden" name="movieId" value="<?= $movie[0]['movieId'] ?>">
                                <input type="hidden" name="moviehallId" value="<?= $movie[0]['Id'] ?>">
                                <input type="hidden" name="hidmoviename" value="<?php echo $movie[0]['name'];?>"/>
                                <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Movie Hall *</label>
									<div class="col-md-8">
									<select name="movie_hall" id="movie_hall" class="form-control">
									<option value="">Select Movie Hall</option>
									<?php if($hall){
										foreach($hall as $row){?>
                                      <option value="<?php echo $row['hallId'];?>" <?php echo(($movie[0]['hallId']==$row['hallId'])?'selected':"");?>><?php echo $row['name'];?></option>
										<?php }}?>
									</select>
									</div>
								</div> 
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Movie Name *</label>
									<div class="col-md-8">
									<input type="text" name="movieName" id="movieName"
										   class="form-control" value="<?= $movie[0]['name'] ?>">
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
