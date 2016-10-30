
	<!-- Modal content-->
	<div class="modal-content">
	<input type="hidden" id="party_id" value="<?php echo $partyDetail['party_id']; ?>" />
	<input type="hidden" id="service_id" value="<?php echo $service_id; ?>" />
	<input type="hidden" id="subService_id" value="<?php echo $subService_id; ?>" />
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title mytitle">Book Now</h4>
	  </div>
	  <div class="modal-body">
		<h3>Party Detail</h3>
		<div id="table1" class="table-responsive">
			<?php $vendorName = (($vendorDetail['userCompanyName']!='')?$vendorDetail['userCompanyName']:$vendorDetail['FirstName'].' '.$vendorDetail['LastName']); ?>
			<table width="100%" cellspacing="0" cellpadding="0" border="1">
				<tr>
					<td><span class="col-md-4 col-lg-4">Name</span> - <strong><?php echo $partyDetail['name']; ?></strong></td>
					<td><span class="col-md-4 col-lg-4">Occassion</span> - <strong><?php echo ucfirst($partyDetail['productCategoryName']); ?></strong></td>
				</tr>
				<tr>
					<td><span class="col-md-4 col-lg-4">Date & Time</span> - <strong><?php echo date('d/m/Y', strtotime($partyDetail['date'])).', '.$partyDetail['time']; ?></strong></td>
					<td><span class="col-md-4 col-lg-4">Location</span> - <strong><?php echo ucfirst($partyDetail['town_nm']); ?></strong></td>
				</tr>
				<tr>
					<td><span class="col-md-4 col-lg-4">Party Size</span> - <strong><?php echo 'Upto '.$partyDetail['party_size']; ?></strong></td>
					<td><span class="col-md-4 col-lg-4">Vendor Name</span> - <strong><?php echo ucfirst($vendorName); ?></strong></td>
				</tr>
			</table>
		</div>
		<div id="table2" class="table-responsive">
			<table width="100%" cellspacing="0" cellpadding="0" border="1" class="text-capitalize">
				<tr>
					<th width="20%">service name</th>
					<th width="20%">service speciality</th>
					<th width="20%">Product</th>
					<th width="10%">Price</th>
					<th width="10%">Discount</th>
					<th width="10%">Payable Price</th>
					<th width="10%"></th>
				</tr>
				<?php 
					if(isset($products) && count($products)){
						foreach($products as $key => $value){ 
							$price = ((int)$value['max_prize']-(((int)$value['max_prize']*(int)$value['discount'])/(int)100));
				?>
							<tr>
								<td width="20%"><?php echo ucfirst($service_name['productCategoryName']); ?></td>
								<td width="20%"><?php echo ucfirst($subService_name['productCategoryName']); ?></td>
								<td width="20%"><?php echo ucfirst($value['product_name']); ?></td>
								<td width="10%"><?php echo (((int)$value['discount']!=(int)0)?'<s>':'').'$'. $value['max_prize']; ?></s></td>
								<td width="10%"><?php echo (((int)$value['discount']!=(int)0)?$value['discount'].' %':'-'); ?></td>
								<td width="10%"><?php echo '$'. $price; ?></td>
								<td width="10%"><a href="Javascript:void(0)" class="btn btn-default" onclick="bookNow(<?php echo "'".$value['id']."', '".$subService_id."', '".$partyDetail['party_id']."'"; ?>);">Book Now</a></td>
							</tr>
				<?php 
						}
					}
				?>
			</table>
		</div>
	  </div>
	</div>
