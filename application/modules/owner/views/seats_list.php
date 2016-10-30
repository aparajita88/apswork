<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
	                                                                                                                              
		
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;   height: 36px;}
		</style>
	</header>
	
							
<body>
<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
		<section class="panel">
						
						<div class="panel-body">
			<h2 class="panel-title">Rooms</h2>
			</div>	<header class="panel-heading">
				
								<select class="design_select" name="city" id="city"  onchange="get_location(this.value)" >
                                    	<option value="">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											if($value['cityId']=='cfd849d5-ec69-2d'){
											echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											
										echo '<option value="'.$value['cityId'].'" >'.$value['name'].'</option>'; 	
										}
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select  class="design_select" name="location" id="location" onchange="get_business(this.value)" onclick="removeValidateHtml('location')">
                                    	<option value="">Select Location</option>
                                        <?php foreach($city as $key=>$value) {
											
											
												echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
											
										} ?>
                                    </select>
                                     <select  class="design_select" name="location" id="request">
                                    	<option value="">Select Business Center</option>
                                       
                                       
                                    </select>
                                     <button type="submit" class="btn btn-primary" onClick="get_result();" id="submit">Search</button>
								<div class="panel-actions">
									
									<!--<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>-->
								</div>
								<!---<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>--->
						
								<h2 class="panel-title"></h2>
							</header>
							<div class="panel-body">
								<?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
			<?php } ?>

			<div id="table_result_ajax" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<!--<thead>
										<tr>
										
											<th al>Total Clients <?php   echo $total_client; ?>  </th>
											
											
											
										</tr>
									</thead>
									



								
		                   <tr>
                        
                           <td id="result">    <?php   echo $total_client; ?>         </td>
                      
             
 
 
 
                           
                           </tr>
                            
                           -->
                   Total Rooms:   <label id="result"> <?php   echo $total_seats; ?></label>  	
				        </table>
							</div>	

							</div>
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
#table_result_ajax { font-size:16px; color:#000;}
 
#table_result_ajax label { margin-left:20px;}
</style>							
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">	
 $(document).ready(function() {
		// alert('1');
		 value='cfd849d5-ec69-2d';
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
});
function get_result(){
	var location_id=$("#location").val();
	var city_id=$("#city").val();
	var business_id=$("#request").val();
	//alert(location_id);
	//alert(city_id);
	//alert(business_id);
	if(location_id!='' || city_id!='' || business_id!='' ){
		//alert('1')
$.ajax({ 
      method: "POST", 
      url: "<?php echo base_url();?>index.php/owner/get_result_seats", 
      data: {location_id:location_id,city_id:city_id,business_id:business_id }, 
      async: false, 
      success: function(data) { 
	 // alert(data);	
	  	
        $("#result").html(); 
        $("#result").html(data.trim()); 
      } 
    });	
	
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
      url: js_site_url+"index.php/client/getBusinessByLocation/"+value+"/"+city, 
     // data: { id:value,city:city, }, 
      async: true, 
      success: function(data) { 
	  //alert(data);
	  	
        $("#request").html(data.trim()); 
       
       //  $("#locker").html(data.trim());
         
	
      } 
    });
}  				
</script>
