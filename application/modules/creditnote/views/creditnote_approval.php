<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			<!--<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>-->
			</ol>
</div>
			<!--<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
		
	</header>

					
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">Credit Note Requests</h2></div>					
							<div class="panel-body panel_body_top">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
									          <th style="display: none;">No</th>
										  <th>Request Date</th>
										  <th>Client Name</th>
										  <th>Invoice no & Date</th>
                                                                                  <th>Credit Requests Details</th>
                                                                                  <th class="hidden-phone">Action</th>
											
										</tr>
									</thead>
									<tbody>
									<?php
									/*echo '<PRE>';
									print_r($credit_notes);
									echo '</PRE>';*/
										if($credit_notes)
										{
											$counter=0;
											foreach($credit_notes as $row)
											{

												$id=$row['c_id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['dateAdded']; ?></td>
									<td><?php echo $row['company_name']; ?></td>
									<td><?php echo $row['invoice_number']; ?><br/>
									<?php echo $row['publish_date']; ?></td>
                                  <?php $name = $row['table_name'];            
                        
                        $percentage=$row['creditnote_amount'];
                        $totalWidth=$row['item_price'];
                      	if($row['credit_type']=='1'){
                         $new_width = ($percentage / 100) * $totalWidth;
                         $total=$new_width;
                      	}else if($row['credit_type']=='2'){
                         $total=$percentage;
                      	}
                      	switch ($name) {
                          case "request_courier_service":
                          echo "<td><b>ITEM:</b>Courier Service Request<br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                          break;
                          case "request_food_service":
                          echo "<td><b>ITEM:CAFE SERVICE REQUEST</b><br/>
			   <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";

				      
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
                          echo "<td><b>ITEM:</b>ADMIN SUPPORT REQUEST
			  <br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                          break;
                          case "book_conference_room":
                          echo "<td><b>ITEM:</b>Booking Conference Room<br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                         /* $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                          }*/
                          break;
                          case "book_meeting_room":
                          echo "<td><b>ITEM:</b>Booking Meeting Room<br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                         /* $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                          }*/
                          break;
                          case "book_dayoffice":
                          echo "<td><b>ITEM:</b>Book Day Office<br/>
			 <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                         /* $bookings = json_decode($item['service_details']['booking_details'], true);
                          foreach ($bookings as $date => $times) {
                              echo "<b>Date : </b>".$date."<br>&nbsp;&nbsp;<b>Time Slots : </b><br>";
                              foreach ($times as $time) {
                                echo "&nbsp;&nbsp;".$time.'<br>';
                              }
                          }*/
                          break;
                          case "book_locker_room":
                          echo "<td><b>ITEM:</b>Locker Room Book<br/>
			 <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                          break;
                          case "book_game_room":
                          echo "<td><b>ITEM:</b>Game Room Book<br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                          break;
                          case "request_conceirge_service":
                          echo "<td><b>ITEM:</b>Conceirge Service Request<br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                          break;
                          case "book_floor_plan":
                          echo "<td><b>ITEM:</b>Floor Plan Book<br/>
			  <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                           /* $bookings = json_decode($item['service_details']['booking_detailes'], true);
                          foreach ($bookings as $floor_plan_id) {
                            $floor_plan_name = $this->invoice_model->getFloorPlanDetails($floor_plan_id);
                              echo "&nbsp;".ucfirst($floor_plan_name['description']).'<br>';
                          }*/
                          break;
                          case "booking_virtual_office":
                          echo "<td><b>ITEM:Virtual Office Book</b><br/>
			 <b>Amount charged:INR</b> ".$row['item_price']. 
			  "<br/>
			  <b>Credit Requested:INR</b> ".$total."<br/>
			  <b>Reason:</b>".$row['c_description']."</td>";
                           /* $bookings = json_decode($item['service_details']['booking_detailes'], true);
                          foreach ($bookings as $floor_plan_id) {
                            $floor_plan_name = $this->invoice_model->getFloorPlanDetails($floor_plan_id);
                              echo "&nbsp;".ucfirst($floor_plan_name['description']).'<br>';
                          }*/
                          break;
                          default:
                          echo "";
                      }?>
                     

												<!--<td id="statusId<?php echo $id; ?>"  class="center hidden-phone">
												<a title="<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>" class="demo-basic" href="javascript:void(0)" onclick="change_location_status('<?php echo $id; ?>','<?php echo $row['status']; ?>')">
												<?php if($row['status']==1){ echo 'Active'; } else{ echo 'Inactive';} ?>
												</a>
											</td>-->
											<!--<td id="statusId<?php echo $row['c_id']; ?>" title="Activate" onclick="approve_credit_note('<?php  echo $row['c_id'];?>')"><font color="green">
										<i class="fa fa-check-square-o" style="font-size:18px;"></i></font>
</td>--><?php if($row['isApproved']=='0'){?>
<td class="center hidden-phone">
<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/creditnote/approve_credit_note/<?php echo $row['c_id'];?>/1" title="Approve" class="demo-basic"  onclick="return confirm('Are you sure you want to Approve')"><i class="fa fa-check-square-o"></i></a>
<a style="margin-left: 12px;" href="<?php echo $this->config->item('base_url');?>index.php/creditnote/approve_credit_note/<?php echo $row['c_id'];?>/2" title="Cancel" class="demo-basic"  onclick="return confirm('Are you sure you want to Reject')">
<i class="fa fa-ban"></i></a>
</td>
											<?php }else if($row['isApproved']=='1') {?>
<td><b><font color="green"><?php echo 'Approved'; ?></font></b></td>
<?php }else if($row['isApproved']=='2'){?>
<td><b><font color="red"><?php echo 'Rejected'; ?></font></b></td>
<?php }?>

								  </tr>									
									  										
        							<?php
											}
										}
									?>									
									
										
										
									</tbody>
								</table>
							</div>
						</section>
					
					
				</section>
			
	
			
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function change_location_status(id,status)
{
	//alert(js_site_url);
	//alert(id);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/location/change_location_status", 
      data: { _id:id, _status:status }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}

 f
</script>
