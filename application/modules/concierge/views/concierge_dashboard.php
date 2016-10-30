<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title"><?php echo $table_heading; ?></h2></div>					
			<div class="panel-body panel_body_top">
			<div class="form-group">
			<div class="col-md-4">
			<select class="form-control" name="request_concierge_type" onchange="fnconrequest(this.value)">
			<option value="" class="opt-root">Select Request Type</option>
			<optgroup label="Travel Plan" class="opt-parent">
			<option class="opt-child" value="Flight" selected>Flight</option>
			<option class="opt-child" value="Hotel">Hotel</option>
			<option class="opt-child" value="Train">Train</option>
			<option class="opt-child" value="Bus">Bus</option>
			<option class="opt-child" value="Cab">Cab</option>
			</optgroup>
			<optgroup label="Booking" class="opt-parent">
			<option class="opt-child" value="Movie">Movie</option>
			<option class="opt-child" value="Restaurant">Restaurant</option>
			<option class="opt-child" value="Event">Event</option>
			<option class="opt-child" value="Experience">Experience</option>
			</optgroup>
			</select>
			</div>
			</div>
			
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
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
					if(!empty($serviceRequests)){
						foreach($serviceRequests as $service){
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not Yet' );
							$dateModified = (($service['dateModified'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateModified'])) : 'Not Yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">CANCELLED</font>';
								$status = "Cancel";
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
							<a href="javascript:void(0);" title="Cancel Request" data-srid='<?php echo $service['id']?>|travel' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
							<?php }else{?>
							<a href="javascript:void(0);" title="View" data-srid='<?php echo $service['id']?>' data-status="<?php echo lcfirst($status); ?>" id="viewBtnAction_<?php echo $count;?>"><i class="fa fa-external-link" style="font-size:18px; color: blue;"></i></a>							
							<?php }?>
						  </td>
						</tr>
					<?php
						$count++;
						}
					} ?>
					</tbody>
				</table>
				
			</div>
	</section>		
</section>
<!-- Modal for details service view with form start here-->
<div class="modal fade" id="viewServiceRequestModal" role="dialog">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
	  		
		<div class="panel-body">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="panel-title">Service Request Details</h2>
			<div class="modal-wrapper">
				<div class="modal-text">
					<form class="form-horizontal mb-sm" id="demo-form">
						<p id="conceirge_type"></p>
						<p id="conceirge_det"></p>
						<p id="transport_type"></p>
						<p id="countrystatus"></p>
						<p id="transport_from_city"></p>
						<p id="transport_to_city"></p>
						<p id="direction"></p>
						<p id="start_date"></p>
						<p id="end_date"></p>
						<p id="booking_name"></p>
						<p id="booking_location"></p>
						<p id="booking_date"></p>
						<p id="booking_start_time"></p>
						<p id="food_item"></p>
						<p id="food_type"></p>
						<p id="total_passengers"></p>
						<p id="class"></p>
						<p id="airline"></p>
						<p id="cab"></p>
						<p id="budget"></p>
						<p id="check_in"></p>
						<p id="check_out"></p>
						<p id="no_of_night"></p>
						<p id="approxtime"></p>
						<p id="hotel_type"></p>
						<p id="ticketId"></p>
						<div class="form-group mt-sm">
							<label class="col-sm-3 control-label"><b>Price</b></label>
							<div class="col-sm-6">
								<input type="text" id="price" required="" placeholder="Enter Price..." class="form-control" name="name">
							</div>
						</div>
						<input type="hidden" value="<?php echo $this->session->userdata("userId"); ?>" id="uid">
						<input type="hidden" value="" id="rid">
						<input type="hidden" value="" id="comid">
						<input type="hidden" value="" id="serviceDesc">
						<input type="hidden" value="" id="appreqtype">
						<input type="hidden" value="" id="appreqticket">
						<input type="hidden" value="" id="requestby">
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="button" class="btn btn-success" id="submitData">Close Request</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			<p id="message"></p>
					
		</div>
		
	
  </div>
</div>
<!-- Modal for details service view with form end here-->

<!-- Modal for details service only view start here-->
<div class="modal fade" id="requestModalView" role="dialog">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
	  		
		<div class="panel-body">
		
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="panel-title">Service Request Details</h2>
		
			<div class="modal-wrapper">
				<div class="modal-text">
					<form class="form-horizontal mb-sm" id="demo-form">
						<p id="conceirge_type_view"></p>
						<p id="conceirge_det_view"></p>
						<p id="transport_type_view"></p>
						<p id="countrystatus_view"></p>
						<p id="transport_from_city_view"></p>
						<p id="transport_to_city_view"></p>
						<p id="direction_view"></p>
						<p id="start_date_view"></p>
						<p id="end_date_view"></p>
						<p id="booking_name_view"></p>
						<p id="booking_location_view"></p>
						<p id="booking_date_view"></p>
						<p id="booking_start_time_view"></p>
						<p id="food_item_view"></p>
						<p id="food_type_view"></p>
						<p id="total_passengers_view"></p>
						<p id="class_view"></p>
						<p id="airline_view"></p>
						<p id="cab_view"></p>
						<p id="budget_view"></p>
						<p id="check_in_view"></p>
						<p id="check_out_view"></p>
						<p id="no_of_night_view"></p>
						<p id="approxtime_view"></p>
						<p id="hotel_type_view"></p>
						<p id="ticketId_view"></p>
						<p id="price_view"></p>
						<p id="status_view"></p>
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			<p id="message"></p>
				
		</div>
		
	
  </div>
</div>
<!-- Modal for details service only view end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<!-- jQuery code start here-->
<script type="text/javascript">
//jQuery section for details service view start here
$(function() {
	$(document).on('click','a[id^="openBtnAction_"]',function(){
		console.log($(this).data("srid"));
		var serviceId = $(this).data("srid");
		var reqtype='Flight';
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
				$('#conceirge_type').html("<label><b>Conceirge Type: </b>"+data[0].conceirge_type+"</label>");
				$('#conceirge_det').html("");
				$('#conceirge_det').html("<label><b>Conceirge Details: </b>"+data[0].details+"</label>");
				$('#transport_type').html("");
				if(data[0].transport_type){
					$('#transport_type').html("<label><b>Transport Type: </b>"+data[0].transport_type+"</label>");	
				}
				$('#countrystatus').html("");
				if(data[0].countrystatus!=""){
					$('#countrystatus').html("<label><b>Type: </b>"+data[0].countrystatus+"</label>");
				}
				$('#direction').html("");
				if(data[0].direction == 0){
					$('#direction').html("<label><b>Direction: </b> One way</label>");	
				}else if(data[0].direction == 1){
					$('#direction').html("<label><b>Direction: </b> Round trip</label>");
				}else if (data[0].direction == 2) {
					$('#direction').html("<label><b>Direction: </b> Multi City/Stop Over</label>");
				}
				$('#start_date').html("");
				if(data[0].start_date != "0000-00-00"){
					$('#start_date').html("<label><b>Start Date: </b>"+data[0].start_date+"</label>");	
				}
				$('#end_date').html("");
				if(data[0].end_date != "0000-00-00"){
					$('#end_date').html("<label><b>End Date: </b>"+data[0].end_date+"</label>");	
				}
				$('#transport_from_city').html("");
				if(data[0].from_city != ""){
					$('#transport_from_city').html("<label><b>From City: </b>"+data[0].from_city+"</label>");	
				}
                $('#transport_to_city').html("");
				if(data[0].to_city != ""){
					$('#transport_to_city').html("<label><b>From City: </b>"+data[0].to_city+"</label>");	
				}
				$('#total_passengers').html("");
				if(data[0].total_passengers != ""){
					$('#total_passengers').html("<label><b>Total Passenger: </b>"+data[0].passengerdt+"</label>");	
				}
				$("#booking_name").html("");
				$("#booking_location").html("");
				$("#booking_date").html("");
				$("#booking_start_time").html("");
				$("#food_item").html("");
				$("#food_type").html("");
				$("#check_in").html("");
				$("#check_out").html("");
				$("#no_of_night").html("");
				$('#class').html("");
				if(data[0].class != ""){
					$('#class').html("<label><b>Class: </b>"+data[0].class+"</label>");	
				}
				$('#airline').html("");
				if(data[0].airline != ""){
					$('#airline').html("<label><b>Airline: </b>"+data[0].airline+"</label>");	
				}
				$('#cab').html("");
				if(data[0].cab != ""){
					$('#cab').html("<label><b>Cab: </b>"+data[0].cabnm+"</label>");	
				}
				$('#budget').html("");
				if(data[0].budget != ""){
					$('#budget').html("<label><b>Budget: </b>"+data[0].budget+"</label>");	
				}
				$('#approxtime').html("");
				if(data[0].budget != ""){
					$('#approxtime').html("<label><b>Approx Time: </b>"+data[0].approxtime+"</label>");	
				}
				$('#ticketId').html("");
				if(data[0].ticketId != ""){
					$('#ticketId').html("<label><b>Ticket No: </b>"+data[0].ticketId+"</label>");	
				}
				
				$('#hotel_type').html("");
				if(data[0].hotel_type != ""){
					$('#hotel_type').html("<label><b>Hotel Type: </b>"+data[0].hotel_type+"</label>");	
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
			$("#message").html('<div><img src="'+url+'assets/uploads/images/ajax-loader.gif" alt=""/></div>');
			$.ajax({
			 method: "POST",
			 url: url+"index.php/concierge/approveServiceRequestDetails",
			 data: { requestId: requestId, userId: userId, comid: comid, price: price, serviceDesc: serviceDesc, reqtype:reqtype, ticketid:ticketid, requestby:requestby },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				$("#message").html('<div style="margin-top:18px;" class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Success!</strong> The Order is Approved.</div>');
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
	$(document).on('click','a[id^="closeBtnAction_"]',function(){
		var r = confirm('Are you sure you want to cancel the service request');
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
	$(document).on('click','a[id^="viewBtnAction_"]',function(){
		var serviceId = $(this).data("srid");
		var status = $(this).data("status");
		var url = '<?php echo base_url(); ?>';
		var reqtype='Flight';
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
				$('#conceirge_type_view').html("<label><b>Conceirge Type: </b>"+data[0].conceirge_type+"</label>");
				$('#conceirge_det_view').html("");
				$('#conceirge_det_view').html("<label><b>Conceirge Details: </b>"+data[0].details+"</label>");
				$('#transport_type_view').html("");
				if(data[0].transport_type){
					$('#transport_type_view').html("<label><b>Transport Type: </b>"+data[0].transport_type+"</label>");	
				}
				$('#countrystatus_view').html("");
				if(data[0].countrystatus!=""){
					$('#countrystatus_view').html("<label><b>Type: </b>"+data[0].countrystatus+"</label>");
				}
				$('#direction_view').html("");
				if(data[0].direction == 0){
					$('#direction_view').html("<label><b>Direction: </b> One way</label>");	
				}else if(data[0].direction == 1){
					$('#direction_view').html("<label><b>Direction: </b> Round trip</label>");
				}else if (data[0].direction == 2) {
					$('#direction_view').html("<label><b>Direction: </b> Multi City/Stop Over</label>");
				}
				$('#start_date_view').html("");
				if(data[0].start_date != "0000-00-00"){
					$('#start_date_view').html("<label><b>Start Date: </b>"+data[0].start_date+"</label>");	
				}
				$('#end_date_view').html("");
				if(data[0].end_date != "0000-00-00"){
					$('#end_date_view').html("<label><b>End Date: </b>"+data[0].end_date+"</label>");	
				}
				$('#transport_from_city_view').html("");
				if(data[0].from_city != ""){
					$('#transport_from_city_view').html("<label><b>From City: </b>"+data[0].from_city+"</label>");	
				}
                $('#transport_to_city_view').html("");
				if(data[0].to_city != ""){
					$('#transport_to_city_view').html("<label><b>From City: </b>"+data[0].to_city+"</label>");	
				}
				$('#total_passengers_view').html("");
				if(data[0].total_passengers != ""){
					$('#total_passengers_view').html("<label><b>Total Passenger: </b>"+data[0].passengerdt+"</label>");	
				}
				$("#booking_name_view").html("");
				$("#booking_location_view").html("");
				$("#booking_date_view").html("");
				$("#booking_start_time_view").html("");
				$("#food_item_view").html("");
				$("#food_type_view").html("");
				$('#class_view').html("");
				$("#check_in_view").html("");
				$("#check_out_view").html("");
				$("#no_of_night_view").html("");
				if(data[0].class != ""){
					$('#class_view').html("<label><b>Class: </b>"+data[0].class+"</label>");	
				}
				$('#airline_view').html("");
				if(data[0].airline != ""){
					$('#airline_view').html("<label><b>Airline: </b>"+data[0].airline+"</label>");	
				}
				$('#cab_view').html("");
				if(data[0].cab != ""){
					$('#cab_view').html("<label><b>Cab: </b>"+data[0].cabnm+"</label>");	
				}
				$('#budget_view').html("");
				if(data[0].budget != ""){
					$('#budget_view').html("<label><b>Budget: </b>"+data[0].budget+"</label>");	
				}
				$('#approxtime_view').html("");
				if(data[0].budget != ""){
					$('#approxtime_view').html("<label><b>Approx Time: </b>"+data[0].approxtime+"</label>");	
				}
				$('#ticketId_view').html("");
				if(data[0].ticketId != ""){
					$('#ticketId_view').html("<label><b>Ticket No: </b>"+data[0].ticketId+"</label>");	
				}
					
				$('#hotel_type_view').html("");
				if(data[0].hotel_type != ""){
					$('#hotel_type_view').html("<label><b>Hotel Type: </b>"+data[0].hotel_type+"</label>");	
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
<style>
.opt-child{
	padding: 10px;
	background: #dfdfdf; 
}
.opt-parent{
	padding: 10px;
	background: #cecece;
}
.opt-root{
	background: #dfdfdf; 
}
</style>