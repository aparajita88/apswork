<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
    <div class="right-wrapper pull-right">
      </ol>
    </div>
  </header>
  <section class="panel">
    <div class="panel-body">
      <h2 class="panel-title">Center Dashboard</h2>
    </div>
     <div class="panel-body panel_body_top">
     <div class="col-md-3 selection">
        <div class="form-group sub_text1">
           <label for="inputDefault" class="control-label">City  :</label>
           <div class="">
         <select class="form-control" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                <option value="0">Select City</option>
                                 <?php foreach($cities as $key=>$value) {
                                    if($userData['city_id']==$value['cityId']){
                                    echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
                                   }else{
                                    echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
                                   }
                                    
                                } ?>
                            </select> 
        </div>
        </div>
     </div>
     
     <div class="col-md-3 selection pad_left0">
      <div class="form-group sub_text1">
              
        <label for="inputDefault" class="control-label ">Location :</label>
        <div class="">
         <select class="form-control" name="location" id="location" onchange="get_business(this.value)" onclick="removeValidateHtml('location')">
                                <option value="0">Select Location</option>
                                 <?php foreach($location as $key=>$value) {
                                    if($userData['location_id']==$value['locationId']){
                                        echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>';
                                    }else{
                                        echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
                                    }
                                        
                                } ?>
                            </select>
        </div>
        
      </div>
    </div>
        
        <div class="col-md-3 selection">
      <div class="form-group sub_text1">
         <label for="inputDefault" class="control-label pad_left0">Business Centers :</label>
        <div class="">
        <select  class="form-control" name="business" id="business" onchange="getroomsBybusiness(this.value)" onclick="removeValidateHtml('business')" >
                                <?php foreach($business_data as $key=>$value) {
                                    echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>';  
                                } ?>
                            </select>
        </div>
        
      </div>
    </div>
        
        <div class="col-md-3 selection">
      <div class="form-group sub_text1">              
        <label for="inputDefault" class="control-label pad_left0">Rooms :</label>
        <div class="">
        <select class="form-control" name="room" id="room" onchange="bookingdata()">
              <?php if(!empty($mainArray))
    {
      foreach($mainArray as $key=>$value)
      {
        foreach($value as $v){
        echo '<option value="'.$key.'/'.$v['id'].'">'.$key.':'.$v['name'].'</option>';
        }
      }     
    }else{
      echo '<option value="0">No Rooms Available</option>';
      
    }?>      
      </select>
        </div>
        
      </div>
    </div>
        
        <div class="col-md-3 selection" >
        <div class="form-group sub_text1">              
      <label for="inputDefault" class="control-label pad_left0">Date :</label>
           <div class="input-daterange input-group" data-plugin-datepicker>
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text" value="<?php echo date('m/d/Y');?>" class="form-control" placeholder="Enter start Date" name="date" id="date" onchange="bookingdata()">    
                          </div>
            </div>
    </div>
       <div class="cende-table" id="ajax_table">
        <div class="table-responsive">
         <table class="table table-bordered table-striped"  >
    <thead>
    <tr role="row">
        <th>DATE</th>
        <th>START TIME</th>
         <th>END TIME</th>
         <th>ROOM</th>
         <th>BOOKED BY</th>
         <th>STATUS</th>
         <th>ACTION</th>
        </tr>
    </thead>
    <tbody id="tbbookdata">
          <?php if(!empty($book_data)){
    foreach($book_data as $bk_data){
       if($bk_data['status']==0){
            $status="";
        }else if($bk_data['status']=="1"){
            $status="Checked In";
        }else if($bk_data['status']=="2"){
            $status="Checked In";
        }
      ?>
    <tr>
            <td><?php echo $bk_data['date'];?></td>
            <td><?php echo $bk_data['start_time'];?></td>
            <td><?php echo $bk_data['end_time'];?></td>
            <td><?php echo $bk_data['Room'];?></td>
            <td><?php echo $bk_data['client'];?></td>
            <td><?php echo $status;?></td>
            <td><?php if($status<>"Checked In" && $status<>"Checked In"){?>
           <a href="javascript:void(0)" onclick="fncheckin('<?php echo $bk_data['id'];?>','<?php echo $bk_data['table'];?>','<?php echo $bk_data['start_time'];?>','<?php echo $bk_data['end_time'];?>','<?php echo date('Y-m-d',strtotime($bk_data['date']));?>','1')" style="background-color: #000">Check In</a>
           <?php }else if($status=="Checked In"){?>
               <a href="javascript:void(0)" onclick="fncheckin('<?php echo $bk_data['id'];?>','<?php echo $bk_data['table'];?>','<?php echo $bk_data['start_time'];?>','<?php echo $bk_data['end_time'];?>','<?php echo date('Y-m-d',strtotime($bk_data['date']));?>','2')" style="background-color: #000">Check Out</a>
           <?php }?></td>
          </tr>
    <?php }}else{?>
    <tr>
        <td colspan="7">No data Available</td>
    </tr>
    <?php }?>

    </tbody>
    </table>
        </div>
        </div>
     </div>
    
   
  </form>
  </section>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>

 <script type="text/javascript">
  $(document).ready(function(){
    var room_id = $("#room").val();
    var res = room_id.split("/");
    var id=res[1];
    var type=res[0];
    
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/get_ajax_booking_room/"+id+"/"+type, 
      async: true, 
      success: function(data) { 
        //alert(data);
       //$("#ajax_table").html(data.trim()); 
      } 
    }); 
  });
  function get_location(value){
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/client/getlocationbycity/"+value,  
      async: true, 
      success: function(data) { 
        //alert(data);
        $("#location").html(data.trim()); 
      } 
    });
}   
function get_business(value){
    var city = $("#city").val();
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/client/getBusinessByLocation/"+value+"/"+city, 
      async: true, 
      success: function(data) { 
        //alert(data);
        $("#business").html(data.trim()); 
      } 
    });
}  
function getroomsBybusiness(value){
var business = $("#business").val();
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/getroomsBybusiness/"+value, 
      async: true, 
      success: function(data) { 
        //alert(data);
        $("#room").html(data.trim()); 
      } 
    });
}
function bookingdata(){
   var bookingdate=$('#date').val();
   var bookingid=$('#room').val();

   $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/getbookingofroom", 
      data: {'bookingdate':bookingdate,'bookingid':bookingid },
      async: true, 
      success: function(data) { 
        
        $('#tbbookdata').html(data);
      } 
    });
   
}
function fncheckin(id,tb,sttime,endtime,bkdate,status){
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/get_checkin_checkout_booking_room",
      data: {'bookingid':id,'table':tb,'start':sttime,'end':endtime,'booking_date':bkdate,'status':status}, 
      async: true, 
      success: function(data) { 
        alert(data);
        location.reload();
      } 
    });
}
 </script>
 
