<?php require_once(FCPATH.'assets/admin/lib/header2.php');
    $bkcost=$floor_service[0]['bookself_cost']+$floor_service[0]['internal_storage_cost'];
    $officecost=$floor_service[0]['floor_cost'];
    $bookselfcost=$floor_service[0]['bookself_cost'];
    $internalstoragecost=$floor_service[0]['internal_storage_cost'];
                      $wificost=$floor_service[0]['wifi_cost'];
                      $phonecost=$floor_service[0]['phone_cost'];
                      $internetdata=json_decode($floor_service[0]['internet_cost']);
                      $internetcost=0;
                      $i=0;
                      foreach($internetdata as $k=>$v){
                           $speedinfo[]=$k;
                           if($i<1){
                              $internetcost=$internetcost+$v;
                           }
                           $i++;
                      }
                      $speeddata=implode(",",$speedinfo);
                      
                      $no_of_people=0;
                      $room_price=0;
                      if(!empty($this->session->userdata('seatid'))){
                        
                        $expseat=explode(",",$this->session->userdata('seatid'));
                        $expseatidinfo=explode("|",$expseat[0]);
                        foreach($expseatidinfo as $stinfo){
                          $expseatinfo=explode(':',$stinfo);
                          $seatinfo=$this->floor_plan->getseatinfo($expseatinfo[0]);
                          $no_of_people=$no_of_people+$seatinfo[0]['no_of_people'];
                          $room_price=$room_price+$seatinfo[0]['price'];
                        }
                        $people_price=$no_of_people*500;
                        $room_price=$people_price+$room_price;
                      }
                      $totalprice=$bkcost+$wificost+$phonecost+$internetcost+$room_price;
        
                ?>
<section role="main" class="content-body">
  <header class="page-header">

    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
  </header>
  
  <section class="panel">
    <header class="panel-heading">
      <h2 class="panel-title">Private office booking</h2>
    </header>
    
    <?php if($this->session->flashdata('edit')){ ?>
    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
    <?php } ?>
    <?php if($this->session->flashdata('item_error')){ ?>
    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
    <?php } ?>
    
    <div class="col-md-3 panel-body-leftpadding0">
            <div class="panel-heading2"><h2 class="panel-title">floor plan selection</h2></div>
            <div class="panel-body2">
              <div class="row">
              <form>
                  <div class="form-group">
                      <label>Location</label>
                       <select class="form-control" name="location" id="location" onchange="get_business(this.value)">
                  <option value="0">Select Location</option>
                  <?php foreach($location as $key=>$value) {$userlocation=$userData['location_id']."|".$userData['city_id'];
                  $vallocation=$value['locationId'].'|'.$value['cityId'];
                                                
                                                if($userlocation==$vallocation){
                                                echo '<option value="'.$vallocation.'" selected>'.$value['name'].' ('.$value['c_name'].')</option>'; 
                                            }else{
                                                echo '<option value="'.$vallocation.'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
                                            }
                                                
                                            } ?>
                </select>
                    </div>
                    <div class="form-group">
                      <label>Business Center</label>
                        <select  class="form-control" name="business" id="business" onchange="getfloorplanBybusiness(this.value)" >
                  <?php foreach($business_data as $key=>$value) {
                                                
                                                
                                                echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>'; 
                                            
                                                
                                            } ?>
                </select>
                    </div>
                    <div class="form-group">
                      <label>Floor Plan</label>
                        <select  class="form-control" name="floor" id="floor" onchange="getlfloorplan(this.value)">
                  
    
                                            
    -                                     
                  <?php foreach($floor_plan as $key=>$value) {
                                                
                                                
                                                echo '<option value="'.$value['floor_id'].'" >'.$value['description'].'</option>'; 
                                            
                                                
                                            } ?>
                </select>
                    </div>
                </form>
                </div>
            </div>
            <div class="clearfix"></div>
            <br />
            <div class="panel-heading2"><h2 class="panel-title">preferences</h2></div>
            <div class="panel-body2">
              <div class="row">
                    <form>
                                              
                        <div class="form-group">
                          <input type="checkbox" value="Technology" name="mergerooms" id="checkbox1" checked="checked" onchange="fnmergerooms()">
                            <label for="checkbox1"><span></span>Merge Rooms</label>
                        </div>
                        <div class="form-group">
                          <div class="row">
                              
                                <div class="col-md-6">
                                  <label>No Of People</label>
                                    <select class="form-control" name="no_of_people">
                                    <option value="">Select no of People</option>
                                    <?php if(!empty($this->session->userdata('seatid'))){
                                      for($i=1;$i<=$no_of_people;$i++){?>
                                      <option value="<?php echo $i;?>" <?php echo(($i==$no_of_people)?"selected":"");?>><?php echo $i;?></option>

                                    <?php }}?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <input type="checkbox" value="bookshelf" name="bookshelf" id="bookselfbox" checked="checked" value="1" onchange="fnoffservice()">
                            <label for="checkbox2"><span></span>Bookshelf</label>

  <div class="clearfix"></div>
  
                              <div class="col-md-7 margintop6">
                            <select class="form-control" name="" id="bookselftype">
                                 <option value="Tree">Tree</option>
                                 <option value="Bracket">Bracket</option>
                            </select>
                            </div>
                            <input type="text" placeholder="Qty." class="col-md-1" style="
    margin-top: 5px;
    height: 34px;
    line-height: 34px;
    border: 1px solid #ccc;
    width: 62px;
" id="qtybookselftype" onkeyup="priceperquantitybookself()">
                        </div>
                        <div class="form-group">
                          <input type="checkbox" value="storage" name="storage" id="internalstoragebox" checked="checked" value="1" onchange="fnoffservice()">
                            <label for="checkbox3"><span></span>Internal storage</label>
                            <div class="clearfix"></div>
                            <div class="col-md-7 margintop6">
                            <select class="form-control" name="" id="storagetype">
                                 <option value="Type 1">Type 1</option>
                                 <option value="Type 2">Type 2</option>
                                 <option value="Type 3">Type 3</option>
                            </select>
                            </div>
                            <input type="text" id="qtystoragetype" placeholder="Qty." class="col-md-1" style="
    margin-top: 5px;
    height: 34px;
    line-height: 34px;
    border: 1px solid #ccc;
    width: 62px;
