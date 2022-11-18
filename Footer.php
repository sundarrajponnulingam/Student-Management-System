<?php 

	require 'DB_Connect.php';

 ?>

<div class="offcanvas offcanvas-start" id="menu" aria-labelledby="menuLabel" tabindex="-1">

	<div class="offcanvas-header">

		<h4 class="offcanvas-title" id="menuLabel"></h4>

		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		
	</div>

	<div class="offcanvas-body">	

		<div class="row">

			<div class="list-group">
				
				<a href="Dashboard.php" class="list-group-item action <?php echo $page_variable == 'Dashboard' ? 'active' : '';?>" aria-current="true">Dashboard
				</a>

				<a href="Students.php" class="list-group-item action <?php echo $page_variable == 'Students' ? 'active' : '';?>" aria-current="true">Students</a>

				<a href="Parents.php" class="list-group-item action <?php echo $page_variable == 'Parents' ? 'active' : '';?>" aria-current="true">Parents</a>

				<a href="Fees.php" class="list-group-item action <?php echo $page_variable == 'Fees' ? 'active' : '';?>" aria-current="true">Fees</a>

			</div>

		</div>	
		
	</div>
	
</div>

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-dialog-centered">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title" id="userModalLabel">My Account</h5>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				
			</div>	

			<div class="modal-body">

				<div class="row mb-3">

					<label class="col-form-label col-md-3">Username</label>

					<div class="col-md-9">
						
						<input type="text" class="form-control-plaintext" value="username" disabled readonly>

					</div>
					
				</div>

				<div class="row mb-3">

					<label class="col-form-label col-md-3">Name</label>

					<div class="col-md-9">
						
						<input type="text" class="form-control" value="name" disabled readonly>

					</div>

				</div>

				<div class="row mb-3">

					<label class="col-form-label col-md-3">Students</label>

					<div class="col-md-9">
						
						<input type="text" class="form-control" value="2" disabled readonly>
						
					</div>

				</div>

				<div class="row mb-3">

					<label class="col-form-label col-md-3">Parent Id</label>

					<div class="col-md-9">
						
						<input type="text" class="form-control" value="123456" disabled readonly>
						
					</div>

				</div>

				<div class="row mb-3">

					<label class="col-form-label col-md-3">Fees</label>

					<div class="d-flex justify-content-between col-md-9 mt-2">

						<div class="form-check form-switch">
							
							<input type="checkbox" class="form-check-input" role="switch" checked>

							<label class="form-check-label">Paid</label>	

						</div>

						<div class="form-check form-switch">
							
							<input type="checkbox" class="form-check-input" role="">

							<label class="form-check-label">Not Paid</label>

						</div>
						
					</div>
					
				</div>
				
			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				
			</div>
			
		</div>
		
	</div>
	
</div>

