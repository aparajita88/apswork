<?php require_once BASEPATH."../assets/front/lib/header.php" ?> 
<?php 
	if(isset($action) && $action=='create'){
		
		echo '<script type="text/javascript">$(document).ready(function(){ addNewParty(); });</script>';
	}
?>
<!-- Body -->
<section class="body_section" >
  <div class="container">
    <div class="row">
      <div class="col-lg-12"> 
        
        <div class="tabs text-capitalize"> <a href="#" data-tab="1" onclick="myPartyz();" class="tab active">my parties</a> <!--<a href="#" data-tab="2" class="tab">bookings & enquiry</a> <a href="#" data-tab="3" class="tab">checklist</a> <a href="#" data-tab="4" class="tab">budget</a> <a href="#" data-tab="5" class="tab">guestlist</a>-->
          <div data-content="1" class="content active">
            <div class="myPartyList">
			<?php if(!isset($action) || $action!='create'){ ?>
            <div class="tab-head">
              <aside class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-capitalize">
                <?php ?>
                <!--<h2>plan your party</h2>-->
              </aside>
              <aside class="col-xs-12 col-sm-10 col-md-10 col-lg-10 rightbtns text-uppercase">
                <ul>
                	<li><input type="search" placeholder="Search by party name"></li>
                	<li><input type="search" placeholder="Search by occassion, location"></li>
                    <li>
                    	<div id="dateRangeForm">
                            <div class="date" id="dateRangePicker">
                                <input type="text" class="form-control datepicker1" placeholder="Start Date" name="Start Date" />
                            </div>
                    	</div>
                    </li>
                    <li>
                    	<div id="dateRangeForm">
                            <div class="date" id="dateRangePicker">
                                <input type="text" class="form-control datepicker1" placeholder="End Date" name="End Date" />
                            </div>
                    	</div>
                    </li>
                  	<li><a href="#" class="btn btn-default"><i class="fa fa-search"></i></a></li>
                  	<li><a href="Javascript:void(0)" id="adNewParty" onclick="addNewParty();" class="btn btn-default">add new party</a></li>
                </ul>
              </aside>
            </div>
            <div class="form-content">
              <div class="table-responsive">
				<?php if(isset($status) && $status!=''){ ?>
				<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist text-capitalize">
					<thead>
						<th colspan="8">
							<td>
								<?php 
									if($status=='send'){ // for resend invitation success
										echo "Invitation(s) are successfuly send.";
									}elseif($status=='error'){ // for resend invitation failed 
										echo "Invitation(s) are not send please contact with admin."; 
									}elseif($status=='success'){ //for party update operation success
										echo "Party successfully updated."; 
									}elseif($status=='getQuote_success'){
										echo "Party successfully created and quotation email successfully send to vendor.";
									}elseif($status=='getQuote_error'){
										echo '<span class="error">Party successfully created but an error occoured while sending quotation email to vendor. Please contact with administrator.</span>';
									}elseif($status=='no_vendor_found'){
										echo '<span class="error">Sorry! No vendor found releted to your party. Please contact with administrator.</span>';
									}elseif($status=="checklist_adding_success"){
										echo "Party checklist successfully created.";
									}
								?>
							</td>
						</th>
					</thead>
				</table>
				<?php } ?>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist text-capitalize">
                  <thead>
                    <th width="16%">
                      <a href="#" title="Sort descending">
                        Name
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                   <th width="16%">
                      <a href="#" title="Sort ascending">
                        occassion
                        <span class="sortable">
                          <b class="caret"></b>
                         
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        event date
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        event time
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        location
                        <span class="sortable">
                          <b class="caret"></b>
                          
                        </span>
                      </a>
                    </th>
                    <th width="10%">
                      <a href="#" title="Sort ascending">
                        party size 
                      </a>
                    </th>
                    <th width="10%">
                      <a href="#" title="Sort ascending">
                        action
                      </a>
                    </th>
                  </thead>
                  <tbody class="text-capitalize">
                    <?php
					if(count($allPartyz)){
						foreach($allPartyz as $value){ 
							$party_id=base64_encode($value['party_id']); 
					?>
                    <tr>
                      <td width="16%" class="paty-name"><a href="<?php echo base_url().'users/manageparty?action=detailview&token='.$party_id ?>"><?php echo ucfirst($value['name']); ?></a></td>
                      <td width="16%"><?php echo ucfirst($value['productCategoryName']); ?></td>
                      <td width="16%"><?php echo date('d M, Y', strtotime($value['date'])) ?></td>
                      <td width="16%"><?php echo $value['time']; ?></td>
                      <td width="16%"><?php echo ucfirst($value['town_nm']); ?></td>
                      <td width="10%"><?php echo $value['party_size']; ?></td>
                      <td width="10%"><span class="col-md-6 col-lg-6"><a href="Javascript:void(0)" onclick="editParty('<?php echo $party_id; ?>')"><i class="fa fa-pencil-square-o"></i></a></span><span class="col-md-6 col-lg-6"><a href="<?php echo base_url().'users/manageparty?action=delete&token='.$party_id; ?>" title="delete this party"><i class="fa fa-trash-o"></i></a></span></td>
                    </tr>
                   <?php 
						}
                   }else{
					?>   
					<td colspan="7">You are not create any party(s).</td>
				  <?php
				   }
                  ?>
                  </tbody>
                </table>
              </div>
               <div class="clearfix"></div>
            </div>
            <div class="partylist-footer">
               <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               		<p style="padding-top:4px;">Showing 5 of 8</p>
               </aside>
               <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               		 <ul class="pager mypager">
                        <li><a href="#"><i class="fa fa-angle-left"></i>Previous</a></li>
                        <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
                     </ul>
               </aside>
               <div class="clearfix"></div>		
            </div>
            </div>
            <?php } ?>
          </div>
          <div data-content="2" class="content ">
          	<div class="tab-head">
              <aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-capitalize">
                <h2>Bookings</h2>
              </aside>
              <aside class="col-xs-12 col-sm-9 col-md-9 col-lg-9 rightbtns text-uppercase send_chrome">
                <ul>
                  <li>
                  	<div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control mysearch" placeholder="Search by name, service, date, status">
                            <span class="input-group-addon myaddon" id="basic-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                  </li>
                  <li>
                   <div class="from_control">
                    	<select class="form-control myselect">
                            <option>Type</option>
                            <option onClick="javascript: top.location='#';">Booking</option>
                            <option onClick="javascript: top.location='#';">Enquiry</option>
                        </select>
                   </div>
                  </li>
                </ul>
              </aside>
            </div>
            <div class="form-content">
               <div class="table-responsive table_responsive01">
                <!--<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist text-capitalize">
                  <thead>
                    <th width="13%">
                      <a href="#" title="Sort descending">
                        vendor name
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="12%">
                      <a href="#" title="Sort ascending">
                        service area
                        <span class="sortable">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="15%">
                      <a href="#" title="Sort ascending">
                        service speciality
                        <span class="sortable">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="17%">
                      <a href="#" title="Sort ascending">
                        last modified date
                        <span class="sortable">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="15%">
                      <a href="#" title="Sort ascending">
                        request date
                        <span class="sortable">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="8%">
                      <a href="#" title="Sort ascending">
                        status
                        <span class="sortable">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="19%">&nbsp;
                      
                    </th>
                  </thead>
                  <tbody class="text-capitalize">
                    <tr>
                      <td width="13%">
                      <a data-target="#myModal_new_04" data-toggle="modal" href="#">Tortuga</a>
                      </td>
                      <td width="12%">venue</td>
                      <td width="15%">community hall</td>
                      <td width="17%">28/09/2015</td>
                      <td width="15%">21/09/2015</td>
                      <td width="8%">enquired</td>
                      <td width="19%">
                      <a href="#" data-toggle="modal" data-target="#myModal_new_05"><button type="button" class="btn btn-default grea">Add Reply</button></a>
                      <a href="#" data-toggle="modal" data-target="#myModal_new_05"><button type="button" class="btn btn-default grea">Book Now</button></a>
                      </td>
                    </tr>
                    <tr>
                      <td><a data-target="#myModal_new_04" data-toggle="modal" href="#">la cour</a></td>
                      <td>decoration</td>
                      <td>theme based</td>
                      <td>28/09/2015</td>
                      <td>21/09/2015</td>
                      <td>confirmed</td>
                      <td>
                      <a href="#" data-toggle="modal" data-target="#myModal_new_05"><button type="button" class="btn btn-default grea">Add Reply</button></a>
                      <a href="#" data-toggle="modal" data-target="#myModal_new_05"><button type="button" class="btn btn-default grea">Book Now</button></a>
                      </td>
                    </tr> 
                  </tbody>
                </table>-->
              </div>
            <div class="clearfix"></div>
            </div>
          </div>
          <!-- Tab -3 -->
          <div data-content="3" class="content">
          	<div class="tab-head ">
              <aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-capitalize">
                <h2>Checklist</h2>
              </aside>
              <aside class="col-xs-12 col-sm-9 col-md-9 col-lg-9 rightbtns text-uppercase send_guest send_guest_new">
                <ul>
                    <li>
                    	<div class="form-group">
                            <div class="input-group">
                                <input type="text" name="date" placeholder="Search by name, contact, response" class="form-control form-control01">
                                <span class="input-group-addon add-on"><i class="fa fa-search fa_search"></i></span> 
                            </div>
                    	</div>
                    </li>
                  	<li><a href="#" class="btn btn-default">Add New</a></li>
                    <!--<li>
                    <div class="from_control">
                        <select class="form-control myselect">
                            <option>Type</option>
                            <option onClick="javascript: top.location='checklist.html';">Checklist</option>
                            <option onClick="javascript: top.location='budget.html';">Budget</option>
                        </select>
                    </div>
                    </li>-->
                </ul>
              </aside>
              
            </div>
            <div class="form-content">
              <div class="table-responsive">
               <!-- <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
                  <thead>
                    <th width="15%">
                      <a href="#" title="Sort descending">
                        Service
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="30%">
                      <a href="#" title="Sort ascending">
                        Description
                      </a>
                    </th>
                    <th width="15%">
                      <a href="#" title="Sort ascending">
                        Status
                      </a>
                    </th>
                    <th width="30%">
                      <a href="#" title="Sort ascending">
                        Comment
                      </a>
                    </th>
                    <th width="10%">
                      <a href="#" title="Sort ascending">
                        action
                      </a>
                    </th>
                  </thead>
                  <tbody class="text-capitalize">
                    <tr>
                      <td width="15%">Tortuga, Venue - <br><span class="colorspn">Community Hall</span></td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</td>
                      <td width="15%">Enquired</td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                      <td width="10%"><span class="col-md-6 col-lg-6"><i class="fa fa-pencil-square-o"></i></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td width="15%">La Cour, Decoration - <br><span class="colorspn">Theme Based</span></td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</td>
                      <td width="15%">Confirmed</td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                      <td width="10%"><span class="col-md-6 col-lg-6"><i class="fa fa-pencil-square-o"></i></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    
                  </tbody>
                </table>-->
              </div>
               <div class="clearfix"></div>
            </div>
            
          </div>
          <!-- /Tab -3 -->
          <!-- Tab -4 -->
          <div data-content="4" class="content">
            
            <div class="tab-head ">
              <aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-capitalize">
                <h2>Budget</h2>
              </aside>
              <aside class="col-xs-12 col-sm-9 col-md-9 col-lg-9 rightbtns text-uppercase send_guest send_guest_new">
                <ul>
                    <li>
                    	<div id="dateRangeForm" class="dateRangeForm1 ">
                            <div id="dateRangePicker" class="input-group input-append date">
                                <input type="text" name="date" placeholder="Search by service , amount" class="form-control form-control01">
                                <span class="input-group-addon add-on"><i class="fa fa-search fa_search"></i></span> 
                            </div>
                    	</div>
                    </li>
                  	<li><a href="#" class="btn btn-default">Add New</a></li>
                    <!--<li>
                        <select class="myselect">
                            <option>Type</option>
                            <option onClick="javascript: top.location='checklist.html';">Checklist</option>
                            <option onClick="javascript: top.location='budget.html';">Budget</option>
                        </select>
                    </li>-->
                </ul>
              </aside>
            </div>
            <div class="form-content">
              <div class="table-responsive">
                <!--<table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
                  <thead>
                    <th width="15%">
                      <a href="#" title="Sort descending">
                        Service
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                        </span>
                      </a>
                    </th>
                    <th width="30%">
                      <a href="#" title="Sort ascending">
                        Description
                      </a>
                    </th>
                    <th width="15%">
                      <a href="#" title="Sort ascending">
                        Amount
                        <span class="sortable">
                          <b class="caret "></b>
                        </span>
                      </a>
                    </th>
                    <th width="30%">
                      <a href="#" title="Sort ascending">
                        Comment
                      </a>
                    </th>
                    <th width="10%">
                      <a href="#" title="Sort ascending">
                        action
                      </a>
                    </th>
                  </thead>
                  <tbody class="text-capitalize">
                    <tr>
                      <td width="15%">Tortuga, Venue - <br><span class="colorspn">Community Hall</span></td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</td>
                      <td width="15%">$1000</td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                      <td width="10%"><span class="col-md-6 col-lg-6"><i class="fa fa-pencil-square-o"></i></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td width="15%">La Cour, Decoration - <br><span class="colorspn">Theme Based</span></td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</td>
                      <td width="15%">$ 1200</td>
                      <td width="30%">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>


                      <td width="10%"><span class="col-md-6 col-lg-6"><i class="fa fa-pencil-square-o"></i></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td width="15%">Total</td>
                      <td width="30%">&nbsp;</td>
                      <td width="15%"><span class="big">$ 2200</span></td>
                      <td width="30%">&nbsp;</td>
                      <td width="10%">&nbsp;</td>
                    </tr>
                    
                  </tbody>
                </table>-->
              </div>
               <div class="clearfix"></div>
            </div>
            
          </div>
          <!-- Tab -4 -->
          <!-- Tab -5 -->
          <div data-content="5" class="content">
          
          	<div class="tab-head ">
              <aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-capitalize">
                <h2><?php echo count($allGuest); ?> Invitations Sent</h2>
              </aside>
              <aside class="col-xs-12 col-sm-9 col-md-9 col-lg-9 rightbtns text-uppercase send_guest send_guest008">
                <ul>
                    <li>
                    	<div id="dateRangeForm" class="dateRangeForm1 ">
                            <div id="dateRangePicker" class="input-group input-append date">
                                <input type="text" name="date" placeholder="Search by name, contact, response" class="form-control form-control01">
                                <span class="input-group-addon add-on"><i class="fa fa-search fa_search"></i></span> 
                            </div>
                    	</div>
                    </li>
                   <!-- <li class="from_control">
                    <select class="form-control">
                    	<option>Invite</option>
                         <option onClick="javascript: top.location='guestlist-individual.html';">Individual</option>
                         <option onClick="javascript: top.location='guestlist.html';">Multiple</option>
                      </select>
                    </li>
                  	<li><a href="#" class="btn btn-default">Resend Invitation</a></li> -->
                </ul>
              </aside>
            </div>
            <div class="form-content">
              <div class="table-responsive">
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
                  <thead>
                    <th width="25%">
                      <a href="#" title="Sort descending">
                        
                        <div class="checkbox checkbox1"><input id="checked1" type="checkbox" name="check" value="checked1"><label for="checked1"><span></span>Guest Name</label></div>
                        
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                         </span>
                      </a>
                    </th>
                    <th width="25%">
                      <a href="#" title="Sort ascending">
                        Contact 
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="25%">
                      <a href="#" title="Sort ascending">
                        Email 
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="25%">
                      <a href="#" title="Sort ascending">
                        Response
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                   </thead>
                  <tbody class="text-capitalize">
					<?php 
						if(isset($allGuest) && !empty($allGuest)){ 
							foreach($allGuest as $key => $guest){
					?>
						<tr>
						  <td width="25%"><div class="checkbox checkbox2"><input id="check<?php echo $key; ?>" type="checkbox" name="check" value="check<?php echo $key; ?>"><label for="check<?php echo $key; ?>"><span></span><?php echo $guest['guest_name']; ?></label></div></td>
						  <td width="25%"><?php echo $guest['guest_contact_no']; ?></td>
						  <td width="25%"><?php echo strtolower($guest['guest_email']); ?></td>
						  <td width="25%"><?php echo ($guest['status']==1) ? "Accepted" : "Invited"; ?></td>
						 </tr>
                     <?php 
							}
						}else{
					?>
						<tr>
							<td width="100%" colspan="4">You are not send any invitation(s)</td>
						</tr>
					<?php		
						}
					?>
                  </tbody>
                </table>
              </div>
               <div class="clearfix"></div>
            </div>
            <div class="partylist-footer partylist_footer1">
               <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               		<p>Showing 10 of 15</p>
               </aside>
               <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               		 <ul class="pager mypager">
                        <li><a href="#"><i class="fa fa-angle-left"></i>Previous</a></li>
                        <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
                     </ul>
               </aside>
               <div class="clearfix"></div>		
            </div>	
	            
            <div class="clearfix"></div>
          </div>
           <!-- /Tab -5 -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Body --> 

