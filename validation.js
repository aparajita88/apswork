function imagevalidation(){
	
	var ListeeTypeImage = $("#ListeeTypeImage").val();
	var ext = $('#ListeeTypeImage').val().split('.').pop().toLowerCase();
	if(ListeeTypeImage==''){
		
		
		$('#ListeeTypeImage').addClass('redmessage');
		ListeeTypeImage.focus();
		
		
		return false;
	}
	//else if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
    ////alert('invalid extension!');
   //$('#msg').css('display','block');
   //$('#msg').addClass('redmessage');
   //$('#msg').html("Invalid Extension");
    	//setTimeout(function() {
  //$("#msg").remove();
//}, 6000);
    //return false;
     //}
	
	
	else{
		$('#ListeeTypeImage').removeClass('redmessage');
		return true;
	}
}

function CheckForm(){
	var checked=false;
	var elements = document.getElementsByName("chkbox[]");
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		 $('#chkvalidate').css('display','block');
		 $('#chkvalidate').css('color','red');
		 $('#chkvalidate').html("Please check.");
		return false;
	}else{
	$('#chkvalidate').removeClass('redmessage');
	return true;
}
}





function classifiedsNameValidation(){
	
	var classifieds_name = $("#classifieds_name").val();
	if(classifieds_name==''){
		//$('#classifieds_name').val('');
		$('#classifieds_name').attr('value','Enter name');
		$('#classifieds_name').addClass('redmessage');
		return false;
	}else{
		$('#classifieds_name').removeClass('redmessage');
		return true;
	}
}
function businessValidation()
{
    var business = $("#business").val();
    if (business==0) {
        alert('please choose your business.');
        
        $('#business').addClass('redmessage');
        return false;
    }else{
        $('#business').removeClass('redmessage');
        return true;
    }
}

function analytics_category(){
var cat = $("#cat").val();
    if (cat=='') {
        alert('please choose your category.');
        
        $('#cat').addClass('redmessage');
        return false;
    }else{
        $('#cat').removeClass('redmessage');
        return true;
    }	
}
function analytics_subcategory(){
var sub = $("#sub").val();
    if (sub=='') {
        alert('please choose your sub category.');
        
        $('#sub').addClass('redmessage');
        return false;
    }else{
        $('#sub').removeClass('redmessage');
        return true;
    }	
}
function analytics_name(){
var analytics = $("#analytics").val();
    if (analytics=='') {
        alert('please choose your analytics.');
        
        $('#analytics').addClass('redmessage');
        return false;
    }else{
        $('#analytics').removeClass('redmessage');
        return true;
    }	
}


function classifiedsAddressValidation(){
	
	var address_name = $("#autocomplete").val();
	
	if(address_name==''){
		
		$('#autocomplete').attr('value', 'Enter');
		$('#autocomplete').addClass('redmessage');
		return false;
	}else{
		$('#autocomplete').removeClass('redmessage');
		return true;
	}
}
function NumberValidation(){
var number = $("#time_slot").val();	
	if(number!=''){
 if (isNaN(number)) {
       $('#time_slot').attr('value', 'time slot should be a number .');
       $('#time_slot').addClass('redmessage');
       return false;
    } else {
		$('#time_slot').removeClass('redmessage');
        return true;
    }	
}else{
 $('#time_slot').attr('value', 'Enter time slot .');
   $('#time_slot').addClass('redmessage');
       return false;	
}
}
function selectclient(){
var client = $("#client").val();
	if(client=='0'){
		//$('#city').val('');
		alert('please choose client.');
		//$('#error').css('display','block');
		//$('#error').addClass('redmessage');
		//$('#error').html('Choose city.');
		$('#client').addClass('redmessage');
		return false;
	}else{
		$('#client').removeClass('redmessage');
		return true;
	}	
}
function firstNameValidation(){
	var first_name = $("#first_name").val();
	if(first_name==''){
		//$('#first_name').val('');
		$('#first_name').attr('placeholder', 'Enter first name.');
		$('#first_name').addClass('redmessage');
		return false;
	}else{
		$('#first_name').removeClass('redmessage');
		return true;
	}
}

function lastNameValidation(){
	var last_name = $("#last_name").val();
	if(last_name==''){
		//$('#last_name').val('');
		$('#last_name').attr('placeholder', 'Enter last name.');
		$('#last_name').addClass('redmessage');
		return false;
	}else{
		$('#last_name').removeClass('redmessage');
		return true;
	}
}

