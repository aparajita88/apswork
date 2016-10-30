<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
    <div class="right-wrapper pull-right">
      </ol>
    </div>
  </header>
  <section class="panel">
    <?php if($this->session->flashdata('item')){ ?>
    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
    <?php } ?>
    <?php if($this->session->flashdata('item_error')){ ?>
    <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
    <?php } ?>
    <div class="panel-body">
      <h2 class="panel-title">virtual office booking</h2>
    </div>
    <div class="panel-body panel_body_top"> 
    	<div class="col-md-3 selection pad_left0">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label ">Location :</label>
              <div class="col-md-12 ">
                <select class="form-control mb-md" name="location" id="location" onchange="get_business(this.value)">
                 <option value="1">Select Location</option>
                     <?php foreach($location as $key=>$value) {
                      
                      echo '<option value="'.$value['cityId'].'/'.$value['locationId'].'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
                    
                      
                    } ?>
    
                </select>
              </div>
            </div>
      </div>
      <div class="col-md-3 selection">
            <div class="form-group sub_text1">
              <label for="inputDefault" class="col-md-12 control-label pad_left0">Business Centers :</label>
              <div class="col-md-12 pad_left0">
                <select  class="form-control mb-md" name="business" id="business" onchange="getvirtualofficeBybusiness(this.value)" >
                 <option value="1">Select Business </option>
                  <?php foreach($business_data as $key=>$value) {
                                                
                                                
                                                echo '<option value="'.$value['business_id'].'" >'.$value['businessName'].'</option>'; 
                                            
                                                
                                            } ?>
                </select>
              </div>
            </div>
      </div>
      <div class="clearfix"></div>
        <div id="ajax"></div>
    </div>
   
      <!--ajax-->
  
  
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script>
function get_business(value)
{
  //alert(js_site_url);
  //alert(value);
 var res = value.split("/");

 
  $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getBusinessByLocation", 
      data: { id:res[1],city:res[0], }, 
      async: false, 
      success: function(data) { 
      //alert(data);
      
        $("#business").html(data.trim()); 
      } 
    });
}   
function getvirtualofficeBybusiness(value){

$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/business/getvirtualofficeBybusiness", 
      data: { id:value, }, 
      async: false, 
      success: function(data) { 
        if(data != ''){
          $("#ajax").html(data.trim());
        }
      } 
    });


}
</script> 
<style type="text/css">
  .black{
    border: 2px solid #000 !important;
  }
</style>
