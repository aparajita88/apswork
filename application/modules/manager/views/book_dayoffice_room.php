<style type="text/css">
	label {margin-top: 0px !important;}
</style>
<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
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
.img-responsive.loding-ajax {
    margin-bottom: 2%;
    margin-left: 40%;
    width: 100px;
	display: none;
}
</style>
<section role="main" class="content-body">
<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
</header>
<div class="row">			
<!-- start: page -->
<section class="panel">
<div class="panel-body"><h2 class="panel-title">Book Day Office</h2></div>
<div class="panel-body panel_body_top">
	<div class="row">
		<div class="form-group">
          <div class="col-md-4">
          	<label class="radio-inline">
		      <input type="radio" name="user_info" value="ru">Prospect
		    </label>
		    <label class="radio-inline">
		      <input type="radio" name="user_info" value="eu">Existing Client
		    </label>
        </div>
      	<div class="col-md-7 selection">
			<div class="form-group sub_text1 selUser">
			    
			</div>
        </div>
      </div>
	</div>
</div>
<div class="panel-body panel_body_top">
	<div class="row booking_carousel_min_min">
		<div class="col-md-3 selection">
			<div class="form-group sub_text1">
			   <label for="inputDefault" class="col-md-12 control-label">City  :</label>
				<div class="col-md-12">
				 <select class="form-control mb-md" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
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
				   <select class="form-control mb-md" name="location" id="location" onchange="get_business(this.value)" onclick="removeValidateHtml('location')">
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
					<select  class="form-control mb-md" name="business" id="business" onchange="getdayofficeBybusiness(this.value)" onclick="removeValidateHtml('business')" >
				<!--<option value="0">Select Business</option>-->
				 <?php foreach($business_data as $key=>$value) {
					
					
					echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>'; 
				
					
				} ?>
		   
			</select>
				</div>
				
			</div>
		</div>
		<div class="col-md-3 selection">
			<div class="form-group sub_text1">							
				<label for="inputDefault" class="col-md-12 control-label pad_left0">Day Office:</label>
				<div class="col-md-12 pad_left0">
					<select  class="form-control mb-md" name="dayoffice" id="dayoffice" onchange="getdayofficeByLocation('this.value')" onclick="removeValidateHtml('locker')" >
                <?php foreach($dayoffice_data as $key=>$value) {
						echo '<option value="'.$value['dayoffice_id'].'" >'.$value['name'].'</option>'; 	
					} ?>
		   
			</select>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div>
<div class="min_booking_scroll item col-md-12">
	<div id="messageSuccess" style="display: none;"><div style="margin-top:18px;" class="alert alert-success fade in"><a title="close" id="reload" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Your booking request has been submited.</strong></div></div>
	<div id="messageError"></div>
	<img class="img-responsive loding-ajax" src="<?php echo base_url();?>assets/uploads/images/loader.gif">
	<div class="booking-calender"></div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="col-md-8">
			<div class="form-group sub_text">
				<label for="inputDefault" class="col-md-3 control-label">Purpose : </label>
				<div class="col-md-9">
				<textarea class="form-control" rows="5" id="purpose"></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-4">
				<div class="table-responsive priceTable"></div>
		</div>	 
	</div>
	<div class="col-md-8">
		<div class="form-group sub_text ">
					<button type="button" id="bookRequest" class="btn btn-primary">Book and pay later</button>
		</div>
	</div>
	<div class="clearfix"></div>   
