<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			<!----<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>--->
			</ol>
</div>
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	<div class="row">
		
		
		
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
			<h2 class="panel-title">Add Meeting Room</h2>
			</div>
			<br>
									<header class="panel-heading">
										<div class="panel-actions">
											 
										</div>
		<form action="<?php echo base_url();?>index.php/rooms/add_meeting" method="post" enctype="multipart/form-data" name="form" id="form" class="orm-horizontal form-bordered">								
										<?php // $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
         //  echo  form_open_multipart('index.php/rooms/add_meeting', $attributes);?>
						<select class="design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
											
										} ?>
                                    </select>
						<div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2> -->
										 <select  class="design_select" name="location" id="location" onchange="get_business(this.value)" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php  foreach($city as $key=>$value) {
											
											
												echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
											
										} ?>
                                    </select>
									<select  class="design_select" name="business" id="business" >
                                    	<option value="0">Select Business</option>
                                   
                                    </select>	
                                   
									</header>
									<div class="panel-body">						
									
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>				<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control" name="name" id="classifieds_name"  onFocus="value=''" type="text">
							</div>
						</div>						
											
								<div class="form-group">
                                                <label class="col-md-3 control-label">Icon Upload <span class="required">*</span>:</label>
                                                <div class="col-md-6">
                                                    <div id="AddFileInputBox" class="image_up">
<span class="loader" id="loader1"  style="opacity: 0;"><img  src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" ></span>
<span class="avter"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/icon1inoimages.jpg" class="preview" id="blah1"></span>
<a><i class="icon-camera"></i></a><br><input onchange="readURL(this,1);" type="file" name="ListeeTypeImage" id="ListeeTypeImage">
<div id="img"></div>
</div> <div id="msg" style="display:none;"  ></div>  
                                                </div>  
                                               
                                            </div>			
						
											<div class="form-group">
												<label class="col-md-3 control-label">Start Time<span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input type="text" id="start_time"  name="start_time" data-plugin-timepicker class="form-control" data-plugin-options='{"showMeridian": false}'>
													</div>
												</div>
											</div>					

						<div class="form-group">
												<label class="col-md-3 control-label">End Time<span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</span>
														<input type="text" id="end_time" name="end_time" data-plugin-timepicker class="form-control" data-plugin-options='{  "showMeridian": false }'>
													</div>
													<div id="timavalidate" style="display:none"></div>
												</div>
											</div>	
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">PRICE (HOURLY)<span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control" name="price" id="price"   type="text">
							</div>
						</div>
						
						<!---<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Time Slot<span class="required">*</span></label>
							<div class="col-md-6">
								<input class="form-control" name="time_slot" id="time_slot"  onFocus="value=''" type="text">
							</div>
						</div>		--->
						<input type="hidden" name="time_slot" value="1" id="time_slot">			
						<div class="form-group">
							<label class="col-md-3 control-label">Description</label>
							<div class="col-md-9">
								<!---<div class="summernote"  name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>Start typing...</div>---->
						<div class="summernote"><textarea class="summernote" id="summernote" name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea></div>						
							<div id="wsummer"></div>
							</div>
							
						</div>
					</form>
				</div>
		
		<div class="panel-footer">
		<div class="row">
			<div class="col-md-9 col-md-offset-3">
				<input name="sub" type="submit" id="add_classifieds" class="btn btn-primary" value="Submit" />
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
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	
 $(document).ready(function()
 {
      $("#add_classifieds").click(function(){
		
		// var city = $("#city").val();
			//var location = $("#location").val();
			//var min = $("#min_price").val();
			//var max = $("#max_price").val();
			if(cityValidation() && locationValidation() && businessValidation() && classifiedsNameValidation() && imagevalidation() && timeValidation() )//&& NumberValidation())
			{								
				//if (min!="" && max!="")
				//{
					 //if(priceValidation(min,max))
					 //{
						//$("#form").submit();
					 //}
					 //else
					  //return false;
				//}
				//else
				 $("#form").submit();
			}
			

			
		});
 });
		
		
		
		
		function readURL(input,i)
		{

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

function get_business(value)
{
	//alert(js_site_url);
	//alert(value);
 var city = $("#city").val();
 
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getBusinessByLocation", 
      data: { id:value,city:city, }, 
      async: false, 
      success: function(data) { 
	 // alert(data);
	  	
        $("#business").html(data.trim()); 
      } 
    });
}
        
</script>
     
 
