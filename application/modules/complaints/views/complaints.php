<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
	 	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
	</header>						
<body>
<section class="panel">
	<div class="panel-body">
		<h2 class="panel-title">FEEDBACK
			<?php if($this->session->userdata("userTypeId")!="ut7" && $this->session->userdata("userTypeId")!="ut10" ){?>
			<a href="<?php echo $this->config->item('base_url');?>index.php/complaints/add_complaints" class="panel-action pull-right" title="Add Complaints"><i class="fa fa-plus"></i></a>
			<?php }?>
		</h2>
	</div>
	<div class="panel-body panel_body_top">		
		<div>
			<form  name="addAttiributesspeFrm" id="form" method="post" action="<?php echo $this->config->item('base_url');?>index.php/complaints/search_complaints_bydate" enctype="multipart/form-data">	
                <div class="col-md-6" style="padding-left:0;">
						<div class="input-daterange input-group" data-plugin-datepicker>
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control" placeholder="FROM" name="start_date" id="start">
									<span class="input-group-addon">to</span>
									<input type="text" class="form-control" placeholder="TO" name="end_date" id="end">
						</div>
				</div>
        		<div class="col-md-2">
                    <button type="submit" class="btn btn-primary" onClick="" id="submit">Search By Date</button>
               	</div>
               <div class="col-md-3">       
				 	<select class="design_select" name="status" id="status" onChange="getbycomplaintstatus(this.value)" onclick="removeValidateHtml('city')">
                    	<option value="2">Search By Status</option>
                    	<option value="1">Close</option>
                        <option value="0">Open</option>
            		</select>
                                        	 
			</form>	<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<?php if($this->session->flashdata('item')){ ?>
			<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
		<?php } ?>
		<?php if($this->session->flashdata('item_error')){ ?>
			<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
		<?php } ?>
		<div class="clearfix"></div>
		 <div id="table_result_ajax" style="margin-top: 30px;">
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
				<thead>
					<tr>
					
						<th>Subject</th>
						<th>Message</th>
						<th>Type</th>
						<th>AddedBy</th>
						<th>Location</th>
						<th>City</th>
						<th>DateAdded</th>
						
                        <th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			    <?php foreach($complaints as $complaint){ ?>
                    <tr>
	                   	<td><?php   echo $complaint['subject']; ?></td>
	                   	<td><?php   echo $complaint['message'];  ?></td>
	                   	<td><?php   echo $complaint['complaint_type'];  ?></td>
				<td><?php   echo $complaint['FirstName'];  ?>  <?php   echo $complaint['LastName'];?></td>
				<td><?php   echo $complaint['l_name'];  ?></td>
				<td><?php   echo $complaint['c_name'];  ?></td>
	                   	<td><?php   echo $complaint['dateadded']; ?></td>
							<td id=""  class="center hidden-phone">
							<a title="<?php if($complaint['status']==1){ echo 'closed'; } else{ echo 'open';} ?>" class="demo-basic"  >
							<?php if($complaint['status']==1){ echo 'closed'; } else{ echo 'open';} ?>
							</a>
						</td>
                       <td>
						<?php if($this->session->userdata("userTypeId")!="ut7" && $this->session->userdata("userTypeId")!="ut10"){?>							   
 							<a onClick="return confirm('Are you sure?');" href="<?php echo site_url('index.php/complaints/delete_complaints') . '/' .$complaint['complain_id']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
 						<?php }else if($complaint['status']<>'1'){?>
	  						<a onClick="return confirm('Are you sure to close this Complaints?');" href="<?php echo site_url('index.php/complaints/close_complaints') . '/' .$complaint['complain_id']; ?>"><i class="fa fa-times"></i></a> 
  						<?php }?>&nbsp;&nbsp;&nbsp;
                       </td>
                   </tr>       
                   <?php } ?>
                          		
	        </table>
		</div>	
</section>
<style>
.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;   height: 36px;}
.redmessage{
border:1px solid #f00;
color:#f00;                                                       	
	
}
.redmessage{ box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;}
.redmessage::-moz-placeholder {
    color: #FF0000;
 }

.redmessage::-webkit-input-placeholder 
{
  color: #FF0000;
}

</style>							
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script type="text/javascript">								
$(document).ready(function() {
  $("#submit").click(function(){
	 
		//alert('1');
		if(dateValidation()){
			
			$("#form").submit();
		}else{
			return false;
		}
		
	});
});	
function getbycomplaintstatus(value)
{
	
	if(value!='2'){
	

	$.ajax({ 
      method: "POST", 
      url: "<?php echo base_url();?>index.php/complaints/getbycomplaintstatus", 
      data: { status:value }, 
      async: false, 
      success: function(data) { 
	  //	alert(data);
	  	
        $("#table_result_ajax").html(); 
        $("#table_result_ajax").html(data.trim()); 
      } 
    });
}
}					
</script>