<?php 

	$sql = "SELECT * FROM table_students";

	$result = mysqli_query($connection, $sql);

	while ($data = mysqli_fetch_assoc($result)) {

?>

		<div class="modal fade" id="studentViewModal-<?php echo $data['student_id']; ?>" tabindex="-1" aria-labelledby="studentViewModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">

			<div class="modal-dialog modal-dialog-centered">

				<div class="modal-content">

					<div class="modal-header">

						<h5 class="modal-title" id="studentViewModalLabel">Student Details</h5>

						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						
					</div>

					<div class="modal-body">              

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Name</label>

							<div class="col-md-8">
								
								<input type="text" class="form-control" value="<?php echo $data['student_name']; ?>" disabled readonly>

							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Class</label>

							<div class="col-md-8">
								
								<input type="text" class="form-control" value="<?php echo $data['student_class']; ?>" disabled readonly>

							</div>

						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Section</label>

							<div class="col-md-8">
								
								<input type="text" class="form-control" value="<?php echo $data['student_section']; ?>" disabled readonly>
								
							</div>

						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Date of Birth</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['student_date_of_birth']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Father Name</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['student_father_name']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Mother Name</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['student_mother_name']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Address</label>

							<div class="col-md-8">

								<textarea name="student_address" rows="4" class="form-control" disabled readonly><?php echo $data['student_address']; ?></textarea>

							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Parent Id</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['student_guardian_id']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Fees</label>

							<div class="d-flex justify-content-between col-md-8 mt-2">

								<div class="form-check form-switch">
									
									<input type="radio" class="form-check-input" role="switch" <?php echo ($data['student_fees_status'] == 1) ? 'checked' : ''; ?> disabled>

									<label class="form-check-label">Paid</label>	

								</div>

								<div class="form-check form-switch">
									
									<input type="radio" class="form-check-input" role="switch" <?php echo ($data['student_fees_status'] < 1) ? 'checked' : ''; ?> disabled>

									<label class="form-check-label">Not Paid</label>

								</div>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Document</label>

								<?php if ($data['student_document']) { 

								?>
									<div class="col-md-6">

										<input type="text" class="form-control" value="<?php echo $data['student_document']; ?>" disabled readonly>

									</div>

									<div class="col-md-2">	

										<button type="button" class="btn btn-primary" name="view_document">View</button>
									</div>	

								<?php }

								else{

								?>	

									<div class="col-md-8">

										<input type="text" class="form-control" value="<?php echo $data['student_document']; ?>" disabled readonly>

									</div>
									
								<?php	
									
									}

								?>							

						</div>
						
					</div>

					<div class="modal-footer">

						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						
					</div>
					
				</div>
				
			</div>
			
		</div>

		<div class="modal fade" id="studentEditModal-<?php echo $data['student_id']; ?>" tabindex="-1" aria-labelledby="studentEditModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">

			<form method="POST" action="Student_Edit_action.php" enctype="multipart/form-data">

				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">

						<div class="modal-header">

							<h5 class="modal-title" id="studentEditModalLabel">Student Details</h5>

							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							
						</div>

						<div class="modal-body">

							<input type="hidden" name="student_id" value="<?php echo $data['student_id']; ?>">

							<input type="hidden" name="parent_id" value="<?php echo $data['student_guardian_id']; ?>">

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Student Name</label>

									<div class="col-md-8">
										
										<input type="text" class="form-control" name="student_name" value="<?php echo $data['student_name']; ?>">

									</div>
									
								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Class</label>

									<div class="col-md-8">
										
										<input type="text" class="form-control" name="student_class" value="<?php echo $data['student_class']; ?>">

									</div>

								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Section</label>

									<div class="col-md-8">
										
										<input type="text" class="form-control" name="student_section" value="<?php echo $data['student_section']; ?>">
										
									</div>

								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Date of Birth</label>

									<div class="col-md-8">

										<input type="date" class="form-control" name="student_date_of_birth" value="<?php echo $data['student_date_of_birth']; ?>">
										
									</div>
									
								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Father Name</label>

									<div class="col-md-8">

										<input type="text" class="form-control" name="student_father_name" value="<?php echo $data['student_father_name']; ?>">
										
									</div>
									
								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Mother Name</label>

									<div class="col-md-8">

										<input type="text" class="form-control" name="student_mother_name" value="<?php echo $data['student_mother_name']; ?>">
										
									</div>
									
								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Address</label>

									<div class="col-md-8">

										<textarea name="student_address" rows="5" class="form-control"><?php echo $data['student_address']; ?></textarea>

									</div>
									
								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Fees</label>

									<div class="d-flex justify-content-between col-md-8 mt-2">

										<div class="form-check form-switch">
											
											<input type="radio" class="form-check-input" role="switch" value="1" name="student_fees_status-<?php echo $data['student_id']; ?>" <?php echo ($data['student_fees_status'] == 1) ? 'checked' : ''; ?>>

											<label class="form-check-label">Paid</label>	

										</div>

										<div class="form-check form-switch">
											
											<input type="radio" class="form-check-input" role="switch" value="0" name="student_fees_status-<?php echo $data['student_id']; ?>" <?php echo ($data['student_fees_status'] < 1) ? 'checked' : ''; ?>>

											<label class="form-check-label">Not Paid</label>

										</div>
										
									</div>
									
								</div>

								<div class="row mb-3">

									<label class="col-form-label col-md-4">Document</label>

									<div class="col-md-8 d-flex justify-content-between">
										
										<?php if ($data['student_document']) { 

										?>
											
											<button type="button" class="btn btn-primary" name="view_document">View</button>

											<button type="button" class="btn btn-danger" name="delete_document" data-bs-toggle="modal" data-bs-target="#studentDocumentDeleteModal-<?php echo $data['student_id'] ?>">Delete</button>

										<?php }

										else{

										?>	

											<input type="file" class="form-control" name="student_document" id="fileUpload">

										<?php	
											
											}

										?>

									</div>
									
								</div>
								
							</div>

							<div class="modal-footer">

								<button type="submit" class="btn btn-warning" name="student_edit">Edit</button>

								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
								
							</div>
							
						</div>
						
					</div>
				
				</div>

			</form>	
			
		</div>

		<div class="modal fade" id="studentDocumentDeleteModal-<?php echo $data['student_id'] ?>" tabindex="-1" aria-labelledby="studentDeleteModalLabel" data-bs-backdrop="static" aria-hidden="true">

			<form method="POST" action="Student_Document_Delete_action.php">
				
				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">	

						<div class="modal-header">

							<h5 class="modal-title d-flex justify-content-between" id="studentDocumentDeleteModalLabel">
								
								<img src="./assets/icons/Exclamation.svg" width="30" height="30">&nbsp &nbsp<span>Warning</span>

							</h5>

							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							
						</div>

						<div class="modal-body">

							<input type="hidden" name="student_id" value="<?php echo $data['student_id']; ?>">

							<span>Are you sure want to Delete</span>&nbsp<strong><?php echo $data['student_document']; ?></strong>&nbsp<img src="./assets/icons/Question.svg" width="30" height="30" class="mb-2">
							
						</div>

						<div class="modal-footer">

							<button type="submit" class="btn btn-danger" name="student_document_delete">Delete</button>

							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							
						</div>
						
					</div>
					
				</div>

			</form>
			
		</div>

		<div class="modal fade" id="studentDeleteModal-<?php echo $data['student_id'] ?>" tabindex="-1" aria-labelledby="studentDeleteModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">

			<form method="POST" action="Student_Delete_action.php">
				
				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">	

						<div class="modal-header">

							<h5 class="modal-title d-flex justify-content-between" id="studentDeleteModalLabel">
								
								<img src="./assets/icons/Exclamation.svg" width="30" height="30">&nbsp &nbsp<span>Warning</span>

							</h5>

							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							
						</div>

						<div class="modal-body">

							<input type="hidden" name="student_id" value="<?php echo $data['student_id']; ?>">

							<input type="hidden" name="student_guardian_id" value="<?php echo $data['student_guardian_id']; ?> ">

							<span>Are you sure want to Delete</span>&nbsp<strong><?php echo $data['student_name']; ?></strong>&nbsp<img src="./assets/icons/Question.svg" width="30" height="30" class="mb-2">
							
						</div>

						<div class="modal-footer">

							<button type="submit" class="btn btn-danger" name="student_delete">Delete</button>

							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							
						</div>
						
					</div>
					
				</div>

			</form>
			
		</div>
<?php 
	
	}

 ?>		

