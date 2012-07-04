<?php //Associated with homepage.html registration
$registerArray = $_POST['user'];
foreach($registerArray as $key => $value){
	print "$key == $value";
}
?>