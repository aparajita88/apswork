<?php setlocale(LC_MONETARY, 'en_IN'); ?>
<?php $tax = (double)(SERVICE_TAX/100);?>
<?php $this->load->model('service_request');?>
<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 0 20px;">
		<tr>
        	<td colspan="2" style="padding:0px;"><img src="<?php echo $logo_img; ?>" alt="" style="padding:5px; background:#003A48; width:150px; height:50px" /></td>
        </tr>
		<tr>
        	<td style="padding:5px; text-align:center; font-size:16px;"><br><br></td>
        </tr>
        <tr>
        	<td style="padding:0px; width:50%;" valign="top">
            		<table width="100%" border="0" style="font-size:14px;border:0px solid #ddd; padding:0px;">
                      <tr>
                        <td style="padding:5px ; width:100;"><b><?php echo ucfirst($company['company_name']);?></b></td>
                       </tr>
                      <?php $address = explode(",",$company['address']);
                      foreach($address as $val){
                      ?>    
                      <tr>
                       <td style="padding:5px ; width:50%;"> <?php echo $val;?></td>
                      </tr> 
                      <?php 
                      }
                      ?>
                    </table>
            </td>
            <td style="padding:0x; width:50%;"  valign="top">
            		<table width="100%" border="0" style="font-size:14px; padding:0px;" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="padding:10px ; width:50%; background:#F3F0F0;"><b>Invoice Date:</b></td>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;">
						<?php
						$date=date_create($invoice['publish_date']);
						echo date_format($date,"d F Y");
						?>
						</td>
                      </tr>
                      <tr>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"><b>Account Number:</b></td>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"> <?php echo $company['company_account_no']?></td>
                      </tr>
                      <tr>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"><b>Invoice Number:</b></td>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"><?php echo $invoice['invoice_number']; ?></td>
                      </tr>
                      <tr>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;"><b>Payment Due:</b></td>
                        <td style="padding:10px ; width:50%;background:#F3F0F0;">Due Immediately</td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                        <td style="padding:5px ; width:50%;">&nbsp;</td>
                      </tr>
                    </table>
             </td>
        </tr>
        <tr>
        	<td colspan="2" style="padding:5px; text-align:center; font-size:16px;">
         </tr>
    	
    	<tr>
        	<td colspan="2" style="padding:5px; text-align:center; font-size:16px;"><b>Invoice</b></td>
         </tr>
        <tr>
             <td colspan="2"  style="padding:5px; text-align:center;font-size:15px;"> <b>Center Name: Smartworks Business Center</b></td>
        </tr>
  		
