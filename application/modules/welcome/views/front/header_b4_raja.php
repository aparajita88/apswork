<!DOCTYPE HTML>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>TelefoneDeal</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Js url -->
<script type="text/javascript" language="javascript">
	var js_site_url='<?php echo $this->config->item('base_url');?>index.php/';
</script>
<!-- Js url --> 

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<link href="<?php echo $this->config->item('base_url');?>assets/front/fonts/stylesheet.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/front/css/font-awesome.css">

<link href="<?php echo $this->config->item('base_url');?>assets/front/css/jquery.bxslider.css" rel='stylesheet' type='text/css'>
<link href="<?php echo $this->config->item('base_url');?>assets/front/css/owl.carousel.css" rel='stylesheet' type='text/css'>
<link href="<?php echo $this->config->item('base_url');?>assets/front/css/bootstrap.css" rel='stylesheet' type='text/css'>
<link href="<?php echo $this->config->item('base_url');?>assets/front/css/telefonedeal.css"  rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/front/css/component.css" /><!--mega-menu-->
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/front/css/project.css" />

<script src="<?php echo $this->config->item('base_url');?>assets/front/js/jquery-1.11.3.min.js" type="text/javascript"></script>

<script src="<?php echo $this->config->item('base_url');?>assets/front/js/modernizr.custom.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/front/js/jquery.bxslider.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/front/js/owl.carousel.js" type="text/javascript"></script>

<script src="<?php echo $this->config->item('base_url');?>assets/front/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/front/js/stickUp.min.js" type="text/javascript"></script>

<!-- core CSS-Rs.-slider-bar -->
<link href="<?php echo $this->config->item('base_url');?>assets/front/css/bootstrap-slider.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/js/bootstrap-slider.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/js/modernizr2.js"></script>-->
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/js/three.min.js"></script>
<!--CustomScrollbar-->
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/front/css/jquery.mCustomScrollbar.css">
<script src="<?php echo $this->config->item('base_url');?>assets/front/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>

