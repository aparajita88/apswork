<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 


<section role="main" class="content-body">
	<header class="page-header">
		<h2> Dashboard</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>
			</ol>
</div>
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
	



<section class="panel">
							<header class="panel-heading">  
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title"> Reply Complaints</h2>
							</header>
							<div class="panel-body">
								
								
	<?php echo form_open("complaints/reply_complaints"); ?>
	
  Subject: <input type='text' name='subject' id='name' /><br />

  Message:<br /><br/>
  
   <textarea name='comment' id='comment'></textarea><br />

      <input type='submit' value='Submit' />  
    
      <?php echo form_close(); ?>
								
								
							</div>
								
						</section>
									<div class="clearfix"></div>


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>


		
		
