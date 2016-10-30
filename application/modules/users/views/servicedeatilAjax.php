
	 <input type="hidden" id="product_token" value="<?php echo $token; ?>" />	
<div class="modal-header">
	 <button type="button" class="close" data-dismiss="modal">&times;</button>
	<div class="inside">
	<aside class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
		<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/modal3-image.jpg" alt="modal-pic">
	</aside>
	<aside class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
		<h2><?php echo ucfirst($product['product_name']); ?></h2>
		<h5><?php echo $product['hours']; ?> hours</h5>
		<div class="clearfix"></div>
		<h6><!--<i class="fa fa-map-marker"></i>--><img src="<?php echo base_url(); ?>assets/images/modal-location.png" alt="location"> <?php echo ucfirst($product['address']).', '.ucfirst($product['town_nm']).', '.ucfirst($product['county_nm']).', '.ucfirst($product['country_nm']);?></h6>
		<h4>Details</h4>
		<p><?php echo ucfirst($product['description']); ?></p>
		<h3>From <strong>$<?php echo $product['min_prize'];  ?></strong></h3>
		<div class="save">Save<br> upto<br> <strong><?php echo $product['discount'];  ?>%</strong></div>
	</aside>
	<div class="clearfix"></div>
	</div>
	<div class="modal-header-btns">
		<span id="modal_status"></span>
		<ul class="add-to">
			<li><!--<i class="fa fa-thumbs-up"></i>--><img src="<?php echo base_url(); ?>assets/images/addtofavourite.png" alt="favourite"> Add to Favourites</li>
			<li><!--<i class="fa fa-gift"></i>--><img src="<?php echo base_url(); ?>assets/images/addtowishlist.png" alt="wishlist"> Add to Wishlist</li>
			<li><img src="<?php echo base_url(); ?>assets/images/compare.png" alt=""> Add to Compare</li>
		</ul>
		<ul class="add-to1">    
			<li><a href="Javascript:void(0)" onclick="sendEnquery();" class="modal-dialog-box">Booking Enquiry</a></li>
			<li><a href="#" class="modal-dialog-box">Book Now</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
  </div>
  <div class="modal-body">
   <div class="panel-group" id="VendorD">
   <div class="panel panel-default">
	<div class="panel-body">
	<div class="modal-dialog-features">
		<h2>Features</h2>
		<p><?php echo $product['features']; ?></p>
		<!--<p>Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maec en as tempus tellus eg condi mentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. </p>
	</div>
   
		 
		<div class="modal-dialog-features-sub mr1">
		<ul>
			<li><i class="fa fa-caret-right"></i> <a href="#">Maecenas nec odio et ante tincidunt tempus.</a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Donec vitae sapien ut libero venenatis faucibus. </a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Nullam quis ante. Etiam sit amet orci eget eros.</a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#"> Sed fringilla mauris sit amet nibh.</a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Donec sodales sagittis magna. </a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Maecenas nec odio et ante tincidunt tempus.</a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Donec vitae sapien ut libero venenatis faucibus. </a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Nullam quis ante. Etiam sit amet orci eget eros.</a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#"> Sed fringilla mauris sit amet nibh.</a></li>
			<li><i class="fa fa-caret-right"></i> <a href="#">Donec sodales sagittis magna. </a></li>
			
		</ul>-->
	</div>
	</div>
    </div>
   </div>
  </div>
  <div class="modal-footer ">
	<div class="row">
		<div class="col-sm-3 mr1 line">
			<div class="modal-dialog-features-last2"><img src="<?php echo base_url(); ?>assets/images/host-may-servise.png" alt=""></div>
			<div class="modal-dialog-features-last"><a href="#">Custom Package Offered</a></div>
		</div>
		<div class="col-sm-2  mr1 line2">
			<div class="modal-dialog-features-last2 "><img src="<?php echo base_url(); ?>assets/images/host-may-servise2.png" alt=""></div>
			<div class="modal-dialog-features-last  mr-helf"><a href="#">Payment Terms</a></div>
		</div>
		<div class="col-sm-3 mr1 line3">
			<div class="modal-dialog-features-last2  "><img src="<?php echo base_url(); ?>assets/images/host-may-servise3.png" alt=""></div>
			<div class="modal-dialog-features-last mr-helf"><a href="#">Cancellation Policy</a></div>
		</div>
		<div class="col-sm-4 mr1 line4">
			<div class="modal-dialog-features-last2"><img src="<?php echo base_url(); ?>assets/images/host-may-servise4.png" alt=""></div>
			<div class="modal-dialog-features-last "><a href="#">Additional Booking Conditions</a></div>
		</div>
	</div>
</div>

