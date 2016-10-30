<?php require_once BASEPATH."../assets/front/lib/header_with_picture.php" ?>   
  <input type="hidden" id="party_token" value="<?php echo $token; ?>" />
  <!-- Start banner -->
  <section id="inner"> 
    <div id="main-slide" class="carousel slide" >
      
      <!-- Carousel inner -->
      <div class="carousel-inner page-banner">
        <div class="page-bannerimginner">
          <div class="slider-content"></div>
        </div><!--/ page-bannerimginner end --> 
      </div><!-- Carousel inner end-->
      
    </div><!-- /carousel --> 
  </section>
  <!-- End banner --> 
  
 
  
  
  
  <!-- Start Hot Deals Section -->
  <div class="content-sec">
    <div class="container">
    
      <div class="row"> 
        <!--Start Breadcrumbs-->
        <div class=" col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb2">
              <li><a href="#">Home</a></li>
              <!--<li><a href="#">Library</a></li>-->
              <li><a href="#"><?php echo $type; ?></a></li>
              <li class="active"><?php echo $vendor_detail['userCompanyName']; ?></li>
            </ol>
        </div><!-- End Breadcrumbs --> 
      </div><!-- .row --> 
      
      
      <div class="row"> 
        
        
        <!--Start right-panel-->
        <div class=" col-sm-12 col-md-12 col-lg-12">
        
        <!--add-product-->
        <div class="row">
        <div class="col-lg-offset-2 col-lg-9 col-md-offset-1 col-md-10 col-sm-12">
              <div class="compareMd">
                <!--1-->
                <!--<div class="compareMdin compareMdin-success compareMdin-dismissible fade in" role="compare">
                <button class="close pull-right" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    <div class="compareMdinimg"><img src="images/brand/brand1.jpg" alt=""></div>
                    <div class="compareMdintext">Aliquam lorem ante</div>
                </div>
				<!--2-->
                <!--<div class="compareMdin compareMdin-success compareMdin-dismissible fade in" role="compare">
                <button class="close pull-right" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    <div class="compareMdinimg"><img src="images/brand/brand2.jpg" alt=""></div>
                    <div class="compareMdintext">Aliquam lorem ante</div>
                </div>
				<!--3-->
                <!-- <div class="compareMdin compareMdin-success compareMdin-dismissible fade in" role="compare">
                <button class="close pull-right" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                    <div class="compareMdinimg"><img src="images/brand/brand3.jpg" alt=""></div>
                    <div class="compareMdintext">Aliquam lorem ante</div>
                </div>
				<!--4-->
                <div class="compareMdin compareMdin-successlink fade in" role="compare"><a href="#" class="">Add Item</a></div>
                <div class="compareMdin compareMdin-successlink fade in" role="compare"><a href="#" class="">Add Item</a></div>
                <div class="compareMdin compareMdin-successlink fade in" role="compare"><a href="#" class="">Add Item</a></div>
                <div class="compareMdin compareMdin-successlink fade in" role="compare"><a href="#" class="">Add Item</a></div>
                <!--5-->
                <div class="compareMdin compareMdin-successlink fade in" role="compare"><a href="#" class="">Add Item</a></div>
				<!--6-->
                <div class="compareMdin-compare"><a href="#">Compare</a></div>
                <!--7-->
              </div>
        </div>
        </div>
        <!--add-product-end-->
         
         <!--form and photo slider part starts here-->
         <div class="green-panel">
         	<div class="green-panel-head">
           		<aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                	<h2><?php echo $vendor_detail['userCompanyName']; ?></h2>
                </aside>
                <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                	<p><i class="fa fa-map-marker"></i><?php echo $vendor_detail['town_nm'].', '.$vendor_detail['county_nm']; ?></p>
                </aside>
                <div class="clearfix"></div> 
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 blue-bg">
                	<aside class="col-xs-12 col-sm-8 col-md-8 col-lg-8 leftimg">
                    	<img class="img-responsive" src="<?php echo $vendor_detail['image']; ?>" alt="tortuga">
                    </aside>
                    <aside class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    	<div class="list-wrpaaer">
                             <ul class="list-aggregate" id="marquee-vertical">
                               <?php
                               foreach($all_product as $images){ 
									foreach($images['product_image'] as $image){
									$image = 
									base_url().'assets/uploads/images/thumbnails/'.$image['image'];
								?>
                               <li>
                               		<img src="<?php echo $image; ?>" 
                               		alt="image">
                               </li>
                               <?php 
									}
								} 
                               ?>
                             </ul>
                          </div>
                          <a href="#">See More Images</a>
                    </aside>
                    <div class="clearfix"></div>
               </div>
               <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               		<div class="venue-form">
                    	<h2><?php echo $type; ?> Rating</h2>
                        <aside class="col-xs-12 col-sm-8 col-md-8 col-lg-8 rating">
                        	<ul>
                            	<li>4.3</li>
                                <li><img src="images/rating.png" alt="rating"></li>
                            </ul>
                        </aside>
                        <aside class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        	<h3>10 Reviews</h3>
                        </aside>
                        <div class="clearfix"></div>
                        <div class="map">
                        	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387157.48218081944!2d-73.97968099999999!3d40.703312749999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1441013000038" width="100%" height="137" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="address">
                        	<p><!--<i class="fa fa-home" 
								style="float:left; padding-bottom:3px;"></i>--><img 
								src="images/home-icon.png" alt="home" style="float:left; 
								padding-bottom:11px;"><?php echo 
								$vendor_detail['address1'].', '.$vendor_detail['town_nm'].', '.$vendor_detail['county_nm'].', <br>'.$vendor_detail['country_nm']; ?><br><!--<i class="fa fa-phone"></i>--><img src="images/phone-icon.png" alt="phone">+1111-1111-111<br><!--<i class="fa fa-archive"></i>--><img src="images/web-icon.png" alt="website"><a href="#">www.hostmypartyz.com</a><br><!--<i class="fa fa-clock-o"></i>--><img src="images/time-icon.png" alt="time">
