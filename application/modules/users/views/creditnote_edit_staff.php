<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script src="<?php echo $this->config->item('base_url');?>assets/admin1/javascripts/giocoading.js"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLW_f1V4had-BIM6OnqZ7huUfOfXNfDog&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
		
</div>
			
	</header>
		
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<header class="panel-heading">
										
										 <h2 class="panel-title">EDIT CREDIT NOTE APPROVAL LIMIT</h2>
											 
									 
						<?php 
										$row=$staff_credit[0];
										
										// $attributes = array( 'method'=>'post','name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          // echo  form_open_multipart('index.php/rooms/edit_game_room/'.$row['game_id'], $attributes);?>
		  <form action="<?php echo base_url();?>index.php/users/creditnote_edit_staff/<?php echo $row['userTypeId'];?>" method="post" enctype="multipart/form-data" name="form" id="form" class="orm-horizontal form-bordered" >
						
                                    
                                   
										<h2 class="panel-title"></h2>
									</header>
									<div class="panel-body  panel_body_top" style="margin-top:15px; border-radius:0px;">
										
											
           <?php if($this->session->flashdata('edit')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?> 
		
		
		
							
															
								<input type="hidden" name="id" value="<?php echo $row['userTypeId'];?>">
							
							
							<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">LIMIT %</label>
							<div class="col-md-6">
								<input class="form-control" name="percentage_creditnote" value="<?php echo $row['percentage_creditnote'];?>"   type="text">
							</div>
						    </div>
							
						   <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">LIMIT AMOUNT (INR)</label>
							<div class="col-md-6">
								<input class="form-control" name="amount_creditnote" value="<?php echo $row['amount_creditnote'];?>"    type="text">
							</div>
						    </div>
						
	
						
						
						
	
						
					
				
				</div>
		
		<div class="panel-footer">
		<div class="row">
			<div class="col-md-9 col-md-offset-3">
					<button type="submit" class="btn btn-primary" >Submit</button>
			</div>
		</div>
		</div>
	 </form>

			</div>
	
		</div>
	</div>
	
<!-- end: page -->
	</section>
<div class="clearfix"></div>
			


<?php //require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 

     
