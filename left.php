<!-- start: sidebar -->
<?php if($this->session->userdata('userTypeId')=='ut11'){?>
	
	<aside id="sidebar-left" class="sidebar-left">
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
									
								 <li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
											<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									<!--</li>
										 <li class="<?=($this->uri->segment(2)=="mySubscription")?'nav-active':''?>">
											<a href="<?php echo base_url(); ?>index.php/users/mySubscription">
 											<i class="fa fa-credit-card" aria-hidden="true"></i>
											<span>My Membership</span>
										</a>
									</li>-->
                                    <li class="<?=($this->uri->segment(2)=="virtual_assistant")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/indirect_client/virtual_assistant">
 											<i class="fa fa-calendar" aria-hidden="true"></i>
											<span>Scheduler</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="add_request_travel"|| $this->uri->segment(2)=="add_request_smartconcierge")?'nav-active':''?>">
											<a href="<?php echo base_url(); ?>index.php/request/add_request_smartconcierge">
 											<i class="fa fa-plane" aria-hidden="true"></i>
 											<span>Smart Concierge</span>
										</a>
									</li>
							
                                    
									<li class="<?=($this->uri->segment(2)=="book_day_office"||$this->uri->segment(2)=="book_locker_room"||$this->uri->segment(2)=="book_game_room"||$this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_meeting_room" )?
                                  'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-briefcase" aria-hidden="true"></i>
											<span>Book</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_conference_roomm")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/indirect_client/book_conference_room">
													<span>Conference Rooms</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="book_meeting_room"|| $this->uri->segment(2)=="book_meeting_room")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/indirect_client/book_meeting_room">
													<span>Meeting Rooms</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="book_day_office"|| $this->uri->segment(2)=="book_day_office")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/indirect_client/book_day_office">
													<span>Day Offices</span>
												</a>
											</li>
                                            <li class="<?=($this->uri->segment(2)=="book_locker_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/indirect_client/book_locker_room">Locker Room</a></li>
                                           <li class="<?=($this->uri->segment(2)=="book_game_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/indirect_client/book_game_room">Games Room</a></li>
                                            
											
										</ul>
									</li>
                                  <li class="<?=($this->uri->segment(2)=="add_request_it"||$this->uri->segment(2)=="add_request_legal"||$this->uri->segment(2)=="add_request_secterial"|| $this->uri->segment(2)=="add_request_officeboy" || $this->uri->segment(2)=="add_request_courier" || $this->uri->segment(2)=="add_request_reception" || $this->uri->segment(2)=="add_request_payroll")?
                                  'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-phone" aria-hidden="true"></i>
											<span>Request</span>
										</a>
									       <ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="add_request_courier")?'nav-active':''?>">
											
												<a href="<?php echo base_url(); ?>index.php/request/add_request_courier">
													 Courier Services
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_request_officeboy")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_officeboy">
													 Office Boy
												</a>
											</li>
											<!-- <li class="<?=($this->uri->segment(2)=="add_request_reception")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_reception">
												Dedicated Phone Reception</a></li>
                                            <li class="<?=($this->uri->segment(2)=="add_request_secterial")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_secterial">
												Secretarial Support</a></li>
                                            <li class="<?=($this->uri->segment(2)=="add_request_legal")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_legal">
												Legal Support</a></li>-->
                                            <li class="<?=($this->uri->segment(2)=="add_request_it")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_it">
												IT Support</a></li>
											 <li class="<?=($this->uri->segment(2)=="add_request_payroll")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/request/add_request_payroll">
 											Clock In Clock Out Support</a></li>
 											
										</ul>
									</li>
									<?php if($userData['can_view_bill'] == 1){ ?>
									<li class="<?=($this->uri->segment(2)=="account_statements" ||$this->uri->segment(2)=="all_bills") ? 'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Manage Bills</span>
										</a>
									       <ul class="nav nav-children">
									       	<li class="<?=($this->uri->segment(2)=="all_bills")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/invoice/all_bills">
													Invoices
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="account_statements")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/invoice/account_statements">
													Account Statement
												</a>
											</li>
											
										</ul>
									</li>
									<?php } ?>
									<li class="<?=($this->uri->segment(2)=="add_request_cafe")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/request/add_request_cafe">
 											<i class="fa fa-coffee" aria-hidden="true"></i>
											<span>Smart Cafe</span>
										</a>
									</li>
                              
									
                                    <li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>
											<span>Feedback</span>
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
<?php }else if($this->session->userdata('userTypeId')=='ut4'){
?>

				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
									
								 <li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
											<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
									<!-- <li class="<?=($this->uri->segment(2)=="mySubscription")?'nav-active':''?>">
											<a href="<?php echo base_url(); ?>index.php/users/mySubscription">
 											<i class="fa fa-credit-card" aria-hidden="true"></i>
											<span>My Membership</span>
										</a>
									</li>-->
                                    <li class="<?=($this->uri->segment(2)=="virtual_assistant")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/client/virtual_assistant">
 											<i class="fa fa-calendar" aria-hidden="true"></i>
											<span>Scheduler</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="add_request_travel"|| $this->uri->segment(2)=="add_request_smartconcierge")?'nav-active':''?>">
											<a href="<?php echo base_url(); ?>index.php/request/add_request_smartconcierge">
 											<i class="fa fa-plane" aria-hidden="true"></i>
											<span>Smart Concierge</span>
										</a>
									</li>
							
                                    
									<li class="<?=($this->uri->segment(2)=="book_day_office"||$this->uri->segment(2)=="book_locker_room"||$this->uri->segment(2)=="book_game_room"||$this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_meeting_room" )?
                                  'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-briefcase" aria-hidden="true"></i>
											<span>Book</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_conference_roomm")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/client/book_conference_room">
													<span>Conference Rooms</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="book_meeting_room"|| $this->uri->segment(2)=="book_meeting_room")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/client/book_meeting_room">
													<span>Meeting Rooms</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="book_day_office"|| $this->uri->segment(2)=="book_day_office")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/client/book_day_office">
													<span>Day Offices</span>
												</a>
											</li>
                                            <li class="<?=($this->uri->segment(2)=="book_locker_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/client/book_locker_room">Locker Room</a></li>
                                           <li class="<?=($this->uri->segment(2)=="book_game_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/client/book_game_room">Games Room</a></li>
                                            
											
										</ul>
									</li>
                                  <li class="<?=($this->uri->segment(2)=="add_request_it"||$this->uri->segment(2)=="add_request_legal"||$this->uri->segment(2)=="add_request_secterial"|| $this->uri->segment(2)=="add_request_officeboy" || $this->uri->segment(2)=="add_request_courier" || $this->uri->segment(2)=="add_request_reception" || $this->uri->segment(2)=="add_request_payroll")?
                                  'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-phone" aria-hidden="true"></i>
											<span>Request</span>
										</a>
									       <ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="add_request_courier")?'nav-active':''?>">
											
												<a href="<?php echo base_url(); ?>index.php/request/add_request_courier">
													 Courier Services
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_request_officeboy")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_officeboy">
													 Office Boy
												</a>
											</li>
											 <!-- <li class="<?=($this->uri->segment(2)=="add_request_reception")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_reception">
												Dedicated Phone Reception</a></li>
                                            <li class="<?=($this->uri->segment(2)=="add_request_secterial")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_secterial">
												Secretarial Support</a></li>
                                            <li class="<?=($this->uri->segment(2)=="add_request_legal")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_legal">
												Legal Support</a></li>-->
                                            <li class="<?=($this->uri->segment(2)=="add_request_it")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/request/add_request_it">
												IT Support</a></li>
											 <li class="<?=($this->uri->segment(2)=="add_request_payroll")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/request/add_request_payroll">
 											Clock In Clock Out Support</a></li>
										</a>
									</li>
 											
										</ul>
									</li>
									<?php if($userData['can_view_bill'] == 1){ ?>
									<li class="<?=($this->uri->segment(2)=="account_statements" || $this->uri->segment(2)=="all_bills") ? 'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Manage Bills</span>
										</a>
									       <ul class="nav nav-children">
									       	<li class="<?=($this->uri->segment(2)=="all_bills")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/invoice/all_bills">
													Invoices
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="account_statements")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/invoice/account_statements">
													Account Statement
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="credit_note_request")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/creditnote/credit_note_for_client">
													 Credit Notes
												</a>
											</li>
											
										</ul>
									</li>
									<?php } ?>
									<li class="<?=($this->uri->segment(2)=="add_request_cafe")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/request/add_request_cafe">
 											<i class="fa fa-coffee" aria-hidden="true"></i>
											<span>Smart Cafe</span>
										</a>
									</li>
                                  
									
                                    <li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>
											<span>Feedback</span>
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
<?php } else if($this->session->userdata('userTypeId')=='ut3'){?>
	
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
									<li class="<?=($this->uri->segment(2)=="vendor_dashboard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/vendor/vendor_dashboard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
                                    
                                   <li class="<?=($this->uri->segment(2)=="add_classified")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/vendor/add_classified">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Register new office space</span>
										</a>
									</li>
                                    
                                       <li class="<?=($this->uri->segment(2)=="office_list")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/vendor/office_list">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>View registered office spaces</span>
										</a>
									</li>
                                     
                                     <li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>
											<span>Feedback</span>
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

	
	
	
	
	
	<?php } else if($this->session->userdata('userTypeId')=='ut1'){?>
		
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
										<a href="<?php echo base_url(); ?>index.php/users/admin/dashBoard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
                                  
                                   <li class="<?=($this->uri->segment(2)=="user_List"||$this->uri->segment(2)=="edit_user"||$this->uri->segment(2)=="delete_user" || $this->uri->segment(2)=="delete_staff" || $this->uri->segment(2)=="staff_List" || $this->uri->segment(2)=="edit_staff" 
                                   || $this->uri->segment(2)=="add_staff" || $this->uri->segment(2)=="add_vendor" || $this->uri->segment(2)=="edit_vendor" || $this->uri->segment(2)=="vendor_List" 
                                   ||$this->uri->segment(2)=="edit_location_email"||$this->uri->segment(2)=="view_locations_email")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Users</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="user_List" || $this->uri->segment(2)=="edit_user" || $this->uri->segment(2)=="delete_user")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/users/user_List" title="City List">Registered User List</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="staff_List" || $this->uri->segment(2)=="edit_staff" || $this->uri->segment(2)=="delete_staff" || $this->uri->segment(2)=="add_staff")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/users/staff_List" title="staff List">Staff User List</a>
											</li>
											
											<li class="<?=($this->uri->segment(2)=="vendor_List" || $this->uri->segment(2)=="edit_vendor" || $this->uri->segment(2)=="delete_vendor" || $this->uri->segment(2)=="add_vendor")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/users/vendor_List" title="Vendor List">Vendor User List</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_location_email" || $this->uri->segment(2)=="edit_location_email" || $this->uri->segment(2)=="view_locations_email")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/view_locations_email" title="Location Admin Emails">Community Managers</a>
											</li>
                                  </ul>
                                  </li>
                                   <li class="<?=($this->uri->segment(2)=="add_location_email"||$this->uri->segment(2)=="view_locations"||$this->uri->segment(2)=="add_city"|| $this->uri->segment(2)=="edit_city_name" || $this->uri->segment(2)=="city_list" || $this->uri->segment(2)=="add_location" || $this->uri->segment(2)=="edit_location" || $this->uri->segment(2)=="delete_city" 
                                   || $this->uri->segment(2)=="delete_location"|| $this->uri->segment(2)=="region_list"||$this->uri->segment(2)=="edit_region"||$this->uri->segment(2)=="add_region")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Address</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="add_city" || $this->uri->segment(2)=="edit_city_name" || $this->uri->segment(2)=="city_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/city_list" title="City List">City List</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="add_location" || $this->uri->segment(2)=="edit_location" || $this->uri->segment(2)=="view_locations")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/view_locations" title="Location List">Location List</a>
											</li>
											</li>
												<li class="<?=($this->uri->segment(2)=="add_region" || $this->uri->segment(2)=="edit_region" || $this->uri->segment(2)=="region_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/region_list" title="Region List">Region List</a>
											</li>
											
											</ul>
									</li>
								
									
									
									
									
							
									 <li class="<?=($this->uri->segment(2)=="edit_business" ||$this->uri->segment(2)=="add_business" || $this->uri->segment(2)=="manage_business_centers" || $this->uri->segment(2)=="add_business_attributes" || $this->uri->segment(2)=="add_virtual_attributes" || $this->uri->segment(2)=="virtual_attributes_list" || $this->uri->segment(2)=="edit_virtual_office" 
									 || $this->uri->segment(2)=="add_business_attributes"
									|| $this->uri->segment(2)=="add_meeting"|| $this->uri->segment(2)=="edit_meeting_room" || $this->uri->segment(2)=="meeting_room_list"
									|| $this->uri->segment(2)=="add_game" || $this->uri->segment(2)=="edit_game_room" || $this->uri->segment(2)=="games_room_list"
									||$this->uri->segment(2)=="add_locker" || $this->uri->segment(2)=="edit_locker_room" || $this->uri->segment(2)=="locker_room_list" 
									||$this->uri->segment(2)=="add_conference" || $this->uri->segment(2)=="edit_conference_room" || $this->uri->segment(2)=="conference_room_list" || 
									$this->uri->segment(2)=="add_day_office" || $this->uri->segment(2)=="edit_day_office" || $this->uri->segment(2)=="day_office_list")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
                                   
										<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Business </span>
										</a>
                                        <ul class="nav nav-children">
											
											<li class="<?=($this->uri->segment(2)=="add_business" || $this->uri->segment(2)=="edit_business" || $this->uri->segment(2)=="manage_business_centers" || $this->uri->segment(2)=="add_business_attributes" || $this->uri->segment(2)=="add_virtual_attributes" || $this->uri->segment(2)=="virtual_attributes_list" || $this->uri->segment(2)=="edit_virtual_office"  )?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/business/manage_business_centers" title="Business Centers">Business List</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_day_office" || $this->uri->segment(2)=="edit_day_office" || $this->uri->segment(2)=="day_office_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/day_office_list" title="Day Office Management">Day offices</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="add_meeting" || $this->uri->segment(2)=="edit_meeting_room" || $this->uri->segment(2)=="meeting_room_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/meeting_room_list" title="Meeting Room Management">Meeting Rooms</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="conference_room_list" || $this->uri->segment(2)=="add_conference" || $this->uri->segment(2)=="edit_conference_room")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/conference_room_list" title="Conference Room Management">Conference Rooms</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="edit_game_room" || $this->uri->segment(2)=="add_game" || $this->uri->segment(2)=="games_room_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/games_room_list" title="Games Room Management">Games Rooms</a>
											</li>
							                <li class="<?=($this->uri->segment(2)=="locker_room_list" || $this->uri->segment(2)=="add_locker" || $this->uri->segment(2)=="edit_locker_room")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/locker_room_list" title="Locker Room Management">Locker Rooms</a>
											</li>
											
										</ul>
									</li>
									
									
									
									 <li class="<?=($this->uri->segment(2)=="edit_game_types" ||$this->uri->segment(2)=="add_game_types" || $this->uri->segment(2)=="game_types_list"
									|| $this->uri->segment(2)=="add_concierge_types"|| $this->uri->segment(2)=="edit_concierge_types" || $this->uri->segment(2)=="concierge_types_list"
									|| $this->uri->segment(2)=="add_courier_types" || $this->uri->segment(2)=="edit_courier_types" || $this->uri->segment(2)=="courier_types_list"
									 
									||$this->uri->segment(2)=="add_cafe_types" || $this->uri->segment(2)=="edit_cafe_types" || $this->uri->segment(2)=="cafe_types_list" 
									|| $this->uri->segment(2)=="concierge_add_city" || $this->uri->segment(2)=="concierge_city_list" || $this->uri->segment(2)=="edit_concierge_city_name" || $this->uri->segment(2)=="movie_hall" || $this->uri->segment(2)=="add_movie_hall" || $this->uri->segment(2)=="edit_movie_hall" || $this->uri->segment(2)=="add_movie" || $this->uri->segment(2)=="edit_movie" || $this->uri->segment(2)=="movie" || $this->uri->segment(2)=="add_restaurant_location" || $this->uri->segment(2)=="edit_restaurant_location" || $this->uri->segment(2)=="restaurant_location" || $this->uri->segment(2)=="add_restaurant" || $this->uri->segment(2)=="edit_restaurant" || $this->uri->segment(2)=="restaurant" || $this->uri->segment(2)=="add_event" || $this->uri->segment(2)=="edit_event" || $this->uri->segment(2)=="event" || $this->uri->segment(2)=="add_event_location" || $this->uri->segment(2)=="edit_event_location" || $this->uri->segment(2)=="event_location" || $this->uri->segment(2)=="add_experience" || $this->uri->segment(2)=="edit_experience" || $this->uri->segment(2)=="experience" || $this->uri->segment(2)=="add_experience_location" || $this->uri->segment(2)=="edit_experience_location" || $this->uri->segment(2)=="experience_location" || $this->uri->segment(2)=="creditnote_staff_List" || $this->uri->segment(2)=="creditnote_edit_staff")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
                                  
										<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Settings</span>
										</a>
                                        <ul class="nav nav-children">
												<li class="<?=($this->uri->segment(2)=="edit_game_types" || $this->uri->segment(2)=="add_game_types" || $this->uri->segment(2)=="game_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/game_types_list" title="Game Types">Game Types</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="edit_concierge_types" || $this->uri->segment(2)=="add_concierge_types" || $this->uri->segment(2)=="concierge_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/concierge_types_list" title="Concierge Types">Concierge Types</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="edit_courier_types" || $this->uri->segment(2)=="add_courier_types" || $this->uri->segment(2)=="courier_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/courier_types_list" title="Courier Types">Courier Types</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="edit_cafe_types" || $this->uri->segment(2)=="add_cafe_types" || $this->uri->segment(2)=="cafe_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/cafe_types_list" title="Cafe Category">Cafe Types</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_subscription_type" || $this->uri->segment(2)=="edit_subscription_type" || $this->uri->segment(2)=="subscription_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/subscription_list" title="Member Subscription">Member Subscription</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="creditnote_staff_List" || $this->uri->segment(2)=="creditnote_edit_staff" )?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/users/creditnote_staff_List" title="Credit note staff List">Credit Note Approval Limits</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="concierge_add_city" || $this->uri->segment(2)=="edit_concierge_city_name" || $this->uri->segment(2)=="concierge_city_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/concierge_city_list" title="Member Subscription">Concierge City</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_movie_hall" || $this->uri->segment(2)=="edit_movie_hall" || $this->uri->segment(2)=="movie_hall")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/movie_hall" title="Member Subscription">Movie Hall</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_movie" || $this->uri->segment(2)=="edit_movie" || $this->uri->segment(2)=="movie")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/movie" title="Member Subscription">Movie</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_restaurant_location" || $this->uri->segment(2)=="edit_restaurant_location" || $this->uri->segment(2)=="restaurant_location")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/restaurant_location" title="Restaurant Location">Restaurant Location</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_restaurant" || $this->uri->segment(2)=="edit_restaurant" || $this->uri->segment(2)=="restaurant")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/restaurant" title="Restaurant">Restaurant</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_event" || $this->uri->segment(2)=="edit_event" || $this->uri->segment(2)=="event")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/event" title="Event">Event</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_event_location" || $this->uri->segment(2)=="edit_event_location" || $this->uri->segment(2)=="event_location")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/event_location" title="Event">Event Location</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_experience" || $this->uri->segment(2)=="edit_experience" || $this->uri->segment(2)=="experience")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/experience" title="Experience">Experience</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_experience_location" || $this->uri->segment(2)=="edit_experience_location" || $this->uri->segment(2)=="experience_location")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/experience_location" title="Experience Location">Experience Location</a>
											</li>
										</ul>
									</li>
									
									
                                  <li class="<?=($this->uri->segment(2)=="list_page_category" ||$this->uri->segment(2)=="add_category"|| $this->uri->segment(2)=="edit_category"|| $this->uri->segment(2)=="list_subpage_category" || $this->uri->segment(2)=="list_page" || $this->uri->segment(2)=="add_subpage_category" || $this->uri->segment(2)=="add_page" || $this->uri->segment(2)=="edit_page" || $this->uri->segment(2)=="edit_sub_category")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
                                  
										<a>
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Web Contents</span>
										</a>
                                        <ul class="nav nav-children">
												<li class="<?=($this->uri->segment(2)=="list_page_category" || $this->uri->segment(2)=="add_category" || $this->uri->segment(2)=="edit_category")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/cms/list_page_category" title="Page Category Management">Page Category</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="list_subpage_category" || $this->uri->segment(2)=="add_subpage_category" || $this->uri->segment(2)=="edit_sub_category")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/cms/list_subpage_category" title="Pages Management">Page sub category</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="list_page" || $this->uri->segment(2)=="add_page" || $this->uri->segment(2)=="edit_page")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/cms/list_page" title="Pages Management">Pages</a>
											</li>
											
										</ul>
									</li>
									<li class="<?=($this->uri->segment(2)=="request_list" || $this->uri->segment(2)=="edit_request")?'nav-active':''?>">
                                   
										<a href="<?php echo base_url(); ?>index.php/request/request_list">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Manage Requests</span>
										</a>

									</li>
									
									 <li class="<?=($this->uri->segment(2)=="email_template_list" || $this->uri->segment(2)=="add_email_template" ||$this->uri->segment(2)=="edit_email_template")?'nav-active':''?>">
                                   
										<a href="<?php echo base_url(); ?>index.php/cms/email_template_list">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Email Templates</span>
										</a>
									</li>
									
									
                                     <li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
                                   
										<a href="<?php echo base_url(); ?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>
											<span>Feedback</span>
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
				<?php }
				
 else if($this->session->userdata('userTypeId')=='ut5'){?>
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
					
					<li class="<?=($this->uri->segment(2)=="center_dashBoard")?'nav-active':''?>">
                                        <a href="<?php echo base_url(); ?>index.php/receptionist/center_dashBoard">
                                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span>Center Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
                                        <a href="<?php echo base_url(); ?>index.php/receptionist/dashBoard">
                                            <i aria-hidden="true" class="fa fa-calendar"></i>
                                            <span>Scheduler</span>
                                        </a>
                                    </li>
				   
                                   <li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
                                      <a href="<?php echo base_url(); ?>index.php/users/myProfile">
                                             <i class="fa fa-user" aria-hidden="true"></i>
                                            <span>My Account</span>
                                        </a>
                                    </li>
                                   <li class="<?=($this->uri->segment(2)=="existing_client")?'nav-active':''?>">
                                        <a href="<?php echo base_url(); ?>index.php/receptionist/existing_client">
                                             <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>Clients</span>
                                        </a>
                                    </li>
                                    <li class="<?=($this->uri->segment(2)=="existing_visitor")?'nav-active':''?>">
                                        <a href="<?php echo base_url(); ?>index.php/receptionist/existing_visitor">
                                             <i class="fa fa-user-secret" aria-hidden="true"></i>
                                            <span>Visitors</span>
                                        </a>
                                    </li>
                                    <li class="<?=($this->uri->segment(2)=="book_day_office"||$this->uri->segment(2)=="book_locker_room"||$this->uri->segment(2)=="book_game_room"||$this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_meeting_room" )?
                                  'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-briefcase" aria-hidden="true"></i>
											<span>Book</span>
										</a>
										<ul class="nav nav-children">
										    <li class="<?=($this->uri->segment(2)=="book_meeting_room"|| $this->uri->segment(2)=="book_meeting_room")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/receptionist/book_meeting_room">
													<span>Meeting Rooms</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_conference_roomm")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/receptionist/book_conference_room">
													<span>Conference Rooms</span>
												</a>
											</li>
											
											<li class="<?=($this->uri->segment(2)=="book_day_office"|| $this->uri->segment(2)=="book_day_office")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/receptionist/book_day_office">
													<span>Day Offices</span>
												</a>
											</li>
                                            <li class="<?=($this->uri->segment(2)=="book_locker_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/receptionist/book_locker_room">Locker Room</a></li>
                                           <li class="<?=($this->uri->segment(2)=="book_game_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/receptionist/book_game_room">Games Room</a></li>
                                            
											
										</ul>
									</li>
                                     				    
									<li class="<?=($this->uri->segment(2)=="service_request"|| $this->uri->segment(2)=="booking_details" || $this->uri->segment(2)=='add_request_courier' || $this->uri->segment(2)=='add_request_officeboy' || $this->uri->segment(2)=='add_request_it' || $this->uri->segment(2)=='add_request_payroll')?'nav-parent nav-expanded nav-active':'nav-parent'?>">
									
										<a href="#">
 											<i class="fa fa-cog" aria-hidden="true"></i>
											<span>Manage</span>
										</a>
										<ul class="nav nav-children">
											
									
											<li class="<?=($this->uri->segment(2)=="service_request" || $this->uri->segment(2)=='add_request_courier' || $this->uri->segment(2)=='add_request_it' || $this->uri->segment(2)=='add_request_payroll')?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/receptionist/service_request">
												<i class="fa fa-phone" aria-hidden="true"></i>

												 <span>Request for Services</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="booking_details")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/receptionist/booking_details">
												<i class="fa fa-book"></i>
													 <span>Bookings</span>
												</a>
											</li>
											
											</ul>
									</li>
																				
										
									<?php if($userData['can_view_bill'] == 1){ ?>
									<li class="<?=($this->uri->segment(2)=="account_statements" || $this->uri->segment(2)=="credit_note_request"||$this->uri->segment(2)=="all_bills" || $this->uri->segment(2)=="manual_payment" || $this->uri->segment(2)=="payment_pdf") ? 'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Billing</span>
										</a>
									       <ul class="nav nav-children">
									       	<li class="<?=($this->uri->segment(2)=="all_bills")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/receptionist/all_bills">
													Invoices
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="account_statements")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/receptionist/account_statements">
													Statement Of Accounts
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="credit_note_request")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/creditnote/credit_note_request">
													 Credit Notes
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="manual_payment" || $this->uri->segment(2)=="payment_pdf")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/receptionist/manual_payment">
													Manual Payment
												</a>
											</li>
										</ul>
									</li>
									<?php } ?>
									<li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
										<a href="<?php echo base_url();?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>

											<span>Feedback</span>
										</a>
									</li>
									 <li class="<?=($this->uri->segment(2)=="add_contacts")?'nav-active':''?>">
                                        <a href="<?php echo base_url(); ?>index.php/receptionist/add_contacts">
                                             <i class="fa fa-user-plus" aria-hidden="true"></i>
                                            <span>Add Contacts</span>
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
                
                    <?php }
		     else if($this->session->userdata('userTypeId')=='ut6'){?>
		
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
										<a href="<?php echo base_url(); ?>index.php/ituser/dashBoard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
                                  
                                
                                   <li class="<?=($this->uri->segment(2)=="add_location_email"||$this->uri->segment(2)=="edit_location_email"||$this->uri->segment(2)=="view_locations_email"||$this->uri->segment(2)=="view_locations"||$this->uri->segment(2)=="add_city"|| $this->uri->segment(2)=="edit_city_name" || $this->uri->segment(2)=="city_list" || $this->uri->segment(2)=="add_location" || $this->uri->segment(2)=="edit_location" || $this->uri->segment(2)=="delete_city" || $this->uri->segment(2)=="delete_location")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Address</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="add_city" || $this->uri->segment(2)=="edit_city_name" || $this->uri->segment(2)=="city_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/city_list" title="City List">City List</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="add_location" || $this->uri->segment(2)=="edit_location" || $this->uri->segment(2)=="view_locations")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/view_locations" title="Location List">Location List</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="add_location_email" || $this->uri->segment(2)=="edit_location_email" || $this->uri->segment(2)=="view_locations_email")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/location/view_locations_email" title="Location Admin Emails">Location Admin Emails</a>
											</li>
											</ul>
									</li>
								
									
									
									
									
							
								<li class="<?=($this->uri->segment(2)=="edit_business" ||$this->uri->segment(2)=="add_business" || $this->uri->segment(2)=="manage_business_centers"
									|| $this->uri->segment(2)=="add_meeting"|| $this->uri->segment(2)=="edit_meeting_room" || $this->uri->segment(2)=="meeting_room_list"
									|| $this->uri->segment(2)=="add_game" || $this->uri->segment(2)=="edit_game_room" || $this->uri->segment(2)=="games_room_list"
									||$this->uri->segment(2)=="add_locker" || $this->uri->segment(2)=="edit_locker_room" || $this->uri->segment(2)=="locker_room_list" 
									||$this->uri->segment(2)=="add_conference" || $this->uri->segment(2)=="edit_conference_room" || $this->uri->segment(2)=="conference_room_list" )?'nav-parent nav-expanded nav-active':'nav-parent'?>">
                              
									<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Business </span>
										</a>
                                        <ul class="nav nav-children">
											<li class="<?=($this->uri->segment(2)=="add_business" || $this->uri->segment(2)=="edit_business" || $this->uri->segment(2)=="manage_business_centers")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/business/manage_business_centers" title="Business Centers">Business List</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="add_meeting" || $this->uri->segment(2)=="edit_meeting_room" || $this->uri->segment(2)=="meeting_room_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/meeting_room_list" title="Meeting Room Management">Meeting Rooms</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="conference_room_list" || $this->uri->segment(2)=="add_conference" || $this->uri->segment(2)=="edit_conference_room")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/conference_room_list" title="Conference Room Management">Conference Rooms</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="edit_game_room" || $this->uri->segment(2)=="add_game" || $this->uri->segment(2)=="games_room_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/games_room_list" title="Games Room Management">Games Rooms</a>
											</li>
							                <li class="<?=($this->uri->segment(2)=="locker_room_list" || $this->uri->segment(2)=="add_locker" || $this->uri->segment(2)=="edit_locker_room")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/locker_room_list" title="Locker Room Management">Locker Rooms</a>
											</li>
											
										</ul>
									</li>
									
									
									
									 <li class="<?=($this->uri->segment(2)=="edit_game_types" ||$this->uri->segment(2)=="add_game_types" || $this->uri->segment(2)=="game_types_list"
									|| $this->uri->segment(2)=="add_concierge_types"|| $this->uri->segment(2)=="edit_concierge_types" || $this->uri->segment(2)=="concierge_types_list"
									|| $this->uri->segment(2)=="add_courier_types" || $this->uri->segment(2)=="edit_courier_types" || $this->uri->segment(2)=="courier_types_list"
									 
									||$this->uri->segment(2)=="add_cafe_types" || $this->uri->segment(2)=="edit_cafe_types" || $this->uri->segment(2)=="cafe_types_list" )?'nav-parent nav-expanded nav-active':'nav-parent'?>">
                                  
										<a href="#">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Settings</span>
										</a>
                                        <ul class="nav nav-children">
												<li class="<?=($this->uri->segment(2)=="edit_game_types" || $this->uri->segment(2)=="add_game_types" || $this->uri->segment(2)=="game_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/game_types_list" title="Game Types">Game Types</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="edit_concierge_types" || $this->uri->segment(2)=="add_concierge_types" || $this->uri->segment(2)=="concierge_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/concierge_types_list" title="Concierge Types">Concierge Types</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="edit_courier_types" || $this->uri->segment(2)=="add_courier_types" || $this->uri->segment(2)=="courier_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/courier_types_list" title="Courier Types">Courier Types</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="edit_cafe_types" || $this->uri->segment(2)=="add_cafe_types" || $this->uri->segment(2)=="cafe_types_list")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/rooms/cafe_types_list" title="Cafe Category">Cafe Types</a>
											</li>
										</ul>
									</li>
									
									
                                  <li class="<?=($this->uri->segment(2)=="list_page_category" ||$this->uri->segment(2)=="add_category"|| $this->uri->segment(2)=="edit_category"|| $this->uri->segment(2)=="list_subpage_category" || $this->uri->segment(2)=="list_page" || $this->uri->segment(2)=="add_subpage_category" || $this->uri->segment(2)=="add_page" || $this->uri->segment(2)=="edit_page" || $this->uri->segment(2)=="edit_sub_category")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
                                   
										<a>
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>Manage Web Contents</span>
										</a>
                                        <ul class="nav nav-children">
												<li class="<?=($this->uri->segment(2)=="list_page_category" || $this->uri->segment(2)=="add_category" || $this->uri->segment(2)=="edit_category")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/cms/list_page_category" title="Page Category Management">Page Category</a>
											</li>
												<li class="<?=($this->uri->segment(2)=="list_subpage_category" || $this->uri->segment(2)=="add_subpage_category" || $this->uri->segment(2)=="edit_sub_category")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/cms/list_subpage_category" title="Pages Management">Page sub category</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="list_page" || $this->uri->segment(2)=="add_page" || $this->uri->segment(2)=="edit_page")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/cms/list_page" title="Pages Management">Pages</a>
											</li>
											
										</ul>
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
				<?php }
				else if($this->session->userdata('userTypeId')=='ut7'){?>
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
									<li class="<?=($this->uri->segment(2)=="center_dashBoard")?'nav-active':''?>">
                                        <a href="<?php echo base_url(); ?>index.php/manager/center_dashBoard">
                                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                                            <span>Center Dashboard</span>
                                        </a>
                                    </li>
									<li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/manager/dashBoard">
											<i class="fa fa-calendar" aria-hidden="true"></i>
											<span>Scheduler</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="client_list")?'nav-active':''?>">
										<a href="<?php echo base_url();?>index.php/manager/client_list">
 											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Clients</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="book_day_office"||$this->uri->segment(2)=="book_locker_room"||$this->uri->segment(2)=="book_game_room"||$this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_meeting_room" )?
                                  'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-briefcase" aria-hidden="true"></i>
											<span>Book</span>
										</a>
										<ul class="nav nav-children">
										    <li class="<?=($this->uri->segment(2)=="book_meeting_room"|| $this->uri->segment(2)=="book_meeting_room")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/manager/book_meeting_room">
													<span>Meeting Rooms</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="book_conference_room"|| $this->uri->segment(2)=="book_conference_roomm")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/manager/book_conference_room">
													<span>Conference Rooms</span>
												</a>
											</li>
											
											<li class="<?=($this->uri->segment(2)=="book_day_office"|| $this->uri->segment(2)=="book_day_office")?'nav-active':''?>">
													<a href="<?php echo base_url(); ?>index.php/manager/book_day_office">
													<span>Day Offices</span>
												</a>
											</li>
                                            <li class="<?=($this->uri->segment(2)=="book_locker_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/manager/book_locker_room">Locker Room</a></li>
                                           <li class="<?=($this->uri->segment(2)=="book_game_room")?'nav-active':''?>">
                                            <a href="<?php echo base_url(); ?>index.php/manager/book_game_room">Games Room</a></li>
                                            
											
										</ul>
									</li>
									<li class="<?=($this->uri->segment(2)=="service_request"|| $this->uri->segment(2)=="booking_details" || $this->uri->segment(2)=='add_request_courier' || $this->uri->segment(2)=='add_request_officeboy' || $this->uri->segment(2)=='add_request_it' || $this->uri->segment(2)=='add_request_payroll')?'nav-parent nav-expanded nav-active':'nav-parent'?>">
									
										<a href="#">
 											<i class="fa fa-cog" aria-hidden="true"></i>
											<span>Manage</span>
										</a>
										<ul class="nav nav-children">
															
									
									
											<li class="<?=($this->uri->segment(2)=="service_request" || $this->uri->segment(2)=='add_request_courier' || $this->uri->segment(2)=='add_request_it' || $this->uri->segment(2)=='add_request_payroll')?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/manager/service_request">
												<i class="fa fa-phone" aria-hidden="true"></i>


												 <span>Request for Services</span>
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="booking_details")?'nav-active':''?>">
												<a href="<?php echo base_url();?>index.php/manager/booking_details">
												<i class="fa fa-book"></i>
													 <span>Bookings</span>
												</a>
											</li>
											
											</ul>
									</li>
									<?php if($userData['can_view_bill'] == 1){ ?>
									<li class="<?=($this->uri->segment(2)=="account_statements" || $this->uri->segment(2)=="all_bills" || $this->uri->segment(2)=="creditnote_approval" || $this->uri->segment(2)=="manual_payment" || $this->uri->segment(2)=="payment_pdf") ? 'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Billing</span>
										</a>
									       <ul class="nav nav-children">
									       	<li class="<?=($this->uri->segment(2)=="all_bills")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/manager/all_bills">
													Invoices
												</a>
											</li>
											
											<li class="<?=($this->uri->segment(2)=="account_statements")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/manager/account_statements">
													Statement Of Accounts
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="creditnote_approval")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/creditnote/creditnote_approval">
													Credit Notes
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="manual_payment" || $this->uri->segment(2)=="payment_pdf")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/manager/manual_payment">
													Manual Payment
												</a>
											</li>
										</ul>
									</li>
									<?php } ?>
									<li class="<?=($this->uri->segment(2)=="booking_seat")?'nav-active':''?>">
										<a href="<?php echo base_url()."index.php/manager/booking_seat"; ?>">
 											<i class="fa fa-cog" aria-hidden="true"></i>
											<span>Private Office Bookings</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="voffice_booking_listing" || $this->uri->segment(2)=="voffice" )?'nav-active':''?>">
                                   
										<a href="<?php echo base_url(); ?>index.php/business/voffice_booking_listing">
 											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Virtual Office Bookings</span>
										</a>
										
									</li>
									<li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
										<a href="<?php echo base_url();?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>

											<span>Feedback</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="enquiry")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/manager/enquiry">
 											<i class="fa fa-question-circle" aria-hidden="true"></i>
											<span>Generate Enquiry</span>
										</a>
									</li>
										<li class="<?=($this->uri->segment(2)=="need_analysis")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/manager/need_analysis">
 											<i class="fa fa-line-chart" aria-hidden="true"></i>
											<span>Need Analysis</span>
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
					<?php }else if($this->session->userdata('userTypeId')=='ut8'){?>
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
									<li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/concierge/dashBoard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
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
						<?php }else if($this->session->userdata('userTypeId')=='ut9'){?>
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
									<li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/pantry/dashBoard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
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
					

		<?php } else if($this->session->userdata('userTypeId')=='ut2'){?>
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
									<li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/owner/analytics">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(1)=="complaints")?'nav-active':''?>">
										<a href="<?php echo base_url();?>index.php/complaints">
 											<i class="fa fa-comment" aria-hidden="true"></i>

											<span>Feedback</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="creditnote_approval") ? 'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Manage Bills</span>
										</a>
									       <ul class="nav nav-children">
									<li class="<?=($this->uri->segment(2)=="creditnote_approval")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/creditnote/creditnote_approval">
												<i class="fa fa-user" aria-hidden="true"></i>
													<span>Credit Notes</span>
												</a>
									</li>
									</ul>
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
					<?php }else if($this->session->userdata('userTypeId')=='ut10'){?>
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
									<li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/areadirector/center_dashBoard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Center Dashboard</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="client_list")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/areadirector/client_list">
 											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Clients</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
									<?php if($userData['can_view_bill'] == 1){ ?>
									<li class="<?=($this->uri->segment(2)=="account_statements" || $this->uri->segment(2)=="all_bills"|| $this->uri->segment(2)=="creditnote_approval") ? 'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-money" aria-hidden="true"></i>
											<span>Billing</span>
										</a>
									       <ul class="nav nav-children">
									       	<li class="<?=($this->uri->segment(2)=="all_bills")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/areadirector/all_bills">
													Invoices
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="account_statements")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/areadirector/account_statements">
													Statement Of Accounts
												</a>
											</li>
											<li class="<?=($this->uri->segment(2)=="creditnote_approval")?'nav-active':''?>">
												<a href="<?php echo base_url(); ?>index.php/creditnote/creditnote_approval">
													Credit Notes
												</a>
											</li>
										</ul>
									</li>
									<?php } ?>
									<li class="<?=($this->uri->segment(2)=="analytics")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/areadirector/analytics">
										<i class="fa fa-bar-chart" aria-hidden="true"></i>
											<span>Analytics</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="index")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/complaints/index">
 											<i class="fa fa-comment" aria-hidden="true"></i>
											<span>Feedback</span>
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
					<?php }else if($this->session->userdata('userTypeId')=='ut12'){?>
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
									<li class="<?=($this->uri->segment(2)=="dashBoard")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/istuser/dashBoard">
											<i class="fa fa-tachometer" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="myProfile")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/users/myProfile">
 											<i class="fa fa-user" aria-hidden="true"></i>
											<span>My Account</span>
										</a>
									</li>
									<li class="<?=($this->uri->segment(2)=="enquiry")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/istuser/enquiry">
 											<i class="fa fa-phone" aria-hidden="true"></i>
											<span>Enquiry</span>
										</a>
									</li>
										<li class="<?=($this->uri->segment(2)=="need_analysis")?'nav-active':''?>">
										<a href="<?php echo base_url(); ?>index.php/istuser/need_analysis">
 											<i class="fa fa-line-chart" aria-hidden="true"></i>
											<span>Need Analysis</span>
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
					<?php }?>


				
		
