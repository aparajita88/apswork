<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			<!--<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboarddd</span></li>-->
			</ol>
</div>
			<!--<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	</header>
	<div class="row">
	<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
			<h2 class="panel-title">Add Staff</h2>
			</div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
										
										
									<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/users/add_staff', $attributes);?>
	     
           <?php if($this->session->flashdata('success')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
	<?php //print_r($userData);?>
	<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Staff Type<span class="required">*</span></label>
												<div class="col-md-6">										
	<select class="form-control mb-md" name="staff_type" id="staff_type"  onclick="removeValidateHtml('staff_type')">
                                    	<option value="0">Select Type</option>
                                        <?php foreach($staff_type as $key=>$value) {
											
											echo '<option value="'.$value['userTypeId'].'">'.$value['userTypeName'].'</option>'; 
										}
											
										 ?>
                                    </select>
                                    </div>
											</div>
		
											<div class="form-group">
												
												<label class="col-md-3 control-label" for="inputDefault">First Name<span class="required">*</span></label>
												
												<div class="col-md-6">
								<input class="form-control" name="first_name"   value="" id="first_name" type="text"  />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Last Name<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="last_name"   value="" id="last_name" type="text"  />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">staff Email<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="staff_email"   value="" id="email" type="text"  />
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">staff Profile Name</label>
												<div class="col-md-6">
								<input class="form-control" name="userProfilename"   value="" id="" type="text" />
												</div>
											</div>
											
								<div class="form-group">
                                                <label class="col-md-3 control-label">staff Image<span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <div id="AddFileInputBox" class="image_up">
<span class="loader" id="loader1"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" ></span>
<span class="avter"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/icon1inoimages.jpg" class="preview" id="blah1"></span>
<a><i class="icon-camera"></i></a><br><input onchange="readURL(this,1);" type="file" name="ListeeTypeImage" id="ListeeTypeImage">
</div> <div id="msg" style="display:none;"  ></div>  
                                                </div>  
                                               
                                            </div>				
											
                                             

											
											<!--<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">User Alternate Email</label>
												<div class="col-md-6">
								<input class="form-control" name="userAlternateEmail"   value="<?php echo $userData['userAlternateEmail']; ?>" id="email" type="text"  />
												</div>
											</div>-->
											
											
										
						
						
											

					
					
		<!--<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">User Name<span class="required">*</span></label>
		<div class="col-md-6" >
			<input class="form-control" onFocus="geolocate()"  placeholder="Enter your address" name="address" value="<?php echo $userData['userName']; ?>" id="autocomplete" type="text" >
		</div>
	</div>-->
	
	
	  <!-- <div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Password<span class="required">*</span></label>
		<div class="col-md-6">
			<input class="form-control"   name="password" value=""  id="password"  type="password">
		
		</div>
	    </div>-->
	      <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Phone</label>
		<div class="col-md-6">
		<input class="form-control"   name="phone" value="" id="phone"  onblur="phonenumber();"type="text">	
        </div>
	     </div>
	    	
        <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Address</label>
		<div class="col-md-6">
		<input class="form-control"   name="address" value="" id="locality"  type="text">	
        </div>
	     </div>
	    
	   <!--  <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">City</label>
		<div class="col-md-6">
		<input class="form-control"   name="cityId" value="<?php echo $userData['c_name']; ?>" id="administrative_area_level_1"  type="text">	
		</div>
		</div>
	    
	      <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Location</label>
		<div class="col-md-6">
		<input class="form-control"   name="locationId" value="<?php echo $userData['l_name']; ?>" id="administrative_area_level_1"  type="text">	
		</div>
		</div>-->
		
		
									
	<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">City<span class="required">*</span></label>
												<div class="col-md-6">										
	<select class="form-control mb-md" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										}
											
									 ?>
                                    </select>
                                    </div>
											</div>
                                     <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
									<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Location<span class="required">*</span></label>
												<div class="col-md-6">										
	<select class="form-control mb-md" name="location" id="location" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
											
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
										}
											
										?>
                                    </select>
						
						
					
	
					
	
						
						
	
						
						
						
	
						
	
						
	
						
	
						
					
				
			
				
				
			
					</form>
			</div>
			</section>
		</div>
	</div>
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<button type="button" id="add_classifieds" class="btn btn-primary">Submit</button>
			</div>
		</div>
		</div>
	 <?php echo form_close();?>

			</div>
	
		</div>
	</div>
			</section>
		
	
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

</style>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
<script type="text/javascript">
	
      $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 
			
			if(stafftypevalidation() && firstNameValidation()  && lastNameValidation() && emailValidation() && imagevalidation() && passwordValidation() && cityValidation() && locationValidation()){
				
				$("#form").submit();
			}else{
				return false;
			}
			
		});
			});
		
		
		
			function readURL(input,i) {

    //alert("hi");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var loader = $('#loader'+i);
                
                reader.onload = function (e) {
                $('#AddFileInputBox').show();
               // $('#input').hide();
                $('#img').show();
                loader.css('opacity', '1'); 
                setTimeout(function(){
                    loader.css('opacity', '0'); 
                    $('#blah'+i)
                        .show()
                        .attr('src', e.target.result)
                        .width(165)
                        .height(180);
                    }, 4000);     
                };
                reader.readAsDataURL(input.files[0]);
                
            }
        }
        
        
     function get_location(value)
{
	//alert(js_site_url);
	//alert(value);

	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getlocationbycity", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#location").html(data.trim()); 
      } 
    });
}
  
        
      
  
        
         </script>
     
