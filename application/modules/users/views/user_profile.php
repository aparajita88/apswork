<?php $this->load->view('header'); ?>
			<div class="inner-wrapper">
				<?php $this->load->view('left'); ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>User Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>index.php/users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>User Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<?php
							$row=$profData[0];
					?>
					<div class="row">
						<form class="form-horizontal" name="myProfFrm" id="myProfFrm" enctype="multipart/form-data">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div id="AddFileInputBox" class="thumb-info mb-md">
										<img src="<?php if($row['image']=='') { echo $this->config->item('base_url').'assets/images/!logged-user.jpg'; } else { echo $this->config->item('base_url').'assets/uploads/images/medium/'.$row['image']; } ?>" class="rounded img-responsive preview" alt="John Doe" id="blah">
										<div class="thumb-info-title">
										
											<span class="thumb-info-inner"><?php echo $this->session->userdata('userProfileName'); ?></span>
											<span class="thumb-info-type loader" id="loader"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/images/loader.gif" border="0" ></span>
											<!--<span class="thumb-info-type">CEO</span>-->
										</div>
										
									</div>
									<input onchange="readURL(this,0);" type="file" name="userImage" id="userImage">
									<?php /*<div id="AddFileInputBox" class="image_up">
                            <span class="loader" id="loader"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/images/loader.gif" border="0" ></span>
                            <span class="avter"><img src="<?php if($row['image']=='') { echo $this->config->item('base_url').'assets/images/!logged-user.jpg'; } else { echo $this->config->item('base_url').'assets/uploads/images/thumbnails/'.$row['image']; } ?>" class="preview" id="blah"></span>
                            <a><i class="icon-camera"></i></a><input onchange="readURL(this,0);" type="file" name="userImage" id="userImage">
                        </div> */?>
                        </div>
							</section>


							
						</div>
						<div class="col-md-8 col-lg-8">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#edit" data-toggle="tab">Edit</a>
									</li>
								</ul>
								<div class="tab-content">
									
									<div id="edit" class="tab-pane active">
										
										
											<h4 class="mb-xlg">Personal Information</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">First Name</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileFirstName" name="profileFirstName" value="<?php echo $row['FirstName']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileLastName">Last Name</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileLastName" name="profileLastName" value="<?php echo $row['LastName']; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileName">Profile Name</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileName" name="profileName" value="<?php echo $row['userProfilename']; ?>">
													</div>
												</div>
												<!--<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Company</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="profileCompany">
													</div>
												</div>-->
											</fieldset>
											<!--<hr class="dotted tall">
											<h4 class="mb-xlg">About Yourself</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileBio">Biographical Info</label>
													<div class="col-md-8">
														<textarea class="form-control" rows="3" id="profileBio"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-xs-3 control-label mt-xs pt-none">Public</label>
													<div class="col-md-8">
														<div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
															<input type="checkbox" checked="" id="profilePublic">
															<label for="profilePublic"></label>
														</div>
													</div>
												</div>
											</fieldset>-->
											<hr class="dotted tall">
											<h4 class="mb-xlg">Change Password</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
													<div class="col-md-8">
														<input type="password" class="form-control" id="profileNewPassword" name="profileNewPassword">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
													<div class="col-md-8">
														<input type="password" class="form-control" id="profileNewPasswordRepeat" name="profileNewPasswordRepeat">
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<input type="hidden" id="imgCurrent" name="imgCurrent" value="<?php echo $row['image']; ?>">
                    								<input type="hidden" id="user_id" name="user_id" value="<?php echo $row['userId']; ?>">
														<button onclick="updateProf()" type="button" class="btn btn-primary">Submit</button>
														<!--<button type="reset" class="btn btn-default">Reset</button>-->
													</div>
												</div>
											</div>

										

									</div>
								</div>
							</div>
						</div>
						
						</form>
					</div>
					<!-- end: page -->
					
				</section>
			</div>
	
				<?php $this->load->view('right'); ?>
			
		</section>
<?php $this->load->view('footer'); ?>