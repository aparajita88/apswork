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
      <h2 class="panel-title">ADD CONTACT</h2>
    </div>
     <div class="panel-body panel_body_top">
      <?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/receptionist/add_contacts', $attributes);?>
     <div class="row">
      <?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
             <div class="col-md-3">
     
                     <div class="form-group">
                       <label for="sel1">CLIENT NAME</label>
                     <select class="form-control" id="client" name="client">
                       <option value="0">Select Client</option>
                       <?php
                       if(!empty($company_data)){
                       foreach($company_data as $key=>$value) {
                                    
                                    echo '<option value="'.$value['id'].'">'.$value['userEmail'].'('.$value['company_name'].')</option>'; 
                                   
                                    
                                }
                                foreach($company_data_individual as $key=>$value) {
                                    
                                    echo '<option value="'.$value['company_id'].'">'.$value['userEmail'].' (INDIVIDUAL)</option>'; 
                                   
                                    
                                } 
                                }else{?>
                                  <option value="0">No Client</option>
                                <?php }?>
                       </select>
                      
                      </div>
               </div><!-------col-md-2 end--->
               
      <div class="col-md-10">
     </div><!-------col-md-10 end--->
     </div><!-------row end--->
     
   
     
     <div class="row">
              
      <div class="col-md-12" style=" margin-top:10px;">
      <p><b>Add New Contact</b></p>
      <div style=" width:100%; border-bottom:1px solid #ccc;"></div>
     </div><!-------col-md-10 end--->
     </div><!-------row end--->
     
     
     
      <div class="row" style=" margin-top:15px;">
              
      <div class="col-md-3 col-xs-3 col-sm-3 col_mds_cl">
     <div class="form-group">
      <label for="email">Contact Name</label>
      <input type="text" class="form-control" name="first_name" value="" id="first_name" >
    </div>
     </div><!-------col-md-10 end--->
      <div class="col-md-3 col-xs-3 col-sm-3 col_mds_cl">
      <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email"   value="" id="email">
    </div>
     </div>
     <div class="col-md-3 col-xs-3 col-sm-3 col_mds_cl">
      <div class="form-group">
      <label for="email">Phone No</label>
      <input type="text" class="form-control" name="phone" value="" id="phone"  onblur="phonenumber();">
    </div>
     </div>
     <div class="col-md-3 col-xs-3 col-sm-3 col_mds_cl">
     <div class="form-group">
      <label for="email">Photo</label>
      <input type="file" class="form-control"  name="ListeeTypeImage" id="ListeeTypeImage" >
    </div>
     </div>
     <div class="col-md-3 col-xs-3 col-sm-3 col_mds_cl">
      <div class="form-group">
      <label for="email">Password</label>
      <input type="password" class="form-control" id="password" name="password" value="" >
    </div>
     </div>
     </div><!-------row end--->
     
     
     
     
     
     
      
     <div class="row" style="margin-top:15px;">
             <div class="col-md-2">
     
                    <button type="button" id="add_classifieds" class="btn btn-primary">Add Contact</button>
               </div><!-------col-md-2 end--->
         </form>      
      <div class="col-md-10">
     </div><!-------col-md-10 end--->
     </div><!-------row end--->
     
     
     
     
     
     
     <div class="row">
              
      <div class="col-md-12" style=" margin-top:10px;">
      <p><b>Existing Contacts</b></p>
      <div style=" width:100%; border-bottom:1px solid #ccc;"></div>
     </div><!-------col-md-10 end--->
     </div><!-------row end--->
     
     
        
        
        
        
        
        
        <div class="cende-table" style="width: 100%; display: inline-block; margin: 13px 1px 0;">
        <div class="table-responsive" id="ajax_data">
         
       <table class="table table-bordered table-striped">
		<thead>
		<tr role="row">
        <th>Contact Name</th>
        <th>Phone No</th>
         <th>Email</th>
         <th>Profile Photo</th>
         <th>Is Primary</th>
          <th>Can View Bill</th>
         <th>Status</th>
         <th>Action</th>
         </tr>
		</thead><tr><td colspan="8">No Contacts</td></tr>
                
		<!--<tbody>
          <tr>
            <td>S.Chakladar</td>
            <td>1234567890</td>
            <td>Sc@tcs.com</td>
            <td><img src="http://smartworks.demostage.net/assets/front/images/no.png" class="center-block" width="80" height="80"/></td>
           <td class="center hidden-phone">
			 <span style="font-size: 20px;"><i class="fa fa-pencil" aria-hidden="true"></i></span>
              <span style="font-size: 20px;"><i class="fa fa-trash"></i></span>
			</td>
            
          </tr>
           <tr>
            <td>S.Chakladar</td>
            <td>1234567890</td>
            <td>Sc@tcs.com</td>
            <td><img src="http://smartworks.demostage.net/assets/front/images/no.png" class="center-block" width="80" height="80"/></td>
           <td class="center hidden-phone">
           <span style="font-size: 20px;"><i class="fa fa-pencil" aria-hidden="true"></i></span>
			 <span style="font-size: 20px;"><i class="fa fa-trash"></i></span>
              
			</td>
            
          </tr>
           
		</tbody>>-->
       </table>
        </div>
        </div>
     </div>
    
   
  
  
  </section>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<style type="text/css">
  .cende-table tr td a { background: none !important; color: #0099e6 !important; text-decoration: none !important; width: auto !important; border-radius: 0px;}
</style>>
  <script type="text/javascript">
  $(document).ready(function(){
    
	$("#add_classifieds").click(function(){
	if(selectclient() && firstNameValidation()  && lastNameValidation() && emailValidation() && passwordValidation()){
		$("#form").submit();
	}else{
		return false;
	}
	});

    $('#client').change(function(){
    var id=$('option:selected',this).attr('value');
   // alert(id);
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/get_client_bycompany/"+id, 
      async: true, 
      success: function(data) { 
        //alert(data);
       $("#ajax_data").html(data.trim()); 
      } 
    }); 
  });
 });
  
  function approve_client(val){
  //alert(id);
  $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/approve_client/"+val, 
      async: true, 
      success: function(data) { 
        //alert(data);
       $("#statusId"+val).html(data.trim()); 
      } 
    }); 
  }
function approve_primary(val){
$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/approve_primary/"+val, 
      async: true, 
      success: function(data) { 
        alert(data);
       //$("#statusId"+val).html(data.trim()); 
      } 
    }); 
}
function approve_canview(val){
$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/receptionist/approve_canview/"+val, 
      async: true, 
      success: function(data) { 
        alert(data);
       //$("#statusId"+val).html(data.trim()); 
      } 
    }); 
 
}
</script>