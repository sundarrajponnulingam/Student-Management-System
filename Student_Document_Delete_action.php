<?php 

	ob_start();

	require 'DB_Connect.php';
		
		$student_id = $_GET['student_id'];

		$sql = " UPDATE table_students SET 

										student_document = '' 

									WHERE student_id = $student_id ";

		$result = mysqli_query($connection, $sql);

		if ($result) {

			return true;
			
		}

 ?>