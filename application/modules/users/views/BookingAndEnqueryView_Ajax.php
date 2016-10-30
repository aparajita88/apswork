<div class="tab-head">
	<aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-capitalize">
		<h2>Bookings</h2>
	</aside>
	<aside class="col-xs-12 col-sm-9 col-md-9 col-lg-9 rightbtns text-uppercase send_chrome">
		<ul>
			<li>
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control mysearch" placeholder="Search by name, occassion, location">
						<span class="input-group-addon myaddon" id="basic-addon"><i class="fa fa-search"></i></span>
					</div>
				</div>
			</li>
			<li class="for_anu">
				<select class="myselect">
					<option>Type</option>
					<option onClick="javascript: top.location='#';">Booking</option>
					<option onClick="javascript: top.location='#';">Enquiry</option>
				</select>
			</li>
		</ul>
	</aside>
</div>
<div class="form-content">
	<div class="table-responsive table_responsive01">
		<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist text-capitalize">
			<thead>
				<th width="13%">
					<a href="#" title="Sort descending">
						vendor name
						<span class="sortable sorted-asc">
							<b class="caret"></b>
							<!--<b class="caret flipped"></b>-->
						</span>
					</a>
				</th>
				<th width="12%">
					<a href="#" title="Sort ascending">
						service area
						<span class="sortable">
							<b class="caret"></b>
							<!--<b class="caret flipped"></b>-->
						</span>
					</a>
				</th>
				<th width="15%">
					<a href="#" title="Sort ascending">
						service speciality
						<span class="sortable">
							<b class="caret"></b>
							<!--<b class="caret flipped"></b>-->
						</span>
					</a>
				</th>
				<th width="17%">
					<a href="#" title="Sort ascending">
						last modified date
						<span class="sortable">
							<b class="caret"></b>
							<!--<b class="caret flipped"></b>-->
						</span>
					</a>
				</th>
				<th width="15%">
					<a href="#" title="Sort ascending">
						request date
						<span class="sortable">
							<b class="caret"></b>
							<!--<b class="caret flipped"></b>-->
						</span>
					</a>
				</th>
				<th width="8%">
					<a href="#" title="Sort ascending">
						status
						<span class="sortable">
							<b class="caret"></b>
							<!--<b class="caret flipped"></b>-->
						</span>
					</a>
				</th>
				<th width="19%">
					&nbsp;
				</th>
			</thead>
			<tbody class="text-capitalize">
				<?php 
				if(isset($equeryDetails) && count($equeryDetails)){
					foreach($equeryDetails as $key => $equeryDetail){ 
						$vendorName = (($equeryDetail['vendorCompany']!='')?$equeryDetail['vendorCompany']:$equeryDetail['vendorFName'].' '.$equeryDetail['vendorLName']);
						$partyId = base64_encode(base64_encode($equeryDetail['party_id']));
						$serviceId = base64_encode(base64_encode($equeryDetail['services_id']));
						$productId = base64_encode(base64_encode($equeryDetail['product_id']));
						$vendorId = base64_encode(base64_encode($equeryDetail['vendor_id']));
						$ServiceAreaId = base64_encode(base64_encode($equeryDetail['ServiceAreaId']));
						$serviceSpecialityId = base64_encode(base64_encode($equeryDetail['serviceSpecialityId']));
				?>
				<tr>
					<td width="15%">
						<a data-target="#myModal_new_04" data-toggle="modal" href="#"><?php echo $vendorName; ?></a>
					</td>
					<td width="14%"><?php echo $equeryDetail['ServiceArea']; ?></td>
					<td width="18%"><?php echo $equeryDetail['serviceSpeciality']; ?></td>
					<td width="18%"><?php echo date('d/m/Y', strtotime($equeryDetail['created_on'])); ?></td>
					<td width="11%"><?php echo date('d/m/Y', strtotime($equeryDetail['created_on'])); ?></td>
					<td width="12%"><?php echo (($equeryDetail['serviceStatus']==1)? 'Confirmed' : 'Enquired'); ?></td>
					<td width="19%">
						<a href="#" data-toggle="modal" data-target="#myModal_new_05"><button type="button" onclick="showCommunication('<?php echo $partyId; ?>', '<?php echo $serviceId; ?>', '<?php echo $productId; ?>', '<?php echo $vendorId; ?>');" class="btn btn-default grea">Add Reply</button></a>
					<?php if($equeryDetail['serviceStatus']==0){ ?>
						<a href="#" data-toggle="modal" data-target="#booknow-modal" onclick="getProductForBookNow(<?php echo "'".$partyId."', '".$ServiceAreaId."', '".$serviceSpecialityId."', '".$vendorId."'"; ?>);"><button type="button" class="btn btn-default grea" style="margin-top:3px;">Book Now</button></a>
					<?php } ?>
					</td>
				</tr>
				<?php 
					}
				}else{
					echo '<tr>
							<td width="100%" colspan="7">
								You are not send any enquery Yet or no vendor are found asper your need.
							</td>
						   </tr>
						  ';
				} 
				?>
			</tbody>
		</table>
	</div>
	<div class="clearfix"></div>
</div>
