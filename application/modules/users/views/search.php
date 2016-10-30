<?php require_once BASEPATH."../assets/front/lib/header_with_picture.php" ?>
<input type="hidden" id="user_token" value="<?php echo $user_id; ?>" />  
<input type="hidden" id="party_token" value="<?php echo $token; ?>" />
<input type="hidden" id="vendorType" value="<?php echo $vendorType; ?>" />
<input type="hidden" id="location" value="<?php echo $location; ?>" />
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
              <li class="active">Search</li>
            </ol>
        </div><!-- End Breadcrumbs --> 
      </div><!-- .row --> 
      
      
      <div class="row"> 
        <!--Start left-panel-->
        <div class=" col-sm-3 col-md-3 col-lg-3">
        
        <!--Vendor-->
        <div class="panel-group" id="VendorD">
        <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title2">Vendor Type</h3>
          <!--<div class="clear"><a href="#">Clear</a></div>-->
        </div>
        <div class="panel-body">
            <form>
            <div class="VendorD">
				<?php 
				if(isset($service) && !empty($service)){
					foreach($service as $key => $value){ 
				?>
					<div class="radio">
						<input id="Venue<?php echo $key; ?>" type="radio" class="services" onclick="getSubServiceforSearch()" name="Venue" value="<?php echo $value['productCategoryId']; ?>">
						<label for="Venue<?php echo $key; ?>"><span><span></span></span><?php echo $value['productCategoryName']; ?></label>
					</div>
				<?php 
					}
				}
				 ?>
            </div>
            </form>
        </div>
        </div>
        </div>
        
        <div id="subServices" class="panel panel-default">
		</div>
          
           <!--location-->
           <div class="panel panel-default  margin-botm0">
            <!--<div class="panel-heading">
              <h3 class="panel-title2 pull-left">Price <i class="fa fa-inr"></i></h3>
              <div class="clear"><a href="#">Clear</a></div>
            </div>-->
            <div class="panel-body">
              <form>
                <div class="form-group margin-botm0">
                  <div class="row">
                    <div class="col-md-12">
                      <!--<label for="exampleInputfrom">From</label>-->
                      <input type="text" class="form-control col-md-12 locationpin" id="exampleInputfrom" placeholder="New York" onkeyup="doFilter();">
                    </div>
                    <div class="col-md-12">
                       <select name="timepass" id="distance" class="custom-select form-control" onchange="doFilter();">
                            <option value="">Please Select</option>
                            <option value="10">1-10 miles</option>
                            <option value="20">10-20 miles</option>
                            <option value="30">20-30 miles</option>              
                        </select>
                    </div>
                  </div>
                </div>
              </form>
              
            </div><!--panel-body--> 
          </div>
          
          <!--location-->
          <form>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                   <select name="timepass" id="party_size" class="custom-select form-control" onchange="doFilter();">
                        <option value="">Party Size</option>
                        <option value="10">Upto 10</option>
						<option value="20">Upto 20</option>
						<option value="50">Upto 50</option>
						<option value="100">Upto 100</option>
						<option value="200">Upto 200</option>             
                    </select>
                </div>
              </div>
            </div>
          </form>
          
         <!--Budget -->
         <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title2 pull-left">Budget $ </h3>
              <div class="clear"><a href="Javascript:void(0)" onclick="selectAllCheckbox('budget-checkbox'), doFilter();">Select all</a> | <a href="Javascript:void(0)" onclick="unSelectAllCheckbox('budget-checkbox');">Clear</a></div>
            </div>
            <div class="panel-body">
              <form>
                <div class="listingP">
                  <div class="checkbox">
                      <input id="check001" class="budget-checkbox" type="checkbox" name="check" value="0-1000" onclick="doFilter();">
                      <label for="check001"><span></span>1000 & below</label>
                  </div>
                  <div class="checkbox">
                    <input id="check002" class="budget-checkbox" type="checkbox" name="check" value="1000-2000" onclick="doFilter();">
                    <label for="check002"><span></span>1,000 - 2,000</label>
                  </div>
                  <div class="checkbox">
                    <input id="check003" class="budget-checkbox" type="checkbox" name="check" value="2000-3000" onclick="doFilter();">
                    <label for="check003"><span></span>2,000 - 3,000</label>
                  </div>
                  <div class="checkbox">
                    <input id="check004" class="budget-checkbox" type="checkbox" name="check" value="3000-4000" onclick="doFilter();">
                    <label for="check004"><span></span>3,000 - 4,000</label>
                  </div>
                  <div class="checkbox">
                    <input id="check005" class="budget-checkbox" type="checkbox" name="check" value="5000-0" onclick="doFilter();">
                    <label for="check005"><span></span>5,000 & above</label>
                  </div>
                </div>
                </form>
              
            </div><!--panel-body--> 
          </div>
          
          <!--Featured Vendors-->
          <div class="panel panel-default">
            <div class="panel-heading">Featured Vendors</div>
            <div class="panel-body">
              <div class="featured_vendors">
              
                <div class="item">
                <div class="box6">
                
                	<div class="box6-col"><!--box6-col-1-->
                    <!--1-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb1.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Vendor Name</div>
                    </div> <!--featuredV-->
                    <!--2-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb3.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Decorator</div>
                    </div> <!--featuredV-->
                    <!--3-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb5.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Venue</div>
                    </div> <!--featuredV-->
                 	</div> <!--box6-col-1-->
                    <div class="box6-col"><!--box6-col-2-->
                    <!--1-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb2.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Venue</div>
                    </div> <!--featuredV-->
                    <!--2-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb4.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Florists</div>
                    </div> <!--featuredV-->
                    <!--3-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb6.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Photography</div>
                    </div> <!--featuredV-->
                 	</div> <!--box6-col-2-->
                    
                </div> <!--box6--> 
                </div><!--item-->
                
                
                <div class="item">
                <div class="box6">
                
                	<div class="box6-col"><!--box6-col-1-->
                    <!--1-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb1.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Vendor Name</div>
                    </div> <!--featuredV-->
                    <!--2-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb3.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Decorator</div>
                    </div> <!--featuredV-->
                    <!--3-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb5.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Venue</div>
                    </div> <!--featuredV-->
                 	</div> <!--box6-col-1-->
                    <div class="box6-col"><!--box6-col-2-->
                    <!--1-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb2.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Venue</div>
                    </div> <!--featuredV-->
                    <!--2-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb4.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Florists</div>
                    </div> <!--featuredV-->
                    <!--3-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb6.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Photography</div>
                    </div> <!--featuredV-->
                 	</div> <!--box6-col-2-->
                    
                </div> <!--box6--> 
                </div><!--item-->
                
                
                <div class="item">
                <div class="box6">
                
                	<div class="box6-col"><!--box6-col-1-->
                    <!--1-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb1.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Vendor Name</div>
                    </div> <!--featuredV-->
                    <!--2-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb3.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Decorator</div>
                    </div> <!--featuredV-->
                    <!--3-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb5.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Venue</div>
                    </div> <!--featuredV-->
                 	</div> <!--box6-col-1-->
                    <div class="box6-col"><!--box6-col-2-->
                    <!--1-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb2.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Venue</div>
                    </div> <!--featuredV-->
                    <!--2-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb4.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Florists</div>
                    </div> <!--featuredV-->
                    <!--3-->
                    <div class="featuredV">
                      <div class="featuredV-img"><img src="<?php echo base_url(); ?>assets/images/thumb-s/thumb6.png" alt=""></div>
                      <div class="text-center"><button type="button" class="btn btn-redmini featuredV-btn">Vendor Name</button></div>
                      <div class="clearfix text-center">
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                      </div>
                      <div class="featuredV-text">Photography</div>
                    </div> <!--featuredV-->
                 	</div> <!--box6-col-2-->
                    
                </div> <!--box6--> 
                </div><!--item-->

                
              </div>
            </div>
          </div>
          <!--Featured Vendors-end-->
          
        
		<!--FavouriteList-->
        <div class="panel-group" id="FavouriteL">
        <div class="panel panel-default">
        <div class="panel-heading">
        	<h3 class="panel-title2 pull-left">Favourite List </h3>
            <div class="clear"><a href="#">Show All</a></div>
        </div>
        <div class="panel-body">
        	<!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            <!--1-->
            <div class="FavouriteList-text">
                <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
                <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span>Venue </span> 
                    <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                </h6>
            </div>
            <hr>
            
        </div>
        </div>
        </div>
        
        
        <!--adv-1-->
        <div class="panel-group">
        <div class="panel panel-default">
        <!--<div class="panel-heading">
        	<h3 class="panel-title2 pull-left">Favourite List </h3>
            <div class="clear"><a href="#">Show All</a></div>
        </div>-->
        <div class="panel-body2">
        	<div class="advertise"><a href="#"><img src="<?php echo base_url(); ?>assets/images/adv1.jpg" alt=""></a></div>
        </div>
        </div>
        </div>
        
        <!--adv-2-->
        <div class="panel-group">
        <div class="panel panel-default">
        <!--<div class="panel-heading">
        	<h3 class="panel-title2 pull-left">Favourite List </h3>
            <div class="clear"><a href="#">Show All</a></div>
        </div>-->
        <div class="panel-body2">
        	<div class="advertise"><a href="#"><img src="<?php echo base_url(); ?>assets/images/adv2.jpg" alt=""></a></div>
        </div>
        </div>
        </div>
        
        <!--adv-3-->
        <div class="panel-group">
        <div class="panel panel-default">
        <!--<div class="panel-heading">
        	<h3 class="panel-title2 pull-left">Favourite List </h3>
            <div class="clear"><a href="#">Show All</a></div>
        </div>-->
        <div class="panel-body2">
        	<div class="advertise"><a href="#"><img src="<?php echo base_url(); ?>assets/images/adv3.jpg" alt=""></a></div>
        </div>
        </div>
        </div>
        
        </div>
        <!-- End left-panel --> 
        
        
        <!--Start right-panel-->
        <div class=" col-sm-9 col-md-9 col-lg-9">
        
        <!--add-product-->
        <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<form action="#" id="compare-form" method="post">
				  <div class="compareMd">
					<input type="hidden" id="total_length" value="5" />
					<?php for($i=0; $i<5; $i++){ ?>
						<div id="compare_<?php echo $i; ?>">
							<div class="compareMdin compareMdin-successlink fade in" role="compare"><a href="#" class="">Add Item</a></div>
						</div>
					<?php } ?>
					<div class="compareMdin-compare"><a href="#">Compare</a></div><!-- index-compare.html -->
				  </div>
				</form>
			</div>
        </div>
        <!--add-product-end-->
        
        
        <!--Search-box-->
        <div class="search-area">
          <div class="row"> 
            <!--left-->
            <div class="col-lg-6 col-md-6 col-sm-6">
             <h1> Search Result <!--<span>(we found 20 venues)</span>--></h1>
            </div>
            <!--right-->
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control height34" name="x" placeholder="Search by venue...">
                <span class="input-group-btn">
                <button class="btn btn-info" type="button"><i class="fa fa-search"></i></button>
                </span> </div>
            </div>
          </div>
        </div>
        <!--Search-box-end--> 
        
      <div id="search_result">  
        <!--pagination-bar-->
        <nav class="navbar navbar-inverse margin-botm2">
          <div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rating <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li style="padding-left: 10px;">
                        <div class="checkbox">
                        <input id="checkd1" type="checkbox" name="check" value="checkd1">
                        <label for="checkd1"><span></span>Action</label>
                        </div>
                        <div class="checkbox">
                        <input id="checkd2" type="checkbox" name="check" value="checkd2">
                        <label for="checkd2"><span></span>Another action</label>
                        </div>
                        <div class="checkbox">
                        <input id="checkd3" type="checkbox" name="check" value="checkd3">
                        <label for="checkd3"><span></span>Something else here</label>
                        </div>
                        <div class="checkbox">
                        <input id="checkd4" type="checkbox" name="check" value="checkd4">
                        <label for="checkd4"><span></span>Separated link</label>
                        </div>
                    </li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Price <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <!--<li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>-->
                    <li style="padding-left: 10px;">
                        <div class="checkbox">
                            <input id="checkd1" type="checkbox" name="check" value="checkd1">
                            <label for="checkd1"><span></span>Low to High</label>
                        </div>
                        <div class="checkbox">
                            <input id="checkd2" type="checkbox" name="check" value="checkd2">
                            <label for="checkd2"><span></span>High to Low</label>
                        </div>
                    </li>    
                  </ul>
                </li>
            </ul>
        

            <!--pagination-->
            <ul class="pagination pull-right">
                <li><a href="#">First</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i> Previous</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">Next <i class="fa fa-chevron-right"></i></a></li>
                <li><a href="#">Last</a></li>
            </ul>
            <!--pagination-end-->
            
          </div><!-- /.container-fluid -->
        </nav>
        <!--pagination-bar-end-->
        
        
        <?php 
       // print_r($vendor_list); exit;
         if(isset($vendor_list) && !empty($vendor_list)){
			foreach($vendor_list as $value){
				
				if(!isset($product[$value['userId']][$value['serviceId']]) || empty($product[$value['userId']][$value['serviceId']])){
					continue;
				}
				$userId = base64_encode(base64_encode($value['userId']));
        ?>
        <!--brand-panel-5-->
        <div class="brand-pan">
        	<div class="panel2 panel-default2">
              <!-- Default panel contents -->
              <div class="panel-heading">
              	<img src="<?php echo base_url(); ?>assets/images/ico/ico-build.png" alt=""> <span><a href="#"><?php echo ucfirst($value['productCategoryName']); ?></a></span>  <img src="<?php echo base_url(); ?>assets/images/ico/ico-tree.png" alt=""><span><a href="#"><?php echo ucfirst($value['serviceName']); ?></a></span>
              </div>
              <div class="panel-body">
              	<div class="brand-cont">
                <div class="row">
                	<div class="brand-cont-img"><!-- vendor-detail.html --><a href="#"><img src="<?php echo $value['image']; ?>" alt=""></a></div>
                    <div class="brand-cont-text">
                    	<h2><a href="<?php echo base_url().'users/vendor_detail?token='.$userId.'&type='.$value['serviceName']; ?>"><?php echo ucfirst($value['userCompanyName']); ?></M></a></h2><!-- vendor-detail.html -->
                        <h6><img src="<?php echo base_url(); ?>assets/images/ico/ico-location.png" alt=""> <span><?php echo ucfirst($value['town_nm']).', '.ucfirst($value['county_nm']); ?></span> 
                        	<a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star1.png" alt=""></a><a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-star2.png" alt=""></a>
                        </h6>
                        <div><?php echo $value['businessDesc']; ?></div>
                    </div>
                </div><!--row-->
                </div>
              </div>
              <!-- Table -->
              <div class="table-responsive">
              <table class="table table-striped tblmrgn">
                <!--<thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                  </tr>
                </thead>-->
                <tbody>
                    <?php
						$products = array();
						$count=0;
						if(isset($product[$value['userId']][$value['serviceId']]) && !empty($product[$value['userId']][$value['serviceId']])){
							$products = $product[$value['userId']][$value['serviceId']];
						}
						foreach($products as $key => $data){
							$count++;
							$productToken = base64_encode(base64_encode($data['productId']));
					  ?>
                  <tr class="loadr">
                    <td>
                    	<h3><a href="#" data-toggle="modal" onclick="getServiceDetails('<?php echo $productToken; ?>');" data-target="#myModal3"><?php echo ucfirst($data['productName']); ?></a></h3>
                        <span id="<?php echo 'favourite_'.$productToken; ?>"><a href="Javascript:void(0)" onclick="addToFavourite('<?php echo $productToken; ?>')"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a></span>
                        <span id="<?php echo 'wishlist_'.$productToken; ?>"><a href="Javascript:void(0)" onclick="addToWishlist('<?php echo $productToken; ?>')"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a></span>
                        <a href="Javascript:void(0)" onclick="addToCompare('<?php echo $productToken; ?>');" id="add_to_compare"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
						<br /><br /><span id="<?php echo 'status_'.$productToken; ?>"></span>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> <?php echo $data['productDiscount'].'%'; ?></span> <input name="amount" type="button" value="From $ <?php echo $data['productMinPrice']; ?>" class="btn btn-black"></div>
                    </td>
                  </tr>
                  
                  
                  <?php if($count==3){ break;} } ?>
                 <!-- <tr class="loadr">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  <tr class="loadr">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                <tr class="trblk4">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  <tr class="trblk4">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  <tr class="trblk4">
                    <td>
                    	<h3><a href="#" data-toggle="modal" data-target="#myModal3">Aliquam lorem ante</a></h3>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-like.png" alt=""><span> Add to Favourite </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-gbox.png" alt=""><span> Add to Wishlist </span></a>
                        <a href="#"><img src="<?php echo base_url(); ?>assets/images/ico/ico-file.png" alt=""><span> Add to Compare </span></a>
                    </td>
                    <td valign="middle" align="right">
                    	<div class="margin-top1">Save upto <span class="text-them-red paddingR-20"> 20%</span> <input name="amount" type="button" value="From $ 1000" class="btn btn-black"></div>
                    </td>
                  </tr>
                  -->
                </tbody>
                <tfoot>
					<?php if($count>=3){ ?>
                  <tr>
                    <th colspan="2"><div id="loadMore4" class="btn btn-lg btn-block button5">SHOW ALL</div></th>
                  </tr>
				<?php } ?>
                </tfoot>
              </table>
            </div>
            </div>
        </div>
        <!--brand-panel-5-end-->
        <?php
			}
		}
        ?>
        
        <!--pagination-bar-->
        <nav class="navbar navbar-inverse margin-botm2">
          <div>
            <!-- Brand and toggle get grouped for better mobile display -->
			<ul class="pull-left">
            	<li><p>Page 1 of 5</p></li> 
            </ul>
        

            <!--pagination-->
            <ul class="pagination pull-right">
                <li><a href="#">First</a></li>
                <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i> Previous</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">Next <i class="fa fa-chevron-right"></i></a></li>
                <li><a href="#">Last</a></li>
            </ul>
            <!--pagination-end-->
            
          </div><!-- /.container-fluid -->
        </nav>
        <!--pagination-bar-end-->
            
		</div>
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


<!--modal3 -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog" >
	<!-- Modal content-->
	<div class="modal-content" id="serviceDetailModal">
		
	</div>
  </div>
</div>
</body>
</html>
