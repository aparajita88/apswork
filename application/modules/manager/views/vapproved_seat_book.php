<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>.table  td { vertical-align:middle !important;}</style>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
			
		<section role="main" class="content-body">
					<header class="page-header">
					<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
						
					</header>

					<section class="panel">
							<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
						<div class="panel-body">
							
						
							<h2 class="panel-title">Client Registration</h2>
							
						</div>
						
					<div class="panel-body panel_body_top">
                    	
							<form  name="frmapprovedseatbook" id="frmapprovedseatbook" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/manager/approvedseatbook" enctype="multipart/form-data">
							 
                                 		
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Company Name <span class="required">*</span></label>
									<div class="col-md-8">
									<input type="text" name="compName" id="compName"
										   class="form-control" placeholder="Company Name" required>
									</div>
								</div>
										
									
	<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">City<span class="required">*</span></label>
												<div class="col-md-8">										
	<select class="form-control " name="city" id="city" onchange="get_location(this.value)"
	 onclick="removeValidateHtml('city')" required>
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											if($userData['city_id']==$value['cityId']){
											echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select>
                                    </div>
											</div>
                                     <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
									<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Location<span class="required">*</span></label>
												<div class="col-md-8">										
	<select class="form-control mb-md" name="location" id="location" onclick="removeValidateHtml('location')" required>
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
											
												if($userData['location_id']==$value['locationId']){
											echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select>
			</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName" >Company Address <span class="required">*</span></label>
									<div class="col-md-8">
									<textarea name="compAdd" id="compAdd"
										   class="form-control" placeholder="" rows="2" cols="50"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName"><strong>Users Information</strong></label>
								</div>
								<input type="hidden" name="theValue" value="1" id="theValue"/>
								<input type="hidden" name="seatrequestid" id="seatrequestid" value="<?php echo $seatrequestid;?>"/>
 
                                <div class="clearfix"></div>
                                	<div class="table-responsive">
                                        <table style="width:100%;" id="tab1" class="table mb-none">
                                            <tr>
                                                <th width="10%" style="padding-left:20px">First Name<span class="required">*</span></th>
                                                <th width="10%" style="padding-left:20px">Last Name<span class="required">*</span></th>
                                                <th width="10%" style="padding-left:20px">Email ID<span class="required">*</span></th>
                                                <th width="10%" style="padding-left:20px">Photo</th>
                                                <th width="10%" style="padding-left:20px">View Bill</th>
                                                <th width="6%" style="padding-left:20px"></th>
                                            </tr>
                                            <tr id="tr1">
                                            <td valign="middle"><input type="text" name="FirstName[]" style="width:120px;" class="form-control" placeholder="First Name" required></td>
                                            <td valign="middle"><input type="text" name="LastName[]" style="width:120px;" class="form-control"  placeholder="Last Name" required></td>
                                            <td valign="middle"><input type="email" name="userEmail[]" style="width:180px;"  class="form-control" placeholder="Email Id" required onblur="fnchkeml(this.value,1)"><span id="spemlchk1"></span></td>
                                            <td><figure class="profile-picture"> <div id="AddFileInputBox" class="image_up">
    <span class="loader" id="loader1"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" ></span>
    <span class="avter"><img src="<?php echo base_url();?>assets/front/images/no.png" width="60" class="preview" id="blah1"></span>
    <a><i class="icon-camera"></i></a><br><input onchange="readURL(this,1);" type="file" name="ListeeTypeImage1" id="ListeeTypeImage" style="width:80px;margin-left: 67px;
    margin-top: 5px;" >
    </div> <div id="msg" style="display:none;"  ></div></figure>  </td>
                                            <td><div style="width: 100px; text-align: center;">
                                            <input style="width:auto !important;display:inline;"type="checkbox" name="view_bill1" id="view_bill1" class="form-control" value="1"></div></td>
                                           <td valign="middle"> <div class="form-group">
											
												<div >
													
							<a href="javascript:;" onclick="addEvent();" class="btn btn-primary"><i class="fa fa-plus"></i></a>
													
												</div>
						                      </div></td>
                                            </tr>
                                            
                                        </table>
                                    </div>
					 			<div class="clearfix"></div>
								
																
											
							 

							
							</div>
                            <div class="panel-footer" style="margin:25px 0;">
                                <div class="row">
                                    <div class="form-group">
                                    <label class="col-md-1 control-label" style=" margin-top: 5px;">Price<span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <div class=" ">
                                                <input type="text" class="form-control" name="price" id="price" placeholder="Price" required>
                                            </div>
                                        </div>
                                      </div>
                                </div>
							</div>
                            
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9  ">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Submit</button>
								</div>
							</div>
							</div>
							</form>
                            
                   </div>   
                   
                    
                   
                         
				</section>
			
	
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer3.php'); ?> 

<script>
	function addEvent(){
		document.getElementById('theValue').value=parseInt(document.getElementById('theValue').value)+1;
		var thevalue=document.getElementById('theValue').value;
		if(thevalue<=10){
		$('#tab1').append('<tr id="tr'+thevalue+'"><td><input type="text" name="FirstName[]" id="FirstName[]" class="form-control" required style="width:120px;" placeholder="First Name"></td><td><input type="text" name="LastName[]" class="form-control" required style="width:120px;" placeholder="Last Name"></td><td><input type="email" name="userEmail[]" required style="width:180px;" placeholder="Email Id"class="form-control" onblur="fnchkeml(this.value,'+thevalue+')"><span id="spemlchk'+thevalue+'"></span></td><td> <div id="AddFileInputBox'+thevalue+'" class="image_up"><span class="loader" id="loader'+thevalue+'"  style="opacity: 0;"><img src="<?php echo $this->config->item('base_url');?>assets/admin1/images/download.png" border="0" ></span><span class="avter"><img src="<?php echo base_url();?>assets/front/images/no.png" width="60" class="preview" id="blah'+thevalue+'"></span><a><i class="icon-camera"></i></a><br><input onchange="readURL(this,\''+thevalue+'\');" type="file" style="width:80px;margin-left: 67px;margin-top: 5px;"  name="ListeeTypeImage'+thevalue+'" id="ListeeTypeImage'+thevalue+'"></div> <div id="msg'+thevalue+'" style="display:none;"  ></div>  </td><td><input type="checkbox" name="view_bill'+thevalue+'" id="view_bill'+thevalue+'" style="width:100px;" value="1"></td><td><a class="btn btn-primary" href=\"javascript:;\" onclick=\"removeElement(\'tr'+thevalue+'\')\"><i class="fa fa-times"></i></a></br></td></tr>');
	}
	
	}
	function removeElement(thevalue) {
	//	alert(thevalue);
  
    $('#'+thevalue).remove(); 
 // var olddiv = document.getElementById(divNum);
  //d.removeChild(olddiv);
}
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
                        .width(74)
                        //.height(180);
                    }, 4000);     
                };
                reader.readAsDataURL(input.files[0]);
                
            }
        }
        function fnchkeml(val,theval){
			$.ajax
    ({ 
        url: '<?php echo base_url();?>index.php/manager/get_chk_eml',
        data: "eml="+val,
        type: 'post',
        success: function(result)
        {
			$('#spemlchk'+theval).html(result);
        }
    });
		}
		    
     function get_location(value)
{
	//alert(js_site_url);
	//alert(value);

	$.ajax({ 
      type: "POST", 
      url: js_site_url+"index.php/rooms/getlocationbycity", 
      data: {id:value}, 
      async: false, 
      success: function(data) { 
	  //	alert(data);
	  	
        $("#location").html(data.trim()); 
      } 
    });
}
</script>
<style>
#tab1 tr:nth-child(2n) td { background:#F5F5F5 ;}
</style>
