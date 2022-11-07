<?php 

	ob_start();
	session_start();

	$page_variable = 'Dashboard';
	
	require 'Header.php';
	require 'Footer.php';

	if (!empty($_SESSION)) {

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
				
				<div class="col-md-4">

						<a href="" class="text-decoration-none">

							<div class="card h-100">
							
								<img src="./assets/icons/Students.svg" class="card-img-top mt-2" width="100" height="100">

								<div class="card-body">
									
									<h5 class="card-title">Students</h5>

									<p class="card-text mt-3">Total Number of Students</p>
									
								</div>

							</div>

						</a>

				</div>

				<div class="col-md-4">

					<a href="" class="text-decoration-none">
						
						<div class="card h-100">

							<img src="./assets/icons/Fees.svg" class="card-img-top mt-2" width="100" height="100">

							<div class="card-body">
								
								<h5 class="card-title">Fees</h5>

								<p class="card-text mt-3">Number of Students Paid </p>

								<p class="card-text">Number of Students Not Paid</p>

							</div>

						</div>				
					
					</a>	

				</div>

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