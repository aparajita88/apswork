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
      <h2 class="panel-title">need analysis guide</h2>
    </div>
    <div class="panel-body panel_body_top">
        <?= (isset($message) && $message != '') ? $message : '';?>
        <form class="mainform" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/manager/need_analysis">
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>Customer Information</label>
                    <div class="row">
                    	<div class="form-group">
                        	<div class="col-lg-6">
                        		<input type="text" class="form-control" id="prosName" name="prosName" placeholder="Prospect Name" required onkeyup="ajaxSearch();"/>
                            <div id="suggestions">
                                <div id="autoSuggestionsList"></div>
                            </div>
                            <input type="hidden" id="registered_user_id" name="registered_user_id" value="">
                        	</div>
                            <div class="col-lg-6">
                            	<input type="text" class="form-control" id="comName" name="comName" placeholder="Company Name" required/>
                            </div>
                      </div>
                      <div class="form-group">
                      	<div class="col-lg-6">
                            <select name="city" id="city" class="fform-control selection2" required>
                              <option value="0">City / Area of Interest</option>
                              <?php foreach($cities as $key=>$value) {
                                /*if($userData['city_id']==$value['cityId']){
                                   echo '<option value="'.$value['cityId'].'" selected>'.ucfirst($value['name']).'</option>'; 
                                }else{*/
                                  echo '<option value="'.$value['cityId'].'">'.ucfirst($value['name']).'</option>'; 
                                //}
                              } ?>
                            </select>
                          </div>
                          <div class="col-lg-6">
                          	<input type="text" class="form-control" name="txtNop" id="txtNop" placeholder="Number of People" required/>
                          </div>
                      </div>
                      <div class="form-group">
                      	<div class="col-lg-6">
                          	<input type="text" class="form-control" name="stData" id="stData" placeholder="Start Date / Why?" required/>
                          </div>
                          <div class="col-lg-6">
                          	<input type="text" class="form-control" name="source" id="source" placeholder="Source" required/>
                          </div>
                      </div>
                      <div class="form-group">
                      	<div class="col-lg-6">
                            <select name="location" id="location" class="form-control selection2" required>
                                <option value="0">Current Location</option>
                                <?php foreach($location as $key=>$value) {
                                        /*if($userData['location_id']==$value['locationId']){
                                          echo '<option value="'.$value['locationId'].'/'.$value['cityId'].'" selected>'.ucfirst($value['name']).' ('.ucfirst($value['c_name']).')</option>';
                                        }else{*/
                                          echo '<option value="'.$value['locationId'].'">'.ucfirst($value['name']).' ('.ucfirst($value['c_name']).')</option>';
                                        //}
                                      } 
                                ?>
                            </select>
                          </div>
                          <div class="col-lg-6">
                          	<input type="text" class="form-control" name="term" id="term" placeholder="Term / Why?" required/>
                          </div>
                      </div>
                    </div>
              </div>
              <hr />
              <div class="form-group">
                <label>What are the other options being considered by the prospect</label>
                  <textarea class="form-control" name="otherOptions" id="otherOptions" placeholder="Enter Details" required></textarea>
              </div>
              <hr />
              <div class="form-group">
                <label>General notes (include promotions discussed)</label>
                  <textarea class="form-control" name="generalNotes" id="generalNotes" placeholder="Enter Details" required></textarea>
              </div>
              <hr />
              <div class="form-group">
                  <label>Aditional information</label>
                    <div class="row">
                      <div class="form-group">
                          <div class="col-lg-6">
                            <input type="text" class="form-control" name="txtPhone" id="txtPhone" placeholder="Mobile" required/>
                          </div>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email" required/>
                            </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="txtWeb" id="txtWeb" placeholder="Website" required/>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="form-control" name="txtAddress" id="txtAddress" placeholder="Address" required/>
                          </div>
                      </div>
                    </div>
              </div>
              <hr />
              <div class="form-group">
                <label>Information from web broker or agent / broker</label>
                  <textarea class="form-control" name="infoFrom" id="infoFrom" placeholder="Enter Details" required></textarea>
              </div>
              <hr />
              <div class="form-group">
                <label>Information from Internet (Google, Linkedin, Website, etc)</label>
                  <textarea class="form-control" name="infoFromInternet" id="infoFromInternet" placeholder="Enter Details" required></textarea>
              </div>
              <hr />
            </div>
            <div class="col-lg-6">
            	<div class="form-group">
                	<label>The Business</label>
                    <textarea class="form-control" name="theBusiness" id="theBusiness" placeholder="Tell me about your company/what they do?" required></textarea>
              </div>
              <hr />
              <div class="form-group">
                	<label>The Problem</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theProblem1" id="theProblem1" placeholder="Where are you currently working? (Location address)"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theProblem2" id="theProblem2" placeholder="How is this working for you? (Cost comparison)"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theProblem3" id="theProblem3" placeholder="Why are you looking to change? (Key factor to change workspace)"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theProblem4" id="theProblem4" placeholder="When are you looking to change? (Date and Time)"/>
                      </div>
              </div>
              <hr />
              <div class="form-group">
                  <label>The Location</label>
                    <textarea class="form-control" name="thelocation" id="thelocation"  placeholder="Why is this area / location important?"></textarea>
              </div>
              <hr />
              <div class="form-group">
                  <label>The Team</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theTeam1" id="theTeam1" placeholder="How many people to accommodate?"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theTeam2" id="theTeam2" placeholder="Will that change in the next 12 months?"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theTeam3" id="theTeam3" placeholder="Is everyone on board / need to be hired?"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theTeam4" id="theTeam4" placeholder="Percentage of time in the office / road / home? "/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="theTeam5" id="theTeam5" placeholder="Did you need the office after office hours?"/>
                      </div>
              </div>
              <hr />
              <div class="form-group">
                  <label>Decision-making</label>
                      <div class="form-group">
                          <input type="text" class="form-control" name="decisionMaking1" id="decisionMaking1" placeholder="Top factors which will help you to make a decision today?"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="decisionMaking2" id="decisionMaking2" placeholder="How does the decision making process work in your company?"/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="decisionMaking3" id="decisionMaking3" placeholder="Once decided who will sign? "/>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="decisionMaking4" id="decisionMaking4" placeholder="Budget? What all it includes?"/>
                      </div>
              </div>
              <hr />
              <div class="form-group">
                  <label>Other opportunities?</label>
                    <textarea class="form-control" name="otherOpptn" id="otherOpptn" placeholder="Are there any future opportunities or need?"></textarea>
              </div>
              <hr />
            </div>
            <div class="clearfix"></div>
    </div>
    <div class="panel-footer">
		<div class="row">
			<div class="col-md-9">
				<button type="submit" class="btn btn-primary" onclick="" id="submit">Submit</button>
			</div>
		</div>
	</div>
  </form>
  </section>
