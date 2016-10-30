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
			<h2 class="panel-title">Edit Request</h2>
			</div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
										
										
									<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart("index.php/request/edit_request/".$request[0]['id'], $attributes);?>
	     
           <?php if($this->session->flashdata('success')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
	<?php //print_r($userData);?>
		
											<div class="form-group">
												
												<label class="col-md-3 control-label" for="inputDefault">Hourly Price<span class="required">*</span></label>
												
												<div class="col-md-6">
								<input class="form-control" name="hourly_price"   value="<?php echo $request[0]['hourly_price']; ?>" id="first_name" type="text"  />
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Day Price<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="day_price"   value="<?php echo $request[0]['day_price']; ?>" id="email" type="text" />
												</div>
											</div>
											
										
		
	   
							
			
					
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
			</div>
	
				<?php //$this->load->view('right'); ?>
			
		</section>
			



<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 

     
