<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title">CREDIT NOTE</h2></div>					
			<div class="panel-body panel_body_top">
				<div class="form-group">
				    <div class="col-md-12">
				       <div class="col-md-4">
				          <lable>Invoice</lable>
				       </div>
				       <div class="col-md-8">
				           <select name="invoice" id="invoice" class="form-control" onchange="fncreditdata(this.value);">
				              <option value="">Select Invoice</option>
				              <?php foreach($invoice as $inv){
				              	if($inv['total_amount']<>$inv['paid_amount']){
				              		$status="Due";
				              	}else if($inv['total_amount']==$inv['paid_amount']){
				              		$status="Not Due";
				              	}
				              	?>
				                 <option value="<?php echo $inv['id'];?>"><?php echo $inv['invoice_number'];?> | <?php echo $inv['total_amount'];?> | <?php echo $status;?></option>
				              <?php }?>
				           </select>
				       </div>
				    </div>
                </div>
			</div>
			<div class="panel-body">
			 <table class="table table-bordered table-striped mb-none" id="datatable-default">
					<thead>
						<tr>
							<th>CREDIT NOTE NO.</th>
							<th>DATE</th>
							<th>INVOICE NO.</th>
							<th>ACTION</th>
							
						</tr>
					</thead>
					<tbody id="tbcreditdata">
					
					</tbody>
				</table>
			</div>
	</section>		
</section>


<!-- Modal for details service only view end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<!-- jQuery code start here-->
<script type="text/javascript">
	function fncreditdata(invoiceid){
		$.ajax({ 
	      method: "POST", 
	      url: js_site_url+"index.php/creditnote/getcreditlisting/"+invoiceid, 
	      async: true, 
	      success: function(data) { 
	        $("#tbcreditdata").html(data); 
	      } 
        }); 
	}
</script>