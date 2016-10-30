<?php if(!empty($conference_data)){ 
    $html = '';
	$ts = strtotime(date("d-m-Y"));
	// calculate the number of days since Monday
	$dow = date('w', $ts);
	$offset = $dow - 1;
	if ($offset < 0) {
	$offset = 6;
	}
	// calculate timestamp for the Monday
	$ts = $ts - $offset*86400;
	// loop from Monday till Sunday
	for($w = 0; $w < 8 ; $w++) {
		$html .= '<div class="item">';
		for ($i = 0; $i < 7; $i++, $ts += 86400){
			$html .= '<div class="time_grid_holder">';
			$html .= '<div class="date_grid">';
			$html .=  date("l", $ts).'<br>'.date("d-m-Y", $ts).'</div>';
			if($ts >= strtotime(date("d-m-Y"))){
				$slots = array();
				foreach($booked as $dt){
					if (array_key_exists(date("d-m-Y", $ts),$dt))
					{
						foreach($dt[date("d-m-Y", $ts)] as $v){
							$slots[] = $v;
						}
					}
				}
				for($j = 8; $j < 17; $j++){
					$time = (string)($j.':00');
					$slotCss = 'available';
					if(!empty($slots)){
						if (in_array($time, $slots))
						{
							$slotCss = 'booked';
						}
					}
					if(($ts  == strtotime(date("d-m-Y"))) && ((int)date('H') > (int)$j))
					{
						$slotCss = 'notavailabletoday';
					}
					if($conference_data[0]['start_time'] <= $j && $j <= $conference_data[0]['end_time']){
						$time = $j.':00 '.(($j < 12) ? 'AM' : 'PM');
						$html .= '<div class="time_grid '.$slotCss.'" data-flag= "1" data-price="'.$conference_data[0]["price"].'" data-date="'.date("d-m-Y", $ts).'" data-time="'.(string)($j.':00').'" id="tme_"> '.$time.'</div>';
					}else {
						$time = $j.':00 '.(($j < 12) ? 'AM' : 'PM');
						$html .= '<div class="time_grid notavailable"> '.$time.' </div>';
					}
				}
			}else {
				$html .= '<div class="time_grid notavailable"> 08:00 AM</div>';
				$html .= '<div class="time_grid notavailable"> 09:00 AM</div>';
				$html .= '<div class="time_grid notavailable"> 10:00 AM</div>';
				$html .= '<div class="time_grid notavailable"> 11:00 AM</div>';
				$html .= '<div class="time_grid notavailable"> 12:00 PM</div>';
				$html .= '<div class="time_grid notavailable"> 13:00 PM</div>';
				$html .= '<div class="time_grid notavailable"> 14:00 PM</div>';
				$html .= '<div class="time_grid notavailable"> 15:00 AM</div>';
				$html .= '<div class="time_grid notavailable"> 16:00 AM</div>';					
			}
				$html .= '</div>';
		}
		$html .= '</div>';
	}
?>
<div class="col-md-8">
		<div class="booking_date_section">		
				<h2>Click on any time to make booking</h2>
				<div class="date_section_sliding">
						<div class="owl-carousel owl-theme"><?php echo $html; ?></div>
						<div class="clearfix"></div>
				</div>		
				<div class="clearfix"></div>
		</div>
		<ul class="note">
			<li><span class="blue"></span>Not Available</li>
		    <li><span class="orange"></span>Available</li>
		    <li><span class="black"></span>Not Available Today</li>
		    <li><span class="white"><hr></span>Booked</li>
		</ul>
</div>
<div class="col-md-4">
		<div class="booking_picture">
				<div class="thumbnail-gallery">	
					<a class="img-thumbnail lightbox" id="hrefLocation" href="<?php echo base_url();?>assets/uploads/images/full/<?php echo $conference_data[0]['imageName']; ?>" data-plugin-options='{ "type":"image" }'>
						<img class="img-responsive" src="<?php echo base_url();?>assets/uploads/images/medium/<?php echo $conference_data[0]['imageName']; ?>">
						<span class="zoom">
							<i class="fa fa-search"></i>
						</span>
					</a>
				</div>
				<div class="scrollDiv">
					<div class="scrollDiv-content">
						<p><?php echo $conference_data[0]['description'];?></p>
					</div>
				</div>
		</div> 
</div>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/owl.carousel/assets/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin1/vendor/owl.carousel/assets/owl.theme.default.css" />
<script>
$( ".time_grid" ).click(function() {
  var time_grid = $( this );
  $( this ).toggleClass( "click_to_book" );
  var flag = $(this).attr('data-flag');
  $(this).attr('data-flag', $(this).attr('data-flag') == '1' ? '0' : '1')
  var date 	= $(this).data("date");
  var time 	= $(this).data("time");
  var price = $(this).data('price');
  $.get(js_site_url+"index.php/indirect_client/getCurrentHour", function(info){
   // Get the hour of server time to check the slot without reload
   	  var currentTime = $.trim(info);
   	  var currentDate = '<?= date("d-m-Y"); ?>';
	  if((parseInt(time.split(':')[0]) < parseInt(currentTime)) && (currentDate === date)){
	  	$('#messageError').html('<div class="alert alert-info fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a><strong>This slot is not available for today!</strong></div>');
	  	time_grid.removeClass("available click_to_book").addClass("notavailabletoday");
	  	return false;
	  }else{
	  	$('#messageError').html("");
	  	$.ajax({
		type: "POST",
		url: js_site_url+"index.php/indirect_client/setBookConferenceRoom",
		data: {flag:flag,date:date,time:time,price:price},
		dataType: "html",
		success: function(data, textStatus, jqXHR) {
			//code after success
	        console.log("Success Msg: "+textStatus);
	        $(".priceTable").html(data);
		},
		error: function(data, textStatus, jqXHR){
			console.log("Error Msg: "+textStatus);
			//code after getting error
		},
		complete: function(data, textStatus, jqXHR){
			console.log("Complete Msg: "+textStatus);
			//code after complete ajax request
		}
		});
	  }
  });
});
</script>
<script src="<?php echo $this->config->item('base_url');?>/html/admin1/assets/vendor/jquery/jquery.js"></script>
<script src="<?php echo $this->config->item('base_url');?>/application/modules/indirect_client/views/owl/owl.carousel-plugin.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>/assets/admin1/vendor/magnific-popup/magnific-popup.css" />
<script src="<?php echo $this->config->item('base_url');?>/html/admin1/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script>
$(document).ready(function() {
$('.lightbox').magnificPopup({
		type: 'image'
});
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    margin: 5,
    autoplay: false,
    nav: true,
    dots: false,
    loop: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1100: {
        items: 1
      }
    }
  })
})
</script>
<style type="text/css">
.scrollDiv-content {
    height: 128px;
    overflow-y: scroll;
    position: absolute;
    width: 305px;
    text-align: justify;
    padding: 6px;
}
.blue{background:#658F9F; margin-right:12px; height:12px; width:12px; display:inline-block;}
.orange{background:#E8773B; margin-right:12px; height:12px; width:12px; display:inline-block;}
.black{background:#a94442; margin-right:12px; height:12px; width:12px; display:inline-block;}
.white {display: inline-block; height: 12px; margin-right: 12px; width: 12px; border: 1px solid #000;}
.white hr{background: #000 none repeat scroll 0 0; margin: 5px 0 0;}
ul.note {margin-top: 12px;}
ul.note li{display:inline-block; padding-right:15px;}
.notavailabletoday {
    background: #a94442 none repeat scroll 0 0 !important;
    color: #fff;
    pointer-events: none;
}
</style>
<?php }else{?>
<div class="col-md-12" style="text-align: center; font-size: 15px;">
    	<b>No conference room available.</b>
</div>
<?php } ?>