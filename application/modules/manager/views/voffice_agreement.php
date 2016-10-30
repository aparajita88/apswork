<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<?php $total_initial_payment=$book_floor_data[0]['total_price']*$office_info[0]['service_retainer']+$book_floor_data[0]['total_price'];
$retainer_amount=$book_floor_data[0]['total_price']*$office_info[0]['service_retainer'];?>

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
                        <div class="col-md-3" style="padding:15px 18px 0;">
                          <div class="input-daterange input-group" data-plugin-datepicker>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Enter start Date" name="agreement_date" id="start" readonly>    
                          </div>
                        </div>
                     <label for="reference" class="col-md-3 control-label" style="padding:20px 0 0 15px;">reference no</label>
                     	<div class="col-md-3" style="padding-top:15px;">
                            <input type="text" class="form-control" placeholder="reference no." name="reference" id="reference" value="<?php echo rand(1000000,9999999);?>" readonly>    
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
                        <tr>
                        	<td><input type="text" value="<?php echo substr($business_center[0]['address'],0,60);?>" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php echo substr($business_center[0]['address'],60,120);?>" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php echo substr($business_center[0]['address'],120,180);?>" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php echo substr($business_center[0]['address'],180,240);?>" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td><input type="text" value="<?php echo substr($business_center[0]['address'],240,300);?>" name="" readonly/></td>
                        </tr>
                    </table>
                </aside>
                <aside class="col-xs-12 col-md-6 col-lg-6">
                	<table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<th colspan="3" style="background:#000; color:#fff; font-weight:normal; border:1px solid #000;">client address (Not a centre address)</th>
                        </tr>
                        <tr>
                            <td width="40%"><input type="radio" name="user_info" id="reguserinfo" value="1" checked onchange="fnoffclientinfo('register')"/>Prospect</td>
                            <td colspan="2"><input type="radio" name="user_info" id="extuserinfo" value="1" onchange="fnoffclientinfo('user')"/>Existing User</td>
                        </tr>
                        <input type="hidden" name="userId" value=""/>
                        <input type="hidden" name="bookfloorplanid" value="<?php echo $this->session->userdata('book_floor_id');?>"/>
                        <tr>
                            <td width="30%">contact name</td>
                            <td colspan="2"><input type="text" value="" name="contact_name" onkeyup="ajaxSearch();"/>
                            <div id="suggestions">
                            <div id="autoSuggestionsList"></div>
                        </div>
                            </td>
                        </tr>
                        <tr>
                        	<td width="30%">company name</td>
                            <td width="50%"><input type="text" value="" name="company_name"/></td>
                            <td width="20%"><input type="text" value="" name="" readonly/></td>
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
                            <td colspan="2"><input type="text" value="" name="email"/></td>
                        </tr>
                    </table>
                </aside>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-12">
                 <div class="office_payment">
                    <div class="panel-heading3" style="background:#000;"">office payment details (excluding tax/GST and excluding services)</div>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <th width="40%" align="center">office number</th>
                            <th width="20%" align="center">no. of people</th>
                            <th width="30%" align="center">monthly office fee</th>
                            <th width="10%" align="center">currency</th>
                        </tr>
                        <tr>
                        	<td align="center"><input type="text" value="<?php echo $office_no;?>" name="officeno" readonly/></td>
                            <td align="center"><input type="text" value="<?php echo $no_of_people;?>" name="" readonly/></td>
                            <td align="center"><input type="text" value="<?php echo $book_floor_data[0]['total_price'];?>" name="" readonly/></td>
                            <td align="center"><input type="text" value="INR" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td align="center"><input type="text" value="" name="" readonly="" /></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                        </tr>
                         <tr>
                        	<td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                            <td align="center"><input type="text" value="" name="" readonly/></td>
                        </tr>
                        <tr>
                        	<td style="background:#000; color:#fff; font-weight:bold;">total per month</td>
                            <td align="center"><input type="text" value="<?php echo $no_of_people;?>" name="" readonly/></td>
                            <td align="center"><input type="text" value="<?php echo $book_floor_data[0]['total_price'];?>" name="total_price" readonly/></td>
                            <td align="center"><input type="text" value="INR" name="" readonly/></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<th width="40%" style="background:#000; color:#fff; font-weight:bold;">Initial payment</th>
                            <th width="45%" colspan="2" style="background:#ddd;">first month's fee</th>
                            <th width="15%"><?php echo $book_floor_data[0]['total_price'];?></th>
                        </tr>
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td width="25%">Service retainer</td>
                            <td width="20%" align="center"><input type="text" value="<?php echo $office_info[0]['service_retainer'];?>" name="service_retainer" readonly/></td>
                            <td width="15%"><input type="text" value="<?php echo $retainer_amount;?>" name="retainer_amount" readonly/></td>
                        </tr>
                        <tr>
                        	<td width="40%" style="border-left:1px solid #fff; border-bottom:1px solid #fff;">&nbsp;</td>
                            <td colspan="2" width="45%">total initial payment</td>
                            <td width="15%"><input type="text" value="<?php echo $total_initial_payment;?>" name="initial_payment" readonly/></td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td style="background:#000; color:#fff; font-weight:bold;" width="40%">total monthly payment</td>
                            <td width="45%" style="background:#ddd;">total monthly payment thereafter</td>
                            <td width="15%"><input type="text" value="<?php echo $book_floor_data[0]['total_price'];?>" name="" readonly/></td>
                        </tr> 
                    </table>
                    <table class="table table-bordered" width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                    	<tr>
                        	<td width="40%" style="background:#000; color:#fff; font-weight:bold;">service provision</td>
                            <td width="15%" style="background:#ddd;">start date</td>
                            <td width="15%"><input type="text" value="<?php echo date('dS M Y',strtotime($book_floor_data[0]['start_date']));?>" name="" readonly/></td>
                            <td width="15%" style="background:#ddd;">end date*</td>
                            <td width="15%"><input type="text" value="<?php echo date('dS M Y',strtotime($book_floor_data[0]['end_date']));?>" name="" readonly/></td>
                        </tr>
                    </table>
                    <p>*All agreements end on the last calender day of the month</p>
                    <form>
                    	<div class="form-group">
                        	<label>comments</label>
                            <textarea class="form-control" cols="4" rows="4" name="comments"></textarea>                        
                        </div>
                    </form>
                    
                 </div>
         	</div>

     </div>    
  </section>
  <div class="panel-body">
    	<button type="button" class="btn agreementbtn">send agreement</button>
        <a href="<?php echo base_url(); ?>index.php/private_office_agreement/vprivate_office_agreement_print/<?= $book_floor_data[0]['id'] ?>" class="btn pre agreementacceptbtn_print" target="_blank" <?php if($book_floor_data[0]['book_for_client']==""){?>style="display:none;"<?php }?>>  <i class="fa fa-print"></i> Print Agreement</a>
    </div>
