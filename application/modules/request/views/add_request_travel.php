<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
</div>
			
	</header>
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000; margin-left: 15px;}
		</style>
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
                                        <div class="col-lg-12"><h2 class="panel-title ">SMART CONCEIRGE</h2></div>
                                    </div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
                                         
						<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/request/add_request_travel', $attributes); ?>

                                
										<h2 class="panel-title"></h2>
                                        
									</header>
									<div class="panel-body">
										
											
									   <?php if($this->session->flashdata('edit')){ ?>
                                                    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
                                                    <?php } ?>
                                                    <?php if($this->session->flashdata('item_error')){ ?>
                                        <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                                    <?php } ?> 
                                    
                                    
                                   <input type="hidden"  name="city" value="<?php echo $this->uri->segment(3); ?>"  >
                                    <input type="hidden"  name="location" value="<?php echo $this->uri->segment(4); ?>"  >
                                    <div class="new_conceirge">
                                        <div class="form-group">
                                            <label class="control-label col-md-12">Mode of Transport</label>
                                            <div class="col-md-6">
                                            	<select required="" name="travel_type" id="travel_type" class="form-control">
													<option value="">Choose </option>
													<option value="Flight">Flight </option>
													<option value="Train">Train </option>
													<option value="Bus">Bus</option>
												</select>
                                            </div>
                                            <label class="control-label col-md-6"></label>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-6"><input type="radio" name="way" class="way"> One Way</label>
                                            <label class="control-label col-md-6"><input type="radio" name="way" class="way"> Round Trip</label>
                                           <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-6"> From</label>
                                            <label class="control-label col-md-6"> To</label>
                                            <div class="col-md-6">
                                            	<select required="" name="from" id="from" class="form-control">
													<option value="">Choose </option>
													<?php foreach($cities as $key=>$value) {
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										
										} ?>
												</select>
                                            </div>
                                            <div class="col-md-6">
                                            	<select required="" name="to" id="to"  class="form-control">
													<option value="">Choose </option>
													<?php foreach($cities as $key=>$value) {
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										
										} ?>
												</select>
                                            </div>
                                           <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group input-daterange " data-plugin-datepicker>
                                            <label class="control-label col-md-6"> Departing</label>
                                            <label class="control-label col-md-6"> Returning</label>
                                             <div class="clearfix"></div>
                                            <div class="col-md-6" >
                                                 <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                   <input type="text" class="col-md-12 form-control" name="start" id="start"  style="text-align:left;" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            	<div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                   <input type="text" class="form-control" name="end" id="end"  style="text-align:left;">
                                                </div>
                                             </div>
                                         </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-12"> Passengers</label>
                                            <div class="col-md-2">
                                            	<select required="" name="passenger_no" id="passenger_no" class="form-control">
													<option value="">Choose </option>
													<option value="1">1</option>
													<option value="2">2 </option>
													<option value="3">3</option>
													<option value="4">4 </option>
													<option value="5">5 </option>
													<option value="6">6 </option>
													<option value="7">7 </option>
													<option value="8">8 </option>
													<option value="9">9 </option>
													<option value="10">10</option>
												</select>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-12"> Passenger Names</label>
                                            <div class="col-md-6">
                                            	<textarea class="form-control" name="pname" id="pname" rows="5"></textarea>
                                             </div>
                                            <div class="clearfix"></div>
                                        </div>	
                                            
                                        <div class="form-group">
                                            <label class="control-label col-md-12"><input type="checkbox" name="bk_hotel" > Book Hotel</label>
                                            <div class="clearfix"></div>
                                        </div>  
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><input type="radio" name="hotel_type"> 2 Star </label>
                                            <label class="control-label col-md-3"><input type="radio" name="hotel_type" >  3 Star</label>
                                            <label class="control-label col-md-3"><input type="radio" name="hotel_type" >  4 Star</label>
                                            <label class="control-label col-md-3"><input type="radio" name="hotel_type">  5 Star</label>
                                           <div class="clearfix"></div>
                                        </div> 
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-12"> Special Instructions</label>
                                            <div class="col-md-6">
                                            	<textarea class="form-control" name="instruction" rows="5"></textarea>
                                             </div>
                                            <div class="clearfix"></div>
                                        </div> 
                                            
                                      </div>
                                    
                                    
                                    
                                    
                                    
					</form>
                    
                    
                    
                   
		</div>
	
	
<div class="panel-footer">
		<div class="row">
			<div class="col-md-12 ">
           	 	<div class="col-md-12 ">	
				<button type="button" id="add_classifieds" class="btn btn-primary">Book My Trip</button>
                </div>
			</div>
		</div>
		</div>
	 <?php echo form_close();?>

			</div>
	
		</div>
	</div>
	
<!-- end: page -->
	</section>
<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>
<style>
.redmessage{
border:1px solid #f00;
color:#f00;                                                       	
	
}
.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
.redmessage::-moz-placeholder {
    color: #FF0000;
 }

.redmessage::-webkit-input-placeholder 
{
  color: #FF0000;
}

.new_conceirge { font-size:16px; color:#000;}
</style>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	
     $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 
			
			var _travel_type = $("#travel_type").val();
			
			var _from = $("#from").val();
			var _to = $("#to").val();
			var start=$("#start").val();
			var end=$("#end").val();
			var passenger_no=$("#passenger_no").val();
			var pname=$("#pname").val();
			//alert(_travel_type);
			if (_travel_type == ""  ) {
				//$("#travel_type").attr('placeholder','Please choose Mode of Transport ');
				alert('Please choose Mode of Transport ');
				$("#travel_type").css("border-color","red");
				$("#travel_type").focus();
				e.preventDefault();
			}else if (_from == "") {
				alert('Please choose start location ');
				$("#from").css("border-color","red");
				$("#from").focus();
				e.preventDefault();
			}else if (_to == "") {
				alert('Please choose end location ');
				$("#to").css("border-color","red");
				$("#to").focus();
				e.preventDefault();
			}else if(_from==_to){
				alert('start location and end location can not be same. ');
				$("#to").val('');
			}
			else if (start == "") {
				alert('Please choose start time ');
				$("#start").css("border-color","red");
				$("#start").focus();
				e.preventDefault();
			}
			else if (end == "") {
				alert('Please choose end time ');
				$("#end").css("border-color","red");
				$("#end").focus();
				e.preventDefault();
			}
			else if (passenger_no == "") {
				alert('Please choose passenger no ');
				$("#passenger_no").css("border-color","red");
				$("#passenger_no").focus();
				e.preventDefault();
			}else if (pname == "") {
				alert('Please choose passenger names ');
				$("#pname").css("border-color","red");
				$("#pname").focus();
				e.preventDefault();
			}else 
			{
			form.submit();	
				
			}
			
		});
			});
		
		
		
	
        
         </script>
     
