<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Login Section -->
<section class="section section_white">

  <div class="logbg col-lg-6 col-md-6 col-sm-6 col-xs-12 center-block" style="float:none;">
     <div  class="lock">
              <img src="<?php echo base_url().'assets/front/images/lockicon.png'; ?>" alt="">
            </div>
      <div class="logininner">
          
            <h2 id="wrong-credential">Enter your credentials to login to your account</h2>
            <form>
              <input type="text" name="username"  id="username" placeholder="Email" />
                <input type="password" password="password" placeholder="Password" id="password" />
                <input type="hidden" name="type" value="admin">
                <div class="remember"><input type="checkbox">&nbsp;Remember Me</div>
                <button class="logbtn" id="user" onclick="userLogin()" type="button">Access Smart</button>
              <div class="remember">
                  <a href="<?php echo base_url().'index.php/users/forgotPassword' ?>" class="forgot">Forgot the password?</a>
                    <a href="<?php echo base_url().'index.php/login/signup/4'; ?>" class="signup">Signup</a>
                </div>
                <div class="spacer"></div>
                <div class="remember">
                  <p class="p_policy">By logging in, you agree to our<a href="<?php echo base_url(); ?>index.php/cms/privacy_policy"> Privacy Policy</a>.</p>
                </div>
            </form>
        </div>
  </div>

</section>
<!-- /Login Section -->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/jquery.min.js"></script> 
<script src="<?php echo base_url()."assets/front"; ?>/js/script.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/bootstrap.min.js"></script> 
<script  src="<?php echo base_url()."assets/front"; ?>/js/wow.js"></script> 
<script src="<?php echo base_url()."assets/front";?>/js/login.js"></script>
	<script>
	   new WOW().init();
	</script> 

<!--click topmenu--> 
<script type="text/javascript">
       $(document).ready(function() {
            $('.showmenu').click(function(e) {
                
                $('.login-wrapper1').stop(true).fadeToggle();
            });
            $(document).click(function(e) {
                if (!$(e.target).closest('.showmenu, .login-wrapper1').length) {
                     
                    $('.login-wrapper1').stop(true).fadeOut();
                }
            });
        });
		
		/* $( '.showmenu' ).click(function() {
		  $( ".login-wrapper" ).slideToggle( "", function() {
 		  });
		}); */
		
		 
      </script>
      
      <script type="text/javascript">
       $(document).ready(function() {
            $('.showmenu1').click(function(e) {
                
                $('.login-wrapper2').stop(true).fadeToggle();
            });
            $(document).click(function(e) {
                if (!$(e.target).closest('.showmenu1, .login-wrapper2').length) {
                     
                    $('.login-wrapper2').stop(true).fadeOut();
                }
            });
        });
		
 		 
      </script>
</body>
</html>
