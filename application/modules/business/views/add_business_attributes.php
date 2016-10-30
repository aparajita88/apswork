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
							<div class="panel-body"><h2 class="panel-title">ADD ATTRIBUTES:   <?php echo $business_name[0]['businessName']?></h2></div>	

							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/business/add_business_attributes/<?php echo $business_name[0]['business_id'];?>">
							<fieldset>
                                <input type="hidden" name="business_id" value="<?= $business_name[0]['business_id'] ?>">
                                	
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">floor cost *(monthly)</label>
									<div class="col-md-8">
									<input type="text" name="floor_cost" id="attiributespeName"
										   class="form-control" value="<?= (empty($business)  ? '' : $business[0]['floor_cost']) ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Bookself cost *(monthly)</label>
									<div class="col-md-8">
									<input type="text" name="bookself_cost" id="attiributespeName"
										   class="form-control" value="<?= (empty($business)  ? '' : $business[0]['bookself_cost']) ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Internal Storage Cost *(monthly)</label>
									<div class="col-md-8">
									<input type="text" name="internal_storage_cost" id="attiributespeName"
										   class="form-control" value="<?= (empty($business)  ? '' : $business[0]['internal_storage_cost']) ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Internet cost*(monthly)</label>
									<div class="col-md-8">
									<?php
									if(!empty($business[0]['internet_cost'])){
									$icost = ''; 
									foreach(json_decode($business[0]['internet_cost']) as $k=>$v){
										$icost.= ucfirst($k).':'.$v.', ';
									}
									$icost = rtrim(trim($icost),',');
								}

									?>
									<input type="text" name="internet_cost" id="attiributespeName"
										   class="form-control"  value="<?= (isset($icost)? $icost : '') ?>">
									<div style="color:red;">Please use this format.</div>
									</div>

								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Phone cost *(monthly)</label>
									<div class="col-md-8">
									<input type="text" name="phone_cost" id="attiributespeName"
										   class="form-control"  value="<?= (empty($business)  ? '' : $business[0]['phone_cost']) ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">WIfi cost *(monthly)</label>
									<div class="col-md-8">
									<input type="text" name="wifi_cost" id="attiributespeName"
										   class="form-control" value="<?= (empty($business)  ? '' : $business[0]['wifi_cost']) ?>">
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
