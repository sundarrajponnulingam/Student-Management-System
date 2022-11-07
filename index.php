<?php 

	session_start();

	if (!empty($_SESSION)) {
		
		header("Location: Dashboard.php");

	}
	else{

		ob_end_clean();
		header("Location: Login.php");
		die();

	}

 ?>