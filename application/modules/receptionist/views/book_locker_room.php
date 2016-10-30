<style type="text/css">
	label {margin-top: 0px !important;}
</style>
<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
	</header>
	<!-- start: page -->
	<section class="panel">
		<div class="panel-body">
			<h2 class="panel-title">Book Locker Room</h2>
		</div>
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
                <div class="col-md-3 selection pad_left0">
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
                            <select  class="form-control mb-md" name="business" id="business" onchange="getlockerBybusiness(this.value)" onclick="removeValidateHtml('business')" >
                                <?php foreach($business_data as $key=>$value) {
									echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>'; 	
								} ?>
                            </select>
                        </div>    
                    </div>
                </div>
                <div class="col-md-3 selection">
                    <div class="form-group sub_text1">          
                        <label for="inputDefault" class="col-md-12 control-label pad_left0">Locker Rooms :</label>
                        <div class="col-md-12 pad_left0">
                            <select  class="form-control mb-md" name="locker" id="locker" onchange="getlockerByLocation('this.value')" onclick="removeValidateHtml('locker')" >
                                 <?php foreach($locker_data as $key=>$value) {
                                    echo '<option value="'.$value['locker_id'].'" >'.$value['name'].'</option>'; 	
								   } ?>
                            </select>
                        </div>    
                    </div>
                </div>        
                <div class="clearfix"></div>
                <div id="messageError" class="col-md-12"></div>
                <div id="messageSuccess" class="col-md-12"style="display: none;">
                	<div style="margin-top:18px;" class="alert alert-success fade in"><a title="close" id="reload" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Your booking request has been submited.</strong></div>
                </div>
                <div id="table_result_ajax" class="col-md-12"></div>
		         <div class="clearfix"></div>
            </div>
        </div>
        <div class="panel-body panel_body_top">
             <div class="row">
                 <div class="col-md-12">
                    <div class="form-group sub_text" style="padding-left:15px;">
						<button type="button" id="bookRequest" class="btn btn-primary">Book and pay later</button>
                    </div> 
                 </div>
             </div>
       </div>
