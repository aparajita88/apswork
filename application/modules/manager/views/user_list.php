<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title"><?php echo $table_heading; ?></h2></div>					
			<div class="panel-body panel_body_top">
					<div class="form-group sub_text1 selUser">
					    <select class="fform-control selection2">
                          <option value="0">Select Client</option>
                          <?php 
                          	foreach($userlist as $value) {
					             echo '<option value="'.base64_encode(base64_encode($value['company_id'])).'">'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
				            }
                          ?>
                        </select>
					</div>
			</div>
	</section>		
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
	$(".selection2").change(function(){
		var id = $(this).val();
		url = js_site_url+"index.php/manager/all_bills/"+id;
		window.location.href = url;
	});
</script>