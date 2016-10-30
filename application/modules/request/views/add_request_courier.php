<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
				
	</header>
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
			<h2 class="panel-title">REQUEST FOR COURIER SERVICE</h2>
			</div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
						<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/request/add_request_courier', $attributes); ?>
          <input type="hidden" name="courier_price" id="courier_price" value=""/>
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
												<label class="col-md-3 control-label" for="inputSuccess">Choice of courier<span class="required">*</span></label>
												<div class="col-md-6">
													<select name="courier_type" id="courier_type" class="form-control mb-md" onchange="priorityprice()">
														<option value="0">Select courier service</option>
													 <?php foreach($choice_courier as $key=>$value) {
											
											
												echo '<option value="'.$value['id'].'">'.$value['name'].'</option>'; 
											
										} ?>
														
													</select>
						
											
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Mode Of Delivery<span class="required">*</span></label>
												<div class="col-md-6">
													<select name="delivery_type" id="delivery_type" class="form-control mb-md" onchange="priorityprice()">
														<option value="0">Select mode of delivery</option>
													    <option value="Priority">Priority</option>
													    <option value="Normal">Normal</option>
														
													</select>
						
											
												</div>
											</div>
											<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Destination Address<span class="required">*</span></label>
		<div class="col-md-6" >
				 <textarea rows="4" id="autocomplete" cols="50" name="address" class="widht_text_area form-control"></textarea>
 
		</div>
	</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Description of package</label>
												<div class="col-md-6">
								 <textarea rows="4" cols="50" name="description" class="widht_text_area form-control">
 </textarea>
						
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
			if( cityValidation() && locationValidation() &&  courierValidation() && modevalidation() && classifiedsAddressValidation() && clientvalidation()){
				
				$("#form").submit();
				
			}else{
				return false;
			}
			
		});
			});
		
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
		function priorityprice(){
			var courier_type=$('#courier_type').val();
			var priority=$('#delivery_type').val();
			$.ajax({ 
		      method: "POST", 
		      url: js_site_url+"index.php/request/get_priority_price", 
		      data: { courier_type:courier_type,priority:priority }, 
		      async: false, 
		      success: function(data) { 
			  	$('#courier_price').val(data);
		      } 
		    });
		}
		
        
         </script>
     