<?php require_once BASEPATH."../assets/front/lib/footer.php" ?>

<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css'; ?>">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
<script type="text/javascript" src="<?php echo base_url().'assets/js/GScroll.js'; ?>"></script> 
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
				$( ".datepicker1" ).datepicker();
            });
        </script>
        
        
<!-- Modal Popup-->
<div id="myModal_new_04" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <div class="modal-content">
          <div class="modal-header modal_new">
            
            <div class="col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal_title_04">Vendor Detail</h4>
            </div>
       </div>
      
      <div class="modal-body">
      	  
          <!-- From Input -->
          <div class="col-lg-12 new_123">
             
                 <aside class="col-xs-12 col-sm-6 col-md-5 col-lg-4 left_ac_pic ">
                   	<img src="images/ac-l1.png" alt="" /> 
                </aside>
                
                <aside class="col-xs-12 col-sm-6 col-md-7 col-lg-8  left_ac_dec">
                  	
                    <div class="star_rating">
                    	<p>Venue Rating -	4.3   </p>
                        <abbr>
                        	<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </abbr>
                        <div class="clearfix"></div>   
                    </div>
                    
                    <div class="address_holder">
                    	<ul>
                        	<li>
                            <i class="fa fa-home"></i><p>260 5th Avenue, Roseville, New York, <br>NY 10001, United States</p><div class="clearfix"></div>
                            </li>
                            <li><i class="fa fa-phone"></i><p>+1111-1111-111</p><div class="clearfix"></div></li>
                            <li><i><img src="<?php echo base_url(); ?>assets/images/w.png" alt="" /></i><p><a href="#">www.hostmyparty.com</a></p><div class="clearfix"></div></li>
                            <li><i><img src="<?php echo base_url(); ?>assets/images/al.png" alt="" /></i><p>MON to SAT - 09:00 am to 11:00 pm, SUN - Closed</p><div class="clearfix"></div></li>
                        </ul>
                    </div>

                </aside>
             <div class="clearfix"></div>   
          </div>  
          <!-- /From Input -->
          
          <!-- Content  -->
          <div class="col-lg-12 ">  
          	
            	<h3>About Tortuga</h3>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venena tis vitae, justo. Nullam dictum felis eu pede mollis pretium.
				<br><br>
				Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viver ra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean impe rdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhon cus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipi scing sem neque sed ipsum. Nam  pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus imperdiet a, venenatis. vitae, justo. Nullam dictum felis pede mollis pretium.
                </p>
                
                
            <div class="clearfix"></div>  
          </div>
          <!-- /Content  -->
          
          
            
         <div class="clearfix"></div>     
       </div>
     
    </div>

  </div>
