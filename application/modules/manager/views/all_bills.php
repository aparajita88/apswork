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
			<div class="panel-body panel_body_top">
				<table class="table table-bordered table-striped mb-none" id="datatable-default-new">
					<thead>
						<tr>
							<th><?php echo $table_header_date; ?></th>
							<th><?php echo $table_header_amount; ?></th>
							<th><?php echo $table_header_status = 'Status'; ?></th>
							<th><?php echo $table_header_action; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($invoice as $inv) { ?>
						<tr>
							<td>
							<?php
								$date=date_create($inv['publish_date']);
								echo date_format($date,"d-M-Y");
							?>
							</td>
							<td><?php setlocale(LC_MONETARY, 'en_IN'); echo money_format('%i', $inv['total_amount']) ?></td>
							<td><?php 
							$subtract_val = $inv['total_amount'] - $inv['paid_amount'];
							if($subtract_val == 0){
								echo "Paid";
							}else{
								echo "Unpaid";
							}
							?>
							</td>
							<td style="text-align: center;">
							<a href="<?php echo base_url(); ?>index.php/manager/generate_invoice_html_view/<?php echo base64_encode(base64_encode($inv['id'])); ?>/<?php echo $this->uri->segment(3); ?>" title="View" target="_blank">View</a>
							&nbsp;&nbsp;
							<a href="<?php echo base_url(); ?>index.php/manager/generate_invoice_pdf/<?php echo base64_encode(base64_encode($inv['id'])); ?>/<?php echo $this->uri->segment(3); ?>" title="Print" target="_blank">Print</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
	</section>		
</section>

<!-- Modal for details service only view end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
	$('#datatable-default-new').dataTable( {
	    "bSort": false
	});
	$(".selection2").change(function(){
		var id = $(this).val();
		url = js_site_url+"index.php/manager/all_bills/"+id;
		window.location.href = url;
	});
</script>