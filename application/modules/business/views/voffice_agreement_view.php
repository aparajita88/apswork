<?php //require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<html class="fixed">
<head>
<title>Smartworks ::Virtual office agreement</title>
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
      </head>
      <body>
<section role="main" class="content-body">
  
  <section class="panel">
    
    <div class="panel-body">
      <h2 class="panel-title">Virtual office service agreement</h2>
    </div>
    <?php //print_r($view);?>
    <div class="panel-body panel_body_top"> 
    	<form class="form-inline" name="frmseatallocation" id="frmseatalloc" method="post">
                 <div class="col-md-12 selection">                            
                     <label for="inputDefault" class="col-md-3 control-label" style="padding:20px 0 0;">agreement date&nbsp;(dd/mm/yy)</label>
                        <div class="col-md-3" style="padding:15px 0 0;">
                          <div class="input-daterange input-group" data-plugin-datepicker>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control" value="<?php echo date('dS M Y',strtotime($view[0]['agreement_date']));?>" name="agreement_date" id="start" disabled>    
                          </div>
                        </div>
                     <label for="reference" class="col-md-3 control-label" style="padding:20px 0 0 15px;">reference no</label>
                     	<div class="col-md-3" style="padding:15px 0 0;">
                            <input type="text" class="form-control" placeholder="reference no." name="reference" id="reference" value="<?php echo $view[0]['reference_number'];?>" disabled>    
                        </div>
                      </div>
                       <div class="clearfix"></div>             
            </form>
            <div class="clearfix"></div>
            <div class="addresses">
            	<aside class="col-xs-12 col-md-6 col-lg-6">
                	<table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<th style="background:#000; color:#fff; font-weight:normal; border:1px solid #0088CC;">business centre address</th>
                        </tr>
			<?php $business_data=explode(",",$view[0]['address']);
			//print_r($business_data);?>
                        <tr>
                        	<td><input type="text" value="<?php echo $view[0]['businessName'];?>" name="businessName" readonly/></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php if(!empty($business_data[0])){echo $business_data[0];?>,<?php } if(!empty($business_data[1])){echo $business_data[1]; }?>" name="address1" readonly /></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php if(!empty($business_data[0])){echo $business_data[2];?>,<?php } if(!empty($business_data[3])){echo $business_data[3]; }?>" name="address2" readonly /></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php if(!empty($business_data[4])){echo $business_data[4];?>,<?php } if(!empty($business_data[0])){echo $business_data[5]; }?>" name="address3"  readonly/></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php if(!empty($business_data[6])){echo $business_data[6];?>,<?php } if(!empty($business_data[6])){echo $business_data[7]; ?>,<?php }if(!empty($business_data[6]))
				{echo $business_data[8];} ?>" name="address4" readonly /></td>
                        </tr>
                    </table>
                </aside>
                <aside class="col-xs-12 col-md-6 col-lg-6">
                	<table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<th colspan="3" style="background:#000; color:#fff; font-weight:normal; border:1px solid #0088CC;">client address <br />(Not a centre address)</th>
                        </tr>
                         <tr>
                            <td colspan="3"><input type="radio" name="user_info"  <?php if($view[0]['Isclient']=='0'){echo 'checked=cheked';} ?> disabled/>&nbsp; &nbsp;Prospect &nbsp; &nbsp; <input type="radio" name="user_info" <?php if($view[0]['Isclient']=='1'){echo 'checked=cheked';} ?> disabled/>&nbsp; &nbsp;Existing User</td>
                        </tr>
                        <tr>
                        <?php //print_r($client_user_info); ?>
                            <td width="30%">contact name</td>
                            <td colspan="2"><input type="text" value="<?php if(empty($registered_user_info)){echo $client_user_info['FirstName'];?>  <?php echo $client_user_info['LastName'];}else{echo $registered_user_info[0]['FirstName'];?>  <?php echo $registered_user_info[0]['LastName'];}?>" name="contact_name" readonly/>
                           
                        </div>
                            </td>
                        </tr>
                        <tr>
                        	<td width="30%">company name</td>
                            <td width="50%"><input type="text" value="<?php if(!empty($client_user_info)){echo $client_user_info['company_name'];}else{echo $registered_user_info[0]['company'];}?>" name="company_name" readonly/></td>
                           
                        </tr>
                        <tr>
                        	<td width="30%">address</td>
                            <td colspan="2"><input type="text" value="<?php if(!empty($client_user_info)){echo $client_user_info['address'];}?>" name="address" readonly/></td>
                        </tr>
                        <tr>
                        	<td width="30%">phone</td>
                            <td colspan="2"><input type="text" value="<?php if(empty($registered_user_info)){echo $client_user_info['phone'];}else{echo $registered_user_info[0]['phone'];}?>" name="phone" readonly/></td>
                        </tr>
                        <tr>
                        	<td width="30%">email</td>
                            <td colspan="2"><input type="text" value="<?php if(empty($registered_user_info)){echo $client_user_info['userEmail'];}else{echo $registered_user_info[0]['userEmail'];}?>" name="email" readonly/></td>
                        </tr>
                    </table>
                </aside>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-12">
                 <div class="office_payment">
                    <div class="panel-heading3" style="background:#000; color:#fff; font-weight:bold;">payment details</div>
                    <table class="table table-bordered" width="55%" cellpadding="0" cellspacing="0" style="margin-top:25px; width:55%;">
                        <tr>
                        	<th style="background:#ddd; font-weight:bold;">type of service <br />(Mailbox Plus, Telephone Answering, VO, VO Plus)</th>  
                        </tr>
						<tr>
			  				<td style="color:#000;"><?php echo $view[0]['name'];?></td>
						</tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<th width="40%" style="background:#000; color:#fff; font-weight:bold;">Initial payment</th>
                            <th width="45%" colspan="2" style="background:#ddd;">first month's fee</th>
                            <th width="15%" readonly><?php echo $view[0]['first_month_fee']; ?></th>
			</tr>
			 <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td colspan="2" width="45%">One time registration fee</td>
                            <td width="15%"><input type="text" value="<?php echo $view[0]['first_month_fee']; ?>" name="registration_fee" readonly/></td>
                        </tr>
			
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td width="25%">Service retainer</td>
                            <td width="20%" align="center"><input type="text" value="3" name="" /></td>
                            <td width="15%"><input type="text" value="<?php echo $view[0]['service_retainer']; ?>" name="service_retainer" readonly/></td>
                        </tr>
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td colspan="2" width="45%">total initial payment</td>
                            <td width="15%"><input type="text" name="total_price" value="<?php echo $view[0]['first_month_fee']; ?>" name="" readonly/></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td style="background:#000; color:#fff; font-weight:bold;" width="40%">total monthly payment</td>
                            <td width="45%" style="background:#ddd;">total monthly payment thereafter<br/>(Excl. locat Vat/Gst/Tax)</td>
                            <td width="15%"><input type="text" value="<?php echo $view[0]['first_month_fee']; ?>" name="monthly_payment" readonly/></td>
                        </tr> 
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td width="40%" style="background:#000; color:#fff; font-weight:bold; vertical-align:middle;">service provision</td>
                            <td width="12%" style="background:#ddd; vertical-align:middle;">start date</td>
			    			<td width="18%">
                            	<div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-daterange input-group" data-plugin-datepicker>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" value="<?php echo $view[0]['start_date']; ?>" placeholder="Enter start Date" name="start_date" id="start" readonly>    
                                        </div>
                                    </div>
                                </div>
                        	</td>
                           
                            <td width="12%" style="background:#ddd; vertical-align:middle;">end date*</td>
                           	<td width="18%">
                            	<div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-daterange input-group" data-plugin-datepicker>
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" value="<?php echo $view[0]['end_date']; ?>"placeholder="Enter end Date" name="end_date" id="end" readonly>    
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <p>*All agreements end on the last calender day of the month</p>
                    <form>
                    	<div class="form-group">
                        	<label>comments</label>
                            <textarea class="form-control" name="comments" cols="4" rows="4" readonly><?php echo $view[0]['comment']; ?></textarea>                        
                        </div>
                    </form>
		    <?php if($view[0]['isApproved']=='0'){?>
                    <p><input type="checkbox"  name="privacy" id="privacy"> I agree with the <a href="<?php echo base_url().'assets/Scenarios for direct-indirect client.pdf'; ?>"> Terms & Conditions</a><span class="required">*</span><br /></p>
            <div class="form-group col-md-3">
                            <label>Signed By</label>
                           <input class="form-control" style="background-color: #eee;"  type="text" name="sign_by" id="sign_by" value=""/>                      
                        </div>
                <?php } ?>
		 </div>
         	</div>

     </div>    
  </section>
  <input type="hidden" name="is_client" value="<?php if(!empty($view)){echo $view[0]['Isclient'];}?>"/>
  <input type="hidden" name="booking_id" value="<?php if(!empty($view)){echo $view[0]['id'];}?>"/>
  <input type="hidden" name="company_id" value="<?php if(!empty($client_user_info)){echo $client_user_info['id'];}else{echo $registered_user_info[0]['company'];}?>"/>
  <input type="hidden" name="userId" value="<?php if(empty($registered_user_info)){echo $client_user_info['userId'];}else{echo $registered_user_info[0]['userId'];}?>"/>
 <?php if($view[0]['isApproved']=='0'){?>
  <div class="panel-body">
    	<button type="button" class="btn agreementbtn" >Accept</button>
        <?php }?>
       <a href="<?php echo base_url(); ?>index.php/business/voffice_agreement_view_print/<?= $bid ?>" class="btn pre agreementbtn" target="_blank">  <i class="fa fa-print"></i> Print Agreement</a>
    </div>
    

