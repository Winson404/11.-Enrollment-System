<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include '../config.php';
	
	$id = $_POST['id'];
	$login_time = $_POST['login_time'];
	$update = mysqli_query($conn, "UPDATE log_history SET logout_datetime=NOW() WHERE user_Id='$id' AND login_datetime='$login_time'");

	if ($update) {
	  echo "Logged out successfully!";
	} else {
	  echo "Error occurred while logging out!";
	}

?>




