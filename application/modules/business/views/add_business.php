<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
		<div class="right-wrapper pull-right"></div>	
	</header>
	<section class="panel">
		<?php if($this->session->flashdata('item')){ ?>
		<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
		<?php } ?>
		<?php if($this->session->flashdata('item_error')){ ?>
		<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
        <?php } ?>
		<div class="panel-body"><h2 class="panel-title">ADD BUSINESS</h2></div>	
        <header class="panel-heading">
			<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          	echo  form_open_multipart('index.php/business/add_business', $attributes); ?>
           	<select class="design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
            	<option value="0">Select City</option>
                <?php foreach($cities as $key=>$value) {
					
					
					echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
					
				} ?>
            </select> 
            <div id="error" style="display:none"  ></div>
		 	<select  class="design_select" name="location" id="location" onclick="removeValidateHtml('location')">
            	<option value="0">Select Location</option>
                <?php foreach($city as $key=>$value) {
					
					
						echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
				} ?>
            </select>
			<h2 class="panel-title"></h2>
		</header>				
		<div class="panel-body panel_body_top">              
       <?php if($this->session->flashdata('edit')){ ?>
			<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
		<?php } ?>
		<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
			<div class="form-group">
				<label class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
				<div class="col-md-6">
					<input class="form-control" name="business_name" onFocus="value=''" placeholder="Enter Name" id="classifieds_name" type="text" />
				</div>
			</div>
			<div class="form-group">
                <label class="col-md-3 control-label">Icon Upload <span class="required">*</span>:</label>
                <div class="col-md-6">
                    <div id="AddFileInputBox" class="image_up">
						<span class="loader" id="loader1"  style="opacity: 0;">
							<img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" >
						</span>
						<span class="avter">
							<img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/icon1inoimages.jpg" class="preview" id="blah1">
						</span>
						<a><i class="icon-camera"></i></a><br><input onchange="readURL(this,1);" type="file" name="ListeeTypeImage" id="ListeeTypeImage">
					</div> 
					<div id="msg" style="display:none;"></div>  
                </div>  
            </div>				
			<div class="form-group">
				<label class="col-md-3 control-label" for="inputDefault">Address</label>
				<div class="col-md-6" >
					<input class="form-control"   placeholder="Enter address" onFocus="value=''" name="address" id="autocomplete" type="text" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="inputDefault">Latitude</label>
				<div class="col-md-6">
					<input class="form-control"   name="latitude"   type="text">
				</div>
    		</div>
	        <div class="form-group">
				<label class="col-md-3 control-label" for="inputSuccess">Longitude</label>
				<div class="col-md-6">
					<input class="form-control"   name="longitude"   type="text">	
	        	</div>
		     </div>
			<div class="form-group">
				<label class="col-md-3 control-label" for="inputDefault">Short description</label>
				<div class="col-md-6">
					<input class="form-control" name="shortDescription" id="short_description" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Long description</label>
				<div class="col-md-9">
					<div class="summernote">
						<textarea class="summernote" id="summernote" name="desc" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'></textarea>
					</div>
				</div>
			</div>				
	</section>
	<div class="panel-footer">
		<div class="row">
			<div class="col-md-9 col-md-offset-3">
				<button type="button" id="add_classifieds" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
	 <?php echo form_close();?>
<div class="clearfix"></div>
<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 
</section>
<style>
.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
.redmessage{border:1px solid #f00;color:#f00;}
.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
.redmessage::-moz-placeholder {color: #FF0000;}
.redmessage::-webkit-input-placeholder {color: #FF0000;}
</style>
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
<script type="text/javascript">
$(document).ready(function() {
	$("#add_classifieds").click(function(){
	if(cityValidation() && locationValidation() && classifiedsNameValidation() && imagevalidation()  ){
		$("#form").submit();
	}else{
		return false;
	}
	});
});
function readURL(input,i) {
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
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getlocationbycity", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
        $("#location").html(data.trim()); 
      } 
    });
}       
</script>
