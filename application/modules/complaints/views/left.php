<!-- start: sidebar -->
<?php
if($this->session->userdata('userTypeName')=='Vendor'){
?>

				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="index.html">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="#">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Virtual Assistant</span>
										</a>
									</li>
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Travel Desk</span>
										</a>
									</li>
                                    
									<li class="nav-parent">
										<a>
											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Book</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="#">
													 Conference Rooms
												</a>
											</li>
											<li>
												<a href="#">
													 Meeting Rooms
												</a>
											</li>
                                            <li><a href="#">Locker Room</a></li>
                                            <li><a href="#">Games Room</a></li>
                                            
											
										</ul>
									</li>
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Request</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="#">
													 Courier Services
												</a>
											</li>
											<li>
												<a href="#">
													 Office Boy
												</a>
											</li>
                                            <li><a href="#">Dedicated Phone Reception</a></li>
                                            <li><a href="#">Secretarial Support</a></li>
                                            <li><a href="#">Legal Support</a></li>
                                            <li><a href="#">IT Support</a></li>
                                            <li><a href="#">Printing & Copying Services</a></li>
                                            <li><a href="#">Video Conferencing</a></li>
 											
										</ul>
									</li>
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Check Attendance</span>
										</a>
									</li>
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Complaints</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url()."index.php/users/doLogOut"; ?>">
 											<i class="fa fa-power-off" aria-hidden="true"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</nav>
				
							
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->
<?php } else if($this->session->userdata('userTypeName')=='Direct Client'){?>
	
	<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="index.html">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="#">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
                                    
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Register new office space</span>
										</a>
									</li>
                                    
                                     <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>View registered office spaces</span>
										</a>
									</li>
                                     
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Complaints</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url()."index.php/users/doLogOut"; ?>">
 											<i class="fa fa-power-off" aria-hidden="true"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</nav>
				
							
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

	
	
	
	
	
	<?php } else {?>
		
		<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="index.html">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="#">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
                                    
                                    <li class="nav-parent">
										<a>
											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Manage</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="#">
													 Clients
												</a>
											</li>
                                            <li>
												<a href="#">
													 Services
												</a>
											</li>
											
										</ul>
									</li>
                                    
                                     <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Generate & print invoice</span>
										</a>
									</li>
                                     
                                    <li>
										<a href="#">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Complaints</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url()."index.php/users/doLogOut"; ?>">
 											<i class="fa fa-power-off" aria-hidden="true"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</nav>
				
							
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->
				<?php }?>
