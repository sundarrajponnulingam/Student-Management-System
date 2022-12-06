<?php 

	ob_start();

	require 'DB_Connect.php';
		
		$student_id = $_GET['student_id'];

		$sql = " SELECT student_document FROM table_students 

										WHERE student_id = $student_id ";

		$result = mysqli_query($connection, $sql);

		if ($result) {
			
			$data = mysqli_fetch_assoc($result);

			$student_document = $data['student_document'];

			$sql = " UPDATE table_students SET 

											student_document = '' 

										WHERE student_id = $student_id ";

			$result = mysqli_query($connection, $sql);

			if ($result) {

				$delete_student_document = unlink("./documents/".$student_document);

				if ($delete_student_document) {

					return true;

				}
				
			}

		}

	mysqli_close($connection);

 ?>