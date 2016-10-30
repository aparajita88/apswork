						<?php if(!empty($floor_plan)){?>
                <div class="map_ses">
                  <div class="text-center map001"> <img src="<?php echo $floor_plan[0]['image_path'];?>"  width="900px" height="743px"   alt="" usemap="#planetmap" class="map" />
                    <map name="planetmap">
                      <?php if(!empty($floor_plan_seat)){
                                                 foreach($floor_plan_seat as $seats){?>
                      <area href="javascript:void(0)" color="blue" alt="Mercury" coords="<?php echo $seats['co_ordinate'];?>" shape="rect" onclick="fnseatbook('<?php echo $seats['seat_id'];?>',$('#floor').val())" id="<?php echo $seats['seat_id'];?>" style="background-color:#ccc;">
                      <?php }}?>
                    </map>
                  </div>
                </div>
                <?php }else{?>
                <div class="col-lg-12 new_floorplan text-center ">
                  <h4>No Floor Plan Available</h4>
                </div>
                <?php }?>