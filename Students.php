<?php 
	
	session_start();

	$page_variable = 'Students';

	if (!empty($_SESSION)) {
	
		require 'Header.php';
		require 'Footer.php';

		$where = "";
		$limit = "";

		$page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1 ;	

		if (isset($_GET['search'])) {

			$search = trim($_GET['search']);
			
			$where = " WHERE student_id LIKE '%$search%' 
					OR student_name LIKE '%$search%' 
					OR student_class LIKE '%$search%' 
					OR student_section LIKE '%$search%' 
					OR student_date_of_birth LIKE '%$search%' 
					OR student_father_name LIKE '%$search%' 
					OR student_mother_name LIKE '%$search%' 
					OR student_guardian_id LIKE '%$search%' ";

		}

		$page_first_result = ($page-1) * 5;

		$limit = " LIMIT $page_first_result, 5 ";

		$sql = " SELECT student_id, student_name, student_class, student_section
			FROM table_students $where ORDER BY student_id DESC ";

		$result = mysqli_query($connection, $sql);
	
		$total_rows = mysqli_num_rows($result);	
		$total_pages = ceil($total_rows / 5);

		$sql = " SELECT student_id, student_name, student_class, student_section
			FROM table_students $where ORDER BY student_id DESC $limit ";

		$result = mysqli_query($connection, $sql);

	 ?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Students</title>
	</head>

		<script type="text/javascript">

			$(document).ready(function(){

				<?php if (isset($_GET['search']) && mysqli_num_rows($result) == 0) { ?>

					$("#no_data_found").modal('show');

				<?php } ?>

			});

		</script>

	<body>

		<div class="container mt-5">

			<div class="row mb-4 float-start">

				<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					
					<div class="d-flex justify-content-between">
					
						<input type="text" class="form-control" name="search" id="search_text">

						<button type="submit" class="btn btn-light" id="search">

							<img src="./assets/icons/Search.svg" width="30" height="30">
							
						</button>

					</div>  

				</form>
				
			</div>

			<div class="row mb-4 float-end">  

				<button type="button" class="btn btn-success d-flex" data-bs-toggle="modal" data-bs-target="#studentAddModal"> 

					<div class="mt-1">Add New Student</div> &nbsp  &nbsp<img src="./assets/icons/Plus.svg" width="30" height="30">
					
				</button>
				
			</div>
			
		</div>

		<?php if (mysqli_num_rows($result) >= 1 ) { ?>

			<div class="container mt-5">

				<table class="table table-bordered table-hover text-center">

					<thead>
						
						<tr>
							
							<th scope="col">Id</th>
							<th scope="col">Name</th>
							<th scope="col">Class</th>
							<th scope="col">Section</th>
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
							<td class="d-flex justify-content-between">
								
								<span data-bs-toggle="modal" data-bs-target="#studentViewModal-<?php echo $data['student_id'] ?>"><span data-bs-toggle="tooltip" data-bs-placement="right" title="View"><img src="./assets/icons/View.svg" width="25" height="25"></span></span>
								<span data-bs-toggle="modal"data-bs-target="#studentEditModal-<?php echo $data['student_id'] ?>"><span data-bs-toggle="tooltip" data-bs-placement="right" title="Edit"><img src="./assets/icons/Edit.svg" width="25" height="25"></span></span>
								<span data-bs-toggle="modal" data-bs-target="#studentDeleteModal-<?php echo $data['student_id'] ?>"><span data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><img src="./assets/icons/Delete.svg" width="25" height="25"></span>

							</td>
							
						</tr>

						<?php 

							}

						 ?>

					</tbody>
					
				</table>
				
			</div>

		<?php } ?>

		<div class="d-flex justify-content-center">
				
			<ul class="pagination pagination-lg">

				<?php

					if ($total_pages > 1) {
						
						if ($page > 1 ) { ?>
								
							<li>
							 	
							 	<a class="page-link" href="Students.php?page=<?php echo $page-1 ; echo (isset($_GET['search']) && !empty($_GET['search'])) ? '&search='.$_GET['search'] : '';?>">Previous</a>

							</li>		

						<?php  

							}

						for ($i=1; $i <= $total_pages; $i++) { 

						?>                                                                                                  
							<li class="page-item <?php echo $page == $i ? 'active aria-current="page" ' : ''; ?>">

								<a class="page-link" href="Students.php?page=<?php echo $i ; echo (isset($_GET['search']) && !empty($_GET['search'])) ? '&search='.$_GET['search'] : ''; ?>">

										<?php echo $i; ?>

								</a>

							</li>

					<?php
							
						}

						if ($page < $total_pages) { ?>
								
							<li>
							 	
							 	<a class="page-link" href="Students.php?page=<?php echo $page+1 ; echo (isset($_GET['search']) && !empty($_GET['search'])) ? '&search='.$_GET['search'] : '';?>">Next</a>

							</li>		

						<?php  

							}

					}

						?>		
				
			</ul>
			
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