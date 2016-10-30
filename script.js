$(document).ready(function(){
	/* Login start here*/
	$("#AdmlogBtn").click(function(){
		//alert('1');
		var username = $("#username").val();
		var password = $("#password").val();
		var x = location.href;
		var res = x.split("/");
		var res4=res[4];
		//alert(res4);
		if(username==""){
			$('#username').attr('placeholder', 'Please enter your username');
			$('#username').addClass('redmessage');
			return false;
		}else{
			$('#username').removeClass('redmessage');
		} 
		
		
		if(password==""){
			$('#password').attr('placeholder', 'Please enter your password');
			$('#password').addClass('redmessage');
			return false;
		}else{
			$('#password').removeClass('redmessage');
		}
		
		if(username!="" && password!=""){
			//$("#wrong-credential").html("Working.");
			$("#AdmlogBtn").prop('disabled', true);
			var url = $("#base_url").val();
			$.ajax({
			  method: "POST",
			  url: url+"users/admin/doAdminLogin",
			  data: { username: username, password: password},
			  async: false,
			  success: function(data) {
				 // alert(data);
				var data1 =  data.split('-');
				if(data1[1]=='0'){
					$("#AdmlogBtn").prop('disabled', false);
					$("#wrong-credential").html("Your given credential is wrong.");
					
				}else if(data1[1]=="ut3"){
					
					$("#AdmlogBtn").prop('disabled', false);
					$("#wrong-credential").html("You are not allowed to login from this panel");
					//$("#wrong-credential").html("Success.");
					//window.location.href = url+"client/client_dashBoard";
				}
				else if(data1[1]=="ut4"){
					$("#AdmlogBtn").prop('disabled', false);
					$("#wrong-credential").html("You are not allowed to login from this panel");
					//$("#wrong-credential").html("Success.");
					//window.location.href = url+"vendor/vendor_dashBoard";
				}
				else if(data1[1]=="ut11"){
					$("#AdmlogBtn").prop('disabled', false);
					$("#wrong-credential").html("You are not allowed to login from this panel");
					//$("#wrong-credential").html("Success.");
					//window.location.href = url+"vendor/vendor_dashBoard";
				}
				else if(data1[1]=="ut1" && res4=='admin' ){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"users/admin/dashBoard";
				}
				else if(data1[1]=="ut5" && res4=='receptionist'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"receptionist/dashBoard";
				}
				else if(data1[1]=="ut6" && res4=='istuser'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"ituser/dashBoard";
				}
				else if(data1[1]=="ut7" && res4=='manager'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"manager/dashBoard";
				}
				else if(data1[1]=="ut8" && res4=='concierge' ){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"concierge/dashBoard";
				}
				else if(data1[1]=="ut9" && res4=='pantry'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"pantry/dashBoard";
					
				}else if(data1[1]=="ut2" && res4=='owner'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"owner/analytics";
				}
				else if(data1[1]=="ut10" && res4=='areadirector'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"areadirector/center_dashBoard";
				}
				else if(data1[1]=="ut12" && res4=='istuser'){
					
					$("#wrong-credential").html("Success.");
					window.location.href = url+"istuser/dashBoard";
				}else{
					$("#AdmlogBtn").prop('disabled', false);
					$("#wrong-credential").html("You are not allowed to login from this panel");
				}
				
			  }
			});
		}
	});

	/* Login end here*/
	
	
	/* Forgot password start here */
	
	$("#forgetPassBtn").click(function(){
		var email = $("#email").val();
    	var validRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    	var flg=0;
    
    	if(email.search(/\S/) == -1){
			$('#email').val('');
			$('#email').attr('placeholder', 'Please enter E-mail');
			$('#email').addClass('redmessage');
			return false;
		}else if(email.search(validRegex) == -1){
			$('#email').val('');
			$('#email').attr('placeholder', 'Enter valid E-mail');
			$('#email').addClass('redmessage');
			return false;
		}else{
			alert("forgot pass");
		}	
	});
	
	/* Forgot password end here*/
});

function removeValidationColor(field_id){
	$('#'+field_id).removeClass('redmessage');
}
