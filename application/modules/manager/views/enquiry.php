<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
			</ol>
</div>
			
		
	</header>

				
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<div class="panel-body"><h2 class="panel-title">Client User List</h2></div>					
							<div class="panel-body panel_body_top">
							
							</div>
						</section>
					
					
				</section>
			
	
			
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
function changeuserStatus(id,status)
{
	//alert(js_site_url);
	//alert(id);
	var table='user';
	var pid='userId';
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/users/changeuserStatus", 
      data: { _id:id, _status:status,_table:table,_pid:pid,}, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#statusId"+id).html(data.trim()); 
      } 
    });
}

</script>