</section>
<section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<style>
.agreementbtn{
    background:#000;
    color:#fff;
}
.agreementacceptbtn_print {
background: #000;
color: #fff;
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
               $('input[name=phone]').val(udata[0].phone);
               $('input[name=email]').val(udata[0].userEmail);
               $('input[name=userId]').val(udata[0].userId);
               if(typeof(udata[0].company_name)!="undefined"){
                  $('input[name=company_name]').val(udata[0].company_name);
               }
               if(typeof(udata[0].address)!="undefined"){
                  $('input[name=address]').val(udata[0].address);
               }
               else if(typeof(udata[0].street)!="undefined"){
                  $('input[name=address]').val(udata[0].street);
               }
           
            
        }
    });
            
        }
        $(document).ready(function(){
            $('.agreementbtn').click(function(){
                var userId=$('input[name=userId]').val();
                    var bookfloorplanid=$('input[name=bookfloorplanid]').val();
                    var total_price=$('input[name=total_price]').val();
                    var agreement_date=$('input[name=agreement_date]').val();
                    var reference=$('input[name=reference]').val();
                    var service_retainer=$('input[name=service_retainer]').val();
                    var comments=$('textarea[name=comments]').val();
                    var email=$('input[name=email]').val();
                    var Isclient;
                    var contname=$('input[name=contact_name]').val();
                    var company_name=$('input[name=company_name]').val();
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
                else{
                    
                      $.ajax
                      ({ 
                         url: '<?php echo base_url();?>index.php/manager/sendagreement',
                         data: "userId="+userId+'&bookfloorplanid='+bookfloorplanid+'&total_price='+total_price+'&agreement_date='+agreement_date+'&reference='+reference+'&service_retainer='+service_retainer+'&comments='+comments+'&email='+email+'&Isclient='+Isclient+'&contname='+contname+'&company='+company_name,
                         type: 'post',
                         success: function(result)
                         {
                             alert(result);
                             $('.agreementacceptbtn_print').show();
                             
                         }
                     });
                }
                
            });
        });
       
</script>