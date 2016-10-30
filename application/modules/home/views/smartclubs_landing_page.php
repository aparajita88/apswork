<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>#SmartClub</title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lp_css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lp_css/style.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
<!-- Facebook Pixel Code -->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1783118191901202');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1783118191901202&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81009361-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>

</head>
<body>
<a href="#top" id="bottom" class="fa fa-arrow-circle-up toparrow" aria-hidden="true"></a>
<header id="star">
  <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 top"> <a href="http://sworks.co.in/" class="logo" target="_blank"><img src="<?php echo base_url();?>assets/lp_images/logo.png" title="Welcome to #Smartclub" alt="" /></a>
    <div class="toggle"> <span class="fa fa-bars"></span> </div>
    <ul class="contactinfo">
      <li><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<a href="tel:18008339675">1800 833 9675 ( Toll Free )</a></li>
      <li><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@sworks.co.in">info@sworks.co.in</a></li>
      <li><i class="fa fa-at" aria-hidden="true"></i>&nbsp;<a href="http://www.sworks.co.in" target="_blank">www.sworks.co.in</a></li>
    </ul>
    <nav class="slidetoggle">
      <ul>
        <li><a href="#bcm">Become A Member</a></li>
        <li><a href="#offc">Smart Office</a></li>
        <li><a href="#sol">Smart Solutions</a></li>
        <li><a href="#supt">Inhouse Support</a></li>
      </ul>
      <a href="JavaScript:void(0)" class="close"></a> </nav>
  </div>
</header>
<section class="col-md-12 col-sm-12 col-xs-12 col-lg-12 banner module">
  <div class="container">
    <article class="bannermessage col-lg-6 col-md-6 col-sm-6  col-xs-12">
      <h1>On Demand & Dedicated </h1>
      <p class="mediumtxt"><span class="xtrabold">Managed</span> Office Solutions at an Unbelievable <span class="xtrabold">Cost</span> <span class="smaltxt">(Inaugural Period Offer)</span></p>
      <p class="smalltxt">If you are a growing professional or a business head, come, experience our <span><img src="<?php echo base_url();?>assets/lp_images/bannerlogo.png" alt="" /></span></p>
    </article>
  </div>
