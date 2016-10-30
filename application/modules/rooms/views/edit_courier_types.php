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
		
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<header class="panel-heading">
										
										 <h2 class="panel-title">EDIT COURIER TYPE</h2>
											 
									 
						<?php 
										$row=$courier_types[0];
										
										// $attributes = array( 'method'=>'post','name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          // echo  form_open_multipart('index.php/rooms/edit_game_room/'.$row['game_id'], $attributes);?>
		  <form action="<?php echo base_url();?>index.php/rooms/edit_courier_types/<?php echo $row['id'];?>" method="post" enctype="multipart/form-data" name="form" id="form" class="orm-horizontal form-bordered" >
						
                                    
                                   
										<h2 class="panel-title"></h2>
									</header>
									<div class="panel-body  panel_body_top" style="margin-top:15px; border-radius:0px;">
										
											
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?> 
		
		
								<!----<div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Vendor Name</label>
												<div class="col-md-6">
													<select name="vendor_user_id" class="form-control mb-md">
														<option value="">Select Vendor</option>
													 <?php foreach($vendor as $key=>$value) {
											
											
													if($value['userId'] == $row['ownerId'])
											{
												echo '<option value="'.$value['userId'].'" selected>'.$value['userEmail'].'</option>'; 
											}else{
											echo '<option value="'.$value['userId'].'">'.$value['userEmail'].'</option>';	
												
											}
											
										} ?>
														
													</select>
						
											
												</div>
											</div>--->
															
								
							
							
							<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Name*</label>
							<div class="col-md-6">
								<input class="form-control" name="name" value="<?php echo $row['name'];?>"  id="name" type="text">
							</div>
						    </div>
							
						
						
	
						
						
						
	
						
					
					</form>
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
		
			//alert(_desc);
			if (_title == "") {
				$("#name").attr('placeholder','Please enter name');
				$("#name").css("border-color","red");
				$("#name").focus();
				e.preventDefault();
			}else{
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
     
