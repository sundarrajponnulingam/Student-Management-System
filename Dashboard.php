<?php 

	ob_start();
	session_start();

	$page_variable = 'Dashboard';
	
	require 'Header.php';
	require 'Footer.php';

	if (!empty($_SESSION)) {

		$sql = " SELECT count(student_id) as student_count, 
				(SELECT count(student_id) FROM table_students WHERE student_fees_status = 1) 
				as paid_students, 
				(SELECT count(student_id) FROM table_students WHERE student_fees_status = 0) 
				as not_paid_students 
				FROM table_students";

		$result = mysqli_query($connection, $sql);

		$data = mysqli_fetch_assoc($result);

		if (isset($_REQUEST['search_text']) && !empty($_REQUEST['search_text'])) {
			
			$search_text = $_REQUEST['search_text'];
			
			$where = " WHERE student_id LIKE '%$search_text%' 
					OR student_name LIKE '%$search_text%' 
					OR student_class LIKE '%$search_text%' 
					OR student_section LIKE '%$search_text%' 
					OR student_date_of_birth LIKE '%$search_text%' 
					OR student_father_name LIKE '%$search_text%' 
					OR student_mother_name LIKE '%$search_text%' 
					OR student_guardian_id LIKE '%$search_text%' ";

			$sql = " SELECT student_id, student_name, student_class, student_section,student_fees_status FROM table_students $where ORDER BY student_id ";

			$result = mysqli_query($connection, $sql);

		}

 ?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<title>Dashboard</title>
	</head>

	<script type="text/javascript">
		
		$(document).ready(function(){

			$("#search").click(function(){

				var search_text = $("#search_text").val();

				$.ajax({

					type: 'POST',
					url: 'Dashboard.php',
					data: {

						search_text : search_text

					},
					success: function(response){

						$("#search_result").html(html).show();

					},
					failure: function(response){
						
					}

				});

			});

		});

	</script>

	<body>

	 	<div class="container mt-5 dashboard">
	 
			<div class="row">
				
				<div class="col-md-6">

						<a href="Students.php                                                                    " class="text-decoration-none">

							<div class="card h-100">
							
								<img src="./assets/icons/Students.svg" class="card-img-top mt-2" width="100" height="100">

								<div class="card-body">
									
									<h5 class="card-title">Students</h5>

									<p class="card-text mt-3">Total Number of Students <strong> <?php echo $data['student_count']; ?> </strong></p>
									
								</div>

							</div>

						</a>

				</div>

				<div class="col-md-6">

					<a href="Fees.php" class="text-decoration-none">
						
						<div class="card h-100">

							<img src="./assets/icons/Fees.svg" class="card-img-top mt-2" width="100" height="100">

							<div class="card-body">
								
								<h5 class="card-title">Fees</h5>

								<p class="card-text mt-3">Number of Students Paid <strong> <?php echo $data['paid_students']; ?> </strong></p>

								<p class="card-text">Number of Students Not Paid <strong> <?php echo $data['not_paid_students']; ?> </strong></p>

							</div>

						</div>				
					
					</a>	

				</div>

			</div>

			<div class="row mt-5">
				
				<form method="POST">
					
					<div class="d-flex justify-content-between">
					
						<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Here">

						<button type="submit" class="btn btn-light" id="search">

							<img src="./assets/icons/Search.svg" width="30" height="30">
							
						</button>

					</div>  

				</form>

			</div>

			<div class="container mt-5" id="search_result" <?php echo (isset($_REQUEST['search_text']) && !empty($_REQUEST['search_text'])) ? '' : 'style="display: none;"' ?>>
			
				<table class="table table-bordered table-hover text-center">

					<thead>
						
						<tr>
							
							<th scope="col">Id</th>
							<th scope="col">Name</th>
							<th scope="col">Class</th>
							<th scope="col">Section</th>
							<th scope="col">Fees</th>
							<th scope="col">Action</th>

						</tr>

					</thead>

					<tbody>
						
						<?php 

						while ($data = mysqli_fetch_assoc($result)) {
						
						?>

						<tr>

							<th scope="row"><?php echo $data['student_id']; ?></th>
							<td><?php echo $data['student_name']; ?></td>
							<td><?php echo $data['student_class']; ?></td>
							<td><?php echo $data['student_section']; ?></td>
							<td>
								
								<?php 

									if ($data['student_fees_status'] == 1) {

								?>
										<div class=" badge rounded-pill bg-success text-white">
																	
											Paid

										</div>
								<?php

									}

									else{

								?>		
									<div class=" badge rounded-pill bg-danger text-white">
										
										Not Paid

									</div>

								<?php

									}

								 ?>

							</td>
							<td class="d-flex justify-content-between">
								
								<a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#studentViewModal-<?php echo $data['student_id'] ?>">View</a>
								<a href="" class="btn btn-warning" data-bs-toggle="modal"data-bs-target="#studentEditModal-<?php echo $data['student_id'] ?>">Edit</a>
								<a href="" class="btn btn-danger" data-bs-toggle="modal"data-bs-target="#studentDeleteModal-<?php echo $data['student_id'] ?>">Delete</a>

							</td>
							
						</tr>

						<?php 

							}

						 ?>

					</tbody>
					
				</table>

			</div>		

	 	</div>

	</body>
	</html>
<?php 
	
	}
	else{

		ob_end_clean();
		header("Location: Login.php");
		exit();
		
	}
	
 ?>