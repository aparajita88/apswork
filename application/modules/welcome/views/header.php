<!doctype html>
<html class="fixed">
	<head>
		<?php
			date_default_timezone_set('Asia/Calcutta');
		?>
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

		<!-- Specific Page Vendor CSS -->		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/select2/select2.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Specific Page Vendor CSS -->		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/morris/morris.css" />
		
		
		<!-- Specific Page Vendor CSS -->		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/dropzone/css/basic.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/dropzone/css/dropzone.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/summernote/summernote.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/summernote/summernote-bs3.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/codemirror/lib/codemirror.css" />		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/codemirror/theme/monokai.css" />
		
		
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/vendor/isotope/jquery.isotope.css" />
		
		<!-- Project Js's -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/project.css" />
		
		

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo $this->config->item('base_url');?>assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="<?php echo $this->config->item('base_url');?>index.php/users/adminDashboard" class="logo">
						<img src="<?php echo $this->config->item('base_url');?>assets/images/logo.png" height="35" alt="Telefone Deal" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Tasks
								</div>
			
								<div class="content">
									<ul>
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Generating Sales Report</span>
												<span class="message pull-right text-dark">60%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Importing Contacts</span>
												<span class="message pull-right text-dark">98%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-xs">
												<span class="message pull-left">Uploading something big</span>
												<span class="message pull-right text-dark">33%</span>
											</p>
											<div class="progress progress-xs light mb-xs">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-envelope"></i>
								<span class="badge">4</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">230</span>
									Messages
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?php echo $this->config->item('base_url');?>assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Doe</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?php echo $this->config->item('base_url');?>assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?php echo $this->config->item('base_url');?>assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
												</figure>
												<span class="title">Joe Junior</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?php echo $this->config->item('base_url');?>assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default">3</span>
									Alerts
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2014</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php if($this->session->userdata('userImg')=='') { echo $this->config->item('base_url').'assets/images/!logged-user.jpg'; } else { echo $this->config->item('base_url').'assets/uploads/images/medium/'.$this->session->userdata('userImg'); } ?>" alt="<?php echo $this->session->userdata('userProfileName'); ?>" class="img-circle" data-lock-picture="<?php echo $this->config->item('base_url');?>assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="<?php echo $this->session->userdata('userProfileName'); ?>" data-lock-email="<?php echo $this->session->userdata('userEmail'); ?>">
								<span class="name"><?php echo $this->session->userdata('userProfileName'); ?></span>
								<span class="role"><?php echo $this->session->userdata('userType'); ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a title="my profile" role="menuitem" tabindex="-1" href="<?php echo $this->config->item('base_url');?>index.php/users/myProfile"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<!--<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>-->
								<li>
									<a title="Logout" role="menuitem" tabindex="-1" href="<?php echo $this->config->item('base_url');?>index.php/users/userLogout"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
