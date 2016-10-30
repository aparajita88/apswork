	<?php require_once(FCPATH.'assets/admin/lib/sign_in/header.php'); ?> 
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="<?php echo $this->config->item('base_url');?>index.php/admin" class="logo pull-left">
					<img src="<?php echo $this->config->item('base_url');?>assets/front/images/logobk.png" height="54" alt="Smartworks" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<span class="error" id="wrong-credential"></span>
						<form name="adminLoginFrm" id="adminLoginFrm" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" id="username" type="text" onclick="removeValidationColor(this.id);" class="form-control input-lg enter_press" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<a href="<?php echo $this->config->item('base_url');?>index.php/users/forgotPassword" class="pull-right">Lost Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" id="password" type="password" onclick="removeValidationColor(this.id);" class="form-control input-lg enter_press" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<!--<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>-->
									</div>
								</div>
								<p id="login_err_txt" class="text-center" style="display:none;">The username and password you entered don't match.</p>
								<div class="col-sm-4 text-right">
									<button id="AdmlogBtn" type="button" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="button" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>

							
							
							<!--<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>

							<p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>-->

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->
</body>
<?php require_once(FCPATH.'assets/admin/lib/sign_in/footer.php'); ?> 
