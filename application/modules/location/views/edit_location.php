<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
		<section role="main" class="content-body">
					<header class="page-header">
							<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
					
<!--
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo $this->config->item('base_url');?>users/adminDashboard" title="Dashboard">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Pages</span></li>
								
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
-->
					</header>
<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">EDIT LOCATION   :   <?php echo $location[0]['name'];?>  (<?php echo $city[0]['name'];?>)</h2></div>					
							<div class="panel-body panel_body_top">
							<form  name="addAttiributesspeFrm" id="addAttiributesspeFrm" method="post"
								   action="<?php echo $this->config->item('base_url');?>index.php/location/edit_location/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" enctype="multipart/form-data">
							<fieldset>
								
                                <div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">City *</label>
									<div class="col-md-8">
									<select name="category" id="category" onchange="change_page_category(this.value)" class="form-control">
                                    	<!--<option value="0">Select page category</option>-->
                                        <?php foreach($cities as $key=>$value) {
											if($value['cityId'] == $location[0]['cityId'])
											{
												echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
											}
											else{
												echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>';
											}
										} ?>
                                    </select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="attributeName">Location *</label>
									<div class="col-md-8">
									<input type="text" name="name" id="name"
										   class="form-control" value="<?= $location[0]['name'] ?>">
									</div>
								</div>
								
                             
                                
                               
                                
                                
                                
								

							
							</div>
							<div class="panel-footer">
							<div class="row">
								<div class="col-md-9 col-md-offset-3">
									<button type="submit" class="btn btn-primary" onclick="" id="submit">Update</button>
								</div>
							</div>
							</div>
							</form>
				</section>
			</div>
	
				<?php //$this->load->view('right'); ?>
			
		</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 

<script>
	
	
	$(document).ready(function(e){
		
		
		
		$("#submit").click(function(e){
			var _category = $("#category").val();
			var _title = $("#name").val();
			//var _content = $("#content").val();
			//alert(_content);
			
			 if (_title == "") {
				$("#name").attr('placeholder','Please enter Location name');
				$("#name").css("border-color","red");
				$("#name").focus();
				e.preventDefault();
			}
			 //if (_content.length =="") {
				////alert('1');
				//alert('Please enter page description');
			    //CKEDITOR.instances.content.focus();
				//e.preventDefault();
			//}
			
			 if( !messageLength ) {
            alert( 'Please enter a description' );
            return false;
        }
			
		});
		
		});
	
		
	
</script>

