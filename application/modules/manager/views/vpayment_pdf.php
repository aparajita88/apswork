<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
	<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
</header>
<section class="panel pthankyou">
<p>Thank You <br/>
You have successfully paid the amount</p>
<a href="<?php echo base_url();?>index.php/manager/payment_pdf_download/<?php echo $paymentId;?>">Click the link to down the payment Receipt</a>
</section>
</section>
	<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
	<style>
	.pthankyou{
		width: 100%;
		max-width: 700px;
		margin: 0 auto;
		text-align: center;
		font-size: 29px;
		line-height: 51px;
	}
	</style> 