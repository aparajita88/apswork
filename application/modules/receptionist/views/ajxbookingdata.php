<?php if(!empty($book_data)){
    foreach($book_data as $bk_data){
        if($bk_data['status']==0){
            $status="";
        }else if($bk_data['status']=="1"){
            $status="Checked In";
        }else if($bk_data['status']=="2"){
            $status="Checked Out";
        }
        ?>
    <tr>
            <td><?php echo $bk_data['date'];?></td>
            <td><?php echo $bk_data['start_time'];?></td>
            <td><?php echo $bk_data['end_time'];?></td>
            <td><?php echo $bk_data['Room'];?></td>
            <td><?php echo $bk_data['client'];?></td>
            <td><?php echo $status;?></td>
           <td><?php if($status<>"Checked In" && $status<>"Checked Out"){?>
           <a href="javascript:void(0)" onclick="fncheckin('<?php echo $bk_data['id'];?>','<?php echo $bk_data['table'];?>','<?php echo $bk_data['start_time'];?>','<?php echo $bk_data['end_time'];?>','<?php echo date('Y-m-d',strtotime($bk_data['date']));?>','1')" style="background-color: #000">Check In</a>
           <?php }else if($status=="Checked In"){?>
               <a href="javascript:void(0)" onclick="fncheckin('<?php echo $bk_data['id'];?>','<?php echo $bk_data['table'];?>','<?php echo $bk_data['start_time'];?>','<?php echo $bk_data['end_time'];?>','<?php echo date('Y-m-d',strtotime($bk_data['date']));?>','2')" style="background-color: #000">Check Out</a>
           <?php }?>
           </td>
          </tr>
    <?php }}else{?>
    <tr>
        <td colspan="7">No data Available</td>
    </tr>
    <?php }?>


           