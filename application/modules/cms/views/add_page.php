<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
			<section role="main" class="content-body">
					<header class="page-header">
						<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					</header>

					<section class="panel">
						<div class="panel-body">
							
							<h2 class="panel-title">Add New Page</h2>
							
						</div>
						
					<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/cms/add_page" enctype="multipart/form-data">
							<fieldset>
                                <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Page Category <span class="required">*</span></label>
									<div class="col-md-8">
									<select name="category" id="category" onchange="change_page_category(this.value)"  class="form-control">
                                    	<option value="0">Select page category</option>
                                        <?php foreach($categories as $key=>$value) {
											echo '<option value="'.$value['pageCategoryId'].'">'.$value['pageCategoryName'].'</option>'; 
										} ?>
                                    </select>
									</div>
								</div>	
								 <div class="form-group">
									<label class="col-md-3 control-label" for="sub_page_category">Page Sub Category<br/> (This option is only for home page.)</label>
									<div class="col-md-8">
									<select name="sub_page_category" id="sub_page_category" class="form-control">
                                    	<option value="0">Select sub Page category</option>
                                    </select>
									</div>
								</div>	
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Page Title <span class="required">*</span></label>
									<div class="col-md-8">
									<input type="text" name="name" id="name"
										   class="form-control" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="slogan">Page Slogan <!-- <span class="required">*</span> --></label>
									<div class="col-md-8">
									<input type="text" name="slogan" id="slogan"
										   class="form-control" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="metaKeys">Meta Keywords </label>
									<div class="col-md-8">
									<input type="text" name="metaKeys" id="metaKeys"
										   class="form-control" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="metaDesc">Meta Description </label>
									<div class="col-md-8">
									<input type="text" name="metaDesc" id="metaDesc"
										   class="form-control" placeholder="">
									</div>
								</div>
                              <div class="form-group">
                                	<label class="col-md-3 control-label">Featured Image :</label>
                                    <div class="col-md-6">
                                    	<div id="AddFileInputBox" class="image_up">
											<span class="loader" id="loader1"  style="opacity: 0;">
												<img src="<?php echo $this->config->item('base_url');?>assets/front/images/load.gif" border="0" >
											</span>
											<span class="avter">
												<img src="<?php echo $this->config->item('base_url');?>assets/front/images/noimages.jpg" class="preview" id="blah1">
											</span>
											<a><i class="icon-camera"></i></a><br>
											<input onchange="readURL(this,1);" type="file" name="pageImage" id="pageImage">
										</div> <div id="msg" style="display:none;"  ></div>  
                                    </div>  
                              </div>
                                <div class="form-group i_am_a" style="display: none;">
                                    <label class="col-md-3 control-label">Page Header Image :</label>
                                    <div class="col-md-6">
                                        <span class="loader" id="loader"  style="opacity: 0;">
											<img src="<?php echo $this->config->item('base_url');?>assets/front/images/load.gif" border="0" >
										</span>
										<span class="avter">
											<img src="<?php echo $this->config->item('base_url');?>assets/front/images/noimages.jpg" class="preview" id="preview">
										</span>
										<input onchange="readHeaderImgURL(this);" type="file" name="pageHeaderImage" id="pageHeaderImage">
                                     </div>  
                                </div>		
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Content<span class="required">*</span></label>
									<div class="col-md-8">
										<textarea cols="180" rows="100" id="content" name="content" class=""></textarea>
										<script type="text/javascript">
											CKEDITOR.replace( 'content',{
											    filebrowserBrowseUrl : js_site_url+'index.php/cms/browse?type=Images&dir=' + encodeURIComponent('cms_image'),
											        filebrowserUploadUrl : js_site_url+'index.php/cms/cmsimage_upload'
											    
											} );
										</script>
									</div>
								</div>
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Submit</button>
								</div>
							</div>
							</div>
							</form>
				</section>			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>	
$(document).ready(function(e){
	$("#submit").click(function(e){
		var _category = $("#category").val();
		var _title = $("#name").val();
		 var messageLength = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
		if (_category == "0") {
			$("#category").css("border-color","red");
			$("#category").focus();
			e.preventDefault();
		}
		 if (_title == "") {
			$("#name").attr('placeholder','Please enter page title');
			$("#name").css("border-color","red");
			$("#name").focus();
			e.preventDefault();
		}
		 if( !messageLength ) {
	    	alert( 'Please enter a description' );
	    	return false;
	}	
	});	
	$(document).on('change','#sub_page_category',function(){
		var i_am_a = $(this).val();
        if(i_am_a == 'd71b61a9-aa73-db'){
        	$('.i_am_a').css('display','block');
        }else{
        	$('.i_am_a').css('display','none');
        }
	});
});		
function change_page_category(value)
{
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/cms/get_subcategories_forcategory", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
        $("#sub_page_category").html(data.trim()); 
        var i_am_a = $('#sub_page_category').val();
        if(i_am_a == 'd71b61a9-aa73-db'){
        	$('.i_am_a').css('display','block');
        }else{
        	$('.i_am_a').css('display','none');
        }
      } 
    });
}
		
function readURL(input,i) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var loader = $('#loader'+i);
        
        reader.onload = function (e) {
        $('#AddFileInputBox').show();
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
function readHeaderImgURL(input){
	if (input.files && input.files[0]) {
        var reader = new FileReader();
        var loader = $('#loader');
        reader.onload = function (e) {
        loader.css('opacity', '1'); 
        setTimeout(function(){
            loader.css('opacity', '0'); 
            $('#preview')
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

