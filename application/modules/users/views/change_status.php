<?php
	foreach($result as $row)
	{
	//echo $row['status'];
?>
	<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="changeStatusNUser('<?php echo $row['userId']; ?>','<?php echo $row['status']; ?>')">
	<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
	</a>

<?php
	}
?>

