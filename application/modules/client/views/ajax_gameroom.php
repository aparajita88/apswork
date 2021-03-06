<?php setlocale(LC_MONETARY, 'en_IN');?>
<?php if(!empty($get_game_room)){ ?>
<input name="game_room_id" id="game_room_id" type="hidden" value="<?php echo $get_game_room[0]['game_id'];?>"/>
<div class="min_booking_scroll item col-md-12">
 	<div class="col-md-8 pad_left0">
    	<div class="booking_date_section booking_date_section001">
	    	 	<div class="col-md-2 selection pad_left0">
	             	<div class="form-group sub_text1">
	                	<label for="inputDefault" class="col-md-12 control-label pad_left0">Type:<span class="required">*</span></label>
	                </div>
	        	</div>
	            <?php 
	        	$game_type=$get_game_room[0]['game_type'];
	            $game_type=explode(",",$game_type);
	            ?>
	            <div class="col-md-10">
					<select name="game_type" id="game_type" class="form-control mb-md">
						<option value="">Select game room type</option>
					 	<?php foreach($game_type as $key=>$value) {
						    $game_type_name=$this->client_model->getgame_type_name($value);  
							echo '<option value="'.$game_type_name[0]['id'].'">'.$game_type_name[0]['name'].'</option>'; 
						} ?>
					</select>
				</div>
            <div class="col-md-12 selection pad_left0">
            	 <label for="inputDefault" class="col-md-2 control-label pad_left0">Date range:<span class="required">*</span></label>
                 <div class="col-md-10">
						<div class='col-md-6 pad_left0'>
					        <div class="form-group">
					            <div class='input-group date' id='datetimepicker6'>
					                <input type='text' class="form-control" value="" placeholder="From date" readonly/>
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>
					    <div class='col-md-6 pad_left0'>
					        <div class="form-group">
					            <div class='input-group date' id='datetimepicker7'>
					                <input type='text' class="form-control toDate" value="" placeholder="To date" readonly/>
					                <span class="input-group-addon">
					                    <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					    </div>
				 </div>                                  
			</div>
            <div class="clearfix"></div>
       	</div>
       	<input type="hidden" id="uprice" value="<?= $get_game_room[0]['price']; ?>">
            <input type="hidden" id="thrs"   value="">
            <div class="table-responsive priceTable pull-right">
                <table class="table table-striped mb-none changeTbl" style="display: none;">
                    <thead>
                        <tr>
                            <th>Hour(s)</th>
                            <th>Price(/hr)</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody class="lkr_data"></tbody>
                </table>
                <table class="table changeTbl" style="display: none;">
                    <tbody>
                        <tr>
                            <td>Service Tax</td>
                            <td><?= SERVICE_TAX; ?>%</td>
                            <td></td>
                            <td></td>
                            <td id='txAmnt'></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>=</td>
                            <td id='totalAmnt'></td>
                        </tr>
                    </tbody>
                </table>
            <input type="hidden" id='totalIncTax' value=""/>
            <input type="hidden" id='totalExcTax' value=""/>
            </div>
    </div>
    <div class="col-md-4">
        <div class="booking_picture">
            <div class="thumbnail-gallery">
                <a class="img-thumbnail lightbox" href="<?php echo base_url();?>assets/uploads/images/medium/<?php echo $get_game_room[0]['imageName']; ?>" data-plugin-options='{ "type":"image" }'>
                    <img class="img-responsive" src="<?php echo base_url();?>assets/uploads/images/medium/<?php echo $get_game_room[0]['imageName']; ?>">
                        <span class="zoom">
                            <i class="fa fa-search"></i>
                        </span>
                </a>
            </div>
            <p><?php echo $get_game_room[0]['description'];?></p>
        </div> 
    </div>                              
    <div class="clearfix"></div>   
</div>
<div class="clearfix"></div>   
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/front/custom_datetimepicker/css/bootstrap-datetimepicker.min.css" /> 
<script type="text/javascript">
$(function () {
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
	                return false;
	            }else{
	                $("#messageError").html('');
	                var diffSeconds = diff/1000;
	                var HH = Math.floor(diffSeconds/3600);
	                //var MM = Math.floor(diffSeconds%3600)/60;
	                //var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
	                var formatted = ((HH < 10)?("0" + HH):HH);
	                console.log(formatted); 
	                $('#thrs').val(formatted);
	            }
	    	}
            var priceTotalFloat = parseFloat($('#uprice').val()*$('#thrs').val());
            console.log(priceTotalFloat);
            var html_td = '<td>'+$('#thrs').val()+'</td><td> INR '+$('#uprice').val()+'</td><td> INR '+priceTotalFloat+'</td>';
            $('.lkr_data').html(html_td);
            var taxedAmt = (priceTotalFloat*<?= SERVICE_TAX; ?>)/100;
            var totalAmt = parseFloat(($('#uprice').val()*$("#thrs").val()) + taxedAmt).toFixed(2);
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
	                return false;
	            }else{
	                $("#messageError").html('');
	                var diffSeconds = diff/1000;
	                var HH = Math.floor(diffSeconds/3600);
	                //var MM = Math.floor(diffSeconds%3600)/60;
	                //var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM);
	                var formatted = ((HH < 10)?("0" + HH):HH);
	                console.log(formatted); 
	                $('#thrs').val(formatted);
	            }
			    
	    	}
            var priceTotalFloat = parseFloat($('#uprice').val()*$('#thrs').val());
            console.log(priceTotalFloat);
            var html_td = '<td>'+$('#thrs').val()+'</td><td> INR '+$('#uprice').val()+'</td><td> INR '+priceTotalFloat+'</td>';
            $('.lkr_data').html(html_td);
            var taxedAmt = (priceTotalFloat*<?= SERVICE_TAX; ?>)/100;
            var totalAmt = parseFloat(($('#uprice').val()*$("#thrs").val()) + taxedAmt).toFixed(2);
            $('#txAmnt').text('INR '+taxedAmt);
            $('#totalAmnt').text('INR '+totalAmt);
            $('#totalIncTax').val(totalAmt);
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
<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>/assets/admin1/vendor/magnific-popup/magnific-popup.css" />
<script src="<?php echo $this->config->item('base_url');?>/html/admin1/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script>
$(document).ready(function() {
	$('.lightbox').magnificPopup({
			type: 'image'
	});
});
</script>
<?php }else{?>
<div class="col-md-12" style="text-align: center; font-size: 15px;">
    	<b>No game room available.</b>
</div>
<?php } ?>
