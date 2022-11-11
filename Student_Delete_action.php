<?php 

	ob_start();
	
	require 'DB_Connect.php';

	if (isset($_POST['student_delete'])) {
		
		$student_id = $_POST['student_id'];
		$student_guardian_id = $_POST['student_guardian_id'];

		$sql = " DELETE FROM table_students WHERE student_id = '$student_id' ";

		$result = mysqli_query($connection, $sql);

		if ($result) {
			
			$sql = "SELECT parents_students_id FROM table_parents 
					WHERE parents_guardian_id = '$student_guardian_id' ";

			$result = mysqli_query($connection, $sql);

			if ($result) {
				
				$data = mysqli_fetch_assoc($result);

				$student_ids = $data['parents_students_id'];
				$student_ids = explode(",", $student_ids);

				for ($i=0; $i < count($student_ids); $i++) { 
					
					if ($student_ids[$i] == $student_id) {
						
						$position = $i;

					}

				}

				$delete = array_splice($student_ids, $position, 1);

				if ($delete) {

					$parents_students_id = implode(',', $student_ids);;

					$sql = "UPDATE table_parents SET 
														parents_students_id = '$parents_students_id'
														
													WHERE parents_guardian_id = '$student_guardian_id' ";

					$result = mysqli_query($connection, $sql);

					if ($result) {
						
						$sql = "SELECT parents_students_name FROM table_parents
								WHERE parents_guardian_id = '$student_guardian_id' ";

						$result = mysqli_query($connection, $sql);

						if ($result) {

							$data = mysqli_fetch_assoc($result);

							$student_names = $data['parents_students_name'];
							$student_names = explode(",", $student_names);

							$delete = array_splice($student_names, $position, 1);

							if ($delete) {

								$parents_students_name = implode(',', $student_names);

								$sql = "UPDATE table_parents SET 
															parents_students_name = '$parents_students_name'
															
														WHERE parents_guardian_id = '$student_guardian_id' ";

								$result = mysqli_query($connection, $sql);

								if ($result) {
									
									ob_end_clean();

									header("Location:Students.php");

								}

							}

						}

					}

				}
				
			}

		}

		mysqli_close($connection);

	}

 ?>