<div class="modal-dialog modal-sm">
	<?php //print_r($booking_info);?>
                        <div class="modal-content">
							<form id="frmapproval" methos="post">
								
								 <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Approval of Booking</h4>
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
                                
                                 <?php if($booking_info[0]['is_approved']=="1"){?>
                                 <div class="form-group">
                                    <label><strong>Price :</strong> </label> <?php if($booking_info){echo $booking_info[0]['price'];}?>
                                    
                                 </div>
                                <?php }?>
                                
                                
                            </div>
                            <div class="modal-footer">
                                                            </div>
							</form>
                           
                        </div>
                    </div>
                  
