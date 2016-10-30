<?php
	$bannerArr=banners();
	if($bannerArr)
	{
?>
		<!--slider-->
        <div class="rbox">
          <ul class="indexslider">
          	<?php
          		foreach($bannerArr as $bnnRow)
          		{
          	?>
            	<li><img src="<?php echo $this->config->item('base_url');?>assets/uploads/bannerimages/full/<?php echo $bnnRow['banner_image']; ?>" alt="<?php echo $bnnRow['bannerTitle']; ?>" title="<?php echo $bnnRow['bannerTitle']; ?>"></li>
            <?php
            	}
            ?>   
          </ul>
          <div id="index-pager"> 
          <ul>
          	<?php
          		foreach($bannerArr as $bnnRow1)
          		{ 
          	?>
          		<li><a data-slide-index="<?php echo $bnnRow1['ordering']; ?>" href=""><?php echo $bnnRow1['bannerTitle']; ?></a> </li>
          	<?php
          		}
          	?>
          </ul>
        </div>
          
        <!--<div id="index-pager"> 
          <a data-slide-index="0" href="">Samsung</a> 
          <a data-slide-index="1" href="">Karbon</a> 
          <a data-slide-index="2" href="">Xolo</a> 
          <a data-slide-index="3" href="">Micromax</a> 
          </div>--> 
        </div>
<?php
	}
?>        