" onkeyup="priceperquantitystorage()"> 
                        </div>
                        <div class="form-group">
                          <input type="checkbox" value="internet" name="internet" id="internetbox" checked="checked" value="1" onchange="fnoffservice()">
                            <label for="checkbox4"><span></span>Internet</label>
                            <div class="clearfix"></div>
                            <div class="col-md-7 margintop6">
                            <select class="form-control" name="floornetspeed" id="floornetspeed" onchange="fnnetspeedcost(this.value);">
                            <?php foreach($speedinfo as $val){?>
                                <option value="<?php echo $val;?>"><?php echo $val;?></option>
                            <?php }?>
                                
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <input type="checkbox" value="phone" name="phone" id="phonebox" checked="checked" onchange="fnoffservice()" value="1">
                            <label for="checkbox5"><span></span>Phone</label>
                             <div class="clearfix"></div>
                            <div class="col-md-7 margintop6">
                            <select class="form-control" name="floorphone" id="phonetype">
                                 <option value="Avaya 6309">Avaya 6309</option>
                                 <option value="Avaya E129">Avaya E129</option>
                            </select>
                            </div>
                            <input type="text" placeholder="Qty." class="col-md-1" style="

    margin-top: 5px;
    height: 34px;
    line-height: 34px;
    border: 1px solid #ccc;
    width: 62px;
" id="qtyphonetype" onkeyup="priceperquantityphone()">
                        </div>
                        <div class="form-group">
                          <input type="checkbox" value="wifi" name="wifi" id="wifibox" checked="checked" value="1" onchange="fnoffservice()">
                            <label for="checkbox6"><span></span>Wifi</label>
                        </div>
                    </form> 
                </div>
            </div>
    </div>
    
    <div class="col-md-9 panel-body panel_body_top">
        <div class="row booking_carousel_min_min"> 
          <div class="panel-body2">
          <div class="preview_ofc_space">
            <div class="col-md-6">
              <h2>Preview Office Space</h2>
            </div>
            <div class="col-md-6 text-right" id="floorlayout">
              <form class="form-horizontal">
                  <label>Layout</label>
                    <button type="button" class="btn" data-toggle="modal" data-target="#floorplan" id="btnfloorplan">Select Layout</button>
                </form>
            </div>
            
            <div class="clearfix"></div>
              <div class="panel panel-default mycollapsebar">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                      Monthly Fee: <strong id="flsertotprice"><i class="fa fa-inr"></i><?php echo $totalprice;?></strong>
                      <span><i class="fa fa-plus" aria-hidden="true"></i>Details</span>
                    </a>
                  </h4>
                </div>
                <form class="form-inline" id="frmfloorprice">
                <input type="hidden" name="hidtotprice" id="hidtotprice" value="<?php echo $totalprice;?>"/>
                <input type="hidden" name="hidphprice" id="hidphprice" value="<?php echo $phonecost;?>"/>
                <input type="hidden" name="hidwifiprice" id="hidwifiprice" value="<?php echo $wificost;?>"/>
                <input type="hidden" name="hidinternetprice" id="hidinternetprice" value="<?php echo $internetcost;?>"/>
                <input type="hidden" name="hidbookselfprice" id="hidbookselfprice" value="<?php echo $floor_service[0]['bookself_cost'];?>"/>
                <input type="hidden" name="hidinternalstorageprice" id="hidinternalstorageprice" value="<?php echo $floor_service[0]['internal_storage_cost'];?>"/>
                <input type="hidden" name="hidintcostinfo" id="hidintcostinfo" value='<?php echo $floor_service[0]['internet_cost'];?>'/>
                <input type="hidden" name="hidroomprice" id="hidroomprice" value="<?php echo $room_price;?>"/>
                <div id="collapseThree" class="panel-collapse collapse">
                   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr style="border-bottom:1px solid #777;">
                          <th width="80%" style="padding-left:20px; padding-bottom:8px; text-transform:capitalize; font-size:18px;"><strong>Price Details</strong></th>
                            <th width="20%" style="color:#39acfd; padding-right:20px; padding-bottom:8px; text-align:right; font-weight:normal; text-transform:capitalize; font-size:18px;"></th>
                        </tr>
                        <tr>
                          <td width="80%" style="padding-left:20px; padding-top:8px; text-transform:capitalize;">Monthly Fees</td>
                            <td width="20%">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;" id="trprivateoffice">
                          <td width="80%" style="float:left;" id="tdprivateoffice">Private Office (Layout: Office One)</td>
                            <td width="20%" style="float:right; text-align:right;" id="tdprivateofficecost"><i class="fa fa-inr"></i>&nbsp;<input type="text" name="roomcost" value="<?php echo $room_price;?>" class="form-control manufield" style="width:74px;" onkeyup="fncaltotprice()" onblur="chkamount()"/></td>
                        </tr>
                        
                                               
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;" id="trbookself">
                          <td width="80%" style="float:left;" id="tdbookself">Bookself(Tree)</td>
                            <td width="20%" style="float:right; text-align:right;" id="tdbkselfcost"><i class="fa fa-inr"></i>&nbsp;<input type="text" name="bookselfprice" value="<?php echo $bookselfcost;?>" class="form-control manufield" style="width:74px;" onkeyup="fncaltotprice()" onblur="chkamount()"/></td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;" id="trinternalstorage">
                          <td width="80%" style="float:left;" id="tdinternalstorage">Internal Storage(Type 1)</td>
                            <td width="20%" style="float:right; text-align:right;" id="tdinternalstoragecost"><i class="fa fa-inr"></i>&nbsp;<input type="text" name="internalstorageprice" value="<?php echo $internalstoragecost;?>" class="form-control manufield" style="width:74px;" onkeyup="fncaltotprice()" onblur="chkamount()"/></td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;" id="trinternet">
                          <td width="80%" style="float:left;" id="tdspeed">Internet (Speed: <?php echo $speedinfo[0];?>)</td>
                            <td width="20%" style="float:right; text-align:right;" id="tdinternetcost"><i class="fa fa-inr"></i>&nbsp;<input type="text" name="internetprice" id="internetprice" class="form-control  manufield" value="<?php echo $internetcost;?>" style="width:74px;" onkeyup="fncaltotprice()" onblur="chkamount()"/></td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;" id="trwifi">
                          <td width="80%" style="float:left;">Wifi</td>
                            <td width="20%" style="float:right; text-align:right;" id="tdwifi"><i class="fa fa-inr"></i>&nbsp;<input type="text" class="form-control manufield" name="wifiprice" id="wifiprice" value="<?php echo $wificost;?>" style="width:74px;" onkeyup="fncaltotprice()" onblur="chkamount()"/></td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;" id="trphone">
                          <td width="80%" style="float:left;">Phone (Avaya 6309)</td>
                            <td width="20%" style="float:right; text-align:right;" id="tdphone"><i class="fa fa-inr"></i>&nbsp;<input type="text" class="form-control manufield" name="phoneprice" id="phoneprice" value="<?php echo $phonecost;?>" style="width:74px;" onkeyup="fncaltotprice()" onblur="chkamount()"/></td>
                        </tr>
                         <tr style="margin:6px 75px; display:table; width:100%; text-transform:none;">
                          <td width="80%" style="float:left; font-weight:bold; color:#39acfd;" >Total</td>
                            <td width="20%" style="float:right; text-align:right; font-weight:bold; color:#39acfd;" id="tdtotal"><i class="fa fa-inr"></i> <?php echo $totalprice;?></td>
                        </tr>
                   </table>
                  
                </div>
                </form>
              </div>
          </div>
          <form name="frmseatallocation" id="frmseatalloc" method="post">
            <input type="hidden" name="seat_allocation" id="seat_alloc_id" value="<?php echo $this->session->userdata('seatid');?>"/>
            <div class="row booking_carousel_min_min">
                                  <div class="col-md-12 selection pad_left0">
                                                   
                         <label for="inputDefault" class="col-md-3 control-label" style="padding:20px 0 0;">Date range:<span class="required">*</span></label>
                        <div class="col-md-9" style="padding:15px 0 0;">
                          <div class="input-daterange input-group" data-plugin-datepicker>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Enter start Date" name="start_date" id="start" required onchange="getfloormapplan()" readonly>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="form-control" placeholder="Enter end Date" name="end_date" id="end" required onchange="getfloormapplan()" readonly>
                          </div>
                        </div>
                      </div>
                       <div class="clearfix"></div>
             <br /><br />
            
              <div class="col-lg-12" id="panelfloorplan">
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
                  <img src="<?php echo $floor_plan[0]['image_path'];?>" alt="" usemap="#planetmap" class="map" width="<?php echo $width;?>" height="<?php echo $height;?>"/>
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
              </div>
              <div class="clearfix"></div>
             <br />
             
                       <div class="col-md-12 selection pad_left0">
                                                    <div class="form-group sub_text1">
                                                                    
                                                        <label for="inputDefault" class="col-md-3 control-label " style="padding-left:15px!important;">Purpose :<span class="required">*</span></label>
                                                        <div class="col-md-9 ">
                                                             <textarea class="form-control" id="purpose" name="purpose" row="2" col="50" required></textarea>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
              <div class="clearfix"></div>
              
            </div>
            </form>
          </div> 
        </div>
    </div>
    <div class="clearfix"></div>
  </section>
  <div class="panel-body">
  	<div class="form-group sub_text" style="padding-left:15px !important;">
           <button type="button" id="add_seat_allocation" class="btn viewagreement"  >View Agreement </button>
    </div>
  </div>
  <div class="clearfix"></div>
