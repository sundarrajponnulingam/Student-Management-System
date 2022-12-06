<?php 

	ob_start();

	require 'DB_Connect.php';

	if (isset($_POST['student_add'])) {
		
		$student_name = trim($_POST['student_name']);
		$student_class = trim($_POST['student_class']);
		$student_section = trim($_POST['student_section']);
		$student_date_of_birth = trim($_POST['student_date_of_birth']);
		$student_father_name = trim($_POST['student_father_name']);
		$student_mother_name = trim($_POST['student_mother_name']);
		$student_address = trim($_POST['student_address']);
		$student_fees_status = $_POST['student_fees_status']; 
		$student_document = isset($_FILES['student_document']) ? $_FILES['student_document']['name'] : NULL;

		if (isset($student_document) && !empty($student_document)) {
			
			$temp_student_document = explode(".", $student_document);
			
			$student_document = str_replace("'", "", current($temp_student_document)).round(microtime(true)).'.'.end($temp_student_document);
			
			$file_path = "documents/".$student_document;
			move_uploaded_file($_FILES['student_document']['tmp_name'], $file_path);

		}

		$page_url = $_POST['page_url'];

		$sql = "INSERT INTO table_students (

												student_name,
			 									student_class, 
			 									student_section, 	
			 									student_date_of_birth, 
			 									student_father_name, 
			 									student_mother_name,
			 									student_address, 
			 									student_fees_status,
			 									student_document			

			 								) 

											VALUES 

											(

												'$student_name',
												'$student_class',
												'$student_section',
												'$student_date_of_birth',
												'$student_father_name',
												'$student_mother_name',
												'$student_address', 
												'$student_fees_status',
												'$student_document'

											)";

		$result = mysqli_query($connection, $sql);

		if ($result) {

			$sql = "SELECT student_id FROM table_students ORDER BY student_id DESC LIMIT 1";

			$result = mysqli_query($connection, $sql);

			if ($result) {

				$data = mysqli_fetch_assoc($result);

				$student_id = $data['student_id'];

				$sql = "SELECT COUNT(parents_guardian_id),parents_guardian_id 
							FROM table_parents 

							WHERE parents_father_name = '$student_father_name' 

							AND parents_mother_name = '$student_mother_name'";

				$result = mysqli_query($connection, $sql);
				
				if ($result) {
					
					$data = mysqli_fetch_assoc($result);

					$count = $data['COUNT(parents_guardian_id)'];
					$parents_guardian_id = $data['parents_guardian_id'];

					if ($count > 0) {

						$sql = "SELECT parents_students_id, parents_students_name FROM 		table_parents

								WHERE parents_guardian_id = '$parents_guardian_id'";

						$result = mysqli_query($connection, $sql);

						if ($result) {

							$data = mysqli_fetch_assoc($result);
							
							$parents_students_ids = $data['parents_students_id'];
							$parents_students_names = $data['parents_students_name'];

							$sql = "UPDATE table_parents SET 
															parents_students_id = CONCAT_WS(', ', '$parents_students_ids', '$student_id'),
															parents_students_name = CONCAT_WS(', ', '$parents_students_names', '$student_name'),

															parents_address = '$student_address'

														WHERE parents_guardian_id = '$parents_guardian_id'";
														
							$result = mysqli_query($connection, $sql);

							if ($result) {

								$sql = "UPDATE table_students SET 
																student_guardian_id = '$parents_guardian_id'
															WHERE student_id = '$student_id'";

								$result = mysqli_query($connection, $sql);

								if ($result) {

									$parents_students_ids = explode(",", $parents_students_ids);

									foreach ($parents_students_ids as $parents_students_id) {
										
										$sql = "UPDATE table_students SET 
																		student_address = '$student_address'

																	WHERE student_id = $parents_students_id ";

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
					else{

						$sql = "INSERT INTO table_parents (
																
																parents_father_name,
							 									parents_mother_name, 
							 									parents_address, 	
							 									parents_students_id, 
							 									parents_students_name

							 								) 

															VALUES 

															(

																'$student_father_name',
																'$student_mother_name',
																'$student_address', 
																'$student_id',
																'$student_name'

															)";

						$result = mysqli_query($connection, $sql);

						if ($result) {

							$sql = "SELECT parents_guardian_id FROM table_parents ORDER BY parents_guardian_id DESC LIMIT 1";

							$result = mysqli_query($connection, $sql);
							
							if ($result) {

								$data = mysqli_fetch_assoc($result);

								$student_guardian_id = $data['parents_guardian_id'];

								$sql = "UPDATE table_students SET 
																student_guardian_id = '$student_guardian_id'
															WHERE student_id = '$student_id'";

								$result = mysqli_query($connection, $sql);                                 
								if ($result) {
									
									ob_end_clean();

									header("Location:".$page_url);

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