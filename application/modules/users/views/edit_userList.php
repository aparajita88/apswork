<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
			<section role="main" class="content-body">
					<header class="page-header">
							<h2>Hi  <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
						
						
					</header>

					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
						<div class="panel-body">
							<!-- <div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							</div> -->
						

							<h2 class="panel-title">Edit User Information</h2>
					

							
						</div>
						
					<div class="panel-body panel_body_top">
						<?php $row=$userTbl[0];?>
							<form  name="userFrm" id="userFrm" method="post" onsubmit="return validateForm();" action="<?php echo $this->config->item('base_url');?>index.php/users/update/<?php echo $row['userId']?>">
							
							<fieldset>
                               
								<div class="form-group">
									<label class="col-md-3 control-label" for="edit_firstName">First Name</label>
									<div class="col-md-8">
										<input type="text" name="edit_firstName" id="edit_firstName" class="form-control" value="<?php echo $row['FirstName'];?>">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="edit_lastName">Last Name</label>
									<div class="col-md-8">
										<input type="text" name="edit_lastName" id="edit_lastName" class="form-control" value="<?php echo $row['LastName'];?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="edit_userEmail">Email</label>
									<div class="col-md-8">
										<input type="text" name="edit_userEmail" id="edit_userEmail" class="form-control" readonly value="<?php echo $row['userEmail'];?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="edit_phone">Contact no</label>
									<div class="col-md-8">
										<input type="text" name="edit_phone" id="edit_phone" class="form-control" value="<?php echo $row['phone'];?>">
									</div>
								</div>
								
								
								
							</fieldset>

							
					</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<input type="submit" class="btn btn-primary" name="update"  value="Submit"/>
								</div>
							</div>
							</div>
							</form>
							
				</section>
			
	
				<?php //$this->load->view('right'); ?>
			
		</section>
		<script type="text/javascript">
								function validateForm(){
									
									var fname=document.getElementById('edit_firstName').value;
									var lname=document.getElementById('edit_lastName').value;
									var phone=document.getElementById('edit_phone').value;
									var city=document.getElementById('edit_city').value;
									if(fname == "")
									{
										alert("Please enter First Name");
										document.getElementById('edit_firstName').focus();
										return false;
									}
									
										
								    
									else if(lname == "")
									{
										alert("Please enter Last Name");
										document.getElementById('edit_lastName').focus();
										return false;
									}
									
									
								    
									else if(phone == "")
									{
									    alert("Please enter valid contact no");
										document.getElementById('edit_phone').focus();
										return false;
									}
									
									
								    
									else if(city == "")
									{
										alert("Please enter valid city");
										document.getElementById('edit_city').focus();
										return false;
									}
									
									return true;
								    
								}
								
		</script>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>


