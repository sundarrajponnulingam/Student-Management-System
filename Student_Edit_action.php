<?php 

	ob_start();

	require 'DB_Connect.php';

	if (isset($_POST['student_edit'])) {
	
		$student_id = $_POST['student_id'];
		$parent_id = $_POST['parent_id'];
		$student_name = trim($_POST['student_name']);
		$student_class = trim($_POST['student_class']);
		$student_section = strtoupper(trim($_POST['student_section']));
		$student_date_of_birth = trim($_POST['student_date_of_birth']);
		$student_father_name = trim($_POST['student_father_name']);
		$student_mother_name = trim($_POST['student_mother_name']);
		$student_address = trim($_POST['student_address']);
		$student_fees_status = $_POST['student_fees_status-'.$student_id];

		if (isset($_POST['student_document']) && !empty($_POST['student_document'])) {
			
			$student_document = $_POST['student_document'];

		}
		else{

			$student_document = isset($_FILES['student_document']) ? $_FILES['student_document']['name'] : NULL;
			
			if (isset($student_document) && !empty($student_document)) {
				
				$temp_student_document = explode(".", $student_document);
				
				$student_document = str_replace("'", "", current($temp_student_document)).round(microtime(true)).'.'.end($temp_student_document);
				
				$file_path = "documents/".$student_document;
				move_uploaded_file($_FILES['student_document']['tmp_name'], $file_path);

			}

		}

		$page_url = $_POST['page_url'];

		$sql = " UPDATE table_students SET 
											student_name = '$student_name',
		 									student_class = '$student_class', 
		 									student_section = '$student_section', 	
		 									student_date_of_birth ='$student_date_of_birth',
		 									student_father_name = '$student_father_name', 
		 									student_mother_name = '$student_mother_name', 
		 									student_address = '$student_address',
		 									student_fees_status = '$student_fees_status',
		 									student_document = '$student_document'			

										WHERE student_id = $student_id ";

		$result = mysqli_query($connection, $sql);

		if ($result) {

			$sql = "SELECT parents_students_id FROM table_parents 
					WHERE parents_guardian_id = '$parent_id' ";

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

				$sql = "SELECT parents_students_name FROM table_parents
						WHERE parents_guardian_id = '$parent_id' ";

				$result = mysqli_query($connection, $sql);

				if ($result) {

					$data = mysqli_fetch_assoc($result);

					$student_names = $data['parents_students_name'];
					$student_names = explode(",", $student_names);

					$student_name = array(

						$position => $student_name

					); 

					$update = array_splice($student_names, $position, 1, $student_name);

					if ($update) {
						
						$student_name = implode(', ', $student_names);
						
						$sql = "UPDATE table_parents SET 

														parents_students_name = '$student_name',
														parents_address = '$student_address',
														parents_father_name = '$student_father_name',
														parents_mother_name = '$student_mother_name'
														
													WHERE parents_guardian_id = '$parent_id' ";

						$result = mysqli_query($connection, $sql);

						if ($result) {

							foreach ($student_ids as $student_id) {
								
								$sql = "UPDATE table_students SET 

																student_address = '$student_address',
																student_father_name = '$student_father_name',
																student_mother_name = '$student_mother_name'

															WHERE student_id = $student_id ";

								$result = mysqli_query($connection, $sql);

							}

							if ($result) {
									
								ob_end_clean();

								header("Location:".$page_url);

							}						

						}

					}
						
				}

			}

		}	

	mysqli_close($connection);

	}

 ?>