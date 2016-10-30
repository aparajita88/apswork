<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<?php
$UserSubscriptionId = $my_subscription[0]['UserSubscriptionId']; // user's memberid
switch ($UserSubscriptionId) {
    case $subscription[1]['Id']:
        $style1 = ''; 
        break;
    case $subscription[2]['Id']:
        $style1 = 'style="margin-left: 358px;"'; 
        break;
    case $subscription[3]['Id']:
        $style1 = 'style="margin-left: 645px;"'; 
        break;
    default:
        break;
}
?>
<script>
    
             
        function getData()
        {
            var d = new Date();
            var n = d.getTime();
            var orderID = n +  '' +randomFromTo(0,1000);
            
            document.getElementById("OrderId").value = orderID;
            return true;
        }

        function randomFromTo(from, to){
            return Math.floor(Math.random() * (to - from + 1) + from);
        }   
    
</script>
<body onload="getData();">
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title"><?php echo $table_heading; ?></h2></div>
            <?php //print_r($my_subscription);?>					
			<div class="panel-body panel_body_top"><?php if($my_subscription[0]['orderId']==1){?><h4><b>Your current membership is Basic.</b></h4><?php }?>
            <div id="msg"></div>
                <?php if($my_subscription[0]['orderId']!=1){?>
            		<div class="hover-tooltip" <?= $style1; ?>>
                    	<div class="innercontent">
                        	<i class="fa fa-check-circle-o" aria-hidden="true"></i>
							<p>your current membership</p>
                        </div>

                    </div>
                    <?php }?>
				 <div class="table-responsive">
                 <?php  $attributes = array('name' => 'registrationform','id' => 'sign-up-form','class'=>"for_sign_up");
           echo form_open('index.php/users/upgrade_membership',$attributes);?>
                 	<table cellpadding="0" cellspacing="0" class="table membership-table">
                    	<tr>
                        	<th width="40%" rowspan="2">&nbsp;</th>

                            <th width="20%" align="center" class="lightgrey" style="text-align:center;"><strong><?php echo $subscription[1]['name']; ?></strong></th>
                            <th width="20%" align="center" class="moderategrey" style="text-align:center;"><strong><?php echo $subscription[2]['name']; ?></strong></th>
                            <th width="20%" align="center" class="darkgrey" style="text-align:center;"><strong><?php echo $subscription[3]['name']; ?></strong></th>
                        </tr>
                        <tr>
                            <td align="center" class="lightgrey">INR <?php echo $subscription[1]['price']; ?> Onwards</td>
                            <td align="center" class="moderategrey">INR <?php echo $subscription[2]['price']; ?> Onwards</td>
                            <td align="center" class="darkgrey">INR <?php echo $subscription[3]['price']; ?> Onwards</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Private Office</strong></td>
                            <td class="lightgrey">&nbsp;</td>
                            <td align="center" class="moderategrey">2 days is for private office</td>
                            <td align="center" class="darkgrey">5 days is for private office</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Smart Community</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Walk in and work</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Virtual Office</strong></td>
                            <td class="lightgrey">&nbsp;</td>
                            <td align="center" class="moderategrey">5% discount on virtual office monthly fee</td>
                            <td align="center" class="darkgrey">10% discount on virtual office monthly fee</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Free refreshments</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                         <tr>
                        	<td class="orangebg"><strong>Free Wi-Fi</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Meeting from Conference Rooms & Videoconferencing and day office discounts</strong></td>
                           	<td align="center" class="lightgrey">10%</td>
                            <td align="center" class="moderategrey">15%</td>
                            <td align="center" class="darkgrey">15%</td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Concierge</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Events*</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                        	<td class="orangebg"><strong>Offers on Smart Alliance**</strong></td>
                            <td align="center" class="lightgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="moderategrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                            <td align="center" class="darkgrey"><i class="fa fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <?php //print_r($subscription);
                        $first_day_of_month = strtotime(date('Y-m-01'));
                        $last_day_of_month = strtotime(date('Y-m-t 23:59:59'));
                        
                         if ((strtotime($my_subscription[0]['UserSubscriptiondate']) >= $first_day_of_month) && (strtotime($my_subscription[0]['UserSubscriptiondate']) <= $last_day_of_month)){
                         $disabled='disabled' ;
                        }else{
                        $disabled='' ;
                         }
                        ?>
                        <tr>
                        	<td>&nbsp;</td><?php if($my_subscription[0]['orderId']==1){ ?>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[1]['Id']; ?>" data-price="<?php echo $subscription[1]['price']; ?>" data-sid="<?php echo $subscription[1]['Id']; ?>" class="btn btn-block btn-lg">Upgrade Now</button></td>
                        
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[2]['Id']; ?>" data-price="<?php echo $subscription[2]['price']; ?>" data-sid="<?php echo $subscription[2]['Id']; ?>" class="btn btn-block btn-lg">Upgrade Now</button></td>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[3]['Id']; ?>" data-price="<?php echo $subscription[3]['price']; ?>" data-sid="<?php echo $subscription[3]['Id']; ?>" class="btn btn-block btn-lg">Upgrade Now</button></td>
                            <?php }else if($my_subscription[0]['orderId']==2){?>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[1]['Id']; ?>" data-price="<?php echo $subscription[1]['price']; ?>" data-sid="<?php echo $subscription[1]['Id']; ?>"  class="btn btn-block btn-lg" <?//= $disabled; ?> style="background-color: #626262;">Renew Now</button></td>
                            
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[2]['Id']; ?>" data-price="<?php echo $subscription[2]['price']; ?>" data-sid="<?php echo $subscription[2]['Id']; ?>" class="btn btn-block btn-lg">Upgrade Now</button></td>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[3]['Id']; ?>" data-price="<?php echo $subscription[3]['price']; ?>" data-sid="<?php echo $subscription[3]['Id']; ?>" class="btn btn-block btn-lg">Upgrade Now</button></td>

                            <?php }else if($my_subscription[0]['orderId']==3){?>
                                 <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[1]['Id']; ?>" data-price="<?php echo $subscription[1]['price']; ?>" data-sid="<?php echo $subscription[1]['Id']; ?>"  class="btn btn-block btn-lg" disabled style="background-color: #626262;">Upgrade Now</button></td>
                            
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[2]['Id']; ?>" data-price="<?php echo $subscription[2]['price']; ?>" data-sid="<?php echo $subscription[2]['Id']; ?>" class="btn btn-block btn-lg" <?//= $disabled; ?> style="background-color: #626262;">Renew Now</button></td>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[3]['Id']; ?>" data-price="<?php echo $subscription[3]['price']; ?>" data-sid="<?php echo $subscription[3]['Id']; ?>" class="btn btn-block btn-lg">Upgrade Now</button></td>
                            <?php }else if($my_subscription[0]['orderId']==4){?>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[1]['Id']; ?>" data-price="<?php echo $subscription[1]['price']; ?>" data-sid="<?php echo $subscription[1]['Id']; ?>"  class="btn btn-block btn-lg" disabled style="background-color: #626262;">Upgrade Now</button></td>
                            
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[2]['Id']; ?>" data-price="<?php echo $subscription[2]['price']; ?>" data-sid="<?php echo $subscription[2]['Id']; ?>" class="btn btn-block btn-lg" disabled style="background-color: #626262;">Upgrade Now</button></td>
                                <td align="center" class="mymembershipbtn"><button type="button" id="btn_<?php echo $subscription[3]['Id']; ?>" data-price="<?php echo $subscription[3]['price']; ?>" data-sid="<?php echo $subscription[3]['Id']; ?>" class="btn btn-block btn-lg" <?//= $disabled; ?> style="background-color: #626262;">Renew Now</button></td>
                            <?php }?>
                        </tr>
                    </table>
                 </div>
                 
               <td><input type="hidden" value="" id="upsub_id" name="upsub_id"></td>
               <td><input type="hidden" value="" id="OrderId" name="OrderId"></td>
               <td><input type="hidden" value="" id="amount" name="amount"></td>
               <td><input type="hidden" value="INR" id="currencyName" name="currencyName"> </td>
               <td><input type="hidden" value="S" id="meTransReqType" name="meTransReqType"></td>
               <td><input type="hidden" name="mid" id="mid" value="WL0000000027698"></td>
               <td><input type="hidden" name="enckey" id="enckey" value="6375b97b954b37f956966977e5753ee6"></td>
               <td><input type="hidden" name="responseUrl" id="responseUrl" value="<?php echo $this->config->item('base_url');?>index.php/users/upgrade_payment_response"/></td>
                 <?php echo form_close();?>
			</div>
	</section>		
</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('button[id^="btn_"]').click(function(){
    var sid = $(this).data("sid");
    var uid='<?php echo $my_subscription[0]['userId']; ?>';
    var url = '<?php echo base_url(); ?>';
    var price= $('#amount').val($(this).data("price"));
    $('#upsub_id').val($(this).data("sid"));
    var flag=($(this).text()).trim();
   // alert(flag);
   // exit;
    if (sid != '') {
   // console.log($(this).data("price"));
      console.log($(this).data("price"));
        $.ajax({
             method: "POST",
             url: url+"index.php/users/membership_check_bydate",
             data: { uid:uid,sid:sid},
             async: false,
             success: function(data, textStatus, jqXHR) {
             //alert(data);
            if(data==0){
             $("#sign-up-form").submit();
            }else{
                if(flag=='Renew Now'){
                $("#msg").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>You can not Renew your membership within a current month !!</strong></div>');    
                }else{
           $("#msg").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>You can not Upgrade your membership within a current date !!</strong></div>');
              }
             }
            }
           
         });
    }
    });
});
</script>