</section>
  </div>
  </div>
  </div>
  <style>
  .map_ses { overflow: scroll;height: 600px;}
  .map001 {width:100%;  margin:0 auto;}
  .map001 img{width:100%;}
  .manualprice {display:none;}
  .manufield {width:60px;}
  .viewagreement{background:#000;color:#fff;}
  </style>
  </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Book Workstation</b></h4>
      </div>
      <div class="modal-body">
        <p>Do you want to book this workstation?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  data-dismiss="modal" data-toggle="modal" data-target="#myModalsave" >Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalsave" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Book Workstation</b></h4>
      </div>
      <div class="modal-body">
        <p>The workstation has been booked.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--floorplan modal-->

<div id="floorplan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="btn-dismiss" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <a href="javascript:void(0)" onclick="fnimg('Office One')"><img src="<?php echo $this->config->item('base_url');?>assets/uploads/images/toystory.jpg" data-thumb="<?php echo $this->config->item('base_url');?>assets/uploads/images/toystory.jpg" alt="Office Two" /></a>
                <a href="javascript:void(0)" onclick="fnimg('Office Two')"><img src="<?php echo $this->config->item('base_url');?>assets/uploads/images/walle.jpg" data-thumb="<?php echo $this->config->item('base_url');?>assets/uploads/images/walle.jpg" alt="Office Three" data-transition="slideInLeft"/></a>
                <a href="javascript:void(0)" onclick="fnimg('Office Three')"><img src="<?php echo $this->config->item('base_url');?>assets/uploads/images/nemo.jpg" data-thumb="<?php echo $this->config->item('base_url');?>assets/uploads/images/nemo.jpg" alt="Office Four"/></a>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal for details service only view end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
  $(window).load(function() {
          //$('#slider').nivoSlider();
          $('#slider').nivoSlider({
              manualAdvance:true
          });
      });
  
  function getlfloorplan(flid){
      $('#start').val('');
      $('#end').val('');
      $('#purpose').val('');
      $('#seat_alloc_id').val('');
      if($("#city").val()=="" || $("#city").val()=="0"){
        alert('Please Select the City');
      }
      else if($("#location").val()=="" || $("#location").val()=="0"){
        alert('Please Select the location');
      }
      else if($("#business").val()=="" || $("#business").val()=="0"){
        alert('Please Select the business center');
      }
      else if($("#floor").val()=="" || $("#floor").val()=="0"){
        alert('Please select the floor plan');
      }else{
        $.ajax
        ({ 
            url: '<?php echo base_url();?>index.php/manager/get_floor_plan_by_floorid',
            data: "floor_id="+flid,
            type: 'post',
            success: function(result)
            {
              $("#panelfloorplan").html("");
                $("#panelfloorplan").html(result);
            }
        });
      }
  }
  function getfloormapplan(){
      var flid=$('#floor').val();
      var start=$('#start').val();
      var end=$('#end').val();
      if($('input[name=mergerooms]').is(':checked')){
        marge=1;
      }else{
        marge=0;
      }
      if(flid==0){
        alert('Please select floor before select date range');
      }else{
         $.ajax
        ({ 
            url: '<?php echo base_url();?>index.php/manager/get_floor_plan_by_floorid_and_date',
            data: "floor_id="+flid+'&startdate='+start+'&enddate='+end+'&marge='+marge,
            type: 'post',
            success: function(result)
            {
                $("#panelfloorplan").html(result);

            }
        });
      }
      
  }
  function get_location(value)
  {
  
      $.ajax({ 
          method: "POST", 
          url: js_site_url+"index.php/client/getlocationbycity/"+value, 
          async: true, 
          success: function(data) { 
            $("#location").html(data.trim()); 
          } 
        });
   }
  function get_business(value)
  {
      var lmcity=value.split("|");
      var location=lmcity[0];
      var city=lmcity[1];
      $.ajax({ 
          method: "POST", 
          url: js_site_url+"index.php/client/getBusinessByLocation/"+location+"/"+city, 
         
          async: true, 
          success: function(data) { 
             $("#business").html(data.trim());
             $("#panelfloorplan").html(''); 
          } 
      });
  } 
      function getfloorplanBybusiness(value){
        var business=value;
        var result1='';
        var result2;
        var htm=1;
        var bkcost;
        var speed;
        var speedstr='';
        var tdbkstorage;
        var tdinternet;
        var tdwifi;
        var tdpvtoffice;
        
        $.ajax({ 
              method: "POST", 
              url: js_site_url+"index.php/manager/getfloorplanbybusiness/"+value, 
             
              async: true, 
              success: function(data) { 
                $('select[name=no_of_people]').html('<option value="">Select no of People</option>');
                $("#floor").html(data.trim()); 
                if(data.trim()=='<option value="0">No Floor Plan</option>'){
                     $('.mycollapsebar').hide();
                     $('#floorlayout').hide();
                   result1='<div class="col-lg-12 new_floorplan text-center "><h4>No Floor Plan Available</h4></div>';
                   htm=0;
                   $("#start").attr("disabled", "disabled");
                   $("#end").attr("disabled", "disabled");
                   $('#add_seat_allocation').attr("disabled", "disabled");
                   $('#purpose').attr("disabled", "disabled");
                   $("#panelfloorplan").html(result1);
                  
                }
                if(htm==1){
                   $('.mycollapsebar').show();
                   $('#floorlayout').show();
                   $("#start").removeAttr("disabled");
                   $("#end").removeAttr("disabled");
                   $('#add_seat_allocation').removeAttr("disabled");
                   $('#purpose').removeAttr("disabled");
                }
                
              } 
            });
            $.ajax({ 
                  method: "POST", 
                  url: js_site_url+"index.php/manager/getfloorplanservicebybusiness/"+value, 
                  dataType: "json",
                  async: true, 
                  success: function(result2) {
                    
                    $("#flsertotprice").html('<i class="fa fa-inr"></i>'+result2.totalcost);
                 
                 bkcost=parseInt(result2.bookself_cost)+parseInt(result2.internal_storage_cost);
                 tdpvtoffice='<i class="fa fa-inr"></i><input type="text" name="roomcost" value="0" class="form-control manufield" style="width:60px;" onkeyup="fncaltotprice()" onblur="chkamount()"/>';
                 tdbkself='<i class="fa fa-inr"></i><input type="text" name="bookselfprice" value="'+result2.bookself_cost+'" class="form-control manufield" style="width:60px;" onkeyup="fncaltotprice()" onblur="chkamount()"/>';
                 tdinternalstorage='<i class="fa fa-inr"></i><input type="text" name="internalstorageprice" value="'+result2.internal_storage_cost+'" class="form-control manufield" style="width:60px;" onkeyup="fncaltotprice()" onblur="chkamount()"/>';
                 tdinternet='<i class="fa fa-inr"></i> <input type="text" name="internetprice" id="internetprice" class="form-control  manufield" value="'+result2.internet_cost+'" style="width:60px;" onkeyup="fncaltotprice()" onblur="chkamount()"/>';
                 tdwifi='<i class="fa fa-inr"></i><input type="text" class="form-control manufield" name="wifiprice" id="wifiprice" value="'+result2.wifi_cost+'" style="width:60px;" onkeyup="fncaltotprice()" onblur="chkamount()"/>';
                 tdphone='<i class="fa fa-inr"></i><input type="text" class="form-control manufield" name="phoneprice" id="phoneprice" value="'+result2.phone_cost+'" style="width:60px;" onkeyup="fncaltotprice()" onblur="chkamount()"/>';
                 $("#tdbkselfcost").html(tdbkself);
                 $('#tdprivateofficecost').html(tdpvtoffice);
                 $('#tdinternalstoragecost').html(tdinternalstorage);
                 $('#tdwifi').html(tdwifi);
                 $('#tdphone').html(tdphone);
                 $('#tdtotal').html('<i class="fa fa-inr"></i> '+result2.totalcost);
                 $('#tdinternetcost').html(tdinternet);
                 $('#hidtotprice').val(result2.totalcost);
                 $('#hidphprice').val(result2.phone_cost);
                 $('#hidwifiprice').val(result2.wifi_cost);
                 $('#hidinternetprice').val(result2.internet_cost);
                 $('#hidbookselfprice').val(result2.bookself_cost);
                 $('#hidinternalstorageprice').val(result2.internal_storage_cost);
                 $('#hidintcostinfo').val(result2.int_cost_info);
                 $("#phonebox" ).prop( "checked", true );
                 $("#internetbox" ).prop( "checked", true );
                 $("#wifibox" ).prop( "checked", true );
                 $("#bookselfbox" ).prop( "checked", true );
                 $("#internalstoragebox" ).prop( "checked", true );
                 $('#autopriceset').prop( "checked", true );
                 $('#trphone').show();
                 $('#trwifi').show();
                 $('#trinternet').show();
                 $('#trbookself').show(); 
                 $('#trinternalstorage').show();

                 speed=result2.speed;
                 
                 spspeed=speed.split(',');
                 for(var i=0;i<spspeed.length;i++){
                  var str = spspeed[i];
                  var res = str.replace("[", "");
                  var res1= res.replace("]","");
                  var res2=res1.replace('"',"");
                  var lng=parseInt(res2.length)-1;
                  var res3=res2.substr(0, lng);
                   speedstr=speedstr+'<option value="'+res3+'">'+res3+'</option>';
                 }
                 $('#floornetspeed').html(speedstr);
                 $('#qtybookselftype').val('');
                 $('#qtystoragetype').val('');
                 $('#qtyphonetype').val('');
                 
               
                  } 
                });
        
      }
    function fnseatbook(seatid,floorid){
        var flid=$('#floor').val();
        var start=$('#start').val();
        var end=$('#end').val();
        var marge;
        var bkprice=$('input[name=bookselfprice]').val();
        var storageprice=$('input[name=internalstorageprice]').val();
        var internetprice=$('input[name=internetprice]').val();
        var wifiprice=$('input[name=wifiprice]').val();
        var phoneprice=$('input[name=phoneprice]').val();
        var totalprice=0;

        if($('input[name=mergerooms]').is(':checked')){
          marge=1;
        }else{
          marge=0;
        }

      if(start==""){
        alert('Please select the start date before select seat/room');
      }
      else if(end==""){
        alert('Please select the end date before select seat/room');
      }else{
      $.ajax({ 
          method: "POST", 
          url: js_site_url+"index.php/manager/getseatallocationinsession", 
          data: "seatid="+seatid+"&floor_id="+floorid+"&start_date="+$('#start').val()+"&end_date="+$('#end').val(),
            type: 'post',
            success: function(result)
            {
          
          if(result.trim()=='Already you have selected this seat/room.'){
            var r = confirm("You have selected this seat/room.\nAre you deselect the seat/room?");
            if(r==true){
              $.ajax({ 
                          method: "POST", 
                          url: js_site_url+"index.php/manager/deselectseatallocation", 
                          data: "seatid="+seatid,
                          type: 'post',
                          success: function(result)
                          {
                  document.getElementById('seat_alloc_id').value=result.trim();
                  
                    $.ajax
                    ({ 
                        url: '<?php echo base_url();?>index.php/manager/get_floor_plan_by_floorid_and_date',
                        data: "floor_id="+flid+'&startdate='+start+'&enddate='+end+'&marge='+marge,
                        type: 'post',
                        async: true,
                        success: function(result,e)
                        {
                              
                            $("#panelfloorplan").html(result);
                            e.preventDefault();
                            
                        }
                    });
                    $.ajax
                    ({ 
                        url: '<?php echo base_url();?>index.php/manager/get_no_of_people',
                        type: 'post',
                        async: true,
                        success: function(result)
                        {
                            $('select[name=no_of_people]').html(result);
                           
                        }
                    });
                    $.ajax
                    ({ 
                        url: '<?php echo base_url();?>index.php/manager/get_room_price',
                        type: 'post',
                        async: true,
                        success: function(result)
                        {
                           $('input[name=roomcost]').val(result);
                           $('#hidroomprice').val(result);
                           totalprice=parseInt(bkprice)+parseInt(storageprice)+parseInt(internetprice)+parseInt(wifiprice)+parseInt(phoneprice)+parseInt($('input[name=roomcost]').val());
                           $('#tdtotal').html('<i class="fa fa-inr"></i> '+totalprice);
                           $("#flsertotprice").html('<i class="fa fa-inr"></i>'+totalprice);
                           $('#hidtotprice').val(totalprice);
                        }
                    });
                  }
              });
            }
          }else if(result.trim()=='Seat/Room already booked.'){
            alert(result);
            }else{
              
          document.getElementById('seat_alloc_id').value=result.trim();
         
              $.ajax
            ({ 
                url: '<?php echo base_url();?>index.php/manager/get_floor_plan_by_floorid_and_date',
                data: "floor_id="+flid+'&startdate='+start+'&enddate='+end+'&marge='+marge,
                type: 'post',
                async: true,
                success: function(result,e)
                {

                   $("#panelfloorplan").html(result);
                   e.preventDefault();
                }
            });
            $.ajax
            ({ 
                url: '<?php echo base_url();?>index.php/manager/get_no_of_people',
                type: 'post',
                async: true,
                success: function(result)
                {
                    $('select[name=no_of_people]').html(result);
                   
                }
            });
            $.ajax
            ({ 
                url: '<?php echo base_url();?>index.php/manager/get_room_price',
                type: 'post',
                async: true,
                success: function(result)
                {
                   $('input[name=roomcost]').val(result);
                   $('#hidroomprice').val(result);
                   totalprice=parseInt(bkprice)+parseInt(storageprice)+parseInt(internetprice)+parseInt(wifiprice)+parseInt(phoneprice)+parseInt($('input[name=roomcost]').val());
                   $('#tdtotal').html('<i class="fa fa-inr"></i> '+totalprice);
                    $("#flsertotprice").html('<i class="fa fa-inr"></i>'+totalprice);
                    $('#hidtotprice').val(totalprice);
                }
            });
              
          
        }
        }
        });
        
       }

      
    }
function fnimg(value){
    var strbookself;
    $('#btnfloorplan').html(value);
    strbookself=$('#tdprivateoffice').html();
    var n = strbookself.search("Office One");
    var n1 = strbookself.search("Office Two");
    var n2 = strbookself.search("Office Three");
    var new_text;
    if(n>=0){
        new_text = strbookself.replace("Office One", value);
    }else if(n1>=0){
      new_text=strbookself.replace("Office Two", value);
    }else if(n2>=0){
      new_text=strbookself.replace("Office Three", value);
    }
    
    $('#tdprivateoffice').html(new_text);
   
    $( "#btn-dismiss" ).trigger( "click" );
}
function fnoffservice(){
    var totprice=0;
    totprice=parseInt($('#hidbookselfprice').val())+parseInt($('#hidinternalstorageprice').val())+parseInt($('#hidwifiprice').val())+parseInt($('#hidinternetprice').val())+parseInt($('input[name=roomcost]').val())+parseInt($('#hidphprice').val());
    
    if($('#phonebox').is(":checked")){
        $('#trphone').show();
     }
    else{
        $('#trphone').hide();
        totprice=totprice-parseInt($('#hidphprice').val());
    }
    if($('#wifibox').is(":checked")){
        $('#trwifi').show();
        
     }
     else{
         $('#trwifi').hide();
         totprice=totprice-parseInt($('#hidwifiprice').val());
     }
     if($('#internetbox').is(":checked")){
        $('#trinternet').show();
        
     }
     else{
        $('#trinternet').hide();
        totprice=totprice-parseInt($('#hidinternetprice').val());
     }
     if($('#bookselfbox').is(":checked")){
        $('#trbookself').show();
        
     }
     else{
         $('#trbookself').hide();
         totprice=totprice-parseInt($('#hidbookselfprice').val());
     }
     if($('#internalstoragebox').is(":checked")){
        $("#trinternalstorage").show();
        
     }
     else{
        $("#trinternalstorage").hide();
        totprice=totprice-parseInt($('#hidinternalstorageprice').val());
     }
    $('#tdtotal').html('<i class="fa fa-inr"></i> '+totprice);
      $('#hidtotprice').val(totprice);
      $("#flsertotprice").html('<i class="fa fa-inr"></i>'+totprice);
}



function fnnetspeedcost(value){
   //alert(value);
   var intcostinf;
   var speed;
   var cost;
   var totalcost=0;
   var tdinternet;
   intcostinf=JSON.parse($('#hidintcostinfo').val());
   for (var key in intcostinf) {
    if(key==value){
        $('#hidinternetprice').val(intcostinf[key]);
        $('#tdspeed').html('Internet (Speed: '+key+')');
        tdinternet='<i class="fa fa-inr"></i><input type="text" name="internetprice" id="internetprice" class="form-control  manufield" value="'+intcostinf[key]+'" style="width:74px;" onkeyup="fncaltotprice()"/>';
        $('#tdinternetcost').html(tdinternet);
        totalcost=parseInt($('#hidphprice').val())+parseInt($('#hidbookselfprice').val())+parseInt($('#hidinternalstorageprice').val())+parseInt($('#hidwifiprice').val())+parseInt($('#hidinternetprice').val())+parseInt($('input[name=roomcost]').val());
        if($('#phonebox').is(":checked")){
            $('#trphone').show();
         }
        else{
            $('#trphone').hide();
            totalcost=totalcost-parseInt($('#hidphprice').val());
        }
        if($('#wifibox').is(":checked")){
            $('#trwifi').show();
            
         }
         else{
             $('#trwifi').hide();
             totalcost=totalcost-parseInt($('#hidwifiprice').val());
         }
         if($('#internetbox').is(":checked")){
            $('#trinternet').show();
            
         }
         else{
            $('#trinternet').hide();
            totalcost=totalcost-parseInt($('#hidinternetprice').val());
         }
         if($('#bookselfbox').is(":checked")){
            $('#trbookself').show();
            
         }
         else{
             $('#trbookself').hide();
             totalcost=totalcost-parseInt($('#hidbookselfprice').val());
         }
         if($('#internalstoragebox').is(":checked")){
            $("#trinternalstorage").show();
            
         }
         else{
            $("#trinternalstorage").hide();
            totalcost=totalcost-parseInt($('#hidinternalstorageprice').val());
         }
            $('#tdtotal').html('<i class="fa fa-inr"></i> '+totalcost);
            $('#hidtotprice').val(totalcost);
            $('#flsertotprice').html('<i class="fa fa-inr"></i>'+totalcost);
        }
    if($('#autopriceset').is(":checked")){
        $('.autoprice').show();
        $('.manualprice').hide();
     }
     else if($('#manualpriceset').is(":checked")){
         $('.manualprice').show();
         $('.autoprice').hide();

     }
         
}
}
function fncaltotprice(){
  
     var totalprice=0;
     var bkprice=$('input[name=bookselfprice]').val();
     var storageprice=$('input[name=internalstorageprice]').val();
     var internetprice=$('input[name=internetprice]').val();
     var wifiprice=$('input[name=wifiprice]').val();
     var phoneprice=$('input[name=phoneprice]').val();
     var officecost=$('input[name=roomcost]').val();
     var hidbkprice=$('#hidbookselfprice').val();
     var hidstorageprice=$('#hidinternalstorageprice').val();
     var hidinternetprice=$('#hidinternetprice').val();
     var hidwifiprice=$('#hidwifiprice').val();
     var hidphoneprice=$('#hidphprice').val();
     var hidofficecost=$('#hidroomprice').val();
     if(officecost==""){
         alert('Please enter private office cost in price field');
         $('input[name=roomcost]').val('');
         $('input[name=roomcost]').focus();
     }
     else if(!officecost.match(/^\d+$/) && officecost!="") {
         alert('Please enter numeric value in price field');
         $('input[name=roomcost]').val('');
         $('input[name=roomcost]').focus();
     }
     
     else if(bkprice==""){
         alert('Please enter Bookself price in price field');
         $('input[name=bookselfprice]').val('');
         $('input[name=bookselfprice]').focus();
     }
     else if(!bkprice.match(/^\d+$/) && bkprice!="") {
         alert('Please enter numeric value in price field');
         $('input[name=bookselfprice]').val('');
         $('input[name=bookselfprice]').focus();
     }
     else if(storageprice==""){
         alert('Please enter Internal Storage price in price field');
         $('input[name=internalstorageprice]').val('');
         $('input[name=internalstorageprice]').focus();
     }
     else if(!storageprice.match(/^\d+$/) && storageprice!=""){
         alert('Please enter numeric value in price field');
         $('input[name=internalstorageprice]').val('');
         $('input[name=internalstorageprice]').focus();
     }
     else if(internetprice==""){
         alert('Please enter Internet price in price field');
         $('input[name=internetprice]').val('');
         $('input[name=internetprice]').focus();
     }
     else if(!internetprice.match(/^\d+$/) && internetprice!=""){
         alert('Please enter numeric value in price field');
         $('input[name=internetprice]').val('');
         $('input[name=internetprice]').focus();
     }
     
     else if(wifiprice==''){
         alert('Please enter Wifi price in price field');
         $('input[name=wifiprice]').val('');
         $('input[name=wifiprice]').focus();
     }
     else if(!wifiprice.match(/^\d+$/) && wifiprice!=""){
         alert('Please enter numeric value in price field');
         $('input[name=wifiprice]').val('');
         $('input[name=wifiprice]').focus();
     }
     
     else if(phoneprice==''){
         alert('Please enter Phone price in price field');
         $('input[name=phoneprice]').val('');
         $('input[name=phoneprice]').focus();
     }
     else if(!phoneprice.match(/^\d+$/) && phoneprice!=""){
         alert('Please enter numeric value in price field');
         $('input[name=phoneprice]').val('');
         $('input[name=phoneprice]').focus();
     }
     else{
         if($('#bookselfbox').is(":checked")){
            totalprice=totalprice+parseInt(bkprice);

         }
         if($('#internalstoragebox').is(":checked")){
            totalprice=totalprice+parseInt(storageprice);
         }
         if($('#phonebox').is(":checked")){
            totalprice=totalprice+parseInt(phoneprice);
         }
         if($('#wifibox').is(":checked")){
            totalprice=totalprice+parseInt(wifiprice);
         }
         if($('#internetbox').is(":checked")){
            totalprice=totalprice+parseInt(internetprice);
         }
         totalprice=totalprice+parseInt(officecost);
             
         $('#tdtotal').html('<i class="fa fa-inr"></i> '+totalprice);
          $('#hidtotprice').val(totalprice);
          $("#flsertotprice").html('<i class="fa fa-inr"></i>'+totalprice);
     }
     

}
function chkamount(){
     var bkprice=$('input[name=bookselfprice]').val();
     var storageprice=$('input[name=internalstorageprice]').val();
     var internetprice=$('input[name=internetprice]').val();
     var wifiprice=$('input[name=wifiprice]').val();
     var phoneprice=$('input[name=phoneprice]').val();
     var officecost=$('input[name=roomcost]').val();
     var hidbkprice=$('#hidbookselfprice').val();
     var hidstorageprice=$('#hidinternalstorageprice').val();
     var hidinternetprice=$('#hidinternetprice').val();
     var hidwifiprice=$('#hidwifiprice').val();
     var hidphoneprice=$('#hidphprice').val();
     var hidofficecost=$('#hidroomprice').val();
     var orgtotprice=parseInt(hidbkprice)+parseInt(hidstorageprice)+parseInt(hidinternetprice)+parseInt(hidwifiprice)+parseInt(hidphoneprice)+parseInt(hidofficecost);
     var totprice=parseInt(bkprice)+parseInt(storageprice)+parseInt(internetprice)+parseInt(wifiprice)+parseInt(phoneprice)+parseInt(officecost);
     if(totprice<orgtotprice){
       if(parseInt(officecost)<parseInt(hidofficecost)){
            alert('You can not decrease the price');
            $('input[name=roomcost]').val(parseInt(hidofficecost));
            $('input[name=roomcost]').focus();
       }
       else if(parseInt(bkprice)<parseInt(hidbkprice)){
            alert('You can not decrease the price');
            $('input[name=bookselfprice]').val(parseInt(hidbkprice));
            $('input[name=bookselfprice]').focus();
       }
       else if(parseInt(storageprice)<parseInt(hidstorageprice)){
            alert('You can not decrease the price');
            $('input[name=internalstorageprice]').val(parseInt(hidstorageprice));
            $('input[name=internalstorageprice]').focus();
       }
       else if(parseInt(internetprice)<parseInt(hidinternetprice)){
            alert('You can not decrease the price');
            $('input[name=internetprice]').val(parseInt(hidinternetprice));
            $('input[name=internetprice]').focus();
       }
       else if(parseInt(wifiprice)<parseInt(hidwifiprice)){
            alert('You can not decrease the price');
            $('input[name=wifiprice]').val(parseInt(hidwifiprice));
            $('input[name=wifiprice]').focus();
       }
       else if(parseInt(phoneprice)<parseInt(hidphoneprice)){
            alert('You can not decrease the price');
            $('input[name=phoneprice]').val(parseInt(hidphoneprice));
            $('input[name=phoneprice]').focus();
       }
   }
}
$(document).ready(function(){
  
  $('#add_seat_allocation').click(function(){
    var totalprice=$('#hidtotprice').val();
    var bookselfprice=$('input[name=bookselfprice]').val();
    var storageprice=$('input[name=internalstorageprice]').val();
    var phoneprice=$('input[name=phoneprice]').val();
    var wifiprice=$('input[name=wifiprice]').val();
    var internetprice=$('input[name=internetprice]').val();
    var roomprice=$('input[name=roomcost]').val();
    var marge;
    if($('input[name=mergerooms]').is(':checked')){
      marge=1;
    }else{
      marge=0;
    }
    var startDate = new Date($('#start').val());
    var endDate = new Date($('#end').val());
    if(endDate<=startDate){
        alert('End date must be the post date of start date');
        $('#end').val('');
        $('#end').focus();

    }
  else if($("#seat_alloc_id").val()==""){
    alert('Please select the seat what you want to allocate');
  }else{
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/manager/addseatallocation", 
      data: $('#frmseatalloc').serialize()+'&totalprice='+totalprice+'&bookselfprice='+bookselfprice+'&storageprice='+storageprice+'&phoneprice='+phoneprice+'&wifiprice='+wifiprice+'&internetprice='+internetprice+'&room_price='+roomprice+'&marge='+marge,
        type: 'post',
        success: function(result)
        {
           //alert(result);
           location.href = "<?php echo base_url();?>index.php/manager/office_agreement";
        }
    });
} 
  });
  
  $('.accordion-toggle').click(function(){
      $( ".fa" ).each(function() {
        if($(this).hasClass( "fa-plus" )){
            $(this).removeClass('fa-plus');
            $(this).addClass('fa-minus');
        }else if($(this).hasClass( "fa-minus" )){
            $(this).removeClass('fa-minus');
            $(this).addClass('fa-plus');
        }
      });
      
  });
  $('#bookselftype').change(function(){
      var strbookself=$('#trbookself').html();
      var val=$(this).val();
      var newstr;
      var newstr1;
      newstr=strbookself.replace('Tree', val);
      newstr1=newstr.replace('Bracket', val);
      $('#trbookself').html(newstr1);
  });
  $('#storagetype').change(function(){
      var strstorage=$('#trinternalstorage').html();
      var val=$(this).val();
      var newstr;
      var newstr1;
      var newstr2;
      newstr=strstorage.replace('Type 1', val);
      newstr1=newstr.replace('Type 2', val);
      newstr2=newstr1.replace('Type 3', val);
      $('#trinternalstorage').html(newstr2);
  });
  $('#phonetype').change(function(){
      var strphone=$('#trphone').html();
      var val=$(this).val();
      var newstr;
      var newstr1;
      newstr=strphone.replace('Avaya 6309', val);
      newstr1=newstr.replace('Avaya E129', val);
      $('#trphone').html(newstr1);
  }); 
});
  function priceperquantitybookself(){
     var reg = /^\d+$/;
     var qtybookself=$('#qtybookselftype').val();
     var hidbkprice=parseFloat($('#hidbookselfprice').val());
     
     if(!reg.test(qtybookself) && qtybookself!=""){
       alert('quantity field must be numeric');
       $('#qtybookselftype').css({'border-color':'red'});
       $('#qtybookselftype').val('');
       $('#qtybookselftype').focus();
       hidbkprice=hidbkprice*1;
         $('input[name=bookselfprice]').val(hidbkprice);
       
     }
     else if(qtybookself==0 && qtybookself!=""){
         alert('quantity field must not be zero');
       $('#qtybookselftype').css({'border-color':'red'});
       $('#qtybookselftype').val('');
       $('#qtybookselftype').focus();
       hidbkprice=hidbkprice*1;
         $('input[name=bookselfprice]').val(hidbkprice);
      
     }
    else{
      if(qtybookself==0){
        qtybookself=1;
      }
         hidbkprice=hidbkprice*qtybookself;
         $('input[name=bookselfprice]').val(hidbkprice);
         

     }
      
     fncaltotprice();

  }
  function priceperquantitystorage(){
     var reg = /^\d+$/;
     var qtystorage=$('#qtystoragetype').val();
     var hidstorageprice=parseFloat($('#hidinternalstorageprice').val());
     
     if(!reg.test(qtystorage) && qtystorage!=""){
         alert('quantity field must be numeric');
          $('#qtystoragetype').css({'border-color':'red'});
        $('#qtystoragetype').val('');
         $('#qtystoragetype').focus();
         hidstorageprice=hidstorageprice*1;
         $('input[name=internalstorageprice]').val(hidstorageprice);
       
     }
     else if(qtystorage==0 && qtystorage!=""){
        alert('quantity field must not be zero');
          $('#qtystoragetype').css({'border-color':'red'});
        $('#qtystoragetype').val('');
         $('#qtystoragetype').focus();
         hidstorageprice=hidstorageprice*1;
         $('input[name=internalstorageprice]').val(hidstorageprice);
         

     }
     else{
      if(qtystorage==0){
        qtystorage=1;
      }
         hidstorageprice=hidstorageprice*qtystorage;
         $('input[name=internalstorageprice]').val(hidstorageprice);
         
     }
     
     fncaltotprice();
  }
  function priceperquantityphone(){
     var reg = /^\d+$/;
     var qtyphone=$('#qtyphonetype').val();
     var hidphoneprice=parseFloat($('#hidphprice').val());
     
     if(!reg.test(qtyphone) && qtyphone!=""){
       alert('quantity field must be numeric');
       $('#qtyphonetype').css({'border-color':'red'});
       $('#qtyphonetype').val('');
       $('#qtyphonetype').focus();
        hidphoneprice=hidphoneprice*1;
         $('input[name=phoneprice]').val(hidphoneprice);
       
     }
     else if(qtyphone==0 && qtyphone!=""){
       alert('quantity field must not be zero');
       $('#qtyphonetype').css({'border-color':'red'});
       $('#qtyphonetype').val('');
       $('#qtyphonetype').focus();
       hidphoneprice=hidphoneprice*1;
       $('input[name=phoneprice]').val(hidphoneprice);

       
     }
     else{
        if(qtyphone==0){
        qtyphone=1;
      }
         hidphoneprice=hidphoneprice*qtyphone;
         $('input[name=phoneprice]').val(hidphoneprice);
         
     }
      fncaltotprice();

  }
function fnmergerooms(){
  var flid=$('#floor').val();
    var start=$('#start').val();
    var end=$('#end').val();
    var seatid='';
    if($('input[name=mergerooms]').is(':checked')){
      marge=1;
    }else{
      marge=0;
    }
    
        $.ajax
        ({ 
            url: '<?php echo base_url();?>index.php/manager/get_floor_plan_by_floorid_and_date',
            data: "floor_id="+flid+'&startdate='+start+'&enddate='+end+'&marge='+marge,
            type: 'post',
            async: true,
            success: function(result)
            {
                $("#panelfloorplan").html(result);
            }
        });
        $.ajax
        ({ 
            url: '<?php echo base_url();?>index.php/manager/get_cavin_no',
            data: "seatid="+seatid+"&marge="+marge,
            type: 'post',
            async: true,
            success: function(result)
            {
                $('select[name=no_of_cabin]').html(result);
               
            }
        });
        
}
</script> 



<script>
$('.collapseThree').on('shown.bs.collapse', function(){
$(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
});
</script>
