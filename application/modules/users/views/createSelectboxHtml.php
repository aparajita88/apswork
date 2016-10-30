<?php 
	if(isset($data) && !empty($data)){ 
		foreach($data as $key => $value){
	?>
		<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
	<?php 
		} 
	}
?>