</section>
<section class="col-md-12 col-sm-12 col-xs-12 col-lg-12 module" id="bcm">
  <div class="container registration">
                  	
    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-7 regform">
      <h2>Become a Member Today & Avail Awesome Benefits for a Limited Time</h2>
      <?php if(isset($_GET['email'])) { ?>
            	<div class="col-sm-12 red">
            	<p><?php echo$_GET['email'];?> </p>
            	</div>
      <?php } ?>
      <?php  $attributes = array('name' => 'registration','id' => 'sign-up-form','class'=>"inputarea");
           echo form_open('index.php/home/smartclubs', $attributes);?>
        <div  class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <select id="frequently_office_use" name="office_use">
              <option selected="selected" value="1">How frequently do you use office space? *</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="quarterly">Quarterly</option>
            <option value="yearly">Yearly</option>
          </select>
        </div>
        <div  class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <select id="type_of_business" name="typeOfBusiness">
            <option selected="selected" value="1">Type of Business *</option>
            <option value="start_up">Start Up</option>
            <option value="small_&_medium_enterprise">Small & Medium Enterprise</option>
            <option value="large_company">Large Company</option>
            <option value="professional">Professional</option>
            <option value="designer">Designer</option>
            <option value="entertainer">Entertainer</option>
          </select>
        </div>
        <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <input type="text"  placeholder="First Name *" name="firstname" id="first_name"/>
        </div>
         <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <input type="text"  placeholder="Last Name *" name="lastname" id="last_name"/>
        </div>
        <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <input type="email"  placeholder="Email *" name="email" id="email"/>
        </div>
        <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <input type="tel"  placeholder="Phone *" name="phoneno" id="phone"/>
        </div>
        <div  class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
          <input type="text"  placeholder="Company Name" name="company_name" id="phone"/>
        </div>
        <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <select name="location" id="ddlView" class="form-control mb-md">
					<option value="1">Select Office Location *</option>
                     <option value="e6b90146-a1be-2b/18bd3041-0c84-08">Indiabulls Finance Center (Mumbai)</option><option value="babe28ff-a738-cd/3cbefdf9-8a2c-36">Logix Cyber Park (Noida)</option><option value="4e24a816-96e6-5d/7017f545-c757-f5">Vardhman Trade Centre (Delhi)</option><option value="7197c81c-e83b-05/8687fee1-3674-5e"> Time Square Building (Gurgaon)</option><option value="14c4d558-8787-ee/c6d3976c-7811-ac">Nyati Unitree (Pune)</option><option value="7197c81c-e83b-05/ca31ed1f-07bc-b8">Paras Downtown Center (Gurgaon)</option><option value="14c4d558-8787-ee/cc637a41-5cb8-c6">Pride Baner (Pune)</option><option value="4d332ea5-cc89-a9/d1ca4785-d083-7e">Umiya Business Bay (Bangalore)</option><option value="cfd849d5-ec69-2d/eeaaf534-7bc9-0b">Victoria Park Building, Sector 5 (Kolkata)</option>    
                      </select>
        </div>
        
         <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <select name="source" id="source">
          		<option selected="selected" value="1">Where did you hear about us? *</option>
                <option value="facebook" >Facebook</option><option value="linkedin">Linkedin</option><option value="advertisement">Advertisement</option>
          </select>
        </div>
        
        
        
        <div  class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
          <button type="button" value="" class="orangebtn" id="register_btn">Register Now</button>
        </div>
      </form>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-12 col-lg-5 regform">
      <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active"> <img src="<?php echo base_url();?>assets/lp_images/experiance.jpg" alt="" /> </div>
          <div class="item"> <img src="<?php echo base_url();?>assets/lp_images/earlybird.jpg" alt="" /> </div>
          <div class="item"> <img src="<?php echo base_url();?>assets/lp_images/referal.jpg" alt="" /> </div>
          <div class="item"> <img src="<?php echo base_url();?>assets/lp_images/uuo.jpg" alt="" /> </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="col-md-12 col-sm-12 col-xs-12 col-lg-12 officebg module" id="offc">
  <div class="container">
    <div class="headingarea">
      <h2>Smart Locations</h2>
      <div class="border"></div>
    </div>
    <div class="slider">
            <div id="myCarousel3" class="carousel slide" data-ride="carousel"> 
            <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
               	 <div class="item active"> 
                 		<div class="row-fluid itm">
                    		<img src="<?php echo base_url();?>assets/lp_images/mumbai.jpg"  alt="" />
                            <img src="<?php echo base_url();?>assets/lp_images/noida.jpg" alt="" />
                            <img src="<?php echo base_url();?>assets/lp_images/kolkata.jpg" alt="" />
                        </div>
                 </div>
				 <div class="item"> 
                 		<div class="row-fluid itm">
                            <img src="<?php echo base_url();?>assets/lp_images/gurgoan02.jpg" alt="" />
                    		<img src="<?php echo base_url();?>assets/lp_images/delhi.jpg"  alt="" />
                            <img src="<?php echo base_url();?>assets/lp_images/pune01.jpg"  alt="" />
                        </div>
                 </div>
                 <div class="item"> 
                 		<div class="row-fluid itm">
                            <img src="<?php echo base_url();?>assets/lp_images/pune02.jpg" alt="" />
                            <img src="<?php echo base_url();?>assets/lp_images/bangalore.jpg"  alt="" />
                            <img src="<?php echo base_url();?>assets/lp_images/gurgoan01.jpg"  alt="" />
                        </div>
                 </div>
                </div>
                
                
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel3" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel3" data-slide-to="1"></li>
                    <li data-target="#myCarousel3" data-slide-to="2" ></li>
                </ol>
                
                
            </div>
      
    </div>
  </div>
</section>
<section class="col-md-12 col-sm-12 col-xs-12 col-lg-12 module" id="sol">
  <div class="container">
    <div class="headingarea">
      <h2>Smart Solutions</h2>
      <div class="border"></div>
    </div>
    <p class="text-center">We offer you the perfect office at an affordable price - plus an umbrella of services to support all your office requirements. Our solutions include.</p>
    <ul class="solution">
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>State of the art, dedicated and fully equipped workstations for your employees; conference rooms, meeting rooms and training rooms for your day to day interactions and needs.</span></li>
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>Professional & cost effective hot desking solutions for all your staff.</span></li>
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>Convenient & flexible pricing plans to suit your budget.</span></li>
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>Absolute customized solutions to fit the requirement of any organization, any size, any where.</span> </li>
    </ul>
    <ul class="solution">
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>Fully equipped virtual offices.</span></li>
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>Ideal for professionals of any industry.</span></li>
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>Payment options in full time or part time, short term or for extended period; we provide customized and exact solutions.</span></li>
      <li><i class="fa fa-star" aria-hidden="true"></i>&nbsp;<span>We get all your office requirement sorted; choose from our host of our ancillary services like coincerge, smart community and much more.</span></li>
    </ul>
  </div>
