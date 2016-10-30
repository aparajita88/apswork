<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title">SMART CONCIERGE</h2></div>					
			<div class="panel-body panel_body_top">
				<h3>what can i help with ?</h3> 
                <div class="clickable_images">
                	<aside class="col-lg-6 text-center"><a href="<?php echo base_url();?>index.php/request/add_request_smartconcierge_traval_plan"><div class="roundshape1"><img src="<?php echo base_url();?>assets/admin1/images/img1.png" alt="img1" /><h4>travel plans</h4></div></a></aside>
                    <aside class="col-lg-6 text-center"><a href="<?php echo base_url();?>index.php/request/add_request_smartconcierge_booking"><div class="roundshape2"><img src="<?php echo base_url();?>assets/admin1/images/img2.png" alt="img2" /><h4>booking</h4></div></a></aside>
                </div>
                <div class="note2">
                	<p><span>note:<img src="<?php echo base_url();?>assets/admin1/images/chevron.png" alt="chevron" /></span>You can also call us at <strong>800-111-2222</strong> to avail smart conceirge services.</p>
                </div>
			</div>
	</section>		
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>