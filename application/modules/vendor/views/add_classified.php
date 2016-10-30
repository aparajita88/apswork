<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
 <!--<script src="<?php echo $this->config->item('base_url');?>assets/admin1/javascripts/giocoading.js"></script>-->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLW_f1V4had-BIM6OnqZ7huUfOfXNfDog&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
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
				<li><span>Dashboard</span></li>-->
			</ol>
</div>
			<!--<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
		
	</header>
	<div class="row">
		
		
		
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
										<div class="panel-actions">
											 
										</div>
						
										<h2 class="panel-title">OFFICE SPACES</h2>
									</div>
									<div class="panel-body panel_body_top">
										
											<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
           echo  form_open_multipart('index.php/vendor/add_classified', $attributes);?>
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="classifieds_name" onFocus="value=''" id="classifieds_name" type="text" />
												</div>
											</div>
											
											
								<div class="form-group">
                                                <label class="col-md-3 control-label">Icon Upload <span class="required">*</span>:</label>
                                                <div class="col-md-6">
                                                    <div id="AddFileInputBox" class="image_up">
<span class="loader" id="loader1"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" ></span>
<span class="avter"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/avatar.png" class="preview" id="blah1"></span>
<a><i class="icon-camera"></i></a><br><input onchange="readURL(this,1);" type="file" name="ListeeTypeImage" id="ListeeTypeImage">
</div> <div id="msg" style="display:none;"  ></div>  
                                                </div>  
                                               
                                            </div>			
											
											
											
					
						
											<input type="hidden" id="latitude" name="latitude" >
											<input type="hidden" id="longitude" name="longitude" >
											

					
					
		<!---<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Address<span class="required">*</span></label>
		<div class="col-md-6" >
			<input class="form-control" onFocus="geolocate()"  placeholder="Enter your address" name="address" id="autocomplete" type="text" >
		</div>
	</div>--->
	
	<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Address 1<span class="required">*</span></label>
		<div class="col-md-6" >
			<input class="form-control"   placeholder="Enter your address" name="address"  type="text" >
		</div>
	</div>
	   <div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Address 2</label>
		<div class="col-md-6">
			<input class="form-control"   name="street_address" id="street_number" type="text">
		</div>
	    </div>
	    
        <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">city</label>
		<div class="col-md-6">
		<input class="form-control"   name="city" id="locality"  type="text">	
        </div>
	     </div>
	     
		<div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">State</label>
		<div class="col-md-6">
		<input class="form-control"   name="state" id="administrative_area_level_1"  type="text">	
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Zip code</label>
		<div class="col-md-6">
		<input class="form-control"   name="zip" id="postal_code"  type="text">	
		</div>
		</div>
		
        <div class="form-group">
		<label class="col-md-3 control-label" for="inputSuccess">Country</label>
		<div class="col-md-6">
		<input class="form-control"   name="country" id="country" value="India"  type="text">	
		</div>
		</div>
											
											
	
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Min Price</label>
							<div class="col-md-6">
								<input class="form-control" name="minPrice" id="min_price" type="text">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Max Price</label>
							<div class="col-md-6">
								<input class="form-control" name="maxPrice" id="max_price" type="text">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Short description</label>
							<div class="col-md-6">
								<input class="form-control" name="shortDescription" id="short_description" type="text">
							</div>
						</div>
	
						
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputPassword">available days</label>
							<div class="col-md-6">
								<input class="form-control" placeholder="" name="days" id="days" type="text" >
							</div>
						</div>
	
					
	
						
						
	
						
						
						
	
						
	
						
	
						
	
						
					
				
				</div>
				
				<div class="row">
		<div class="col-xs-12">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						
					</div>
	
					<h2 class="panel-title"></h2>
				</header>
				<div class="panel-body">
					<form class="form-horizontal form-bordered">
						<div class="form-group">
							<label class="col-md-3 control-label">Long description</label>
							<div class="col-md-9">
								<!---<div class="summernote"  name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>Start typing...</div>---->
						<div class="summernote"><textarea class="summernote" id="summernote" name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea></div>
					
							
							
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
				<button type="button" id="add_classifieds" class="btn btn-primary">Submit</button>
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
	
      $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 
			
			if( classifiedsNameValidation() && imagevalidation() && classifiedsAddressValidation() ){
				
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
        
        
     
  
        
         </script>
     
