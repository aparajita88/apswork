<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

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
    
    <header class="panel-heading">
     	 <div class="col-md-3 selection">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label">City  :</label>
              <div class="col-md-12">
                <select class="form-control mb-md" name="city" id="city" onchange="get_location(this.value)">
                  <option value="0">Select City</option>
                  <?php foreach($cities as $key=>$value) {
                                                if($userData['city_id']==$value['cityId']){
                                                echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
                                            }else{
                                                echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
                                            }
                                                
                                            } ?>
                </select>
              </div>
            </div>
          </div>
         <div class="col-md-3 selection pad_left0">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label ">Location :</label>
              <div class="col-md-12 ">
                <select class="form-control mb-md" name="location" id="location" onchange="get_business(this.value)">
                  <option value="0">Select Location</option>
                  <?php foreach($location as $key=>$value) {
                                                
                                                if($userData['location_id']==$value['locationId']){
                                                echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
                                            }else{
                                                echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
                                            }
                                                
                                            } ?>
                </select>
              </div>
            </div>
          </div>
         <div class="col-md-3 selection">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label pad_left0">Business Centers :</label>
              <div class="col-md-12 pad_left0">
                <select  class="form-control mb-md" name="business" id="business" onchange="getfloorplanBybusiness(this.value)" >
                  <?php foreach($business_data as $key=>$value) {
                                                
                                                
                                                echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>'; 
                                            
                                                
                                            } ?>
                </select>
              </div>
            </div>
          </div>
           <?php //print_r($locker_data); ?>
          <div class="col-md-3 selection">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label pad_left0">Floor Plan :</label>
              <div class="col-md-12 pad_left0">
                <select  class="form-control mb-md" name="floor" id="floor" onchange="getlfloorplan(this.value)">
                  
    
                                            
    -                                     
                  <?php foreach($floor_plan as $key=>$value) {
                                                
                                                
                                                echo '<option value="'.$value['floor_id'].'" >'.$value['description'].'</option>'; 
                                            
                                                
                                            } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
    </header>
    
    <div class="col-md-3 panel-body-leftpadding0">
            <div class="panel-heading2"><h2 class="panel-title">floor plan selection</h2></div>
            <div class="panel-body2">
            	<div class="row">
            	<form>
                	<div class="form-group">
                    	<label>Location</label>
                        <select class="form-control">
                        	<option>Victoria Park Building, Sector 5, Salt Lake</option>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label>Business Center</label>
                        <select class="form-control">
                        	<option>Smartworks Kolkata, Sector 5, Salt Lake</option>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label>Floor Plan</label>
                        <select class="form-control">
                        	<option>9th Floor Plan</option>
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
                        <label class="radio-inline">
                            <input type="radio" name="automatic" />Automatic
                             <div class="check"></div>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="manual" />Manual
                             <div class="check"></div>
                        </label>
                        <div class="form-group">
                        	<input type="checkbox" value="Technology" name="mergerooms" id="checkbox1" checked="checked">
                          	<label for="checkbox1"><span></span>Merge Rooms</label>
                        </div>
                        <div class="form-group">
                        	<div class="row">
                            	<div class="col-md-6">
                                	<label>Cabins</label>
                                    <select class="form-control">
                                    	<option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                	<label>Work Stations</label>
                                    <select class="form-control">
                                    	<option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        	<input type="checkbox" value="bookshelf" name="bookshelf" id="checkbox2" checked="checked">
                          	<label for="checkbox2"><span></span>Bookshelf Needed</label>
                        </div>
                        <div class="form-group">
                        	<input type="checkbox" value="storage" name="storage" id="checkbox3" checked="checked">
                          	<label for="checkbox3"><span></span>internal storage needed</label>
                        </div>
                        <div class="form-group">
                        	<input type="checkbox" value="internet" name="internet" id="checkbox4" checked="checked">
                          	<label for="checkbox4"><span></span>internet needed</label>
                            <div class="clearfix"></div>
                            <div class="col-md-7 margintop6">
                            <select class="form-control">
                                 <option>1 Mbps</option>
                                 <option>2 Mbps</option>
                                 <option>4 Mbps</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                        	<input type="checkbox" value="phone" name="phone" id="checkbox5" checked="checked">
                          	<label for="checkbox5"><span></span>phone needed</label>
                            <div class="clearfix"></div>
                            <div class="col-md-7 margintop6">
                            <select class="form-control">
                                 <option>Cisco IP Phone</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                        	<input type="checkbox" value="wifi" name="wifi" id="checkbox6" checked="checked">
                          	<label for="checkbox6"><span></span>Wifi needed</label>
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
            <div class="col-md-6 text-right">
            	<form class="form-horizontal">
                	<label>Layout</label>
                    <button type="button" class="btn" data-toggle="modal" data-target="#floorplan">Office One</button>
                </form>
            </div>
            <div class="clearfix"></div>
              <div class="panel panel-default mycollapsebar">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                      Monthly Fee: <strong>20000</strong>
                      <span><i class="fa fa-plus" aria-hidden="true"></i>Details</span>
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                   		<tr style="border-bottom:1px solid #777;">
                        	<th width="80%" style="padding-left:20px; padding-bottom:8px; text-transform:capitalize; font-size:18px;"><strong>Price Details</strong></th>
                            <th width="20%" style="color:#39acfd; padding-right:20px; padding-bottom:8px; text-align:right; font-weight:normal; text-transform:capitalize; font-size:18px;">Revise</th>
                        </tr>
                        <tr>
                        	<td width="80%" style="padding-left:20px; padding-top:8px; text-transform:capitalize;">Monthly Fees</td>
                            <td width="20%">&nbsp;</td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;">
                        	<td width="86%" style="float:left;">Private Office (Layout: Office one with Bookshelf & Internal Storage)</td>
                            <td width="14%" style="float:right; text-align:right;">Rs. 17500</td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;">
                        	<td width="86%" style="float:left;">Internet (Speed: 1 Mbps)</td>
                            <td width="14%" style="float:right; text-align:right;">Rs. 1000</td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;">
                        	<td width="86%" style="float:left;">Wifi</td>
                            <td width="14%" style="float:right; text-align:right;">Rs. 1000</td>
                        </tr>
                        <tr style="border-bottom:1px solid #777; margin:6px 75px; display:table; width:100%; text-transform:none;">
                        	<td width="86%" style="float:left;">Phone (Cisco Ip Phone)</td>
                            <td width="14%" style="float:right; text-align:right;">Rs. 500</td>
                        </tr>
                         <tr style="margin:6px 75px; display:table; width:100%; text-transform:none;">
                        	<td width="86%" style="float:left; font-weight:bold; color:#39acfd;">Total</td>
                            <td width="14%" style="float:right; text-align:right; font-weight:bold; color:#39acfd;">Rs. 20000</td>
                        </tr>
                   </table>
                   <div class="discount">
                   		<form class="form-inline">
                        	<div class="form-group">
                                <label>Discount Requested (%)</label>
                                <input type="text" value="" name="discount"  class="form-control"/>
                                <button type="button" class="btn">Apply Discount</button>
                                <button type="button" class="btn">Forward to AD</button>
                            </div>
                        </form>
                   </div>
                </div>
              </div>
          </div>
          <form name="frmseatallocation" id="frmseatalloc" method="post">
            <input type="hidden" name="seat_allocation" id="seat_alloc_id" value="<?php echo $this->session->userdata('seatid');?>"/>
            <div class="row booking_carousel_min_min">
              <div class="col-lg-12" id="panelfloorplan">
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
              </div>
              <div class="clearfix"></div>
              <br />
              <div class="clearfix"></div>
              <div class="form-group sub_text" style="padding-left:15px !important;">
                <button type="button" id="add_seat_allocation" class="btn btn-primary"  >Send Request </button>
              </div>
            </div>
            </form>
          </div> 
        </div>
    </div>
    <div class="clearfix"></div>
  </section>
  <div class="clearfix"></div>
