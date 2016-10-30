<?php require_once BASEPATH."../assets/front/lib/header_with_picture.php" ?>   

<!-- client id - "73226506739-kkbk7hmkies5jenld9jpavfpber5fros.apps.googleusercontent.com" -->
<!--client secret -  oLntfSdW-vB2wR6ljY4-8I_b  -->
<!-- created from https://console.developers.google.com/apis/credentials?project=hostmypartyz -->

  <!-- Start banner -->
  <section id="inner"> 
    <div id="main-slide" class="carousel slide" >
      
      <!-- Carousel inner -->
      <div class="carousel-inner page-banner">
        <div class="page-bannerimginner">
          <div class="slider-content"></div>
        </div><!--/ page-bannerimginner end --> 
      </div><!-- Carousel inner end-->
      
    </div><!-- /carousel --> 
  </section>
  <!-- End banner --> 
<!-- registration start-->
<section>
	<form action="<?php echo base_url().'users/doRegistration' ?>" id="host_registration_form" method="post">
	  <div class="register-main">
    	<div class="container">
        	<div class="row">
            	<?php if(isset($_GET['email']) && $_GET['email']=='send'){ ?>
            	<div class="col-sm-12">
					<p>Your account has been successfuly created. An email send to your given email id, please confirm your account with click on given link on your email.</p>
            	</div>
            	<?php }else if(isset($_GET['email']) && $_GET['email']=='error'){ ?>
				<div class="col-sm-12">
					<p>Your account has been successfuly created. please contact with site administrator to confirm your account.</p>
            	</div>
				<?php } ?>
            	<div class="col-sm-12">
                	<div class="register-heading">
                    	<h2>Register</h2>
                    </div>
                </div>
            </div>
            <div class=" full">
            	<div class="row">
                	<div class="col-sm-6">
                    	<input type="text" name="first_name" id="first_name" class="register-box"  placeholder="First name" onclick="removeValidateHtml(this.id);"/>
 						<span id="first_name_error" class="error"></span>
                   </div>
                    <div class="col-sm-6">
                    	<input type="text" name="last_name" id="last_name" class="register-box"  placeholder="Last Name" onclick="removeValidateHtml(this.id);"/>
						<span id="last_name_error" class="error"></span>
                    </div>
                </div>
            </div>
            <div class=" full mr3">
            	<div class="row">
                	<div class="col-sm-6">
                    	<input type="text" name="phone" id="phone" class="register-box" minlength="11" onkeypress="return isNumber(event);" placeholder=" Phone" onclick="removeValidateHtml(this.id);"/>
						<span id="phone_error" class="error"></span>
                    </div>
                    <div class="col-sm-6">
                    	<input type="text" name="email" id="email" class="register-box" placeholder=" Email" onclick="removeValidateHtml(this.id);"/>
						<span id="email_error" class="error"></span>
                    </div>
                </div>
            </div>
            <div class=" full mr3">
            	<div class="row">
                	<div class="col-sm-6">
                    	<input type="text" name="address" id="address" class="register-box"  placeholder="Address" onclick="removeValidateHtml(this.id);"/>
						<span id="address_error" class="error"></span>
                    </div>
                    <div class="col-sm-6">
                    	<input type="text" name="postcode" id="postcode" class="register-box"  placeholder="Postcode" onclick="removeValidateHtml(this.id);"/>
						<span id="postcode_error" class="error"></span>
                    </div>
                </div>
            </div>
            <div class=" full mr3">
            	<div class="row">
                	<div class="col-sm-6">
                    	<input  type="password" name="password" id="password" class="register-box"  placeholder="Password" onclick="removeValidateHtml(this.id);"/>
						<span id="password_error" class="error"></span>
                    </div>
                    <div class="col-sm-6">
                    	<input type="password" name="password1" id="password1" class="register-box"  placeholder="Confirm Password" onclick="removeValidateHtml(this.id);"/>
						<span id="password1_error" class="error"></span>
                    </div>
                </div>
            </div>
            <div class=" full mr3">
            	<div class="row">
                	<div class="col-sm-6">
                    	<div  class=" full">
                        	<input type="text" name="captcha" id="captcha" class="register-sub-box" placeholder="Type here" onclick="removeValidateHtml(this.id);">
                            
                            <div class="register-sub-box2">
	                          <div class="captcha-image"><?php	echo $image; ?></div>
                               	<a href="Javascript:void(0)" id="captcha-refresh" onClick="refresh_captcha();"><img src="<?php echo base_url().'html/images/refresh.png';?>" alt="CAPTCHA security refresh" /></a>
                                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                            	<!--<img src="<?php // echo base_url(); ?>html/images/number.png" alt="">-->
                              </div>
							
                        </div>
                        <span id="captcha_error" class="error"></span>
                    </div>
                </div>
            </div>
            <div class="full mr3">
            	<div class="row">
                <div class="col-sm-9">
                	<div class="checkbox">
                        <input id="1checkd" type="checkbox" name="check" value="1checkd">
                        <label for="1checkd"><span></span>I agree to the HostMyParty Terms of Service and Privacy Policy</label>
                    </div>
                </div>
                </div>
            </div>
            <div class="full mr3">
            	<button type="button" onclick="doValidation();" class="btn btn-danger register-button">Submit</button>
            </div>
        </div>
    </div>
    <span style="display:none;"><input type="submit" id="doregistration" name="doregistration" value="Submit"/></span>
	</form>
    <div class="clearfix"></div>
</section>
  <?php require_once BASEPATH."../assets/front/lib/footer.php" ?>
  
</div>
<!-- End Full Body Container --> 

<!-- Go To Top Link --> 
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
<div id="loader">
  <div class="spinner">
    <div class="dot1"></div>
    <div class="dot2"></div>
  </div>
</div>
	
</body>
</html>
