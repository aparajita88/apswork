<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

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
			<h2 class="panel-title">Request For Clock In Clock Out Support</h2>
			</div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
						<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/request/add_request_payroll', $attributes); ?>
           <select class="design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											
											if($userData['city_id']==$value['cityId']){
											echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select  class="design_select" name="location" id="location" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
											
												if($userData['location_id']==$value['locationId']){
											echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
										} 
											
										} ?>
                                    </select>
										<h2 class="panel-title"></h2>
									</header>
									<div class="panel-body">
										
											
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?> 
		<?php if($this->session->userdata("userTypeId")=='ut7' || $this->session->userdata("userTypeId")=='ut5'){?>
		<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Request Type<span class="required">*</span></label>
												<div class="col-md-6">
													<select name="client_id" id="client_id" class="form-control mb-md" onchange="ajxservice(this.value)">
														<option value="Courier Service" <?php echo(($this->uri->segment(2)=='add_request_courier')?"selected":"");?>>Courier Service</option>
														<option value="Office Boy" <?php echo(($this->uri->segment(2)=='add_request_officeboy')?"selected":"");?>>Office Boy</option>
														<option value="IT Support" <?php echo(($this->uri->segment(2)=='add_request_it')?"selected":"");?>>IT Support</option>
														<option value="Clock in Clock Out Support" <?php echo(($this->uri->segment(2)=='add_request_payroll')?"selected":"");?>>Clock in Clock Out Support</option>

														
													</select>
						
											
												</div>
											</div>
		                          <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Client name<span class="required">*</span></label>
												<div class="col-md-6">
													<select name="client_id" id="client_id" class="form-control mb-md">
														<option value="0">Select client name</option>
													<?php 
                            foreach($userlist as $value) {
                                if (isset($com_id) && $com_id == $value['company_id']."|++|".$value['userId']) {
                                    echo '<option value="'.$value['company_id']."|++|".$value['userId'].'" selected>'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
                                }else{
                                 echo '<option value="'.$value['company_id']."|++|".$value['userId'].'">'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
                                }
                            }
                          ?>
														
													</select>
						
											
												</div>
											</div>
											
									<?php }?>
											
											<div class="form-group">
												<label class="col-md-3 control-label">Date range<span class="required">*</span></label>
												<div class="col-md-6">
													<div class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" class="form-control" placeholder="Enter start Date" name="start_date" id="start">
														<span class="input-group-addon">to</span>
														<input type="text" class="form-control" placeholder="Enter end Date" name="end_date" id="end">
													</div>
												</div>
											</div>
						
											<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Details<span class="required">*</span></label>
		<div class="col-md-6" >
				 <textarea rows="4" id="autocomplete" cols="50" name="detailes" placeholder="Enter details" class="widht_text_area form-control"></textarea>
 
		</div>
	</div>
						</form>
			</div>
	
	
<div class="panel-footer">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<button type="button" id="add_classifieds" class="btn btn-primary">Place Request</button>
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
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	
     $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 
			//alert('1');
			if(cityValidation() && locationValidation()  && vendorName() && dateValidation() && classifiedsAddressValidation() && clientvalidation()){
			
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
  
      function ajxservice(value){
             if(value=="Courier Service"){
             	window.location.href = js_site_url+'index.php/request/add_request_courier';
             }
             if(value=="Office Boy"){
                window.location.href = js_site_url+'index.php/request/add_request_officeboy';
             }
             if(value=="IT Support"){
             	window.location.href = js_site_url+'index.php/request/add_request_it';
             }
             if(value=="Clock in Clock Out Support"){
             	window.location.href = js_site_url+'index.php/request/add_request_payroll';
             }
		}  
         </script>
     
