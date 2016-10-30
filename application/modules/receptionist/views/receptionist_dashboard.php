<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>
* {
    box-sizing: content-box;
}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
	<div class="row">
			<!---<div class="board">
		<div id="profile_detail">
				<aside class="col-md-3 col-lg-3">
					<img class="img-responsive" src="<?php echo $userData['image']; ?>" alt="Profile-image" title="Profile-image">
				</aside>
				<aside class="col-md-9 col-lg-9">
					<h4><?php echo $userData['FirstName'].' '.$userData['LastName']; ?></h4>
					<p><?php echo $userData['userEmail']; ?></p>
					<p><?php echo $userData['phone']; ?></p>
					<input type="button" class="btn btn-primary" value="Edit Profile" name="editprofile" id="edit-profile-btn">
				</aside>
			</div>--->
			<!-- start: page -->
				<section class="panel">
        <div class="panel-body">
          
              <h2 class="panel-title">SCHEDULER</h2>
              
            </div>
						<div class="panel-body panel_body_top">
							<div class="row">
								
                                <div class="col-lg-12 new_calender">
                                 	<div id='calendar'></div>
                                    <div id="event_edit_container" class="event_edit_container">
                                        <form class="receptionist_popup">
                                            <input type="hidden" />
                                            
                                            
                                            <div class="col-lg-12">
                                            
                                            	<div class="form-group">
                                                    <div class="col-lg-12">
                                                         <span >Date: <abbr id="dtspan"></abbr></span>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                     <label for="end">Start Time: <abbr id="spstart"></abbr></label>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                     <label for="end">End Time: <abbr id="spend"></abbr></label>
                                                    </div>
                                                   
                                                </div>
                                                                                               
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label for="body">Message: </label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                       <span id="spbody"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label for="body">Reminder: </label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                       <select name="reminder" class="form-controll">
														   <option value="0">Not Reminded</option>
														   <option value="1">Reminded</option>
                                                       </select>
                                                    </div>
                                                </div>
                                                
                                            
                                            </div>
                                             
                                            
                                            
                                        </form>
                                    </div>
                                </div>
                                
 							</div>
 						</div>
					</section>
 					<!-- end: page -->
			<div class="clearfix"></div>
			
<script type="text/javascript">
			
   function getEventData() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var day = new Date().getDate();
      var yearmonthday=<?php echo json_encode($eventyearmonthday); ?>;
      var pausecontent = <?php echo json_encode($eventdata); ?>;
      console.log(pausecontent);
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
        </script>
<style type="text/css">
  /*---------19-7-2016---------*/
.new_calender button.wc-today {
    background: #000 none repeat scroll 0 0 !important;
}

body .btn-primary {
    color: #ffffff !important;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25) !important;
    background-color: #000 !important;
    border-color: #000 !important;
}


.heading_text h2 {
    color: #000 !important;
    float: left !important;
    font-size: 18px !important;
    font-weight: bold !important;
    margin: 8px 0 0 !important;
    padding: 0 !important;
}

.date_min {
    position: absolute !important;
    left: 26px !important;
    top: 12px !important;
    z-index: 9 !important;
    width: 330px !important;
    padding: 15px !important;
    background-color: rgba(255,255,2255,0.9) !important;
    border: 1px solid #ccc !important;
    box-shadow: 0px -1px 8px 1px rgba(0,0,0,0.49) !important;
    -moz-box-shadow: 0px -1px 8px 1px rgba(0,0,0,0.49) !important;
    -webkit-box-shadow: 0px -1px 8px 1px rgba(0,0,0,0.49) !important;
}

.date_panel ul li textarea {
    padding: 4% !important;
    width: 92% !important;
    font-size: 16px !important;
    color: #000 !important;
    height: 48px !important;
    background: none !important;
    border: 0 !important;
    resize: none !important;
}


.new_calender .wc-header td {
    background-color: #000 !important;
    color: #fff !important;
}

.wc-business-hours {
    background-color: #ccc !important;
    border-bottom: 1px solid #fff !important;
    color: #000 !important;
    font-size: 1.4em !important;
}
/*---------19-7-2016---------*/
</style>
<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer3.php'); ?> 


    