<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="studentAddModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	
	<form method="POST" action="Student_Add_action.php" enctype="multipart/form-data">

		<div class="modal-dialog modal-dialog-centered">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title" id="studentAddModalLabel">Student Details</h5>

					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					
				</div>

				<div class="modal-body">

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Student Name</label>

						<div class="col-md-8">
							
							<input type="text" class="form-control" name="student_name">

						</div>
						
					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Class</label>

						<div class="col-md-8">
							
							<input type="text" class="form-control" name="student_class">

						</div>

					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Section</label>

						<div class="col-md-8">
							
							<input type="text" class="form-control" name="student_section">
							
						</div>

					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Date of Birth</label>

						<div class="col-md-8">

							<input type="date" class="form-control" name="student_date_of_birth">
							
						</div>
						
					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Father Name</label>

						<div class="col-md-8">

							<input type="text" class="form-control" name="student_father_name">
							
						</div>
						
					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Mother Name</label>

						<div class="col-md-8">

							<input type="text" class="form-control" name="student_mother_name">
							
						</div>
						
					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Address</label>

						<div class="col-md-8">

							<textarea name="student_address" rows="5" class="form-control"></textarea>

						</div>
						
					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Fees</label>

						<div class="d-flex justify-content-between col-md-8 mt-2">

							<div class="form-check form-switch">
								
								<input type="radio" class="form-check-input" role="switch" name="student_fees_status" value="1">

								<label class="form-check-label">Paid</label>	

							</div>

							<div class="form-check form-switch">
								
								<input type="radio" class="form-check-input" role="switch" name="student_fees_status" value="0">

								<label class="form-check-label">Not Paid</label>

							</div>
							
						</div>
						
					</div>

					<div class="row mb-3">

						<label class="col-form-label col-md-4">Document</label>

						<div class="col-md-8 text-center">

							<input type="file" class="form-control" name="student_document" id="fileUpload">

						</div>
						
					</div>

				</div>

					<div class="modal-footer">

						<button type="submit" class="btn btn-primary" name="student_add">Add</button>

						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</form>

