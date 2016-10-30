<?php
if($creditinfo[0]['table_name']=="request_courier_service"){
  $description="Courier service";
  $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['Approved_on']));
  $end_date="";
  $unit_price=$creditinfo[0]['service_details']['price'];
  $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
  $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="request_food_service"){
    $description="Food service";
    $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['dateApproved']));
    $end_date="";
    $unit_price=$creditinfo[0]['service_details']['price'];
    $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
    $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="request_stuff_service"){
     $description=$creditinfo[0]['description'];
      $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['start_date']));
      $end_date=date('M d Y',strtotime($creditinfo[0]['service_details']['end_date']));
      $unit_price=$creditinfo[0]['service_details']['price'];
      $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
      $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="book_floor_plan"){
     $description=$creditinfo[0]['purpose'];
      $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['start_date']));
      $end_date=date('M d Y',strtotime($creditinfo[0]['service_details']['end_date']));;
      $unit_price=$creditinfo[0]['service_details']['total_price'];
      $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
      $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="book_conference_room"){
     $description=$creditinfo[0]['purpose'];
      $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['dateApproved']));
      $end_date="";
      $unit_price=$creditinfo[0]['service_details']['price'];
      $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
      $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="book_meeting_room"){
     $description=$creditinfo[0]['purpose'];
      $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['dateApproved']));
      $end_date="";
      $unit_price=$creditinfo[0]['service_details']['price'];
      $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
      $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="book_dayoffice"){
   $description=$creditinfo[0]['purpose'];
    $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['dateApproved']));
    $end_date="";
    $unit_price=$creditinfo[0]['service_details']['price'];
    $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
    $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="book_game_room"){
   $description="Game Room";
    $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['start_date']));
    $end_date=date('M d Y',strtotime($creditinfo[0]['service_details']['end_date']));;
    $unit_price=$creditinfo[0]['service_details']['price'];
    $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
    $total_including_tax=$creditinfo[0]['total']+$interest;
}else if($creditinfo[0]['table_name']=="book_locker_room"){
   $description="Locker Room";
    $start_date=date('M d Y',strtotime($creditinfo[0]['service_details']['start_date']));
    $end_date=date('M d Y',strtotime($creditinfo[0]['service_details']['end_date']));;
    $unit_price=$creditinfo[0]['service_details']['price'];
    $interest=$creditinfo[0]['total']*SERVICE_TAX/100;
    $total_including_tax=$creditinfo[0]['total']+$interest;
}?>

<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
    <tr>
        <td colspan="2" style="padding:15px 0;">
            <table style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-bottom: 4px solid red; width: 100%; padding: 0px 0px 15px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%;"><img src="<?= $logo_img;?>" alt="" style="padding:5px;"></td>
                            <td style="width: 50%; text-align: right;"><span style="float:right; font-size:20px;"><b>Credit Note</b></span></td>
                        </tr>
                    </tbody>
             </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding:15px 0;">
            <table  border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">
                              <table>
                                <tr><td><strong>Exclusive Marketing</strong></td></tr>
                                <tr><td>Attention Of: <?php echo $userData['FirstName']." ".$userData['LastName'];?>.</td></tr>
                                <tr><td><?php echo $userData['address'];?></td></tr>
                              </table>
                            </td>
                            <td style="width: 50%; text-align: right;">
                              <table>
                                <tr><td><strong>Credit Note:</strong> <?php echo $creditinfo[0]['creditnote_no'];?></td></tr>
                                <tr><td><strong>Credit Note Date:</strong> <?php echo $creditinfo[0]['dateAdded'];?></td></tr>
                              </table>
                            </td> 
                        </tr>
                    </tbody>
             </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding:15px 0;">
            <table  border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%;"><strong>Accounting System Ref:</strong> <?php echo rand(10000000,99999999);?></td>
                            <td style="width: 50%; text-align: left;"><strong>Invoice No :</strong> <?php echo $creditinfo[0]['invoice_no'];?></td> 
                        </tr>
                    </tbody>
             </table>
        </td>
    </tr>
