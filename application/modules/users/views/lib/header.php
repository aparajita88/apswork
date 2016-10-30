<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en" itemscope itemtype="http://schema.org/Article">

<head>
<title>HostMyPartyz | Registration</title>

<!-- Define Charset -->
<meta charset="utf-8">

<!-- Responsive Metatag -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description" content="HostMyPartyz - Responsive HTML5 Template">
<meta name="author" content="iThemesLab">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/asset/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style1.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/responsive.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.css" media="screen">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />


<!-- HostMyPartyz JS  -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script><!--es-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.migrate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modernizrr.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/asset/js/bootstrap.min.js"></script><!--es-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/nivo-lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/count-to.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.textillate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.lettering.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.parallax.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mediaelement-and-player.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/facebook.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/googlePlus.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ads.js" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<!-- BEGIN Pre-requisites -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
  </script>
  <script src="https://apis.google.com/js/client:platform.js?onload=start" async defer>
  </script>
  <!-- END Pre-requisites -->


<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<script>
	jQuery(function($){
		$(window).load(function(){

			$("#VendorD .panel-body").mCustomScrollbar({
				setHeight:200,
				theme:"dark-3"
			});
			
			//load more
			/*****************2***/
			jQuery(document).ready(function(){
			// jQuery('#newsmyList li:lt(3)').show();//alert("ss");
			// jQuery('#newsloadMore').click(function () {
			// jQuery('#newsmyList li:lt(5)').show();
			// });
				
				size_li = jQuery("#tab-pane .loadr").size();
				x=3;
				jQuery('#tab-pane .loadr:lt('+x+')').show();
				jQuery('#loadMore').click(function () {
					//jQuery(".loadr").fadeIn("slow");
				//jQuery('#loadMore-loader').show(1000, function(){
					x= (x+1 <= size_li) ? x+1 : size_li;
					jQuery('#tab-pane .loadr:lt('+x+')').fadeIn(1000);
				if(x == size_li){
					jQuery('#loadMore').hide();
					jQuery('#showLess').show();
				}
					//jQuery('#loadMore-loader').hide();
				//});
				});
			});
			
			
			
		});
	});
	
	$(document).ready(function()
{

$(".account").click(function()
{
var X=$(this).attr('id');
if(X==1)
{
$(".submenu").hide();
$(this).attr('id', '0');
}
else
{
$(".submenu").show();
$(this).attr('id', '1');
}

});

//Mouse click on sub menu
$(".submenu").mouseup(function()
{
return false
});

//Mouse click on my account link
$(".account").mouseup(function()
{
return false
});


//Document Click
$(document).mouseup(function()
{
$(".submenu").hide();
$(".account").attr('id', '');
});
});
	
//checkout - custom select box******************************************
jQuery(document).ready(function(){
	jQuery(".custom-select").each(function(){
		jQuery(this).wrap("<span class='select-wrapper'></span>");
		jQuery(this).after("<span class='holder'></span>");
	});
	jQuery(".custom-select").change(function(){
		var selectedOption = jQuery(this).find(":selected").text();
		jQuery(this).next(".holder").text(selectedOption);
	}).trigger('change');
	
	jQuery(".custom-select2").each(function(){
		jQuery(this).wrap("<span class='select-wrapper'></span>");
		jQuery(this).after("<span class='holder'></span>");
	});
	jQuery(".custom-select2").change(function(){
		var selectedOption = jQuery(this).find(":selected").text();
		jQuery(this).next(".holder").text(selectedOption);
	}).trigger('change');
	
});


</script>


</head>

<body>