function emailValidation(){
	var email = $("#email").val();
	if(email!=''){
	var validRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	//if(email.search(/\S/) == -1){
		//$('#email').val('');
		//$('#email').attr('placeholder', 'Please enter E-mail');
		//$('#email').addClass('redmessage');
		//return false;
	//}else
	 if(email.search(validRegex) == -1){
		$('#email').val('');
		$('#email').attr('placeholder', 'Enter valid E-mail');
		$('#email').addClass('redmessage');
		return false;
	}else{
	return true	;	
	}
}
	//}else{
		//return isemailAvailable(email, "1");
	//}
else{
$('#email').val('');
$('#email').attr('placeholder', 'Enter  E-mail');
$('#email').addClass('redmessage');
return false;
}

}
 function phonenumber()  
{
	
  var phone1 = $("#phone").val();
  var phoneno = /^\d{10}$/;  
if(phone1!=''){
 
	  if(phone1.match(phoneno)){
	  $('#phone').removeClass('redmessage'); 
      return true;  
  
} 
  else  
  {  
        $('#phone').val('');
		$('#phone').attr('placeholder', 'Enter valid phone number.');
		$('#phone').addClass('redmessage');
		return false;
     
  }  
  } else{
	  
	return true;  
  }
}
function isemailAvailable(email, edit){ // if argument "edit==1" then its calling from profile edit from else new parofile ceate
	var url = $("#base_url").val();
	var status;
	$.ajax({
		  method: "POST",
		  url: url+"index.php/users/admin/isEmailAvailable",
		  data: {email:email, isEdit:edit} ,
		  async: false,
		  success: function(data) {
			data = data.trim();
			status = data;
		  }
	});
	return status;
}

