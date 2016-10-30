<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Mission  Section -->
	 <style>
	 .for_linkss { padding-left:0;}
	 .all_links { margin-top:25px; width:70%; margin:35px auto 0 auto;}
	 .all_links a { color:#000; text-decoration:underline;}
	 .all_links a:hover { color:#333; text-decoration:none;}
	 .faq001 h2 {color: #000;
    font-family: "Roboto";
    font-size: 30px;
    font-weight: bold;}
	 .faq001 p {font-size: 18px; color: #000;
    font-family: "Roboto";font-weight: 300;}
	 </style>
    
    <div class="floor-body">
       <div class="container">
          <div class="row">
              <div class="col-lg-12 faq faq001 text-center">
                  <h2 >Smartworks Floor Plan</h2>
                  <p>Click on the links below to view the floor plan of Kolkata office.</p>
                  
				  <?php $location = $this->uri->segment(3);

  if($this->uri->segment(3) ==='Kolkata'){ ?> 
  				  <div class="all_links">	
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center for_linkss">
                        <p><a href="<?php echo base_url(); ?>assets/front/images/furniture layout-8th floor.pdf" target="_blank"><img alt="" src="<?php echo base_url(); ?>assets/front/images/8-Floor Plan Thumbnail.jpg"> </a><p>
                      </div>
                      
                       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center for_linkss">
                         <p><a href="<?php echo base_url(); ?>assets/front/images/furniture layout-9th floor.pdf" target="_blank"><img alt="" src="<?php echo base_url(); ?>assets/front/images/9-Floor Plan Thumbnail.jpg"></a><p>
                       </div>
                   <div class="clearfix"></div>
                   </div>  
             
            <?php } else{ ?>
            
			<span class="no_data"><h2>Sorry! No data found in this location.</h2></span><?php } ?> </div>
           
           </div>
       </div>
    </div>
    


<!-- /Mission Section -->

<!-- client_section  -->
<div class="client_section">
  <!----<ul>
    <li><a href="#"><img alt="" src="<?php echo base_url(); ?>assets/front/images/c1.png"></a></li>
    <li><a href="#"><img alt="" src="<?php echo base_url(); ?>assets/front/images/c2.png"></a></li>
    <li><a href="#"><img alt="" src="<?php echo base_url(); ?>assets/front/images/c3.png"></a></li>
    <li><a href="#"><img alt="" src="<?php echo base_url(); ?>assets/front/images/c4.png"></a></li>
    <li><a href="#"><img alt="" src="<?php echo base_url(); ?>assets/front/images/c5.png"></a></li>
    <li><a href="#"><img alt="" src="<?php echo base_url(); ?>assets/front/images/c6.png"></a></li>
  </ul>---->
</div>
<!-- /client_section  -->

<!-- Call Us -->
<section class="coll_us_section">
  <div class="container">
    <div class="row">
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 phone_contact">
        <p><i class="fa fa-phone"></i>Call us Today 1800 - 111 - 1111</p>
      </aside>
      <aside class="col-lg-6 col-md-6 col-sm-6 col-xs-12 icon_contact"> <a class="btn btn-large btn-default know" href="<?php echo base_url().'index.php/users/contact_us' ?>">Contact Us <i class="fa fa-angle-right"></i></a> </aside>
    </div>
  </div>
</section>
<!-- /Call Us --> 

<!-- Map -->
<!---<div class="map_sec">
 <!----- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.270770521181!2d88.43108311482146!3d22.568974038791673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275adc3ba1021%3A0xebcdcaa065bd0c8!2sBarbeque+Nation!5e0!3m2!1sen!2sin!4v1449465437662" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>---->
<?php 
	//$yourAddress = "Plot No D2/, JDS House, EP Block, Sector V, Salt Lake City, Kolkata, West Bengal 700091";
	$yourAddress = "Smartworks Business Center Pvt. Ltd. Victoria Park Building Plot No. 37/2, Block GN Salt Lake, Kolkata - 700091";
	$yourAddress = str_replace(" ", "+", $yourAddress);
	$yourAddress = str_replace("++", "+", $yourAddress);
?>
<!---<iframe src="https://maps.google.it/maps?q=<?php echo $yourAddress; ?>&output=embed" width="100%" height="310" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>--->
<!-- /Map --> 
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