<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 center-block" style="float:none">
    <a href="#bcm" id="register_btn" class="orangebtn_small2">Register Now</a>
</div>
</section>

<section class="col-md-12 col-sm-12 col-xs-12 col-lg-12 module support" id="supt">
  <div class="container">
    <div class="headingarea">
      <h2>In-house Support</h2>
      <div class="border"></div>
    </div>
    <div id="myCarousel2" class="carousel slide" data-ride="carousel"> 
      <!-- Carousel items -->
      <div class="carousel-inner">
        <div class="item active">
          <div class="row-fluid">
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/env.png" alt="" /><span>Professional Services</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/gofer.png" alt="" /><span>Gofer</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/cafe.png" alt="" /><span>Smart Business Cafe </span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/recept.png" alt="" /><span>Dedicated Reception</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/services.png" alt="" /><span>Secretarial Services</span></div>
          </div>
        </div>
        <!--/item-->
        
        <div class="item">
          <div class="row-fluid">
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/it.png" alt="" /><span>IT Support</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/legal.png" alt="" /><span>Legal Support</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/game.png" alt="" /><span>Games Room</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/print.png" alt="" /><span>High Quality Printing & Copying </span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/clocksupport.png" alt="" /><span>Clock in, Clock out Support</span></div>
          </div>
        </div>
        
        
        <div class="item">
          <div class="row-fluid">
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/concierge.png" alt="" /><span>Smart Concierge </span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/video.png" alt="" /><span>Video Conferencing </span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/locker.png" alt="" /><span>Locker Rooms</span></div>
            <div class="span3"><img src="<?php echo base_url();?>assets/lp_images/community.png" alt="" /><span>Connectivity</span></div>
          </div>
        </div>        
        

        
        
        <!--/item--> 
        
      </div>
      <!--/carousel-inner-->
      <div class="spacer"></div>
      <ol class="carousel-indicators">
        <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel2" data-slide-to="1"></li>
        <li data-target="#myCarousel2" data-slide-to="2" ></li>
      </ol>
    </div>
  </div>
</section>

<footer>
  <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
    <div class="container"> <a href="JavaScript:void(0)" class="flogo"><img src="<?php echo base_url();?>assets/lp_images/smartblack.png" alt="" /></a>
      <p class="copy">@ Copy Rights 2016. All Rights Reserved.</p>
    </div>
  </div>
</footer>

<!--Scrip Section--> 
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/front/js/validation.js"></script> 
<!--Scrip Section--> 
<script type="text/javascript">
	$(document).ready(function(){
		$('.toggle').click(function(){
			$('.slidetoggle').toggle( "slide" );
		})		
		
//		$('.slidetoggle').hover(function(){ 
//			mouse_is_inside=true; 
//			}, function(){ 
//			mouse_is_inside=false; 
//		});
//		
//		$("body").mouseup(function(){ 
//			if(! mouse_is_inside) $('.slidetoggle').hide("slide");
//		});
		$('body').bind('mouseup', function(event){
                    var thisclass=event.target.className;
                    if(thisclass === 'fa fa-bars' || thisclass === 'slidetoggle' ) {    } else {  $('.slidetoggle').hide("slide");}
                });
		$('#myCarousel').carousel({
			interval: 3000,
			cycle: true
		})	
		
		 $('#myCarousel2').carousel({
			interval: 3000,
			cycle: true
		})

		
	})

</script>
<script>

	$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});


$(function() {
    // Desired offset, in pixels
    var offset = -100;
    // Desired time to scroll, in milliseconds
    var scrollTime = 500;

    $('a[href^="#"]').click(function() {
        // Need both `html` and `body` for full browser support
        $("html, body").animate({
            scrollTop: $( $(this).attr("href") ).offset().top + offset 
        }, scrollTime);

        // Prevent the jump/flash
        return false;
    });
});
      $(document).ready(function() {
      $("#register_btn").click(function(){
			if( selectValidateOfficeUse() && selectValidateTypeOfBusiness() && firstNameValidation() && lastNameValidation() && emailValidation() && phonenumber()  && selectValidate() && selectValidateSource()){
				$("#sign-up-form").submit();
			}else{
				return false;
			}
		});
	});
</script>
</body>
</html>
