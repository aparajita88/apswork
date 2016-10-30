<?php if(!empty($credit_listing)){foreach($credit_listing as $crd_list){?>
<tr>
<td><?php echo $crd_list['creditnote_no'];?></td>
<td><?php echo date('M d Y',strtotime($crd_list['dateAdded']));?></td>
<td><?php echo $crd_list['invoice_no'];?></td>
<td><a href="<?php echo base_url();?>index.php/creditnote/download_creditnote/<?php echo $crd_list['id'];?>" title="download credit note"><i class="fa fa-eye" area-hidden="true;"></i></a></td>
</tr>
<?php }}else{?>
<tr><td colspan="4"><center>No data available in table</center></td></tr>
<?php }?>
