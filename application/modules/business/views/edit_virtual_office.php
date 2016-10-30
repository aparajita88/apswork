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
							<div class="panel-body"><h2 class="panel-title">EDIT VIRTUAL OFFICE </h2></div>	

							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/business/edit_virtual_office/<?php echo $virtual_office[0]['id'];?>">
							<fieldset>
                                <input type="hidden" name="id" value="<?php echo $virtual_office[0]['id'];?>">
                                	
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Name*</label>
									<div class="col-md-8">
									<input type="text" name="name" id="attiributespeName"
										   class="form-control" value="<?php echo $virtual_office[0]['name'];?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Detailes*</label>
									<div class="col-md-8">
									<textarea name="details" rows="8" cols="40" class="form-control"><?php echo $virtual_office[0]['details'];?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Monthly Price*</label>
									<div class="col-md-8">
									<input type="text" name="price" id="attiributespeName"
										   class="form-control" value="<?php echo $virtual_office[0]['price'];?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Registration Fee*</label>
									<div class="col-md-8">
									<input type="text" name="onetime_price" id="attiributespeName"
										   class="form-control" value="<?php echo $virtual_office[0]['onetime_price'];?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Css Class *</label>
									<div class="col-md-8">
									<select name="css_class" id="css_class" class="form-control">
                                    
                                        <?php
					$css = array('1' => 'orange','2' => 'skyblue','3'=>'saffron','4'=>'green','5'=>'blue');
					foreach($css as $key=>$value) {
											if($value == $virtual_office[0]['css_class'])
											{
												echo '<option value="'.$virtual_office[0]['css_class'].'" selected>'.$virtual_office[0]['css_class'].'</option>'; 
											}
											else{
												echo '<option value="'.$value.'">'.$value.'</option>';
											}
										} ?>
                                    </select>
									</div>
								</div>
								
								
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Update</button>
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
