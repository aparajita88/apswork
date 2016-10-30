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
                  <li class="cab"><a data-toggle="pill" href="#movie"><i class="fa fa-video-camera" aria-hidden="true"></i> Movies</a></li>
                  <li class="bus"><a data-toggle="pill" href="#resturant"><i class="fa fa-cutlery" aria-hidden="true"></i> Restaurant</a></li>
                  <li class="train"><a data-toggle="pill" href="#event"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a></li>
                  <li class="hotel"><a data-toggle="pill" href="#experience"><i class="fa fa-bullhorn" aria-hidden="true"></i> Experiences</a></li>
                  
                </ul>
                
               <div class="tab-content">
                  <div id="movie" class="tab-pane fade in active">
                  <div class="row">
                  <form role="form" name="frmregairline" method="post" id="frmregmovie" action="<?php echo base_url();?>index.php/request/add_request_smartconcierge_booking">
                    <div class="heading">
                    	<aside class="col-lg-9">
                        	<h4>Book Movie Tickets</h4>
                        </aside>
                        
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="mainform">
                    	<div class="row">
                    		<aside class="col-lg-9">
                            
                                
                                <div class="clearfix"></div>
                                <form>
                                <div class="inputtypes">
                                	<div class="row">
                                        <div class="form-group">
                                        	<div class="col-lg-6">
                                            	<label>MOVIE NAME</label>
                                            	<select class="form-control selection2" name="movie_name" onchange="fnmovielocation(this.value)">
                                              <option value="">Select Movie</option>
                                              <?php foreach($movie as $row){?>
                                              <option value="<?php echo $row['movieId'];?>"><?php echo $row['name'];?></option>
                                              <?php }?>
                                                	
                                                </select>
                                            </div>
                                            
                                        </div>
                                         <div class="form-group">
                                         <div class="col-lg-6">
                                            	<label>LOCATION</label>
                                                <select class="form-control selection2" name="movie_location">
                                                	<option value="">Select Location</option>
                                                    
                                                </select>
                                            </div>
                                            </div>
                                        <div class="form-group">
                                        	<div class="col-lg-6">
                                                                           	
                                                	<label>DATE</label>
                                                    <input  type="text" id="example1" class="form-control mycalender" name="movie_date">
                                                </div>
                                                                            
                                            </div>
                                           
                                        
                                        <div class="form-group">
                                        	<div class="col-lg-2">
                                            	<label>START TIME</label>
                                                <input type="text" data-plugin-timepicker class="form-control" name="movie_time">
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-3">
                                            	<label>NO OF PERSON</label>
                                                <select class="form-control selection2" name="movie_person">
                                                <?php for($i=1;$i<=100;$i++){?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php }?>
                                                
                                                       
                                                </select>
                                            </div>
                                        </div>
                                         <br /><br />
                                         <div class="form-group">
                                         	<div class="col-lg-5">
                                            	<button type="button" class="btn btn-lg btn-info mybtn" id="btnreqmovie">Book Now</button>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             </form>
                         </aside>
                         </div>
                         
                    </div>
                    </form>
                    </div>
                  </div>
                  <div id="resturant" class="tab-pane fade">
                   <div class="row">
                   <form name="frmresturant" id="frmresturant" method="post" action="<?php echo base_url();?>index.php/request/add_request_smartconcierge_booking">
                        <div class="heading">
                            <aside class="col-lg-9">
                                <h4>Book Restaurant</h4>
                            </aside>
                            
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="mainform">
                        	<div class="row">
                            	<div class="col-lg-10">
                                	
                                    	<div class="form-group">
                                      <div class="col-lg-6">
                                                  <label>LOCATION</label>
                                                    <select class="selection2 form-control" name="resturant_location" onchange="fnresturantoflocation(this.value)">
                                                      <option value="">Select Location</option>
                                                      <?php foreach($res_location as $row){?>
                                                      <option value="<?php echo $row['locationId'];?>"><?php echo $row['name'];?></option>
                                                      <?php }?>
                                                    </select>
                                                </div>
                                    	<div class="col-lg-6">
                                        	<label>RESTAURANT NAME</label>
                                            <select class="form-control selection2" name="resturant">
                                            	<option value="">Select Restaurant</option>
                                               
                                            </select>
                                            </div>
                                            
                                        </div>
                                        	<div class="form-group">
                                    	<div class="col-lg-6">
                                        	<label>DATE</label>
                                            <input  type="text" id="example2" class="form-control mycalender" name="resturant_date">
                                            </div>
                                            <div class="col-lg-6">
                                                	<label>VEG/NON VEG</label>
                                                    <select class="selection2 form-control" name="food_type">
                                                    	<option value="">Select One</option>
                                                      <option value="VEG">VEG</option>
                                                      <option value="NON VEG">NON VEG</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                    	<div class="col-lg-6">
                                        	<label>TYPE</label>
                                            <select class="selection2 form-control" name="food_status">
                                                    	<option value="">Select Type</option>
                                                      <option value="Breakfast">Breakfast</option>
                                                      <option value="Lunch">Lunch</option>
                                                      <option value="Dinner">Dinner</option>
                                                    </select>
                                            </div>
                                            <div class="col-lg-6">
                                                	<label>NO OF PERSON</label>
                                                    <select class="selection2 form-control" name="resturant_member">
                                                    <?php for($i=1;$i<=100;$i++){?>
                                                    	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                        </div>
                                        
                                        <br /><br />
                                        <div class="form-group">
                                        	<button type="button" class="btn btn-lg btn-info mybtn" id="bkresturant">Book Now</button>
                                        </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                        </form>
                   </div>
                  </div>
                  <div id="event" class="tab-pane fade">
                    <h3>Book Event</h3>
                    <div class="clearfix"></div>
                                <div class="inputtypes mainform">
                                    <div class="row">
                                    <form name="frmevent" id="frmevent" action="<?php echo base_url();?>index.php/request/add_request_smartconcierge_booking" method="post">
                    
                                        <div class="form-group">
                                            <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>EVENT NAME</label>
                                                    <select class="selection2 form-control" name="event_name">
                                                    	<option value="">Select Event Name</option>
                                                      <?php foreach($event as $row){?>
                                                      <option value="<?php echo $row['eventId'];?>"><?php echo $row['eventName'];?></option>
                                                      <?php }?>
                                                    </select>
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                             <div class="form-group">
                                            <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>LOCATION</label>
                                                    <select class="selection2 form-control" name="event_location">
                                                    	<option value="">Select Location</option>
                                                      <?php foreach($event_loc as $row){?>
                                                      <option value="<?php echo $row['locationId'];?>"><?php echo $row['location'];?></option>
                                                      <?php }?>
                                                    </select>
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                             <div class="form-group">
                                            <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>DATE</label>
                                                    <input  type="text" id="example3" class="form-control mycalender" name="event_date">
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                             
                                             <div class="form-group">
                                            <div class="col-lg-7">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>NO OF PERSON</label>
                                                    <select class="selection2 form-control" name="no_of_person">
                                                    <?php for($i=1;$i<=100;$i++){?>
                                                    	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                              <br /><br />
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-info mybtn" id="bkevent">Book Now</button>
                                        </div>
                                       </form>
                                        </div>
                  </div>
                  </div>
                  <div id="experience" class="tab-pane fade">
                    <h3>Book For Experience</h3>
                     <div class="clearfix"></div>
                                <div class="inputtypes mainform">
                                    <div class="row">
                                    <form name="frmexperience" id="frmexperience" method="post" action="<?php echo base_url();?>index.php/request/add_request_smartconcierge_booking">
                   
                                        <div class="form-group">
                                            <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>NAME</label>
                                                    <select class="selection2 form-control" name="experience_name">
                                                    	<option value="">Select Experience Name</option>
                                                      <?php foreach($experience as $row){?>
                                                      <option value="<?php echo $row['experienceId'];?>"><?php echo $row['experienceName'];?></option>
                                                      <?php }?>
                                                    </select>
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                             <div class="form-group">
                                            <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>LOCATION</label>
                                                    <select class="selection2 form-control" name="experience_location">
                                                    	<option value="">Select Location</option>
                                                      <?php foreach($exp_loc as $row){?>
                                                     <option value="<?php echo $row['locationId'];?>"><?php echo $row['location'];?></option>
                                                      <?php }?>
                                                    </select>
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                             <div class="form-group">
                                            <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>DATE</label>
                                                    <input  type="text" id="example4" class="form-control mycalender" name="experience_date">
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                             
                                             <div class="form-group">
                                            <div class="col-lg-7">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>NO OF PERSON</label>
                                                    <select class="selection2 form-control" name="no_of_person">
                                                    <?php for($i=1;$i<=100;$i++){?>
                                                    	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                               
                                             </div> 
                                             </div>
                                             </div>
                                              <br /><br />
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-info mybtn" name="bkbus" id="bkexperience">Book Now</button>
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
function fnmovielocation(val){
  $.ajax
    ({ 
        url: js_site_url+'index.php/request/get_location_for_request',
        data: "movieId="+val+"&type=movie",
        type: 'post',
        success: function(data)
        {
            $('select[name=movie_location]').html(data);
        }
    });
}
function fnresturantoflocation(val){
      $.ajax
    ({ 
        url: js_site_url+'index.php/request/get_resturant_for_request',
        data: "locationId="+val+"&type=resturant",
        type: 'post',
        success: function(data)
        {
          //alert(data);
            $('select[name=resturant]').html(data);
        }
    });
}
$(document).ready(function(){
     $('#btnreqmovie').click(function(){
         if($('select[name=movie_name]').val()==""){
          alert('Please Select the movie name');
            $('select[name=movie_name]').focus();
            $('select[name=movie_name]').css('border-color','red');

         }else if($('select[name=movie_location]').val()==""){
            alert('Please select the location');
            $('select[name=movie_location]').focus();
            $('select[name=movie_location]').css('border-color','red');
            $('select[name=movie_name]').css('border-color','#999999');

         }else if($('input[name=movie_date]').val()==""){
            alert('Please enter the movie date');
            $('input[name=movie_date]').focus();
            $('input[name=movie_date]').css('border-color','red');
            $('select[name=movie_name]').css('border-color','#999999');
            $('select[name=movie_location]').css('border-color','#999999');

         }else if($('input[name=movie_time]').val()==""){
             alert('Please enter the movie time');
            $('input[name=movie_time]').focus();
            $('input[name=movie_time]').css('border-color','red');
            $('select[name=movie_name]').css('border-color','#999999');
            $('select[name=movie_location]').css('border-color','#999999');
            $('input[name=movie_date]').css('border-color','#999999');
         }else{
            $('#frmregmovie').submit();
         }
     });
     $('#bkresturant').click(function(){
         if($('select[name=resturant_location]').val()==""){
          alert('Please Select the the location of restaurant');
            $('select[name=resturant_location]').focus();
            $('select[name=resturant_location]').css('border-color','red');

         }else if($('select[name=resturant]').val()==""){
            alert('Please select the restaurant');
            $('select[name=resturant]').focus();
            $('select[name=resturant]').css('border-color','red');
            $('select[name=resturant_location]').css('border-color','#999999');

         }else if($('input[name=resturant_date]').val()==""){
            alert('Please enter the date');
            $('input[name=resturant_date]').focus();
            $('input[name=resturant_date]').css('border-color','red');
            $('select[name=resturant_location]').css('border-color','#999999');
            $('select[name=resturant]').css('border-color','#999999');

         }else if($('select[name=food_type]').val()==""){
            alert('Please select the food item');
            $('select[name=food_type]').focus();
            $('select[name=food_type]').css('border-color','red');
            $('select[name=resturant_location]').css('border-color','#999999');
            $('select[name=resturant]').css('border-color','#999999');

         }
         else if($('select[name=food_status]').val()==""){
            alert('Please select the type of order');
            $('select[name=food_status]').focus();
            $('select[name=food_status]').css('border-color','red');
            $('select[name=resturant_location]').css('border-color','#999999');
            $('select[name=resturant]').css('border-color','#999999');


         }else{
            $('#frmresturant').submit();
         }
     });
     $('#bkevent').click(function(){
        if($('select[name=event_name]').val()==''){
          alert('Please select the event');
          $('select[name=event_name]').css('border-color','red');
          $('select[name=event_name]').focus();
        }
        else if($('select[name=event_location]').val()==''){
          alert('Please select the location');
          $('select[name=event_location]').focus();
          $('select[name=event_location]').css('border-color','red');
          $('select[name=event_name]').css('border-color','#999999');

        }
        else if($('input[name=event_date]').val()==''){
          alert('Please select the event date');
          $('input[name=event_date]').focus();
          $('input[name=event_date]').css('boder-color','red');
          $('select[name=event_name]').css('border-color','#999999');
          $('select[name=event_location]').css('border-color','#999999');

        }else{
          $('#frmevent').submit();
        }
     });
     $('#bkexperience').click(function(){
       if($('select[name=experience_name]').val()==""){
        alert('Please select the experience');
        $('select[name=experience_name]').focus();
        $('select[name=experience_name]').css('border-color','red');
       }
       else if($('select[name=experience_location]').val()==""){
        alert('Please select the location');
        $('select[name=experience_location]').focus();
        $('select[name=experience_location]').css('border-color','red');
        $('select[name=experience_name]').css('border-color','#999999');
       }
       else if($('input[name=experience_date]').val()==""){
        alert('Please enter the experience date');
        $('input[name=experience_date]').focus();
        $('input[name=experience_date]').css('border-color','red');
        $('select[name=experience_name]').css('border-color','#999999');
        $('select[name=experience_location]').css('border-color','#999999');
       }
       else{
         $('#frmexperience').submit();
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
});
</script>