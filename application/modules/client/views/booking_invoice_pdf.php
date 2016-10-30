<?php setlocale(LC_MONETARY, 'en_IN'); ?>
<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
     	<tr>
        	<td colspan="2" style="padding:15px 0;"><a href="#"><img src="<?php echo $logo_img; ?>" alt="" style="padding:5px;" /></a></td>
        </tr>
        
        <tr>
        	<td style="padding:0px; width:50%;" valign="top">
            		<table width="100%" border="0" style="font-size:14px;border:0px solid #ddd; padding:0px;">
                      <tr>
                        <td style="padding:5px ; width:100;"><b><?= $userName; ?></b></td>
                       </tr>
                </table>
            </td>
            <td style="padding:0x; width:50%;"  valign="top">
            		<table width="100%" border="0" style="font-size:14px; padding:0px;" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="padding:10px ; width:50%; background:#F3F0F0;"><b>Payment Date:</b></td>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;">
                          <?php
                          $date=date_create(date('d-M-Y'));
                          echo date_format($date,"d F Y");
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"><b>Invoice Number:</b></td>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"><?= $invoice_number; ?></td>
                      </tr>
                </table>
             </td>
        </tr>
        <tr>
        	<td colspan="2" style="padding:5px; text-align:center; font-size:16px;">
        </tr>  		
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
                    <tr>
                      <td style="padding:15px; border-bottom:1px solid #ddd;"><strong>Description of Charges</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Price (exc. Service Tax and SB Cess) </strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Service Tax and SB Cess Amount</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Total (inc. Service Tax and SB Cess)</strong></td>
                    </tr>
                     <tr>
                      <td style="padding:10px 25px;">
                        <?php
                        $name = $table_name;            
                        switch ($name) {
                          case "request_courier_service":
                          echo "<b>Courier Service Request</b>";
                          break;
                          case "request_food_service":
                          echo "<b>Foods Service Request with Quanty</b><br>";
                          break;
                          case "request_stuff_service":
                          echo "<b>Stuff Service Request</b>";
                          break;
                          case "book_conference_room":
                          echo "<b>Booking Conference Room</b><br><br>";
                            foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                            }
                          break;
                          case "book_meeting_room":
                              echo "<b>Booking Meeting Room</b><br><br>";
                               foreach ($bookings as $date => $times) {
                                  echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                                  foreach ($times as $time) {
                                    echo "&nbsp;&nbsp;".$time.'<br>';
                                 }
                              }
                          break;
                          case "book_dayoffice":
                              echo "<b>Booking Day Office</b><br><br>";
                               foreach ($bookings as $date => $times) {
                                  echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                                  foreach ($times as $time) {
                                    echo "&nbsp;&nbsp;".$time.'<br>';
                                 }
                              }
                          break;
                          case "request_conceirge_service":
                          echo "<b>Conceirge Service Request</b>";
                          break;
                          case "book_locker_room":
                          echo "<b>Locker Room Book</b><br>";
                                echo "<b>Start Date : </b>".$start_date."<br>";
                                echo "<b>End Date   : </b>".$end_date."<br>";
                          break;
                          case "book_floor_plan":
                          echo "<b>Floor Plan Book</b><br>";
                          break;
                          case "book_game_room":
                          echo "<b>Game Room Book</b><br>";
                                echo "<b>Start Date : </b>".$start_date."<br>";
                                echo "<b>End Date   : </b>".$end_date."<br>";
                          break;
                          default:
                          echo "";
                        }
                        ?>
                      </td>
                      <td style="padding:10px 15px; text-align:right;"><?php echo money_format('%i', $priceExcTax); ?></td>
                      <td style="padding:10px 15px; text-align:right;"><?php echo money_format('%i', ($priceIncTax-$priceExcTax)); ?></td>
                      <td style="padding:10px 15px; text-align:right;"><?php echo money_format('%i', $priceIncTax); ?></td>
                    </tr>
                    <tr>
                      <td style="padding:10px 15px;; background:#F3F0F0;"><strong>Total Charges</strong></td>
                      <td style="padding:10px 15px;; text-align:right; background:#F3F0F0;" >&nbsp;</td>
                      <td style="padding:10px 15px;;text-align:right;background:#F3F0F0;">&nbsp;</td>
                      <td style="padding:10px 15px;; text-align:right;background:#F3F0F0;"><strong><?php echo money_format('%i', $priceIncTax); ?></strong></td>
                    </tr>
                   </table>

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">       
        <tr>
        	<td width="50%" valign="top"> 
             	 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:70px;" >
                    <tr>
                      <td style="padding:15px;">&nbsp;</td>
                      <td style="padding:15px;">&nbsp;</td>
                     </tr>
                    <tr>
                      <td style="padding:15px;">&nbsp;</td>
                      <td style="padding:15px;">&nbsp;</td>
                     </tr> 
                </table>
          </td>
        	<td  width="50%" valign="top"> 
             	 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:70px;">
                    <tr>
                      <td style="padding:15px; width:50%; border:1px solid #ddd; border-right:0;"><strong>Total (exc. Service Tax and SB
Cess)</strong></td>
                      <td style="padding:15px; width:50%; border:1px solid #ddd;text-align:right;"><strong><?php echo money_format('%i', $priceExcTax); ?></strong></td>
                     </tr>
                    <tr>
                      <td style="padding:15px; border:1px solid #ddd; border-right:0; border-top:0;"><strong>ServiceTax <?= $tax;?>%</strong></td>
                      <td style="padding:15px; border:1px solid #ddd; border-top:0;text-align:right;"><strong><?php echo money_format('%i', ($priceIncTax-$priceExcTax)); ?></strong></td>
                     </tr>
                     <tr>
                      <td style="padding:10px 15px;; border:1px solid #ddd; border-right:0; border-top:0; background:#F3F0F0;"><strong>Total (inc. Service Tax and SB
Cess)</strong></td>
                      <td style="padding:10px 15px;; border:1px solid #ddd; border-top:0; text-align:right; background:#F3F0F0;"><strong><?php echo money_format('%i', $priceIncTax); ?></strong></td>
                     </tr> 
                </table>
             </td>
        </tr>
 </table>
