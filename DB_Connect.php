<?php 

	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = 'root';
	$db_name = 'student_management_system';

	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

	if (!$connection) {
		
		echo "Not Connected";

	}
 ?>