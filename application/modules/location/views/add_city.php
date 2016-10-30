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
							<div class="panel-body"><h2 class="panel-title">ADD CITY</h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/add_city">
							<fieldset>
							<?php //print_r($region); ?>
                                <div class="form-group">

									<label class="col-md-3 control-label" for="attributeName">Region *</label>
									<div class="col-md-8">
									<select name="region_name" id="region_name" class="form-control">

                                    	<option value="0">Select Region</option>
                                        <?php foreach($region as $key=>$value) {
											
												echo '<option value="'.$value['regionId'].'">'.$value['name'].'</option>';
											
										} ?>
                                    </select>
									</div>
								</div>		
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">City Name *</label>
									<div class="col-md-8">
									<input type="text" name="attiributespeName" id="attiributespeName"
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
			
	
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 

<script>
	$(document).ready(function(e){
		$("#submit").click(function(e){
			var _title = $("#attiributespeName").val();
			var region_name = $("#region_name").val();
			
			if(region_name=="0"){
                $("#region_name").attr('placeholder','Please choose');
				$("#region_name").css("border-color","red");
				$("#region_name").focus();
				e.preventDefault();

			}
			else if (_title == "") {
				$("#attiributespeName").attr('placeholder','Please enter city name');
				$("#attiributespeName").css("border-color","red");
				$("#attiributespeName").focus();
				e.preventDefault();
			}
			
		});
	});
</script>
