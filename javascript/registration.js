//Function to send post request to .php file
function register(email, uname, pass1, pass2){

	$.post(
	
	"../assets/php/registration.php", //php file
	
	//create objects with values
	{newemail: email, newusername: uname, newpass: pass1, newpassconfirm: pass2},
	
	//function called when server returns data
	registerCallback,
	
	//How to format the data when it is returned
	"json"
	);
}

//Function to set the error based on php result
 function registerCallback(res){
 	var response = res.returnvalue;
 	var username_resp = res.username_analysis;
 	var email_resp = res.email_analysis;
 	var password_resp = res.password_analysis;
 	var confirm_resp = res.confirm_analysis;
 	if(username_resp == "Empty username"){
		$("#register_username_control").addClass("error");
		$("#register_username_help").html("Please enter a username");	
 	}
 	else{
 		$("#register_username_control").removeClass("error");
		$("#register_username_help").html("");	
 	}

 	if(email_resp == "Invalid email"){
 		$("#register_email_control").addClass("error");
		$("#register_email_help").html("Please enter a valid email address");	
 	}
 	else{
 		$("#register_email_control").removeClass("error");
		$("#register_email_help").html("");	
 	}

 	if(password_resp == "Empty password"){
 		$("#register_password_control").addClass("error");
		$("#register_password_help").html("Password empty");
		$("#register_passwordconfirm_control").addClass("error");
		$("#register_passwordconfirm_help").html("Password confirmation empty");
 	}
 	else if(confirm_resp == "Password mismatch"){
 		$("#register_password_control").addClass("error");
		$("#register_passwordconfirm_control").addClass("error");
		$("#register_password_help").html("Passwords do not match");
		$("#register_passwordconfirm_help").html("Passwords do not match");
 	}
 	else{
 		$("#register_password_control").removeClass("error");
		$("#register_password_help").html("");
		$("#register_passwordconfirm_control").removeClass("error");
		$("#register_passwordconfirm_help").html("");
 	}
}

$(document).ready(function () {
	
	//Register submit button click function
	//Submitting the registration data using ajax
	$("#register-button").click(function() {
		var email = $("#register_email").val();
		var username = $("#register_username").val();
		var password = $("#register_password").val();
		var passwordConfirm = $("#register_passwordConfirm").val();
		var errMsg = ""; //error feedback to user
	
		
		//Proceed only if there are no errors
		if(errMsg == ""){
			//alert("no errors");
			register(email, username, password, passwordConfirm);
		}
	});
});