</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;  font-family: \'trebuchet_msregular\'; font-size:14px;padding: 0 20px;">
                    <tr>
                      <td style="padding:15px; border-bottom:1px solid #ddd;"><strong>Description of Charges</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd;"><strong>From Date</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd;"><strong>To Date</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Price (exc. Service Tax and SB Cess) </strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Service Tax and SB Cess Amount</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Total (inc. Service Tax and SB Cess)</strong></td>
                    </tr>
                    <tr>
                      <td style="padding:10px 15px;"><strong>Standing Charges</strong></td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                    </tr>
          			<?php $total_main_amount = 0; ?>
                    <?php foreach($invoice_items as $item){ ?>
                    <tr>
                      <td style="padding:10px 25px;">
                      <?php
                      $name = $item['table_name'];            
                      switch ($name) {
                        case "request_courier_service":
                        echo "<b>Courier Service Request</b>";
                        break;
                        case "request_food_service":
                          echo "<b>Foods Service Request with Quanty</b><br>";
                          $foods = json_decode($item['service_details']['detailes'], true);
                          foreach ($foods as $food) {
                            foreach ($food as $k => $v) {
                              $scat = 'sub_cat';
                              $qty = 'qty';
                              $prodName = $this->service_request->getFoodServiceDetails($food[$scat]);
                              $productNameQty = ucfirst($prodName['name'])." (".$food[$qty].")";
                              echo "<br>".$productNameQty;
                              break;
                            }
                          }
                          break;
                          case "request_stuff_service":
                          echo "<b>Stuff Service Request</b>";
                          break;
                          case "book_conference_room":
                          echo "<b>Booking Conference Room</b><br><br>";
                          $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                            echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                            foreach ($times as $time) {
                              echo "&nbsp;&nbsp;".$time.'<br>';
                            }
                          }
                          break;
                          case "book_meeting_room":
                          echo "<b>Booking Meeting Room</b><br><br>";
                          $bookings = json_decode($item['service_details']['booking_details'], true);
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
                          echo "<b>Locker Room Book</b>";
                          break;
                          case "book_floor_plan":
                          echo "<b>Floor Plan Book</b>";
                          $bookings = json_decode($item['service_details']['booking_detailes'], true);
                          /*foreach ($bookings as $floor_plan_id) {
                            $floor_plan_name = $this->invoice_model->getFloorPlanDetails($floor_plan_id);
                              echo "&nbsp;".ucfirst($floor_plan_name['description']).'<br>';
                          }*/
                          break;
                          case "book_play_room":
                          echo "<b>Play Room Book</b>";
                          break;
                          default:
                          echo "";
                      }
                      ?>
                      </td>
                      <td style="padding:10px 15px;" valign="center"><?php echo isset($item['service_details']['start_date']) ? date_format(date_create($item['service_details']['start_date']),"d M Y") : '------' ;?></td>
                      <td style="padding:10px 15px;" valign="center"><?php echo isset($item['service_details']['end_date']) ? date_format(date_create($item['service_details']['end_date']),"d M Y") : '------' ;?></td>
                      <td style="padding:10px 15px; text-align:right;"><?php echo money_format('%i', $item['total']); ?></td>
                      <td style="padding:10px 15px; text-align:right;">
                      <?php echo money_format('%i', ($item['total'] * $tax));
                      $total_with_tax = ($item['total'] * $tax) + $item['total'];
                      $total_main_amount = $total_main_amount + $total_with_tax;
                      ?>
                      </td>
                      <td style="padding:10px 15px; text-align:right;"><?php echo money_format('%i', $total_with_tax); ?></td>
                    </tr>
          					<?php } ?>
                    <tr>
                      <td style="padding:10px 35px;"><strong>Total Standing Charges</strong></td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                      <td style="padding:10px 15px;">&nbsp;</td>
                      <td style="padding:10px 15px;text-align:right;">&nbsp;</td>
                      <td style="padding:10px 15px;text-align:right;">&nbsp;</td>
                      <td style="padding:10px 15px; text-align:right;">
                      <strong>
                          <?php echo money_format('%i', $total_main_amount); ?>
                      </strong>
                      </td>
                    </tr>
						<?php
						if(!empty($discount) && $discount['IsApproved'] == 1){
						$discount_percentage = $discount['discounts'];
						$discount_on_total_amount = ($total_main_amount * $discount_percentage)/100;
						?>
						   <tr>
							 <td style="padding:10px 35px;"><strong>Discount (<?= $discount_percentage; ?>%)</strong></td>
							 <td style="padding:10px 15px;">&nbsp;</td>
							 <td style="padding:10px 15px;">&nbsp;</td>
							 <td style="padding:10px 15px;text-align:right;">&nbsp;</td>
							 <td style="padding:10px 15px;text-align:right;">&nbsp;</td>
							 <td style="padding:10px 15px; text-align:right;">
									   <strong>
											   -<?php echo money_format('%i', $discount_on_total_amount); ?>
									   </strong>
									 </td>
						   </tr>
					   <?php }else{
							   $discount_on_total_amount = 0;		
					   } ?>
                    <tr>
                      <td style="padding:10px 15px; background:#F3F0F0;"><strong>Total Charges</strong></td>
                      <td style="padding:10px 15px; background:#F3F0F0;">&nbsp;</td>
                      <td style="padding:10px 15px; background:#F3F0F0;">&nbsp;</td>
                      <td style="padding:10px 15px; text-align:right; background:#F3F0F0;" >&nbsp;</td>
                      <td style="padding:10px 15px; text-align:right;background:#F3F0F0;">&nbsp;</td>
                      <td style="padding:10px 15px; text-align:right;background:#F3F0F0;">
                      <strong><?php echo money_format('%i', $total_main_amount - $discount_on_total_amount); ?></strong>
                      </td>
                    </tr>
                   </table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">       
        <tr>
        	<td width="50%" valign="top"> 
             	 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;" >
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
             	 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                    <tr>
                      <td style="padding:15px; width:50%; border:1px solid #ddd; border-right:0;"><strong>Total (exc. Service Tax and SB
Cess)</strong></td>
                      <td style="padding:15px; width:50%; border:1px solid #ddd;text-align:right;">
                      <strong>
                          <?php echo money_format('%i', $invoice['sub_total']); ?>
                      </strong>
                      </td>
                     </tr>
                    <tr>
                      <td style="padding:15px; border:1px solid #ddd; border-right:0; border-top:0;"><strong>ServiceTax <?php echo $invoice['tax_rate']; ?>%</strong></td>
                      <td style="padding:15px; border:1px solid #ddd; border-top:0;text-align:right;">
                      <strong><?php echo money_format('%i', $invoice['tax_amount']); ?></strong>
                      </td>
                     </tr>
					<?php 
						if(!empty($discount) && $discount['IsApproved'] == 1){
						$discount_percentage = $discount['discounts'];
						$discount_on_total_amount = ($invoice['total_amount'] * $discount_percentage)/100;
				     ?>
					 <tr>
                      <td style="padding:15px; border:1px solid #ddd; border-right:0; border-top:0;"><strong>Discount <?= $discount_percentage; ?>%</strong></td>
                      <td style="padding:15px; border:1px solid #ddd; border-top:0;text-align:right;">
          						<strong>-<?php echo money_format('%i', $discount_on_total_amount); ?></strong>
          					  </td>
                     </tr>
					 <?php }else{
						$discount_on_total_amount = 0;		
				      } ?>
                     <tr>
                      <td style="padding:10px 15px;; border:1px solid #ddd; border-right:0; border-top:0; background:#F3F0F0;"><strong>Total (inc. Service Tax and SB
Cess)</strong></td>
                      <td style="padding:10px 15px;; border:1px solid #ddd; border-top:0; text-align:right; background:#F3F0F0;"><strong><?php echo money_format('%i', ($invoice['total_amount'] - $discount_on_total_amount)); ?></strong></td>
                     </tr>
                      
                   </table>
             </td>
        </tr>    
 </table>
 <!--mpdf
<htmlpagefooter name="myfooter1">
<div style="padding:5px; text-align:center; font-size:13px; text-align:center; line-height:20px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type <br>specimen book. <br>It has survived not only five centuries</div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter1" value="on" />
mpdf-->
