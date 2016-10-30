<?php $this->load->view('header'); ?>
			<div class="inner-wrapper">
				<?php $this->load->view('left'); ?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Users</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>index.php/users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Users</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							</div>
						
							<h2 class="panel-title">Edit User</h2>
						</header>
						<form method="post" name="editUserFrm" id="editUserFrm" enctype="multipart/form-data">
					<div class="panel-body">
						
					<h4 class="mb-xlg">Description</h4>
					<?php
							$row=$userTbl[0];
					?>
					
					<!-- Image Preview Section Start -->
											<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
												<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
													<div class="thumbnail">
													<div id="AddFileInputBox" class="thumb-preview">
														<a class="thumb-image" href="<?php if($row['image']==''){ echo $this->config->item('base_url').'assets/images/projects/project-1.jpg'; }else{ echo $this->config->item('base_url').'assets/uploads/images/medium/'.$row['image']; } ?>">
															<img src="<?php if($row['image']==''){ echo $this->config->item('base_url').'assets/images/projects/project-1.jpg'; }else{ echo $this->config->item('base_url').'assets/uploads/images/medium/'.$row['image']; } ?>" class="img-responsive" alt="Project" id="blah">
														</a>
													<div class="mg-thumb-options">
													<div class="mg-zoom"><i class="fa fa-search"></i></div>
													<div class="mg-toolbar">
														<div class="mg-option checkbox-custom checkbox-inline">
															<input  onchange="readURL(this,0);" type="file" name="userImage" id="userImage">
														</div>
														<div class="mg-group pull-right">
															<span class="thumb-info-type loader" id="loader"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/images/loader.gif" border="0" ></span>
														</div>
														<!--<div class="mg-group pull-right">
															<a href="#" id="loader"  style="opacity: 0;">EDIT</a>
															<button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown">
																<i class="fa fa-caret-up"></i>
															</button>
															<ul class="dropdown-menu mg-menu" role="menu">
																<li><a href="#"><i class="fa fa-download"></i> Download</a></li>
																<li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
															</ul>
														</div>-->
													</div>
													</div>
													</div>
														<!--<h5 class="mg-title text-weight-semibold">SEO<small>.png</small></h5>
															<div class="mg-description">
															<small class="pull-left text-muted">Design, Websites</small>
															<small class="pull-right text-muted">07/10/2014</small>
															</div>-->
													</div>
												</div>
											</div>
											<!-- Image Preview Section End -->	
							
							<fieldset>
								<div class="form-group">
									<label class="col-md-3 control-label" for="userType">User Type</label>
									<div class="col-md-8">
										<select name="userType" id="userType" onfocus="checkNullProf();" class="form-control">
                            		<option value="">Select</option>
                            		<?php 
                                	foreach($userTypeList as $uType){
                            		?>
                                		<option <?php if($row['userTypeId']==$uType['userTypeId']){ ?>selected="selected"<?php } ?> value="<?php echo $uType['userTypeId']; ?>"><?php echo $uType['userTypeName']; ?></option>
                            		<?php } ?>
                        		</select>
									</div>
									</div>
									<div class="form-group">
								   <label class="col-md-3 control-label" for="userEmail">Email-Id</label>
									<div class="col-md-8">
										<input type="text" name="userEmail" id="userEmail" onfocus="checkNullProf();" value="<?php echo $row['userName']; ?>" placeholder="email address" class="form-control l" onkeyup="sellerEmailLoder()" onBlur="javascript:checkEmailSellerEdt()">
										<div id="loderId" class="l" style="display:none;"><img src="<?php echo $this->config->item('base_url');?>assets/images/load.gif"></div>
                        			<input type="hidden" name="vali" id="vali">
                        			<input type="hidden" name="editEmailVal" id="editEmailVal" value="<?php echo $row['userName']; ?>">
                        		<div id="emailInvalid"  style="display:none;" class="l">
                            		<font style="color:#d7422d; font-size:14px; margin-left:4px;">Email is in use.</font>
                        		</div>
                        		<div id="emailInvalidFormat"  style="display:none;" class="l">
                            		<font style="color:#d7422d; font-size:14px; margin-left:4px;">Invalid mail format.</font>
                        		</div>
                        		<div  style="display:none;" class="l" id="emailValid">
                        			<i class="fa fa-thumbs-o-up"></i>
                        			<?php /*<img style="margin-left:4px;margin-top:4px;" src="<?php echo $this->config->item('base_url');?>assets/images/correct.png">*/ ?>
                        		</div>
									</div>
									</div>
									<?php /*<div class="form-group">
									<label class="col-md-3 control-label" for="userPassword">Password</label>
									<div class="col-md-8">
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label" for="userPassword">Confirm Password</label>
									<div class="col-md-8">
										<input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" class="form-control">
									</div>
									</div>*/ ?>									
									<h4 class="mb-xlg">Profile Information</h4>
									<div class="form-group">
									<label class="col-md-3 control-label" for="userImage">Image</label>
									<div class="col-md-8">
										
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label" for="userFirstName">First Name</label>
									<div class="col-md-8">
										<input type="text" name="firstName" id="firstName" onfocus="checkNullProf();" value="<?php echo $row['FirstName']; ?>" placeholder="First name" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label" for="userLastName">Last Name</label>
									<div class="col-md-8">
										<input type="text" name="lastName" id="lastName" onfocus="checkNullProf();" value="<?php echo $row['LastName']; ?>" placeholder="Last name" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label" for="userProfileName">Profile Name</label>
									<div class="col-md-8">
										<input type="text" name="profileName" id="profileName" onfocus="checkNullProf();" value="<?php echo $row['profileName']; ?>" placeholder="Profile Name" class="form-control">
									</div>
									</div>
									<div class="form-group">
									<label class="col-md-3 control-label" for="userGender">Gender</label>
									<div id="radioTd" class="col-md-8">
									<label class="radio-inline">
										<input type="radio" value="Male" name="gender" id="gender" <?php if($row['gender']=="Male") { echo "checked"; } ?>> Male
									</label>
									<label class="radio-inline">
										<input type="radio" value="Female" name="gender" id="gender" <?php if($row['gender']=="Female") { echo "checked"; } ?>> Female
									</label>
									</div>
									</div>

									<div id="multiVal" class="form-group">
									<label class="col-md-3 control-label" for="userAddress">Address</label>
									<div class="col-md-8">
										<textarea placeholder="Address" rows="3" class="form-control" name="address1" id="address1"><?php echo $row['address1']; ?></textarea>
									</div>
									</div>
									<div id="multiVal" class="form-group">
									<label class="col-md-3 control-label" for="userPhone">Phone</label>
									<div class="col-md-8">
										<input type="text" name="phone" id="phone" value="<?php echo $row['phone']; ?>" placeholder="Phone No" class="form-control" onkeypress="return isNumberKey(event)">
									</div>
									</div>
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<input type="hidden" id="imgCurrent" name="imgCurrent" value="<?php echo $row['image']; ?>">
									<input type="hidden" id="user_id" name="user_id" value="<?php echo $row['userId']; ?>">
									<button type="button" class="btn btn-primary" onclick="updateUserreg();">Submit</button>
								</div>
							</div>
							</div>
							</form>
				</section>
			</div>
	
				<?php $this->load->view('right'); ?>
			
		</section>
<?php $this->load->view('footer'); ?>