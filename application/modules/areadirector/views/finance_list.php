<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<section role="main" class="content-body">
	<header class="page-header">
			<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
			<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;   height: 36px;}
		.total {font-size:16px;color:#000;}
		</style>

		<div class="right-wrapper pull-right">
			<!---<ol class="breadcrumbs">
				<li>
					<a href="" title="Dashboard">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>--->
			</ol>
</div>
			<!---<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>--->
		
	</header>
<section class="panel">
	
	<header class="panel-heading">
		<!---<h2 class="panel-title">Revenue  of <?php // NOW( ) - INTERVAL 1 MONTH ;
		$currentMonth = date('F');
echo Date('F', strtotime($currentMonth . " last month"));?>	    <?php echo date("Y"); ?></h2>	--->				
		<h2 class="panel-title">Revenue By Location</h2>			
							</header>
		<div class="panel-body">
									<div>
										<?php //print_r($location);?>
								 				<div class="col-md-5">  
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Month</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control" id="yearMonthInput"></select>
                                                        </div>
                                                    </div>
                                     
                                                     
                                                     </div>
                                        	 
                                               <div class="col-md-7">
                                               		<label class="col-md-7">
                                                    <select class="form-control" name="location" id="location" >
                                                <option value="0">Search By Location</option>
                                                <?php foreach($location as $key=>$value) {
                                                    
                                                    echo '<option value="'.$value['cityId'].'/'.$value['locationId'].'">'.$value['name'].' ('.$value['c_name'].')</option>'; 
                                                
                                                    
                                                } ?>
            
                                                </select>
                                                	</label>
                                                    <div class="col-md-2"> 
                                                    	<button type="button" class="btn btn-primary" onClick="searchlocationrevenue()" id="submit">Search</button>
                                                    </div>
                                                    
                                                   <div class="col-md-3" id="total_revenue" style="margin-top: 8px;"></div>
                                                    
                                                   </div>
                                               </div>
                                                
                                                <br />
                                                
                                                
                                               
                                               
									</div>
                                    
	</section>
					
					<section class="panel">
						<?php if($this->session->flashdata('item')){ ?>
						<div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('item'); ?></div>
						<?php } ?>
						<?php if($this->session->flashdata('item_error')){ ?>
						<div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                        <?php } ?>
							<header class="panel-heading">
							<h2 class="panel-title">Revenues for all locations</h2>			
							</header>	
						
							
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th style="display: none;">No</th>
											<th>Company Name</th>
											<th>Address</th>
											<th>Location</th>
											<th>City</th>
											<th>Invoice Date</th>
											
											
											<th>Revenue Amout</th>
											
											
										</tr>
									</thead>
									<tbody>
									<?php
										if($query)
										{
											//print_r($query);
											$counter=0;
											foreach($query as $row)
											{

												$id=$row['id'];
        										
									?>      
									
									<tr id="del<?php echo $id; ?>" class="gradeX">
									<td style="display: none;"><?php echo $counter++; ?></td>
									<td><?php echo $row['company_name']; ?></td>
                                  
                                     	<td><?php echo $row['address']; ?></td>  
                                     	
                                     	<td><?php echo $row['l_name']; ?></td>  
                                     	
                                     	<td><?php echo $row['c_name']; ?></td>  
                                     	<td><?php echo $row['publish_date']; ?></td>   	
                                     	<td><?php echo  money_format('%i',$row['total_amount']); ?></td>   
                                   
								  </tr>									
									  										
        							<?php
											}
										}
																		
									else{?>
											
											<tr class="gradex"><td colspan="8">No Revenue  Available.....</td></tr>
											
							
											
									<?php
									}?>
										
										
									</tbody>
								</table>
							</div>
						</section>
					
					
				</section>
			
	
			
			
		</section>
		
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script>
	var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    for (i = new Date().getFullYear() ; i > 2008; i--) {
		var j=1;
        $.each(months, function (index, value) {
            $('#yearMonthInput').append($('<option />').val(j + "_" + i).html(value + " " + i));
            j++;
        });                
    }
function searchlocationrevenue()
{
	//alert(js_site_url);
	//alert(id);
	
	var id = $("#location").val();
	var date = $("#yearMonthInput").val();
	//alert(date);
	if(id!='0'){
	var id=id.split("/");
	var city=id['0'];
	var location=id['1'];
	//alert(location);
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/areadirector/searchlocationrevenue", 
      data: { location:location,city:city,date:date}, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
        $("#total_revenue").html(data.trim()); 
        $("#total_revenue").addClass("total");
      } 
    });
}
else{
alert('Please choose any location!');	
	
}
}
$(function() {
	$('.monthYearPicker').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy'
	}).focus(function() {
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
		});
	});
});
</script>
