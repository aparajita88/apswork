<?php if($reqtype=="Flight" || $reqtype=="Train" || $reqtype=="Bus" || $reqtype=="Cab"){?>


					<thead>
						<tr>
							<th>DATE OPENED</th>
							<th>REQUEST OPENED</th>
							<th>TRANSPORT TYPE</th>
							<th>FROM CITY</th>
							<th>TO CITY</th>
							<th>DEPARTURE DATE</th>
							<th>DATE CLOSED</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($reqlist)){
						foreach($reqlist as $service){
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Rejected</font>';
								$status = "Rejected";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td><?php echo ucfirst($service['transport_type']); ?></td>
						  <td><?php echo ucfirst($service['from_city']); ?></td>
						  <td><?php echo ucfirst($service['to_city']); ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['start_date'])); ?></td>
						  <td><?php echo $dateModified; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Open" data-srid='<?php echo $service['id']?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Rejected" data-srid='<?php echo $service['id']?>|travel' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $service['id']?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					}else{ ?>
					<tr><td colspan="9" align="center">No Data Available</td></tr>
					<?php }?>
					</tbody>
				
				<?php }else if($reqtype=="Hotel"){?>
				
					<thead>
						<tr>
							<th>DATE OPENED</th>
							<th>REQUEST OPENED</th>
							<th>LOCATION</th>
							<th>BUDGET</th>
							<th>CHECK IN</th>
							<th>CHECK OUT</th>
							<th>STAR</th>
							<th>DATE CLOSED</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($reqlist)){
						foreach($reqlist as $service){
							$id=$service['Id'];
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Rejected</font>';
								$status = "Rejected";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td><?php echo ucfirst($service['location']); ?></td>
						  <td><?php echo $service['budget']; ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['check_in'])); ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['check_out'])); ?></td>
						  <td><?php echo $service['hotel_type']; ?></td>
						  <td><?php echo $dateModified; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Open" data-srid='<?php echo $id?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Rejected" data-srid='<?php echo $id?>|hotel' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $id?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					} ?>
					</tbody>
				
				<?php }else if($reqtype=="Movie"){?>
				
					<thead>
						<tr>
							<th>DATE OPENED</th>
							<th>REQUEST OPENED</th>
							<th>NAME</th>
							<th>LOCATION</th>
							<th>DATE</th>
							<th>START TIME</th>
							<th>PERSON</th>
							<th>DATE CLOSED</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($reqlist)){
						foreach($reqlist as $service){
							$id=$service['Id'];
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Rejected</font>';
								$status = "Rejected";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td><?php echo ucfirst($service['movie']); ?></td>
						  <td><?php echo $service['location']; ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['request_date'])); ?></td>
						  <td><?php echo $service['start_time']; ?></td>
						  <td><?php echo $service['no_of_person']; ?></td>
						  <td><?php echo $dateModified; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Open" data-srid='<?php echo $id?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Rejected" data-srid='<?php echo $id?>|booking' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $id?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					} ?>
					</tbody>
				
				<?php }else if($reqtype=="Restaurant"){?>
				
					<thead>
						<tr>
							<th>DATE OPENED</th>
							<th>REQUEST OPENED</th>
							<th>NAME</th>
							<th>LOCATION</th>
							<th>DATE</th>
							<th>FOOD ITEM</th>
							<th>ORDER TYPE</th>
							<th>PERSON</th>
							<th>DATE CLOSED</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($reqlist)){
						foreach($reqlist as $service){
							$id=$service['Id'];
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Rejected</font>';
								$status = "Rejected";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td><?php echo ucfirst($service['restaurant']); ?></td>
						  <td><?php echo $service['location']; ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['request_date'])); ?></td>
						  <td><?php echo $service['food_item']; ?></td>
						  <td><?php echo $service['food_type']; ?></td>
						  <td><?php echo $service['no_of_person']; ?></td>
						  <td><?php echo $dateModified; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Open" data-srid='<?php echo $id?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Rejected" data-srid='<?php echo $id?>|booking' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $id?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					} ?>
					</tbody>
				
				<?php }else if($reqtype=="Event"){?>
				
					<thead>
						<tr>
							<th>DATE OPENED</th>
							<th>REQUEST OPENED</th>
							<th>NAME</th>
							<th>LOCATION</th>
							<th>DATE</th>
							<th>PERSON</th>
							<th>DATE CLOSED</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($reqlist)){
						foreach($reqlist as $service){
							$id=$service['Id'];
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Rejected</font>';
								$status = "Rejected";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td><?php echo ucfirst($service['event']); ?></td>
						  <td><?php echo $service['location']; ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['request_date'])); ?></td>
						  <td><?php echo $service['no_of_person']; ?></td>
						  <td><?php echo $dateModified; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Open" data-srid='<?php echo $id?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Rejected" data-srid='<?php echo $id?>|booking' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $id?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					} ?>
					</tbody>
				
				<?php }else if($reqtype=="Experience"){?>
				
					<thead>
						<tr>
							<th>DATE OPENED</th>
							<th>REQUEST OPENED</th>
							<th>NAME</th>
							<th>LOCATION</th>
							<th>DATE</th>
							<th>PERSON</th>
							<th>DATE CLOSED</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($reqlist)){
						foreach($reqlist as $service){
							$id=$service['Id'];
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Rejected</font>';
								$status = "Rejected";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td><?php echo ucfirst($service['experience']); ?></td>
						  <td><?php echo $service['location']; ?></td>
						  <td><?php echo date('d/m/Y',strtotime($service['request_date'])); ?></td>
						  <td><?php echo $service['no_of_person']; ?></td>
						  <td><?php echo $dateModified; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Open" data-srid='<?php echo $id?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Rejected" data-srid='<?php echo $id?>|booking' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $id?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					} ?>
					</tbody>
				
				<?php }?>
