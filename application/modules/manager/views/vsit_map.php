			<?php if($floor_plan[0]['description']=="Floor Plan Pune"){
		   $width=671;
		   $height=1507;
		}
		else if($floor_plan[0]['description']=="Mumbai floor plan"){
		   $width=671;
		   $height=782;
		}
		else if($floor_plan[0]['description']=="Delhi Nehru Plan"){
		   $width=671;
		   $height=1414;
		}
		else if($floor_plan[0]['description']=="Kolkata Floor Plan"){
		   $width=2550;
		   $height=3300;
		}?>
						<?php if(!empty($floor_plan)){?>
                <div class="map_ses">
                  <div class="text-center map001">
                  <div class="map" style="display: block; position: relative; padding: 0px; width: <?php echo $width;?>px; height: <?php echo $height;?>px;">
                   <img src="<?php echo $floor_plan[0]['image_path'];?>"     alt="" usemap="#planetmap" class="map" width="641" height="<?php echo $height;?>"/>
                   </div>
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
                <style>
  .map_ses { overflow: scroll;height: 600px;}
  .map001 {width:100%;  margin:0 auto;}
  .map001 img{width:100%;}
  </style>