MON to SAT - 09:00 am to 11:00 pm, SUN - Closed</p>
                        </div>
                        <h2>Like & share us on social sites :</h2>
                        <div class="social-icons">
                        	<ul>
                            	<li><a href="#"><img class="img-responsive" src="images/facebook.png" alt="facebook"></a></li>
                                <li><a href="#"><img class="img-responsive" src="images/twitter.png" alt="twitter"></a></li>
                                <li><a href="#"><img class="img-responsive" src="images/gplus.png" alt="gplus"></a></li>
                                <li><a href="#"><img class="img-responsive" src="images/pnterest.png" alt="pinterest"></a></li>
                                <li><a href="#"><img class="img-responsive" src="images/youtube.png" alt="youtube"></a></li>
                            </ul>
                        </div>
                        <div class="tell-a-frnd">
                        	<h4>Tell a friend</h4>
                            <form class="form-inline">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email">
                                </div>
                                	<input type="submit" class="btn btn-default" value="Submit">   
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <button type="button" class="btn btn-primary btn-lg" name="enquiry">booking enquiry</button>
                        <button type="button" class="btn btn-primary btn-lg" name="book now">book now</button>
                    </div>
               </div>
            <div class="clearfix"></div>
         </div>
         <!--form and photo slider part starts here-->
		<div class="clearfix"></div>
        
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 about">
        	<h2>about</h2>
            <?php echo $vendor_detail['businessDesc'] ?> 
        </div>
        <div class="clearfix"></div>
        
        
        <!--brand-panel-1-->
        	<div class="servicepanel panel-default2">
            	<h2>services offered</h2>
              <!-- Table -->
              <div class="table-responsive">
              <table class="table table-striped tblmrgn"> 
                <tbody>
				 <?php $count=0; foreach($all_product as $value){ 
					 $count++; if($count>6){break;} ?>
                  <tr class="">
                    <td>
                    	<h4><a href="#" data-target="#myModal3" 
                    	data-toggle="modal" 
                    	onclick="getServiceDetails('<?php echo 
                    	base64_encode(base64_encode($value['id'])); ?>');"><?php echo $value['product_name']; ?></a></h4> 
                    </td>
                    <td align="center">
                    	<a href="#"><img src="images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span 
                    	class="text-them-red paddingR-20"> <?php echo 
                    	$value['discount']; ?>%</span> <input 
                    	name="amount" type="button" value="From $ 
                    	<?php echo $value['min_prize']; ?>" class="btn btn-black" ></div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <?php if($count>6){ ?>
                  <tr>
                    <th colspan="3"><div id="loadMore4" class="btn btn-lg btn-block button">SHOW ALL</div></th>
                  </tr>
                  <?php } ?>
                </tfoot>
              </table>
             <!--modal3 -->
			<div id="myModal3" class="modal fade" role="dialog">
			  <div class="modal-dialog" >
				<!-- Modal content-->
				<div class="modal-content" id="serviceDetailModal">
					
				</div>
			  </div>
			</div>
            </div>
            </div>
        <!--brand-panel-1-end-->
        
        <!--left panel starts here-->
        <div class="col-sm-3 col-md-3 col-lg-3 rating-review">
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">submit your rating & review</button>

            <!-- Modal -->
            <div id="myModal2" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Submit Your Rating & Review</h4>
                  </div>
                  <div class="modal-body">
                    <p>Submit your rating</p>
                    <img src="images/white-star.png" alt="stars">
                    <div class="clearfix"></div>
					<h3>Write a Review</h3>
                    <textarea class="form-control" cols="5" rows="3"></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default">Submit</button>
                  </div>
                </div>
            
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="panel-group" id="FavouriteL">
        <div class="panel panel-default">
        <div class="panel-heading">
        	<h3 class="panel-title2 pull-left">Favourite List </h3>
            <div class="clear"><a href="#">Show All</a></div>
        </div>
        <div class="panel-body">
        	<!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2>Vivamus elementum</h2>
                <h6><img src="images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <!--1-->
            
            <hr>
            
        </div>
        </div>
        </div>
        </div>
        <!--left panel ends here-->
        
        <!--right panel starts here-->
        <div class="col-sm-9 col-md-9 col-lg-9 reviews">
        	<div class="head">
            	<aside class="col-sm-8 col-md-8 col-lg-8">
                	<h3><a href="#">view all the reviews</a></h3>
                </aside>
                <aside class="col-sm-4 col-md-4 col-lg-4">
                	<p>10 Reviews</p>
                </aside>
                <div class="clearfix"></div>
            </div>
            <div class="review-cont">
                	<aside class="col-sm-2 col-md-1 col-lg-1 review-cont-img"><img src="images/speaker.png" alt=""></aside>
                    <aside class="col-sm-10 col-md-11 col-lg-11 review-cont-text">
                    	<h2>John Doe</h2>
                        <h6>1st Aug, 2015</h6>  
                        	<a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                            <div class="clearfix"></div>
                        <div class="reviewtxt">
                            <h3>Lorem ipsum dolor sit amet</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean com odo ligula egetdolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                        </div>
                    </aside>
                    <div class="clearfix"></div>
                </div>
                <div class="review-cont">
                	<aside class="col-sm-2 col-md-1 col-lg-1 review-cont-img"><img src="images/speaker.png" alt=""></aside>
                    <aside class="col-sm-10 col-md-11 col-lg-11 review-cont-text">
                    	<h2>John Doe</h2>
                        <h6>1st Aug, 2015</h6>  
                        	<a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                            <div class="clearfix"></div>
                        <div class="reviewtxt">
                            <h3>Lorem ipsum dolor sit amet</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean com odo ligula egetdolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                        </div>
                    </aside>
                    <div class="clearfix"></div>
                </div>
                <div class="review-cont">
                	<aside class="col-sm-2 col-md-1 col-lg-1 review-cont-img"><img src="images/speaker.png" alt=""></aside>
                    <aside class="col-sm-12 col-md-11 col-lg-11 review-cont-text">
                    	<h2>John Doe</h2>
                        <h6>1st Aug, 2015</h6>  
                        	<a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star1.png" alt=""></a><a href="#"><img src="images/ico/ico-star2.png" alt=""></a>
                            <div class="clearfix"></div>
                        <div class="reviewtxt">
                            <h3>Lorem ipsum dolor sit amet</h3>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean com odo ligula egetdolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                        </div>
                    </aside>
                    <div class="clearfix"></div>
                </div> 
        </div>
        <!--right panel ends here-->
        <div class="clearfix"></div>

        
            
			
        </div><!-- End right-panel ---------------------------- --> 
      </div><!-- .row --> 


      
    </div><!-- .container --> 
  </div>
  <!-- End Hot Deals Section --> 
  
  
