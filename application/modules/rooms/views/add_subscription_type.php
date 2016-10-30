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
			
			</ol>
</div>
				
	</header>
		
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<header class="panel-heading">
										
										 <h2 class="panel-title">ADD SUBSCRIPTION</h2>
											 
									 
						<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/rooms/add_subscription_type', $attributes); ?>
          
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
												<label class="col-md-3 control-label" for="inputDefault">Name<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="name" onFocus="value=''"  id="name" type="text" />
												</div>
											</div>
											
											
								<div class="form-group">
												<label class="col-md-3 control-label" for="inputDefault">Price<span class="required">*</span></label>
												<div class="col-md-6">
								<input class="form-control" name="price" onFocus="value=''" onKeyUp="return valtxt(this)" id="price" type="text" />
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
<?php require_once(FCPATH.'assets/admin/lib/footer.php'); ?> 
<script type="text/javascript">
	
      $(document).ready(function(e){
		$("#submit").click(function(e){
			var _title = $("#name").val();
		    var _price = $("#price").val();
			//alert(_desc);
			if (_title == "") {
				$("#name").attr('placeholder','Please enter name');
				$("#name").css("border-color","red");
				$("#name").focus();
				e.preventDefault();
			}else if (_price==""){
                $("#price").attr('placeholder','Please enter price');
				$("#price").css("border-color","red");
				$("#price").focus();
				e.preventDefault();

			}else{
			form.submit();	
				
			}
		});
	});
		
		
			function valtxt(obj) 
       {
        str="0123456789-"
        l=obj.value.length;
        for(i=0;i<=l;i++)
        {
         if(str.indexOf(obj.value.charAt(i))==-1)
         {
          alert("Please enter valid price.");
          obj.value="";
          obj.focus();
          return false;
         }
        }
        return true;
       }
  
  
        
         </script>
     
