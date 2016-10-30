<div class="modal-dialog modal-sm">
	
                        <div class="modal-content">
							<form id="frmapproval" methos="post">
								<input type="hidden" name="appid" value="<?php if($booking_info){echo $booking_info[0]['id'];}?>"/>
								<input type="hidden" name="custid" id="custid" value="<?php if($booking_info){echo $booking_info[0]['company_id'];}?>"/>
								
								<input type="hidden" name="tbname" id="tbname" value="<?php echo $tbname;?>"/>
								 <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Approval of Request</h4>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Client :</strong></label>&nbsp;<?php if($booking_info){echo $booking_info[0]['FirstName']." ".$booking_info[0]['LastName']." (".$booking_info[0]['company_name'].")";}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>City :</strong></label>&nbsp;<?php if($booking_info){echo $booking_info[0]['cites'];}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>Location :</strong> </label>&nbsp;<?php if($booking_info){echo $booking_info[0]['location'];}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>Name :</strong> </label>&nbsp;<?php if($booking_info){echo $booking_info[0]['conference_room'];}?>
                                    
                                 </div>
                                 <?php if($tbname<>"locker_room" && $tbname<>"game_room"){?>
                                 <div class="form-group">
                                    <label><strong>Purpose :</strong> </label>&nbsp;<?php if($booking_info){echo $booking_info[0]['purpose'];}?>
                                    
                                 </div>
                                 <?php }?>
                                 <div class="form-group">
									 <div class="col-sm-12" style="padding-left:0;">
                                    <label class="col-sm-4" style="padding-left:0;"><strong>Price <sup>* </sup> :</strong> </label>
                                    <div class="col-sm-8">
										<input type="text" class="form-control" placeholder="Price" name="price" id="appprice">
                                    </div>
                                    </div>
                                 </div>
                                
                                
                                
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-success btn_black" id="btnsubapproved">Submit</button>
                                 <button type="button" class="btn btn-info btn_black" data-dismiss="modal">Cancel</button>
                            </div>
							</form>
                           
                        </div>
                    </div>
                    <script type="text/javascript">
						$(document).ready(function(){
		$("#btnsubapproved").click(function(){
			var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
			price=$("#appprice").val();
            if(price==""){
				$("#appprice").attr("placeholder", "Please give the price").placeholder();
				$('#appprice').addClass('redmessage');
				$('#appprice').focus();
				$('#appprice').css('border', 'solid 1px red');
			}else if(!numberRegex.test(price)){
				alert('Please give the numeric value');
				$("#appprice").attr("placeholder", "Please give a valid price").placeholder();
				$('#appprice').addClass('redmessage');
				$('#appprice').focus();
				$('#appprice').css('border', 'solid 1px red');
			}
			else{
			
			$.ajax({
			  url: '<?php echo base_url();?>index.php/manager/approved_booking', 
			  type: 'post', 
			  data:$("#frmapproval").serialize(),
			  
			success: function(result) {
				location.href = '<?php echo base_url();?>index.php/manager/booking_details';
					   
				}
			});
		}
			 });
});
                    </script>
