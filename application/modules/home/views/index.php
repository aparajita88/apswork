<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 

<!-- Video Section -->
<section class="video v-center custom_video_part" >
  <div class="overlaybg"></div>
  <div id="bgVideo" class="background">
    <video id="video_background" preload="auto" autoplay loop style="position: fixed; top: -203px; left: 0px; bottom: 0px; right: 0px; z-index: -100; width: 100%;" controls>
      <source src="http://smartworks.demostage.net/assets/front/video/video1.mp4" type="video/mp4">
      <source src="http://smartworks.demostage.net/assets/front/video/video1.ogg" type="video/ogg">
    </video>
  </div>
  <div class="video_contener">
      <div class="container">
      <div class="hero-unit">
        <div class="clearfix"></div>
        <h1 class="dgn" href="http://smartworks.demostage.net/index.php/login/signup/4">Let's Grow Together</h1>
        <a class="btn btn-large know" href="/index.php/location/book_a_tour/TWpSaU5UZzROMkl0WkRKaE1pMWlaQT09/WTJaa09EUTVaRFV0WldNMk9TMHlaQT09">Book A Tour</a>
          <div class="callnow-banner">
              <span>Call Now</span>
              <a href="tel:1800 - 833 -9675">1800 - 833 - 9675</a>
          </div>
      </div>
  </div>
</section>
<!-- /Video Section --> 
<!-- Welcome Section -->
<section class="section section_white">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 ">
        <h2>
          <h2>SMART OFFERS</h2>
        </h2>
        <ul class="smartservices">
         
          <li>
          	<img src="<?php echo base_url()."assets/front/"; ?>images/dedicated-work-station.jpg" alt="">
          	<div class="name"> Dedicated </div>
          </li>
          <li>
          	<img src="<?php echo base_url()."assets/front/"; ?>images/cube.jpg" alt="">
          	<div class="name"> Cubes</div>
          </li>
          <li>
          	<img src="<?php echo base_url()."assets/front/"; ?>images/05.jpg" alt="">
          	<div class="name"> Suites </div>
          </li>
          
          <li>
          	<img src="<?php echo base_url()."assets/front/"; ?>images/THINK.jpg" alt="">
          	<div class="name"> Think Cube </div>
          </li>
         
          <li>
          	<img src="<?php echo base_url()."assets/front/"; ?>images/conf.jpg" alt="">
          	<div class="name"> Conference</div>
          </li>
        
        </ul>
         <a href="<?php echo base_url();?>index.php/home/price" class="blkbutton">See All Plans & Pricing</a>
      </div>
    </div>
  </div>
</section>
<!-- /Welcome Section --> 
<!-- Offer Section -->
<div class="offer_section section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 ">
        <h2>Smart Services</h2>
      </div>
      <div class="col-lg-12 in_section ">
        <aside class=" col-lg-12 info_box info_box10 ">
  			  <?php 
            foreach ($cms_content_smart_services as $key  => $val) {?>
          	  <aside class="info_icon_box">
                <a href="" data-toggle="tooltip" data-placement="top" title="<?php echo strip_tags($val['content']);?>"><p><i class="fa"><img src="<?php echo base_url()."assets/uploads/cms/full/".$val['image']; ?>" alt="" /></i><span><?php echo $val['title'];?></span></p></a>
              </aside>
  			  <?php } ?>
          <div class="clearfix"></div>
        </aside>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<!-- /Offer Section --> 
<!-- Gellery -->
<div class="gellery_main_contener section_white container">
  <div class="container section gellery ">
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-12 ">
          <h2>WHAT'S IN IT FOR YOU</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="gellery_div gellery_div_hovers">
    <?php foreach ($cms_content_i_am_a as $key  => $val) { ?>
      <aside class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gellery_images gellery_over_home "> 
      <img src="<?php echo base_url();?>assets/uploads/cms/medium/<?= $val['image'] ?>" alt="<?= $val['slug'] ?>"/>
      <p><a href="javascript:void(0);"><?= $val['title'] ?></a></p>
      <div class="gellery_over">
        <h2><?= $val['title'] ?></h2>
        <div class="a"> <a href="<?php echo base_url();?>index.php/home/page/<?= $val['slug'] ?>">EXPLORE</a> </div>
      </div>
     </aside>
    <?php } ?>
    <div class="clearfix"></div>
  </div>
