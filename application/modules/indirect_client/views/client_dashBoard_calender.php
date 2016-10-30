<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>
* {
    box-sizing: content-box;
}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2> Dashboard</h2>

		
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
							<div class="row">
								
                                <div class="col-lg-12 new_calender">
                                 	<div id='calendar'></div>
                                    <div id="event_edit_container" class="event_edit_container">
                                        <form>
                                            <input type="hidden" />
                                            
                                            
                                            <div class="col-lg-12">
                                            
                                            	<div class="form-group">
                                                    <div class="col-lg-12">
                                                         <span>Date: </span><span class="date_holder"></span> 
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <select name="start" class="form-control">
                                                            <option value="">Select Start Time</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                     <label for="end">End Time: </label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                     <select name="end" class="form-control">
                                                        <option value="">Select End Time</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label for="title">Title: </label>
                                                    </div>
                                                    
                                                     <div class="col-lg-12">
                                                        <input type="text" name="title"  class="form-control" />
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label for="body">Body: </label>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="body"></textarea>
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
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer3.php'); ?> 


    


