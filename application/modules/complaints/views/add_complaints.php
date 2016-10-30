<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
			<section role="main" class="content-body">
					<header class="page-header">
					<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
<!--
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Pages</span></li>
								
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
-->
					</header>

					<section class="panel">
						<header class="panel-body">
							<!--<div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
							</div>-->
						
							<h2 class="panel-title">Add New Complain</h2>
							
						</header>
						
					<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/complaints/add_complaints" enctype="multipart/form-data">
							<fieldset>
                                 <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Type <span class="required">*</span></label>
									<div class="col-md-8">
									<select name="type" id="type"   class="form-control">
                                    	<option value="0">Select Type</option>
                                        <option value="Feedback">Feedback</option>
                                        <option value="Query">Query</option>
                                        <option value="Complaint">Complaint</option>
                                    </select>
									</div>
								</div>	
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Subject <span class="required">*</span></label>
									<div class="col-md-8">
									<input type="text" name="subject" id="subject"
										   class="form-control" placeholder="">
									</div>
								</div>
                             	
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Message<span class="required">*</span></label>
									<div class="col-md-8">
										<textarea cols="180" rows="100" id="content" name="content" class=""></textarea>
										<script type="text/javascript">
											CKEDITOR.replace( 'content' );
										</script>
									</div>
								</div>
							</fieldset>

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Post</button>
								</div>
							</div>
							</div>
							</form>
				</section>
		
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 

<script>
	
	
	$(document).ready(function(e){
		
		
		
		$("#submit").click(function(e){
			
			var _subject = $("#subject").val();
		    var _type = $("#type").val();
			var messageLength = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
			
			if(_type=='0' ) {
            alert( 'Please Choose Type' );
            $("#type").css("border-color","red");
			$("#type").focus();
            e.preventDefault();
            }
			else if (_subject == "") {
				$("#subject").attr('placeholder','Please enter subject');
				$("#subject").css("border-color","red");
				$("#subject").focus();
				e.preventDefault();
			}
			
			else if( !messageLength ) {
            alert( 'Please Type your message' );
            e.preventDefault();
        }
			
		});
		
		});
		
		function change_page_category(value)
{
	//alert(js_site_url);
	//alert(value);

	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/cms/get_subcategories_forcategory", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#sub_page_category").html(data.trim()); 
      } 
    });
}
		
		function readURL(input,i) {

    //alert("hi");
            if (input.files && input.files[0]) {
				//alert("hi");
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