</div>
<!-- /Gellery --> 
<!--Smart MEMBERSHIPs-->
<!--<section class="section section_white">
  <div class="smartmember_section section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ">
          <h2 style="color:#fff; text-shadow: 0px 5px 6px rgba(63, 63, 63, 0.86);">Smart MEMBERSHIPs</h2>
        </div>
        <div class="col-lg-12 in_section ">
          <div class="table-responsive">
            <table width="100%" class="table tblrdata">
              <thead>
                <tr>
                  <td style="background:none; border-bottom:0; border-top:0">&nbsp;</td>
                 
                  <td><?php echo $subscription[0]['name']; ?></td>
                  <td><?php echo $subscription[1]['name']; ?> </td>
                  <td><?php echo $subscription[2]['name']; ?> </td>
                  <td><?php echo $subscription[3]['name']; ?> </td>
                </tr>
              </thead>
              <tr>
                <td style="background:none; border-bottom:0; border-top:0"><p>&nbsp;</p></td>
                <td><p>Free for initial 3 months </p></td>
                <td><p>INR <?php echo $subscription[1]['price']; ?> onwards</p></td>
                <td><p>INR <?php echo $subscription[2]['price']; ?> onwards</p> </td>
                <td><p>INR <?php echo $subscription[3]['price']; ?> onwards</p> </td>
              </tr>
              
               <tr>
                <td><p>Private Office</p></td>
                <td><p></p></td>
                <td><p></p></td>
                <td><p>2 days is for Private office </p></td>
                <td><p>5 days is for Private office</p> </td>
              </tr>             
              
               <tr>
                <td><p>Smart Community</p></td>
                 <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>                
              
               <tr>
                <td><p>Walk in and work</p></td>
                <td><p>&nbsp;</p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>                 
              
               <tr>
                <td><p>Virtual Office</p></td>
                <td><p>&nbsp;</p></td>
                <td><p>&nbsp;</p></td>
                <td><p>5% discount on Virtual Office monthly fee</p></td>
                <td><p>10% discount on Virtual Office monthly fee</p></td>
              </tr>                
              
               <tr>
                <td><p>Free Refreshments</p></td>
                <td><p>&nbsp;</p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>                 
              
               <tr>
                <td><p>Free Wi-Fi</p></td>
                <td><p>&nbsp;</p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>                 
              
              <tr>
                <td><p>Meeting room, Conference Rooms & Videoconferencing and day office discounts</p></td>
                <td><p>10%</p></td>
                <td><p>10%</p></td>
                <td><p>15%</p></td>
                <td><p>15%</p></td>
              </tr>              
              
               <tr>
                <td><p>Concierge </p></td>
                <td><p>&nbsp;</p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>              
              
                <tr>
                <td><p>Events * </p></td>
                <td><p>&nbsp;</p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>               
              
                 <tr>
                <td><p>Offers on Smart Alliance** </p></td>
                <td><p>&nbsp;</p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
                <td><p><i class="fa fa-check" aria-hidden="true"></i></p></td>
              </tr>               
              
              <tr id="getmember">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              
                <td><a href="<?php echo base_url(); ?>index.php/login/membership/<?php echo base64_encode(base64_encode($subscription[1]['Id'])); ?>">Get Membership <br>@INR <?php echo $subscription[1]['price']; ?> onwards</a></td>
                <td><a href="<?php echo base_url(); ?>index.php/login/membership/<?php echo base64_encode(base64_encode($subscription[2]['Id'])); ?>">Get Membership  <br>@INR <?php echo $subscription[2]['price']; ?> onwards</a></td>
                <td> <a href="<?php echo base_url(); ?>index.php/login/membership/<?php echo base64_encode(base64_encode($subscription[3]['Id'])); ?>">Get Membership <br> @INR <?php echo $subscription[3]['price']; ?> onwards</a></td>
              </tr>               
            </table>
            <p class="condttxt"><span>*  Participants in the events should be from the same member group  </span>  **Discounts would vary from product to product. Kindly refer to the benefit page on our app. </p>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</section>-->
