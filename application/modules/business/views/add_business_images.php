<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
					
						
					</header>
<style>
	.fa-trash-o{
		font-size: 30px;
		color: #FF0000;
	}
	.ord_chng{
		width: 40px;
	}
	#notifi{
		color: #FF0000;
		font-size: 15px;
		margin-bottom: 15px;
	}
	#uploddiv{
		margin-top: 15px;
	}
	#frm_elm{
		margin-top: 20px;
	}
	.no_response{
  position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
</style>
     <section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title">Add Multiple Images For Business CENTERS</h2>
	</header>
	<div class="panel-body ">
		
		
		<div class="row"></div>
		<!-- Message -->
		<?php if($this->session->flashdata('item_warning')){ ?>
			<div class="alert alert-warning" role="alert"><?php echo $this->session->flashdata('item_warning'); ?></div>
		<?php } ?>
		<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
		<?php if($this->session->flashdata('edit')){ ?>
			<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
		<?php } ?>
		<!-- Message -->
		
		<div class="table-responsive col-md-6">
			<table class="table text-dark">
				<thead>
					<tr>
						<th align="center">Image</th>
						<th align="center">Default</th>
						<th align="center">Actions</th>
					</tr>

				</thead>
				<tbody class="text-dark">
					
						<?php 
										// $row = $classified[0]; 
										 
										 ?>
											<?php  $attributes = array('name' => 'form','id' => 'frmord','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/business/add_business_images/'.$this->uri->segment(3), $attributes);?>

						<?php //print_r($res);
						if(!empty($res)){ ?>
						<?php foreach($res as $row1){ ?>
						<tr>
							<?php if($row1['s_deleted']==0){ ?>
							<td>
								<img src="<?php echo base_url().'assets/uploads/images/small/'.$row1['imageName']; ?>">
							</td>
							<?php }else{?>
								<td><img src="<?php echo base_url();?>assets/front/images/noimages.jpg"/></td>
								<?php }?>

							<td align="">
								<input type="radio" id="def_chng" name="def_chng" <?php echo ($row1['primaryImage'] == 1) ? "checked" : "";?> value="<?php echo $this->uri->segment(3);?>_<?php echo $row1['id'];?>">
							</td>
							<td align="">
								<a onclick="return myFunction();" href="<?php echo base_url().'index.php/business/delete_business_image/'.$this->uri->segment(3).'/'.$row1['id'];?>" class="remove_field on-default remove-row"><i class="fa fa-trash-o"></i></a>
							</td>

						</tr>
						
						
						
						<?php }}else{ ?>
						<tr>
							<td colspan="2">
								No Data Found
								
							</td>
							
						</tr>
						<?php } ?>

						<tr>
							<td colspan="4">
								<div id="loading_img" style="display:none;"><img src="<?php echo base_url().'assets/uploads/images/loader.gif' ;?>" alt=""></div>
							</td>
							
						</tr>
					</form>
				</tbody>
			</table>
		</div>
		<div id="overlay" class="no_response" style="display: none;"></div>
		<div class="table-responsive col-md-6" id="uploddiv">
			
			<form id="frmAddlisting" name="frmAddlisting" class="form-horizontal" action="<?php echo base_url().'index.php/business/add_business_images/'.$this->uri->segment(3); ?>" method="post" enctype="multipart/form-data" onsubmit="return image_upload();">
				
				<div class="row">
					<div class="col-xs-12">
						<div class="well">
							<div class="row">
								<div class="col-md-8">
									<h4>Upload Image</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="file" name="service_img"  id="service_img" class="custom-file-input valid">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12" id="frm_elm">
									<input type="submit" class="btn btn-primary pull-right" name="sub_image" id="sub_image" value="Save">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

			</div>
	
				<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

</section>

<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script>
	function image_upload() {
		
		if($('#service_img').val()!="")
		{
			
			$('#overlay').css('display','block');
			$('#loading_img').css('display','block');
			return true;
		}else{
			alert('Please Choose your file!!!');
			return false;
		}
		
	}
	function myFunction(){
		var retVal = confirm("Are you sure you want to delete this Image?");
		if(retVal){
			return true;
		}
		else{
			return false;
		}
	}
$(document).ready(function(){
		
		$(document).on('click',"#def_chng", function(e){
			//alert('hii');
			var business_id ="<?php echo $this->uri->segment(3); ?>";
			e.preventDefault();
			var pdata = $("#frmord").serialize();
			var url = $("#base_url").val();
			//alert(url);
			$.ajax({
				type:'POST',
				 url: url+'index.php/business/changeimageorder', 
				data:pdata,
				success: function(data){
					//alert(data);
					window.location=url+"index.php/business/add_business_images/"+business_id;
				}
			})
			
		});
		
});
</script>