<!-- Full Body Container -->
<div id="container"> 
  
  <!-- Start Header Section -->
  <div class="hidden-header"></div>
  <header class="clearfix"> 
	 <?php if(isset($profData)){ ?>
		<div class="container">
    <div class="row">
      <div class="col-xs-8 col-sm-4 col-md-3 col-lg-3 logo_img"> <a  href="<?php echo base_url(); ?>"> <img alt="" src="<?php echo base_url(); ?>assets/images/logo-new.png"> </a> </div>
      <div class="col-xs-4 col-sm-8 col-md-9 col-lg-9 right1 ">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <i class="fa fa-bars"></i> </button>
        <div class="navbar-collapse collapse">
          <ul class="for_account pull-right">
			<!--<p>Welcome John!</p>-->
			<div class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $profData[0]['FirstName']; ?>!<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li ><a href="<?php echo base_url().'index.php/users/userLogout'; ?>">Sign Out</a></li>
					</ul>
			</div>
			<img src="<?php echo $profData[0]['image']; ?>" class="img-circle" alt="" />
		  </ul>  
          <ul class="for_alert pull-right">
            <img src="<?php echo base_url(); ?>assets/images/msg.png" alt="" /> <a>4</a>
          </ul>
          <ul class="for_nav pull-right">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="#" class="active">Saved Vendors</a></li><!-- index.html -->
          </ul>
          <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
	<?php } else{ ?>    
    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="container clsshowH1">
        <div class="row">
        
          <div class="col-sm-6 col-md-6"> 
            <!-- Start Contact Info -->
            <ul class="breadcrumb">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
            <!-- End Contact Info --> 
          </div><!-- .col-md-6 --> 
          <div class="col-sm-6 col-md-6">
          		<ul class="headrlink">
                	<!--<li> <span>6</span><a href="#">Wishlist</a></li>-->
                	<li class="phno">Call Us at <strong>1800-111-1234</strong></li>
                </ul>
          		<!--<div><a href="#">Wishlist</a></div>
           		<div class="phno">Call Us at <strong>1800-111-1234</strong></div>-->
          </div><!-- .col-md-6 --> 
          
        </div><!-- .row --> 
      </div><!-- .container --> 
    </div>
    <!-- End Top Bar --> 

		
    <!-- Start  Logo & Naviagtion  -->
    <div class="navbar navbar-default navbar-top">
      <div class="container">
        <div class="navbar-top-bg">
          <div class="navbar-header"> 
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <i class="fa fa-bars"></i> </button>
            <!-- End Toggle Nav Link For Mobiles --> 
            <a class="navbar-brand" href="<?php echo base_url(); ?>"> <img alt="" src="<?php echo base_url(); ?>assets/images/logo-new.png"> </a> </div>
            <div class="navbar-collapse collapse">

           
            <div class="navbar-right padding1" style=" position:relative;"> 
                <div class=" btn-rightlg">
                   <!-- <button type="button" class="btn btn-default"><i class="fa fa-lock"></i> Login</button>
                    <button type="button" class="btn btn-info"><i class="fa fa-pencil"></i> Sign Up</button>-->
                    <a href="#" class="btn btn-default btn-lg poup-boxColer" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock"></i> Login</a>
                    <a href="<?php echo base_url().'index.php/users/registration'; ?>" class="btn btn-info btnnew"><i class="fa fa-pencil"></i> Sign Up</a>
                </div>
                
              <div class="vendorD"><a href="#">Become<br><strong>a Vendor</strong></a></div> <!--html/index-vendor-registration.html-->
            </div>
            
            
            <div class="col-sm-12 col-md-6 wid502Pd"><!--search-->
          	<div class="input-group margin-top2">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default wid502" >
                    	 <!--<i class="fa fa-map-marker"></i>--><img alt="icon" src="<?php echo base_url(); ?>assets/images/map-icon.png"> <span id="search_concept2"> <span>New York, City, Zip Code</span></span>
                    </button>
                    <!--<ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than ></a></li>
                      <li><a href="#less_than">Less than < </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>
                    </ul>-->
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control wid50s2" name="x" placeholder=" Vendor Type">
                <span class="input-group-btn">
                    <a class="btn btn-info btnHigt2" href="#"> Search</a>
                </span>
            </div>
            </div>
          
            <!--mobile-menu-->
			<div class="container clsshowH2">
            <div class="row">
              <div class="clearfix"></div>
              <div class="col-md-6"> 
                <!-- Start Contact Info -->
                <ul class="breadcrumb">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul><!-- End Contact Info --> 
              </div><!-- .col-md-6 --> 
              <div class="col-md-6"> 
              		<ul class="headrlink ">
                        <li> <span>6</span><a href="#">Wishlist</a></li>
                        <li class="phno">Call Us at <strong>1800-111-1234</strong></li>
                    </ul>
                    <!--<div class="phno">Call Us at <strong>1800-111-1234</strong></div>-->
              </div><!-- .col-md-6 --> 
            </div><!-- .row --> 
			</div>
      		<!--mobile-menu-end-->
            
          </div><!--collapse-->
        </div>
      </div>
    </div>
    <!-- End Header Logo & Naviagtion --> 
    <?php } ?>
  </header>
  <!-- End Header Section --> 
