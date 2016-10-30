<?php  require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Login Section -->
<section class="login_section">
	<div class="container">
    	
      
        <div class="card card-container for_sign_up_card">
           
            
             
            
         
          
           <tr>
					<td valign="middle" align="left" colspan="2" >

					<?php
						/*if($this->session->flashdata('success')){							
							echo  $this->session->flashdata('success') ;							
						}elseif($this->session->flashdata('error')){							
							echo "<span class='error_msg'>" . $this->session->flashdata('error') . "</span>";							
						}
					*/?>
					
					<div class="row">
            	<?php if(isset($_GET['email']) && $_GET['email']=='send'){ ?>
            	<div class="col-sm-12">
				<!---	<p>Your account has been successfuly created. An email send to your given email id, please confirm your account with click on given link on your email.</p>--->
            	 <h3>Registration Successful</h3>
            	<p><h4>Hello   <?php echo $user_info['gender']." ";?><?php echo $user_info['FirstName']." ".$user_info['LastName'];?> <p></h4></br>
            	<p><h4>Thank you for signing up for Smartworks Business Center. </br>
Our Community Manager will get in touch with you as soon as possible.</br></br>
 
Regards,</br></br>
 
SmartWorks</h4></p></br>
<p><h4><?php //echo $user_info['l_name'];?></h4></p>
<p><h4><?php //echo $user_info['c_name'];?></h4></p>
            	</div>
            	<?php }else if(isset($_GET['email']) && $_GET['email']=='error'){ ?>
				<div class="col-sm-12">
					<p>Your account has been successfuly created. please contact with site administrator to confirm your account.</p>
            	</div>
				<?php }
					else if(isset($_GET['email']) && $_GET['email']=='emailavailable'){ ?>
				<div class="col-sm-12">
					<p>You already have an account here with this email. Please try with another email.</p>
            	</div>
				<?php } 
				
       // print_r($user_info);
				
				?>
					
					
					
					
					

					</td>									
				</tr>
				
				
				
				
           <!--- <form role="form" class="for_sign_up" >--->
           
            
           	<div class="clearfix"></div> 
        </div> 
        
         
        
    </div><!-- /container -->
</section>   
<!-- /Login Section -->


 <br> <br>
<!-- Call Us -->
<!--<section class="coll_us_section">
  <div class="container">
    <div class="row">
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 phone_contact">
        <p><i class="fa fa-phone"></i>Call us Today 1800-111-1111</p>
      </aside>
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 icon_contact"> <a class="btn btn-large btn-default know" href="<?php echo base_url().'index.php/users/contact_us'; ?>">Contact Us <i class="fa fa-angle-right"></i></a> </aside>
    </div>
  </div>
</section>-->
<!-- /Call Us --> 

<!-- Map -->
<!---<div class="map_sec">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.270770521181!2d88.43108311482146!3d22.568974038791673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275adc3ba1021%3A0xebcdcaa065bd0c8!2sBarbeque+Nation!5e0!3m2!1sen!2sin!4v1449465437662&z=12" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>--->
<!---<div class="map_sec">
<iframe src="https://maps.google.it/maps?q=Smartworks+Business+Center&output=embed&z=12" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>

</div><!-- /Map --> 
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
</style>
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
<script type="text/javascript">
	
      $(document).ready(function() {
      $("#sign-up-btn").click(function(){
		 
			
			if( firstNameValidation() && lastNameValidation() && emailValidation() && phonenumber()  && selectValidate() && check() ){
				
				$("#sign-up-form").submit();
			}else{
				return false;
			}
			
		});
			});
			 </script>