</div>
<div class="clearfix"></div>   
</div>
</div>
</section>
<div class="clearfix"></div>
<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer3.php'); ?>
<script type="text/javascript">	
// ajax load calender data on ready
$(document).ready(function(){
	$('input[name=user_info]').change(function() {
	  console.log($('input[name=user_info]:checked').val());
	  var id = $('input[name=user_info]:checked').val();
	  $.ajax({
			type: "POST",
			url: js_site_url+"index.php/manager/getUserList",
			data: { id: id},
			success: function(data, textStatus, jqXHR) {
				console.log("Success Msg: "+textStatus);
				$('.selUser').html(data);
				//code after success
			},
			error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			},
			complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			}
		});
	});
	$.ajax({
		type: "GET",
		url: js_site_url+"index.php/client/clearSessionArray",
		success: function(data, textStatus, jqXHR) {
			console.log("Page refreshed and booked slot(s) cleared "+textStatus);
		}
	});
	var dayoffice_id = $("#dayoffice").val();
	if (dayoffice_id == ''|| dayoffice_id == null) {
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Sorry!</strong> no rooms available</div>');
	}else{
		$(".loding-ajax").css('display','block');
		$.ajax({
		type: "POST",
		url: js_site_url+"index.php/manager/getCalenderDayOffice",
		data: { dayoffice_id: dayoffice_id },
		dataType: "html",
		success: function(data, textStatus, jqXHR) {
			$(".loding-ajax").css('display','none');
			//code after success
			$(".booking-calender").html(data);
		},
		error: function(data, textStatus, jqXHR){
			console.log("Error Msg: "+textStatus);
			//code after getting error
		},
		complete: function(data, textStatus, jqXHR){
			console.log("Complete Msg: "+textStatus);
			//code after complete ajax request
		}
		});
	}
	$("#reload").click(function(){
		location.reload();
	});
	$("#bookRequest").click(function(){
		if($('#user_list').length == 0){
			$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select a user first!!</strong></div>');
			return false;
		}
	 	var dayoffice_id = $("#dayoffice").val();
	 	var purpose = $("#purpose").val();
	 	var price = $('#totalExcTax').val();
		var userId = $('#user_list').val();
	 	if (purpose == "") {
			$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please enter your purpose of booking</strong></div>');
			return false;
	 	}else if(price == ''){
		 	$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Price not defined</strong></div>');
			return false;
		}else if(userId == ''){
	 		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>No user selected !!</strong></div>');
			return false;
	 	}else{
	 	$("#messageError").html('');
		$.ajax({
			type: "POST",
			url: js_site_url+"index.php/manager/setbookingDayOfficeRequest",
			data: { dayoffice_id: dayoffice_id, purpose: purpose, price:price, userId:userId},
			dataType: "json",
			success: function(data, textStatus, jqXHR) {
				console.log("Success Msg: "+textStatus);
				if (data == true) {
					$("#messageSuccess").css('display','block');
				}else if(data == 'noslotsSelected'){
					$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select timeslot(s) !!</strong></div>');
				}
				//code after success
			},
			error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			},
			complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			}
		});	
	 }
	});
});
// end
function getdayofficeByLocation(){
	var dayoffice_id = $("#dayoffice").val();
	if (dayoffice_id == '') {
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Sorry!</strong> no rooms available</div>');
	}else{
		$("#messageError").html(' ');
		$.ajax({
			type: "POST",
			url: js_site_url+"index.php/manager/getCalenderDayOffice",
			data: { dayoffice_id: dayoffice_id },
			dataType: "html",
			success: function(data, textStatus, jqXHR) {
				//code after success
				$(".booking-calender").html(data);
			},
			error: function(data, textStatus, jqXHR){
				console.log("Error Msg: "+textStatus);
				//code after getting error
			},
			complete: function(data, textStatus, jqXHR){
				console.log("Complete Msg: "+textStatus);
				//code after complete ajax request
			}
		});
	}
}
function dayofficeroomvalidation(){		
	var dayoffice = $("#dayoffice").val();
	if(dayoffice=='0'){
		alert('please choose any dayoffice room.');
		$('#dayoffice').addClass('redmessage');
		return false;
	}else{
		$('#dayoffice').removeClass('redmessage');
		return true;
	}			
}      
function get_location(value){
	$.ajax({ 
	  method: "POST", 
	  url: js_site_url+"index.php/client/getlocationbycity/"+value,  
	  async: true, 
	  success: function(data) { 
		$("#location").html(data.trim());
	  } 
	});
}
function get_business(value){
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
function getdayofficeBybusiness(value){
	$.ajax({ 
	  method: "POST", 
	  url: js_site_url+"index.php/client/getdayofficeBybusiness/"+value, 
	  async: true, 
	  success: function(data) { 	  	
		$("#dayoffice").html(data.trim());      
	  } 
	});		
}          
</script>
<style>
.sidebar-toggle {pointer-events: none;}
.panel_body_top { padding:15px 15px;}
.min_booking_scroll { margin-top:0px;}
.selection label {color: #333; font-size: 16px;}
.booking_picture img { max-width:100%;}
.booking_date_section { background:#1EB1E7; padding:15px; border-radius: 4px;}
.time_grid	{
padding:1px 0px;
width:100%;
background:#fff;
text-align:center;
margin:5px 0 0 0;
cursor:pointer;
}
.date_grid	{
padding:1px 0px;
width:100%;
color: #fff;
text-align:center;
margin:5px 0 0 0;
}	
 .available { background:#E8773B; color:#fff;}
 .notavailable { background:#658F9F; color:#fff; pointer-events: none;}
 .booked {  background:#fff; text-decoration: line-through; /*cursor:no-drop;*/ pointer-events: none;}
 .click_to_book {  box-shadow: 0 0 17px 1px #507805 inset; color:#fff;}
.time_grid_holder { width:13.4%; float:left;}	
.time_grid_holder + .time_grid_holder  { margin-left:5px}

.sub_text { margin-top:10px;}
.sub_text  .col-md-3, .sub_text1  .col-md-3  { padding-left:0!important;}
.sub_text  .col-md-9, .sub_text1  .col-md-9  {padding-left:0!important; margin-bottom:5px; padding-right:0!important;}	

.thumbnail-gallery, .thumbnail-gallery a  { margin:0 !important; border-radius: 4px !important;}
.img-thumbnail .zoom { left: 8px; right:auto !important;}

.booking_date_section h2 { 
border-bottom: 1px solid #e2e2e2;
color: #fff;
font-size: 15px;
padding-bottom: 10px;
margin-top:0;}

.booking_carousel_min_min .owl-nav { position:absolute; top: 0; width:100%;}
 
.booking_carousel_min_min .owl-theme .owl-nav .disabled  { opacity: 0!important; }
.booking_carousel_min_min .owl-theme .owl-nav [class*="owl-"] {
	background: #999 !important;
	color:#fff !important;
	font-size: 34px !important;
	margin-top: 11px !important;
	padding: 1px 11px 9px !important;}
	
.carousel_min_min .owl-prev  { margin-left:15px !important;   float:left;  border-radius: 0px!important;}	
.carousel_min_min .owl-next  {  margin-right:45px !important; float:right;  border-radius: 0px!important;}

.booking_date_section .owl-prev  { margin-left:0px !important; float:left;  border-radius: 0px!important;}	
.booking_date_section .owl-next  {  margin-right:0px !important; float:right;  border-radius: 0px!important;}

.booking_date_section .owl-theme .owl-nav [class*="owl-"]  {font-size: 21px !important; padding: 0 5px 3px 5px !important;  
margin-right: 10px !important; }

.booking_carousel_min_min .owl-theme .owl-nav [class*="owl-"] {margin-top: 0px !important;}
.booking_date_section 	.owl-theme .owl-nav [class*="owl-"]{margin-top: 11px !important;}
.pad_left0 { padding-left:0;}
</style>