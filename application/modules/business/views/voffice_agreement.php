<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
    <div class="right-wrapper pull-right">
      </ol>
    </div>
  </header>
  <section class="panel">
    <?php if($this->session->flashdata('item')){ ?>
    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
    <?php } ?>
    <?php if($this->session->flashdata('item_error')){ ?>
    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
    <?php } ?>
    <div class="panel-body">
      <h2 class="panel-title">office service agreement</h2>
    </div>
    <div class="panel-body panel_body_top"> 
    	<form class="form-inline" name="frmseatallocation" id="frmseatalloc" method="post">
                 <div class="col-md-12 selection">                            
                     <label for="inputDefault" class="col-md-3 control-label" style="padding:20px 0 0;">agreement date&nbsp;(dd/mm/yy)</label>
                        <div class="col-md-3" style="padding:15px 0 0;">
                          <div class="input-daterange input-group" data-plugin-datepicker>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Enter start Date" name="agreement_date" id="start">    
                          </div>
                        </div>
                     <label for="reference" class="col-md-3 control-label" style="padding:20px 0 0 15px;">reference no</label>
                     	<div class="col-md-3" style="padding:15px 0 0;">
                            <input type="text" class="form-control" placeholder="reference no." name="reference" id="reference" value="<?php echo rand(1000000,9999999);?>" disabled>    
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
			<?php $business_data=explode(",",$b_id[0]['address']);
			//print_r($business_data);?>
                        <tr>
                        	<td><input type="text" value="<?php echo $b_id[0]['businessName'];?>" name="businessName" readonly/></td>
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
                        	<th colspan="3" style="background:#000; color:#fff; font-weight:normal; border:1px solid #000;">client address <br />(Not a centre address)</th>
                        </tr>
                         <tr>
                            <td colspan="3"><input type="radio" name="user_info" id="reguserinfo" value="1" checked onchange="fnoffclientinfo('register')"/>&nbsp; &nbsp;Prospect &nbsp; &nbsp; <input type="radio" name="user_info" id="extuserinfo" value="1" onchange="fnoffclientinfo('user')"/>&nbsp; &nbsp;Existing User</td>
                        </tr>
                        <tr>
                            <td width="30%">contact name</td>
                            <td colspan="2"><input type="text" value="" name="contact_name" onkeyup="ajaxSearch();" />
                            <div id="suggestions">
                            <div id="autoSuggestionsList"></div>
                        </div>
                            </td>
                        </tr>
                        <tr>
                        	<td width="30%">company name</td>
                            <td width="50%"><input type="text" value="" name="company_name"/></td>
                           
                        </tr>
                        <tr>
                        	<td width="30%">address</td>
                            <td colspan="2"><input type="text" value="" name="address"/></td>
                        </tr>
                        <tr>
                        	<td width="30%">phone</td>
                            <td colspan="2"><input type="text" value="" name="phone"/></td>
                        </tr>
                        <tr>
                        	<td width="30%">email</td>
                            <td colspan="2"><input type="text" value="" name="email" readonly/></td>
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
			  				<td style="color:#000;"><?php echo $b_id[0]['name'];?></td>
						</tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<th width="40%" style="background:#000; color:#fff; font-weight:bold;">Initial payment</th>
                            <th width="45%" colspan="2" style="background:#ddd;">first month's fee</th>
                            <th width="15%" readonly><?php echo $b_id[0]['price']; ?></th>
			</tr>
			 <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td colspan="2" width="45%">One time registration fee</td>
                            <td width="15%"><input type="text" value="<?php echo $b_id[0]['onetime_price']; ?>" name="registration_fee" readonly/></td>
                        </tr>
			
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td width="25%">Service retainer</td>
                            <td width="20%" align="center"><input type="text" value="3" name="" /></td>
                            <td width="15%"><input type="text" value="<?php echo 3*$b_id[0]['price']; ?>" name="service_retainer" readonly/></td>
                        </tr>
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td colspan="2" width="45%">total initial payment</td>
                            <td width="15%"><input type="text" name="total_price" value="<?php echo (3*$b_id[0]['price'])+($b_id[0]['price'])+($b_id[0]['onetime_price']); ?>" name="" readonly/></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td style="background:#000; color:#fff; font-weight:bold;" width="40%">total monthly payment</td>
                            <td width="45%" style="background:#ddd;">total monthly payment thereafter<br/>(Excl. locat Vat/Gst/Tax)</td>
                            <td width="15%"><input type="text" value="<?php echo $b_id[0]['price']; ?>" name="monthly_payment" readonly/></td>
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
                                            <input type="text" class="form-control" placeholder="Enter start Date" name="start_date" id="start">    
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
                                            <input type="text" class="form-control" placeholder="Enter end Date" name="end_date" id="end">    
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
                            <textarea class="form-control" name="comments" cols="4" rows="4"></textarea>                        
                        </div>
                    </form>
                    <p><br /></p>
                 </div>
         	</div>

     </div>    
  </section>
  <input type="hidden" name="first_month_fee" value="<?php echo $b_id[0]['price']; ?>"/>
  <input type="hidden" name="voffice_id" value="<?php echo $v_id;?>"/>
  <input type="hidden" name="business_id" value="<?php echo $b_id[0]['business_id'];?>"/>
  <input type="hidden" name="userId" value=""/>
  
  <div class="panel-body">
    	<button type="button" class="btn agreementbtn">send agreement</button>
    </div>
