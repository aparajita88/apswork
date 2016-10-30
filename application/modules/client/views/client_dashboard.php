<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2> Dashboard</h2>

		
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
	<div class="row">
			<!---<div class="board">
		<div id="profile_detail">
				<aside class="col-md-3 col-lg-3">
					<img class="img-responsive" src="<?php echo $userData['image']; ?>" alt="Profile-image" title="Profile-image">
				</aside>
				<aside class="col-md-9 col-lg-9">
					<h4><?php echo $userData['FirstName'].' '.$userData['LastName']; ?></h4>
					<p><?php echo $userData['userEmail']; ?></p>
					<p><?php echo $userData['phone']; ?></p>
					<input type="button" class="btn btn-primary" value="Edit Profile" name="editprofile" id="edit-profile-btn">
				</aside>
			</div>--->
			<!-- start: page -->
				<section class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div id="calendar"></div>
									
								</div>
 							</div>
 							
 							
 							
 							
						</div>
					</section>
 					<!-- end: page -->
			<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
