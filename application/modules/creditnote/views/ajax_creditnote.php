<?php setlocale(LC_MONETARY, 'en_IN'); ?>
<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/creditnote/credit_note_request', $attributes); ?>
<div class="row" >
             
             <div class="col-md-12" style=" margin-top:10px;">
             <p><b>Details For Invoice No.<?php echo $invoice_items[0]['invoice_number'];?></b></p>
             <div style=" width:100%; border-bottom:1px solid #ccc;"></div>
     </div><!--col-md-10 end-->
     </div><!--row end-->
     <div class="row">
      <div class="col-md-12">
      
      <table class="table tables1" style="border:1px solid #ccc;">
    <thead>
      <tr>
        <th>Line item</th>
        <th>Amount</th>
        <th>Credit Requested</th>
         <th>Description</th>
      </tr>
    </thead>
    <tbody>
       <tr>
      <?php $total_main_amount = 0; ?>
                    <?php 
                    /*echo '<PRE>';
                    print_r($invoice_items);
                    echo '</PRE>';*/
                    foreach($invoice_items as $item){
                      $name = $item['table_name'];            
                      switch ($name) {
                          case "request_courier_service":
                          echo "<td>Courier Service Request</td>";
                          break;
                          case "request_food_service":
                                      echo "<td>CAFE SERVICE REQUEST</td>";
                                       /* $foods = json_decode($item['service_details']['detailes'], true);
                                        foreach ($foods as $food) {
                                            $catName = $this->invoice_model->getFoodServiceDetails($food['cat']);
                                            echo "<b style='font-size: 11px; font-style: italic;'>".$catName['name']."</b><br>";
                                            $temp = explode('|', $food['sub_cat']);
                                            $temp_qty = explode('|', $food['qty']);
                                            foreach ($temp as $k => $v) {
                                              $prodName = $this->invoice_model->getFoodServiceDetails($v);
                                              $productNameQty = ucfirst($prodName['name'])." (".$temp_qty[$k].")";
                                              echo "&nbsp;&nbsp;<b style='font-size: 11px; font-style: italic;'>".$productNameQty."</b><br>";
                                            }
                                        }*/
                          break;
                          case "request_stuff_service":
                          echo "<td>ADMIN SUPPORT REQUEST</td>";
                          break;
                          case "book_conference_room":
                          echo "<td>Booking Conference Room</td>";
                         /* $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                          }*/
                          break;
                          case "book_meeting_room":
                          echo "<td>Booking Meeting Room</td>";
                         /* $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                          }*/
                          break;
                          case "book_dayoffice":
                          echo "<td>Book Day Office</td>";
                         /* $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                          }*/
                          break;
                          case "book_locker_room":
                          echo "<td>Locker Room Book</td>";
                          break;
                          case "book_game_room":
                          echo "<td>Game Room Book</td>";
                          break;
                          case "request_conceirge_service":
                          echo "<td>Conceirge Service Request</td>";
                          break;
                          case "book_floor_plan":
                          echo "<td>Floor Plan Book</td>";
                           /* $bookings = json_decode($item['service_details']['booking_detailes'], true);
                          foreach ($bookings as $floor_plan_id) {
                            $floor_plan_name = $this->invoice_model->getFloorPlanDetails($floor_plan_id);
                              echo "&nbsp;".ucfirst($floor_plan_name['description']).'<br>';
                          }*/
                          break;
                          case "booking_virtual_office":
                          echo "<td>Virtual Office Book</td>";
                           /* $bookings = json_decode($item['service_details']['booking_detailes'], true);
                          foreach ($bookings as $floor_plan_id) {
                            $floor_plan_name = $this->invoice_model->getFloorPlanDetails($floor_plan_id);
                              echo "&nbsp;".ucfirst($floor_plan_name['description']).'<br>';
                          }*/
                          break;
                          default:
                          echo "";
                      }
                     
                     
                     
                     ?> 
     
         
        
        <td><?php echo money_format('%i', $item['total']); ?></td>
         <td>
         
    <label class="radio-inline">
      <input type="radio" name="optradio_<?php echo $item['id'] ;?>" class="radio_subcat cat_<?php echo $item['id'] ;?>" value="1">%
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio_<?php echo $item['id'] ;?>" class="radio_subcat cat_<?php echo $item['id'] ;?>" value="2">Amount
    </label>
    <label class="radio-inline">
     <input type="text" class="form-control" name="qty[]" id="qty_<?php echo $item['id'] ;?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" >
    </label>
  
  </td>
        <td>
        <div class="form-group">
      
      <input type="text" name="description[]" class="form-control" id="email" >
      <input type="hidden" value="<?php echo $invoice_items[0]['invoice_number']; ?>" name="invoice_no[]">
      <input type="hidden" value="<?php echo $invoice_items[0]['invoice_id']; ?>" name="invoice_id[]">
      <input type="hidden" value="<?php echo $item['id']; ?>" name="cat[]" class="cat">
      <input type="hidden" value="<?php echo $item['total']; ?>" name="item_price[]">
      
    </div>
    </td>
      </tr>
      
       <?php }?>
      
    </tbody>
  </table>
      
        </div>
      </div>
     <button type="button" class="btn btn-primary" id="add_classifieds">SEND REQUEST</button>
     <!--row end-->
  <script type="text/javascript">
  $(document).ready(function(){
      $("#add_classifieds").click(function(){
		 
			
			if(radiocheck() && validate_qty()){
				
				$("#form").submit();
			}else{
				return false;
			}
			
		});
      function radiocheck() {
		
		if(!$(".radio_subcat").is(":checked")) {
			alert("Must check any type!");
			return false;
		}
    
    return true;
}


function validate_qty()
	{
		
		var _cat = [];
		i=0;
		$(".cat").each(function() {
			_cat[i]=$(this).val();
			i++;
		});
		//alert(_cat);
		var f=0;
		for(i=0;i<_cat.length;i++)
		{
                  
			//if($("input:radio[class='cat_"+_cat[i]+"']").is(":checked")) {
			if($(".cat_"+_cat[i]).is(":checked")) {
				 //alert('checked');       
				 if($("#qty_"+_cat[i]).val() == "" || $("#qty_"+_cat[i]).val() == 0) 
				 {
					 alert("Plase enter the amount");
					 $("#qty_"+_cat[i]).focus();
					 return false;
				 }
			}
			else {
				if($("#qty_"+_cat[i]).val() != "") 
				 {
					 alert("Must check any type!");
					 //$("#qty_"+_cat[i]).focus();
					 return false;
				 }
			}
		}
		return true;
	}	
		
  });