</section>
<section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<style>
.agreementbtn{
    background:#000;
    color:#fff;
}
</style>
<script type="text/javascript">
function fnoffclientinfo(utype){
           $('input[name=contact_name]').val('');
           $('input[name=phone]').val('');
           $('input[name=email]').val('');
           $('input[name=address]').val('');
           $('input[name=company_name]').val('');
           $('input[name=userId]').val('');
           $('#suggestions').hide();
}
function ajaxSearch() {
        var usertype;
        if($('#reguserinfo').is(':checked')){
           usertype='register';
        }else if($('#extuserinfo').is(':checked')){
           usertype='user';
        }

            var input_data = $('input[name=contact_name]').val();
            //alert(input_data);
            if (input_data.length === 0) {
                $('#suggestions').hide();
            } else {
              
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/manager/autocomplete/",
                    data: "eml="+input_data+'&usertype='+usertype,
                    success: function(data) {
                        
                        if (data.length > 0) {
                            $('#suggestions').show();
                            $('#autoSuggestionsList').addClass('auto_list');
                            $('#autoSuggestionsList').html(data);
                            
                        }
                    }
                });

            }
        }
function litxt(txt){
            var contdata=txt.split('[');
            var spleml=contdata[1].split(']');
            var eml=spleml[0];
            var usertype;
            if($('#reguserinfo').is(':checked')){
                   usertype='register';
                }else if($('#extuserinfo').is(':checked')){
                   usertype='user';
                }
            $('input[name=contact_name]').val(contdata[0]);
            $('#suggestions').hide();
            var udata;
    var cityid;
    
    $.ajax
    ({ 
        url: '<?php echo base_url();?>index.php/manager/user_display_info',
        data: "eml="+eml+'&usertype='+usertype,
        type: 'post',
        success: function(response)
        {

           $('input[name=phone]').val('');
           $('input[name=email]').val('');
           $('input[name=address]').val('');
           $('input[name=company_name]').val('');
           $('input[name=userId]').val('');
            udata=JSON.parse(response);
               $('input[name=address]').val(udata[0].street); 
               $('input[name=company_name]').val(udata[0].company_name); 
               $('input[name=phone]').val(udata[0].phone);
               $('input[name=email]').val(udata[0].userEmail);
               $('input[name=userId]').val(udata[0].userId);
               if(typeof(udata[0].company_name)!="undefined"){
                  $('input[name=company_name]').val(udata[0].company_name);
               }
               if(typeof(udata[0].address)!="undefined"){
                  $('input[name=address]').val(udata[0].address);
               }
               
           
            
        }
    });
            
        }
	$(document).ready(function(){
            $('.agreementbtn').click(function(){
                var userId=$('input[name=userId]').val();
                    var company_name=$('input[name=company_name]').val();
                    var agreement_date=$('input[name=agreement_date]').val();
                    var reference=$('input[name=reference]').val();
                    var comments=$('textarea[name=comments]').val();
                    var email=$('input[name=email]').val();
		    var total_price=$('input[name=total_price]').val();
		    var first_month_fee=$('input[name=first_month_fee]').val();
		    var registration_fee=$('input[name=registration_fee]').val();
		    var service_retainer=$('input[name=service_retainer]').val();
		    var monthly_payment=$('input[name=monthly_payment]').val();
		    var start=$('input[name=start_date]').val();
		    var end=$('input[name=end_date]').val();
		    var v_id=$('input[name=voffice_id]').val();
		    var b_id=$('input[name=business_id]').val();
                    var Isclient;
                    var contname=$('input[name=contact_name]').val();
                    if($('#reguserinfo').is(':checked')){
                       Isclient=0;
                    }else if($('#extuserinfo').is(':checked')){
                         Isclient=1;
                    }
                if(agreement_date==""){
                    alert('please enter agreement date');
                    $('input[name=agreement_date]').focus();
                }
                else if($('input[name=contact_name]').val()==""){
                    alert('Please enter the contact name');
                    $('input[name=contact_name]').focus();
                }
		 else if($('input[name=start_date]').val()==""){
                    alert('Please enter start date');
                    $('input[name=start_date]').focus();
                }
		 else if($('input[name=end_date]').val()==""){
                    alert('Please enter the end date');
                    $('input[name=end_date]').focus();
                }else if($('input[name=end_date]').val()==""){
                    alert('Please enter the end date');
                    $('input[name=end_date]').focus();
                }else if($('input[name=comments]').val()==""){
                    alert('Please enter comment');
                    $('input[name=comments]').focus();
                }
                else{
                    
                      $.ajax
                      ({ 
                         url: '<?php echo base_url();?>index.php/business/send_vofficeagreement',
                         data: "userId="+userId+'&v_id='+v_id+'&b_id='+b_id+'&total_price='+total_price+'&agreement_date='+agreement_date+'&reference='+reference+'&total_price='+total_price+'&start='+start+'&end='+end+'&comments='+comments+'&email='+email+'&company_name='+company_name
			 +'&Isclient='+Isclient+'&contname='+contname+'&first_month_fee='+first_month_fee+'&registration_fee='+registration_fee+'&service_retainer='+service_retainer+'&monthly_payment='+monthly_payment,
                         type: 'post',
                         success: function(result)
                         {
                             alert(result);
                         }
                     });
                }
                
            });
        });
       
</script>