<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script src="<?php echo $this->config->item('base_url');?>assets/admin1/javascripts/giocoading.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLW_f1V4had-BIM6OnqZ7huUfOfXNfDog&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
		<div class="right-wrapper pull-right">
			
</div>
			
		
	</header>
	<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	<div class="row">
		
		<div class="col-lg-12">
								
								<section class="panel">	
									<div class="panel-body">
			<h2 class="panel-title">Edit Business Center</h2>
			</div>								
									<header class="panel-heading">
										
										 <?php 
										 $row = $business[0]; 
										 
										 ?>
											<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"form-horizontal form-bordered");
          echo  form_open_multipart("index.php/business/edit_business/".$row['business_id'], $attributes);?>
	       
		   						<select class="design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											if($value['cityId'] == $row['cityId'])
											{
												echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
											}
											else{
												echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>';
											}
											
										
											
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select class="design_select" name="location" id="location" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
												if($value['locationId'] == $row['locationId'])
											{
												echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
											}else{
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>';	
												
											}
										} ?>
                                    </select>
										</header>
									<div class="panel-body">
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>

		<!--<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Vendor Name</label>
												<div class="col-md-6">
													<select name="vendor_user_id" class="form-control mb-md">
														<option value="">Select Vendor</option>

												 <?php foreach($vendor as $key=>$value) {
									
											
												if($value['userId'] == $row['ownerId'])
									{
												//echo '<option value="'.$value['userId'].'" selected>'.$value['userEmail'].'</option>'; 
										}else{
											echo '<option value="'.$value['userId'].'">'.$value['userEmail'].'</option>';	
												
											}
											
										} ?>

										</select>
						
											
												</div>
											</div>-->

											<div class="form-group">
												<label  class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="businesss_name"   value="<?php echo $row['businessName']; ?>"onFocus="value=''" id="businesss_name" type="text"  />
												</div>
											</div>
											
											
												<div class="form-group">
                                                <label class="col-md-3 control-label">Icon Upload <span class="required">*</span>:</label>
                                                <div class="col-md-6">
                                                    <div id="AddFileInputBox" class="image_up">
<span class="loader" id="loader1"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" ></span>
<span class="avter"><img src="<?php echo base_url();?>assets/uploads/images/small/<?php echo $row['imageName']; ?>"class="preview" id="blah1"></span>
<a><i class="icon-camera"></i></a><br><input onchange="readURL(this,1);" type="file" name="ListeeTypeImage" id="ListeeTypeImage">
</div> <div id="msg" style="display:none;"  ></div>  
                                                </div> </div>	
						              <input type="hidden" name="image_id" value="<?php echo $row['id']; ?>" /> 																																																	
						<!---<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Type</label>
												<div class="col-md-6">
													<select name="businesss_type" class="form-control mb-md">
														<option value="1"  <?php if(isset ($row['business_type']) && $row['business_type']=='1'){echo 'selected="selected"';}?> >Start Up</option>
														<option value="2" <?php if(isset($row['business_type']) && $row['business_type']=='2'){echo 'selected="selected"';}?> >Small Business</option>
														<option value="3"<?php if(isset($row['business_type']) && $row['business_type']=='3'){echo 'selected="selected"';}?> >Large Company</option>
														<option value="4" <?php if(isset($row['business_type']) && $row['business_type']=='4'){echo 'selected="selected"';}?> >Remote Team</option>
														<option value="5"<?php if(isset($row['business_type']) && $row['business_type']=='5'){echo 'selected="selected"';}?> >Freelancer</option>
														<option value="6"<?php if(isset($row['business_type']) && $row['business_type']=='6'){echo 'selected="selected"';}?> >Service Provider</option>																												
													</select>										
												</div>
											</div>--->
						
											<!---<input type="hidden" id="latitude" name="latitude" value="<?php echo $row['latitude'];?>" >
											<input type="hidden" id="longitude" name="longitude" value="<?php echo $row['longitude'];?>">--->
											<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Address</label>
		<div class="col-md-6" >
			<input class="form-control"   placeholder="Enter address" value="<?php echo $row['address'];?>" name="address" id="autocomplete" type="text" >
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Latitude</label>
		<div class="col-md-6">
			<input class="form-control"   name="latitude" value="<?php echo $row['latitude'];?>"   type="text">
		</div>
	    </div>
	    
        <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Longitude</label>
		<div class="col-md-6">
		<input class="form-control"   name="longitude" value="<?php echo $row['longitude'];?>"   type="text">	
        </div>
	     </div>

						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Short description</label>
							<div class="col-md-6">
								<input class="form-control" name="shortDescription" value="<?php echo $row['shortDescription'];?>" id="short_description" type="text">
							</div>
						</div>						
				
		<div class="row">
		<div class="col-xs-12">
			<section class="panel">

				<div class="panel-body">
					<form class="form-horizontal form-bordered">
						<div class="form-group">
							<label class="col-md-3 control-label">Long description</label>
							<div class="col-md-9">
								<!---<div class="summernote"  name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>Start typing...</div>---->
						<div class="summernote">	<textarea class="summernote" id="summernote" name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'><?php echo $row['longDescription'];?> </textarea></div>
					
							
							
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
			</section>
		
	
		</div>
	
	
<div class="panel-footer">
		<div class="row">
			<div class="col-md-9 col-md-offset-3">
				<button type="button" id="add_businesss" class="btn btn-primary">Submit</button>
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

</style>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
<script type="text/javascript">
	
$(document).ready(function()
{
      $("#add_businesss").click(function()
		{			
			if(cityValidation() && locationValidation() && classifiedsNameValidation()){
				// $("#businesss_name").removeAttr('disabled');
				$("#form").submit();
			}else{
				return false;
			}
			
		});
});
		
		
		
function readURL(input,i)
{

    //alert("hi");
            if (input.files && input.files[0])
			{
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
     
