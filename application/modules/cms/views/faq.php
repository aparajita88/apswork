<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<style type="text/css">
  .faq_holder{
    max-width: 100%;
  }
  .faq_holder .faq p, .faq_holder .faq h2{
    padding-left: 15px;
    padding-right: 15px;
  }
  </style>
<!-- Section -->
  <section class="our_mission our_mission_start">
        <?php if($cms_content[0]['image'] != ''){ ?>
        <img src="<?php echo base_url();?>assets/uploads/cms/full/<?= $cms_content[0]['image'] ?>" alt=''>          
      <?php } ?>          
     <div class="clearfix"></div>
  </section>
 <!-- /Section --> 
<!-- Faq Section -->
	<section class="">
     	<div class="faq">
			<?php //print_r($cms_content);
			echo $cms_content[0]['content']; ?>
        <!---	<h2 style="text-align:center;">FAQ </h2>
        	<h2>WHAT DOES SMARTWORKS OFFER?</h2>
             <p>Smartwork offers flexible workspace solutions ideal for businesses that do not wish to commit 

to long term leases or contracts and wish to minimize their overhead expenses. Whatever you 

need there is a smart solution for you here at Smartworks. Our solutions include:</p>
		
		<h3>DEDICATED WORKSTATIONS</h3>
		
<p>Fully equipped workstations for your employees.</p>

<h3>CONFERENCE ROOMS</h3>
<p>Your Conference rooms for important conferences, not below any traditional conference room you would see in a long-term lease office.</p>

<h3>Meeting Rooms</h3>
 <p>Meeting rooms for day to day interactions and needs.</p>

<h3>Virtual Offices</h3>
<p> Fully equipped virtual offices to make you work away from office.</p>

<h3>Day Desks</h3> 
<p>Professional & cost effective day desks for all your staff.</p>

<h3>Training Rooms </h3>
<p>Training rooms for teaching and instruction purposes.</p>
 <h3>ANCILLARY SERVICES</h3>
 <p>Apart from these solutions, we also offer ancillary services that a business might need. Anything 

that you can think of, we have ready for you. These services include courier services, office boy, 

cafeteria, dedicated phone reception, secretarial support, legal support, IT support, games room, 

printing and copying services, payroll support, travel desk, video conferencing, locker rooms and 

network connections.</p>

<h2>SHOULD I MAKE AN APPOINTMENT TO VISIT 

SMARTWORKS?</h2>
<p>Tours must be scheduled in advance. Give us a call at 1800-111-1111 for details.</p>
<h2> DO WHAT ARE THE PRICING PLANS?</h2>
<p>We have convenient & flexible pricing plans to suit your budget. Give us a call at 1800-111-1111 

for details.</p>
<h2>WHAT IF MY COMPANY NEEDS PHONE SERVICE?</h2>

<p>STD and ISD facilities are available. Give us a call at 1800-111-1111 for details..

<h2>WHAT ARE THE BUILDING HOURS?</h2>
<p>All Smartworks buildings are accessible by keycard 24/7. Smartworks staff attend to the 

buildings between 9 a.m. - 6 p.m. Monday through Friday.</p>
<h2>WHEN DO I HAVE TO LET SMARTWORKS 

MANAGEMENT KNOW I’M MOVING OUT?</h2>
<p>Members are required to give a 30-day notice to move out or transfer offices. Give us a call at 

1800-111-1111 for details.</p>--->

   
   
        </div>
       <!---- <div class="faq">
        	<h2>Contrary to popular  </h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <h3>typesetting </h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <h3>industry</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        </div>
        <div class="faq">
        	<h2>Questions or comments </h2>
            <p>If you have any questions or comments regarding our Policy, please mail or email us at:</p>
             <p>Smartworks 123 Lipsum Lorem <br>
             Lorem Ipsum<br>
                State, Zipcode<br>
                Call us 111-123-325<br>
                Email: <a href="#">info@company.com</a></p>
         </div>--->
        
        
    
    <div class="clearfix"></div>
    </section>

<!-- /Faq Section -->

<!-- Call Us -->
<section class="coll_us_section">
  <div class="container">
    <div class="row">
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 phone_contact">
        <p><i class="fa fa-phone"></i>Call us Today 1800-111-1111</p>
      </aside>
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 icon_contact"> <a class="btn btn-large btn-default know" href="<?php echo base_url().'index.php/users/contact_us' ?>">Contact Us <i class="fa fa-angle-right"></i></a> </aside>
    </div>
  </div>
</section>
<!-- /Call Us --> 

<!-- Map -->
<div class="map_sec">
 <!--- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.270770521181!2d88.43108311482146!3d22.568974038791673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275adc3ba1021%3A0xebcdcaa065bd0c8!2sBarbeque+Nation!5e0!3m2!1sen!2sin!4v1449465437662" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>--->
 <!---<iframe src="https://maps.google.it/maps?q=Smartworks+Business+Center&output=embed&z=12" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe> 
</div>--->
<!-- /Map --> 

<!-- Footer -->
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
<!-- /Footer --> 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/jquery.min.js"></script> 
<script src="<?php echo base_url()."assets/front"; ?>/js/script.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/bootstrap.min.js"></script> 
<script  src="<?php echo base_url()."assets/front"; ?>/js/wow.js"></script> 
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
