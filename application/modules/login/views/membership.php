<?php setlocale(LC_MONETARY, 'en_IN'); ?>
<?php  require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Login Section -->
<script>
	
			 
		function getData()
		{
			var d = new Date();
			var n = d.getTime();
			var orderID = n +  '' +randomFromTo(0,1000);
			
			document.getElementById("OrderId").value = orderID;
			return true;
		}

		function randomFromTo(from, to){
			return Math.floor(Math.random() * (to - from + 1) + from);
		}	
	
</script>
<body onload="getData();">
<section class="login_section">
	<div class="container">
    	<?php //print_r($this->session->unset_userdata('newdata')); ?>
      
      
        <div class="card card-container for_sign_up_card card_card_new">
           
            
            
             
            
          <?php  $attributes = array('name' => 'registrationform','id' => 'sign-up-form','class'=>"for_sign_up");
           echo form_open('index.php/login/membership/'.base64_encode(base64_encode($subscription[0]['Id'])), $attributes);?>
          
          

            <div class="heading_div">
            	<h4 class="col-md-6 padding_left0"><abbr><?php echo $subscription[0]['name']; ?></abbr> Membership</h4>
            	<p class="col-md-6 text-right padding_right0">Price <b><?php echo money_format( '%i',$subscription[0]['price']); ?></b></p>
          		<div class="clearfix"></div>
          		 NOTE: The membership will take effect from the beginning of the current month.
            </div>
            
            <div class="div_class">
                
                <!-- 1st -->
                <div class="div_class_div">
                <div class=""><h4>Personal Information</h4></div>
                <div class="clearfix"></div>
                <div class="div_class_gb">
                 <div class="col-lg-6">
                     <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>" >
                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="firstname"  onFocus="value=''" class="form-control" id="first_name"  >
                        </div>
                    </div>
                 </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="">Last Name<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="lasttname" onclick="removeValidateHtml(this.id); "onFocus="value=''" class="form-control" id="last_name" >
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email Address<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="email" onFocus="value=''" class="form-control" id="email" onchange="return emailValidation_member();" >
                        </div>
                        <span id="Loading" style="display: none;" ><img src="<?php echo base_url()."assets/front/"; ?>images/load.gif" alt="Ajax Indicator" /></span> 
                        <div id="Info"></div>
                    </div>
                </div>
                 
                 <div class="col-lg-6">
                     <div class="form-group">
                        <label>Phone Number<span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" name="phoneno" onFocus="value=''" id="phone" class="form-control" >
                        </div>
                    </div>
                 </div>
                 <!-- /1st -->
                 <div class="clearfix"></div>
                 </div>
                  </div>
                 
                 <div class="div_class_div">
                <div class=""><h4>Address</h4></div>
                <div class="clearfix"></div>
                  <!-- 2nd -->
                  <div class="div_class_gb">
                 <div class="col-lg-3">
                    <div class="form-group">
                        <label>Street <span class="required">*</span></label>
                        <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="street"  onFocus="value=''" class="form-control" id="state"  >
                        </div>
                    </div>
                 </div>
             
                  <div class="col-lg-6">
                    
                    <div class="form-group">
                     <label  class="" for="inputSuccess">City<span class="required">*</span></label> 
                          <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" name="city"  onFocus="value=''" class="form-control" id="city"  >
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
                 </div>
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
                                                
                                                echo '<option value="'.$value['cityId'].'/'.$value['locationId'].'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
                                            
                                                
                                            } ?>
        <a href="http://www.simayaa.com/simayaa-brochure.pdf" download="simayaa-brochure.pdf">Download our Company Profile</a>
                              
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
                <div class="form-group privacy-check col-lg-12">
                <label style=" margin-top: 19px;"><input type="checkbox" required name="privacy" id="privacy"  name="terms"> I agree with the <a href="<?php echo base_url().'assets/Scenarios for direct-indirect client.pdf'; ?>">Terms & Condition</a><span class="required">*</span></label>
              
                <div id="signup_msg" style="clear:both;color:#f00;padding:0px;"  ></div>
              </div>
               <!-- data for session  -->
               <?php $price_data=$subscription[0]['price']*100;?>
               <td><input type="hidden" value="" id="OrderId" name="OrderId"></td>
               <td><input type="hidden" value=<?php echo $price_data;?> id="amount" name="amount"></td>
               <td><input type="hidden" value="<?= CURRENCY_NAME; ?>" id="currencyName" name="currencyName"> </td>
               <td><input type="hidden" value="<?= ME_TRANS_REQ_TYPE;?>" id="meTransReqType" name="meTransReqType"></td>
               <td><input type="hidden" name="mid" id="mid" value="<?= MID; ?>"></td>
               <td><input type="hidden" name="enckey" id="enckey" value="<?= ENCKEY; ?>"></td>
               <td><input type="hidden" name="responseUrl" id="responseUrl" value="<?php echo $this->config->item('base_url');?>index.php/login/payment_response"/></td>
               
               
               
               
               
               <!-- data for session  -->
               <div class="clearfix"></div>
                 </div>
               
               <br />
               <div class="">
                <div id="radio_msg" style="clear:both;color:#f00; "  ></div>
                 <div class="form-group">
            		<button type="button" id="sign-up-btn" class="btn  btn-primary  btn-signin btn-signup">PAY NOW</button>
            	</div>
               </div> 
                
               <div class="clearfix"></div>
                 </div>
             
             <div class="clearfix"></div>
             </div>
            
             
             
            
 			</div>
            
             	
            	
            </div>
           <!--- </form>--->
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



/**/

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
     
      $("#sign-up-btn").click(function(){
		 
			
			if( firstNameValidation() && lastNameValidation() && email_blankchk() &&  phonenumber() &&  stateValidation() && cityValidation() && countryValidation() && selectValidate() && selectValidate_info() && check() ){
				
				$("#sign-up-form").submit();
			}else{
				return false;
			}
			
		});
			});
	


 

	</script>
