<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
    <tr>
        <td colspan="2" style="padding:15px 0;">
            <table style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-bottom: 4px solid red; width: 100%; padding: 0px 0px 15px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%;"><img src="<?= $logo_img;?>" alt="" style="padding:5px;"></td>
                            <td style="width: 50%; text-align: right;"><span style="float:right; font-size:20px;"><b>Payment Receipt</b></span></td>
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
                                <tr><td><strong><?php echo $company_name;?></strong></td></tr>
                                <tr><td><?php echo $company_address;?></td></tr>
                              </table>
                            </td>
                            <td style="width: 50%; text-align: right;">
                              <table>
                                <tr><td><strong>Payment Date:</strong> <?php echo date('d M Y',strtotime($payment_date));?></td></tr>
                                <tr><td><strong>Invoice Number:</strong> <?php echo $invoice_number;?></td></tr>
                              </table>
                            </td> 
                        </tr>
                    </tbody>
             </table>
        </td>
    </tr>
    <tr>
    <td colspan="2">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
                    <tr>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Purpose Of Payment</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd;"><strong>Payment Type</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Amount</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Transaction_Reference_No</strong></td>
                      
                    </tr>
                     <tr>
                      <td style="padding:10px 25px;">
                        <?php echo $purpose; ?>
                      </td>
                      <td style="padding:0px 15px; text-align:left;"><?php echo $payment_type; ?></td>
                      <td style="padding:0px 15px; text-align:center;">INR <?php echo $amount; ?></td>
                      <td style="padding:0px 15px; text-align:center;"><?php echo $Transaction_Reference_No;?></td>
                    </tr>
                    
                   </table>
                   </td>
                   </tr>
                    <tr>
    <td colspan="2">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
                    <tr>
                      <td style="padding:15px; border-top:1px solid #ddd;border-bottom:1px solid #ddd; text-align:center;" align="center"><strong>Total Charges</strong></td>
                      <td style="padding:15px; border-bottom:1px solid #ddd;"><strong>INR</strong> <?php echo $amount; ?></td>
                      </tr>
                      </table>
    </td>
    </tr>
    </table>
    <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:30px 0 0 0;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 20px;">
        <tr>
            <td colspan="2" style="padding:15px 0; text-align:center;">
             This is a computer generated document. No signature us required.
            </td>
        </tr>
 </table>