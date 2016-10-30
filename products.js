function setShippingCostVal(id,val)
{
	
		$("#shippingCost"+id).hide();
		$("#shippingCostLoad"+id).show();
		//alert(val);
		$.ajaxSetup ({cache: false});
		var loadUrl = js_site_url+"products/admin/setShippingCost/"+id+"/"+val;
		//var formdata = $("#addCoursesFrm").serialize();
		$.ajax({
			type: "POST",
			url: loadUrl,
			dataType:"html",
			//data:formdata,
			success:function(responseText)
			{
				$("#shippingCostLoad"+id).hide();
				$("#shippingCost"+id).show();
				//document.getElementById('statusId'+id).innerHTML=responseText;
	
			},
		   error: function(jqXHR, exception) {
				return false;
		 }
		});
		return false;
	
}


function ProAdd()
{
	var productName = $("#productName").val();     
   var flag = 0;
   
   if(productName.search(/\S/) == -1){
		$('#productName').val('');
		$('#productName').attr('placeholder', 'Enter Product Name.');
		$('#productName').addClass('redmessage');
		//$( "#userEmail" ).focus();
      flag=1;
	}
	
	if(flag==1){
        return false;  
  	}
  	else 
  	{
  		//alert('HI..');
  		$('#addProductFrm').submit();
  	}
}

function changeProductStatus(id,val)
{
	var confm=confirm("Are you sure?");
	if(confm==true)
	{
	//alert(val);
	$.ajaxSetup ({cache: false});
	var loadUrl = js_site_url+"products/admin/statusChange/"+id+"/"+val;

	$.ajax({
		type: "POST",
		url: loadUrl,
		dataType:"html",
		//data:formdata,
		success:function(responseText)
		{

			document.getElementById('statusId'+id).innerHTML=responseText;

		},
	   error: function(jqXHR, exception) {
	   		return false;
	 }
	});
	return false;
	}
	else
	{
	return false;
	}

}

function deleteProductitem(id) 
{
	var confm=confirm("Are you sure?");
	if(confm==true)
	{
	//alert(id);
	$.ajaxSetup ({cache: false});
	var loadUrl = js_site_url+"products/admin/deleteProduct/"+id;
	//var formdata = $("#categoryListfrm").serialize();
   //var del_id= $(this).attr('id');

	$.ajax({
		type: "POST",
		url: loadUrl,
		dataType:"html",
		//data:formdata,
		success:function(responseText)
		{
		   // alert(id);
         $("#del"+id).remove();
         alert('Product deleted successfully');

		},
	   error: function(jqXHR, exception) {
	   		return false;
	 }
	});
	return false;
	}
	else
	{
		return false;
	}
}


$('.parentCat').each(function(){
         
       				if($(this).next('.subCat').is(':hidden')){
           			$(this).children().find('.pm_click').addClass('pm_show');
       				} 
    				});
    			
   $('.pm_click').click(function(){ 
        
        			obj= $(this).parents('.parentCat').nextUntil('.parentCat');
        			$('.subCat').slideUp();
        			$('.pm_click').children().removeClass('fa fa-minus').addClass('fa fa-plus');
        			if(obj.is(':hidden')){
        				$(this).children().removeClass('fa fa-plus').addClass('fa fa-minus');
       				obj.slideDown(); 
        			}else{
             		$(this).children().removeClass('fa fa-minus').addClass('fa fa-plus');
           			obj.slideUp(); 
        			}
    				});



function remove_related_product(obj)
{
	
	if(confirm('Are you sure?'))
	{
		var id = obj.getAttribute('data-value');
		//alert(three);
                /*//alert(ths);
                var id = $(ths).closest('tr').find('.rp_id').val();
                var httxt = $(ths).closest('tr').find('.prdtext').text();
                var htm = '<option value="'+id+'" id="product_item_'+id+'">'+httxt+'</option>';
                $('#product_list').append(htm);
                $(ths).closest('tr').remove();*/
		$('#related_product_'+id).remove();
		run_product_query();
	}
}

function remove_option(id)
{
    if(confirm('Are you sure?'))
    {
            $('#option-'+id).remove();
    }
}


function productTypeCheck(optionval){
	//alert(optionval);
	if(optionval==1){
	$('#quantity_tr').show();
	//$('#attr_tab').hide();
}else{
	$('#quantity_tr').hide();
	//$('#attr_tab').show();

}

}


function getattributes()
{
    //alert(js_site_url);
//alert('hello code');
 var catid = $("#catId1").val();
    var pid = $("#pId").val();
    //alert(catid);
        $.ajaxSetup ({cache: false});
	var loadUrl = js_site_url+"products/admin/attiributesList/"+catid
        //alert(loadUrl);
	//var formdata = $("#editAttribute").serialize();
	$.ajax({
		type: "POST",
		url: loadUrl,
		dataType:"html",
		//data:formdata,
		success:function(responseText)
		{
                    //alert(responseText);
                        document.getElementById('attrName').innerHTML=responseText;
                        

		},
	   error: function(jqXHR, exception) {
	   		return false;
	 }
	});

}