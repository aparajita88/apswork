<?php setlocale(LC_MONETARY, 'en_IN'); ?>
<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/creditnote/credit_note_request_edit', $attributes); ?>
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

                    <?php /*echo '<PRE>';
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
     <input type="hidden" name="rad_<?php echo $item['c_id']; ?>" value="<?php if($item['isApproved']=='1' && $item['credit_type']=='1'){echo'1';}else if($item['isApproved']=='1' && $item['credit_type']=='2'){echo '2';}?>" >     
    <label class="radio-inline">
      <input type="radio" name="optradio_<?php echo $item['c_id']; ?>" class="radio_subcat cat_<?php echo $item['id'] ;?>" value="1"
      <?php if($item['isApproved']=='1' && $item['credit_type']=='1'){echo 'checked ';echo 'disabled';} 
      else if($item['isApproved']!='1' && $item['credit_type']=='1'){echo 'checked';}
      else if($item['isApproved']=='1' && $item['credit_type']=='2'){echo 'disabled';}?>>%
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio_<?php echo $item['c_id']; ?>" class="radio_subcat cat_<?php echo $item['id'] ;?>" value="2"
      <?php if($item['isApproved']=='1'&& $item['credit_type']=='2'){echo 'checked '; echo 'disabled';} 
      else if( $item['isApproved']!='1' && $item['credit_type']=='2'){echo 'checked';}
      else if($item['isApproved']=='1'&& $item['credit_type']=='1'){echo 'disabled';}?>>Amount
    </label>
   
    <label class="radio-inline">
    <?php if($item['isApproved']=='1'){?>
     <input type="text" class="form-control" name="qty_<?php echo $item['c_id']; ?>" id="qty_<?php echo $item['id'] ;?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php if(!empty($item['creditnote_amount'])){echo $item['creditnote_amount'];}?>" readonly>
     <?php }else{?>
     <input type="text" class="form-control" name="qty_<?php echo $item['c_id']; ?>" id="qty_<?php echo $item['id'] ;?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php if(!empty($item['creditnote_amount'])){echo $item['creditnote_amount'];}?>" >
     <?php }?>
    </label>
  
  </td>
        <td>
        <div class="form-group">
      <?php if(!empty($item['c_description']) && $item['isApproved']!='1'){?>
      <input type="text" name="description_<?php echo $item['c_id']; ?>" class="form-control" id="email" value="<?php echo $item['c_description'];?>" >
      <?php } else if(!empty($item['c_description']) && $item['isApproved']=='1'){?>
       <input type="text" name="description_<?php echo $item['c_id']; ?>" class="form-control" id="email" value="<?php echo $item['c_description'];?>" readonly >
      <?php }else{?>
      <input type="text" name="description_<?php echo $item['c_id']; ?>" class="form-control" id="email" value="" >
      <?php }?>
      <input type="hidden" value="<?php echo $invoice_items[0]['invoice_number']; ?>" name="invoice_no[]">
      <input type="hidden" value="<?php echo $invoice_items[0]['invoice_id']; ?>" name="invoice_id[]">
      <input type="hidden" value="<?php echo $item['id']; ?>" name="cat[]" class="cat">
      <input type="hidden" value="<?php echo $item['total']; ?>" name="item_price_<?php echo $item['c_id']; ?>">
      <input type="hidden" value="<?php echo $item['c_id']; ?>" name="c_id[]">
      
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