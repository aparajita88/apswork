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
							<th><?php echo $table_header_date; ?></th>
							<th><?php echo $table_header_amount; ?></th>
							<!--<th><?php //echo $table_header_description; ?></th>-->
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
							<!-- <td></td> -->
							<td style="text-align: center;">
							<a href="<?php echo base_url(); ?>index.php/invoice/generate_invoice_html_view/<?php echo base64_encode(base64_encode($inv['id'])); ?>" title="View" target="_blank">View</a>
							&nbsp;&nbsp;
							<a href="<?php echo base_url(); ?>index.php/invoice/generate_invoice_pdf/<?php echo base64_encode(base64_encode($inv['id'])); ?>" title="Print" target="_blank">Print</a>
							<?php if(!empty($discount)){?>
							<?php }else{?>
							&nbsp;&nbsp;
							<a href="javascript:void(0);" id="dis_<?= $inv['id']; ?>" data-inv="<?= $inv['id']; ?>"  title="Discount">Discount</a>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
	</section>		
</section>
<!-- Modal for details service view with form start here-->
<div class="modal fade" id="discountRequestModal" role="dialog">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
	  <section class="panel">
		<header class="panel-heading">
			<button type="button" class="close closeModal" data-dismiss="modal">&times;</button>
			<h2 class="panel-title">Request for discount</h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-text">
					<form class="form-horizontal mb-sm" id="demo-form">
						<p id="conceirge_type"></p>
						<div class="form-group mt-sm">
						<label class="col-sm-3 control-label"><b>Discount</b></label>
						<div class="col-sm-7">
							<input type="text" id="discount" required="" placeholder="Enter discount..." class="form-control" name="name">
						</div>
						<div class="col-sm-2" style="font-weight: bold; font-size: 17px; margin: 5px 0px 0px -25px;">%</div>
						</div>
						<input type="hidden" value="" id="invoiceId">
					</form>
				</div>
			</div>			
			<div class="row">
			<div class="col-md-12 text-right">
				<button type="button" class="btn btn-success" id="submitData">Submit</button>
				<button type="button" class="btn btn-danger closeModal" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<p id="message"></p>
		</div>
	</section>
  </div>
</div>
<!-- Modal for details service view with form end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
//jQuery section for details service view start here
$(function() {
	$('a[id^="dis_"]').click(function(){
		var invoiceId = $(this).data("inv");
		$('#invoiceId').val(invoiceId);
		$("#discount").css("border","1px solid #ccc");
		$('#discountRequestModal').modal('show');
	});
	$('.closeModal').click(function(){
		$("#discount").val("");
		$('#invoiceId').val("");
		$("#discount").css("border","1px solid #ccc");
	});
	$('#submitData').click(function(){
		var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
		var url = '<?php echo base_url(); ?>';
		var invoiceId = $('#invoiceId').val();
		var discount = $("#discount").val();
		if (discount == "") {
			$("#discount").css("border","1px solid red");
			return false;
		}else if(!numberRegex.test(discount)){
			alert('Enter Numbers only');
			$("#discount").css("border","1px solid red");
			$("#discount").val("");
			return false;
		} else{
			$("#discount").css("border","1px solid #ccc");
			$.ajax({
			 method: "POST",
			 url: url+"index.php/invoice/discountOnInvoice",
			 data: { invoiceId: invoiceId, discount: discount},
			 async: false,
			 dataType : 'json',
			 success: function(data, textStatus, jqXHR) {
				//code after success
				console.log("Success Msg: "+textStatus);
				$("#message").html('<div style="margin-top:18px;" class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Success!</strong> Your request has been processed .</div>');
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
});
</script>