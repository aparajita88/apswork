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
									<?php
									switch($this->session->userdata('userType')) 
									{
   									case 'Merchant':
   								?>
   								<li class="<?=($this->uri->segment(1)=="users" && $this->uri->segment(2)!="admin")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/users/sellerDashboard" title="Dashboard">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="attributes")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/attributes/admin/attributesList" title="Attributes">
											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Attributes</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="products")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/products/admin/productsList" title="Products">
											<i class="fa fa-cube" aria-hidden="true"></i>
											<span>Products</span>
										</a>
									</li>
   								<?php
   									break;
										
										case 'Administrator':
									?>
									<li class="<?=($this->uri->segment(1)=="users" && $this->uri->segment(2)!="admin")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/users/adminDashboard" title="Dashboard">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									
									<!--<li class="<?=($this->uri->segment(1)=="categories")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/categories/admin/categoriesList/" title="Categories">
											<i class="fa fa-pie-chart" aria-hidden="true"></i>
											<span>Vendor</span>
										</a>
									</li>-->
									
								<!--		<li class="<?=($this->uri->segment(1)=="sitesetting")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-gears" aria-hidden="true"></i>
											<span>Vendor  </span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(3)=="manageSiteSettings")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/categories/admin/categoriesList/">
													Vendor Management
												</a>
											</li>
											<!--<li class="<?=($this->uri->segment(3)=="manageSocialSettings")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/categories/admin/vendorserviceList/">
													Service Management
												</a>
											</li>
										</ul>
									</li>-->
									<li class="<?=($this->uri->segment(3)=="vendorserviceList")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/categories/admin/categoriesList" title="Brands">
											<i class="fa fa-tag" aria-hidden="true"></i>
											<span>Vendor Management</span>
										</a>
									</li>
								   <li class="<?=($this->uri->segment(3)=="vendorserviceList")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/categories/admin/vendorserviceList" title="Brands">
											<i class="fa fa-tag" aria-hidden="true"></i>
											<span>Service Management</span>
										</a>
									</li>
									
									<!--<li class="<?=($this->uri->segment(1)=="brands")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/brands/admin/brandList" title="Brands">
											<i class="fa fa-tag" aria-hidden="true"></i>
											<span>Brands</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="attributes")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/attributes/admin/attributesList" title="Attributes">
											<i class="fa fa-th-large" aria-hidden="true"></i>
											<span>Attributes</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="products")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/products/admin/productsList" title="Products">
											<i class="fa fa-cube" aria-hidden="true"></i>
											<span>Products</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="merchantManage")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/merchantManage/admin/userList" title="Sellers">
											<i class="fa fa-slideshare" aria-hidden="true"></i>
											<span>Sellers</span>
										</a>
									</li>-->
									
									<li class="<?=(($this->uri->segment(3)=="userList" || $this->uri->segment(3)=="addUser" || $this->uri->segment(3)=="editUser") && ($this->uri->segment(1)!="merchantManage"))?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/users/admin/userList" title="Manage Users">
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Manage Users</span>
										</a>
									</li>	
									
									<!--<li class="<?=($this->uri->segment(1)=="banners")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/banners/admin/bannerList" title="Banners">
											<i class="fa fa-flag" aria-hidden="true"></i>
											<span>Banners</span>
										</a>
									</li>-->
									
									<li class="<?=($this->uri->segment(1)=="cms")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/cms/admin/pageList" title="CMS Pages">
											<i class="fa fa-files-o" aria-hidden="true"></i>
											<span>CMS Pages</span>
										</a>
									</li>
									
									
									<li class="<?=($this->uri->segment(1)=="sitesetting")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-gears" aria-hidden="true"></i>
											<span>Settings</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(3)=="manageSiteSettings")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/sitesetting/admin/manageSiteSettings">
													 Site Settings
												</a>
											</li>
											<li class="<?=($this->uri->segment(3)=="manageSocialSettings")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/sitesetting/admin/manageSocialSettings">
													 Social Settings
												</a>
											</li>
										</ul>
									</li>
										
									
									<li class="<?=($this->uri->segment(1)=="email")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/email/admin/emailList" title="Email Template">
											<i class="fa fa-paste" aria-hidden="true"></i>
											<span>Email Template</span>
										</a>
									</li>	
									
									<!--<li class="<?=($this->uri->segment(1)=="newsletters")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/newsletters/admin" title="Newsletters">
											<i class="fa fa-newspaper-o" aria-hidden="true"></i>
											<span>Newsletters</span>
										</a>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="country" || $this->uri->segment(1)=="state" || $this->uri->segment(1)=="zip")?'nav-parent nav-expanded nav-active':'nav-parent'?>">
										<a>
											<i class="fa fa-map-marker" aria-hidden="true"></i>
											<span>Locations</span>
										</a>
										<ul class="nav nav-children">
											<li class="<?=($this->uri->segment(1)=="country")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/country/admin/countryList">
													 Country
												</a>
											</li>
											<li class="<?=($this->uri->segment(1)=="state")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/state/admin/stateList">
													 State
												</a>
											</li>
											<li class="<?=($this->uri->segment(1)=="zip")?'nav-active':''?>">
												<a href="<?php echo $this->config->item('base_url');?>index.php/zip/admin/zipList">
													 Zip
												</a>
											</li>
										</ul>
									</li>
									
									<li class="<?=($this->uri->segment(1)=="order")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/order/admin" title="Orders">
											<i class="fa fa-reorder"></i>
											<span>Orders</span>
										</a>
									</li>									
											
									<li class="<?=($this->uri->segment(1)=="coupons")?'nav-active':''?>">
										<a href="<?php echo $this->config->item('base_url');?>index.php/coupons/admin" title="Coupons">
											<i class="fa fa-tags" aria-hidden="true"></i>
											<span>Coupons</span>
										</a>
									</li>-->
									<?php
									break;									
									
									}
									?>				
									
								</ul>
							</nav>
				
							
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->