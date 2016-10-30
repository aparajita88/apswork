<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-timepicker.min.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
<script>
    $(function () {
    
      $('[data-tab]').on('click', function (e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active')
          .siblings('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');
        e.preventDefault();
      });
      
    });
    </script> 
<!-- Scroll Pop up -->    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/GScroll.js"></script> 
<script type="text/javascript">
		$(document).ready(function(){
			$('#content005').GScroll();
			//$('#content3').GScroll({height: 100});
			$('<a href=""></a>')
		});
	</script>
<!-- /Scroll Pop up -->       
<script type="text/javascript">
            $(function () {
				$( ".datepicker" ).datepicker();
            });
            
            /*$(function () {
            $('#timepicker').datetimepicker({
                    format: 'LT'
                });
                });
              */  
        </script>

 <div data-content="1" class="content active">
            <div class="tab-head">
              <aside class="col-xs-12 col-sm-3 col-md-4 col-lg-4 text-capitalize">
               <!-- <h2>plan your party</h2>-->
               <ol class="breadcrumb">
                  <li><a href="<?php echo base_url().'users/myPartyz' ?>">My Parties</a></li>
                  <li class="active"><?php echo $party; ?></li>
                </ol>
              </aside>
              <aside class="col-xs-12 col-sm-9 col-md-8 col-lg-8 rightbtns text-uppercase">
                <!--<ul>
                  <li><a href="#" class="btn btn-default"><i class="fa fa-search"></i></a></li>
                  <li><a href="#" class="btn btn-default">find vendor</a></li>
                  <li><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">get quote</a></li>
                </ul>-->
              </aside>
            </div>
            <div class="form-content">
              <form id="party_creation_form" action="<?php echo base_url().'users/createParty'; ?>" method="post" class="form-horizontal" role="form">
                <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6 left_side">
                  <div class="form-group myform-group">
                    <div class="col-lg-12">
                      <input type="text" name="party_name" id="party_name" class="form-control" placeholder="Party Name" onclick="removeValidateHtml(this.id);" />
                      <span id="party_name_error" class="error"></span>
                    </div>
                  </div>
                  <div class="form-group myform-group">
                    <div id="dateRangeForm" class="col-lg-6">
                      <div class="date" id="dateRangePicker">
                        <input type="text" class="form-control datepicker" placeholder="Event Date" id="party_date" name="party_date" onclick="removeValidateHtml(this.id);" />
						<span class="error" id="party_date_error"></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="time bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" placeholder="Event Time" id="party_time" name="party_time" onclick="removeValidateHtml(this.id);" />
                        <span class="error" id="party_time_error"></span>
                      </div>
                      
					<!---<div class="input-group bootstrap-timepicker timepicker">
						<input id="timepicker1" type="text" class="form-control input-small">
						<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					</div>---->
					<script type="text/javascript">
						$('#party_time').timepicker();
					</script>
                    </div>
                  </div>
                  <div class="form-group myform-group">
                    <div class="col-lg-12">
						<input type="text" class="form-control" name="postcode" id="postcode" placeholder="Post Code" onclick="removeValidateHtml(this.id);">
						<span class="error" id="postcode_error"></span>
                    </div>
                  </div>
                </aside>
                <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6 right_side">
                  <div class="form-group myform-group">
                    <div class="col-lg-12">
                      <select class="form-control" name="occassion" id="occassion" onclick="removeValidateHtml(this.id);">
                        <option VALUE=''>---SELECT OCCASSION---</option>
                        <?PHP foreach($occassion as $key => $value): ?>
							<option value="<?php echo $value['productCategoryId']; ?>"><?php echo ucfirst($value['productCategoryName']); ?></option>
                        <?PHP endforeach; ?>
                      </select>
                      <span class="error" id="occassion_error"></span>
                    </div>
                  </div>
                  <div class="form-group myform-group">
                    <div class="col-lg-12">
                      <select class="form-control location" name="location" id="location" onclick="removeValidateHtml(this.id);">
						  <option value=''>---SELECT LOCATION---</option>
						  <?PHP foreach($town as $key => $value): ?>
							<option value="<?php echo $value['id']; ?>"><?php echo ucfirst($value['town_nm']); ?></option>
                        <?PHP endforeach; ?>
                      </select>
                      <span class="error" id="location_error"></span>
                      <!--<input type="text" class="form-control location" placeholder="Location">-->
                    </div>
                  </div>
                  <div class="form-group myform-group">
                    <div class="col-lg-12">
                     <select class="form-control" id="party_size" name="party_size" onclick="removeValidateHtml(this.id);">
							<option value="">---SELECT PARTY SIZE---</option>
							<option value="10">Upto 10</option>
							<option value="20">Upto 20</option>
							<option value="50">Upto 50</option>
							<option value="100">Upto 100</option>
							<option value="200">Upto 200</option>
						</select>
                      <!--<input type="text" class="form-control" placeholder="Party Size" id="party_size" name="party_size" onclick="removeValidateHtml(this.id);" onblur="validatePartySize();">-->
                       <span class="error" id="party_size_error"></span>
                    </div>
                  </div>
                </aside>
                <div class="clearfix"></div>
              <input type="hidden" id="action" name="action" value="" />
              <div class="secondhead">
                <h2>Services Required</h2>
                <div class="clearfix"></div>
              </div>
              <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
              <div class="registratioForm1-area3 text-capitalize">
                <?php $num=0; foreach($service as $key => $value){ $num++; ?>
					 <?php if($num==1) echo '<script type="text/javascript">$(document).ready(function(){getSubService("check1");});</script>'; // this line for open minimum 1 subcategory "check1" is first checkbox id ?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 party-plan-services">
                  <div class="checkbox">
                     <input type="checkbox" class="main_service_<?php echo $num; ?>" value="<?php echo $value['productCategoryId']; ?>" name="service[]" onclick="getSubService(this.id)" id="check<?php echo $num; ?>" <?php echo($num==1) ? "checked" : ""; ?>>
                     <label for="check<?php echo $num; ?>"><span></span><?php echo $value['productCategoryName']; ?></label>
                  </div>
                </div>
                <?php } ?>
                <span class="checkbox_error" id="main_category_error"></span>
               </div>
              <div class="clearfix"></div>
              <div class="thirdhead">
                <h2>select service speciality</h2>
                <div class="clearfix"></div>
              </div>
                <div class="subcategory"></div>
               
              <div class="clearfix"></div>
              <div class="full mr2">
               		<button class="btn btn-danger mycreate-button" type="button" onclick="validatePartyCreationForm('create');"; name="create" value="Create">Create</button>
                    <button class="btn btn-danger mycreate-button" type="button" onclick="validatePartyCreationForm('create_getquote');"; name="create_getquote" value="Create&GetQuote">Create & Get Quote</button>
                    <button class="btn btn-danger mycreate-button" type="button" onclick="validatePartyCreationForm('create_findvendors');"; name="findvendor" >Create & Find Vendors</button>
               </div>
               </form>
               <!-- Modal -->
               <div class="container">
                    <div class="row">
                        <div id="myModal" class="modal fade mymodal" role="dialog">
                      <div class="modal-dialog mymodal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title mytitle">Get Quote</h4>
                          </div>
                          <div class="modal-body">
                            <h3>Party Detail</h3>
                            <div id="table1" class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1">
                                	<tr>
                                    	<td><span class="col-md-4 col-lg-4">Name</span> - <strong>John's Wedding</strong></td>
                                        <td><span class="col-md-4 col-lg-4">Occassion</span> - <strong>Wedding</strong></td>
                                    </tr>
                                    <tr>
                                    	<td><span class="col-md-4 col-lg-4">Date</span> - <strong>25/09/2015</strong></td>
                                        <td><span class="col-md-4 col-lg-4">Location</span> - <strong>New York</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="table2" class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1" class="text-capitalize">
                                	<tr>
                                    	<th>service name</th>
                                        <th>service speciality</th>
                                        <th>status</th>
                                    </tr>
                                	<tr>
                                    	<td>venue</td>
                                        <td>community hall</td>
                                        <td>enquired</td>
                                    </tr>
                                    <tr>
                                    	<td>decoration</td>
                                        <td>theme based</td>
                                        <td>confirmed</td>
                                    </tr>
                                </table>
                            </div>
                            <h5>Write to Vendor</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                            <div class="form-group">
                            	<div class="checkbox">
                                	<label class="new-checkbox"><input type="checkbox" value="" checked>Do you agree to share the party details with vendors and contacted by them?</label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger sendbutton">Send</button>
                          </div>
                        </div>
                    
                      </div>
                    </div>
                    </div>
                </div>
               <div class="clearfix"></div>
            </div>
          </div>
