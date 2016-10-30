<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<style type="text/css">
  .whitebx {
    padding: 15px;
  }
</style>
<!-- Section -->
	<section class="our_mission our_mission_start">
      <?php if($cms_page_content['page_header_image'] != ''){ ?>
    	  <img src="<?php echo base_url();?>assets/uploads/cms/full/<?= $cms_page_content['page_header_image'] ?>" alt='<?= $cms_page_content['title'];?>'>
        <?php } ?>           
        <div class="our_mission_start_content">	
        	<div class="container">
 				<div class="row">
                	<div class="col-lg-12">           
                        <h1 style="display: none;"><?= $cms_page_content['title']; ?><br></h1> 
                        <p style="display: none;"><?= $cms_page_content['slogan']; ?></p>
                   </div>  
               </div>       
        </div>
        
     <div class="clearfix"></div>
  </section>
<!-- /Section -->    
<div class="gellery_main_contener section_white our_mission_gellery">
  <div class="div section gellery ">
    <div class="div">
      <div class="div brow_or">
        <?= $cms_page_content['content']; ?>
        <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<!-- /Mission Section -->

<!-- client_section  -->

<!-- /client_section  -->

<!-- Call Us -->

<!-- /Call Us --> 

<!-- Map -->

<!-- /Map --> 

<!-- Footer -->
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
<!-- /Footer --> 
</body>
</html>