</div>

<?php 

	$sql = " SELECT table_parents.*,
			(SELECT AVG(student_fees_status) FROM table_students 
			WHERE table_parents.parents_guardian_id = table_students.student_guardian_id )
			AS fees_status 
			FROM table_parents;  ";

	$result = mysqli_query($connection, $sql);

	while ($data = mysqli_fetch_assoc($result)) {

?>

		<div class="modal fade" id="parentViewModal-<?php echo $data['parents_guardian_id']; ?>" tabindex="-1" aria-labelledby="parentViewModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">

		 	<div class="modal-dialog modal-dialog-centered">

		 		<div class="modal-content">

		 			<div class="modal-header">

		 				<h5 class="modal-title" id="studentViewModalLabel">Parent Details</h5>

		 				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		 				
		 			</div>

		 			<div class="modal-body">              

		 				<div class="row mb-3">

							<label class="col-form-label col-md-4">Father Name</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['parents_father_name']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Mother Name</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['parents_mother_name']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Address</label>

							<div class="col-md-8">

								<textarea name="student_address" rows="4" class="form-control" disabled readonly><?php echo $data['parents_address']; ?></textarea>

							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Student Id(s)</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['parents_students_id']; ?>" disabled readonly>
								
							</div>
							
						</div>

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Student Name(s)</label>

							<div class="col-md-8">

								<input type="text" class="form-control" value="<?php echo $data['parents_students_name']; ?>" disabled readonly>
								
							</div>
							
						</div>			

						<div class="row mb-3">

							<label class="col-form-label col-md-4">Fees</label>

							<div class="d-flex justify-content-between col-md-8 mt-2">

								<div class="form-check form-switch">
									
									<input type="radio" class="form-check-input" role="switch" <?php echo ($data['fees_status'] == 1) ? 'checked' : ''; ?> disabled>

									<label class="form-check-label">Paid</label>	

								</div>

								<div class="form-check form-switch">
									
									<input type="radio" class="form-check-input" role="switch" <?php echo ($data['fees_status'] < 1) ? 'checked' : ''; ?> disabled>

									<label class="form-check-label">Not Paid</label>

								</div>
								
							</div>
							
						</div>

			 			<div class="modal-footer">

			 				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			 				
			 			</div>
			 			
			 		</div>
			 		
			 	</div>
			 	
			</div>

		</div>
<?php 
	
	}		

 ?>

 <div class="modal" tabindex="-1" id="noResult">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title">Oops..!</h5>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				
			</div>

			<div class="modal-body">

				<p>No Data Found</p>
				
			</div>

			<div class="modal-footer">
				
				<button type="button" class="btn btn-warning">Close</button>

			</div>
			
		</div>
		
	</div> 	

 </div>

<script type="text/javascript" src="./assets/jQuery/jQuery.min.js"></script>
<!-- <script type="text/javascript" src="./assets/Popper/popper.min.js"></script> -->
<script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