<script type="text/javascript">
//jQuery section for details service view start here
$(function() {
	$('a[id^="openBtnAction_"]').click(function(){
		console.log($(this).data("srid"));
		var serviceId = $(this).data("srid");
		var reqtype='<?php echo $reqtype;?>';
		var url = '<?php echo base_url(); ?>';
		if (serviceId != '') {
			$.ajax({
			 method: "POST",
			 url: url+"index.php/concierge/getServiceRequestDetails",
			 data: { serviceId: serviceId,reqtype:reqtype },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
		        
				$("#price").css("border","1px solid #ccc");
				$("#price").val("");
				$("#rid").val("");
				$("#rid").val(serviceId);
				$("#comid").val("");
				$("#comid").val(data[0].company_id);
				$("#appreqtype").val(reqtype);
				$("#serviceDesc").val("");
				$("#serviceDesc").val(data[0].details);
				$("#appreqticket").val(data[0].ticketId);
				$('#requestby').val("");
				$('#requestby').val(data[0].requested_by);
				$('#conceirge_type').html("");

				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
					$('#conceirge_type').html("<label><b>Conceirge Type: </b>"+data[0].conceirge_type+"</label>");
				}else if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
					$('#conceirge_type').html("<label><b>Booking Type: </b>"+data[0].booking_type+"</label>");
				}
				else if(reqtype=='Hotel'){
					$('#conceirge_type').html("<label><b>Conceirge Type: </b>Hotel</label>");
				}
				
				$('#conceirge_det').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
					$('#conceirge_det').html("<label><b>Conceirge Details: </b>"+data[0].details+"</label>");
				}
				
				$('#transport_type').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].transport_type){
					$('#transport_type').html("<label><b>Transport Type: </b>"+data[0].transport_type+"</label>");	
				}
			}
				$('#countrystatus').html("");
				if(reqtype=='Flight'){
					if(data[0].countrystatus!=""){
					 $('#countrystatus').html("<label><b>Type: </b>"+data[0].countrystatus+"</label>");
				    }
				}else if(reqtype=="Hotel"){
					if(data[0].country_status!=""){
					 	$('#countrystatus').html("<label><b>Type: </b>"+data[0].country_status+"</label>");
				    }	
				}
				
				$('#direction').html("");
				if(reqtype=='Flight'){
					if(data[0].direction == 0){
					$('#direction').html("<label><b>Direction: </b> One way</label>");	
				}else if(data[0].direction == 1){
					$('#direction').html("<label><b>Direction: </b> Round trip</label>");
				}else if (data[0].direction == 2) {
					$('#direction').html("<label><b>Direction: </b> Multi City/Stop Over</label>");
				}
				}
				
				$('#start_date').html("");
			if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].start_date != "0000-00-00"){
					$('#start_date').html("<label><b>Start Date: </b>"+data[0].start_date+"</label>");	
				}
			}
			$('#end_date').html("");
			if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				
				if(data[0].end_date != "0000-00-00"){
					$('#end_date').html("<label><b>End Date: </b>"+data[0].end_date+"</label>");	
				}
			}
			$('#transport_from_city').html("");
			if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				
				if(data[0].from_city != ""){
					$('#transport_from_city').html("<label><b>From City: </b>"+data[0].from_city+"</label>");	
				}
			}
                $('#transport_to_city').html("");
                if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].to_city != ""){
					$('#transport_to_city').html("<label><b>From City: </b>"+data[0].to_city+"</label>");	
				}
			}
				$('#total_passengers').html("");
            if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].total_passengers != ""){
					$('#total_passengers').html("<label><b>Total Passenger: </b>"+data[0].passengerdt+"</label>");	
				}
			}
			else if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
				if(data[0].no_of_person != ""){
                  $('#total_passengers').html("<label><b>No of Person: </b>"+data[0].no_of_person+"</label>");	
              }
			}else if(reqtype=="Hotel"){
				if(data[0].room_details != ""){
				$('#total_passengers').html("<label><b>Booking Details: </b><br>"+data[0].roomdt+"</label>");	
			}
			}
			else if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
                  $('#total_passengers').html("<label><b>No of Person: </b>"+data[0].no_of_person+"</label>");	
			}
			$('#booking_name').html("");
			if(reqtype=='Movie'){
				if(data[0].movie!=""){
					$('#booking_name').html("<label><b>Movie: </b>"+data[0].movie+"</label>");
				}
				
			}else if(reqtype=='Restaurant'){
				if(data[0].restaurant!=""){
					$('#booking_name').html("<label><b>Restaurant: </b>"+data[0].restaurant+"</label>");
				}
			}else if(reqtype=='Event'){
				if(data[0].event!=""){
					$('#booking_name').html("<label><b>Event: </b>"+data[0].event+"</label>");
				}
			}else if(reqtype=='Experience'){
				if(data[0].experience!=""){
					$('#booking_name').html("<label><b>Event: </b>"+data[0].experience+"</label>");
				}
			}
			$("#booking_location").html("");
			if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
				if(data[0].location!=""){
					$("#booking_location").html("<label><b>Location: </b>"+data[0].location+"</label>");	
				}
			}else if(reqtype=='Hotel'){
				if(data[0].location!=""){
					$("#booking_location").html("<label><b>Location: </b>"+data[0].location+"</label>");	
				}
			}
			$("#booking_date").html("");
			if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
				
				if(data[0].request_date!="0000-00-00"){
					$("#booking_date").html("<label><b>Request Date: </b>"+data[0].request_date+"</label>");	
				}
			}
			$("#booking_start_time").html("");
            if(reqtype=='Movie'){
            	if(data[0].start_time!=""){
            		$("#booking_start_time").html("<label><b>Start Time: </b>"+data[0].start_time+"</label>");
            	}
            	
            }
            $("#food_item").html("");
            if(reqtype=="Restaurant"){
            	if(data[0].food_item != ""){
					$('#food_item').html("<label><b>Food Item: </b>"+data[0].food_item+"</label>");	
				}
            }
            $("#food_type").html("");
            if(reqtype=="Restaurant"){
            	if(data[0].food_type != ""){
					$('#food_type').html("<label><b>Food Item: </b>"+data[0].food_type+"</label>");	
				}
            }
            $("#check_in").html("");
            if(reqtype=="Hotel"){
            	if(data[0].check_in!="0000-00-00"){
            		$('#check_in').html("<label><b>Check In: </b>"+data[0].check_in+"</label>");
            	}
            }
            $('#check_out').html("");
            if(reqtype=="Hotel"){
            	if(data[0].check_out!="0000-00-00"){
            		$('#check_out').html("<label><b>Check In: </b>"+data[0].check_out+"</label>");
            	}
            }
            $('#no_of_night').html("");
            if(reqtype=="Hotel"){
            	if(data[0].no_of_night!=""){
            		$('#no_of_night').html("<label><b>No Of Night: </b>"+data[0].no_of_night+"</label>");
            	}
            }
				$('#class').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].class != ""){
					$('#class').html("<label><b>Class: </b>"+data[0].class+"</label>");	
				}
			}
				$('#airline').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].airline != ""){
					$('#airline').html("<label><b>Airline: </b>"+data[0].airline+"</label>");	
				}
			}
				$('#cab').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].cab != ""){
					$('#cab').html("<label><b>Cab: </b>"+data[0].cabnm+"</label>");	
				}
			}
				$('#budget').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab' || reqtype=='Hotel'){
				if(data[0].budget != ""){
					$('#budget').html("<label><b>Budget: </b>"+data[0].budget+"</label>");	
				}
			}
				$('#approxtime').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].budget != ""){
					$('#approxtime').html("<label><b>Approx Time: </b>"+data[0].approxtime+"</label>");	
				}
			}
				$('#ticketId').html("");
				if(data[0].ticketId != ""){
					$('#ticketId').html("<label><b>Ticket No: </b>"+data[0].ticketId+"</label>");	
				}
								
				$('#hotel_type').html("");
				if(reqtype=='Hotel'){
					if(data[0].hotel_type != ""){
						$('#hotel_type').html("<label><b>Hotel Type: </b>"+data[0].hotel_type+" Star</label>");	
				    }
				}
				
								
				$('#viewServiceRequestModal').modal('show');
				
			 },
			 error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			 },
			 complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			 }
			});
		}
	});
	$('#submitData').click(function(){
		var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
		var url = '<?php echo base_url(); ?>';
		var requestId = $('#rid').val();
		var comid = $('#comid').val();
		var userId = $('#uid').val();
		var price = $("#price").val();
		var serviceDesc = $("#serviceDesc").val();
		var reqtype=$("#appreqtype").val();
		var ticketid=$("#appreqticket").val();
        var requestby=$('#requestby').val();
        $("#message").html('<div><img src="'+url+'assets/uploads/images/ajax-loader.gif" alt=""/></div>');
		if (price == "") {
			$("#price").css("border","1px solid red");
			return false;
		}else if(!numberRegex.test(price)){
			alert('Enter Numbers only');
			$("#price").css("border","1px solid red");
			$("#price").val("");
			return false;
		} else{
			$("#price").css("border","1px solid #ccc");
			$.ajax({
			 method: "POST",
			 url: url+"index.php/concierge/approveServiceRequestDetails",
			 data: { requestId: requestId, userId: userId, comid: comid, price: price, serviceDesc: serviceDesc,reqtype:reqtype, ticketid:ticketid, requestby:requestby  },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				$("#message").html('<div style="margin-top:18px;" class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Success!</strong> The Request is Approved.</div>');
				window.setTimeout(function(){location.reload()},3000);
			 },
			 error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			 },
			 complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			 }
			});
		}
	});
	$('a[id^="closeBtnAction_"]').click(function(){
		var r = confirm('Are you sure you want to reject the service request');
		if (r == true) {
			console.log($(this).data("srid"));
			var expsrid=$(this).data("srid").split('|');
			var serviceId = expsrid[0];
			var reqtype=expsrid[1];
			var url = '<?php echo base_url(); ?>';	
			$.ajax({
			 method: "POST",
			 url: url+"index.php/concierge/rejectServiceRequestDetails",
			 data: { serviceId: serviceId, reqtype:reqtype },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				location.reload();
			 },
			 error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			 },
			 complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			 }
		});
		}	
	});	
	$('a[id^="viewBtnAction_"]').click(function(){
		var serviceId = $(this).data("srid");
		var status = $(this).data("status");
		var url = '<?php echo base_url(); ?>';
		var reqtype='<?php echo $reqtype;?>';
		if (serviceId != '') {
		$.ajax({
			 method: "POST",
			 url: url+"index.php/concierge/getServiceRequestDetails",
			 data: { serviceId: serviceId,reqtype:reqtype },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				
				$('#conceirge_type_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
					$('#conceirge_type_view').html("<label><b>Conceirge Type: </b>"+data[0].conceirge_type+"</label>");
				}else if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
					$('#conceirge_type_view').html("<label><b>Booking Type: </b>"+data[0].booking_type+"</label>");
				}
				else if(reqtype=='Hotel'){
					$('#conceirge_type_view').html("<label><b>Conceirge Type: </b>Hotel</label>");
				}
				
				$('#conceirge_det_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
					$('#conceirge_det_view').html("<label><b>Conceirge Details: </b>"+data[0].details+"</label>");
				}
				
				$('#transport_type_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].transport_type){
					$('#transport_type_view').html("<label><b>Transport Type: </b>"+data[0].transport_type+"</label>");	
				}
			}
				$('#countrystatus_view').html("");
				if(reqtype=='Flight'){
					if(data[0].countrystatus!=""){
					 $('#countrystatus_view').html("<label><b>Type: </b>"+data[0].countrystatus+"</label>");
				    }
				}else if(reqtype=="Hotel"){
					if(data[0].country_status!=""){
					 	$('#countrystatus_view').html("<label><b>Type: </b>"+data[0].country_status+"</label>");
				    }	
				}
				
				$('#direction_view').html("");
				if(reqtype=='Flight'){
					if(data[0].direction == 0){
					$('#direction_view').html("<label><b>Direction: </b> One way</label>");	
				}else if(data[0].direction == 1){
					$('#direction_view').html("<label><b>Direction: </b> Round trip</label>");
				}else if (data[0].direction == 2) {
					$('#direction_view').html("<label><b>Direction: </b> Multi City/Stop Over</label>");
				}
				}
				
				$('#start_date_view').html("");
			if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].start_date != "0000-00-00"){
					$('#start_date_view').html("<label><b>Start Date: </b>"+data[0].start_date+"</label>");	
				}
			}
			$('#end_date_view').html("");
			if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				
				if(data[0].end_date != "0000-00-00"){
					$('#end_date_view').html("<label><b>End Date: </b>"+data[0].end_date+"</label>");	
				}
			}
			$('#transport_from_city_view').html("");
			if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				
				if(data[0].from_city != ""){
					$('#transport_from_city_view').html("<label><b>From City: </b>"+data[0].from_city+"</label>");	
				}
			}
                $('#transport_to_city_view').html("");
                if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].to_city != ""){
					$('#transport_to_city_view').html("<label><b>From City: </b>"+data[0].to_city+"</label>");	
				}
			}
				$('#total_passengers_view').html("");
            if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].total_passengers != ""){
					$('#total_passengers_view').html("<label><b>Total Passenger: </b>"+data[0].passengerdt+"</label>");	
				}
			}
			else if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
				if(data[0].no_of_person != ""){
                  $('#total_passengers_view').html("<label><b>No of Person: </b>"+data[0].no_of_person+"</label>");	
              }
			}else if(reqtype=="Hotel"){
				if(data[0].room_details != ""){
				$('#total_passengers_view').html("<label><b>Booking Details: </b><br>"+data[0].roomdt+"</label>");	
			}
			}
			else if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
                  $('#total_passengers_view').html("<label><b>No of Person: </b>"+data[0].no_of_person+"</label>");	
			}
			$('#booking_name_view').html("");
			if(reqtype=='Movie'){
				if(data[0].movie!=""){
					$('#booking_name_view').html("<label><b>Movie: </b>"+data[0].movie+"</label>");
				}
				
			}else if(reqtype=='Restaurant'){
				if(data[0].restaurant!=""){
					$('#booking_name_view').html("<label><b>Restaurant: </b>"+data[0].restaurant+"</label>");
				}
			}else if(reqtype=='Event'){
				if(data[0].event!=""){
					$('#booking_name_view').html("<label><b>Event: </b>"+data[0].event+"</label>");
				}
			}else if(reqtype=='Experience'){
				if(data[0].experience!=""){
					$('#booking_name_view').html("<label><b>Event: </b>"+data[0].experience+"</label>");
				}
			}
			$("#booking_location_view").html("");
			if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
				if(data[0].location!=""){
					$("#booking_location_view").html("<label><b>Location: </b>"+data[0].location+"</label>");	
				}
			}else if(reqtype=='Hotel'){
				if(data[0].location!=""){
					$("#booking_location_view").html("<label><b>Location: </b>"+data[0].location+"</label>");	
				}
			}
			$("#booking_date_view").html("");
			if(reqtype=='Movie' || reqtype=='Restaurant' || reqtype=='Event' || reqtype=='Experience'){
				
				if(data[0].request_date!="0000-00-00"){
					$("#booking_date_view").html("<label><b>Request Date: </b>"+data[0].request_date+"</label>");	
				}
			}
			$("#booking_start_time_view").html("");
            if(reqtype=='Movie'){
            	if(data[0].start_time!=""){
            		$("#booking_start_time_view").html("<label><b>Start Time: </b>"+data[0].start_time+"</label>");
            	}
            	
            }
            $("#food_item_view").html("");
            if(reqtype=="Restaurant"){
            	if(data[0].food_item != ""){
					$('#food_item_view').html("<label><b>Food Item: </b>"+data[0].food_item+"</label>");	
				}
            }
            $("#food_type_view").html("");
            if(reqtype=="Restaurant"){
            	if(data[0].food_type != ""){
					$('#food_type_view').html("<label><b>Food Item: </b>"+data[0].food_type+"</label>");	
				}
            }
            $("#check_in_view").html("");
            if(reqtype=="Hotel"){
            	if(data[0].check_in!="0000-00-00"){
            		$('#check_in_view').html("<label><b>Check In: </b>"+data[0].check_in+"</label>");
            	}
            }
            $('#check_out_view').html("");
            if(reqtype=="Hotel"){
            	if(data[0].check_out!="0000-00-00"){
            		$('#check_out_view').html("<label><b>Check In: </b>"+data[0].check_out+"</label>");
            	}
            }
            $('#no_of_night_view').html("");
            if(reqtype=="Hotel"){
            	if(data[0].no_of_night!=""){
            		$('#no_of_night_view').html("<label><b>No Of Night: </b>"+data[0].no_of_night+"</label>");
            	}
            }
				$('#class_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].class != ""){
					$('#class_view').html("<label><b>Class: </b>"+data[0].class+"</label>");	
				}
			}
				$('#airline_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].airline != ""){
					$('#airline_view').html("<label><b>Airline: </b>"+data[0].airline+"</label>");	
				}
			}
				$('#cab_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].cab != ""){
					$('#cab_view').html("<label><b>Cab: </b>"+data[0].cabnm+"</label>");	
				}
			}
				$('#budget_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab' || reqtype=='Hotel'){
				if(data[0].budget != ""){
					$('#budget_view').html("<label><b>Budget: </b>"+data[0].budget+"</label>");	
				}
			}
				$('#approxtime_view').html("");
				if(reqtype=='Flight' || reqtype=='Bus' || reqtype=='Train' || reqtype=='Cab'){
				if(data[0].budget != ""){
					$('#approxtime_view').html("<label><b>Approx Time: </b>"+data[0].approxtime+"</label>");	
				}
			}
				$('#ticketId_view').html("");
				if(data[0].ticketId != ""){
					$('#ticketId_view').html("<label><b>Ticket No: </b>"+data[0].ticketId+"</label>");	
				}
								
				$('#hotel_type_view').html("");
				if(reqtype=='Hotel'){
					if(data[0].hotel_type != ""){
						$('#hotel_type_view').html("<label><b>Hotel Type: </b>"+data[0].hotel_type+" Star</label>");	
				    }
				}
				$("#price_view").html("");
				if(data[0].price != ""){
					$('#price_view').html("<label><b>Price: </b>"+data[0].price+" /-</label>");
				}
				$("#status_view").html("");
				if (status == 'closed') {
					//code
					$('#status_view').html('<label><b>Status: </b><font color="#00b300">Closed</font></label>');
				}else if (status == 'rejected') {
					//code
					$('#status_view').html('<label><b>Status: </b><font color="#ff0000">Rejected</font></label>');
				}					
				$('#requestModalView').modal('show');
			 },
			 error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			 },
			 complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			 }
		});
		}
	});
});
function fnconrequest(val){
	var url='<?php echo base_url();?>';
    $.ajax({
			 method: "POST",
			 url: url+"index.php/concierge/getServiceRequestList",
			 data: { reqtype: val },
			 success: function(data) {
			 	//alert(data);
			 	$('#datatable-default').html(data);
			 }
			});
}
//jQuery section for details service view end here
</script>