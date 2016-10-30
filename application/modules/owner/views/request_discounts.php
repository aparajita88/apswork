<div class="modal-dialog modal-sm">
	
                        <div class="modal-content">
							<form id="frmapproval" methos="post">
								<input type="hidden" name="appid" id="appid" value="<?php if($discount_info){echo $discount_info[0]['id'];}?>"/>
								<input type="hidden" id="appid_status" name="appid_status" value="<?php echo $isApproved;?>"/>
								 <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Approval of Discount</h4>
                            </div><?php //print_r($discount_info);?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Company :</strong></label>&nbsp;<?php if($discount_info){echo $discount_info[0]['company_name'];}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>Client :</strong></label>&nbsp;<?php if($discount_info){echo $discount_info[0]['FirstName']."  ". $discount_info[0]['LastName'] ;}?>
                                    
                                 </div>
                                 <div class="form-group">
                                    <label><strong>Discounts :</strong> </label>&nbsp;<?php if($discount_info){echo $discount_info[0]['discounts'];}?>
                                    
                                 </div>
                                
                                 <div class="form-group">
                                    <label><strong>Detailes :</strong></label>
                                    <?php if($discount_info){if(!empty($discount_info[0]['details'])){echo $discount_info[0]['details'];}else{echo $discount_info[0]['details'];}}?>
                                 </div>
                                <div class="form-group">
                                    <label><strong>Date Added :</strong></label>
                                    <?php if($discount_info){if(!empty($discount_info[0]['dateAdded'])){echo $discount_info[0]['dateAdded'];}else{echo $discount_info[0]['dateAdded'];}}?>
                                 </div>
                                
                                
                            </div>
                            <div class="modal-footer">
								<?php if($isApproved=='1'){?>
                                 <button type="button" class="btn btn-success btn_black" id="btnsubapproved">Approve</button>
                                 <?php }else if($isApproved=='2'){?>
								   <button type="button" class="btn btn-success btn_black" id="btnsubapproved">Reject</button>
								   <?php }?>	 
                                 <button type="button" class="btn btn-info btn_black" data-dismiss="modal">Cancel</button>
                            </div>
							</form>
                           
                        </div>
                    </div>
                    <script type="text/javascript">
						$(document).ready(function(){
		$("#btnsubapproved").click(function(){
			//var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
			//price=$("#appprice").val();
            //if(price==""){
				//$("#appprice").attr("placeholder", "Please give the price").placeholder();
				//$('#appprice').addClass('redmessage');
				//$('#appprice').focus();
				//$('#appprice').css('border', 'solid 1px red');
			//}else if(!numberRegex.test(price)){
				//alert('Please give the numeric value');
				//$("#appprice").attr("placeholder", "Please give a valid price").placeholder();
				//$('#appprice').addClass('redmessage');
				//$('#appprice').focus();
				//$('#appprice').css('border', 'solid 1px red');
			//}
			
			appid=$("#appid").val();
			appid_status=$("#appid_status").val();
			$.ajax({
			  url: '<?php echo base_url();?>index.php/owner/approved_discount', 
			  type: 'post', 
			  data:"appid="+appid+"&appid_status="+appid_status,
			  
			success: function(result) {
				//alert(result);

					   location.href = '<?php echo base_url();?>index.php/owner/discounts_list';
				  
				   
			   
				}
			});
		
			 });
});
                    </script>
