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
      <h2 class="panel-title">New Customer Enquiry</h2>
    </div>
    <div class="panel-body panel_body_top">
    <?= (isset($message) && $message != '') ? $message : '';?>
   <form class="mainform" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/manager/enquiry">
            <div class="col-lg-6">
              <div class="form-group">
                  <label>Prospect Details</label>
                    <div class="row">
                      <div class="form-group">
                          <div class="col-lg-3" style="padding-right: 0px;">
                            <select name="gender" id="gender" class="form-control selection2">
                                <option value="">Title</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Miss.">Miss.</option>
                            </select>
                          </div>
                          <input type="hidden" id="uid" name="uid" value="">
                          <div class="col-lg-4" style="padding-left: 4px;padding-right: 2px;">
                            <input type="text" class="form-control" placeholder="First Name" id="txtFname" name="txtFname" required onkeyup="ajaxSearchF();"/>
                            <div id="suggestionsF">
                                <div id="autoSuggestionsListF"></div>
                            </div>
                          </div>
                          <div class="col-lg-5" style="padding-left: 2px;padding-right: 24px;">
                            <input type="text" class="form-control" placeholder="Last Name" id="txtLname" name="txtLname" required onkeyup="ajaxSearchL();"/>
                             <div id="suggestionsL">
                                <div id="autoSuggestionsListL"></div>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-lg-6">
                            <input type="text" class="form-control" placeholder="Email" id="txtEmail" name="txtEmail"/>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="form-control" placeholder="Phone" id="txtPhone" name="txtPhone"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-lg-12">
                            <input type="text" class="form-control" placeholder="Company" id="txtCompany" name="txtCompany"/>
                          </div>
                      </div>
                    </div>
              </div>
              <hr />
              <div class="form-group">
                  <label>Address</label>
                    <div class="row">
                      <div class="form-group">
                          <div class="col-lg-12">
                            <input type="text" class="form-control" placeholder="Street" id="txtStreet" name="txtStreet"/>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-lg-6">
                            <select name="city" id="city" class="fform-control selection2">
                              <option value="0">Select City</option>
                              <?php foreach($cities as $key=>$value) {
                                if($userData['city_id']==$value['cityId']){
                                   echo '<option value="'.$value['cityId'].'" selected>'.ucfirst($value['name']).'</option>'; 
                                }else{
                                  echo '<option value="'.$value['cityId'].'">'.ucfirst($value['name']).'</option>'; 
                                }
                              } ?>
                            </select>
                          </div>
                          <div class="form-group">
                          <div class="col-lg-6">
                              <input type="text" class="form-control" placeholder="Zip" id="txtZip" name="txtZip"/>
                          </div>
                      </div>
                      </div>
                    </div>
              </div>
              <hr />
              <div class="form-group">
                  <label>Enquiry Source</label>
                    <div class="row">
                      <div class="form-group">
                          <div class="col-lg-12">
                            <select name="source" id="source" class="form-control selection2" onchange="get_source_detail(this.value)">
                                <option value="">Source</option>
                                <option value="web">Web</option>
                                <option value="brokers">Brokers</option>
                                <option value="internet-brokers">Internet Brokers</option>
                                <option value="ist">IST</option>
                                <option value="referral">Referral</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                         <div class="col-lg-12">
                            <select name="sourceDetail" id="sourceDetail" class="form-control selection2">
                                <option value="">Source Detail</option>
                            </select>
                          </div>
                      </div>
                    </div>
              </div>
              <hr />
            </div>
            <div class="col-lg-6" style="border-left: 1px solid #ddd;">
              <div class="form-group">
                <div class="col-lg-12">
                <label>Requirement</label>
                  <select name="sltProduct" id="sltProduct" class="form-control selection2">
                      <option value="">Select Product</option>
                      <option value="private-office">Private Office</option>
                      <option value="virtual-office">Virtual Office</option>
                      <option value="cubes">Cubes</option>
                      <option value="eco-cube">Eco Cube</option>
                      <option value="think-cube">Think Cube</option>
                      <option value="conference">Conference</option>
                      <option value="leasing">Leasing</option>
                      <option value="no-product-of-interest">No Product of interest</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-6">
                      <input type="text" class="form-control" placeholder="WS / People" id="ws_or_people" name="ws_or_people"/>
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="form-control mycalender" id="dtStart" name="dtStart" placeholder="Start Date"/>
                    </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-6">
                      <input type="text" class="form-control" placeholder="Office" id="office" name="office" />
                    </div>
                    <div class="col-lg-6">
                      <input type="text" class="form-control" placeholder="Months" id="months" name="months" />
                  </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12">
                 <label>
                    <input type="checkbox" value="1" name="chkBookTour" id="chkBookTour"> Book Tour 
                 </label>
                </div>
              </div>
              <hr />
              <div class="form-group">
                 <div class="col-lg-12">
                    <label>Location</label>
                    <select name="location" id="location" class="form-control selection2" onchange="get_business(this.value);get_manager(this.value);">
                        <option value="0">Select Location</option>
                        <?php foreach($location as $key=>$value) {
                                if($userData['location_id']==$value['locationId']){
                                  echo '<option value="'.$value['locationId'].'/'.$value['cityId'].'" selected>'.ucfirst($value['name']).' ('.ucfirst($value['c_name']).')</option>';
                                }else{
                                  echo '<option value="'.$value['locationId'].'/'.$value['cityId'].'">'.ucfirst($value['name']).' ('.ucfirst($value['c_name']).')</option>';
                                }
                              } 
                        ?>
                    </select>
                  </div>
              </div>
              <hr />
              <div class="form-group business" style="display: none;">
                 <div class="col-lg-12">
                    <label>Business</label>
                    <select name="business" id="business" class="form-control selection2">
                        <option value="">Select Business</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                 <div class="col-lg-12">
                    <label>Manager</label>
                    <select name="manager" id="manager" class="form-control selection2">
                        <option value="">Select Manager</option>
                        <?php foreach($managers as $value) {
                           if($userData['location_id']==$value['location_id']){
                              echo '<option value="'.$value['userId'].'" selected>'.($value['gender'] == 'M' ? 'Mr. ' : '').ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).'</option>';
                          }else{
                               echo '<option value="'.$value['userId'].'">'.($value['gender'] == 'M' ? 'Mr. ' : '').ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).'</option>';
                          }
                        } 
                        ?>
                    </select>
                  </div>
              </div>
              <hr />
            </div>
            <hr />
            <div class="col-lg-12">
              <div class="form-group">
                <label>Enquiry Details</label>
                  <textarea name="txtrEnDetails" id="txtrEnDetails" class="form-control" placeholder=""></textarea>
              </div>
            </div>
    </div>
    <div class="clearfix"></div>
    <div class="panel-footer">
    <div class="row">
      <div class="col-md-9">
        <button type="submit" class="btn btn-primary" onclick="" id="submit">Process Enquiry</button>
      </div>
    </div>
  </div>
  </form>
  </section>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
 <script>
	function ajaxSearchF() {
      var input_data = $('#txtFname').val();
       document.getElementById('uid').value       ='';
       document.getElementById('gender').value    ='';
       document.getElementById('txtEmail').value  ='';
       document.getElementById('txtPhone').value  ='';  
       document.getElementById('txtStreet').value ='';
       document.getElementById('city').value      ='';
       document.getElementById('txtZip').value    ='';
       document.getElementById('txtCompany').value = '';
      if (input_data.length === 0) {
          $('#suggestionsF').hide();
      } else {
        
          $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>index.php/manager/autocompletef/",
              data: "eml="+input_data,
              success: function(data) {
                  
                   if (data != 0) {
                      $('#suggestionsF').show();
                      $('#autoSuggestionsListF').addClass('auto_list');
                      $('#autoSuggestionsListF').html(data);
                      
                  }
              }
          });

      }
  }
  function ajaxSearchL() {
      var input_data = $('#txtLname').val();
       document.getElementById('uid').value       ='';
       document.getElementById('gender').value    ='';
       document.getElementById('txtEmail').value  ='';
       document.getElementById('txtPhone').value  ='';  
       document.getElementById('txtStreet').value ='';
       document.getElementById('city').value      ='';
       document.getElementById('txtZip').value    ='';
       document.getElementById('txtCompany').value = '';
      if (input_data.length === 0) {
          $('#suggestionsL').hide();
      } else {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>index.php/manager/autocompletel/",
              data: "eml="+input_data,
              success: function(data) {
                  
                   if (data != 0) {
                      $('#suggestionsL').show();
                      $('#autoSuggestionsListL').addClass('auto_list');
                      $('#autoSuggestionsListL').html(data);
                      
                  }
              }
          });

      }
  }
  /*function ajaxSearchE() {
      var input_data = $('#txtEmail').val();
      if (input_data.length === 0) {
          $('#suggestionsE').hide();
      } else {
        
          $.ajax({
              type: "POST",
              url: "<?php //echo base_url(); ?>index.php/istuser/autocompletee/",
              data: "eml="+input_data,
              success: function(data) {
                  
                  if (data.length > 0) {
                      $('#suggestionsE').show();
                      $('#autoSuggestionsListE').addClass('auto_list');
                      $('#autoSuggestionsListE').html(data);
                      
                  }
              }
          });

      }
  }*/
  function litxt(txt){
		//$('#suggestionsF,#suggestionsL,#suggestionsE').hide();
    $('#suggestionsF,#suggestionsL').hide();
		var udata;
    var cityid;
     $.ajax
      ({ 
        url: '<?php echo base_url();?>index.php/manager/user_display_info_enq',
        data: "eml="+txt,
        type: 'post',
        success: function(response)
        {
           document.getElementById('uid').value       ='';
			     document.getElementById('txtFname').value  ='';
           document.getElementById('gender').value    ='';
           document.getElementById('txtLname').value  ='';
           document.getElementById('txtEmail').value  ='';
           document.getElementById('txtPhone').value  ='';  
           document.getElementById('txtStreet').value ='';
           document.getElementById('city').value      ='';
           document.getElementById('txtZip').value    ='';
           document.getElementById('txtCompany').value = '';
           //document.getElementById('location').value = '';
            udata=JSON.parse(response);
            cityid=udata[0].locationId+'/'+udata[0].cityId;
            console.log(cityid);
           document.getElementById('uid').value      = udata[0].userId;
           document.getElementById('txtFname').value  = udata[0].FirstName;
           document.getElementById('gender').value    = udata[0].gender;
           document.getElementById('txtLname').value  = udata[0].LastName;
           document.getElementById('txtEmail').value  = udata[0].userEmail;
           document.getElementById('txtPhone').value  = udata[0].phone;
           document.getElementById('txtStreet').value = udata[0].street;
           document.getElementById('city').value      = udata[0].cityId;
           document.getElementById('txtZip').value    = udata[0].pincode;
           document.getElementById('txtCompany').value = udata[0].company;
           //document.getElementById('location').value  = udata[0].cityid;
        }
      });	
	}
  function get_business(val){
    $.ajax({ 
        method: "POST", 
        url: "<?php echo base_url(); ?>index.php/istuser/getBusinessByCityLocation",
        data: "val="+val, 
        async: true, 
        success: function(data) { 
          $("#business").html("");
          $("#business").html(data);
        }
    });
  }
  function get_manager(val){
    $.ajax({ 
        method: "POST", 
        url: "<?php echo base_url(); ?>index.php/manager/getManagerByCityLocation",
        data: "val="+val, 
        async: true, 
        success: function(data) { 
          $("#manager").html("");
          $("#manager").html(data);       
        }
    });
  }
  function get_source_detail(val){
    $.ajax({ 
        method: "POST", 
        url: "<?php echo base_url(); ?>index.php/manager/getSourceDetail",
        data: "val="+val, 
        async: true, 
        success: function(data) { 
          $("#sourceDetail").html("");
          $("#sourceDetail").html(data);       
        }
    });
  }
  $(function() {
    //$('#suggestionsF,#suggestionsL,#suggestionsE').hide();
    $('#suggestionsF,#suggestionsL').hide();
    $('#dtStart').datepicker({
      format: "dd/mm/yyyy",
      minDate: 'today'
    });
    $('#chkBookTour').change(function() {
        if($(this).is(":checked")) {
            console.log($('#location').val());
            get_business($('#location').val());
            $('.business').css('display','block');
        }else{
            $("#business").html("");
            $('.business').css('display','none');
        }       
    });  	
  });
</script>
<style type="text/css">
  textarea {
    border-radius: 0 !important;
  }
  #autoSuggestionsListF, #autoSuggestionsListL > li {
   background: none repeat scroll 0 0 #F3F3F3;
   border-bottom: 1px solid #E3E3E3;
   list-style: none outside none;
   padding: 3px 15px 3px 15px;
   text-align: left;
   z-index:80000;
  }
  .auto_list {
     border: 1px solid #E3E3E3;
     border-radius: 5px 5px 5px 5px;
     position: absolute;
     z-index: 99999;
     width: 290px;
     cursor: pointer;
  }
</style>
