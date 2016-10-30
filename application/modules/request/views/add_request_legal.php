<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
</div>
			
	</header>
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
			<h2 class="panel-title">Request For Legal Support</h2>
			</div>
			
									<header class="panel-heading">
										
										<div class="panel-actions">
											 
										</div>
						<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/request/add_request_legal', $attributes); ?>
           <select class="design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											
											if($userData['city_id']==$value['cityId']){
											echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select  class="design_select" name="location" id="location" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
											
												if($userData['location_id']==$value['locationId']){
											echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
										} 
											
										} ?>
                                    </select>
										<h2 class="panel-title"></h2>
									</header>
									<div class="panel-body">
										
											
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>  <div id="messageError" class="col-md-12"></div>
											
                                  <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Vendor name<span class="required">*</span></label>
												<div class="col-md-7">
													<select name="vendor_name" id="vendor_name" class="form-control mb-md">
														<option value="0">Select vendor name</option>
													 <?php foreach($vendor as $key=>$value) {
											
											
												echo '<option value="'.$value['id'].'">'.$value['name'].'</option>'; 
											
										} ?>
														
													</select>
						
											
												</div>
											</div>
						
											
						                        
						                       				
											<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Type of services<span class="required">*</span></label>
		<div class="col-md-7" >
				
				 <input type="radio" name="size" checked value="hourly" id="hourly"/>Hourly Basis
				 <input type="radio" name="size" value="day" id="day"/>Day Basis
 
		</div>
	</div>
						                    


	<div class="form-group first">
            	 <label for="inputDefault" class="col-md-3 control-label pad_left0">Date range:<span class="required">*</span></label>
                 <div class="col-md-7">
						<div class="col-md-6 padding0">
					        <div class="form-group">
					            <div class="input-group date" id="datetimepicker6">
					                <input type="text" class="form-control" value="" placeholder="From date" name="start_date" readonly="">
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-6 padding0">
					        <div class="form-group">
					            <div class="input-group date" id="datetimepicker7">
					                <input type="text" class="form-control toDate" value="" placeholder="To date" name="end_date" readonly="">
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>
				 </div>                                  
			</div>

			<div class="form-group second" style="display: none;">
            	 <label for="inputDefault" class="col-md-3 control-label pad_left0">Date range:<span class="required">*</span></label>
                 <div class="col-md-7">
						<div class="col-md-6 padding0">
					        <div class="form-group">
					            <div class="input-group date" id="datetimepicker8">
					                <input type="text" class="form-control" value="" placeholder="From date" name="start_date_day" readonly="">
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>
					    <div class="col-md-6 padding0">
					        <div class="form-group">
					            <div class="input-group date" id="datetimepicker9">
					                <input type="text" class="form-control toDate" value="" placeholder="To date" name="end_date_day"  readonly="">
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>
				 </div>                                  
			</div>
											<div class="form-group">
		<label class="col-md-3 control-label" for="inputDefault">Details<span class="required">*</span></label>
		<div class="col-md-7" >
				 <textarea rows="4" id="autocomplete" cols="50" name="detailes" placeholder="Enter details" class="widht_text_area form-control"></textarea>
 
		</div>
	</div>
										
									
		<input type="hidden" name="totalIncTax" value=""   id="totalIncTax">						
	    <input type="hidden" id="uprice" name="uprice" value="<?= $request[0]['hourly_price']; ?>">
        <input type="hidden" id="thrs"   name="thrs" value="">
					
					
		<input type="hidden" name="totalIncTax_day" value=""   id="totalIncTax_day">						
	    <input type="hidden" id="uprice_day" name="uprice_day" value="<?= $request[0]['day_price']; ?>">
        <input type="hidden" id="thrs_day"   name="thrs_day"  value="">
	
								
	  
		
        
						
						
				
			
					</form>
				
		
	
		</div>
	
	
<div class="panel-footer">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<button type="button" id="add_classifieds" class="btn btn-primary">Place Request</button>
			</div>
		</div>
		</div>
	 <?php echo form_close();?>

			</div>
	
		</div>
	</div>
	
<!-- end: page -->
	</section>
<div class="clearfix"></div>
	



</section>
<style>
.padding0{
	padding: 0 0 0 0;
}
.redmessage{
border:1px solid #f00;
color:#f00;                                                       	
	
}
.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
.redmessage::-moz-placeholder {
    color: #FF0000;
 }

.redmessage::-webkit-input-placeholder 
{
  color: #FF0000;
}

