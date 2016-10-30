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
				
	</header>
		
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<header class="panel-heading">
										
										 <h2 class="panel-title">EDIT CAFE TYPE</h2>
											 
									 
						<?php 
										$row=$cafe_types[0];
										//print_r($cafe_types[0]);
										?>
		  <form action="<?php echo base_url();?>index.php/rooms/edit_cafe_types/<?php echo $row['id'];?>" method="post" enctype="multipart/form-data" name="form" id="form" class="orm-horizontal form-bordered" >
						
                                    
                                   
										<h2 class="panel-title"></h2>
									</header>
									<div class="panel-body  panel_body_top" style="margin-top:15px; border-radius:0px;">
										
											
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?> 
		
									
		<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Cafe Category<span class="required">*</span></label>
												<div class="col-md-6">
													<select name="cafe_id" id="cafe_id" class="form-control mb-md">
														<option value="0">Select Category</option>
												<?php			if($row['parent_id']=='')
											{
												echo '<option value="1" selected>Main Category</option>'; 
											}
													else{
														echo '<option value="1">Main Category</option>'; 
														 foreach($cafe_type as $key=>$value) {
											
											
											
												 if($value['id'] == $row['parent_id'])
											{
												echo '<option value="'.$value['id'].'" selected>'.$value['name'].'('.$value['c_name'].')</option>'; 
											}
											
											
										} }?>
														
													</select>
						
											
												</div>
											</div>
		<?php if($row['city_id']!=''){ ?>
	<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">City<span class="required">*</span></label>
												<div class="col-md-6">										
	<select class="form-control mb-md" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											if($row['city_id']==$value['cityId']){
											echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select>
                                    </div>
											</div><?php } if($row['location_id']!=''){?>
                                   
									<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Location<span class="required">*</span></label>
												<div class="col-md-6">										
	<select class="form-control mb-md" name="location" id="location" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
											
												if($row['location_id']==$value['locationId']){
											echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select>
						
						</div>
			</div>
									<?php }?>
							<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control" name="name" value="<?php echo $row['name'];?>"  id="name" type="text">
							</div>
						    </div>
							
						<input type="hidden" name="hid_cafe_img" value="<?php echo $row['image'];?>"/>
						<?php if($row['price']!=''){ ?>
	
						<div class="form-group" id="price" >
												<label class="col-md-3 control-label" for="inputDefault">Price<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="price" value="<?php echo $row['price'];?>"  id="price1" type="text" />
												</div>
											</div><?php }?>
						
						<div class="form-group" id="cafe_image">
												<label class="col-md-3 control-label" for="inputDefault">Upload image<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="cafe_image" id="cafe_img" type="file"/>
								<?php if($row['image']<>''){?></br>
								<img src="<?php echo base_url();?>assets/uploads/images/cafe_image/<?php echo $row['image'];?>" width="100" hight="100" alt="cafe_image"/>
								<?php }?>
												</div>
											</div>	
	
						
					
					
				</div>
		
		<div class="panel-footer">
		<div class="row">
			<div class="col-md-9 col-md-offset-3">
					<button type="submit" class="btn btn-primary"  id="submit">Submit</button>
			</div>
		</div>
		</div>
	 </form>

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
	
 
     $(document).ready(function(e){
		$("#submit").click(function(e){
			var _title = $("#name").val();
			var _cat = $("#cafe_id").val();
		
			//alert(_cat);
			//exit;
			 if(_cat=="0"){
				$("#cafe_id").attr('placeholder','Please choose category');
				$("#cafe_id").css("border-color","red");
				$("#cafe_id").focus();
				e.preventDefault();
				
				}
			else  if (_title == "") {
				$("#name").attr('placeholder','Please enter name');
				$("#name").css("border-color","red");
				$("#name").focus();
				e.preventDefault();
			}
			else 
			{
			form.submit();	
				
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
        
     
