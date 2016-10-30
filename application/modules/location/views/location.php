<?php require_once(FCPATH.'assets/front/lib/header_location.php'); ?>
<?php
    $firstLat = $firstLng = '';
    if(!empty($location_data)){ 
      foreach($location_data as $key=>$value){ 
        if($value["latitude"] != '' && $value["longitude"] != ''){
          $firstLat = $value["latitude"];
          $firstLng = $value["longitude"];
          break;
        }else{
          $firstLat = '21.0000';
          $firstLng = '78.0000'; 
        }
      }
    }else{
      $firstLat = '21.0000';
      $firstLng = '78.0000'; 
    }
?> 
<section class="new_location">

	<div class="col-lg-12 location_section1">
		<div id="bc2" class="btn-group btn-breadcrumb">
			<a href="<?php echo base_url(); ?>" class="btn btn-default"><i class="fa fa-home"></i></a>
			<div class="btn btn-default">India</div>
			<div class="btn btn-default">
				<select class="form-control control_select" id="location_dropdown">
					<?php 
          $location_arr=$this->lm->getcities();
					foreach($location_arr as $key=>$value){ ?>
						<?php $selected = (base64_encode(base64_encode($value["cityId"]))==$location)?'selected="selected"':''; ?>
						<option value="<?php echo $value["name"]; ?>" <?php echo $selected; ?>><?php echo $value["name"]; ?></option><!--location.html-->
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 new_location_left">
    		<!-- Location -->
          <section class="location_section location_section2">
                 <div class="clearfix"></div>
                <div class="col-lg-12 nopadd h5">
               <?php //if($city_name[0]['cityImage']!=''){?>
               <!-- <div class="locationheader"><img src="<?php echo base_url();?>assets/front/images/<?php echo $city_name[0]['cityImage']; ?>" alt=""></div>-->
                <?php //}?>
                	<h5> <?php echo count($location_data);?> office(s) in <?php echo $city_name[0]['name']; ?></h5>
                	<?php if(!empty($location_data))
									{
									$count = 1;
									foreach($location_data as $row)
									{?>
                    <div class="loction_div">
                        
                            <aside class="col-lg-6 col-md-12 col-sm-12 col-xs-12 loction_left po_rel">
                            	<div class="comming"><abbr><?php echo $row['businessName'];?></abbr></div>
                                <img src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>" width="337" height="189" alt="" >
                            </aside>
                            
                            <aside class="col-lg-6 col-md-12 col-sm-12 col-xs-12 loction_right po_rel">
                                <h3><?php echo $row['address'];?> </h3>
                                 <?php 
                                 $l_array = array('Pune','kolkata','Bangalore');
                                 if (!in_array($this->uri->segment(3), $l_array)){?>
                                   <div class="view_bnt">
                        <a href="#" class="demo" id="<?php echo $row['business_id'];?>">Packages</a>
                                  </div>
                                 <!-- <div class="clearfix"></div>
                                <div class="view_bnt">
								                    <a href="<//?php echo base_url().'index.php/location/video_gallery/'.base64_encode(base64_encode($row["business_id"])); ?>">Video Gallery</a>
							                 </div>-->
                                <div class="view_bnt">
                                    <a href="<?php echo base_url().'index.php/location/book_a_tour/'.base64_encode(base64_encode($row["business_id"]))."/".$location; ?>">Book a Tour</a>
                                </div>
                                 <div class="view_bnt_new">
                                   or Call us at 1800-833-9675
                                </div>
                                <?php }elseif($count == 2){ ?>
                                <div class="view_bnt_comming">
                                  Coming shortly.
                                </div>
                                <div class="view_bnt_new">
                                   or Call us at 1800-833-9675
                                </div>
                                <?php }else{?>
                                <div class="view_bnt">
                                  <a href="#" class="demo" id="<?php echo $row['business_id'];?>">Packages</a>
                                  </div>
                                 <!-- <div class="clearfix"></div>
                                <div class="view_bnt">
                                    <a href="<//?php echo base_url().'index.php/location/video_gallery/'.base64_encode(base64_encode($row["business_id"])); ?>">Video Gallery</a>
                               </div>-->
                                <div class="view_bnt">
                                    <a href="<?php echo base_url().'index.php/location/book_a_tour/'.base64_encode(base64_encode($row["business_id"]))."/".$location; ?>">Book a Tour</a>
                                </div>
                                 <div class="view_bnt_new">
                                   or Call us at 1800-833-9675
                                </div>
                                <?php } ?>
                            </aside>
                             <div id="pkg_<?php echo $row['business_id'];?>"  class="collapse" >
                                       <img src="<?php echo base_url(); ?>assets/front/images/pricetable.jpg" alt="pricetable" style="margin-top: 15px;">
                                  </div>
                            <div class="clearfix"></div>
                        </div><?php $count++;}}else {?>
								<div class="loction_div">
                        <aside class="col-lg-6 col-md-12 col-sm-12 col-xs-12 loction_left po_rel">
                           	<div class="comming"><abbr>coming soon</abbr></div>
							<img src="<?php echo base_url(); ?>assets/front/images/BuildingComingSoon.png" alt="" >
                         </aside>
                            
                         <aside class="col-lg-6 col-md-12 col-sm-12 col-xs-12 loction_right po_rel">
							             Your wait is about to end...
                         </aside>
                         <div class="clearfix"></div>
                       </div> <?php } ?>
                       
                       <input type="hidden" id="firstLat" value="<?= $firstLat; ?>" />
                       <input type="hidden" id="firstLng" value="<?= $firstLng; ?>" />
                  <div class="clearfix"></div>
                </div>
             
           <div class="clearfix"></div> 
         </section>
         <?php if($city_name[0]['cityImage']!=''){?>
                <div class="locationheader"><img src="<?php echo base_url();?>assets/front/images/<?php echo $city_name[0]['cityImage']; ?>" alt=""></div>
                <?php }?>
     		<!-- /Location -->
        <!-- ===================================== Call us and footer ===============================-->
        <!-- Footer -->
        <footer>
          <div class="padding_left_rights">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."assets/front/"; ?>images/logo.png" alt="" /></a>
                <p>© 2016 Copyright Smartworks. <br>
          All Rights Reserved. <br>
          <a href="javascript:void(0)">Terms & Conditions.</a><br>
          </p>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_01">
                <h2>Contact</h2>
               
               <p> Smartworks Business Centre Pvt. Ltd. <br>
				 21A, Shakespeare Sarani<br>
                 Kolkata 700017<br>
                 
				   
              </div>
              <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 footer_02">
                <h2>About</h2>
                <ul>
                   
          <li><a href="<?php echo base_url().'index.php/cms/our_mission'; ?>">Our Mission</a></li><!--our-mission.html-->
          <li><a href="<?php echo base_url().'index.php/cms/faq'; ?>">FAQ</a></li><!--faq.html-->
          <li><a href="<?php echo base_url().'index.php/location/image_gallery/all'; ?>">Photos</a><!-- photos.html --></li><!--photos.html-->
          <li><a href="<?php echo base_url().'index.php/location/video_gallery/all'; ?>">Videos</a></li><!--videos.html-->
          <li><a href="<?php echo base_url().'index.php/cms/privacy_policy'; ?>">Privacy Policy</a></li><!--privacy-policy.html-->
        </ul>
                
              </div>
              <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12 footer_news">
                <h2>Sign up Our Newsletter</h2>
                <div class="clearfix"></div>
                <div class="input-group input_group" id="subscription-div">
                  <input type="email" id="subscription-email" class="form-control"  placeholder="E-mail ">
                  <span class="input-group-btn">
                  <input type="submit" id="subscribe"  value="Subscribe" class="button btn btn-default">
                  </span> </div> 
                  <div class="clearfix"></div> 
		          <span class="sub-stat" id="subscription_status"></span>
       
                <div class="clearfix"></div>
                <ul>
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
        <!-- =====================================/ Call us and footer ===============================--> 	
    </div>
    <div class="new_location_fixed">
     <div id="map" style="width: 100%; height: 100%;"></div>    
    </div>
</section>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/jquery.min.js"></script> 
<script src="<?php echo base_url()."assets/front"; ?>/js/script.js"></script> 
<script src="<?php echo base_url()."assets/front"; ?>/js/validation.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/bootstrap.min.js"></script> 
<script  src="<?php echo base_url()."assets/front"; ?>/js/wow.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/css/fancybox.css" media="screen" />
<!--video lightbox-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/html5lightbox.js"></script>
<!--video lightbox-->
<script type="text/javascript">
	//$.noConflict();
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<style>
.view_bnt_comming {
text-align: center;
width: 100%;
margin-top: 30px;
font-size: 15px;
font-weight: bold;
}
.view_bnt_new {
text-align: center;
width: 100%;
margin-top: 30px;
font-size: 12px;
}
  header {position:fixed;z-index:9999;}
.location_section2 {margin: 116px 0 20px;}
.fancybox-custom .fancybox-skin {
	box-shadow: 0 0 50px #222;
}
.loction_right.po_rel > h3{
  font-size: 16px;
  line-height: 21px; 
}
</style>
<script>
   new WOW().init();
</script> 
<!--click topmenu--> 
<script type="text/javascript">
$(document).ready(function() {

   $('.demo').click(function (e) {
    e.preventDefault();
   _id =  $(this).attr('id');
    $("#pkg_"+_id).toggle();
 
  

  });
    $('.showmenu').click(function(e) {
        
        $('.login-wrapper1').stop(true).fadeToggle();
    });
    $(document).click(function(e) {
        if (!$(e.target).closest('.showmenu, .login-wrapper1').length) {
             
            $('.login-wrapper1').stop(true).fadeOut();
        }
    });
    $('.showmenu1').click(function(e) {
        
        $('.login-wrapper2').stop(true).fadeToggle();
    });
    $(document).click(function(e) {
        if (!$(e.target).closest('.showmenu1, .login-wrapper2').length) {
             
            $('.login-wrapper2').stop(true).fadeOut();
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">
 var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng($("#firstLat").val(), $("#firstLng").val()),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
var infowindow = new google.maps.InfoWindow();
var marker, i;
<?php foreach($location_data as $key=>$value){ 
  if($value["latitude"] != '' && $value["longitude"] != ''){
?>
 marker = new google.maps.Marker({
   position: new google.maps.LatLng(<?php echo $value["latitude"]; ?>, <?php echo $value["longitude"]; ?>),
   map: map
});
google.maps.event.addListener(marker, 'click', (function(marker) {
  return function() {
    infowindow.setContent('<?php echo $value["address"]; ?>');
    infowindow.open(map, marker);
}
})(marker, i));
<?php }}?>   
</script>
</body>
</html>
