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
						<header class="panel-heading">
							
						
							<h2 class="panel-title">Edit Visitor</h2>
							
						</header>
						
					<div class="panel-body">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/receptionist/edited_visitor">
								   <input type="hidden" name="hidvisitorid" value="<?php echo $visitor_list[0]['id'];?>"/>
							<fieldset>
                                 <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Client *</label>
									<div class="col-md-8">
									<select name="client" id="client" class="form-control">
                                    	<option value="">Please choose Client</option>
                                        <?php foreach($client_list as $clntlst) {?>
											<option value="<?php echo $clntlst['userId'];?>" <?php echo(($clntlst['userId']==$visitor_list[0]['client_id'])?'selected':"");?>><?php echo $clntlst['FirstName']." ".$clntlst['LastName'];?></option>
											
											<?php }?>
                                    </select>
									</div>
								</div>		
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Name *</label>
									<div class="col-md-8">
									<input type="text" name="visitorName" id="visitorName"
										   class="form-control" placeholder="" value="<?php echo $visitor_list[0]['name'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName" class="form-control">Phone *</label>
									<div class="col-md-8">
									<input type="text" name="visitorPhone" id="visitorPhone"
										   class="form-control" placeholder="" value="<?php echo $visitor_list[0]['phone'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName" class="form-control">Address *</label>
									<div class="col-md-8">
									<textarea name="visitorAddress" id="visitorAddress"
										   class="form-control" placeholder=""><?php echo $visitor_list[0]['address'];?></textarea>
									</div>
								</div>
								<div class="form-group">
												<label class="col-md-3 control-label">In Time</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input type="text" data-plugin-timepicker class="form-control" name="in_time" id="in_time" value="<?php echo $visitor_list[0]['in_time'];?>">
													</div>
												</div>
												
											</div>
											<div class="form-group">
											<label class="col-md-3 control-label">Out Time</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input type="text" data-plugin-timepicker class="form-control" name="out_time" id="out_time" value="<?php echo $visitor_list[0]['out_time'];?>">
													</div>
												</div>
						                      </div>
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<button type="submit" class="btn btn-success" onclick="" id="submit">Update</button>
								</div>
							</div>
							</div>
							</form>
				</section>
			
	
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer3.php'); ?> 

<script>
	$(document).ready(function(e){
		$("#submit").click(function(e){
			var _title = $("#visitorName").val();
			var _desc = $("#client").val();
			var phone=$("#visitorPhone").val();
			var in_time=$("#in_time").val();
			var out_time=$("#out_time").val();
			//alert(_desc);
			if (_desc == ""  ) {
				$("#client").attr('placeholder','Please choose city ');
				$("#client").css("border-color","red");
				$("#client").focus();
				e.preventDefault();
			}
			else if (_title == ""  ) {
				$("#visitorName").attr('placeholder','Please enter visitor name');
				$("#visitorName").css("border-color","red");
				$("#visitorName").focus();
				e.preventDefault();
			}
			else if(phone==""){
				$("#visitorPhone").attr('placeholder','Please enter Phone No');
				$("#visitorPhone").css("border-color","red");
				$("#visitorPhone").focus();
				e.preventDefault();
			}
			else if(in_time==""){
				//$("#in_time").attr('placeholder','Please enter Phone No');
				$("#in_time").css("border-color","red");
				$("#in_time").focus();
				e.preventDefault();
			}
			else if(out_time==""){
				//$("#out_time").attr('placeholder','Please enter Phone No');
				$("#out_time").css("border-color","red");
				$("#out_time").focus();
				e.preventDefault();
			}
		});
	});
</script>
