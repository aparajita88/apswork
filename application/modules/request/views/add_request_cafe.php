<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?> 

<section role="main" class="content-body">
	<header class="page-header">
	<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>

		<div class="right-wrapper pull-right">
			
</div>
			
	</header>
		<style>
		.design_select { background:#fff !important; border:1px solid #ddd; padding:5px 15px; font-size:15px; color:#000;}
		</style>
	<div class="row">
							<div class="col-lg-12">
								
								<section class="panel">
									<div class="panel-body">
										<div>
										<h2 class="panel-title">Smart Cafe</h2>
                                        </div>
                                    </div>
			                   
									<header class="panel-heading">
										 <div id="msg"></div>
										<div class="panel-actions">
											 
										</div>
						<?php  $attributes = array('name' => 'form','id' => 'form','class'=>"orm-horizontal form-bordered");
          echo  form_open_multipart('index.php/request/add_request_cafe', $attributes); ?>
           <select class="design_select" name="city" id="city" onchange="get_location(this.value)" onclick="removeValidateHtml('city')">
                                    	<option value="0">Select City</option>
                                       <?php foreach($cities as $key=>$value) {
											if($userData['city_id']==$value['cityId']){
											echo '<option value="'.$value['cityId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['cityId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select> <div id="error" style="display:none"  ></div>
										<!---<h2 class="panel-title">OFFICE SPACES</h2>-->
										 <select  class="design_select" name="location" id="location" onclick="removeValidateHtml('location')">
                                    	<option value="0">Select Location</option>
                                        <?php foreach($location as $key=>$value) {
											
											
												if($userData['location_id']==$value['locationId']){
											echo '<option value="'.$value['locationId'].'" selected>'.$value['name'].'</option>'; 
										}else{
											echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
										}
											
										} ?>
                                    </select>
										<h2 class="panel-title"></h2>
										
									</header>
									<div class="panel-body"
									
										
											
									   <?php if($this->session->flashdata('edit')){ ?>
                                                    <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('edit'); ?></div>
                                                    <?php } ?>
                                                    <?php if($this->session->flashdata('item_error')){ ?>
                                        <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('item_error'); ?></div>
                                    <?php } ?> 
					</form>
                    
                    
                    
                  <div id="ajax">
                    				<!-- Tea -->
                    				<?php if(!empty($cafe_cat)){
						foreach($cafe_cat as $key=>$value) {?>
                                    <div class="section_min">
									  
                                        <div class="col-md-3"><div class="rounddiv"><img src="<?php echo base_url();?>assets/uploads/images/cafe_image/<?php echo $value['image']; ?>" title="<?php echo $value['name'] ;?>"/> </div>
											<input type="hidden" value="<?php echo $value['id'] ;?>"   name="cat[]" class="cat" >
											<input type="hidden" name="subcat[]" class="subcat" id="subcat<?php echo $value['id'];?>"/>
											<input type="hidden" name="subqty[]" class="subqty" id="subqty<?php echo $value['id'];?>">
											<input type="hidden" name="totprice[]" class="totprice" id="totprice<?php echo $value['id'];?>" value="0">
											</label></div>
                                        <div class="col-md-9 ">
											
                                        <?php $catid=$value['id'];
                                        $subcat=$this->rooms_model->get_cafe_subcat($value['id']);
                                        foreach($subcat as $key=>$val){?>
                                        <input type="hidden" name="price_<?php echo $val['id'] ;?>" id="price_<?php echo $val['id'] ;?>" value="<?php echo $val['price'] ;?>"/>
                                        	<label for="" class="col-md-4 control-label cl_heignt checkbox">
												<input type="checkbox" name="radio_subcat_<?php echo $value['id'] ;?>"   class="radio_subcat cat_<?php echo $val['id'] ;?>" value="<?php echo $val['id'] ;?>" onClick="fnsubcat(this.value,'<?php echo $catid;?>',this)"/><?php echo $val['name'] ;?>
                                                <div class="col-md-12 " style="padding:0;">
                                        	<label for="" class="col-md-2 control-label"  style="padding:0;margin: 10px 0 0 -19px;">Qty.</label>
                                            <div class="col-md-7" style="padding:0; margin-top:10px;">
                                            	<input type="text" id="qty_<?php echo $val['id'] ;?>" value="" name="qty[]" class="form-control" style="width:60px;">	
                                            </div>
                                        </div>
                                                </label>
                                                
                                          <?php }?>
                                        </div>
                                       
                                         <div class="clearfix"></div> 
                                    </div>
                                     <?php }}?> 
                                  
                                  </div>
                                    <!-- /Tea -->
				
		
	
		</div>
	
	
<div class="panel-footer">
		<div class="row">
			<div class="col-md-12 ">
				<button type="button" id="add_classifieds" class="btn btn-primary">Place Order</button>
			</div>
		</div>
		</div>
	 <?php echo form_close();?>

			</div>
	
		</div>
	</div>
	
<!-- end: page -->
	</section>
<div class="clearfix"></div>
			


<?php require_once(FCPATH.'assets/admin/lib/right.php'); ?> 

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

.section_min { padding:15px; }
.section_min  + .section_min   { border-top:1px solid #ddd;}
.cl_heignt { min-height:45px;}
.section_min  .control-label {color: #000;    font-size: 14px;}

.section_min:nth-child(2n) { background:#d5e9f4 ; } 
.radio + .radio, .checkbox + .checkbox{margin-top: 10px;}
.rounddiv {
   border-radius: 50%;
   width: 160px;
   height: 160px;
   overflow: hidden;
}
</style>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?> 
<script type="text/javascript">
	
     $(document).ready(function() {
      $("#add_classifieds").click(function(){
		 var _prdsubcat;
		 var price=0;
		 if(cityValidation() && locationValidation()  && cafe_subcategory() && validate_qty()  ){
				
				var order = [];
				var i = 0;
				$(".cat").each(function() {
					cat_id = $(this).val();
                    _prdsubcat=$('#subcat'+cat_id).val();
                    price=parseInt(price)+parseInt($('#totprice'+cat_id).val());
					//price=parseInt(price);
                     if($("#subcat"+cat_id).val()!=""){
                     	order[i] = new Object();
						order[i].cat = cat_id;
						//order[i].sub_cat = $(".cat_"+cat_id).val();

						order[i].sub_cat = $("#subcat"+cat_id).val();
						order[i].qty = $('#subqty'+cat_id).val();
						
						i++;

                     }
						
					
				});
				order = JSON.stringify(order);
				//alert(order);
				var city=$("#city").val();
				var location=$("#location").val();
				$.ajax({ 
      method: "POST", 
      //dataType: "json",
      url: js_site_url+"index.php/request/add_request_cafe", 
      data: { order:order,city:city,location:location,price:price }, 
      async: false, 
      success: function(data) { 
		 //alert(data);
		  $('#msg').css('display','block');
		 $('#msg').addClass('alert alert-success');
		// $('#msg').html("Please check  types.");
	  $('#msg').html('You have successfully request for smart cafe items.<span style="padding-left:500px;"><a href="javascript:void(0)" onclick="closemsg()"><i class="fa fa-close"></i></span></a>');
	  	//alert('You have successfully request for smart cafe items.');
       $("#add_classifieds").prop('disabled', true);
      } 
    });
				
				return false;	
					//$("#form").submit();*/
			}else{
				return false;
			}
			
		});
			});
		
	function validate_qty()
	{
		//alert(1);
		var _cat = [];
		
		i=0;
		$(".cat").each(function() {
			
				_cat[i]=$(this).val();
					
			i++;
		});
		//alert(_cat.length);
		var f=0;
        var expsubcat;
        var k;
        var _subcat;
        var subqty='';
        var _totprice=0;
		for(i=0;i<_cat.length;i++)
		{

			if($('#subcat'+_cat[i]).val()!=""){

				_subcat=$('#subcat'+_cat[i]).val();
				expsubcat=_subcat.split('|');
				for(k=0;k<expsubcat.length;k++){

					if($("#qty_"+expsubcat[k]).val() == "" || $("#qty_"+expsubcat[k]).val() == 0) 
				 {
					 alert("Plase enter the quantity");
					 $("#qty_"+expsubcat[k]).focus();
					 return false;
				 }else{
				 	  if($('#subqty'+_cat[i]).val()=='' && subqty==''){
				 	  	subqty=subqty+$("#qty_"+expsubcat[k]).val();
				 	  }else if(subqty!=""){
				 	  	subqty=subqty+'|'+$("#qty_"+expsubcat[k]).val();
				 	  }else{
				 	  	subqty=subqty+$("#qty_"+expsubcat[k]).val();
				 	  } 
                      
                      _totprice=parseInt(_totprice)+parseInt(($("#qty_"+expsubcat[k]).val()*$('#price_'+expsubcat[k]).val()));
                      $('#subqty'+_cat[i]).val(subqty);
                      $('#totprice'+_cat[i]).val(_totprice);
                 
				 }
					
				}
				subqty='';
				_totprice=0;
			}
			

		}
		return true;
	}	
	function fnsubcat(subcat,cat,obj){
        var subcatid=$('#subcat'+cat).val();
        
	    if(obj.checked){
	    	if(subcatid==''){
	    		$('#subcat'+cat).val(subcat);
	    	}else{
	    		subcatid=subcatid+'|'+subcat;
	    		$('#subcat'+cat).val(subcatid);
	    	}
	    	
		
	}else{
		var cntres;
		var res;
		cntres=subcatid.split('|');
		if(cntres.length>1){
             res=subcatid.replace('|'+subcat,'');
		$('#subcat'+cat).val(res);
		}else{
			res=subcatid.replace(subcat,'');
		$('#subcat'+cat).val(res);
		}
		 

	}
		
		
	 
	}	
	function cafe_subcategory() {
		
		if(!$(".radio_subcat").is(":checked")) {
			alert("Must check any item!");
			return false;
		}
    
    return true;
}   
     
function get_location(value)
{
	//alert(js_site_url);
	//alert(value);

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
function closemsg(){
	$('#msg').html('');
	$('#msg').css('display','hidden');
		 $('#msg').removeClass('alert alert-success');
}
        
$('#location').change(function(){
    var id=$('option:selected',this).attr('value');
    var city=$("#city").val();
    //alert(city);
    if(id!=0){
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/request/get_cafeitemby_location/"+id+"/"+city, 
      async: true, 
      success: function(data) { 
      //alert(data);
      $("#ajax").html(data.trim()); 
      } 
    });
 }
  });         </script>
     
