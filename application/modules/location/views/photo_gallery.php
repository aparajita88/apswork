<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<!-- Mission  Section -->
<style type="text/css">
	.gellery_images.gellery_images_hover > img {
    height: 300px;
    max-height: 300px;
    max-width: 447px;
    width: 447px
} 
</style>    
    
<div class="gellery_main_contener section_white our_mission_gellery">
  <div class="container section gellery ">
    <div class="row">
      <div class="col-lg-12">
        <h2>Smartworks Photos</h2>
        <p>Experience Smartworks through these photos.</p>
      </div>
    </div>
  </div>
   <div class="gellery_div only_photo">
  <?php // print_r($business_images);
  if(!empty($business_images))
									{
									
									foreach($business_images as $row)
									{ ?> 
 
    <aside class="col-lg-4 col-md-6 col-sm-6 col-xs-12 gellery_images gellery_images_hover"> 
    <div class="gellery_over">
       
         <div class="a">
        	 <a class="fancybox" href="<?php echo base_url();?>assets/uploads/images/full/<?php echo $row['imageName']; ?>" data-fancybox-group="gallery">View</a>
         </div>
    </div>
    <img alt="" src="<?php echo base_url();?>assets/uploads/images/thumbnails/<?php echo $row['imageName']; ?>" height="218" width="427"> 
    
    </aside>
<?php }} else{ ?>
		<span class="no_data"><p>Sorry! No data found in this location.</p></span><?php } ?>
		<div class="clearfix"></div>
  </div>
</div>

<!-- /Mission Section -->



<!-- Call Us -->

<!-- /Call Us --> 

<!-- Map -->
<!---<div class="map_sec">
  
</div>--->
<!-- /Map --> 
 <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/css/fancybox.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
	<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
	 
	</style>
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
