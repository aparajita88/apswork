<form action="<?php echo base_url().'users/saveCheckList'; ?>" id="checklist-form" method="post">
  <input type="hidden" name="party_id" value="<?php echo $party_id; ?>" />
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	  </div>
	  <div class="modal-body">
	  <form class="form-horizontal" role="form">
		<div class="col-lg-12">
		<div class="form-group">
		  <label class="col-sm-3">Service Type</label>
		  <div class="col-sm-8">
			  <select id="service_type_id" name="service_type_id" class="form-control" onclick="removeValidateHtml(this.id);" onchange="drawSubServiceSelectBox('<?php echo $party_id; ?>', this.value);">
				<option value="">--- Please select ---</option>
			  </select>
			  <span id="service_type_id_error" class="error"></span>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3">Sub Service Type</label>
			<div class="col-sm-8">
				<select id="subservice_type_id" name="subservice_type_id" class="form-control" onclick="removeValidateHtml(this.id);">
					<option value="">--- Please select ---</option>
				</select>
				<span id="subservice_type_id_error" class="error"></span>
			</div>
			
		</div>
		<!--<div class="form-group">							  
		 <label class="col-sm-3">Amount</label>
		 <div class="col-sm-8"><input type="text" id="amount" name="amount" class="form-control" onclick="removeValidateHtml(this.id);"> <span id="amount_error" class="error"></span></div>
		</div>-->
		<div class=form-group>
		  <label class="col-sm-3">Discription</label>
		  <div class="col-sm-8"><textarea id="discription" name="discription" class="form-control" cols="5" rows="5"></textarea></div>
		</div>
		<div class=form-group>
		  <label class="col-sm-3">Comment</label>
		  <div class="col-sm-8"><textarea id="comment" name="comment" class="form-control" cols="5" rows="5"></textarea></div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3">Status</label>
		  <div class="col-sm-8">
			  <select id="status" name="status" class="form-control" onclick="removeValidateHtml(this.id);">
				<option value="">--- Please select ---</option>
				<option value="0">Enquired</option>
				<option value="1">Confirmed</option>
			  </select>
			  <span id="status_error" class="error"></span>
		  </div>
		  
		</div>
		 </div>
		 <button type="button" style="margin-left:117px;" onclick="submitChecklistForm();" class="btn btn-danger">Save</button>
		 </form>
		<div class="clearfix"></div>
		
