
<?php if(isset($acc_statement['invoice']) && count($acc_statement['invoice']) > 0 && !empty($acc_statement['invoice'])){?>
<table style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 0 10px;">
                    <tr>
                        <td colspan="2" style="padding:20px;"><img src="<?php echo $logo_img; ?>" alt="" style="padding:5px; width:150px; height:50px" /></td>
                    </tr>
                    <tr>
                        <td style="padding:20px; width:100%; text-align: center; font-size: 1.6em;" valign="top">
                            Transaction History
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px; width:100%;" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%; padding: 0px; text-align:left;"><span style="font-weight: bold;">Centre:</span> <span><?= ucfirst($userData['l_name']); ?>, <?= ucfirst($userData['c_name']); ?></span></td>
                                        <td style="width: 50%; padding: 0px; text-align:right;">
                                            <span style="font-weight: bold;">Start Date:</span> <span>
                                                <?php 
                                                    $date=date_create($acc_statement['staring_balance_date']);
                                                    echo date_format($date,"d-M-y");
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px; width:100%;" valign="top">
                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%; padding: 0px; text-align:left;"><span style="font-weight: bold;">Customer:</span> <span><?= ucfirst($userData['company_name']); ?></span></td>
                                        <td style="width: 50%; padding: 0px; text-align:right;">
                                            <span style="font-weight: bold; margin-right: 15px;">End date:</span> <span>
                                                <?php 
                                                    $date=date_create($acc_statement['ending_balance_date']);
                                                    echo date_format($date,"d-M-y");
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> 
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px; width:100%; text-align: center;" valign="top">
                            Please note that any transactions placed in the last 2 days may not be reflected
                        </td>
                    </tr>
</table>
<table style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 0 10px;">
    <tbody>
        <tr>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">DATE</td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">TRANSACTION TYPE</td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">TRANSACTION REFERENCE</td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">DEBIT</td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">CREDIT</td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">OUTSTANDING BALANCE (INR)</td>
        </tr>
        <tr>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">
                <?php 
                    $date=date_create($acc_statement['ending_balance_date']);
                    echo date_format($date,"d-M-y");
                ?>            
            </td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">Ending Balance</td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"><?= $acc_statement['ending_balance'];?></td>
        </tr>
         <?php 
         $temp = 0;
        foreach($acc_statement['invoice'] as $key => $dat){
            $date=date_create($dat['p_date']);
        ?>
        <?php if($dat['t_status'] == 'paid'){ ?>
        <tr>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= date_format($date,"d-M-y"); ?></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= ucfirst('Invoice'); ?></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_number']; ?></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_amount']; ?></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"></td>
            <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_outstanding_debit']; ?></td>
        </tr>
        <?php }?>
        <tr>
            <?php if($dat['t_status'] == 'debit'){?>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= date_format($date,"d-M-y"); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= ucfirst($dat['t_type']); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_number']; ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_amount']; ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"></td>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_outstanding']; ?></td>
            <?php }elseif($dat['t_status'] == 'credit'){ ?>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= date_format($date,"d-M-y"); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= ucfirst($dat['t_type']); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_number']; ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_amount']; ?></td>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_outstanding']; ?></td>
            <?php }elseif($dat['t_status'] == 'paid'){ ?>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= date_format($date,"d-M-y"); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= ucfirst('Payment'); ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_number']; ?></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"></td>
                <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_amount']; ?></td>
                 <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"><?= $dat['t_outstanding_credit']; ?></td>
            <?php }?>
        </tr>
        <?php } ?>
      <tr>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">
        <?php 
            $date=date_create($acc_statement['staring_balance_date']);
            echo date_format($date,"d-M-y");
        ?>
        </td>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"></td>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;">Starting Balance</td>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"></td>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"></td>
        <td style="border: 1px solid #dddddd;text-align: left;padding: 8px;color: black;font-weight: bold;"><?= $acc_statement['staring_balance'];?></td>
      </tr>
    </tbody>
</table>
<table style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding: 0 10px;">
    <tr>
        <td style="width:100%; text-align: center; font-size: 14px;" valign="top">
            <hr style="width: 50%">
             This is a computer generated document. No signature us required.
        </td>
    </tr>
</table>
<?php } ?>
     