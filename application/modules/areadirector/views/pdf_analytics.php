<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
    <tr>
        <td colspan="2" style="padding:15px 0;">
            <table style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-bottom: 4px solid red; width: 100%; padding: 0px 0px 15px;">
                    <tbody>
                        <tr>
                            <td style="width: 50%;"><img src="<?= $logo_img;?>" alt="" style="padding:5px;"></td>
                            <td style="width: 50%; text-align: right;"><span style="float:right; font-size:20px;"><b>Analytics</b></span></td>
                        </tr>
                    </tbody>
             </table>
        </td>
    </tr>
</table>
<table  border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding:  0 20px 0 20px;">
        <tr>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd; text-align:left;"><strong>City</strong></td>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd;"> <?= $city_name->name;?></td>
        </tr>
         <tr>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd; text-align:left;"><strong>Location</strong></td>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><?= $location_name->name;?></td>
        </tr>
         <tr>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd; text-align:left;"><strong>Business Center Name</strong></td>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><?= $business_name->businessName;?></td>
        </tr>
         <tr>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd; text-align:left;"><strong>Start Date</strong></td>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><?= $start_date;?></td>
        </tr>
         <tr>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd; text-align:left;"><strong>End Date</strong></td>
            <td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><?= $end_date;?></td>
        </tr>
 </table>
<table  border="0" cellspacing="0" cellpadding="0" style="width:100%; margin-top:20px auto;  font-family: 'trebuchet_msregular'; font-size:14px; padding:  0 20px 0 20px;">
        <?= $html_pdf;?>
 </table>
 
 