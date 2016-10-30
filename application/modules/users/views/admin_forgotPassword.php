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
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Recover Password</h2>
					</div>
					<div class="panel-body">
						<div id="toHid" class="alert alert-info">
							<p class="m-none text-weight-semibold h6">Enter your e-mail below and we will send you reset instructions!</p>
						</div>
						<div id="nonExistMsg" style="display:none;" class="alert alert-danger">
							<p class="m-none text-weight-semibold h6">Entered e-mail does not exist</p>
						</div>
						<div id="succMsg" style="display:none;" class="alert alert-success">
							<p class="m-none text-weight-semibold h6">mail has been send to your e-mail please check your mail.</p>
						</div>
						<div id="forgetPassLoad" style="display:none;" class="alert">
							<p class="text-center"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/load.gif" alt="Loading..."></p>
						</div>
						

						<form method="post" name="forgotPForm" id="forgotPForm">
							<div class="form-group mb-none">
								<div class="input-group">
									<input onfocus="checkLoginNullValue();" name="email" id="email" type="text" placeholder="E-mail" class="form-control input-lg enter_press_forget_pass" />
									<span class="input-group-btn">
										<button id="" name="forgetPassBtn" onclick="adminForgotPassword();" class="btn btn-primary btn-lg" type="button" >Reset</button>
									</span>
								</div>
							</div>

							<p class="text-center mt-lg">Remembered? <a href="<?php echo $this->config->item('base_url');?>index.php/login/Login" title="Sign In">Sign In!</a>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2015. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->
</body>
<?php require_once(FCPATH.'assets/admin/lib/sign_in/footer.php'); ?> 
