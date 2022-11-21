<?php 

	ob_start();

	require 'DB_Connect.php';

	if (isset($_POST['student_document_delete'])) {
		
		$student_id = $_POST['student_id'];

		$sql = " UPDATE table_students SET 

										student_document = '' 

									WHERE student_id = $student_id ";

		$result = mysqli_query($connection, $sql);

		if ($result) {

			ob_end_clean();

			header("Location:Students.php");

		}

	}

 ?>