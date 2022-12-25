<?php

	ob_start();
	
	$page_variable = false; 

	require 'Header.php';
	require 'Footer.php';

 ?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
	</head>
	<body style="background-image: url('./assets/images/Background.jpg'); background-size: 1370px 770px;">

		<div class="container mt-5 login">

			<div class="card d-flex">

				<div class="card-body text-center">

					<?php if (isset($_GET['message']) && !empty($_GET['message'])) { ?>

						<div class="alert alert-danger" id="message">
							
							<strong> <?php print_r($_GET['message']); ?> </strong>

						</div>

					<?php } ?>

					<form method="POST" action="Login_action.php">
						
						<div class="row mt-3 mb-2">
							
							<label class="col-6 col-form-label"><b>Username</b></label>

							<div class="col-6">

								<input type="text" name="username" required>

							</div>

						</div>

						<div class="row mb-5">
							
							<label class="col-6 col-form-label"><b>Password</b></label>

							<div class="col-6">
								
								<input type="password" name="password" required>

							</div>

						</div>

						<div class="text-center">
							
							<button type="submit" name="login" class="btn btn-primary">Login</button>

						</div>

						<div class="float-end">

							<a href="Signup.php" class="btn btn-success">Sign Up</a>
								
						</div>

					</form>
					
				</div>
				
			</div>
			
		</div>

	</body>
	</html>

<script type="text/javascript">
	
	$(document).ready(function(){

		$('.alert').fadeOut(5000);

	});

</script>

