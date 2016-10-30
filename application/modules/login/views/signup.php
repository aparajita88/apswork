<?php  require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Login Section -->
<section class="login_section">
	<div class="container">
    	
      
        <div class="card card-container for_sign_up_card">
            <h3>Let's Get Started</h3>
            
             
            
          <?php  $attributes = array('name' => 'registrationform','id' => 'sign-up-form','class'=>"for_sign_up");
           echo form_open('index.php/login/signup', $attributes);?>
          
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
				<!--	<p>Your account has been successfuly created. An email send to your given email id, please confirm your account with click on given link on your email.</p>-->
            	<p>Thank you. Someone from our team will contact you to enquire about your needs.</pp>
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
				<?php } ?>
					
					
					
					
					

					</td>									
				</tr>
           <!-- <form role="form" class="for_sign_up" >-->
            <div class="col-lg-6">
				 <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>" >
            <div class="form-group">
                <label>
				<select class="mrs" name="salutation">
				
					<option value="Mr.">Mr.</option>
                    <option value="Miss.">Miss.</option>
				</select>	
				<div class="mssf">First Name <span class="required">*</span></div>
				</label>
                <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="firstname"  onFocus="value=''" class="form-control" id="first_name"  >
                </div>
            </div>

            
            <div class="form-group">
                <label>Email Address<span class="required">*</span></label>
                <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="email" onFocus="value=''" class="form-control" id="email" >
                </div>
            </div> 
            <div class="form-group">
                 <label  class="col-md-3 control-label" for="inputSuccess">City<span class="required">*</span></label> 
                       <select name="location" id="ddlView" class="form-control mb-md">
					<option value="1">Select Location</option>
                     <?php foreach($location as $key=>$value) {
											
											echo '<option value="'.$value['cityId'].'/'.$value['locationId'].'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
										
											
										} ?>
    
                          
                      </select>
             </div> 
            
            </div>
            
            <div class="col-lg-6">
            <div class="form-group">
            	<label class="lable001">Last Name<span class="required">*</span></label>
                <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="lasttname" onclick="removeValidateHtml(this.id); "onFocus="value=''" class="form-control" id="last_name" >
                </div>
            </div>
            <div class="form-group">
            	<label>Phone Number<span class="required">*</span></label>
                <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="phoneno" onFocus="value=''" id="phone" class="form-control" >
                </div>
            </div>
            <div class="form-group privacy-check">
           			<label style=" margin-top: 19px;"><input type="checkbox" required name="privacy" id="privacy"  name="terms"> I agree with the <a href="<?php echo base_url().'index.php/cms/privacy_policy'; ?>">Privacy Policy</a><span class="required">*</span></label>
            	
                <div id="signup_msg" style="clear:both;color:#f00;padding:0px;"  ></div>
            	</div>
            </div>
          
            									
                 
            
			</div>
            
            <div class="clearfix"></div>
           
                 
                 
            	
            	<div id="radio_msg" style="clear:both;color:#f00; "  ></div>
                 <div class="form-group">
            		<button type="button" id="sign-up-btn" class="btn  btn-primary  btn-signin btn-signup">SUBMIT</button>
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
