<?php 
setlocale(LC_MONETARY, 'en_IN'); 
if(!empty($price_table_details) && count($price_table_details) > 0 && !isset($error)){
ksort($price_table_details);
$price = 0;
?>
<table class="table table-striped mb-none">
<thead>
	<tr>
		<th>Date</th>
		<th>Rate</th>
		<th>Slot(s)</th>
		<th>Total</th>
	</tr>
</thead>
<tbody>
	<?php foreach($price_table_details as $key => $val){ ?>
	<tr>
		<td><?= $key; ?></td>
		<td><?= money_format('%i', ($val['rate'])); ?></td>
		<td><?= $val['count'];?></td>
		<td><?= money_format('%i', ($val['price'])); ?></td>
	</tr>
	<?php 
	$price += $val['price'];
	}
	$taxAmmount = (($price*SERVICE_TAX)/100);
	$total = $price + $taxAmmount;
	?>
</tbody>
</table>
<table class="table">
	<tbody>
		<tr>
			<td>Service Tax</td>
			<td></td>
			<td><?= SERVICE_TAX; ?>%</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?= money_format('%i', $taxAmmount); ?></td>
		</tr>
		<tr>
			<td>Total</td>
			<td></td>
			<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>=</td>
			<td><?= money_format('%i', $total); ?></td>
		</tr>
	</tbody>
</table>
<input type="hidden" id='totalIncTax' value="<?= round($total, 2); ?>"/>
<input type="hidden" id='totalExcTax' value="<?= round($price, 2); ?>"/>
<?php }elseif(isset($error) && $error != '' && $date != '' && $time != ''){ 
$t = explode(':', $time);
$id='#tme_'.$date.'_'.$t[0];
?>
<script type="text/javascript">
	$('<?= $id; ?>').attr('data-flag', $(this).attr('data-flag') == '1' ? '0' : '1')
	$('<?= $id; ?>').toggleClass( "click_to_book" );
	$('#messageError').html('<div class="alert alert-info fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong><?php echo $error; ?></strong></div>');
</script>
<?php }?>