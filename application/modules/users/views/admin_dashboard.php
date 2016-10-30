<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
        <div class="right-wrapper pull-right">
		</div>
	</header>
	<div class="row">
			
			<!-- start: page -->
					<section class="panel">
						<div class="panel-body">
						<h2 class="panel-title">DASHBOARD</h2>
							</div>
							<div class="row">
								<div class="col-md-12">
									<img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/superadmin_dashboard.png" style="width: 100%!important;">
								</div>
 							</div>
					</section>
 					<!-- end: page -->
			<div class="clearfix"></div>
<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
