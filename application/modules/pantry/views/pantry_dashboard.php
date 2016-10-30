<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title"><?php echo $table_heading; ?></h2></div>					
			<div class="panel-body panel_body_top">
				<table class="table table-bordered table-striped mb-none" id="datatable-default">
					<thead>
						<tr>
							<th><?php echo $table_header_date_opend; ?></th>
							<th><?php echo $table_header_request_from; ?></th>
							<th><?php echo $table_header_request_details; ?></th>
							<th><?php echo $table_header_date_closed; ?></th>
							<th><?php echo $table_header_status; ?></th>
							<th><?php echo $table_header_action; ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$count = 1;
					if(!empty($serviceRequests)){
						foreach($serviceRequests as $service){
							$dateAdded = (($service['dateAdded'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateAdded'])) : 'Not yet' );
							$dateApproved = (($service['dateApproved'] != "0000-00-00 00:00:00" ) ? date('d/m/Y',strtotime($service['dateApproved'])) : 'Not yet' );
							if((int)$service['is_approved'] == 0 ){ 
								$statusMsg = '<font color="#3366ff">Open</font>';
								$status = "Open";
							}elseif((int)$service['is_approved'] == 1 ){
								$statusMsg = '<font color="#00b300">Closed</font>';
								$status = "Closed";
							}else{
								$statusMsg = '<font color="#ff0000">Cancel</font>';
								$status = "Cancel";
							}
							
					?>
						<tr>
						  <td><?php echo $dateAdded; ?></td>
						  <td><?php echo ucfirst($service['company_name']); ?></td>
						  <td>
							<div class='col-md-12'>
								<div class="col-md-4"><b>Type</b></div><div class="col-md-5"><b>Details</b></div><div class="col-md-3"><b>Price</b></div>
						   </div>
							<hr>
							<?php if(!empty($service['order'])){
								//print_r($service['order']);
							$total_amount = 0;	
							?>
							<?php foreach($service['order'] as $data){$subprice=0;
								for($p=0;$p<count($data['order_total_price']);$p++){
									$subprice=$subprice+$data['order_total_price'][$p];
								}
							$total_amount = $total_amount + $subprice;	
							?>
							<div class="col-md-12">
								<div class="col-md-4"><?php echo $data['order_type']; ?></div><div class="col-md-5"><?php echo implode(',',$data['order_details']); ?><br/>(<?php echo implode(',',$data['order_qty']); ?>)</div><div class="col-md-3"><?php echo $subprice; ?>/-</div>
							</div>
							<?php } ?>
							<div class="col-md-12" style="border-top: 1px solid #ddd; margin-top: 15px;">
								<div class="col-md-4"></div><div class="col-md-5" style="text-align: right; font-weight: bold;">Total = </div><div class="col-md-3"><?php echo $total_amount; ?>/-</div>
							<?php } ?>
						  </div></td>
						  <td><?php echo $dateApproved; ?></td>
						  <td><?php echo $statusMsg; ?></td>
						  <td>
							<?php if((int)$service['is_approved'] == 0){ ?>
							<a href="javascript:void(0);" title="Close Order" data-srid='<?php echo $service['id']?>' data-count= '<?php echo $count;?>' id="openBtnAction_<?php echo $count;?>"><i class="fa fa-check-square-o" style="font-size:18px; color: green;"></i></a>
							<a href="javascript:void(0);" title="Cancel Order" data-srid='<?php echo $service['id']?>' data-count= '<?php echo $count;?>' id="closeBtnAction_<?php echo $count;?>"><i class="fa fa-ban" style="font-size:18px; color: red;"></i></a>
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
    <div class="modal-dialog modal-md">   
      <!-- Modal content-->
	  
		<div class="panel-body">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="panel-title">Order Details</h2>
			<div class="modal-wrapper">
				<div class="modal-text">
					<form class="form-horizontal mb-sm" id="demo-form">
						<p id="order_from"></p>
						<p id="order_opened"></p>
						<!-- <p id="order_closed"></p> -->
						<div>
							<label><b>Order details</b></label>
							<table class="table table-striped" id="tblGrid">
							  <thead id="tblHead">
								<tr>
								  <th>Type</th>
								  <th>Details</th>
								  <th>Price</th>
								</tr>
							  </thead>
							  <tbody id="tblBody"></tbody>
							</table>
						</div>
						<input type="hidden" value="<?php echo $this->session->userdata("userId"); ?>" id="uid">
						<input type="hidden" value="" id="rid">
						<input type="hidden" value="" id="comid">
						<input type="hidden" value="" id="totalPrice">
						<input type="hidden" value="" id="serviceDesc">
					</form>
				</div>
			</div>
			<div class="col-md-12 text-right">
					<button type="button" class="btn btn-success" id="submitData">Close Order</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>			
		</div>
	
  </div>
</div>
<!-- Modal for details service view with form end here-->

<!-- Modal for details service only view start here-->
<div class="modal fade" id="requestModalView" role="dialog">
    <div class="modal-dialog modal-md">   
      <!-- Modal content-->
	 
		<div class="panel-body">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="panel-title">Order Details</h2>
			<div class="modal-wrapper">
				<div class="modal-text">
					<form class="form-horizontal mb-sm" id="demo-form">
						<p id="order_from_view"></p>
						<p id="order_opened_view"></p>
						<p id="order_closed_view"></p>
						<div>
							<label><b>Order details</b></label>
							<table class="table table-striped" id="tblGrid">
							  <thead id="tblHead">
								<tr>
								  <th>Type</th>
								  <th>Details</th>
								  <th>Price</th>
								</tr>
							  </thead>
							  <tbody id="tblBodyView"></tbody>
							</table>
						</div>
						<p id="status_view"></p>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-right">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>			
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
		var url = '<?php echo base_url(); ?>';
		if (serviceId != '') {
			$.ajax({
			 method: "POST",
			 url: url+"index.php/pantry/getServiceRequestDetails",
			 data: { serviceId: serviceId },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				$("#rid").val('');
				$("#rid").val(data.id);
				$("#comid").val('');
				$("#comid").val(data.company_id);
				$("#totalPrice").val('');				
				$("#order_from").html("");
				if(data.company_name){
					$('#order_from').html("<label><b>Order from: </b>"+data.company_name+"</label>");	
				}
				$("#order_opened").html("");
				if(data.dateAdded != ""){
					$('#order_opened').html("<label><b>Order opened: </b>"+data.dateAdded+"</label>");	
				}
				//$("#order_closed").html("");
				//if(data.dateApproved != ""){
				//	$('#order_closed').html("<label><b>Order closed: </b>"+data.dateApproved+"</label>");	
				//}
				var tblData = '';
				var totalOrderPrice = 0;
				
				$.each(data.order, function(k, v) {

					tblData += '<tr>';
					tblData += '<td>'+v.order_type+'</td>';
					tblData += '<td>'+v.order_details+'</td>';
					tblData += '<td>'+v.order_total_price+'/-</td>';
					tblData += '</tr>';
					totalOrderPrice = (totalOrderPrice + v.order_total_price);
					/// do stuff
				});
				tblData += '<tr>';
				tblData += '<td></td>';
				tblData += '<td>Total = </td>';
				tblData += '<td>'+totalOrderPrice+'/-</td>';
				tblData += '</tr>';
				$("#tblBody").html('');
				$("#tblBody").html(tblData);
				$("#totalPrice").val(totalOrderPrice);
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
		var url = '<?php echo base_url(); ?>';
		var requestId = $('#rid').val();
		var comid = $('#comid').val();
		var userId = $('#uid').val();
		var totalPrice = $("#totalPrice").val();
		var serviceDesc = $("#serviceDesc").val();
		if (totalPrice == "") {
			return false;
		} else{
			$.ajax({
			 method: "POST",
			 url: url+"index.php/pantry/approveServiceRequestDetails",
			 data: { requestId: requestId, userId: userId, comid: comid, totalPrice: totalPrice, serviceDesc: serviceDesc },
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
	$(document).on('click','a[id^="viewBtnAction_"]',function(){
		var serviceId = $(this).data("srid");
		var status = $(this).data("status");
		var url = '<?php echo base_url(); ?>';
		if (serviceId != '') {
		$.ajax({
			 method: "POST",
			 url: url+"index.php/pantry/getServiceRequestDetails",
			 data: { serviceId: serviceId },
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				$("#order_from_view").html("");
				if(data.company_name){
					$('#order_from_view').html("<label><b>Order from: </b>"+data.company_name+"</label>");	
				}
				$("#order_opened_view").html("");
				if(data.dateAdded != ""){
					$('#order_opened_view').html("<label><b>Order opened: </b>"+data.dateAdded+"</label>");	
				}
				$("#order_closed_view").html("");
				if(data.dateApproved != ""){
					$('#order_closed_view').html("<label><b>Order closed: </b>"+data.dateApproved+"</label>");	
				}
				var tblData = '';
				var totalOrderPrice = 0;
				$.each(data.order, function(k, v) {
					tblData += '<tr>';
					tblData += '<td>'+v.order_type+'</td>';
				        tblData += '<td>'+v.order_details+'<br/>('+v.order_qty+')</td>';
					tblData += '<td>'+v.order_total_price+'/-</td>';
					tblData += '</tr>';
					totalOrderPrice = (totalOrderPrice + v.order_total_price);
					/// do stuff
				});
				tblData += '<tr>';
				tblData += '<td></td>';
				tblData += '<td>Total = </td>';
				tblData += '<td>'+totalOrderPrice+'/-</td>';
				tblData += '</tr>';
				$("#tblBodyView").html('');
				$("#tblBodyView").html(tblData);				
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
	$(document).on('click','a[id^="closeBtnAction_"]',function(){
		var r = confirm('Are you sure you want to cancel the pantry order');
		if (r == true) {
			console.log($(this).data("srid"));
			var expsrid=$(this).data("srid").split('|');
			var serviceId = expsrid[0];
			var reqtype=expsrid[1];
			var url = '<?php echo base_url(); ?>';	
			$.ajax({
			 method: "POST",
			 url: url+"index.php/pantry/rejectpantryRequestDetails",
			 data: { serviceId: serviceId },
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
});
//jQuery section for details service view end here
</script>
