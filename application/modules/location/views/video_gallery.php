<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Mission  Section -->
     
    
<div class="gellery_main_contener section_white our_mission_gellery">
  <div class="container section gellery ">
    <div class="row">
      <div class="col-lg-12">
        <h2>Smartworks Videos</h2>
        <p>Experience Smartworks through these videos that educate and inspire our community.</p>
      </div>
    </div>
  </div>
  <?php if(!empty($business_videos))
									{
									
									foreach($business_videos as $row)
									{ ?> 
<div class="gellery_div">
    <aside class="col-lg-4 col-md-4 col-sm-4 col-xs-12 gellery_images gellery_images_hover"> 
    <a class="html5lightbox" data-webm="<?php echo base_url(); ?>assets/uploads/videos/<?php echo $row["videoName"]; ?>" href="<?php echo base_url(); ?>assets/uploads/videos/<?php echo $row["videoName"]; ?>">
             <div class="play_btn">
                <img src="<?php echo base_url(); ?>assets/front/images/play.png" alt="" style="height: auto;" >
            </div>
        </a>	
     
    <a class="html5lightbox" data-webm="<?php echo base_url(); ?>assets/uploads/videos/<?php echo $row["videoName"]; ?>" href="<?php echo base_url(); ?>assets/uploads/videos/<?php echo $row["videoName"]; ?>"><img alt="" src="<?php echo base_url(); ?>assets/front/images/<?php echo $row["imageName"]; ?>" ></a>
    </aside>
     <?php }} else{ ?>
		<span class="no_data"><p>No videos are currently available.</p></span><?php } ?>
		 
     
     
    <div class="clearfix"></div>
  </div>
</div>

<!-- /Mission Section -->

<!-- client_section  -->

<!-- /client_section  -->

<!-- Call Us -->

<!-- /Call Us --> 

<!-- Map -->

<!-- /Map --> 
 
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
