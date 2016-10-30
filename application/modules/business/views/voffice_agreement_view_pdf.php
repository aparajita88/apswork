<table border="0" cellspacing="0" cellpadding="0" style="width:100%; margin:0px auto;  font-family: 'trebuchet_msregular'; font-size:14px;padding: 20px;">
        <tr>
            <td colspan="2" style="padding:15px 0;">
                <table style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-bottom: 4px solid red; width: 100%; padding: 0px 0px 15px;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><img src="<?= $logo_img;?>" alt="" style="padding:5px;"></td>
                                <td style="width: 50%; text-align: right;"><span style="float:right; font-size: 20px;"><b>Virtual Office Agreement</b></span></td> 
                            </tr>
                        </tbody>
                 </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:15px 0; margin-bottom:15px; background:#000;">
                <table style="background:rgba(255,255,255,1); width:100%; background:#000;">
                    <tbody>
                        <tr>
                            <td style="width: 25%; background:#000; color: #fff; padding-left:5px;">AGREEMENT DATE (DD/MM/YY) : </td>
                            <td style=" width:25%; background:#000; color: #fff; padding-left:5px;"><?php echo date('dS M Y',strtotime($view[0]['agreement_date']));?></td> 
                            <td style="width:25%; background:#000; color: #fff; padding-left:5px;">Reference No : </td>
                            <td style="width:25%; background:#000; color: #fff; padding-left:5px"><?php echo $view[0]['reference_number'];?></td> 
                         </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" style="padding-top:10px; width:50%;">
                <table width="90%" border="0" style="font-size:14px;border:0px solid #ddd; padding:0px;">
                    <tbody>
                        <tr>
                            <td style="width:550px; height:50px;  background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;">
                                <span style=" color:white; text-transform: uppercase!important; font-size:14px; padding-left:10px;">BUSINESS CENTRE ADDRESS
                                </span>
                            </td>
                        </tr>
                        <?php $business_data=explode(",",$view[0]['address']);?>
                        <tr>
                            <td style="width:550px; height:50px; border:1px solid #CCC; line-height:50px; padding-left:10px;">
                                <span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"><?php echo $view[0]['businessName'];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:550px; height:50px; border:1px solid #CCC;line-height:50px; padding-left:10px;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">
                                <?php if(!empty($business_data[0])){echo $business_data[0];?>,<?php } if(!empty($business_data[1])){echo $business_data[1]; }?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:550px; height:50px; border:1px solid #CCC; line-height:50px; padding-left:10px;">
                                <span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"><?php if(!empty($business_data[0])){echo $business_data[2];?>,<?php } if(!empty($business_data[3])){echo $business_data[3]; }?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:550px; height:50px; border:1px solid #CCC; line-height:50px; padding-left:10px;">
                                <span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"><?php if(!empty($business_data[4])){echo $business_data[4];?>,<?php } if(!empty($business_data[0])){echo $business_data[5]; }?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:550px; height:50px; border:1px solid #CCC;line-height:50px; padding-left:10px;">
                                <span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">
                                    <?php if(!empty($business_data[6])){echo $business_data[6];?>,<?php } if(!empty($business_data[6])){echo $business_data[7]; ?>,<?php }if(!empty($business_data[6])){echo $business_data[8];} ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="padding-top:10x; width:50%;"  valign="top">
                    <table width="100%" cellspacing="0" cellpadding="2" border="0" style="padding:0px;">
                        <tbody>
                        <tr>
                            <td style="width:100%; height:50px; background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="3"><span style="color: white; margin: 0px; text-transform: uppercase ! important; font-size: 14px; float: left; padding: 0px 0px 0px 10px;">
                            CLIENT ADDRESS (NOT A CENTRE ADDRESS)</span></td>
                         </tr>
                        </tbody>
                    </table>
                    <table width="100%" cellspacing="0" cellpadding="2" border="0" style="padding:0px;">
                        <tbody>                  
                         <tr>
                         <td style="border:1px solid #ccc; padding-left:10px; width:100%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Contact Name</span></span></td>
                         <td style="border:1px solid #ccc; padding-left:10px; width:100%"><?php if(empty($registered_user_info)){echo $client_user_info['FirstName'];?>  <?php echo $client_user_info['LastName'];}else{echo ucfirst($registered_user_info[0]['FirstName']);?>  <?php echo ucfirst($registered_user_info[0]['LastName']);}?></td>
                         </tr>
                          <tr>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Company Name</span></span></td>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><?php if(!empty($client_user_info)){echo $client_user_info['company_name'];}else{echo $registered_user_info[0]['company'];}?></td>
                         </tr>
                          <tr>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Address</span></span></td>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><?php if(!empty($client_user_info)){echo $client_user_info['address'];}?></td>
                         </tr>
                          <tr>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Phone</span></span></td>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"><?php if(empty($registered_user_info)){echo $client_user_info['phone'];}else{echo $registered_user_info[0]['phone'];}?></span></span></td>
                         </tr>
                          <tr>
                        <td style="border:1px solid #ccc; padding-left:10px; width:50%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Email</span></span></td>
                         <td style="border:1px solid #ccc; padding-left:10px; width:50%"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"><?php if(empty($registered_user_info)){echo $client_user_info['userEmail'];}else{echo $registered_user_info[0]['userEmail'];}?></span></span></td>
                         </tr>
                        </tbody>
                    </table>
             </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:15px; text-align:left; font-size:16px; width:100%;">
                <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody><tr>
                        <td colspan="2" style="width:100%; height:50px;  background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                       <span style=" color:white; padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">PAYMENT DETAILS</span></span></td>
                     </tr>
                    </tbody>
                </table>
            </td>
         </tr>
         <tr>
            <td colspan="2" style="padding-top:15px; text-align:left; font-size:16px; width:100%;">
                <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody>
                        <tr>
                            <td style="width:100%; height:50px;  background:#ddd; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                            <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px; color:#000;">Type of service (Mailbox Plus, Telephone Answering, VO, VO Plus)</span></span></td>
                        </tr>
                    </tbody>
                </table>
                 <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody>
                        <tr>
                            <td style="width:100%;border:1px solid #ccc; padding-left:10px; font-weight: bold;"><span style=" font-size:19px; margin:0; padding:0; line-height:45px; "><span style="padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"> <?php echo ucfirst($view[0]['name']);?></span></span></td>
 
                        </tr>
                    </tbody>
                </table>
            </td>
         </tr>
        <tr>
            <td colspan="2" style="padding-top:5px; text-align:left; font-size:16px; width: 100%;">
                <table style="background:rgba(255,255,255,1); float:left; width:100%;">
                    <tbody>
                        <tr>
                            <td style="width:50%; height:50px;  background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2">
                                <span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                    <span style=" color:white; padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;"> INITIAL PAYMENT</span>
                                </span>
                            </td>
                            <td colspan="2" style="height: 50px; background: rgb(204, 204, 204) none repeat scroll 0% 0%; border-radius: 5px; line-height: 50px; width: 30%; padding-left: 10px;">
                                <span style=" color:#000; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">FIRST MONTH'S FEE</span>
                            </td>
                            <td colspan="2" style="height: 50px; border: 1px solid rgb(204, 204, 204); border-radius: 5px; line-height: 50px; width: 20%; padding-left:10px;">
                                    <span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                        <span style=" padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px; color:#000;"> <?php echo $view[0]['first_month_fee']; ?></span>
                                    </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
         </tr>
         <tr>
             <td colspan="2" style="padding-top:5px; text-align:left; font-size:16px; width: 100%;">
                <table style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; width: 100%;">
                    <tbody>
                            <tr>
                                <td style="width:71%;" colspan="2"></td>
                                <td colspan="2" style="border:1px solid #ccc; padding-left:10px; width: 30%;">
                                    <span style=" font-size:19px; margin:0; padding:0; line-height:45px;">
                                        <span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">One time registration fee</span>
                                </span>
                                </td>
                                <td style="border:1px solid #ccc; padding-left:10px; width: 20%;"><?php echo $view[0]['first_month_fee']; ?></td>
                            </tr>
                             <tr>
                                    <td style="width:71%;" colspan="2"></td>
                                    <td colspan="2" style="border:1px solid #ccc; padding-left:10px; width: 30%;"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Service retainer</span></span></td>

                                    <td style="border:1px solid #ccc; padding-left:10px; width: 20%;"><?php echo $view[0]['service_retainer']; ?></td>
                             </tr>
                             <tr>
                                    <td style="width:71%;" colspan="2"></td>
                                    <td colspan="2" style="border:1px solid #ccc; padding-left:10px; width: 30%;"><span style=" font-size:19px; margin:0; padding:0; line-height:45px;"><span style="  padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Total Initial Payment</span></span></td>

                                    <td style="border:1px solid #ccc; padding-left:10px; width: 20%;"><?php echo $view[0]['first_month_fee']; ?></td>
                             </tr>
                    </tbody>
                </table>
            </td>
         </tr>
        <tr>
             <td colspan="2"  style="padding-top:5px;width:100%;text-align:left;font-size:16px;">
                <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody>
                    <tr>
                        <td style="width:39%; height:50px;  background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                           <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px;">TOTAL MONTHLY PAYMENT</span></span></th>
                        <td style="width:50%; height:50px;  background:#ddd; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                           <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px; color:#000;"> 
                        TOTAL MONTHLY PAYMENT THEREAFTER ,(EXCL. LOCAT VAT/GST/TAX)</span></span></th>
                        <td style="width:11%; height:50px; border:1px solid #ccc; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                           <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px; color:rgba(0,0,0,1);"> 
                        <?php echo $view[0]['first_month_fee']; ?></span></span>
                        </td>
                     </tr>
                    </tbody>
                </table>
             </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding-top:15px;width:100%;text-align:left;font-size:16px;">
                <table style="background:rgba(255,255,255,1); float:left; width: 100%; ">
                    <tbody>
                        <tr>
                            <td style="width: 39%;   background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px;">SERVICE PROVISION</span></span>
                            </td>
                            <td style="width: 15%;  background:#ccc; border:1px solid #ccc; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"> <span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px; color:rgba(0,0,0,1);"> START DATE</span></span>
                            </td>
                            <td style="width: 15%;  border:1px solid #ccc; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px; color:rgba(0,0,0,1);"> <?php echo $view[0]['start_date']; ?></span></span>
                            </td>
                            <td style="width: 15%;  border:1px solid #ccc; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px; color:rgba(0,0,0,1);"> END DATE*</span></span>
                            </td>
                            <td style="width: 15%;  border:1px solid #ccc; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px; color:rgba(0,0,0,1);"> <?php echo $view[0]['end_date']; ?></span></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding-top:15px;width:100%;text-align:left;font-size:16px;">
                <table style="ackground:rgba(255,255,255,1); float:left; width: 100%;   float:left; ">
                    <tbody>
                        <tr>
                            <td style="width:100%; height:50px;   border-radius: 5px; line-height:50px;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; padding-left:10px;"><span style="color:black;">*All agreements end on the last calender day of the month</span></span></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"  style="padding-top:15px;width:100%;text-align:left;font-size:16px;">
                <table style="ackground:rgba(255,255,255,1); float:left; width: 100%;   float:left; ">
                    <tbody>
                        <tr><td colspan="2"><span style="color:black;">Comments:</span></td></tr>
                        <tr>
                            <td colspan="2">
                                <span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                                    <span style="padding:0; margin:0; text-transform: uppercase!important; font-size:12px; line-height:23px;"><span style="color:black;"><?php echo $view[0]['comment']; ?>
                                    </span></span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top:15px; text-align:left; font-size:16px; width:100%;" colspan="2">
                <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody>
                        <tr>
                            <td style="width:100%; height:50px;  background:#000; border-radius: 5px; line-height:50px; padding-left:10px; font-weight: bold;" colspan="2"><span style=" color:white; padding:0; margin:0; text-transform:  uppercase!important; font-size:14px; float: left;">
                           <span style=" color:white; padding:0; margin:0; text-transform: uppercase!important; font-size:14px; padding-left:10px;">Terms and Conditions</span></span></td>
                        </tr>
                    </tbody>
                </table>
            </td>
         </tr>
         <tr>
            <td style="padding-top:15px; text-align:left; font-size:16px; width:100%;" colspan="2">
                <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody>
                        <tr>
                            <td style="width:20px;"><img src="<?= $tick;?>" alt="" style="padding:5px;width:20px;"></td>
                            <td>I accept the terms and conditions</td>
                        </tr>
                    </tbody>
                </table>
            </td>
         </tr>
         <tr>
            <td style="padding-top:15px; text-align:left; font-size:16px; width:100%;" colspan="2">
                <table style="width:100%; background:rgba(255,255,255,1); float:left; ">
                    <tbody>
                        <tr>
                            <td style="width:8%;">Signed By:</td>
                            <td><?php if(empty($registered_user_info)){echo $client_user_info['FirstName'];?>  <?php echo $client_user_info['LastName'];}else{echo ucfirst($registered_user_info[0]['FirstName']);?>  <?php echo ucfirst($registered_user_info[0]['LastName']);}?></td>
                        </tr>
                        <tr>
                            <td style="width:8%;">Signed On:</td>
                            <td><?= $view[0]['dateAdded'];?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
         </tr>
 </table>