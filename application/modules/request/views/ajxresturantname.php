<option value="">Select Restaurant</option>
<?php foreach($resturant as $row){?>
<option value="<?php echo $row['recid'];?>"><?php echo $row['recname'];?></option>
<?php }?>