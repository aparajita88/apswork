<?php require_once(FCPATH.'assets/front/lib/header.php'); ?> 
<style type="text/css">
  .faq_holder{
    max-width: 100%;
  }
  .faq_holder .faq p, .faq_holder .faq h2{
    padding-left: 15px;
    padding-right: 15px;
  }
  </style>
<!-- Section -->
  <section class="our_mission our_mission_start">
        <?php if($cms_content[0]['image'] != ''){ ?>
        <img src="<?php echo base_url();?>assets/uploads/cms/full/<?= $cms_content[0]['image'] ?>" alt=''>          
      <?php } ?>          
     <div class="clearfix"></div>
  </section>
 <!-- /Section --> 
<!-- Faq Section -->
  <section class="">
      <div class="faq">
      <?php //print_r($cms_content);
      echo $cms_content[0]['content']; ?>
    
    <div class="clearfix"></div>
    </section>

<!-- /Faq Section -->

<!-- Call Us -->

<!-- /Call Us --> 

<!-- Map -->

<!-- /Map --> 

<!-- Footer -->
<?php require_once(FCPATH.'assets/front/lib/footer.php'); ?> 
<!-- /Footer --> 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/jquery.min.js"></script> 
<script src="<?php echo base_url()."assets/front"; ?>/js/script.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url()."assets/front"; ?>/js/bootstrap.min.js"></script> 
<script  src="<?php echo base_url()."assets/front"; ?>/js/wow.js"></script> 
	<script>
	   new WOW().init();
	</script> 

<!--click topmenu--> 
<script type="text/javascript">
       $(document).ready(function() {
            $('.showmenu').click(function(e) {
                
                $('.login-wrapper1').stop(true).fadeToggle();
            });
            $(document).click(function(e) {
                if (!$(e.target).closest('.showmenu, .login-wrapper1').length) {
                     
                    $('.login-wrapper1').stop(true).fadeOut();
                }
            });
        });
		
		/* $( '.showmenu' ).click(function() {
		  $( ".login-wrapper" ).slideToggle( "", function() {
 		  });
		}); */
		
		 
      </script>
      
      <script type="text/javascript">
       $(document).ready(function() {
            $('.showmenu1').click(function(e) {
                
                $('.login-wrapper2').stop(true).fadeToggle();
            });
            $(document).click(function(e) {
                if (!$(e.target).closest('.showmenu1, .login-wrapper2').length) {
                     
                    $('.login-wrapper2').stop(true).fadeOut();
                }
            });
        });
		
 		 
      </script>
</body>
</html>
