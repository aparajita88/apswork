<?php $total_initial_payment=$agreementdata[0]['total_price']*$agreementdata[0]['service_retainer']+$agreementdata[0]['total_price'];
$retainer_amount=$agreementdata[0]['total_price']*$agreementdata[0]['service_retainer'];?>
<!doctype html>
<html class="fixed">
	<head>
		<?php
			date_default_timezone_set('Asia/Calcutta');
		?>
		<!-- Js url -->
		<script type="text/javascript" language="javascript">
			var js_site_url='<?php echo base_url(); ?>';
  		</script>
  		<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
  		<input type="hidden" class="base_url" value="<?php echo base_url(); ?>" />
		<!-- Js url --> 
		<!-- Basic -->
		<meta charset="UTF-8">
		
		<title>Smartworks :: Private Office Agreement</title>
		<meta name="keywords" content="Telefone deal Admin Panel" />
		<meta name="description" content="Telefone deal Admin Panel">
		<meta name="author" content="simayaa" >
		<meta http-equiv="Cache-control" content="no-cache">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/morris.js/morris.css" />
 		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/fullcalendar/fullcalendar.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/fullcalendar/fullcalendar.print.css" media="print" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/select2-bootstrap-theme/select2-bootstrap.css" />
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
        
		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/stylesheets/theme.css" />
         <link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/summernote/summernote.css" />
		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/stylesheets/theme-custom.css">
		<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css">
        <!----Timepicker CSS--->
        
        
        <!--nivo slider css-->
        <link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/nivo-themes/default/default.css" type="text/css" media="screen" />
    	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/nivo-themes/light/light.css" type="text/css" media="screen" />
    	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/nivo-themes/dark/dark.css" type="text/css" media="screen" />
    	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/nivo-themes/bar/bar.css" type="text/css" media="screen" />
    	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/nivo-style/nivo-slider.css" type="text/css" media="screen" />
    	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/nivo-style/nivo-style.css" type="text/css" media="screen" />
        
	    <script src="<?php echo $this->config->item('base_url');?>/html/admin1/assets/vendor/jquery/jquery.js"></script>
		<!-- Head Libs -->
		<script src="<?php echo $this->config->item('base_url');?>assets/admin/modernizr/modernizr.js"></script>
		
  <section class="panel">
   
    <div class="panel-body" style="background:#000;">
      <h2 class="panel-title" >office service agreement</h2>
    </div>
    <div class="panel-body panel_body_top"> 
    	<form class="form-inline" name="frmseatallocation" id="frmseatalloc" method="post">
                 <div class="col-md-12 selection">                            
                     <label for="inputDefault" class="col-md-3 control-label" style="padding:20px 0 0;">agreement date&nbsp;(dd/mm/yy)</label>
                        <div class="col-md-3" style="padding:15px 18px 0;">
                          <div class="input-daterange input-group" data-plugin-datepicker>
                            <span class="input-group-addon">
                              <?php echo date('dS M Y',strtotime($agreementdata[0]['agreement_date']));?>
                            </span>
                                
                          </div>
                        </div>
                     <label for="reference" class="col-md-3 control-label" style="padding:20px 0 0 15px;">reference no</label>
                     	<div class="col-md-3" style="padding-top:15px;">
                     	<span class="input-group-addon">
                            <?php echo $agreementdata[0]['referenceno'];?> </span>  
                        </div>
                      </div>
                       <div class="clearfix"></div>             
            </form>
            <div class="clearfix"></div>
            <div class="addresses">
            	<aside class="col-xs-12 col-md-6 col-lg-6">
                	<table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<th style="background:#000; color:#fff; font-weight:normal; border:1px solid #000;">business centre address</th>
                        </tr>
                        <tr>
                        	<td style="height:30px;"><span><?php echo substr($business_center[0]['address'],0,60);?></span></td>
                        </tr>
                        <tr>
                        	<td style="height:30px;"><span><?php echo substr($business_center[0]['address'],60,120);?></span></td>
                        </tr>
                        <tr>
                        	<td style="height:30px;"><span ><?php echo substr($business_center[0]['address'],120,180);?></span></td>
                        </tr>
                        <tr>
                        	<td style="height:30px;"><span><?php echo substr($business_center[0]['address'],180,240);?></span></td>
                        </tr>
                        <tr>
                        	<td style="height:30px;"><span><?php echo substr($business_center[0]['address'],240,300);?></span></td>
                        </tr>
                    </table>
                </aside>
                <aside class="col-xs-12 col-md-6 col-lg-6">
                	<table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<th colspan="3" style="background:#000; color:#fff; font-weight:normal; border:1px solid #000;">client address (Not a centre address)</th>
                        </tr>
                        
                        <tr>
                            <td width="30%">contact name</td>
                            <td colspan="2"><?php echo $client_data[0]['FirstName']." ".$client_data[0]['LastName'];?>
                        
                            </td>
                        </tr>
                        <tr>
                        	<td width="30%">company name</td>
                            <td width="50%"><?php echo(($agreementdata[0]['Isclient']==1)?$company[0]['company_name']:$regcompany);?></td>
                            <td width="20%"></td>
                        </tr>
                        <tr>
                        	<td width="30%">address</td>
                            <td colspan="2"><?php echo(($agreementdata[0]['Isclient']==1)?$client_data[0]['address']:$client_data[0]['street']);?></td>
                        </tr>
                        <tr>
                        	<td width="30%">phone</td>
                            <td colspan="2"><?php echo $client_data[0]['phone'];?></td>
                        </tr>
                        <tr>
                        	<td width="30%">email</td>
                            <td colspan="2"><?php echo $client_data[0]['userEmail'];?></td>
                        </tr>
                    </table>
                </aside>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-12">
                 <div class="office_payment">
                    <div class="panel-heading3" style="background:#000;">office payment details (excluding tax/GST and excluding services)</div>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <th width="40%" align="center">office number</th>
                            <th width="20%" align="center">no. of people</th>
                            <th width="30%" align="center">monthly office fee</th>
                            <th width="10%" align="center">currency</th>
                        </tr>
                        <tr>
                        	<td align="center" style="height:30px;"><?php echo $office_no;?></td>
                            <td align="center" style="height:30px;"><?php echo $no_of_people;?></td>
                            <td align="center" style="height:30px;"><?php echo $agreementdata[0]['total_price'];?></td>
                            <td align="center" style="height:30px;">INR</td>
                        </tr>
                        <tr>
                        	<td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                        </tr>
                        <tr>
                        	<td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                        </tr>
                         <tr>
                        	<td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                        </tr>
                        <tr>
                        	<td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                        </tr>
                        <tr>
                        	<td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                            <td align="center" style="height:30px;"></td>
                        </tr>
                        <tr>
                        	<td style="background:#000; color:#fff; font-weight:bold;">total per month</td>
                            <td align="center"><?php echo $no_of_people;?></td>
                            <td align="center"><?php echo $agreementdata[0]['total_price'];?></td>
                            <td align="center">INR</td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<th width="40%" style="background:#000; color:#fff; font-weight:bold;">Initial payment</th>
                            <th width="45%" colspan="2" style="background:#ddd;">first month's fee</th>
                            <th width="15%"><?php echo $agreementdata[0]['total_price'];?></th>
                        </tr>
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td width="25%">Service retainer</td>
                            <td width="20%" align="center"><?php echo $agreementdata[0]['service_retainer'];?></td>
                            <td width="15%"><?php echo $retainer_amount;?></td>
                        </tr>
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td colspan="2" width="45%">total initial payment</td>
                            <td width="15%"><?php echo $total_initial_payment;?></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td style="background:#000; color:#fff; font-weight:bold;" width="40%">total monthly payment</td>
                            <td width="45%" style="background:#ddd;">total monthly payment thereafter</td>
                            <td width="15%"><?php echo $agreementdata[0]['total_price'];?></td>
                        </tr> 
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td width="40%" style="background:#000; color:#fff; font-weight:bold;">service provision</td>
                            <td width="15%" style="background:#ddd;">start date</td>
                            <td width="15%"><?php echo date('dS M Y',strtotime($agreementdata[0]['start_date']));?></td>
                            <td width="15%" style="background:#ddd;">end date*</td>
                            <td width="15%"><?php echo date('dS M Y',strtotime($agreementdata[0]['end_date']));?></td>
                        </tr>
                    </table>
                    <form>
                    	<div class="form-group">
                        	<label>comments</label>
                            <textarea class="form-control" cols="4" rows="4" name="comments" disabled><?php echo $agreementdata[0]['comments'];?></textarea>                        
                        </div>
                        <?php if($agreementdata[0]['IsApproved']==0){?>
                        <div class="form-group">
                        	<input type="checkbox" name="agreecheckbox" value="1">&nbsp;I agree to <a href="<?php echo base_url();?>application/modules/private_office_agreement/wpc134050.pdf" target="_blank">Terms and Condition</a>                      
                        </div>
                        <?php }?>
                        <input type="hidden" name="bookplanid" id="bookplanid" value="<?php echo $agreementdata[0]['id'];?>"/>
                   
                    
                 </div>
         	</div>

     </div>    
  </section>
  <?php if($agreementdata[0]['IsApproved']==0){?>
      <div class="panel-body">
        <button type="button" class="btn agreementacceptbtn">Accept</button>
        <button type="button" class="btn agreementrejectbtn">Reject</button>
        
        <a href="<?php echo base_url(); ?>index.php/private_office_agreement/vprivate_office_agreement_print/<?= $agreementdata[0]['id'] ?>" class="btn pre agreementacceptbtn_print" target="_blank"><i class="fa fa-print"></i> Print Agreement</a>
        </form>
    </div>
  <?php }else{?>
  <div class="panel-body">
  <a href="<?php echo base_url(); ?>index.php/private_office_agreement/vprivate_office_agreement_print/<?= $agreementdata[0]['id'] ?>" class="btn pre agreementacceptbtn_print" target="_blank"><i class="fa fa-print"></i> Print Agreement</a>
  </div>
  <?php }?>
  <style>
      .agreementacceptbtn{background:#000;color:#fff;}
      .agreementrejectbtn{background:#000;color:#fff;}
      .agreementacceptbtn_print {
background: #000;
color: #fff;
}
  </style>
<script type="text/javascript">
   $(document).ready(function(){

       $('.agreementacceptbtn').click(function(){
             if($('input[name=agreecheckbox]').is(":checked")){
                var bookplanid=$('#bookplanid').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/private_office_agreement/acceptagreement/",
                    data: "book_floor_plan_id="+bookplanid,
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
             }else{
                alert('Please agree to terms and conditions');

             }
       });
       $('.agreementrejectbtn').click(function(){
            var bookplanid=$('#bookplanid').val();
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/private_office_agreement/rejectagreement/",
                    data: "book_floor_plan_id="+bookplanid,
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
       });

   });
   
</script>