function isNumber(evt) {
	
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    alert(charCode);
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

function phoneNumberValidation(){
	var phone = $("#phone").val();
	if(phone==''){
		$('#phone').val('');
		$('#phone').attr('placeholder', 'Enter phone number.');
		$('#phone').addClass('redmessage');
		return false;
	}else{
		$('#phone').removeClass('redmessage');
		return true;
	}
}

function addressValidation(){
	var address = $("#address").val();
	if(address==''){
		$('#address').val('');
		$('#address').attr('placeholder', 'Enter your address.');
		$('#address').addClass('redmessage');
		return false;
	}else{
		$('#address').removeClass('redmessage');
		return true;
	}
}
function vendorName(){
var vendor_name = $("#vendor_name").val();
	if(vendor_name=='0'){
		alert('please choose any vendor name.');
		$('#vendor_name').addClass('redmessage');
		return false;
	}else{
		$('#vendor_name').removeClass('redmessage');
		return true;
	}

}
function cityValidation(){
	
	var city = $("#city").val();
	if(city=='0'){
		//$('#city').val('');
		alert('please choose any city.');
		//$('#error').css('display','block');
		//$('#error').addClass('redmessage');
		//$('#error').html('Choose city.');
		$('#city').addClass('redmessage');
		return false;
	}else{
		$('#city').removeClass('redmessage');
		return true;
	}
}
function clientvalidation(){
	var client;
	if($("#client_id").val()!='undefined'){
		client = $("#client_id").val();
	}
	else{
		client=1;
	}
	if(client=='0'){
		//$('#city').val('');
		alert('please choose any client.');
		//$('#error').css('display','block');
		//$('#error').addClass('redmessage');
		//$('#error').html('Choose city.');
		$("#client_id").addClass('redmessage');
		return false;
	}else{
		$("#client_id").removeClass('redmessage');
		return true;
	}
}
function locationValidation(){
	
var location = $("#location").val();
	if(location=='0'){
		
		alert('please choose any Location.');
		
		$('#location').addClass('redmessage');
		return false;
	}else{
		$('#location').removeClass('redmessage');
		return true;
	}	
	
}
function stafftypevalidation(){
var staff_type = $("#staff_type").val();
	if(staff_type=='0'){
		
		alert('please choose Staff type.');
		
		$('#staff_type').addClass('redmessage');
		return false;
	}else{
		$('#staff_type').removeClass('redmessage');
		return true;
	}		
	
}
function courierValidation(){
	
var courier_type = $("#courier_type").val();
//alert(courier_type);
	if(courier_type=='0'){
		
		alert('please choose any courier type.');
		
		$('#courier_type').addClass('redmessage');
		return false;
	}else{
		$('#courier_type').removeClass('redmessage');
		return true;
	}	
	
}
function modevalidation(){
	
var delivery_type = $("#delivery_type").val();
//alert(courier_type);
	if(delivery_type=='0'){
		
		alert('please choose any delivery type.');
		
		$('#delivery_type').addClass('redmessage');
		return false;
	}else{
		$('#delivery_type').removeClass('redmessage');
		return true;
	}	
	
}
function timeValidation(){
	
var start_time = $("#start_time").val();

var end_time = $('#end_time').val();
if(start_time != '' && end_time != ''){
    if(parseInt(start_time.split(':')[0]) > parseInt(end_time.split(':')[0])){
        $('#timavalidate').css('display','block');
		$('#timavalidate').css('color','red');
		$('#timavalidate').html("Start time should be less than end time");
        $('#end_time').val('');
        $('#end_time').addClass('redmessage');
        return false;
    }else{
		$("#timavalidate").remove();	
		return true;
	}
}else{
$('#start_time').attr('placeholder','Enter start time');
$('#start_time').addClass('redmessage');
$('#end_time').attr('placeholder','Enter end time');
$('#end_time').addClass('redmessage');
return false;	
}
	
}
function dateValidation(){
	//alert('1');
var start = $("#start").val();
var end = $('#end').val(); 

       if(start!='' && end!='' ){
       return true;
           
		}else{
		$('#start').attr('placeholder','start Date');
		$('#start').addClass('redmessage');
		$('#end').attr('placeholder','end Date');
		$('#end').addClass('redmessage');
		return false;	
		}
	
}
function stateValidation(){
	var state = $("#state").val();
	if(state==''){
		$('#state').val('');
		$('#state').attr('placeholder', 'Enter your state.');
		$('#state').addClass('redmessage');
		return false;
	}else{
		$('#state').removeClass('redmessage');
		return true;
	}
}

function countryValidation(){
	var country = $("#country").val();
	if(country==''){
		$('#country').val('');
		$('#country').attr('placeholder', 'Enter your state.');
		$('#country').addClass('redmessage');
		return false;
	}else{
		$('#country').removeClass('redmessage');
		return true;
	}
}

function post_codeValidation(){
	var post_code = $("#post_code").val();
	if(post_code==''){
		$('#post_code').val('');
		$('#post_code').attr('placeholder', 'Enter your Post/Zip code.');
		$('#post_code').addClass('redmessage');
		return false;
	}else{
		$('#post_code').removeClass('redmessage');
		return true;
	}
}

function passwordValidation(){
	var password = $("#password").val();
	if(password==''){
		$('#password').val('');
		$('#password').attr('placeholder', 'Enter your password.');
		$('#password').addClass('redmessage');
		return false;
	}else{
		$('#password').removeClass('redmessage');
		return true;
	}
}

function confirmPasswordValiadtion(){
	var password = $("#password").val();
	var password1 = $("#password1").val();
	if(password1==''){
		$('#password1').val('');
		$('#password1').attr('placeholder', 'Re-enter your password.');
		$('#password1').addClass('redmessage');
		return false;
	}else if(password!=password1){
		$('#password1').val('');
		$('#password1').attr('placeholder', 'Your confirm password did not match.');
		$('#password1').addClass('redmessage');
		return false;
	}else{
		$('#password1').removeClass('redmessage');
		return true;
	}
}

function validatePassword(){
	var password = $("#password").val();
	var password1 = $("#password1").val();
	if(password!=""){
		return confirmPasswordValiadtion();
	}else{
		return true;
	}
}

function removeValidateHtml(field_id){
	
	$('#'+field_id).removeClass('redmessage');
	$('#'+field_id).focus();
}
function addValidateHtml(name,message){
	
	if(name!=""){
		return true;
	}else{
		$('input').attr('placeholder',message);
		$('input').css("border-color","red");
		$('input').focus();
		return false;
	}
}
function textboxvalidation(field_id){
	//alert(field_id);
	var name=$('#'+field_id).val();
	//alert(name);
	if(name!="" && !isNaN(name) ){
		return true;
	}else{
		$('#'+field_id).attr('placeholder','Please enter items quantity');
		$('#'+field_id).css("border-color","red");
		$('#'+field_id).focus();
		return false;
	}
}
function textboxvalidationforbooking(field_id){
	//alert(field_id);
	var name=$('#'+field_id).val();
	//alert(name);
	if(name!="" && !isNaN(name) ){
		return true;
	}else{
		$('#'+field_id).attr('placeholder','Please enter no of lockers');
		$('#'+field_id).css("border-color","red");
		$('#'+field_id).focus();
		return false;
	}
}
function cafe_category(){
	var _cat = $("#cafe_id").val();
 if(_cat=="0"){
				$("#cafe_id").attr('placeholder','Please choose cafe items');
				$("#cafe_id").css("border-color","red");
				$("#cafe_id").focus();
				return false;
				
				}else{
					
				return true;
				}
			}
