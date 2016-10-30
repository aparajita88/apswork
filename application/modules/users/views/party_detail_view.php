<?php require_once BASEPATH."../assets/front/lib/header.php" ?> 
<?php $party_id=base64_encode($partyDetail['party_id']); ?>
<?php
	$cheklist_status = array("checklist_adding_success", "checklist_error", "checklist_updating_success", "checklist_update_error", "checklist_deleting_success", "checklist_deleting_error");
	$budget_status = array("budget_adding_success", "budget_error", "budget_deleting_success", "budget_deleting_error", "budget_updating_success", "budget_update_error");
	$bookingAndEnquery_status = array("booking_success", "booking_error");
	$guestList_status = array("invitation_send");
	$partyz_class="";
	$checklist_class="";
	$bookingAndEnquery_class = "";
	$budget_class = "";
	$guestList_class = "";
	if($status!=''){
		if (in_array($status, $bookingAndEnquery_status)){
			$partyz_class="active";
			//$bookingAndEnquery_class = "active";
		}elseif(in_array($status, $cheklist_status)){
			$checklist_class = "active";
		}elseif(in_array($status, $budget_status)){
			$budget_class = "active";
		}elseif(in_array($status, $guestList_status)){
			//$partyz_class="active";
			$guestList_class = "active";
			//echo "<script>$(document).ready(function(){ gotoGuestList('".base64_encode($party_id)."', 'guestlist', true); }); </script>";
		}
	}else{
		$partyz_class="active";
	}
?>

