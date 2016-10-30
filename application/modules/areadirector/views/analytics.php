<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 
<style>
.design_select {border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
</style>
<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi Manisha Bajpai</h2>
    <div class="right-wrapper pull-right">
      </ol>
    </div>
  </header>
  <section class="panel">
    <div class="panel-body">
      <h2 class="panel-title">Analytics</h2>
    </div>
   
     <div class="panel-body panel_body_top">
     <div id="messageError" class="col-md-12"></div>
     <div class="col-md-2 selection">
        <div class="form-group sub_text1">
           <label for="inputDefault" class="control-label">City  :</label>
           <div class="">
				 <select class="form-control design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                <option value="0">Select City</option>
                                        <?php foreach($cities as $key=>$value) {
											
											
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
											
										} ?>
				           </select> 
				</div>
        </div>
     </div>
     
     <div class="col-md-3 selection pad_left0">
			<div class="form-group sub_text1">
							
				<label for="inputDefault" class="control-label ">Location :</label>
				<div class="">
				 <select class="form-control design_select" name="location" id="location" onchange="get_business(this.value)" onclick="removeValidateHtml('location')">
                                 <option value="0">Select Location</option>
				 </select>
				</div>
				
			</div>
		</div>
        
        <div class="col-md-3 selection">
			<div class="form-group sub_text1">
			   <label for="inputDefault" class="control-label pad_left0">Business Centers :</label>
				<div class="">
				<select  class="form-control design_select" name="business" id="business" onchange="getroomsBybusiness(this.value)" onclick="removeValidateHtml('business')" >
                                 <option value="0">Select Business Centers</option>
				</select>
				</div>
				
			</div>
		</div>
        
        
        
        <div class="col-md-2 selection" >
        <div class="form-group sub_text1">							
			       <label for="inputDefault" class="control-label pad_left0">Start Date :</label>
            <input type="text" value="" class="form-control" placeholder="Start Date" name="start_date" id="dtStart">
        </div>
		</div>
        <div class="col-md-2 selection" >
        <div class="form-group sub_text1">							
			       <label for="inputDefault" class="control-label pad_left0">End Date :</label>
             <input type="text" value="" class="form-control" placeholder="End Date" name="end_date" id="dtEnd">
        </div>
		</div>
        
        
        
          <div class="col-md-3 selection" >
        <div class="form-group sub_text1">
           <label for="inputDefault" class="control-label">Category  :</label>
           <div class="">
				 <select class="form-control design_select" onchange="get_subcat(this.value);" name="cat" id="cat" onclick="removeValidateHtml('cat')">
                        <option value="">Select Category</option>
                        <option value="sal">Sales & Marketing</option>
               	</select> 
				</div>
        </div>
		</div>
        
        <div class="col-md-3 selection" >
        <div class="form-group sub_text1">
           <label for="inputDefault" class="control-label">Sub Category  :</label>
           <div class="">
				 <select class="form-control design_select" id="sub" name="sub" onchange="get_analytics(this.value);" onclick="removeValidateHtml('sub')">
                    <option value="">Select Sub Category</option>                                     
                   </select> 
				</div>
        </div>
		</div>
        
        
        <div class="col-md-3 selection" >
        <div class="form-group sub_text1">
           <label for="inputDefault" class="control-label">Analytics Name  :</label>
           <div class="">
				 <select class="form-control design_select" name="analytics" id="analytics" onclick="removeValidateHtml('analytics')">
                     <option value="">Select Analytics Name</option>
          </select> 
				</div>
        </div>
		</div>
        
        <div class="col-md-3 selection" >
        <div class="form-group sub_text1">
           <button type="button" id="add_classifieds" class="btn btn-primary" style="margin-top:27px;">Show Analytics</button>
				</div>
        </div>
       
     </div>
 

    
   <div class="panel-body panel_body_top">
    <div class="cende-table" id="ajax_table">
        <div class="table-responsive">
        <div class="col-md-2 pull-right" style="float:none; text-align:right;">
        <a id="print_pdf" href="JavaScript:void(0)" target="_new"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
        </div>
          <table class="table table-bordered table-striped"  >
        		<thead>
        		    <tr role="row">
                  <th style="text-align: center;">Details</th>
                </tr>
        		</thead>
          </table>
          <table class="table table-bordered table-striped"  > 
        		<tbody id="ajax_data">
                <tr>
                  <td colspan="1">No data Available</td>
                </tr>
        		</tbody>
		      </table>
        </div>
        </div>
    </div>
    
    
   
  </form>
  </section>
</section>
<style>
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
        $("#messageError").html('');
        $("#dtStart").datepicker({
            format: 'yyyy-mm-dd',
            pickTime: false,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#dtEnd').datepicker('setStartDate', startDate);
            console.log($(this).val());
        }).on('clearDate', function (selected) {
            $('#dtEnd').datepicker('setStartDate', null);
        });
        $("#dtEnd").datepicker({
            format: 'yyyy-mm-dd',
            pickTime: false,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $('#dtStart').datepicker('setEndDate', endDate);
            console.log($(this).val());
        }).on('clearDate', function (selected) {
            $('#dtStart').datepicker('setEndDate', null);
        });
      $('#print_pdf').click(function(){
      	 if(cityValidation() && locationValidation() && businessValidation() && analytics_category() && analytics_subcategory() && analytics_name()){
      	 	var city=$("#city").val();
	      	var location=$("#location").val();
	      	var business=$("#business").val();
	      	var start_date=$("#dtStart").val();
	      	var end_date=$("#dtEnd").val();
	      	var cat=$("#cat").val();
	      	var sub=$("#sub").val();
	      	var analytics=$("#analytics").val();
	      	$(this).attr("href", "<?php echo base_url();?>index.php/areadirector/search_analytics_pdf/"+city+"/"+location+"/"+business+"/"+start_date+"/"+end_date+"/"+cat+"/"+sub+"/"+analytics);
  	 	}else{
			return false;
		}
      });
      $("#add_classifieds").click(function(){
      if(cityValidation() && locationValidation() && businessValidation() && analytics_category() && analytics_subcategory() && analytics_name()){
      	var city=$("#city").val();
      	var location=$("#location").val();
      	var business=$("#business").val();
      	var start_date=$("#dtStart").val();
      	var end_date=$("#dtEnd").val();
      	var cat=$("#cat").val();
      	var sub=$("#sub").val();
      	var analytics=$("#analytics").val();
     // alert($("#city").val(););
      	$.ajax({ 
      	method: "POST", 
      	url: "<?php echo base_url();?>index.php/areadirector/search_analytics", 
      	data: "city="+city+'&location='+location+'&business='+business+'&start_date='+start_date+'&end_date='+end_date+'&cat='+cat+'&sub='+sub+'&analytics='+analytics,
      	async: false, 
      	success: function(data) { 
			$("#ajax_data").html(''); 	
	        $("#ajax_data").html(data.trim()); 
      	} 
		});
		}else{
			return false;
		}
			
		});
});
		
		
  function get_location(value){
$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getlocationbycity", 
      data: { id:value }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#location").html(data.trim()); 
      } 
    });
}

function get_business(value)
{
	//alert(js_site_url);
	//alert(value);
var city = $("#city").val();
	$.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/rooms/getBusinessByLocation", 
      data: { id:value,city:city, }, 
      async: false, 
      success: function(data) { 
	  	//alert(data);
	  	
        $("#business").html(data.trim()); 
      } 
    });
}
function get_subcat(value)
{

  $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/owner/get_subcat", 
      data: { value:value }, 
      async: false, 
      success: function(data) {
      $("#sub").html(data.trim()); 
      } 
    });
}
function get_analytics(value)
{

  $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/owner/get_analytics", 
      data: { value:value }, 
      async: false, 
      success: function(data) {
      $("#analytics").html(data.trim()); 
      } 
    });
}
</script>   