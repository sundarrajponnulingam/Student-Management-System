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

 ?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<title>Dashboard</title>
	</head>
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
					
						<input type="text" class="form-control" name="search_text" id="search_text" placeholder="Enter Your Search Text Here">

						<button type="submit" class="btn btn-light" id="search">

							<img src="./assets/icons/Search.svg" width="30" height="30">
							
						</button>

					</div>  

				</form>

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