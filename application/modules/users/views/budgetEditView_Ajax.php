
  <form action="<?php echo base_url().'users/updateBudget'; ?>" id="budget-form" method="post">
   <input type="hidden" name="budget_id" value="<?php echo $budgetData['budget_id']; ?>" />
   <input type="hidden" name="party_id" value="<?php echo $budgetData['party_id']; ?>" />
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
			  <select id="service_type_id" name="service_type_id" class="form-control" onclick="removeValidateHtml(this.id);" onchange="drawSubServiceSelectBox('<?php echo $budgetData['party_id']; ?>', this.value);">
				<option value="">--- Please select ---</option>
				<?php 
					if(isset($mainServices) && count($mainServices)){
						foreach($mainServices as $key => $value){
							$selected = (($key==$budgetData['service_type_id'])? "selected" : "" );
				?>
							<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
				<?php 
						}
					}
				?>
			  </select>
			  <span id="service_type_id_error" class="error"></span>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3">Sub Service Type</label>
			<div class="col-sm-8">
				<select id="subservice_type_id" name="subservice_type_id" class="form-control" onclick="removeValidateHtml(this.id);">
					<option value="">--- Please select ---</option>
					<?php 
					if(isset($subServices) && count($subServices)){
						foreach($subServices as $key => $value){
							$selected = (($key==$budgetData['subservice_type_id'])? "selected" : "" );
					?>
								<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
					<?php 
							}
						}
					?>
				</select>
				<span id="subservice_type_id_error" class="error"></span>
			</div>
			
		</div>
		<div class="form-group">							  
		 <label class="col-sm-3">Amount</label>
		 <div class="col-sm-8"><input type="text" id="amount" name="amount" class="form-control" onclick="removeValidateHtml(this.id);" value="<?php echo $budgetData['ammount']; ?>"> <span id="amount_error" class="error"></span></div>
		</div>
		<div class=form-group>
		  <label class="col-sm-3">Discription</label>
		  <div class="col-sm-8"><textarea id="discription" name="discription" class="form-control" cols="5" rows="5"><?php echo $budgetData['discription']; ?></textarea></div>
		</div>
		<div class=form-group>
		  <label class="col-sm-3">Comment</label>
		  <div class="col-sm-8"><textarea id="comment" name="comment" class="form-control" cols="5" rows="5"><?php echo $budgetData['comment']; ?></textarea></div>
		</div>
		 </div>
		 <button type="button" style="margin-left:117px;" onclick="submitBudgetForm();" class="btn btn-danger">Save</button>
		</form>
		<div class="clearfix"></div>
	 
