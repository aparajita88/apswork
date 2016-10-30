<?php require_once(FCPATH.'assets/front/lib/header_contact.php'); ?> 

	<section class="faq_holder2 contact_holder">
     	<div class="faq2">
        	<h2>Contact us, we can help.</h2>
             <p>If you have any questions or comments regarding our services, please mail or email us at:</p>
             <p>Smartworks Business Center Pvt. Ltd.<br>
               21A, Shakespeare Sarani<br>
                Kolkata 700017<br>
                Call us 1800 - 833 -9675<br>
                Email: <a href="mailto:info@sworks.co.in">info@sworks.co.in</a></p>
        </div>
        
        
        <section class="login_section login_section_contact">
         <div class="card card-container for_sign_up_card" id="contactUs_div">
             <form class="for_sign_up" role="form" method="post">
            
            <label>First Name<span class="required">*</span></label>
            <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" placeholder="First Name" class="form-control" name="first_name" id="first_name" onclick="removeValidateHtml(this.id);">
            </div>
            <div class="clearfix"></div>
            
            <label>Last Name<span class="required">*</span></label>
            <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" placeholder="Last Name" class="form-control" name="last_name" id="last_name" onclick="removeValidateHtml(this.id);">
            </div>
            <div class="clearfix"></div>
            
            <label>Email Address<span class="required">*</span></label>
            <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" placeholder="Email Address" class="form-control" name="email" onclick="removeValidateHtml(this.id);" id="email">
            </div>
            <div class="clearfix"></div>
            
            
            
            <label>Phone<span class="required">*</span></label>
            <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" placeholder="Phone" class="form-control" name="phone" onclick="removeValidateHtml(this.id);" id="phone"><!--onkeypress="return isNumber(event);"--> 
            </div>
            <div class="clearfix"></div>
            
             <label>Message<span class="required">*</span></label>
            <div class="input-group textarea">
                    <textarea class="form-control" placeholder="Message" id="message"></textarea>
             </div>
            <div class="clearfix"></div>

             <div class="clearfix"></div>
             <br> 
             <button class="btn  btn-primary  btn-signin btn-signup" id="btn-contactUs" type="button">Contact Us</button>
             <span id="contact_status"></span>
            <div class="clearfix"></div>
            </form>
        </div> 
  		</section>
         
        
    
    <div class="clearfix"></div>
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

