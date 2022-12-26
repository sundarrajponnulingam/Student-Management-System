<link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css">

<?php

	if ($page_variable) { ?>
		
		<nav class="navbar">
			
			<div class="container-fluid">

				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menu">
					
					<span class="navbar-toggler-icon">
						
						<img src="./assets/icons/Menu-Bars.svg">

					</span>

				</button>

				<div class="float-end logout">
							
					<a href="Logout_action.php" class="btn btn-danger"> 

						Logout  &nbsp&nbsp

						<img src="./assets/icons/Logout.svg" width="30" height="30">

					</a>
					
				</div>
				
			</div>

		</nav>

<?php

	}

 ?>