<?php require_once BASEPATH."../assets/front/lib/footer.php" ?>   
  
</div>
<!-- End Full Body Container --> 

<!-- Go To Top Link --> 
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
<div id="loader">
  <div class="spinner">
    <div class="dot1"></div>
    <div class="dot2"></div>
  </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-body">
      	<h2>Login</h2>
         <div class="full-2 mr1">
            <input type="text" id="" class="button-poup" placeholder="Email">
          </div>
     	 <div class="full-2 mr1">
      		<input  type="password" id="" class="button-poup" placeholder="Password">
      	</div>
      	<div class="full-2 mr2">
        	<div class=" login-1">
            	<button type="button" class="btn btn-primary">Login</button>
            </div>
            <div class="login-2 mr1">
            	<a href="#">Forgot Password?</a>
            </div>
        </div> 
      </div>
      
      <div class="modal-footer">
      	<div class="full-2 mr2">
        	<p>Login with your social account</p>
        </div>
       	<div class="full-2 mr2">
      	<div class="popup-img">
        	<img src="images/fb.png" alt="">
        </div>
        <div class="popup2-img">
        	<img src="images/g+.png" alt="">
        </div>
      </div>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  
  $(function(){


  $('#marquee-vertical').marquee();  
  
});

</script>
</body>
</html>