</style>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/css/bootstrap-datetimepicker.min.css" /> 		
<script type="text/javascript">
  
$(function () {
	$("input[name='size']").click(function () {
			$("#messageError").html('');
	        $('#autocomplete').removeAttr('readonly');
	        $("#datetimepicker6 input").val(''); 
	        $("#datetimepicker7 input").val(''); 
	        $("#datetimepicker8 input").val(''); 
	        $("#datetimepicker9 input").val(''); 
            if ($("#day").is(":checked")) {
            	$(".second").css('display','block');
                $(".first").css('display','none');
            } else if($("#hourly").is(":checked")){
                $(".second").css('display','none');
                $(".first").css('display','block');
            }
        });
    $('#datetimepicker6').datetimepicker({
        daysOfWeekDisabled: [0, 6],
        format: 'YYYY-MM-DD hh:00 A',
        ignoreReadonly: true,
        useCurrent: false,
    }).on('dp.show', function (e) {
    	$('#datetimepicker6').data("DateTimePicker").minDate(e.date);
    	$('a.btn[data-action="incrementMinutes"], a.btn[data-action="decrementMinutes"]').removeAttr('data-action').attr('disabled', true);
    	$('span.timepicker-minute[data-action="showMinutes"]').removeAttr('data-action').attr('disabled', true).text('00');
	}).on('dp.change', function (e) {
		$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    	$(this).val($(this).val().split(':')[0]+':00');
    	$('span.timepicker-minute').text('00');
	}).on("dp.hide", function (e) {
    	if($("#datetimepicker6 input").val() != '' && $("#datetimepicker7 input").val() != ''){
			start_actual_time 	= $("#datetimepicker6 input").val().replace("-",',').replace("-",',');
	    	end_actual_time 	= $("#datetimepicker7 input").val().replace("-",',').replace("-",',');
	    	if(end_actual_time != '' && start_actual_time != ''){
	    		start_actual_time 	= new Date(start_actual_time);
			    end_actual_time 	= new Date(end_actual_time);
			    var diff = end_actual_time - start_actual_time;
			    if(diff == 00){
	                $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please change end time on same date!</strong></div>');
	                $("#autocomplete").attr('readonly','readonly');
	                return false;

	            }else{
	                $("#messageError").html('');
	                $('#autocomplete').removeAttr('readonly');
	                var diffSeconds = diff/1000;
	                var HH = Math.floor(diffSeconds/3600);
	                //var MM = Math.floor(diffSeconds%3600)/60;
	                //var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
	                var formatted = ((HH < 10)?("0" + HH):HH);
	                console.log(formatted); 
	                 $('#thrs_day').val('');
	                $('#totalIncTax_day').val('');
	                $('#thrs').val(formatted);
	            }
	    	}
            var priceTotalFloat = parseFloat($('#uprice').val()*$('#thrs').val());
            console.log(priceTotalFloat);
            var html_td = '<td>'+$('#thrs').val()+'</td><td> INR '+$('#uprice').val()+'</td><td> INR '+priceTotalFloat+'</td>';
            $('.lkr_data').html(html_td);
            var taxedAmt = (priceTotalFloat*14)/100;
            var totalAmt = parseFloat(($('#uprice').val()*$("#thrs").val())).toFixed(2);
            $('#txAmnt').text('INR '+taxedAmt);
            $('#totalAmnt').text('INR '+totalAmt);
            $('#totalIncTax').val(totalAmt);
            $('#totalExcTax').val(priceTotalFloat);
            $('.changeTbl').css('display','block');
        }else{
            $('.changeTbl').css('display','none');
        }
    });
    $('#datetimepicker7').datetimepicker({
        daysOfWeekDisabled: [0, 6],
        format: 'YYYY-MM-DD hh:00 A',
        ignoreReadonly: true,
        useCurrent: false,
    }).on('dp.show', function (e) {
    	$('a.btn[data-action="incrementMinutes"], a.btn[data-action="decrementMinutes"]').removeAttr('data-action').attr('disabled', true);
    	$('span.timepicker-minute[data-action="showMinutes"]').removeAttr('data-action').attr('disabled', true).text('00');
	}).on('dp.change', function (e) {
		$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    	$(this).val($(this).val().split(':')[0]+':00');
    	$('span.timepicker-minute').text('00');
	}).on("dp.hide",function(e) {
        if($("#datetimepicker6 input").val() != '' && $("#datetimepicker7 input").val() != ''){
        	start_actual_time 	= $("#datetimepicker6 input").val().replace("-",',').replace("-",',');
	    	end_actual_time 	= $("#datetimepicker7 input").val().replace("-",',').replace("-",',');
	    	if(end_actual_time != '' && start_actual_time != ''){
	    		start_actual_time 	= new Date(start_actual_time);
			    end_actual_time 	= new Date(end_actual_time);
			    var diff = end_actual_time - start_actual_time;
	            if(diff == 00){
	                $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please change end time on same date!</strong></div>'); 
	                $("#autocomplete").attr('readonly','readonly');
	                return false;
	            }else{
	                $("#messageError").html('');
	                $('#autocomplete').removeAttr('readonly');
	                var diffSeconds = diff/1000;
	                var HH = Math.floor(diffSeconds/3600);
	                //var MM = Math.floor(diffSeconds%3600)/60;
	                //var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
	                var formatted = ((HH < 10)?("0" + HH):HH);
	                console.log(formatted); 
	                 $('#totalIncTax_day').val('');
	                $('#thrs_day').val('');
	                $('#thrs').val(formatted);
	            }
			    
	    	}
            var priceTotalFloat = parseFloat($('#uprice').val()*$('#thrs').val());
            console.log(priceTotalFloat);
            var html_td = '<td>'+$('#thrs').val()+'</td><td> INR '+$('#uprice').val()+'</td><td> INR '+priceTotalFloat+'</td>';
            $('.lkr_data').html(html_td);
            var taxedAmt = (priceTotalFloat*14)/100;
            var totalAmt = parseFloat(($('#uprice').val()*$("#thrs").val())).toFixed(2);
            $('#txAmnt').text('INR '+taxedAmt);
            $('#totalAmnt').text('INR '+totalAmt);
            $('#totalIncTax').val(totalAmt);
            $('#totalExcTax').val(priceTotalFloat);
            $('.changeTbl').css('display','block');
        }else{
            $('.changeTbl').css('display','none');
        }
	});
//---------------------------------------------------
	$('#datetimepicker8').datetimepicker({
        daysOfWeekDisabled: [0, 6],
        format: 'YYYY-MM-DD',
        ignoreReadonly: true,
        useCurrent: false,
    }).on('dp.show', function (e) {
    	$('#datetimepicker8').data("DateTimePicker").minDate(e.date);
    	$('a.btn[data-action="incrementMinutes"], a.btn[data-action="decrementMinutes"]').removeAttr('data-action').attr('disabled', true);
    	$('span.timepicker-minute[data-action="showMinutes"]').removeAttr('data-action').attr('disabled', true).text('00');
	}).on('dp.change', function (e) {
		$('#datetimepicker9').data("DateTimePicker").minDate(e.date);
    	$(this).val($(this).val().split(':')[0]+':00');
    	$('span.timepicker-minute').text('00');
	}).on("dp.hide", function (e) {
    	if($("#datetimepicker8 input").val() != '' && $("#datetimepicker9 input").val() != ''){
			start_actual_time 	= $("#datetimepicker8 input").val().replace("-",',').replace("-",',');
	    	end_actual_time 	= $("#datetimepicker9 input").val().replace("-",',').replace("-",',');
	    	if(end_actual_time != '' && start_actual_time != ''){
	    		start_actual_time 	= new Date(start_actual_time);
			    end_actual_time 	= new Date(end_actual_time);
			    var diff = end_actual_time - start_actual_time;
			    var days = diff/1000/60/60/24;
               // alert(days);
			   
			    if(diff == 00){
	              /*  $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please change end time on same date!</strong></div>');*/
	                return false;
	            }else{
	                $("#messageError").html('');
	                var diffSeconds = diff/1000;
	                var HH = Math.floor(diffSeconds/3600);
	                //var MM = Math.floor(diffSeconds%3600)/60;
	                //var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
	                var formatted = ((HH < 10)?("0" + HH):HH);
	                console.log(formatted); 
	                $('#totalIncTax').val('');
	                $('#thrs').val('');
	                $('#thrs_day').val(days);
	            }
	    	}
            var priceTotalFloat = parseFloat($('#uprice_day').val()*$('#thrs_day').val());
            console.log(priceTotalFloat);
            var html_td = '<td>'+$('#thrs_day').val()+'</td><td> INR '+$('#uprice_day').val()+'</td><td> INR '+priceTotalFloat+'</td>';
            $('.lkr_data').html(html_td);
            var taxedAmt = (priceTotalFloat*14)/100;
            var totalAmt = parseFloat(($('#uprice_day').val()*$("#thrs_day").val())).toFixed(2);
            $('#txAmnt').text('INR '+taxedAmt);
            $('#totalAmnt').text('INR '+totalAmt);
            $('#totalIncTax_day').val(totalAmt);
            $('#totalExcTax').val(priceTotalFloat);
            $('.changeTbl').css('display','block');
        }else{
            $('.changeTbl').css('display','none');
        }
    });
    $('#datetimepicker9').datetimepicker({
        daysOfWeekDisabled: [0, 6],
        format: 'YYYY-MM-DD',
        ignoreReadonly: true,
        useCurrent: false,
    }).on('dp.show', function (e) {
    	$('a.btn[data-action="incrementMinutes"], a.btn[data-action="decrementMinutes"]').removeAttr('data-action').attr('disabled', true);
    	$('span.timepicker-minute[data-action="showMinutes"]').removeAttr('data-action').attr('disabled', true).text('00');
	}).on('dp.change', function (e) {
		$('#datetimepicker8').data("DateTimePicker").maxDate(e.date);
    	$(this).val($(this).val().split(':')[0]+':00');
    	$('span.timepicker-minute').text('00');
	}).on("dp.hide",function(e) {
        if($("#datetimepicker8 input").val() != '' && $("#datetimepicker9 input").val() != ''){
        	start_actual_time 	= $("#datetimepicker8 input").val().replace("-",',').replace("-",',');
	    	end_actual_time 	= $("#datetimepicker9 input").val().replace("-",',').replace("-",',');
	    	if(end_actual_time != '' && start_actual_time != ''){
	    		start_actual_time 	= new Date(start_actual_time);
			    end_actual_time 	= new Date(end_actual_time);
			    var diff = end_actual_time - start_actual_time;
			    var days = diff/1000/60/60/24;
	            if(diff == 00){
	               /* $("#messageError").html('<div style="margin-top:18px;" class="alert alert-danger fade in"><a title="close"  aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Please change end time on same date!</strong></div>');
	                return false;*/
	            }else{
	                $("#messageError").html('');
	                var diffSeconds = diff/1000;
	                var HH = Math.floor(diffSeconds/3600);
	                //var MM = Math.floor(diffSeconds%3600)/60;
	                //var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
	                var formatted = ((HH < 10)?("0" + HH):HH);
	                console.log(formatted); 
	                $('#totalIncTax').val('');
	                $('#thrs').val('');
	                $('#thrs_day').val(days);
	            }
			    
	    	}
            var priceTotalFloat = parseFloat($('#uprice_day').val()*$('#thrs_day').val());
            console.log(priceTotalFloat);
            var html_td = '<td>'+$('#thrs_day').val()+'</td><td> INR '+$('#uprice_day').val()+'</td><td> INR '+priceTotalFloat+'</td>';
            $('.lkr_data').html(html_td);
            var taxedAmt = (priceTotalFloat*14)/100;
            var totalAmt = parseFloat(($('#uprice_day').val()*$("#thrs_day").val())).toFixed(2);
            $('#txAmnt').text('INR '+taxedAmt);
            $('#totalAmnt').text('INR '+totalAmt);
            $('#totalIncTax_day').val(totalAmt);
            $('#totalExcTax').val(priceTotalFloat);
            $('.changeTbl').css('display','block');
        }else{
            $('.changeTbl').css('display','none');
        }
	});
});
</script>
<style type="text/css">
    .table.table-striped.mb-none.changeTbl {
        text-align: center !important;
        margin-right: 10px !important;
    }
	.day.weekend.disabled, .day.weekend.disabled:hover {
    background: #FFCBCB !important;
    color: #777 !important;
    cursor: not-allowed !important;
	}
	.day.disabled, .day.disabled:hover {
    background: #FBEEE6 !important;
    color: #777 !important;
    cursor: not-allowed !important;
	}
	.month.disabled, .month.disabled:hover {
    background: #FBEEE6 !important;
    color: #777 !important;
    cursor: not-allowed !important;
	}
	.year.disabled, .year.disabled:hover {
    background: #FBEEE6 !important;
    color: #777 !important;
    cursor: not-allowed !important;
	}
</style>

<script type="text/javascript">
	
     $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 
			//alert('1');
			if(cityValidation() && locationValidation() && vendorName() &&  classifiedsAddressValidation()){
				
				$("#form").submit();
			}else{
				return false;
			}
			
		});
			});
		
		
        
     
function get_location(value)
{
	//alert(js_site_url);
	//alert(value);

	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getlocationbycity", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#location").html(data.trim()); 
      } 
    });
}
  
        
         </script>
     