</table>
<table  border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding:  0 20px 0 20px;">
        <tr>
             <td colspan="2" style="padding:15px; border-left: 1px solid #dddddd;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;"><strong>Description</strong></td>
             <td colspan="2" style="padding:15px; border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;"><strong>Period</strong></td>
             <td colspan="2" style="padding:15px; border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;"><strong>Qty</strong></td>
             <td colspan="2" style="padding:15px; border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;"><strong>Unit Price</strong></td>
             <td colspan="2" style="padding:15px; border-right: 1px solid #dddddd;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;"><strong>Total</strong></td>
        </tr>
        <tr>
            <td colspan="2" style="padding:15px; border-left: 1px solid #dddddd; text-align:left;"><strong>One Off Charges</strong></td>
            <td colspan="2" style="padding:15px;"></td>
            <td colspan="2" style="padding:15px;"></td>
            <td colspan="2" style="padding:15px;"></td>
            <td colspan="2" style="padding:15px; border-right: 1px solid #dddddd;"></td>
        </tr>
        <tr>
           <td colspan="2" style="padding:15px; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd; text-align:left;">Internet Service</td>
           <td colspan="2" style="padding:15px; border-bottom: 1px solid #dddddd;"><?php echo(($start_date<>"")?$start_date:"");?> - <?php echo(($end_date<>"")?$end_date:"");?></td>
           <td colspan="2" style="padding:15px; border-bottom: 1px solid #dddddd;">1.00</td>
           <td colspan="2" style="padding:15px; border-bottom: 1px solid #dddddd;"><?php echo $unit_price;?></td>
           <td colspan="2" style="padding:15px; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd;"><?php echo $unit_price;?></td>
        </tr>
        <tr>
            <td colspan="2" style="padding:15px; border-left: 1px solid #dddddd;"></td>
            <td colspan="2" style="padding:15px;"></td>
            <td colspan="2" style="padding:15px;"></td>
            <td colspan="2" style="padding:15px;"></td>
            <td colspan="2" style="padding:15px; border-right: 1px solid #dddddd;"></td>
        </tr>
 </table>
 <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 0 20px 0 20px;">
   <tr>
        <td colspan="2">
            <table  border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%; background-color: #dddddd;">
                              <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;">
                                  <tr>
                                      <td colspan="2" style="padding:15px; border-right: 1px solid #000; width: 33%;">Tax Rate </td>
                                      <td colspan="2" style="padding:15px; border-right: 1px solid #000; width: 33%;">Tax Ground </td>
                                      <td colspan="2" style="padding:15px; width: 33%;">Tax Total </td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="padding:15px; border-right: 1px solid #000; width: 33%;"><?= SERVICE_TAX; ?>% Service Tax </td>
                                    <td colspan="2" style="padding:15px; border-right: 1px solid #000; width: 33%;"><?php echo $creditinfo[0]['total'];?></td>
                                    <td colspan="2" style="padding:15px; width: 33%;"><?php echo $interest;?></td>
                                  </tr>
                              </table>
                            </td>
                            <td style="width: 5%;"></td>
                            <td style="width: 45%;background-color: #dddddd;text-align: left;">
                              <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 0 10px 0 10px;">
                                    <tr>
                                        <td colspan="2" style="padding:15px;">Total Excluding Tax </td>
                                        <td colspan="2" style="padding:15px;">INR</td>
                                        <td colspan="2" style="padding:15px;"><?php echo $creditinfo[0]['total'];?></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" style="padding:15px;">TAX</td>
                                      <td colspan="2" style="padding:15px;">INR</td>
                                      <td colspan="2" style="padding:15px;"><?php echo $interest;?></td>
                                    </tr>
                                     <tr>
                                      <td colspan="2" style="padding:15px; border-top: 1px solid #000;">Grand Total Including Tax </td>
                                      <td colspan="2" style="padding:15px; border-top: 1px solid #000;">INR</td>
                                      <td colspan="2" style="padding:15px; border-top: 1px solid #000;"><?php echo $total_including_tax;?></td>
                                    </tr>
                                </tbody>
                              </table>
                            </td> 
                        </tr>
                    </tbody>
             </table>
        </td>
    </tr>
 </table>
 <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:30px 0 0 0;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 20px;">
        <tr>
            <td colspan="2" style="padding:15px 0; text-align:center;">
            <hr>This is a computer generated invoice. No signature us required.<br>PAN NO : <?= PAN_NO;?> Service TAX No: <?= SERVICE_TAX_NO;?><br>TDS to be deducted as per applicable laws<br>21A Shakespeare Sarani. Kolkata 700017.<br>For communication, please refer to the business center with which you have registered.
            </td>
        </tr>
 </table>