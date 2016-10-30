<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 


<section role="main" class="content-body">
	<header class="page-header">
		<h2> View Complaints</h2>
<!--
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>
			</ol>
</div>
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
	



<section class="panel">
							<header class="panel-heading">  
							<!--	<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div> 
						
								<h2 class="panel-title"> View Complaints</h2>-->
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Office Name</th>
											<th>Subject</th>
											<th>Message</th>
												<th>Added By</th>
											<th>Date</th>
										</tr>
									</thead>
						 			
                                        <?php //print_r($view);
											if(!empty($view)){
		  	                                foreach($view->result_array() as $row)
			                                {
		                                      ?>
										<tr>
											<td><?php echo $row['classifiedName'];  ?>   </td>
											
											<td><?php echo $row['subject'];   ?>        </td>
											
											<td><?php echo $row['message'];   ?>         </td>

											<td>  <?php echo $row['FirstName']." ".$row['LastName']; ?> </td>

                                            <td><?php echo $row['dateadded'];   ?>       </td>
                                        </tr>


										<?php }}else{?>
											
												<tr class="gradex"><td colspan="6">No Classifieds Available.....</td></tr>
											
										
											<?php }?>	
											
							
											                          		
				        </table>
								
							</div>
							
							
						</section>
									<div class="clearfix"></div>







<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>


		
		