</section>
</body>
</html>
<?php //require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script src="http://sworks.co.in/html/admin1/assets/vendor/jquery/jquery.js"></script>
<style type="text/css">
html.fixed .content-body {
margin-left: 0px !important;
}
.agreementbtn{
    background:#000;
    color:#fff;
}
.pre{
background:#000;
color:#fff;  
}
</style>
<script type="text/javascript">

	$(document).ready(function(){
       var sign_by=$('input[name=sign_by]').val(); 
       if(sign_by==''){
        $('.agreementbtn').prop('disabled', true);
      } 
      $( "#sign_by" ).keyup(function() {
        var input = $(this);
        if( input.val() == "" ) {
          $('.agreementbtn').prop('disabled', true);
        }else{
          $('.agreementbtn').prop('disabled', false); 
        } 
      });
     $('.agreementbtn').click(function(){
      if(privacy.checked == false){
     alert('Please check Terms & Condition');
     return false;
}
else{
      var company_id=$('input[name=company_id]').val();
      var userId=$('input[name=userId]').val();
      var booking_id=$('input[name=booking_id]').val();
      var is_client=$('input[name=is_client]').val();
     // alert(userId);
     var confm=confirm('Are you sure to accept the agreement?');
	if(confm==true)
	{
	  var isApproved='1';
	
	 $.ajax
                      ({ 
                         url: '<?php echo base_url();?>index.php/business/accept_vofficeagreement',
                         data: "userId="+userId+'&company_id='+company_id+'&booking_id='+booking_id+'&isApproved='+isApproved+'&is_client='+is_client,
                         type: 'post',
                         success: function(result)
                         {
                             alert(result);
                             location.href =  location.href;
                         }
                     });
      }
}

     });
        });
	
</script>