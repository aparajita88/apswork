   <?php  require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Login Section -->
<section class="login_section">
	<div class="container">
   <div class="new_signuup">
         		<h3>Smart Signup</h3>
                
                <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gellery_images gellery_images_hover gellery_over0060h " > 
                    <div class="ne_m">
                        <div class="gellery_over gellery_over0060">
                             <a href="<?php echo base_url().'index.php/login/signup/4';?>" class="">
                                <p>Serviced Office <br />
                                From <br />
                                Smartworks</p>
                                </a>
                         </div>
                        <img src="<?php echo base_url()."assets/front"; ?>/images/01212016/small-business.jpg" alt="" />
                	</div>
                    	
                </aside>
                
                <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gellery_images gellery_images_hover gellery_over0060h"> 
                	 <div class="ne_m">
                    <div class="gellery_over gellery_over0060">
                         <a href="<?php echo base_url().'index.php/login/signup/3';?>" class="">
                         	<p>Serviced Office  <br />
                            For<br />
                            Smartworks</p>
                            </a>
                     </div>
                   <img src="<?php echo base_url()."assets/front"; ?>/images/01212016/start-up.jpg" alt="" />
                	</div>
                </aside>
                
                
                 
            <div class="clearfix"></div>
            </div>
    
  </div><!-- /container -->
</section>   
<!-- /Login Section -->


 <br> <br>
<!-- Call Us -->
<section class="coll_us_section">
  <div class="container">
    <div class="row">
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 phone_contact">
        <p><i class="fa fa-phone"></i>Call us Today 1800-111-1111</p>
      </aside>
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 icon_contact"> <a class="btn btn-large btn-default know" href="<?php echo base_url().'index.php/users/contact_us'; ?>">Contact Us <i class="fa fa-angle-right"></i></a> </aside>
    </div>
  </div>
</section>
<!-- /Call Us --> 

<!-- Map -->
<!---<div class="map_sec">
  <!----<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.270770521181!2d88.43108311482146!3d22.568974038791673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275adc3ba1021%3A0xebcdcaa065bd0c8!2sBarbeque+Nation!5e0!3m2!1sen!2sin!4v1449465437662" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>
----><!----<iframe src="https://maps.google.it/maps?q=Smartworks+Business+Center&output=embed&z=12" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>--->

<!-- /Map --> 
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
<script type="text/javascript">
	
      $(document).ready(function() {
      $("#sign-up-btn").click(function(){
		 
			
			if( firstNameValidation() && lastNameValidation() && emailValidation() && phonenumber() && radio() && check()){
				
				$("#sign-up-form").submit();
			}else{
				return false;
			}
			
		});
			});
			 </script>
   
