<option value="">Select Invoice</option>
<?php if(!empty($invoice_data)){
	foreach($invoice_data as $invdt){
		$due_amount=$invdt['total_amount']-$invdt['paid_amount'];
		?>
		<option value="<?php echo $invdt['id'];?>"><?php echo $invdt['invoice_number'];?> | Due Amount: <?php echo $due_amount;?></option>
		<?php
	}
}?>