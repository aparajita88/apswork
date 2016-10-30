<?php  require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<body>
<section class="login_section">
	<div class="container">
        <div class="card card-container for_sign_up_card card_card_new">
        <?= (isset($message) && $message != '') ? $message : '';?>
          <?php  $attributes = array('name' => 'bookATourForm','id' => 'book-a-tour-form','class'=>"for_sign_up");
           echo form_open('index.php/location/book_a_tour/'.base64_encode(base64_encode($business_id))."/".base64_encode(base64_encode($city_id)), $attributes);?>
            <div class="heading_div">
              <h4 class="col-md-6 padding_left0">Book A Tour</h4>
              <div class="clearfix"></div>
            </div>
            <div class="div_class">
                
                <!-- 1st -->
                <div class="div_class_div">
                <div class=""><h4>Personal Information</h4></div>
                <div class="clearfix"></div>
                <div class="div_class_gb">
                 <div class="col-lg-6">
                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="firstname"  onclick="removeValidateHtml(this.id);" onFocus="value=''" class="form-control" id="first_name"  >
                        </div>
                    </div>
                 </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="">Last Name<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="lastname" onclick="removeValidateHtml(this.id);" onFocus="value=''" class="form-control" id="last_name" >
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email Address<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="email" onFocus="value=''" class="form-control" id="email" onclick="removeValidateHtml(this.id);" >
                        </div>
                    </div>
                </div>
                 
                 <div class="col-lg-6">
                     <div class="form-group">
                        <label>Phone Number<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" name="phoneno" onFocus="value=''" onclick="removeValidateHtml(this.id);" id="phone" class="form-control" >
                        </div>
                    </div>
                 </div>
                 <!-- /1st -->
                 <div class="clearfix"></div>
                 </div>
                  </div>
                 
                 <div class="div_class_div">
               <!-- <div class=""><h4>Address</h4></div>
                <div class="clearfix"></div>
                  <!-- 2nd -->
               <!--   <div class="div_class_gb">
                 <div class="col-lg-3">
                    <div class="form-group">
                        <label>Street <span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="street"  onclick="removeValidateHtml(this.id);" onFocus="value=''" class="form-control" id="state"  >
                        </div>
                    </div>
                 </div>
             
                  <div class="col-lg-6">
                    
                    <div class="form-group">
                     <label  class="" for="inputSuccess">City<span class="required">*</span></label> 
                          <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="city"  onclick="removeValidateHtml(this.id);" onFocus="value=''" class="form-control" id="city"  >
                        </div>
                 </div>
                                                    
                  </div>  
              
                  <div class="col-lg-3">
                    <div class="form-group">
                        <label>Pin<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="pin" onkeypress="javascript:return isNumber(event)" onFocus="value=''" class="form-control" id="country"  >
                        </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                 </div>-->
              	<!-- /2nd -->
                  </div>
                
                <div class="div_class_div">
                <div class=""><h4>Business Center</h4></div>
                <div class="clearfix"></div>
                <div class="div_class_gb">
                <!-- /3rd -->
              <div class="col-lg-6">
                 <div class="form-group">
                 	  <label  class="" for="inputSuccess">Location<span class="required">*</span></label> 
                        <select name="location" id="ddlView" class="form-control mb-md">
                          <option value="1">Select Location</option>
                          <?php foreach($location as $key=>$value) {
                                                
                                                echo '<option value="'.$value['locationId'].'/'.$value['cityId'].'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
                                            
                                                
                                            } ?>
                              
                        </select>
            	</div>
               </div>
               
               <div class="col-lg-6">
                 <div class="form-group">
                 	  <label  class="" for="inputSuccess">How Did You Hear About Us? <span class="required">*</span></label> 
                       <select name="info" id="ddlView_info" class="form-control mb-md">
							<option value="Internet">Internet</option>
							<option value="Word of mouth">Word of mouth</option>
							<option value="Print Media">Print Media</option>
							<option value="Other">Other</option>
                       </select>
            	</div>
               </div>
               <div class="clearfix"></div>
                 </div>
               
               <br />
               <div class="">
                <div id="radio_msg" style="clear:both;color:#f00; "  ></div>
                 <div class="form-group">
            		<button type="submit" id="sign-up-btn" class="btn  btn-primary  btn-signin btn-signup">BOOK NOW</button>
            	</div>
               </div> 
                
               <div class="clearfix"></div>
                 </div>
             
             <div class="clearfix"></div>
             </div>
            
             
             
            
 			</div>
            </div>
           <?php echo form_close();?>
           	<div class="clearfix"></div> 
        </div> 
    </div><!-- /container -->
</section>   
<!-- /Login Section -->
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
.required {
  color:#D2322D;
  display:inline-block;
  font-size:0.8em;
  font-weight:bold;
  position:relative;
  top:-0.2em;
}
theme.css
* {
  box-sizing:border-box;
}
.div_class h4 { font-size:18px; font-weight:normal; border-bottom:1px solid #ddd; padding-bottom:8px;}
.div_class_div { }
.div_class_gb { background:#F7F7F7; padding:15px 0;}

.div_class_div + .div_class_div { margin-top:15px;}
.card_card_new { background:none !important;}
.padding_left0 { padding-left:0 !important;}
.padding_right0 { padding-right:0 !important;}
.heading_div { border-bottom:1px solid #ddd; margin-bottom:35px;}
.heading_div h4 { color: #000;  font-size: 24px;}
.heading_div h4 abbr{ color:#52bdf3; font-weight:bold;}
.heading_div p { font-size: 18px; margin-top: 13px; }

</style>
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
<script type="text/javascript">
$(document).ready(function() {
  $('#Loading').hide();
  $("#sign-up-btn").click(function(){
    if( firstNameValidation() && lastNameValidation() && emailValidation() && phonenumber() &&  stateValidation() && cityValidation() && countryValidation() && selectValidate() && selectValidate_info() && check() ){
    	
    	$("#sign-up-form").submit();
    }else{
    	return false;
    }
  });
});
</script>
