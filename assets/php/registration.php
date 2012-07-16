<?php //Associated with homepage.html registration

// include db access variables
include 'utilities/config.php';
include 'utilities/MySQL.php';

// Connect to the database
$sql = new MySQL();

$encrypt_password=""; //Encrypted password

$tbl_name="users"; // Table name

// Get the values from the registration form.
if(isset($_POST['newemail']))
	$email = $_POST['newemail'];
else
	$email = "";

if(isset($_POST['newusername']))
	$username = $_POST['newusername'];
else
	$username = "";

if(isset($_POST['newpass']))
	$password = $_POST['newpass'];
else
	$password = "";

if(isset($_POST['newpassconfirm']))
	$passwordConfirm = $_POST['newpassconfirm'];
else
	$passwordConfirm = "";

//creates a 3 character sequence and hashes the password
function createSalt()
{
    $string = md5(uniqid(rand(), true));
    return substr($string, 0, 3);
}
$hash = hash('sha256', $password);
$salt = createSalt();
$hash = hash('sha256', $salt . $hash);

//sanitize username
//$username = mysql_real_escape_string($username);

// If any of the below errors occurs, set dieFlag to 1 and die()
$dieFlag = 0;
$errArr = Array();
// Analyze the fields to make sure the data is valid. Otherwise, send back the error.
// Empty username
if($username == ""){
	$errArr['username_analysis'] = "Empty username";
	$dieFlag = 1;
}
// Check if the email is valid.
$emailPattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
if(!preg_match($emailPattern, $email)){
	$errArr['email_analysis'] = "Invalid email";
	$dieFlag = 1;
}

// Check if password exists
if($password == "" || $passwordConfirm == ""){
	$errArr['password_analysis'] = "Empty password";
	$dieFlag = 1;
}

if(($password != $passwordConfirm) && ($password != "") && ($passwordConfirm != "")){
	$errArr['confirm_analysis'] = "Password mismatch";
	$dieFlag = 1;
}

// Check if need to die
if($dieFlag == 1){
	echo json_encode($errArr);
	die();
}

// Connect to the database
//$conn = mysql_connect("$MYSQL_HOST", "$MYSQL_USER", "$MYSQL_PASS")or die("cannot connect"); 
//mysql_select_db("$MYSQL_NAME")or die("cannot select DB");

//check for duplicate username
$query = "SELECT `username` FROM $tbl_name WHERE `username`='$username'";
//$result = mysql_query($query);
$result = $sql->executeSQL($query);
$rows = mysql_num_rows($result);
if($rows > 0)
{
	echo json_encode(array("returnvalue"=>"Username already exists."));
	
}
else //it's ok to add it because it's unique
{

	// Insert it into the database.
	$query = "INSERT INTO $tbl_name ( email, username, password, salt )
		VALUES ( '$email', '$username' , '$hash' , '$salt' );";
	//mysql_query($query) or die ("error here");
	$sql->executeSQL($query);
	echo json_encode(array("returnvalue"=>""));

}

//header('Location: login.html');


// To protect MySQL injection (more detail about MySQL injection)
// $myusername = stripslashes($myusername);
// $mypassword = stripslashes($mypassword);
// $myusername = mysql_real_escape_string($myusername);
// $mypassword = mysql_real_escape_string($mypassword);

?>