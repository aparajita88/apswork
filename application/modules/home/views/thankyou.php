<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Thanks You</title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lp_css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/lp_css/style.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1783118191901202');
fbq('track', "PageView");
fbq('track', 'Lead');</script>
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
<header id="star">
  <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 top"> <a href="http://sworks.co.in/" class="logo" target="_blank"><img src="<?php echo base_url();?>/assets/lp_images/logo.png" title="Welcome to #Smartclub" alt="" /></a>
    <ul class="contactinfo">
      <li><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<a href="tel:18008339675">1800 833 9675 ( Toll Free )</a></li>
      <li><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;<a href="mailto:info@sworks.co.in">info@sworks.co.in</a></li>
      <li><i class="fa fa-at" aria-hidden="true"></i>&nbsp;<a href="http://www.sworks.co.in" target="_blank">www.sworks.co.in</a></li>
    </ul>
    
  </div>
</header>
<section class="col-md-12 col-sm-12 col-xs-12 col-lg-12 banner">
	<div class="col-md-8 col-sm-8 col-xs-12 col-lg-8 center-block thnk" style="float:none">
  	<h1 class="">Thank you for your interest & time. <span>Your enquiry has been received, we will shortly get back to you.</span></h1>
    	<a href="<?php echo base_url();?>index.php/home/smartclubs" class="orangebtn_small">Back to the Offers page</a>
    </div>
</section>




<!--Scrip Section--> 
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --> 
<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<!--Scrip Section--> 
<script type="text/javascript">
	$(document).ready(function(){
		$('.toggle').click(function(){
			$('.slidetoggle').toggle( "slide" );
		})		
		
		$('.slidetoggle').hover(function(){ 
			mouse_is_inside=true; 
			}, function(){ 
			mouse_is_inside=false; 
		});
		
		$("body").mouseup(function(){ 
			if(! mouse_is_inside) $('.slidetoggle').hide("slide");
		});
		
		$('#myCarousel').carousel({
			interval: 3000,
			cycle: true
		})	
		
		 $('#myCarousel2').carousel({
			interval: 3000,
			cycle: true
		})

		 $('#myCarousel3').carousel({
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

</script>

<!-- Google Code for Conversions Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */ 
var google_conversion_id = 877662353; 
var google_conversion_language = "en"; 
var google_conversion_format = "3"; 
var google_conversion_color = "ffffff"; 
var google_conversion_label = "w8MPCNO4w2gQkaHAogM"; 
var google_remarketing_only = false; 
/* ]]> */ 
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/877662353/?label=w8MPCNO4w2gQkaHAogM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>
