<input type="hidden" id="party_token" value="<?php echo $party_token; ?>">
<input type="hidden" id="service_token" value="<?php echo $service_token; ?>">
<input type="hidden" id="product_token" value="<?php echo $product_token; ?>">
<input type="hidden" id="vendor_token" value="<?php echo $vendor_token; ?>">
 <div class="modal-content">
          <div class="modal-header modal_new">
            
            <div class="col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal_title_04">Add Reply</h4>
            </div>
       </div>
      
      <div class="modal-body">
      	  
          <!-- Content  -->
          <div class="col-lg-12 form_horizontal_rep">  
          	
            	<form class="form_horizontal " role="form">
                        <!-- <div class="form_part">
                         
                          <div class="form_part_submit">
                           <input type="text" class="form-control" placeholder="Subject">
                          </div>
                          <div class="clearfix"></div>
                        </div>-->
                        <div class="form_part">
                           <div class="form_part_submit">
                           <textarea placeholder="Message" id="vendor_message" class="form-control"></textarea>
                           <a class="btn btn-danger btn_bnt" href="Javascript:void(0)" onclick="sendMessage();">Reply</a>
                          </div>
                          <span id="message-status"></span>
                          <div class="clearfix"></div>
                        </div>
                      <div class="clearfix"></div>
                  </form>
                
                
                <div class="col-lg-12 addreply_comments">
                    <div class="commeent_box" id="content005">
                    	<div class="defult_scroll"></div>	
                       <?php 
                       if(isset($communication) && count($communication)){ 
						foreach($communication as $data){
							if($data['type']=="host"){
					   ?>
                        <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	<?php echo $data['message']; ?>
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo $hostImage; ?>" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         <?php }else{ ?>
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo $vendorImage; ?>" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	<?php echo $data['message']; ?>
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                       <?php 
							}
						}
						echo '<input type="hidden" id="parent_id" value="'.$data['id'].'" />';
                       } 
                       ?>
                    </div>
                </div>
                
            <div class="clearfix"></div>  
          </div>
          <!-- /Content  -->
            
         <div class="clearfix"></div>     
       </div>
     
    </div>