<!-- Body -->
<section class="body_section" >
  <div class="container">
    <div class="row">
      <div class="col-lg-12"> 
         
        <div class="tabs text-capitalize"> 
			<a href="#" data-tab="1" class="tab <?php echo $partyz_class; ?>">my parties</a> 
			
			<a href="#" data-tab="2" id="bookingAndEnqueryTab" class="tab" onclick="getEnqueryDetail('','<?php echo base64_encode($party_id); ?>');">bookings & enquiry</a> 
			
			<a href="#" id="checklist-anchor" data-tab="3" class="tab <?php echo $checklist_class; ?>">checklist</a> 
			
			<a href="#" id="budget-anchor" data-tab="4" class="tab <?php echo $budget_class; ?>">budget</a> 
			
			<a href="#" data-tab="5" id="guestlist" class="tab <?php echo $guestList_class; ?>">guestlist</a>
            
             <div data-content="1" class="content myPartyList <?php echo $partyz_class; ?>">
            <div class="tab-head">
              <aside class="col-xs-12 col-sm-3 col-md-3 col-lg-4 text-capitalize">
               <!-- <h2>John's wedding</h2>-->
               <ol class="breadcrumb">
                  <li><a href="<?php echo base_url().'users/mypartyz'; ?>">My Parties</a></li>
                    <li class="active"><?php echo $party; ?></li>
                </ol>
              </aside>
              <aside class="col-xs-12 col-sm-9 col-md-9 col-lg-8 rightbtns text-uppercase">
			     <ul>
                  <li><a href="Javascript:void(0)" onclick="editParty('<?php echo $party_id; ?>')" class="btn btn-default">modify</a></li> 
                  <li><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">get quote</a></li>
                  <li><a href="#" class="btn btn-default" data-toggle="modal" data-target="#find_Modal">find vendor</a></li>
                   <li><a href="Javascript:void(0)" onclick="gotoGuestList('<?php echo base64_encode($party_id); ?>', 'guestlist', true);" class="btn btn-default">Send invitation</a></li>
                </ul>
              </aside>
            </div>
            <div class="form-content">
            	<div class="detail-view">
					<div class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1">
                                	<tr>
                                    	<td><span class="col-md-4 col-lg-4">Name</span> - <strong><?php echo $party; ?></strong></td>
                                        <td><span class="col-md-4 col-lg-4">Occassion</span> - <strong><?php echo ucfirst($partyDetail['productCategoryName']); ?></strong></td>
                                    </tr>
                                    <tr>
                                    	<td><span class="col-md-4 col-lg-4">Date & Time</span> - <strong><?php echo date('d/m/Y', strtotime($partyDetail['date'])).', '.$partyDetail['time']; ?></strong></td>
                                        <td><span class="col-md-4 col-lg-4">Location</span> - <strong><?php echo ucfirst($partyDetail['town_nm']); ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                    <div class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1" class="text-capitalize">
                                	<tr>
                                    	<th width="30%">service name</th>
                                        <th width="30%">service speciality</th>
                                        <th width="23%">status</th>
                                        <th width="17%">&nbsp;</th>
                                    </tr>
                                    <?php 
										foreach($servicesdetail as $key => $value){ 
											foreach($value as $service){ 
									?>
												<tr>
													<td width="30%"><?php echo ucfirst($key); ?></td>
													<td width="30%"><?php echo ucfirst($service['serviceName']); ?></td>
													<td width="23%"><?php echo ($service['status']==1) ? "Confirmed" : "Enquired"; ?></td>
													<td width="17%"><a href="Javascript:void(0)" onclick="showEnqueryDetail('<?php echo base64_encode(base64_encode($service['serviceId'])); ?>', '<?php echo base64_encode($party_id); ?>');">booking & enquiry detail</a></td>
												</tr>
                                    <?php 
											}
										} 
                                    
                                    ?>
                                </table>
                            </div>
                 </div>
                 <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
               <div class="clearfix"></div>
               <!-- Modal -->
               <div class="container">
                    <div class="row">
                        <div id="myModal" class="modal fade mymodal" role="dialog">
                      <div class="modal-dialog2 mymodal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
						<form action="<?php echo base_url().'users/getQuote'; ?>" method="post" id="getQuote_modal">
						<input type="hidden" name="token" value="<?php echo base64_encode($party_id); ?>" />
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title mytitle">Get Quote</h4>
                          </div>
                          <div class="modal-body">
                            <h3>Party Detail</h3>
                            <div id="table1" class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1">
                                	<tr>
                                    	<td><span class="col-md-4 col-lg-4">Name</span> - <strong><?php echo $party; ?></strong></td>
                                        <td><span class="col-md-4 col-lg-4">Occassion</span> - <strong><?php echo ucfirst($partyDetail['productCategoryName']); ?></strong></td>
                                    </tr>
                                    <tr>
                                    	<td><span class="col-md-4 col-lg-4">Date & Time</span> - <strong><?php echo date('d/m/Y', strtotime($partyDetail['date'])).', '.$partyDetail['time']; ?></strong></td>
                                        <td><span class="col-md-4 col-lg-4">Location</span> - <strong><?php echo ucfirst($partyDetail['town_nm']); ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="table2" class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1" class="text-capitalize">
                                	<tr>
										<th width="10%"><div class="checkbox"><input class="master_chechbox" onclick="CheckedAllCheckbox();" id="checked1" type="checkbox" name="check" value="">  <label for="checked1"><span></span></label></div></th>
                                    	<th width="45%">service name</th>
                                        <th width="45%">service speciality</th>
                                    </tr>
                                	<?php 
                                   		foreach($servicesdetail as $key => $value){ 
											foreach($value as $service){
									?>
												<tr>
													<td width="10%"><div class="checkbox"><input onclick="CheckOrUncheckMusterCheckbox();" class="slave_chekbox" id="check<?php echo $service['serviceId']; ?>" type="checkbox" name="services[]" value="<?php echo $service['serviceId']; ?>"> <label for="check<?php echo $service['serviceId']; ?>"><span></span></label></div></td>
													<td width="45%"><?php echo ucfirst($key); ?></td>
													<td width="45%"><?php echo ucfirst($service['serviceName']); ?></td>
												</tr>
                                    <?php 
											}
										}
                                    ?>
                                </table>
                            </div>
                            <h5>Write to Vendor</h5>
                            <textarea class='form-control' name="message" placeholder="message"></textarea>
                            <div class="form-group">
                            	<div class="checkbox">
                                	<!--<label class="new-checkbox"><input type="checkbox" value="" checked>Do you agree to share the party details with vendors and contacted by them?</label>-->
                                    <input type="checkbox" value="check1" name="check" id="check1" checked>
                                    <label for="check1"><span></span>Do you agree to share the party details with vendors and contacted by them?</label>
                                </div>
                            </div>
                            <button type="button" onclick="getQuote();" class="btn btn-danger sendbutton">Send</button>
                            </form>
                          </div>
                        </div>
                    
                      </div>
                    </div>
						<!--find vendor modal start-->
					 <div id="find_Modal" class="modal fade mymodal" role="dialog">
                      <div class="modal-dialog2 mymodal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
						<form action="<?php echo base_url().'users/findVendor'; ?>" method="post" id="findVendor_modal-form">
						<input type="hidden" name="token" value="<?php echo base64_encode($party_id); ?>" />
                        <input type="hidden" name="party_size" value="<?php echo $partyDetail['party_size']; ?>" />  
                        <input type="hidden" name="location" value="<?php echo $partyDetail['town_nm']; ?>" />  
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title mytitle">Fnd Vendors</h4>
                          </div>
                          <div class="modal-body">
                            <h3>Party Detail</h3>
                            <div id="table1" class="table-responsive">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1">
                                	<tr>
                                    	<td><span class="col-md-4 col-lg-4">Name</span> - <strong><?php echo $party; ?></strong></td>
                                        <td><span class="col-md-4 col-lg-4">Occassion</span> - <strong><?php echo ucfirst($partyDetail['productCategoryName']); ?></strong></td>
                                    </tr>
                                    <tr>
                                    	<td><span class="col-md-4 col-lg-4">Date & Time</span> - <strong><?php echo date('d/m/Y', strtotime($partyDetail['date'])).', '.$partyDetail['time']; ?></strong></td>
                                        <td><span class="col-md-4 col-lg-4">Location</span> - <strong><?php echo ucfirst($partyDetail['town_nm']); ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="table2" class="table-responsive xyz">
                            	<table width="100%" cellspacing="0" cellpadding="0" border="1" class="text-capitalize">
                                	<tr>
										<th width="10%"></th>
                                    	<th width="45%">service name</th>
                                        <th width="45%">service speciality</th>
                                    </tr>
                                	<?php
										foreach($servicesdetail as $key => $value){ 
											foreach($value as $service){
												$jsonData['services'] = $service;
									?>
												<tr>
													<td width="10%">
														<div class="radio">
															<label>
																<input type="hidden" name="<?php echo $service['serviceId']; ?>" value="<?php echo $key; ?>">
																<input type="radio" class="service_id_radio" id="<?php echo 'service_id_'.$service['serviceId']; ?>" name="service_id" value="<?php echo $service['serviceId']; ?>">
															</label>
														</div>
													</td>
													<td width="45%"><?php echo ucfirst($key); ?></td>
													<td width="45%"><?php echo ucfirst($service['serviceName']); ?></td>
												</tr>
                                    <?php 
											}
										}
                                    ?>
                                </table>
                            </div>
                           <div class="form-group">
                            	
                            </div>
                           
                            <button type="button" onclick="findVendor('service_id_radio');" class="btn btn-danger sendbutton">Find vendor</button>
                            </form>
                          </div>
                        </div>
                    
                      </div>
                    </div>

						<!--find vendor modal end-->
						
                    </div>
                </div>
               <div class="clearfix"></div>
            </div>
          </div>
          <div data-content="2" class="content ">
			<div id="bookingAndEnquery">
          	
			</div>
          </div>
          <!-- Tab -3 -->
          <div data-content="3" class="content <?php echo $checklist_class; ?>">
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
                  	<li><a href="#" class="btn btn-default" data-toggle="modal" data-target="#checklist_modal" onclick="drawCheckListAddForm('<?php echo $partyDetail['party_id']; ?>');">Add New</a></li>
                    <li>
                        <select class="myselect" id="budgetChecklistSwitcher" onchange="switchBudgetChecklist(this.value, this.id);">
                            <option value="checklist" selected>Checklist</option>
                            <option value="budget">Budget</option>
                        </select>
                    </li>
                </ul>
              </aside>
              
            </div>
            <div class="form-content">
              <div class="table-responsive">
                <?php 
					if(isset($status) && in_array($status, $cheklist_status)){
                ?>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
					<tr>
					<?php 
						if($status == "checklist_adding_success"){			
							echo '<th width="100%">Checklist Successfully Added</th>';
						}elseif($status == "checklist_error"){			
							echo '<th width="100%"><span class="error">Sorry! An error occoured while adding one item in checklist. Please contact with administrator.</span></th>';
						}elseif($status == "checklist_updating_success"){			
							echo '<th width="100%">Checklist successfully updated</th>';
						}elseif($status == "checklist_update_error"){			
							echo '<th width="100%"><span class="error">Sorry! An error occoured while updating checklist. Please contact with administrator.</span></th>';
						}elseif($status == "checklist_deleting_success"){			
							echo '<th width="100%">One item successfully deleted from checklist</th>';
						}elseif($status == "checklist_deleting_error"){			
							echo '<th width="100%"><span class="error">Sorry! An error occoured while deleting one item from checklist. Please contact with administrator.</span></th>';
						}
					?>
					</tr>
                </table>
                <?php 
					}
                ?>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
                  <thead>
                    <th width="15%">
                      <a href="#" title="Sort descending">
                        Service
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
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
                    <?php 
						if(isset($checklist) && count($checklist)){
							foreach($checklist as $value){
                    ?>
                    <tr>
                      <td width="15%"><?php echo  $value['serviceName'].', '.$value['subserviceName']; ?> <!-- - <br><span class="colorspn">Community Hall</span>--></td>
                      <td width="30%"><?php echo  $value['discription']; ?></td>
                      <td width="15%"><?php echo  (($value['status']==1) ? "Confirmed" : "Enquired"); ?> </td>
                      <td width="30%"><?php echo  $value['comment']; ?></td>
                      <td width="10%"><a href="#" class="col-md-6 col-lg-6 chklist-ed-del" data-toggle="modal" data-target="#checklist_edit_modal" onclick="checklistEdit(<?php echo "'".$value['checklist_id']."', '".$partyDetail['party_id']."'"; ?>);"><span><i class="fa fa-pencil-square-o"></i></span></a><a class="col-md-6 col-lg-6 chklist-ed-del" href="<?php echo base_url().'users/deleteChecklist/'.$value['checklist_id'].'/'.$partyDetail['party_id']; ?>"><span><i class="fa fa-trash-o"></i></span></a></td>
                    </tr>
                    <?php 
						} 
                    }else{
						echo '<tr><td colspan="5">Sorry! No data found.</td></tr>';
					} 
                    ?>                 
                  </tbody>
                </table>
              </div>
              
			  
			  
			  
			   <div class="clearfix"></div>
            </div>
            
          </div>
          <!-- /Tab -3 -->
           <!-- Tab -4 -->
          <div data-content="4" class="content <?php echo $budget_class; ?>">
            
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
                  	<li><a href="#" class="btn btn-default" data-toggle="modal" data-target="#checklist_modal" onclick="drawBudgetAddForm('<?php echo $partyDetail['party_id']; ?>');">Add New</a></li>
                   <li>
                        <select class="myselect" id="budgetChecklistSwitcher1" onchange="switchBudgetChecklist(this.value, this.id);">
                            <option value="checklist">Checklist</option>
                            <option value="budget" selected>Budget</option>
                        </select>
                    </li>
                </ul>
              </aside>
            </div>
            <div class="form-content">
              <div class="table-responsive">
				<?php
					if(isset($status) && in_array($status, $budget_status)){
                ?>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
					<tr>
					<?php 
						if($status == "budget_adding_success"){			
							echo '<th width="100%">Budget Successfully Added</th>';
						}elseif($status == "budget_error"){			
							echo '<th width="100%"><span class="error">Sorry! An error occoured while adding budget. Please contact with administrator.</span></th>';
						}elseif($status == "budget_updating_success"){			
							echo '<th width="100%">Budget successfully updated</th>';
						}elseif($status == "budget_update_error"){			
							echo '<th width="100%"><span class="error">Sorry! An error occoured while updating budget. Please contact with administrator.</span></th>';
						}elseif($status == "budget_deleting_success"){			
							echo '<th width="100%">One budget successfully deleted</th>';
						}elseif($status == "budget_deleting_error"){			
							echo '<th width="100%"><span class="error">Sorry! An error occoured while deleting one budget. Please contact with administrator.</span></th>';
						}
					?>
					</tr>
                </table>
                <?php 
					}
                ?>
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist mypartylist1 text-capitalize">
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
                    <?php 
						$total = 0;
						if(isset($budget) && count($budget)){
							foreach($budget as $value){
								$total += $value['ammount'];
                    ?>
                    <tr>
                      <td width="15%"><?php echo  $value['serviceName'].', '.$value['subserviceName']; ?> <!-- - <br><span class="colorspn">Community Hall</span>--></td>
                      <td width="30%"><?php echo  $value['discription']; ?></td>
                      <td width="15%">$<?php echo  $value['ammount']; ?></td>
                      <td width="30%"><?php echo  $value['comment']; ?></td>
                     <td width="10%"><a href="#" class="col-md-6 col-lg-6 chklist-ed-del" data-toggle="modal" data-target="#checklist_edit_modal" onclick="budgetEdit('<?php echo $value['budget_id']; ?>', '<?php echo $partyDetail['party_id']; ?>');"><span><i class="fa fa-pencil-square-o"></i></span></a><a class="col-md-6 col-lg-6 chklist-ed-del" href="<?php echo base_url().'users/deleteBudget/'.$value['budget_id'].'/'.$partyDetail['party_id']; ?>"><span><i class="fa fa-trash-o"></i></span></a></td>
                    </tr>
                  <?php 
						}
					?>
                    <tr>
                      <td width="15%">Total</td>
                      <td width="30%">&nbsp;</td>
                      <td width="15%"><span class="big">$ <?php echo $total; ?></span></td>
                      <td width="30%">&nbsp;</td>
                      <td width="10%">&nbsp;</td>
                    </tr>
                     <?php
					}else{
					?>
					<tr>
						<td width="100%" colspan="5">Sorry! no budget(s) found.</td>
                    </tr>
					<?php	
					}
                   ?>
                  </tbody>
                </table>
              </div>
               <div class="clearfix"></div>
            </div>
            
          </div>
          <!-- Tab -4 -->
          <!-- Tab -5 -->
          <div data-content="5" class="content <?php echo $guestList_class; ?>" id="body_subcontent">
          

          </div>
           <!-- /Tab -5 -->
          <!--checklist and budget form start-->
					<div id="checklist_modal" class="modal fade newchecklistmodal" role="dialog">
					  <div class="modal-dialog" id="checklist_add">
					  </div>
					</div>
					 
                <!--checklist and budget form end-->
                
                
                <div id="checklist_edit_modal" class="modal fade newchecklistmodal" role="dialog">
					<div class="modal-dialog" id="cheklist_edit">
					</div>
				</div>
                
                
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Body --> 

<?php require_once BASEPATH."../assets/front/lib/footer.php" ?>

<script>
	$(document).ready(function(){
		window.onload = function() {
		  gotoGuestList('<?php echo base64_encode($party_id); ?>', 'guestlist', false);
		};
	});
	
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
                $('#datetimepicker1').datetimepicker();
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
                            <li><i><img src="images/w.png" alt="" /></i><p><a href="#">www.hostmyparty.com</a></p><div class="clearfix"></div></li>
                            <li><i><img src="images/al.png" alt="" /></i><p>MON to SAT - 09:00 am to 11:00 pm, SUN - Closed</p><div class="clearfix"></div></li>
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

<!-- Modal popup start for book now -->
<div id="booknow-modal" class="modal fade mymodal" role="dialog">
  <div class="modal-dialog2 mymodal-dialog" id="book_now_ajax">


  </div>
</div>

<!-- Modal popup end book now -->

<!-- Modal Popup-->
<div id="myModal_new_05" class="modal fade" role="dialog">
  <div class="modal-dialog" id="showComunication">

     

  </div>
</div>
<!-- /Modal Popup-->               
</body>
</html>
