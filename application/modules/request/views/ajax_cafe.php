	
                    
                    
                    
                  
                    				<!-- Tea -->
                    				<?php if(!empty($cafe_cat)){
						foreach($cafe_cat as $key=>$value) {?>
                                    <div class="section_min">
									  
                                        <div class="col-md-3"><div class="rounddiv"><img src="<?php echo base_url();?>assets/uploads/images/cafe_image/<?php echo $value['image']; ?>" title="<?php echo $value['name'] ;?>"/> </div>
											<input type="hidden" value="<?php echo $value['id'] ;?>"   name="cat[]" class="cat" >
											<input type="hidden" name="subcat[]" class="subcat" id="subcat<?php echo $value['id'];?>"/>
											<input type="hidden" name="subqty[]" class="subqty" id="subqty<?php echo $value['id'];?>">
											<input type="hidden" name="totprice[]" class="totprice" id="totprice<?php echo $value['id'];?>" value="0">
											</label></div>
                                        <div class="col-md-9 ">
											
                                        <?php $catid=$value['id'];
                                        $subcat=$this->rooms_model->get_cafe_subcat($value['id']);
                                        foreach($subcat as $key=>$val){?>
                                        <input type="hidden" name="price_<?php echo $val['id'] ;?>" id="price_<?php echo $val['id'] ;?>" value="<?php echo $val['price'] ;?>"/>
                                        	<label for="" class="col-md-4 control-label cl_heignt checkbox">
												<input type="checkbox" name="radio_subcat_<?php echo $value['id'] ;?>"   class="radio_subcat cat_<?php echo $val['id'] ;?>" value="<?php echo $val['id'] ;?>" onClick="fnsubcat(this.value,'<?php echo $catid;?>',this)"/><?php echo $val['name'] ;?>
                                                <div class="col-md-12 " style="padding:0;">
                                        	<label for="" class="col-md-2 control-label"  style="padding:0;margin: 10px 0 0 -19px;">Qty.</label>
                                            <div class="col-md-7" style="padding:0; margin-top:10px;">
                                            	<input type="text" id="qty_<?php echo $val['id'] ;?>" value="" name="qty[]" class="form-control" style="width:60px;">	
                                            </div>
                                        </div>
                                                </label>
                                                
                                          <?php }?>
                                        </div>
                                       
                                         <div class="clearfix"></div> 
                                    </div>
                                     <?php }}else{?> 
                                  
                                  <div>NO DATA</div>
				  <?php }?>
                                    <!-- /Tea -->
				
		
	
		