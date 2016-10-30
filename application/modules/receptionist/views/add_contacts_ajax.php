    <table class="table table-bordered table-striped">
		<thead>
		<tr role="row">
        <th>Contact Name</th>
        <th>Phone No</th>
         <th>Email</th>
         <th>Profile Photo</th>
	<th>Is Primary</th>
        <th>Can View Bill</th>
	<th>Status</th>
        <th>Action</th>
         </tr>
		<tbody>
		    <?php if(!empty($get_client_list)){
			
		      foreach($get_client_list as $row){
		      ?>
          <tr>
           <td><?php echo $row['FirstName']." ".$row['LastName']; ?></td>
											
                                   <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['userEmail']; ?></td>
                                    <td><?php if($row['image']!=""){?>
										<img src="<?php echo base_url();?>assets/uploads/images/full/<?php echo $row['image']?>" width="100" height="100" alt="">
										<?php }else{?>
											<img src="<?php echo base_url();?>assets/front/images/no.png" width="100" height="100" alt="">
											<?php }?>
										</td>
				    <td><input type="checkbox" name="Isprimary" onclick="approve_primary('<?php  echo $row['userId'];?>')" value="<?php echo $row['Isprimary']; ?>" <?php if($row['Isprimary']=='1'){echo "checked='checked'";}?>></td>
				    <td><input type="checkbox" name="can_view_bill" onclick="approve_canview('<?php  echo $row['userId'];?>')" value="<?php echo $row['can_view_bill']; ?>" <?php if($row['can_view_bill']=='1'){echo "checked='checked'";}?>></td>
				    <?php if($row['status']=="0"){?>
										<td id="statusId<?php echo $row['userId']; ?>" title="Activate" onclick="approve_client('<?php  echo $row['userId'];?>')"><font color="green">
										<i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</td>
										
										<?php }else{?>
										<td>Active</td>	
											<?php }?>
           <td class="center hidden-phone">
			
			 <a href="<?php echo base_url();?>index.php/areadirector/edit_client/<?php echo $row['userId'];?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
             <!-- <span style="font-size: 20px;"><i class="fa fa-trash"></i></span>-->
              <a href="<?php echo base_url();?>index.php/receptionist/delete_contacts/<?php echo $row['userId'];?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash"></i></a>
			</td>
			
            
          </tr>
          
           <?php } }else{ ?>
	   <tr><td colspan="8">No Contacts</td></tr>
	   <?php }?>
		</tbody> </table>
        </div>
        </div>
	