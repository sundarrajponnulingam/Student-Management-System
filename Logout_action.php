<?php 

	ob_start();
	session_start();

	$logout = session_destroy();

	if ($logout) {
		
		ob_end_clean();
		header("Location: Login.php");
		exit();

	}

 ?>