<?php 

	ob_start();
	session_start();

	$page_variable = 'Dashboard';

	if (!empty($_SESSION)) {

		require 'Header.php';
		require 'Footer.php';

		$where = "WHERE 1";
		$limit = "";

		$sql = " SELECT count(student_id) as student_count, 
				(SELECT count(student_id) FROM table_students WHERE student_fees_status = 1) 
				as paid_students, 
				(SELECT count(student_id) FROM table_students WHERE student_fees_status = 0) 
				as not_paid_students 
				FROM table_students";

		$result = mysqli_query($connection, $sql);

		$data = mysqli_fetch_assoc($result);

		$page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1;

		if (isset($_GET['search']) && !empty($_GET['search'])) {	
			
			$search = $_GET['search'];
			
			$where .= " AND student_id LIKE '%$search%' 
					OR student_name LIKE '%$search%' 
					OR student_class LIKE '%$search%' 
					OR student_section LIKE '%$search%' 
					OR student_date_of_birth LIKE '%$search%' 
					OR student_father_name LIKE '%$search%' 
					OR student_mother_name LIKE '%$search%' 
					OR student_guardian_id LIKE '%$search%' ";
		}

		if (isset($_GET['fees_status'])) {                                                                                                                                           

			$student_fees_status = $_GET['fees_status'];

			if ($student_fees_status == 'Paid') {
				
				$where .= " HAVING student_fees_status = '1'";

			}
			else{

				$where .= " HAVING student_fees_status = '0'";

			}
		
		}

		$page_first_result = ($page-1) * 5;

		$limit = " LIMIT $page_first_result, 5 ";

		$sql = " SELECT student_id, student_name, student_class, student_section,student_fees_status FROM table_students $where ORDER BY student_id ASC ";

		$result = mysqli_query($connection, $sql);

		$total_rows = mysqli_num_rows($result);	
		$total_pages = ceil($total_rows/ 5);

		$sql = " SELECT student_id, student_name, student_class, student_section,student_fees_status FROM table_students $where ORDER BY student_id ASC $limit ";

		$result = mysqli_query($connection, $sql);

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

				<?php if (isset($_GET['search']) && mysqli_num_rows($result) == 0) { ?>

					$("#no_data_found").modal('show');

				<?php } ?>

			});

		</script>

	<body>

	 	<div class="container mt-5 dashboard">
	 
			<div class="row">
				
				<div class="col-md-6">

						<a href="Students.php" class="text-decoration-none" style="color: #ffffff;">

							<div class="card h-100">

								<div class="card-body">
									
									<h5 class="card-title fs-3">Students</h5>

									<img src="./assets/icons/Students.svg" class="card-img-top mt-2" width="75" height="75">

									<p class="card-text mt-3 fs-5 text-center">Total Number of Students : <span> <?php echo $data['student_count']; ?> </span></p>
									
								</div>

							</div>

						</a>

				</div>

				<div class="col-md-6">

					<a href="Fees.php" class="text-decoration-none" style="color: #ffffff;">
						
						<div class="card h-100">

							<div class="card-body">
								
								<h5 class="card-title fs-3">Fees</h5>

								<img src="./assets/icons/Fees.svg" class="card-img-top mt-2" width="75" height="75">

								<div class="d-flex justify-content-between mt-3">
									
									<span class="card-text fs-5"> Paid : <span> <?php echo $data['paid_students']; ?> </span></span>

									<span class="card-text fs-5" style="background-color: red;"> Not Paid : <span> <?php echo $data['not_paid_students']; ?> </span></span>

								</div>

							</div>

						</div>				
					
					</a>	

				</div>

			</div>

			<div class="container mt-4 d-flex justify-content-center">
				
				<div class="row">
					
					<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						
						<div class="d-flex justify-content-between">
						
							<input type="text" class="form-control" name="search" id="search_text" placeholder="Search Here">

							<button type="submit" class="btn btn-light" id="search">

								<img src="./assets/icons/Search.svg" width="30" height="30">
								
							</button>

						</div>  

					</form>

				</div>

			</div>

			<?php if (isset($_GET['search']) && !empty($_GET['search']))  {
			 ?>

				<div class="dropdown float-end mb-3">

					<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded = "false">Fees Status</button>

					<ul class="dropdown-menu">
						
						<li><a class="dropdown-item" href="Dashboard.php?<?php echo (isset($_GET['search']) && !empty($_GET['search'])) ? 'search='.$_GET['search'].'&fees_status=Paid' : 'fees_status=Paid'; ?>">Paid</a></li>
						<li><a class="dropdown-item" href="Dashboard.php?<?php echo (isset($_GET['search']) && !empty($_GET['search'])) ? 'search='.$_GET['search'].'&fees_status=Not Paid' : 'fees_status=Not Paid'; ?>">Not Paid</a></li>

					</ul>
					
				</div>

			<?php 

			}

			 ?>

			<?php if (mysqli_num_rows($result) >=1 ) { ?>

				<div class="container" id="search_result" <?php echo (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) ? '' : 'style="display: none;"' ?>>
				
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
									
									<span data-bs-toggle="modal" data-bs-target="#studentViewModal-<?php echo $data['student_id'] ?>">

										<span data-bs-toggle="tooltip" data-bs-placement="right" title="View">

											<img src="./assets/icons/View.svg" width="25" height="25">

										</span>

									</span>

									<span data-bs-toggle="modal"data-bs-target="#studentEditModal-<?php echo $data['student_id'] ?>">

										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">

											<img src="./assets/icons/Edit.svg" width="25" height="25">

										</span>

									</span>

									<span data-bs-toggle="modal"data-bs-target="#studentDeleteModal-<?php echo $data['student_id'] ?>">

										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">

											<img src="./assets/icons/Delete.svg" width="25" height="25">

										</span>

									</span>

								</td>
								
							</tr>

							<?php 

								}

							 ?>

						</tbody>
						
					</table>

				</div>

			<?php } ?>

			<?php if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) { ?>

				<div class="d-flex justify-content-center" id="pagination">
				 
				 	<ul class="pagination pagination-lg">

				 		<?php

				 			if ($total_pages > 1) {
				 				
	 				 			if ($page > 1 ) { ?>
	 				 					
	 				 				<li>
	 				 				 	
	 				 				 	<a class="page-link" href="Dashboard.php?page=<?php echo $page-1 ; echo (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) ? '&search='.$_REQUEST['search'] : ''; echo (isset($_GET['fees_status']) && !empty($_GET['fees_status'])) ? '&fees_status='.$_GET['fees_status'] : '';?>">Previous</a>

	 				 				</li>		

	 				 			<?php  

	 				 			}

	 				 			for ($i=1; $i <= $total_pages; $i++) { 

	 				 			?>
	 				 				
	 				 				<li class="page-item <?php echo $page == $i ? 'active aria-current="page" ' : ''; ?>">

	 				 					<a class="page-link" href="Dashboard.php?page=<?php echo $i ; echo (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) ? '&search='.$_REQUEST['search'] : ''; echo (isset($_GET['fees_status']) && !empty($_GET['fees_status'])) ? '&fees_status='.$_GET['fees_status'] : '';?>">

	 				 							<?php echo $i; ?>

	 				 					</a>

	 				 				</li>

	 				 		<?php
	 				 				
	 				 			}

	 				 			if ($page < $total_pages) { ?>
	 									
	 								<li>
	 								 	
	 								 	<a class="page-link" href="Dashboard.php?page=<?php echo $page+1 ; echo (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) ? '&search='.$_REQUEST['search'] : ''; echo (isset($_GET['fees_status']) && !empty($_GET['fees_status'])) ? '&fees_status='.$_GET['fees_status'] : '';?>">Next</a>

	 								</li>		

	 							<?php  

	 								}

				 			 } 

							?>	
				 		
				 	</ul>
				 	
				</div>

			<?php } ?>		

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