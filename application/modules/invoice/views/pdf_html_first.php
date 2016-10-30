<?php setlocale(LC_MONETARY, 'en_IN'); ?>
<?php $this->load->model('invoice_model');
$dueAmount = $this->invoice_model->getDueAmaount($invoice['customerId'],$invoice['invoice_date']);
if(empty($dueAmount)){
$dueAmount['total_amount'] = 0.0;
$dueAmount['paid_amount'] = 0.0;
}
?>
<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;   font-family: 'trebuchet_msregular'; font-size:14px;padding: 0 20px;">
				<tr>
					<td colspan="2" style="padding:0px;"><img src="<?php echo $logo_img; ?>" alt="" style="padding:5px; width:150px; height:50px" /></td>
				</tr>       
				<tr>
					<td style="padding:15px; width:40%;" valign="middle">
						<h2>Account Statement</h2>
					</td>
					<td style="padding:15px; width:60%;"  valign="middle">
					<table width="100%" border="0" style="font-size:14px;border:1px solid #ddd; padding:10px;">
                      <tr>
                        <td style="padding:5px ; width:50%;"><b>Statement Date:</b></td>
                        <td style="padding:5px ; width:50%;">
				        <?php
						$date=date_create($invoice['publish_date']);
						echo date_format($date,"d F Y");
						?>
						</td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;"><b>Account Number:</b></td>
                        <td style="padding:5px ; width:50%;"><?php echo $company['company_account_no'];?></td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;"><b>Name Of Account:</b></td>
                        <td style="padding:5px ; width:50%;"><?php echo ucfirst($company['company_name']);?></td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;"><b>Center Name:</b></td>
                        <td style="padding:5px ; width:50%;">Smartworks Business Center</td>
                      </tr>
                      <tr>
                        <td style="padding:5px ; width:50%;"><b>Payment Due:</b></td>
                        <td style="padding:5px ; width:50%;">Due Immediately</td>
                      </tr>
                    </table>
					 </td>
				</tr>    
				<tr>
					<td style="padding:15px;">&nbsp; </td>
					<td style="padding:15px; text-align:right;"> <b>Amount</b></td>
				</tr>
				<tr>
        	<td style="padding:15px; text-align:left;"> Outstanding Balance at <?php
								$date = new DateTime($invoice['invoice_date']);
								$date->modify("last day of previous month");
								echo $date->format("d F Y");
							?>
		    </td>
            <td style="padding:15px; text-align:right;"><?php echo money_format('%i', $dueAmount['total_amount']); ?></td>
        </tr>
        <tr>
        	<td style="padding:15px; text-align:left;"> Payments Received</td>
            <td style="padding:15px; text-align:right;">-<?php echo money_format('%i', ($dueAmount['paid_amount'] != '') ? $dueAmount['paid_amount'] : 0); ?></td>
        </tr>
		<?php
		 if(!empty($discount) && $discount['IsApproved'] == 1){
		 $discount_percentage = $discount['discounts'];
		 $discount_on_total_amount = ($invoice['total_amount'] * $discount_percentage)/100;		 
		 }else{
		 $discount_percentage = 0;
		 $discount_on_total_amount = 0;		
		}
		?>
    	<tr>
        	<td style="padding:15px; text-align:left;">
			<?php $date=date_create($invoice['invoice_date']); echo date_format($date,"F"); ?> Invoice <?php echo $invoice['invoice_number']; echo ($discount_percentage != 0) ? ' with discount ( '.$discount_percentage.'% )' : '' ;?> 
			</td>
            <td style="padding:15px; text-align:right;">
			<?php echo money_format('%i', $invoice['total_amount'] - $discount_on_total_amount ); ?>
			</td>
        </tr>
        <tr >
        	<td style="padding:10px; text-align:left; padding-right:0; border:1px solid #ddd; border-right:0;"> 
            	<strong style="background:#F3F0F0; display:block; padding:15px; ">
				Total Payment Due – (Quote Reference <?php echo $invoice['invoice_number']; ?> )
				</strong>
            </td>
            <td style="padding:10px; text-align:right;  padding-left:0; border:1px solid #ddd; border-left:0;">
            	<strong style="background:#F3F0F0; display:block; padding:15px; ">
				<?php echo money_format('%i', (($invoice['total_amount'] + ($dueAmount['total_amount'] - $dueAmount['paid_amount']))) - $discount_on_total_amount); ?>
				</strong>
            </td>
        </tr>
				<tr>
					<td style="padding:15px; text-align:left;">&nbsp; </td>
					<td style="padding:15px; text-align:left;">&nbsp; </td>
				</tr>
				
				<tr>
					<td colspan="2" style="border:1px solid #ddd; padding:10px;">
						<table border="0" cellspacing="0" cellpadding="0" style=" width:100%; ">
						<tbody>
							<tr>
								<td colspan="2" style="padding:15px;"><h3>IMPORTANT INFORMATION :</h3></td>
							 </tr>
							<tr>
								<td colspan="2" style="padding:8px 15px; "> &bull; <abbr style="padding-left:20px;">Please bear in mind that your recent payments may not be reflected in the invoice immediately.</abbr></td>
							 </tr>
							 <tr>
								<td  colspan="2" style="padding:8px 15px;"><b> &bull; <abbr style="padding-left:20px;">If you receive more than one invoice please pay them separately so that we can ensure payment is properly
		applied to your account. </abbr></b></td>
							 </tr>
							 <tr>
								<td colspan="2" style="padding:8px 15px;"> &bull; <abbr style="padding-left:20px;">Please note that late payment fees will be applied to your account if payment is not received promptly. </abbr></td>
							 </tr>
							 <tr>
								<td colspan="2" style="padding:15px;"><b>If you have any questions, contact your Center directly. We are here to help.</b></td>
							 </tr>
							 
							 <tr>
								<td  style="padding:8px 15px;">Your Center Team Email Address:</td>
								<td  style="padding:8px 15px;"> <a href="mailto:<?= $community_manager; ?>"> <?= $community_manager; ?></a></td>
							 </tr>
						</tbody>
					 </table>
					</td>
				</tr>		
		  </table>