<!--Smart MEMBERSHIPs--> 

<!--News & Events-->
<section class="whitespace section_white">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 ">
        <h2>News & Events</h2>
      </div>
      <div class="col-lg-12 space news">
        <div class="newsholder">
          <div class="col-md-6 img"><img src="<?php echo base_url()."assets/front/"; ?>images/NEWS01.jpg" alt=""></div>
          <div class="col-md-6 txt">
            <p class="hed">Smartworks presence in Gurgaon.</p>
            <p class="date"><i class="fa fa-calendar"></i>&nbsp;June 25, 2016</p>
            <p>Smartworks Business Centre Pvt Ltd is proud to announce the integration of Vision Business Centre into the Smartworks stable of centres. Based in Gurgaon at Sushantlok, the office spanning is state of the art with cross functional services like fully managed private office, virtual offices, conferencing facility, reception services as well as proximity to prime CBD area amenities like metro connectivity and transportation. Smartworks is an innovative and new generation solutions provider of Office space solutions encompassing the latest trends and techniques in providing end to end customer centric solutions in their quest for scalable office solutions.

            Emergence of “Activity Based Working” in India, 2016.</p>
          </div>
        </div>
        <div class="newsholder">
          <div class="col-md-6 txt">
            <p class="hed">Emergence of “Activity Based Working” in India, 2016.</p>
            <p class="date"><i class="fa fa-calendar"></i>&nbsp;Jun 25, 2016</p>
            <p>Co-working spaces are a relatively new phenomena, and are now really coming into their own. Each is unique, full of different people, different services, different vibes and their own special stories to tell. Working in these spaces ensure you will always be surrounded by like-minded, talented individuals and teams which can really benefit you in the short and long term. Not only that a study from Deskmag.com found that those who decided to work in co-working spaces were more likely to be motivated, have higher levels of interaction, and more than half worked in supportive teams. So if you and your startup or company aren’t based in a co-working space then you very well should be.</p>
          </div>
          <div class="col-md-6 img"><img src="<?php echo base_url()."assets/front/"; ?>images/client.jpg" alt=""></div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</section>

<!--News & Events--> 
<!-- Map -->
<section class="whitespace" style="background:url(<?php echo base_url()."assets/front/"; ?>images/map-bg.png) no-repeat 0 0; background-size:cover;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 ">
        <h2>Our Locations</h2>
      </div>
    </div>
    <div class="callnow"> <img src="<?php echo base_url()."assets/front/"; ?>images/callnow.png" alt="">
      <h2><span>Call Now</span> 1800 - 833 - 9675 </h2>
    </div>
    <div class="indiamap">
      <div class="map_hover">
		<div class="city city01"><a href="<?php echo base_url().'index.php/location/view/Noida';?>" title="">Noida</a></div>
        <div class="city city02"><a href="<?php echo base_url().'index.php/location/view/Delhi';?>" title="">Delhi</a></div>
        <div class="city city03"><a href="<?php echo base_url().'index.php/location/view/Gurgaon';?>" title="">Gurgaon</a></div>
        <div class="city city05"><a href="<?php echo base_url().'index.php/location/view/Kolkata';?>" title="">Kolkata</a></div>
        <div class="city city06"><a href="#" title="">Guwahati</a></div>
        <div class="city city07"><a href="<?php echo base_url().'index.php/location/view/Mumbai';?>" title="">Mumbai</a></div>
        <div class="city city08"><a href="<?php echo base_url().'index.php/location/view/Pune';?>" title="">Pune</a></div>
        <div class="city city11"><a href="<?php echo base_url().'index.php/location/view/Bangalore';?>" title="">Bangalore</a></div>
        <div class="city city12"><a href="<?php echo base_url().'index.php/location/view/Hyderabad';?>" title="">Hyderabad</a></div>
        <div class="city city13"><a href="<?php echo base_url().'index.php/location/view/Chennai';?>" title="">Chennai</a></div>
        <!--<div class="city city14"><a href="<?php echo base_url().'index.php/location/view/Agartala';?>" title="">Agartala</a></div>-->
      </div>
    </div>
  </div>
</section>

<!-- /Map -->
<!-- Footer -->
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