</section>
  </div>
  </div>
  </div>
  <style>
	.map_ses { overflow:initial;}
	.map001 {width:100%;  margin:0 auto;}
	.map001 img{width:100%;}
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
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="<?php echo $this->config->item('base_url');?>assets/uploads/images/toystory.jpg" data-thumb="<?php echo $this->config->item('base_url');?>assets/uploads/images/toystory.jpg" alt="" />
                <img src="<?php echo $this->config->item('base_url');?>assets/uploads/images/walle.jpg" data-thumb="<?php echo $this->config->item('base_url');?>assets/uploads/images/walle.jpg" alt="" data-transition="slideInLeft" />
                <img src="<?php echo $this->config->item('base_url');?>assets/uploads/images/nemo.jpg" data-thumb="<?php echo $this->config->item('base_url');?>assets/uploads/images/nemo.jpg" alt="" />
            </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal for details service only view end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
	
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
            $("#panelfloorplan").html(result);
        }
    });
}
	}
	function getfloormapplan(){
		//alert($('#floor').val());
		//alert($('#start').val());
		//alert($('#end').val());
		var flid=$('#floor').val();
		var start=$('#start').val();
		var end=$('#end').val();
		$.ajax
    ({ 
        url: '<?php echo base_url();?>index.php/manager/get_floor_plan_by_floorid_and_date',
        data: "floor_id="+flid+'&startdate='+start+'&enddate='+end,
        type: 'post',
        success: function(result)
        {
			//alert(result);
            $("#panelfloorplan").html(result);
        }
    });
	}
	function get_location(value)
{
	
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/client/getlocationbycity/"+value, 
     // data: { id:value }, 
      async: true, 
      success: function(data) { 
	  	
        $("#location").html(data.trim()); 
      } 
    });
}
function get_business(value)
{
	
 var city = $("#city").val();
 
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/client/getBusinessByLocation/"+value+"/"+city, 
     
      async: true, 
      success: function(data) { 
	  
	  	
        $("#business").html(data.trim()); 
    
      } 
    });
} 
function getfloorplanBybusiness(value){
	var business=value;
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/manager/getfloorplanbybusiness/"+value, 
     
      async: true, 
      success: function(data) { 
	    	
        $("#floor").html(data.trim()); 
        if(data.trim()=='<option value="0">No Floor Plan</option>'){
			 $("#panelfloorplan").html('<div class="col-lg-12 new_floorplan text-center "><h4>No Floor Plan Available</h4></div>');
		}
    
      } 
    });
}
function fnseatbook(seatid,floorid){
	var flid=$('#floor').val();
		var start=$('#start').val();
		var end=$('#end').val();
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
        data: "floor_id="+flid+'&startdate='+start+'&enddate='+end,
        type: 'post',
        success: function(result)
        {
			$("#panelfloorplan").html(result);
			
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
        data: "floor_id="+flid+'&startdate='+start+'&enddate='+end,
        type: 'post',
        success: function(result)
        {
			$("#panelfloorplan").html(result);
			
        }
    });
			
		}
		}
    });
    
   }
	
}

$(document).ready(function(){
	
	$('#add_seat_allocation').click(function(){
		
		if($("#seat_alloc_id").val()==""){
		alert('Please select the seat what you want to allocate');
	}else{
		$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/manager/addseatallocation", 
      data: $('#frmseatalloc').serialize(),
        type: 'post',
        success: function(result)
        {
			alert(result);
			location.href = "<?php echo base_url();?>index.php/manager/booking_seat";
		}
    });
}	
	});
	
	
}); 

</script> 



<script>
$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
});
</script>