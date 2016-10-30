<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>
* {
    box-sizing: content-box;
}
</style>
<section role="main" class="content-body">
<header class="page-header">
	<h2>Hi   <?php echo ucfirst($userData['FirstName'])." ".ucfirst($userData['LastName']);?></h2>		
</header>
<div class="row">
<!-- start: page -->
<section class="panel">
			<div class="panel-body">
          
              <h2 class="panel-title">Scheduler</h2>
              
            </div>
			<div class="panel-body panel_body_top">
			<div class="row">								
				<div class="col-lg-12 new_calender new_calender_relative">
                    <div class="date_min"></div>
                    
                	<a href="javascript:void(0);" title="ToDo" id="open_div" style="position:absolute;" class="heading_text">
                    <button class="btn btn-primary btn_green" >To Do List</button>
                    </a>
                    
                    
                    
                    <div class="clearfix"></div>
                    <div id='calendar_virtual_assistant'></div>		
					<div id="event_view_container" class="event_edit_container">
						<form>
							<div class="col-lg-12">                                          
								<div class="form-group">
									<div class="col-lg-12">
										 <span><b>Date: </b></span><span class="date_holder"></span> 
									</div>
									<div class="col-lg-12">
										<div class="col-lg-12">
											<label for="end"><b>Start Time: </b></label>
										</div>
										<select name="start" class="form-control" disabled="disabled">
											<option value="">Select Start Time</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
									 <label for="end"><b>End Time: </b></label>
									</div>
									<div class="col-lg-12">
									 <select name="end" class="form-control" disabled="disabled">
										<option value="">Select End Time</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
									 <label for="chkShare"><b>Share Event: </b></label>
									</div>
									<div class="col-lg-12">
									  <input type="checkbox" id="checkView" name="chkShare" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<label for="body"><b>Details: </b></label>
									</div>
									<div class="col-lg-12">
										<textarea class="form-control" name="body" rows="4" cols="50"></textarea>
									</div>
								</div                                              
							></div>                                           
						</form>
					</div>
					<div id="event_new_create" class="event_edit_container">
						<form>
							<div class="col-lg-12">                                          
								<div class="form-group">
									<div class="col-lg-12">
										 <span><b>Date: </b></span><span class="date_holder"></span> 
									</div>
									<div class="col-lg-12">
										<div class="col-lg-12">
											<label for="end"><b>Start Time: </b></label>
										</div>
										<select name="start" class="form-control">
											<option value="">Select Start Time</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
									 <label for="end"><b>End Time: </b></label>
									</div>
									<div class="col-lg-12">
									 <select name="end" class="form-control">
										<option value="">Select End Time</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
									 <label for="chkShare"><b>Share Event: </b></label>
									</div>
									<div class="col-lg-12">
									  <input type="checkbox" id="check" name="chkShare" value="1">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<label for="body"><b>Details: </b></label>
									</div>
									<div class="col-lg-12">
										<textarea class="form-control" name="body" rows="4" cols="50"></textarea>
									</div>
								</div                                              
							></div>                                           
						</form>
					</div>
				</div>					
			</div>
		</div>
</section>
<!-- end: page -->
<input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>" />
<div class="clearfix"></div>
<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer3.php'); ?> 
<script type="text/javascript">
function getEventData() {
var year = new Date().getFullYear();
var month = new Date().getMonth();
var day = new Date().getDate();
var yearmonthday = <?php echo json_encode($eventyearmonthday); ?>;
var pausecontent = <?php echo json_encode($eventdata); ?>;
if (pausecontent == "") {
	return {
	events: []	  
};
}else{
for(var i=0;i<pausecontent.length;i++){
	var res = yearmonthday[i].split("-");
	day1=parseInt(res[2])-day;
	pausecontent[i]['start']=new Date(year, month, day+day1, pausecontent[i]['start']);
	pausecontent[i]['end']=new Date(year, month, day+day1, pausecontent[i]['end']);
}
return {
	events: pausecontent	  
};	
}
}
// this dialog box for ToDo List 
$(document).ready(function(){
	$.ajax({
	type: "GET",
	url: js_site_url+"index.php/client/getTodo",
	dataType: "html",
	success: function(data, textStatus, jqXHR) {
		$(".loding-ajax").css('display','none');
		//code after success
		$(".date_min").html(data);
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
</script>
<style>
.new_calender_relative { position:relative;}
.date_min { 
	position:absolute; 
	left:26px; top:12px; 
	z-index: 9;
	width:330px; 
	padding:15px;
 	background-color:rgba(62,184,233,0.8);}

.date_panel { position:relative;}	
.closes {
	background: #000 none repeat scroll 0 0;
    border: 2px solid #fff;
    border-radius: 50%;
    color: #fff;
    height: 28px;
    line-height: 28px;
    position: absolute;
    right: -38px;
    text-align: center;
    top: -37px;
    width: 30px;
	}
.closes a { display:block;}	
.closes .fa { color:#fff; font-size:15px;}	

.date_panel ul { padding:0; margin:0;}
.date_panel ul li { position:relative; list-style:none; 
background:url(<?php echo base_url(); ?>application/modules/client/views/dot.png) no-repeat left 18px;}
.date_panel ul li  textarea  {  
	padding: 4%;
    width: 92%;
	font-size:16px;
	color:#fff;
	height: 48px;
	background:none;
	border:0;
	resize:none;
	}
.editis { position:absolute; right:0; top:16px;}
.editis a .fa  { color:#fff; font-size:16px;}

.heading_text h2 { 
	color: #fff;
    float: left;
    font-size: 18px;
    font-weight: bold;
    margin: 8px 0 0;
    padding: 0;
}
.heading_text .btn { float:right; font-weight:bold; font-size:13px; border-radius:0;}
.heading_text  {
	/*box-shadow: 0 1px 0 0 #606060;*/
	margin-bottom: 15px;
    padding-bottom: 8px;
}
.date_panel .form-control { padding: 4%;
    width: 92%; font-size:16px; color: #000; height: 50px; border-radius:0 !important} 

.date_panel .add_form .btn { margin-left:15px; margin-top:15px; border-radius:0 !important}	

/*---------19-7-2016---------*/
.new_calender button.wc-today {
    background: #000 none repeat scroll 0 0;
}

body .btn-primary {
    color: #ffffff;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: #000;
    border-color: #000;
}


.heading_text h2 {
    color: #000;
    float: left;
    font-size: 18px;
    font-weight: bold;
    margin: 8px 0 0;
    padding: 0;
}

.date_min {
    position: absolute;
    left: 26px;
    top: 12px;
    z-index: 9;
    width: 330px;
    padding: 15px;
    background-color: rgba(255,255,2255,0.9);
    border: 1px solid #ccc;
    box-shadow: 0px -1px 8px 1px rgba(0,0,0,0.49);
    -moz-box-shadow: 0px -1px 8px 1px rgba(0,0,0,0.49);
    -webkit-box-shadow: 0px -1px 8px 1px rgba(0,0,0,0.49);
}

.date_panel ul li textarea {
    padding: 4%;
    width: 92%;
    font-size: 16px;
    color: #000;
    height: 48px;
    background: none;
    border: 0;
    resize: none;
}


.new_calender .wc-header td {
    background-color: #000;
    color: #fff;
}

.wc-business-hours {
    background-color: #ccc;
    border-bottom: 1px solid #fff;
    color: #000;
    font-size: 1.4em;
}

.btn_green1 {
    color: #fff !important;
}

.btn_green {
    background: #000 !important;
    border: 1px solid #000 !important;
}
/*---------19-7-2016---------*/
</style>
    


