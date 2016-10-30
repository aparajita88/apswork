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
							<div class="panel-body"><h2 class="panel-title">ADD EVENT LOCATION</h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/add_event_location">
							<fieldset>
							
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Event Location *</label>
									<div class="col-md-8">
									<textarea name="eventLocation" id="eventLocation"
										   class="form-control" placeholder="" row="2" cols="50"></textarea>
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
			var _event = $("#eventLocation").val();

			if (_event == "") {
				$("#eventLocation").attr('placeholder','Please enter event location');
				$("#eventLocation").css("border-color","red");
				$("#eventLocation").focus();
				e.preventDefault();
			}
			
		});
	});
</script>
