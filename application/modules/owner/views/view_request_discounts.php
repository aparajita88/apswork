<div class="modal-dialog modal-sm">
	
                        <div class="modal-content">
							<form id="frmapproval" methos="post">
								<input type="hidden" name="appid" id="appid" value="<?php if($discount_info){echo $discount_info[0]['id'];}?>"/>
								<input type="hidden" id="appid_status" name="appid_status" value="1"/>
								 <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">View of Discount</h4>
                            </div>
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
                           
							</form>
                           
                        </div>
                    </div>
                   
