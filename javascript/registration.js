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
	alert(response);
// 	if(response == "")
// 	{
// 		disablePopup();
// 		//Empty out the registration fields
// 		$("#register-name").val("");
// 		$("#register-pass").val("");
// 		$("#register-passconfirm").val("");
// 	}
}

$(document).ready(function () {
	
	//Register submit button click function
	//Submitting the registration data using ajax
	$("#register-button").click(function() {
		alert("clicked the register button");
		var email = $("#register_email").val();
		var username = $("#register_username").val();
		var password = $("#register_password").val();
		var passwordConfirm = $("#register_passwordConfirm").val();
		var errMsg = ""; //error feedback to user
		
		//Check for empty fields and basic errors
		if(!username){
			errMsg += "\nUsername empty.\n";
		}
		if(!password || !passwordConfirm){
			errMsg += "Password empty.";
		}
		if(password != passwordConfirm){
			errMsg += "Password mismatch.";
		}
		//$("#register-error").html(errMsg);
		
		//Proceed only if there are no errors
		if(errMsg == ""){
			alert("no errors");
			register(email, username, password, passwordConfirm);
		}
	});
});