<script>
	jQuery(function($){
		$(window).load(function(){

			$("#brand .panel-body").mCustomScrollbar({
				setHeight:200,
				theme:"dark-3"
			});
			
			$("#accordion .panel-body").mCustomScrollbar({
				setHeight:250,
				theme:"dark-3"
			});
			
			/*jQuery('#accordion .panel-heading a[data-toggle="collapse"]').on('click', function () {   
				jQuery('#accordion .panel-heading a[data-toggle="collapse"]').removeClass('actives');
				$(this).addClass('actives');
			 });*/
			 jQuery('#accordion .panel-heading a[data-toggle="collapse"]').on('click', function () {   
				jQuery('#accordion .panel-heading a[data-toggle="collapse"]').removeClass('actives');
				$(this).addClass('collapse');
				jQuery('#accordion .panel-heading a[data-toggle="collapse"]').addClass('actives');
				$(this).removeClass('collapse');
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
</script>



<!--zoom-products-view-->

    
</head>

<body>

<!--header-->
<header> 
  
  <!--top-->
  <div class="telefonedeal-top-bar" id="telefonedeal-top-bar">
    <div class="container">
      <div class="subheader">
        <div class="pull-right"> <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/about_us.png" alt=""></a> | <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/contact-us.png" alt=""></a> | <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/carrer1.png" alt=""></a> | <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/cc.png" alt=""></a> | <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/for_sale2.png" alt=""></a> | <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/ico-signup.png" alt=""></a> | <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/ico-login.png" alt="15"></a> </div>
      </div>
    </div>
  </div>
  
<div class="telefonedeal-top-bar" id="telefonedeal-top">
    <div class="container">
    <div class="row"> 
        <div class="subheader">
            <div class="pull-right"> 
            <a href="#">About Us</a> | <a href="#">Contact Us</a> | <a href="#">Careers</a> | <a href="#">24x7 Customer Care</a> | <a target="_blank" href="<?php echo $this->config->item('base_url');?>index.php/users/admin/sellerlogin">Sell</a> | 
            <?php if($this->session->userdata('')!=""){ ?> <a class="btn btn-launch" href="javascript:;" data-toggle="modal" data-target="#loginModal"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/ico-signup.png" alt="Signup"> Logout</a> 
            <?php }else{ ?>
            <a class="btn btn-launch" href="javascript:;" data-toggle="modal" data-target="#loginModal"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/ico-signup.png" alt="Signup"> Signup</a> | <a class="btn btn-launch" href="javascript:;" data-toggle="modal" data-target="#loginModal"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/ico-login.png" alt="Login"> Login</a>
            <?php } ?> 
            </div>
        </div>
    </div>
    </div>
</div>
        
  <!--middle-->
  <div class="telefonedeal-top-menu stuckMenu">
    <div class="container">
      <div class="row"> 
        
        <!-- Static navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="row">
          <!--container-->
            <div class="navbar-header col-lg-2 col-md-2 col-sm-2">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <div class=""><a href="<?php echo $this->config->item('base_url');?>" class="navbar-brand"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/logo.png" alt="Telefone Deal" title="Telefone Deal" /></a></div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <form class="navbar-form navbar-left formsearch" role="search">
                <div class="form-group searchDiv">
                  <input type="search" class="form-control" placeholder="Search by Product, Category">
                  <button type="submit" class="btn button_search">Search</button>
                </div>
              </form>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
            		<?php if($this->uri->segment(1) != 'cart'): ?>
                			<a href="<?php echo $this->config->item('base_url');?>index.php/cart"><div class="cartd">
                				<!--<input name="" type="text" value="0" class="cartValue">-->
                				<div class="cartValue"><?php echo $rows = count($this->cart->contents()); ?></div>
                				<span>Cart</span>
              				</div></a>
                	<?php endif;?>
            </div>
           </div>
           <!--/.container-fluid --> 
          
        </div>
        <!--/.navbar --> 
        
      </div>
    </div>
    <!-- /container --> 
  </div>
  
  <!--bottom-->
  <div class="telefonedeal-bottom-bar">
    <div class="container">
      <div class="row">
      

        <!--/.nav-collapse -->
        <nav id="cbp-hrmenu" class="cbp-hrmenu navbar-collapse collapse">
            <ul>
				<?php
					$menuArr=generate_top_menu();
					if($menuArr)
					{
						foreach($menuArr as $menkey=>$menVal)
						{ 
				?>
							<li>
								<a href="<?php echo $this->config->item('base_url');?>index.php/products/getCatProducts/<?php echo $menVal['productCategoryId']; ?>"><?php /*<img src="<?php echo $this->config->item('base_url');?>assets/front/images/arro-slid.png" alt=""> */ ?><?php echo ucwords($menVal['productCategoryName']).'&nbsp;'; ?><i class="fa fa-angle-down"></i></a>
								<div class="cbp-hrsub cbp-hrsub-Mobiles">
                        <div class="cbp-hrsub-inner">
                        <?php
                        	if($menVal['Brands'])
                        	{
                        ?>
                        	<div>
                                <h4>Brands</h4>
                                <ul>
                                <?php
                                		foreach($menVal['Brands'] as $bndKey=>$bndVal)
                                		{
                                ?>
                                    <li><a href="<?php echo $this->config->item('base_url');?>index.php/products/getProducts/<?php echo $menVal['productCategoryId']; ?>/<?php echo $bndVal['productBrandId']; ?>"><?php echo ucwords($bndVal['productBrandName']); ?></a></li>
                                <?php
                                		}
                                ?>
                                </ul>
                            </div>
                        <?php
                        	}
                        	
                        	if($menVal['Categories'])
                        	{
                        		foreach($menVal['Categories'] as $categoryKey=>$categoryVal)
                        		{
                        ?>
                        		<div>
                                <h4><?php echo ucwords($categoryVal['productCategoryName']); ?></h4>
                                <ul>
                                <?php
                                		if($categoryVal['Sub'])
                                		{
                                			foreach($categoryVal['Sub'] as $subCategoryKey=>$subCategoryVal)
                                			{
                                ?>
                                    		<li><a href="<?php echo $this->config->item('base_url');?>index.php/products/getCatProducts/<?php echo $subCategoryVal['productCategoryId']; ?>"><?php echo ucwords($subCategoryVal['productCategoryName']); ?></a></li>
                                <?php
                                			}
                                		}
                                ?>
                                </ul>
                            	</div>
                        <?php
                        		}
                        	}
                        ?>
                        </div>
                        </div>
							</li>		
				     
				<?php
						}
					}
				?>       
            
                
            </ul>
            <div class="social navbar-right"> <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/social-fb.png" alt=""></a> <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/social-tw.png" alt=""></a> <a href="#"><img src="<?php echo $this->config->item('base_url');?>assets/front/images/social-g+.png" alt=""></a> </div>
        </nav>
        
        
      </div><!--row-->
    </div><!--container-->
  </div>
</header>
<!--header-end--> 


  <!-- -Login Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form id="frontLogFrm" name="frontLogFrm" method="post">
	    	<div class="modal-content login-modal">
	      		<div class="modal-header login-modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title text-center" id="loginModalLabel">USER AUTHENTICATION</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="text-center">
		      			<div role="tabpanel" class="login-tab">
						  	<!-- Nav tabs -->
						  	<ul class="nav nav-tabs" role="tablist">
						    	<li role="presentation" class="active"><a id="signin-taba" href="#home" aria-controls="home" role="tab" data-toggle="tab">Sign In</a></li>
						    	<li role="presentation"><a id="signup-taba" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>
						    	<li role="presentation"><a id="forgetpass-taba" href="#forget_password" aria-controls="forget_password" role="tab" data-toggle="tab">Forget Password</a></li>
						  	</ul>
						
						  	<!-- Tab panes -->
						 	<div class="tab-content">
						    	<div role="tabpanel" class="tab-pane active text-center" id="home">
						    		&nbsp;&nbsp;
						    		<span id="login_fail" class="response_error" style="display: none;">Loggin failed, please try again.</span>
						    		<div class="clearfix"></div>
						    		
										<div class="form-group">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
									      		<input type="text" class="form-control" id="emailId" name="emailId" placeholder="Username">
									    	</div>
									    	<span class="help-block has-error" id="email-error"></span>
									  	</div>
									  	<div class="form-group">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-lock"></i></div>
									      		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
									    	</div>
									    	<span class="help-block has-error" id="password-error"></span>
									  	</div>
							  			<button onclick="forntLogin()" type="button" id="login_btn" class="btn btn-block bt-login" data-loading-text="Signing In....">Login</button>
							  			<div class="clearfix"></div>
							  			<div class="login-modal-footer">
							  				<div class="row">
												<div class="col-xs-8 col-sm-8 col-md-8">
													<i class="fa fa-lock"></i>
													<a href="javascript:;" class="forgetpass-tab"> Forgot password? </a>
												
												</div>
												
												<div class="col-xs-4 col-sm-4 col-md-4">
													<i class="fa fa-check"></i>
													<a href="javascript:;" class="signup-tab"> Sign Up </a>
												</div>
											</div>
							  			</div>
									
						    	</div>
						    	<div role="tabpanel" class="tab-pane" id="profile">
						    	    &nbsp;&nbsp;
						    	    <span id="registration_fail" class="response_error" style="display: none;">Registration failed, please try again.</span>
						    		<div class="clearfix"></div>
						    		
										<div class="form-group">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
									      		<input type="text" class="form-control" id="username" placeholder="Username">
									    	</div>
									    	<span class="help-block has-error" data-error='0' id="username-error"></span>
									  	</div>
									  	<div class="form-group">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-at"></i></div>
									      		<input type="text" class="form-control" id="remail" placeholder="Email">
									    	</div>
									    	<span class="help-block has-error" data-error='0' id="remail-error"></span>
									  	</div>
							  			<button type="button" id="register_btn" class="btn btn-block bt-login" data-loading-text="Registering....">Register</button>
										<div class="clearfix"></div>
										<div class="login-modal-footer">
							  				<div class="row">
												<div class="col-xs-8 col-sm-8 col-md-8">
													<i class="fa fa-lock"></i>
													<a href="javascript:;" class="forgetpass-tab"> Forgot password? </a>
												
												</div>
												
												<div class="col-xs-4 col-sm-4 col-md-4">
													<i class="fa fa-check"></i>
													<a href="javascript:;" class="signin-tab"> Sign In </a>
												</div>
											</div>
							  			</div>
									
						    	</div>
						    	<div role="tabpanel" class="tab-pane text-center" id="forget_password">
						    		&nbsp;&nbsp;
						    	    <span id="reset_fail" class="response_error" style="display: none;"></span>
						    		<div class="clearfix"></div>
						    		
										<div class="form-group">
									    	<div class="input-group">
									      		<div class="input-group-addon"><i class="fa fa-user"></i></div>
									      		<input type="text" class="form-control" id="femail" placeholder="Email">
									    	</div>
									    	<span class="help-block has-error" data-error='0' id="femail-error"></span>
									  	</div>
									  	
							  			<button type="button" id="reset_btn" class="btn btn-block bt-login" data-loading-text="Please wait....">Forget Password</button>
										<div class="clearfix"></div>
										<div class="login-modal-footer">
							  				<div class="row">
												<div class="col-xs-6 col-sm-6 col-md-6">
													<i class="fa fa-lock"></i>
													<a href="javascript:;" class="signin-tab"> Sign In </a>
												
												</div>
												
												<div class="col-xs-6 col-sm-6 col-md-6">
													<i class="fa fa-check"></i>
													<a href="javascript:;" class="signup-tab"> Sign Up </a>
												</div>
												</div>
												
							  			</div>
									
									
						    	</div>
						    	<div class="row">
												<div class="modal-footer">
                   						 <div class="full-2 mr2">
      											<div class="popup-img">
        											<img src="<?php echo $this->config->item('base_url'); ?>assets/front/images/fb.png" alt="">
        											</div>
        											<div class="popup2-img">
        											<img src="<?php echo $this->config->item('base_url'); ?>assets/front/images/g+.png" alt="">
        											</div>
     											 </div>
     											 </div>
											</div>
						  	</div>
						</div>
	      				
	      			</div>
	      		</div>
	      		
	    	</div>
	    	</form>
	   </div>
 	</div>
 	
 	<!-- - Login Model Ends Here -->
 	<script>
	    jQuery(document).ready(function(){
	    	jQuery(document).on('click','.signup-tab',function(e){
	    		 e.preventDefault();
	    		 jQuery('#signup-taba').tab('show');
	    	});	
	
	    	jQuery(document).on('click','.signin-tab',function(e){
	    		 e.preventDefault();
	    		 jQuery('#signin-taba').tab('show');
	    	});
	    	
	    	jQuery(document).on('click','.forgetpass-tab',function(e){
	    		 e.preventDefault();
	    		 jQuery('#forgetpass-taba').tab('show');
	    	});
	    });	
    </script>

        