<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<style>
	.sidebar-toggle {pointer-events: none;}
	.panel_body_top { padding:15px 15px;}
	.min_booking_scroll { margin-top:0px;}
	.selection label {color: #fff; font-size: 16px;}
	.booking_picture img { max-width:100%;}
	.booking_date_section { background:#E8773B !important; padding:15px!important; border-radius: 4px;}
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
	    color: #000;
		text-align:center;
		margin:5px 0 0 0;
	}	
	.available { background:#a3cb3e; color:#fff;}
	.booked {  background:none; text-decoration: line-through; /*cursor:no-drop;*/ pointer-events: none;}
	.click_to_book { background:#a3cb3e;  box-shadow: 0 0 17px 1px #507805 inset; color:#fff;}
	.time_grid_holder { width:13.4%; float:left;}	
	.time_grid_holder + .time_grid_holder  { margin-left:5px}
	.sub_text { margin-top:10px;}
	.sub_text  .col-md-3, .sub_text1  .col-md-3  { padding-left:0!important;}
	.sub_text  .col-md-9, .sub_text1  .col-md-9  {padding-left:0!important; margin-bottom:5px; padding-right:0!important;}	
	.thumbnail-gallery, .thumbnail-gallery a  { margin:0 !important; border-radius: 4px !important;}
	.img-thumbnail .zoom { left: 8px; right:auto !important;}
	.booking_date_section h2 { 
		border-bottom: 1px solid #e2e2e2;
		color: #666;
		font-size: 15px;
		padding-bottom: 10px;
		margin-top:0;
	}			
	.booking_carousel_min_min .owl-nav { position:absolute; top: 0; width:100%;} 
	.booking_carousel_min_min .owl-theme .owl-nav .disabled  { opacity: 0!important; }
	.booking_carousel_min_min .owl-theme .owl-nav [class*="owl-"] {
		background: #999 !important;
		color:#fff !important;
		font-size: 34px !important;
		margin-top: 11px !important;
		padding: 1px 11px 9px !important;
	}	
	.carousel_min_min .owl-prev  { margin-left:15px !important;   float:left;  border-radius: 0px!important;}	
	.carousel_min_min .owl-next  {  margin-right:45px !important; float:right;  border-radius: 0px!important;}
	.booking_date_section .owl-prev  { margin-left:0px !important; float:left;  border-radius: 0px!important;}	
	.booking_date_section .owl-next  {  margin-right:0px !important; float:right;  border-radius: 0px!important;}
	.booking_date_section .owl-theme .owl-nav [class*="owl-"]  {font-size: 21px !important; padding: 0 5px 3px 5px !important;  
		margin-right: 10px !important; }
	.booking_carousel_min_min .owl-theme .owl-nav [class*="owl-"] {margin-top: 0px !important;}
	.booking_date_section 	.owl-theme .owl-nav [class*="owl-"]{margin-top: 11px !important;}
	.pad_left0 { padding-left:0;}
	.redmessage{
		border:1px solid #f00;
		color:#f00;	
	}
	.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
	.redmessage::-moz-placeholder {
	    color: #FF0000;
	 }
	.redmessage::-webkit-input-placeholder {
	  color: #FF0000;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('input[name=user_info]').change(function() {
	  console.log($('input[name=user_info]:checked').val());
	  var id = $('input[name=user_info]:checked').val();
	  $.ajax({
			type: "POST",
			url: js_site_url+"index.php/receptionist/getUserList",
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
	$("#reload").click(function(){
		location.reload();
	});
    var locker_id = $("#locker").val();
    $("#table_result_ajax").html('<img class="img-responsive" src="<?php echo base_url();?>assets/uploads/images/loader.gif" style="float:none; margin-bottom: 2%; margin-left: 40%; width: 100px;"/>');
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/getLockerRoom/"+locker_id, 
      async: false, 
      success: function(data) { 
        $("#table_result_ajax").html("");
        $("#table_result_ajax").html(data);         
      } 
    });
    $("#bookRequest").click(function(){
	 	$("#messageError").html('');
	 	if($('#user_list').length == 0){
			$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select a user first!!</strong></div>');
			return false;
		}
	 	if(CheckRadio() && chkStartDate() && chkEndDate() && chkLocNbr() && chkUser()){
	 		var locker_room_id 	= $('#locker_room_id').val();
	 		var locker_type 	= $('input[name="size"]:checked').val();
	 		var total_locker	= $("#loc_number").val();
	 		var start_date		= $("#datetimepicker6 input").val();
	 		var end_date		= $("#datetimepicker7 input").val();
	 		var price			= $('#totalExcTax').val();
	 		var userId 			= $('#user_list').val();
			$.ajax({
				type: "POST",
				url: js_site_url+"index.php/receptionist/setbookingLockerRequest",
				data: { locker_room_id: locker_room_id, locker_type: locker_type, total_locker: total_locker, start_date: start_date, end_date: end_date, price: price, userId:userId},
				dataType: "json",
				success: function(data, textStatus, jqXHR) {
					console.log("Success Msg: "+textStatus);
					if (data == true) {
						$("#messageSuccess").css('display','block');
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
function CheckRadio(){
	var checked=false;
	var elements = document.getElementsByName("size");
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please choose any locker room size.</strong></div>');
		return false;
	}else{
	$("#messageError").html('');
	console.log($('input[name="size"]:checked').val());
	return true;
	}
}
function chkStartDate(){
	var start = $("#datetimepicker6 input").val();
	if(start == ''){
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select start date.</strong></div>');
		return false;
	}else{
		$("#messageError").html('');
		return true;
	}
}
function chkEndDate(){
	var end = $("#datetimepicker7 input").val();
	if(end == ''){
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please select end date.</strong></div>');
		return false;
	}else{
		$("#messageError").html('');
		return true;
	}
}
function chkLocNbr(){
	var locNmbr = $("#loc_number").val();
	if(locNmbr == ''){
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please add number of locker(s).</strong></div>');
		return false;
	}else{
		$("#messageError").html('');
		return true;
	}
}
function chkUser(){
	var userId = $('#user_list').val();
	if(userId == ''){
		$("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>No user selected !!</strong></div>');
		return false;
	}else{
		$("#messageError").html('');
		return true;
	}
}
function lockerroomvalidation(){	
	var locker = $("#locker").val();
	if(locker=='0'){
		alert('please choose any locker room.');
		$('#locker').addClass('redmessage');
		return false;
	}else{
		$('#locker').removeClass('redmessage');
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
function getlockerBybusiness(value){
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/client/getlockerBybusiness/"+value, 
      async: true, 
      success: function(data) { 
        $("#locker").html(data.trim()); 
      } 
    });	
}
function getlockerByLocation(){
    var locker_id = $("#locker").val();
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/getLockerRoom/"+locker_id, 
      async: true, 
      success: function(data) { 
        $("#table_result_ajax").html("");
        $("#table_result_ajax").html(data);         
      } 
    });
}           
</script>
     

 
