<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
	</header>
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
                                        <h2 class="panel-title">SMART CONCIERGE</h2>
                                    </div>
			<?php if($this->session->flashdata('add_request')){ ?>
                        <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('add_request'); ?></div>
                        <?php } ?>				
			<div class="panel-body panel_body_top">
				 <ul class="nav nav-pills">
                  <li class="flight"><a data-toggle="pill" href="#flight"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Flight</a></li>
                  <li class="hotel"><a data-toggle="pill" href="#hotel"><i class="fa fa-bed" aria-hidden="true"></i> Hotel</a></li>
                  <li class="train"><a data-toggle="pill" href="#train"><i class="fa fa-train" aria-hidden="true"></i> Train</a></li>
                  <li class="bus"><a data-toggle="pill" href="#bus"><i class="fa fa-bus" aria-hidden="true"></i> Bus</a></li>
                  <li class="cab"><a data-toggle="pill" href="#cab"><i class="fa fa-taxi" aria-hidden="true"></i> Cab</a></li>
                </ul>
                <div class="tab-content">
                  <div id="flight" class="tab-pane fade in active">
                  <div class="row">
                  <form role="form" name="frmregairline" method="post" id="frmregairline" action="<?php echo base_url();?>request/add_request_smartconcierge_traval_plan">
                    <div class="heading">
                    	<aside class="col-lg-9">
                        	<h4>Book Domestic & International Flight Tickets</h4>
                        </aside>
                        
                        <aside class="col-lg-3 text-right">
                        	<select class="selection1" name="flighttype">
                            	<option value="Domestic">Domestic</option>
                                <option value="International">International</option>
                            </select>
                        </aside>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mainform">
                    	<div class="row">
                    		<aside class="col-lg-9">
                            
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" value="0">ONE WAY
                                  <div class="check"></div>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" value="1">ROUND TRIP
                                  <div class="check"><div class="inside"></div></div>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optradio" value="2">MULTI CITY/ STOP OVER
                                  <div class="check"><div class="inside"></div></div>
                                </label>
                                <div class="clearfix"></div>
                                <div class="inputtypes">
                                	<div class="row">
                                        <div class="form-group">
                                            <div class="col-lg-5">
                                                <label>FROM</label>
                                                <select class="form-control" name="airline_formcity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 myimg"><img src="http://smartworks.demostage.net/assets/admin1/images/two-arrows.jpg" alt="img" /></div>
                                            <div class="col-lg-5">
                                                <label>To</label>
                                                <select class="form-control" name="airline_tocity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="col-lg-5">
                                            <div class="row">
                                            	<div class="col-lg-6">
                                                	<label>DEPARTURE</label>
                                                    <input  type="text" id="example1" class="form-control mycalender" name="airline_departure">
                                                </div>
                                                <div class="col-lg-6">
                                                	<label>RETURN</label>
                                                    <input  type="text"  id="example2" class="form-control mycalender" name="airline_return">
                                                </div>
                                             </div>   
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-5">
                                            	<div class="row">
                                                	<div class="col-lg-4">
                                                    	<label>ADULT(12+)</label>
                                                        <input type="text" class="form-control" name="airline_adult"/>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    	<label>CHILD(2-11)</label>
                                                        <input type="text" class="form-control" name="airline_child"/>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    	<label>INFANT(0-2)</label>
                                                        <input type="text" class="form-control" name="airline_infant"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="col-lg-5">
                                            	<label>CLASS</label>
                                            	<select class="form-control selection2" name="airline_class">
                                                	<option>Economy</option>
                                                    <option>Business</option>
                                                    <option>First Class</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-5">
                                            	<label>AIRLINE PREFERENCE (OPTIONAL)</label>
                                                <select class="form-control selection2" name="airline_name">
                                                	<option value="">Select Airline</option>
                                                    <?php foreach($airline as $row){?>
                                                    <option value="<?php echo $row['airlinesId'];?>"><?php echo $row['name'];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="col-lg-4">
                                            	<label>APPROX TIME OF DEPARTURE</label>
                                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="airline_time">
                                            </div>
                                            <div class="col-lg-2">&nbsp;</div>
                                            <div class="col-lg-4">
                                            	<label>BUDGET</label>
                                                <select class="form-control selection2" name="airline_budget">
                                                <?php for($i=0;$i<=12;$i++){$amt1=8000+$i*4000;$amt2=12000+$i*4000;?>
                                                	<option value="<?php echo $amt1;?>-<?php echo $amt2;?>"><?php echo $amt1;?>-<?php echo $amt2;?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                         	<div class="col-lg-5">
                                            	<button type="button" class="btn btn-lg btn-info mybtn" id="btnreqairline">Book Now</button>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             
                         </aside>
                         </div>
                         
                    </div>
                    </form>
                    </div>
                  </div>
                  <div id="hotel" class="tab-pane fade">
                   <div class="row">
                   <form name="frmroom" id="frmroom" method="post" action="<?php echo base_url();?>request/add_request_smartconcierge_traval_plan">
                        <div class="heading">
                            <aside class="col-lg-9">
                                <h4>Book Domestic & International Flight Hotels</h4>
                            </aside>
                            <aside class="col-lg-3 text-right">
                                <select class="selection1" name="hotel_status">
                                    <option value="Domestic">Domestic</option>
                                    <option value="International">International</option>
                                </select>
                            </aside>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="mainform">
                        	<div class="row">
                            	<div class="col-lg-5">
                                	
                                    	<div class="form-group">
                                        	<label>I WANT TO GO</label>
                                            <select class="form-control selection2" name="room_city">
                                            	<option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        	<div class="row">
                                            	<div class="col-lg-8">
                                                	<label>BUDGET (per night)</label>
                                                    <select class="selection2 form-control" name="room_budget">
                                                    	<?php for($i=0;$i<=12;$i++){$amt1=1500+$i*1000;$amt2=2500+$i*1000;?>
                                                    <option value="<?php echo $amt1;?>-<?php echo $amt2;?>"><?php echo $amt1;?>-<?php echo $amt2;?></option>
                                                <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                	<label>STAR</label>
                                                    <select class="selection2 form-control" name="room_star">
                                                    	<option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="row">
                                                <div class="col-lg-6">
                                                    <label>check-in</label>
                                                    <input  type="text" id="example3" class="form-control mycalender" name="room_check_in">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>check-out</label>
                                                    <input  type="text"  id="example4" class="form-control mycalender" name="room_check_out">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="row">
                                            	<div class="col-lg-3">
                                                	<label>night</label>
                                                    <select class="selection2 form-control" name="room_no_of_night">
                                                    <?php for($i=1;$i<=30;$i++){?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                    	
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <div class="form-group">
                                        	<button type="button" class="btn btn-lg btn-info mybtn" id="bkroom">Book Now</button>
                                        </div>
                                    
                                </div>
                                <div class="col-lg-7">
                                	<div class="rooms">
                                    	<div class="col-lg-6">
                                        	<h6>Room 1</h6>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                        	<div class="col-lg-6">
                                            	<div class="form-group">
                                                	<label>ADULT(12+)</label>
                                                    <input type="text" class="form-control" name="room_adult[]" id="rmadult1"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            	<div class="form-group">
                                                	<label>CHILD(0-12)</label>
                                                    <input type="text" class="form-control" name="room_child[]" id="rmchild1"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                    <div class="form-group">
                                            <button type="button" class="btn btn-md btn-info mybtn" id="btnadroom">Add Room</button>
                                            <a class="btn btn-md btn-info mybtn" href="javascript:void(0)" onclick="removeElement()" style="display:none;" id="rmremove">Remove Room</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cntroom" value="1"/>
                        </form>
                   </div>
                  </div>
                  <div id="train" class="tab-pane fade">
                    <h3>Indian Railways Tickets</h3>
                    <div class="clearfix"></div>
                                <div class="inputtypes mainform">
                                    <div class="row">
                                    <form name="frmrailway" id="frmrailway" action="<?php echo base_url();?>request/add_request_smartconcierge_traval_plan" method="post">
                    <div class="form-group">
                                            <div class="col-lg-5">
                                                <label>FROM</label>
                                                <select class="form-control" name="railway_fromcity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 myimg"><img src="http://smartworks.demostage.net/assets/admin1/images/two-arrows.jpg" alt="img" /></div>
                                            <div class="col-lg-5">
                                                <label>To</label>
                                                <select class="form-control" name="railway_tocity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-5">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>DEPARTURE</label>
                                                    <input  type="text" id="example5" class="form-control mycalender" name="railway_departure">
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                              <br /><br />
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-info mybtn" id="bkrailway">Book Now</button>
                                        </div>
                                       </form>
                                        </div>
                  </div>
                  </div>
                  <div id="bus" class="tab-pane fade">
                    <h3>Online Bus Tickets Booking</h3>
                     <div class="clearfix"></div>
                                <div class="inputtypes mainform">
                                    <div class="row">
                                    <form name="frmbus" id="frmbus" method="post" action="<?php echo base_url();?>request/add_request_smartconcierge_traval_plan">
                    <div class="form-group">
                                            <div class="col-lg-5">
                                                <label>FROM</label>
                                                <select class="form-control" name="bus_fromcity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 myimg"><img src="http://smartworks.demostage.net/assets/admin1/images/two-arrows.jpg" alt="img" /></div>
                                            <div class="col-lg-5">
                                                <label>To</label>
                                                <select class="form-control" name="bus_tocity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            
                                                <div class="col-lg-3">
                                                    <label>DEPARTURE</label>
                                                    <input  type="text" id="example6" class="form-control mycalender" name="bus_departure">
                                                </div>
                                               
                                             
                                             <div class="col-lg-2">
                                                <label>APPROX TIME</label>
                                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="bus_time">
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-3">
                                                <label>BUDGET</label>
                                                <select class="form-control selection2" name="bus_budget">
                                                <?php for($i=0;$i<=12;$i++){$amt1=8000+$i*4000;$amt2=12000+$i*4000;?>
                                                    <option value="<?php echo $amt1;?>-<?php echo $amt2;?>"><?php echo $amt1;?>-<?php echo $amt2;?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                             </div>
                                              <br /><br />
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-info mybtn" name="bkbus" id="bkbus">Book Now</button>
                                        </div>
                                        </form>
                                        </div>
                                        </div>
                  </div>
                  <div id="cab" class="tab-pane fade">
                    <h3>Online Cab Booking</h3>
                     <div class="clearfix"></div>
                                <div class="inputtypes mainform">
                                    <div class="row">
                                    <form name="frmcab" id="frmcab" method="post" action="<?php echo base_url();?>request/add_request_smartconcierge_traval_plan">
                    <div class="form-group">
                                            <div class="col-lg-5">
                                                <label>FROM</label>
                                                <select class="form-control" name="cab_fromcity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1 myimg"><img src="http://smartworks.demostage.net/assets/admin1/images/two-arrows.jpg" alt="img" /></div>
                                            <div class="col-lg-5">
                                                <label>To</label>
                                                <select class="form-control" name="cab_tocity">
                                                <option value="">Select City</option>
                                                <?php foreach($concierge_city as $city){?>
                                                <option value="<?php echo $city['cityId'];?>"><?php echo $city['name'];?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            
                                                <div class="col-lg-3">
                                                    <label>DEPARTURE</label>
                                                    <input  type="text" id="example7" class="form-control mycalender" name="cab_departure">
                                                </div>
                                               
                                             
                                             <div class="col-lg-2">
                                                <label>TIME</label>
                                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' name="cab_time">
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-3">
                                                <label>CAB PREFERENCE</label>
                                                <select class="form-control selection2" name="cab_preference">
                                                    <option value="">Select CAB</option>
                                                    <?php foreach($cab as $row){?>
                                                    <option value="<?php echo $row['cabId'];?>"><?php echo $row['name'];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                             </div>
                                              <br /><br />
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-info mybtn" id="bkcab">Book Now</button>
                                        </div>
                                        </form>
                                        </div>
                                        </div>
                  </div>
                </div>
			</div>
	</section>		
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
    $('input[name=optradio]').click(function(){
        if(this.value=='0'){
            $('input[name=airline_return]').attr("disabled", "disabled");
            $('input[name=airline_return]').val('');
        }
        else{
           $('input[name=airline_return]').removeAttr("disabled"); 
        }
    });

            
            $('#example1').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            });
            
            
            $('#example2').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            }); 
            
            
            $('#example3').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            });
            
            
            $('#example4').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            });
            $('#example5').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            }); 
            $('#example6').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            });
            $('#example7').datepicker({
                format: "dd/mm/yyyy",
                minDate: 'today'
            });   
       
     
    $('#btnreqairline').click(function(){
        //alert($('select[name=flighttype]').val());
        var chk=0;
        var intsOnly = /^\d+$/;
        stri = $('input[name=airline_adult]').val();
        stri1 = $('input[name=airline_child]').val();
        stri2 = $('input[name=airline_infant]').val();
        if($('input[name=optradio]:checked').val()){
           chk=1;
                      
           
        }else{
             alert('Please choose the way of flight');
        }
        if(chk==1){
            var fromcity=$('select[name=airline_formcity]').val();
            var tocity=$('select[name=airline_tocity]').val();
            if($('select[name=airline_formcity]').val()==""){
                alert('Please select the departure city');
                $('select[name=airline_formcity]').focus();
                $('select[name=airline_formcity]').css('border-color','red');
            }else if($('select[name=airline_tocity]').val()==""){
                alert('Please select the destination city');
                $('select[name=airline_tocity]').focus();
                $('select[name=airline_tocity]').css('border-color','red');
                $('select[name=airline_formcity]').css('border-color','#999999');
            }else if(fromcity==tocity){
                alert('Please select the different city of destination');
                $('select[name=airline_tocity]').focus();
                $('select[name=airline_tocity]').css('border-color','red');
                $('select[name=airline_fromcity]').css('border-color','#999999');
             }else if($('input[name=airline_departure]').val()==""){
                alert('Please enter the airline departure date');
                $('input[name=airline_departure]').focus();
                $('input[name=airline_departure]').css('border-color','red');
                $('select[name=airline_tocity]').css('border-color','#999999');
            }else if($('input[name=airline_return]').val()=="" && $('input[name=optradio]:checked').val()!=0){
                alert('Please enter the airline return date');
                $('input[name=airline_return]').focus();
                $('input[name=airline_return]').css('border-color','red');
                $('input[name=airline_departure]').css('border-color','#999999');
            }else if($('input[name=airline_adult]').val()==""){
                alert('Please enter the no of aduit passenger');
                $('input[name=airline_adult]').focus();
                $('input[name=airline_adult]').css('border-color','red');
                $('input[name=airline_return]').css('border-color','#999999');

            }else if(!intsOnly.test(stri)) {
                 alert('Please enter a integer value in adult passenger box');
                $('input[name=airline_adult]').focus();
                $('input[name=airline_adult]').val('');
                $('input[name=airline_adult]').css('border-color','red');
                $('input[name=airline_return]').css('border-color','#999999');
             }else if(!intsOnly.test(stri1) && stri1!="") {
                 alert('Please enter a integer value in child passenger box');
                $('input[name=airline_child]').focus();
                $('input[name=airline_child]').val('');
                $('input[name=airline_child]').css('border-color','red');
                $('input[name=airline_adult]').css('border-color','#999999');
             }else if(!intsOnly.test(stri2) && stri2!="") {
                 alert('Please enter a integer value in infant passenger box');
                $('input[name=airline_infant]').focus();
                $('input[name=airline_infant]').val('');
                $('input[name=airline_infant]').css('border-color','red');
                $('input[name=airline_child]').css('border-color','#999999');
             }
            else if($('select[name=airline_name]').val()==""){
                alert('Please select which airline you want to travel');
                $('select[name=airline_name]').focus();
                $('select[name=airline_name]').css('border-color','red');
                $('input[name=airline_child]').css('border-color','#999999');
                $('input[name=airline_infant]').css('border-color','#999999');
                $('input[name=airline_adult]').css('border-color','#999999');
            }else if($('input[name=airline_time]').val()==""){
                alert('Please enter the approximate time');
                $('input[name=airline_time]').focus();
                $('input[name=airline_time]').css('border-color','red');
                $('select[name=airline_name]').css('border-color','#999999');
                $('input[name=airline_child]').css('border-color','#999999');
                $('input[name=airline_infant]').css('border-color','#999999');
                $('input[name=airline_adult]').css('border-color','#999999');
            }else{
                  $('#frmregairline').submit();
            }
        }
});
$('#bkrailway').click(function(){
    var fromcity=$('select[name=railway_fromcity]').val();
            var tocity=$('select[name=railway_tocity]').val();
    if($('select[name=railway_fromcity]').val()==""){
        alert('Please select the departure city');
        $('select[name=railway_fromcity]').focus();
        $('select[name=railway_fromcity]').css('border-color','red');
    }
    else if($('select[name=railway_tocity]').val()==""){
        alert('Please select the destination city');
        $('select[name=railway_tocity]').focus();
        $('select[name=railway_tocity]').css('border-color','red');
        $('select[name=railway_fromcity]').css('border-color','#999999');
    }else if(fromcity==tocity){
        alert('Please select the different city of destination');
        $('select[name=railway_tocity]').focus();
        $('select[name=railway_tocity]').css('border-color','red');
        $('select[name=railway_fromcity]').css('border-color','#999999');
    }else if($('input[name=railway_departure]').val()==""){
        alert('Please enter the departure date of rail');
        $('input[name=railway_departure]').focus();
        $('input[name=railway_departure]').css('border-color','red');
        $('select[name=railway_tocity]').css('border-color','#999999');
    }else{
        $('#frmrailway').submit();
    }
});
$('#bkbus').click(function(){
    var fromcity=$('select[name=bus_fromcity]').val();
            var tocity=$('select[name=bus_tocity]').val();
    if($('select[name=bus_fromcity]').val()==""){
        alert('Please select the departure city');
        $('select[name=bus_fromcity]').focus();
        $('select[name=bus_fromcity]').css('border-color','red');
    }else if($('select[name=bus_tocity]').val()==""){
       alert('Please select the destination city');
        $('select[name=bus_tocity]').focus();
        $('select[name=bus_tocity]').css('border-color','red');
        $('select[name=bus_fromcity]').css('border-color','#999999'); 
    }else if(fromcity==tocity){
        alert('Please select the different city of destination');
        $('select[name=bus_tocity]').focus();
        $('select[name=bus_tocity]').css('border-color','red');
        $('select[name=bus_fromcity]').css('border-color','#999999');
    }else if($('input[name=bus_departure]').val()==""){
        alert('Please enter the departure date of bus');
        $('input[name=bus_departure]').focus();
        $('input[name=bus_departure]').css('border-color','red');
        $('select[name=bus_tocity]').css('border-color','#999999');
    }else if($('input[name=bus_time]').val()==""){
        alert('Please enter the approx time of bus');
        $('input[name=bus_time]').focus();
        $('input[name=bus_time]').css('border-color','red');
        $('input[name=bus_departure]').css('border-color','#999999');
    }else if($('select[name=bus_budget]').val()==""){
        alert('Please select the budget');
        $('select[name=bus_budget]').focus();
        $('select[name=bus_budget]').css('border-color','red');
        $('input[name=bus_time]').css('border-color','#999999');
    }
    else{
        $('#frmbus').submit();
    }
});
$('#bkcab').click(function(){
    var fromcity=$('select[name=cab_fromcity]').val();
            var tocity=$('select[name=cab_tocity]').val();
    if($('select[name=cab_fromcity]').val()==""){
        alert('Please select the departure city');
        $('select[name=cab_fromcity]').focus();
        $('select[name=cab_fromcity]').css('border-color','red');
    }else if($('select[name=cab_tocity]').val()==""){
       alert('Please select the destination city');
        $('select[name=cab_tocity]').focus();
        $('select[name=cab_tocity]').css('border-color','red');
        $('select[name=cab_fromcity]').css('border-color','#999999');  
    }else if(fromcity==tocity){
        alert('Please select the different city of destination');
        $('select[name=cab_tocity]').focus();
        $('select[name=cab_tocity]').css('border-color','red');
        $('select[name=cab_fromcity]').css('border-color','#999999');
    }else if($('input[name=cab_departure]').val()==""){
       alert('Please enter the departure date of cab');
        $('input[name=cab_departure]').focus();
        $('input[name=cab_departure]').css('border-color','red');
        $('select[name=cab_tocity]').css('border-color','#999999'); 
    }else if($('input[name=cab_time]').val()==""){
        alert('Please enter the approx time of cab');
        $('input[name=cab_time]').focus();
        $('input[name=cab_time]').css('border-color','red');
        $('input[name=cab_departure]').css('border-color','#999999');
    }else if($('select[name=cab_preference]').val()==""){
        alert('Please choose the cab type');
        $('select[name=cab_preference]').focus();
        $('select[name=cab_preference]').css('border-color','red');
        $('input[name=cab_time]').css('border-color','#999999');
        $('input[name=cab_departure]').css('border-color','#999999');
    }
    else{
        $('#frmcab').submit();
    }
});
$('#btnadroom').click(function(){
    var strhtml;
    var cntroom=parseInt($('input[name=cntroom]').val())+1;

    if(cntroom<=10){
        strhtml='<div id="rm'+cntroom+'"><div class="col-lg-6"><h6>Room '+cntroom+'</h6></div><div class="col-lg-6 text-center"><div class="col-lg-6"><div class="form-group"><label>ADULT(12+)</label><input type="text" class="form-control" name="room_adult[]" id="rmadult'+cntroom+'"/></div></div><div class="col-lg-6"><div class="form-group"><label>CHILD(0-12)</label><input type="text" class="form-control" name="room_child[]" id="rmchild'+cntroom+'"/></div></div></div></div>';
    $('.rooms').append(strhtml);
    $('input[name=cntroom]').val(cntroom);
    $('#rmremove').show();
    }
    
});
$('#bkroom').click(function(){
    var intsOnly = /^\d+$/;
    var cntroom=parseInt($('input[name=cntroom]').val());
    var rmadultval;
    var rmchildval;
    //alert($('select[name=hotel_status]').val());
    if($('select[name=room_city]').val()==""){
        alert('Please choose the city');
        $('select[name=room_city]').focus();
        $('select[name=room_city]').css('border-color','red');
    }else if($('input[name=room_check_in]').val()==""){
        alert('Please enter the check in date');
        $('input[name=room_check_in]').focus();
        $('input[name=room_check_in]').css('border-color','red');
        $('select[name=room_city]').css('border-color','#999999');
    }else if($('input[name=room_check_out]').val()==""){
        alert('Please enter the check in date');
        $('input[name=room_check_out]').focus();
        $('input[name=room_check_out]').css('border-color','red');
        $('input[name=room_check_in]').css('border-color','#999999');
    }else if($('#rmadult1').val()==""){
        alert('Please enter the no of adult member in a room');
        $('#rmadult1').focus();
        $('#rmadult1').css('border-color','red');
        $('select[name=room_city]').css('border-color','#999999');
        $('input[name=room_check_in]').css('border-color','#999999');
        $('input[name=room_check_in]').css('border-color','#999999');

    }
    else{
         for(i=1;i<=cntroom;i++){
            rmadultval=$('#rmadult'+i).val();
            rmchildval=$('#rmchild'+i).val();
            if(!intsOnly.test(rmadultval) && rmadultval!="") {
                alert('Please enter a integer value in adult member box');
                $('#rmadult'+i).focus();
                $('#rmadult'+i).css('border-color','red');
                $('#rmadult'+i).val('');
                return false;

            }else{
                $('#rmadult'+i).css('border-color','#999999');
            }

            if(!intsOnly.test(rmchildval) && rmchildval!="") {
                alert('Please enter a integer value in child member box');
                $('#rmchild'+i).focus();
                $('#rmchild'+i).css('border-color','red');
                $('#rmchild'+i).val('');
                return false;

            }else{
                $('#rmchild'+i).css('border-color','#999999');
            }
            if(rmchildval!="" && rmadultval==""){
                alert('Please enter the no of adult member in a room');
                $('#rmadult'+i).focus();
                $('#rmadult'+i).css('border-color','red');
                return false;
            }
            else{
               $('#rmadult'+i).css('border-color','#999999'); 
            }
         }
         $('#frmroom').submit();
    }

});
});
function removeElement() {
    //  alert(thevalue);
  var cntroom=parseInt($('input[name=cntroom]').val())-1;
  var rmroom=parseInt($('input[name=cntroom]').val());
    $('#rm'+rmroom).remove(); 
    $('input[name=cntroom]').val(cntroom);
 // var olddiv = document.getElementById(divNum);
  //d.removeChild(olddiv);
  if(cntroom==1){
    $('#rmremove').hide();
  }
}
</script>