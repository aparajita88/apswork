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
      <h2 class="panel-title">Credit Note Request</h2>
    </div>
     <div class="panel-body panel_body_top">
       <div class="row">
        <?php if($this->session->flashdata('item')){ ?>
            <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
            <?php } ?>
            <?php if($this->session->flashdata('item_error')){ ?>
            <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
              
             <div class="col-md-12" style=" margin-top:10px;">
             <p><b>Search Client</b></p>
             <div style=" width:100%; border-bottom:1px solid #ccc;"></div>
     </div><!--col-md-10 end-->
     </div><!--row end-->
     
     
     <div class="row" style="margin-top:15px;">
              
            <div class="col-md-3">
     
                     <div class="form-group">
                       <label for="sel1">LOCATION</label>
                     <select class="form-control" id="location" name="location">
                       <option value="0">Select Location</option>
                        <?php foreach($location as $key=>$value) {
                      
                      echo '<option value="'.$value['cityId'].'/'.$value['locationId'].'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
                    
                      
                    } ?>
                        </select>
                       
                      </div>
               </div><!--col-md-3 end-->
           <div class="col-md-3">
             <div class="form-group">
                       <label for="sel1">CLIENT LIST</label>
                     <select class="form-control" id="client" name="client">
                       <option value="0">Select Client</option>
                      
                      </select>
                     
                      </div>
            </div><!--col-md-6 end-->
            <div class="col-md-6">
            <div class="form-group">
                       <label for="sel1">INVOICE</label>
                     <select class="form-control" id="invoice" name="invoice">
                       <!--<option value="0">001/25 | RS.1200 | Not Due</option>-->
                       <option value="0">Select Invoice</option>
                      </select>
                    
                      </div>
            </div><!--col-md-3 end-->
     </div><!--row end-->
     </div>
     
     
    
     
     
     <div class="panel-body panel_body_top" >
     <?php // $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          //echo  form_open_multipart('index.php/creditnote/credit_note_request', $attributes); ?>
       <div id="ajax">
              
             <div class="col-md-12" style=" margin-top:10px;">
             <p style="text-align: center"><b>NO DATA</b></p>
            
     </div><!--col-md-10 end-->
     </div><!--row end-->
    <!-- <div class="row">
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
        <td>Monthly Fee</td>
        <td>Rs.5000</td>
         <td>
         <form role="form">
    <label class="radio-inline">
      <input type="radio" name="optradio">0%
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">Amount
    </label>
    <label class="radio-inline">
     <input type="email" class="form-control" id="email" >
    </label>
  </form>
  </td>
        <td>
        <div class="form-group">
      
      <input type="email" class="form-control" id="email" >
    </div>
    </td>
      </tr>
       <tr>
        <td>Couirer Service</td>
        <td>Rs.500</td>
         <td>
         <form role="form">
    <label class="radio-inline">
      <input type="radio" name="optradio">0%
    </label>
    <label class="radio-inline">
      <input type="radio" name="optradio">Amount
    </label>
    <label class="radio-inline">
     <input type="email" class="form-control" id="email" >
    </label>
  </form>
  </td>
        <td>
        <div class="form-group">
      
      <input type="email" class="form-control" id="email" >
    </div>
    </td>
      </tr>
      
    </tbody>
  </table>
      
        </div>
      </div>
     <button type="button" class="btn btn-primary">SEND REQUEST</button>-->
     <!--row end-->
    </div>
    </form>
  </section>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
 <script type="text/javascript">
  $(document).ready(function(){
     
 $('#location').change(function(){
    var id=$('option:selected',this).attr('value');
    if(id!=0){
    var res = id.split("/");
    var city=res[0];
    var location=res[1];
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/creditnote/get_companyby_location/"+city, 
      async: true, 
      success: function(data) { 
      
      $("#client").html(data.trim()); 
      } 
    });
 }
  });
  $('#client').change(function(){
    var id=$('option:selected',this).attr('value');
    if(id!='0'){
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/creditnote/get_invoice_bycompany/"+id, 
      async: true, 
      success: function(data) { 
     // alert(data);
      $("#invoice").html(data.trim()); 
      } 
    });
  }
  });
   $('#invoice').change(function(){
    var id=$('option:selected',this).attr('value');
  
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/creditnote/get_invoice/"+id, 
      async: true, 
      success: function(data) { 
     // alert(data);
     $("#ajax").html(data.trim()); 
      } 
    }); 
  });
  });
  </script>>