<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
			
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	</header>
	<div class="row">
	<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
			<h2 class="panel-title">Add Vendor</h2>
			</div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
										
										
									<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/users/add_vendor', $attributes);?>
	     
           <?php if($this->session->flashdata('success')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
	<?php //print_r($userData);?>
	
		
											<div class="form-group">
												
												<label class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
												
												<div class="col-md-6">
								<input class="form-control" name="name"   value="" id="first_name" type="text"  />
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Vendor Email<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="email"   value="" id="email" type="text"  />
												</div>
											</div>
											
											
								
											
											
										
						
						
											

					
					
		
	      <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Phone</label>
		<div class="col-md-6">
		<input class="form-control"   name="phone" value="" id="phone"  type="text">	
        </div>
	     
			</section>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<button type="button" id="add_classifieds" class="btn btn-primary">Submit</button>
			</div>
		</div>
		</div>
	 <?php echo form_close();?>

			</div>
	
		</div>
	</div>
			</section>
		
	
		</div>
	
<!-- end: page -->
	</section>
<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>
<style>
.redmessage{
border:1px solid #f00;
color:#f00;                                                       	
	
}
.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
.redmessage::-moz-placeholder {
    color: #FF0000;
 }

.redmessage::-webkit-input-placeholder 
{
  color: #FF0000;
}

</style>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
<script type="text/javascript">
	
      $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 
			
			if(firstNameValidation() && emailValidation() && phonenumber()){
				
				$("#form").submit();
			}else{
				return false;
			}
			
		});
			});
	 </script>
     
