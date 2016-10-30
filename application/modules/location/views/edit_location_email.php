<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
		<section role="main" class="content-body">
					<header class="page-header">
							<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
					
<!--
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Pages</span></li>
								
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
-->
					</header>

						<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">Edit Location  email  :   <?php echo $location[0]['name'];?> ( <?php echo $city[0]['name'];?>)</h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/edit_location_email/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" enctype="multipart/form-data">
							<fieldset>
								
                               <!--- <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">City *</label>
									<div class="col-md-8">
									<select name="city" id="city"  class="form-control">
                                    	<!--<option value="0">Select page category</option>-->
                                        <?php 
                                         //foreach($cities as $key=>$value) {
											//if($value['cityId'] == $location[0]['cityId'])
											//{
												//echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
											//}
											//else{
												//echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>';
											//}
										//} ?>
                                   <!--- </select>
									</div>
								</div>--->
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Location Email *</label>
									<div class="col-md-8">
									<input type="text" name="email" id="email"
										   class="form-control" value="<?= $location[0]['email'] ?>">
									</div>
								</div>
								
                             <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Community Manager Name</label>
									<div class="col-md-8">
									<input type="text" name="admin_name" id="admin_name"
										   class="form-control" value="<?= $location[0]['admin_name'] ?>">
									</div>
								</div>
								
                                
                               
                                
                                
                                
								

							
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
			</div>
	
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 

<script>
	
	
	$(document).ready(function(e){
		
		
		
		$("#submit").click(function(e){
			
			var _email= $("#email").val();
			var _admin_name = $("#admin_name").val();
			//alert(_admin_name);
			
			 if (_email == "") {
				$("#email").attr('placeholder','Please enter email');
				$("#email").css("border-color","red");
				$("#email").focus();
				e.preventDefault();
			}
			 //if (_content.length =="") {
			else if(_email != ""){
			var validRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			 if(_email.search(validRegex) == -1){
		$('#email').val('');
		$('#email').attr('placeholder', 'Enter valid E-mail');
		$('#email').addClass('redmessage');
		e.preventDefault();
	}else{
	return true	;	
	}
			}else if(_admin_name == ""){
			$("#admin_name").attr('placeholder','Please enter admin name');
			$("#admin_name").css("border-color","red");
			$("#admin_name").focus();
			e.preventDefault();	
			}
		});
		
		});
	
		
	
</script>

