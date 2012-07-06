<?php //Associated with homepage.html registration
$host="localhost"; // Host name 
$dbusername="root"; // Mysql username 
$sqlpass="bosporus";
$encrypt_password=""; //Encrypted password
$db_name="debtapp"; // Database name 
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
$username = mysql_real_escape_string($username);

// Connect to the database
$conn = mysql_connect("$host", "$dbusername", "$sqlpass")or die("cannot connect"); 
 mysql_select_db("$db_name")or die("cannot select DB");

//check for duplicate username
$query = "SELECT `username` FROM $tbl_name WHERE `username`='$username'";
$result = mysql_query($query);
$rows = mysql_num_rows($result);
if($rows > 0)
{
	echo json_encode(array("returnvalue"=>"Username already exists."));
}
else //it's ok to add it because it's unique
{
	$query = "INSERT INTO $tbl_name ( email, username, password, salt )
			VALUES ( '$email', '$username' , '$hash' , '$salt' );";
	mysql_query($query) or die ("error here");
	
	
	echo json_encode(array("returnvalue"=>""));

}


//header('Location: login.html');


// To protect MySQL injection (more detail about MySQL injection)
// $myusername = stripslashes($myusername);
// $mypassword = stripslashes($mypassword);
// $myusername = mysql_real_escape_string($myusername);
// $mypassword = mysql_real_escape_string($mypassword);

?>