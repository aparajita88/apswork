<div class="modal-dialog modal-sm">
	
                        <div class="modal-content">
							<form id="frmapproval" methos="post">
								<input type="hidden" name="appid" value="<?php if($legal_support){echo $legal_support[0]['id'];}?>"/>
								<input type="hidden" name="custid" id="custid" value="<?php if($legal_support){echo $legal_support[0]['company_id'];}?>"/>
								<input type="hidden" name="appdesc" id="appdesc" value="<?php if(!empty($legal_support[0]['description'])){echo $legal_support[0]['description'];}else{echo $legal_support[0]['package_description'];}?>"/>
								<input type="hidden" name="tbname" id="tbname" value="<?php echo $tbname;?>"/>
								 <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Completion of Request</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Client :</strong></label>&nbsp;<?php if($legal_support){echo $legal_support[0]['company_name'];}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>City :</strong></label>&nbsp;<?php if($legal_support){echo $legal_support[0]['cites'];}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>Location :</strong> </label>&nbsp;<?php if($legal_support){echo $legal_support[0]['location'];}?>
                                    
                                 </div>
                                 <?php if(!empty($legal_support[0]['start_date'])){?>
                                <div class="form-group">
                                    <label><strong>From Date :</strong></label>&nbsp;<?php if($legal_support){echo date('d/m/Y',strtotime($legal_support[0]['start_date']));}?>
                                    
                                 </div>
                                 <?php }?>
                                 <?php if(!empty($legal_support[0]['end_date'])){?>
                                 <div class="form-group">
                                    <label><strong>End Date :</strong></label>&nbsp;<?php if($legal_support){echo date('d/m/Y',strtotime($legal_support[0]['end_date']));}?>
                                    
                                 </div>
                                 <?php }?>
                                 <div class="form-group">
                                    <label><strong>Description :</strong></label>
                                    <?php if($legal_support){if(!empty($legal_support[0]['description'])){echo $legal_support[0]['description'];}else{echo $legal_support[0]['package_description'];}}?>
                                 </div>
                                 <?php if(!empty($legal_support[0]['destination'])){?>
                                 <div class="form-group">
                                    <label><strong>Destination :</strong></label>&nbsp;<?php if($legal_support){echo $legal_support[0]['destination'];}?>
                                    
                                 </div>
                                 <?php }?>
                                 <div class="form-group">
									 <div class="col-sm-12" style="padding-left:0;">
                                    <label class="col-sm-4" style="padding-left:0;"><strong>Price <sup>* </sup> :</strong> </label>
                                    <div class="col-sm-8">
										<input type="text" class="form-control" placeholder="Price" name="price" id="appprice" value="<?php if($legal_support){if($tbname=='request_stuff_service' || $tbname=='request_courier_service'){echo $legal_support[0]['price'];}}?>">
                                    </div>
                                    </div>
                                 </div>
                                
                                
                                
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-success btn_black" id="btnsubapproved">CLOSE REQUEST</button>
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
			  url: '<?php echo base_url();?>index.php/manager/approved_request', 
			  type: 'post', 
			  data:$("#frmapproval").serialize(),
			  
			success: function(result) {
				
				   if($("#tbname").val()=="request_stuff_service"){
					   location.href = '<?php echo base_url();?>index.php/manager/service_request';
				   }if($("#tbname").val()=="request_courier_service"){
					   location.href = '<?php echo base_url();?>index.php/manager/service_request';
				   }
				   
			   
				}
			});
		}
			 });
});
                    </script>
