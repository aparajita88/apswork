<!doctype html>
<html class="fixed">
	<head>
		<!-- Js url -->
		<script type="text/javascript" language="javascript">
			var js_site_url='<?php echo $this->config->item('base_url');?>index.php/';
  		</script>
		<!-- Js url --> 
		<!-- Basic -->
		<meta charset="UTF-8">
		<title>Hostmypartyz</title>
		<meta name="keywords" content="Telefone deal Admin Panel" />
		<meta name="description" content="Telefone deal Admin Panel">
		<meta name="author" content="simayaa" >

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/theme-custom.css">
		
		<!-- Project Js's -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/project.css" />

		<!-- Head Libs -->
		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="<?php echo $this->config->item('base_url');?>index.php/admin" class="logo pull-left">
					<img src="<?php echo $this->config->item('base_url');?>assets/images/logo.png" height="54" alt="Telefone Deal" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<form name="adminLoginFrm" id="adminLoginFrm" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input onfocus="checkLoginNullValue();" name="username" id="username" type="text" class="form-control input-lg enter_press" />
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
									<input onfocus="checkLoginNullValue();" name="password" id="password" type="password" class="form-control input-lg enter_press" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>
							<p id="login_err_txt" class="text-center" style="display:none;">The username and password you entered don't match.</p>
							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<!--<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>-->
									</div>
								</div>
								<p id="login_err_txt" class="text-center" style="display:none;">The username and password you entered don't match.</p>
								<div class="col-sm-4 text-right">
									<button id="AdmlogBtn" onclick="vendorLogin()" type="button" class="btn btn-primary hidden-xs">Sign In</button>
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



		<!-- Vendor -->
		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/jquery/jquery.js"></script>		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap/js/bootstrap.js"></script>		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/nanoscroller/nanoscroller.js"></script>		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/magnific-popup/magnific-popup.js"></script>		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $this->config->item('base_url');?>assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo $this->config->item('base_url');?>assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $this->config->item('base_url');?>assets/javascripts/theme.init.js"></script>

		<!-- Cust Js's -->
		<script src="<?php echo $this->config->item('base_url');?>assets/js/login.js"></script>

	</body>
</html>