</div>
<!-- /Modal Popup--> 

<!-- Modal Popup-->
<div id="myModal_new_05" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <div class="modal-content">
          <div class="modal-header modal_new">
            
            <div class="col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal_title_04">Add Reply</h4>
            </div>
       </div>
      
      <div class="modal-body">
      	  
          <!-- Content  -->
          <div class="col-lg-12 form_horizontal_rep">  
          	
            	<form class="form_horizontal " role="form">
                         <div class="form_part">
                         
                          <div class="form_part_submit">
                           <input type="text" class="form-control" placeholder="Subject">
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        <div class="form_part">
                           <div class="form_part_submit">
                           <textarea placeholder="Message" class="form-control"></textarea>
                           <a class="btn btn-danger btn_bnt" href="#" data-toggle="modal" data-target="#myModal_new2">Reply</a>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      <div class="clearfix"></div>
                  </form>
                
                
                <div class="col-lg-12 addreply_comments">
                    <div class="commeent_box" id="content005">
                    	<div class="defult_scroll"></div>	
                        <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo base_url(); ?>assets/images/account_dash1.png" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo base_url(); ?>assets/images/ac-l1.png" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                         
                         <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo base_url(); ?>assets/images/account_dash1.png" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo base_url(); ?>assets/images/ac-l1.png" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                         
                         <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo base_url(); ?>assets/images/account_dash1.png" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="<?php echo base_url(); ?>assets/images/ac-l1.png" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                         
                    	
                    </div>
                </div>
                
            <div class="clearfix"></div>  
          </div>
          <!-- /Content  -->
            
         <div class="clearfix"></div>     
       </div>
     
    </div>

  </div>
</div>
<!-- /Modal Popup-->         
     
</body>
</html>


