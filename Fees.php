<?php 

	ob_start();
	session_start();
	
	$page_variable = 'Fees';

	if (!empty($_SESSION)) {

		require 'Header.php';
		require 'Footer.php';

		$where = " WHERE 1 ";
		$limit = "";

		$sql = "SELECT * FROM table_students";
		
		$result = mysqli_query($connection, $sql);

		$total_rows = mysqli_num_rows($result);	
		$total_pages = ceil($total_rows / 5);

		$page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1 ;	

		if (isset($_GET['search']) && !empty($_GET['search'])) {

			$search = trim($_GET['search']);
			
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

		$sql = " SELECT student_id, student_name, student_class, student_section, student_fees_status FROM table_students $where ORDER BY student_id ASC ";

		$result = mysqli_query($connection, $sql);
			
		$total_rows = mysqli_num_rows($result);	
		$total_pages = ceil($total_rows / 5);

		$sql = " SELECT student_id, student_name, student_class, student_section, student_fees_status FROM table_students $where ORDER BY student_id ASC $limit ";
		$result = mysqli_query($connection, $sql);

	 ?>
	 <!DOCTYPE html>
	 <html>
	 <head>
	 	<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<title>Fees</title>
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

			<div class="dropdown float-end">

				<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded = "false">Fees Status</button>

				<ul class="dropdown-menu">
					
					<li><a class="dropdown-item" href="Fees.php?<?php echo (isset($_GET['search']) && !empty($_GET['search'])) ? 'search='.$_GET['search'].'&fees_status=Paid' : 'fees_status=Paid'; ?>">Paid</a></li>
					<li><a class="dropdown-item" href="Fees.php?<?php echo (isset($_GET['search']) && !empty($_GET['search'])) ? 'search='.$_GET['search'].'&fees_status=Not Paid' : 'fees_status=Not Paid'; ?>">Not Paid</a></li>

				</ul>
				
			</div>

		</div>

		<?php if (mysqli_num_rows($result) >=1 ) { ?>

			<div class="container mt-5">
				
				<table class="table table-bordered table-hover text-center">

					<thead>
						
						<tr>
							
							<th scope="col">Id</th>
							<th scope="col">Name</th>
							<th scope="col">Class</th>
							<th scope="col">Section</th>
							<th scope="col">Fees</th>

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
			 				 	
			 				 	<a class="page-link" href="Fees.php?page=<?php echo $page-1 ; echo (isset($_GET['search']) && !empty($_GET['search'])) ? '&search='.$_GET['search'] : '';  echo (isset($_GET['fees_status']) && !empty($_GET['fees_status'])) ? '&fees_status='.$_GET['fees_status'] : '';?>">Previous</a>

			 				</li>		

			 			<?php  

			 			}

			 			for ($i=1; $i <= $total_pages; $i++) { 

			 			?>
			 				
			 				<li class="page-item <?php echo $page == $i ? 'active aria-current="page" ' : ''; ?>">

			 					<a class="page-link" href="Fees.php?page=<?php echo $i; echo (isset($_GET['search']) && !empty($_GET['search'])) ? '&search='.$_GET['search'] : ''; echo (isset($_GET['fees_status']) && !empty($_GET['fees_status'])) ? '&fees_status='.$_GET['fees_status'] : '';?>">

			 							<?php echo $i; ?>

			 					</a>

			 				</li>

			 		<?php
			 				
			 			}

			 			if ($page < $total_pages) { ?>
								
							<li>
							 	
							 	<a class="page-link" href="Fees.php?page=<?php echo $page+1 ; echo (isset($_GET['search']) && !empty($_GET['search'])) ? '&search='.$_GET['search'] : ''; echo (isset($_GET['fees_status']) && !empty($_GET['fees_status'])) ? '&fees_status='.$_GET['fees_status'] : '';?>">Next</a>

							</li>		

						<?php  

							}

		 			} 

					?>	
		 		
		 	</ul>
		 	
		</div>
	 
	</body>
	</html>

	<script type="text/javascript">
		
		function fliterByFeesStatus(feesStatus){

			var feesStatus = feesStatus;

			var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function(){

				if (this.readyState == 4 && this.status == 200) {

					window.location.reload();

				}

			};

			xmlhttp.open("GET", "Fees.php?fees_status=" + feesStatus, true);
			xmlhttp.send();

		}

	</script>

	
<?php 

	}
	else{

		ob_end_clean();
		header("Location: Login.php");
		exit();
		
	}

 ?>