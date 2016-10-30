<option value="">Select Location</option>
<?php foreach($movie_hall as $row){?>
<option value="<?php echo $row['hid'];?>"><?php echo $row['hollname'].'('.substr($row['lc'],0,50).'...'.')';?></option>
<?php }?>