</section>
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
 <style type="text/css">
  textarea {
    border-radius: 0 !important;
  }
  #autoSuggestionsList > li {
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
 <script type="text/javascript">
	 function ajaxSearch() {
       var input_data = $('#prosName').val();
       document.getElementById('registered_user_id').value  ='';
       document.getElementById('comName').value             ='';
       document.getElementById('city').value                ='0';
       document.getElementById('txtEmail').value            ='';
       document.getElementById('txtPhone').value            ='';  
       document.getElementById('txtAddress').value          ='';
       document.getElementById('location').value            ='0';
      if (input_data.length === 0) {
          $('#suggestions').hide();
      } else {
        
          $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>index.php/manager/autocompletef/",
              data: "eml="+input_data,
              success: function(data) {
                  if (data != 0) {
                      $('#suggestions').show();
                      $('#autoSuggestionsList').addClass('auto_list');
                      $('#autoSuggestionsList').html(data);
                  }else{
                    $('#suggestions').hide();
                  }
              }
          });

      }
  }
  function litxt(txt){
    $('#suggestions').hide();
    var udata;
    var currentLoc;
     $.ajax
      ({ 
        url: '<?php echo base_url();?>index.php/manager/user_display_info_enq',
        data: "eml="+txt,
        type: 'post',
        success: function(response)
        {
           document.getElementById('registered_user_id').value  ='';
           document.getElementById('prosName').value            ='';
           document.getElementById('comName').value             ='';
           document.getElementById('city').value                ='0';
           document.getElementById('txtEmail').value            ='';
           document.getElementById('txtPhone').value            ='';  
           document.getElementById('txtAddress').value          ='';
           document.getElementById('location').value            ='0';
            udata=JSON.parse(response);
           document.getElementById('registered_user_id').value      = udata[0].userId;
           document.getElementById('prosName').value                = udata[0].FirstName+' '+udata[0].LastName;
           document.getElementById('comName').value                 = udata[0].company;
           document.getElementById('city').value                    = udata[0].cityId;
           document.getElementById('txtEmail').value                = udata[0].userEmail;
           document.getElementById('txtPhone').value                = udata[0].phone;
           document.getElementById('txtAddress').value              = udata[0].street;
           document.getElementById('location').value                = udata[0].locationId;
        }
      }); 
  }
$(function() {
  $('#suggestions').hide();
});
</script>
