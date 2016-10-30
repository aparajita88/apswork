<div class="modal-dialog modal-sm">
	
                        <div class="modal-content">
							<form id="frmapproval" methos="post">
								
								 <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Completion of Request</h4>
                            </div>
                            <div class="modal-body">
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
                                 <?php if($legal_support[0]['IsApproved']=="1"){?>
                                 <div class="form-group">
                                    <label><strong>Price :</strong> </label> <?php if($legal_support){echo $legal_support[0]['price'];}?>
                                    
                                 </div>
                                <?php }?>
                                
                                
                            </div>
                            <div class="modal-footer">
                                                            </div>
							</form>
                           
                        </div>
                    </div>
                  
