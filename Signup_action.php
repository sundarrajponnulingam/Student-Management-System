<?php 

	ob_start();

	require 'DB_Connect.php';

	if (isset($_POST['signup'])) {
		
		$user_name = trim($_POST['username']);
		$user_password = trim($_POST['password']);
		$user_confirm_password = trim($_POST['confirm_password']);

		$password_equal = strcmp($user_password, $user_confirm_password);

		if ($password_equal == 0) {

			$users_password = md5($user_password);
			
			$sql = " INSERT INTO table_users (

											users_name,
											users_password,
											users_role

										  )

										VALUES
										(

											'$user_name',
											'$users_password',
											'2'
											
										) ";

			$result = mysqli_query($connection, $sql);
			
			if ($result) {
				
				$sql = " SELECT users_role FROM table_users ORDER BY users_id DESC LIMIT 1 ";

				$result = mysqli_query($connection, $sql);

				if ($result) {

					$data = mysqli_fetch_assoc($result);
					
					$user_role = $data['users_role'];

					session_start();

					$_SESSION['user_name'] = $user_name;
					$_SESSION['user_role'] = $user_role;

					if (!empty($_SESSION)) {
						
						ob_end_clean();		
						header("Location: Dashboard.php");
						die();

					}

				}	

			}							

		}
		else{

			ob_end_clean();
			header("Location: Signup.php?message=Passwords doesnot match");
			exit();
			
		}

	}
	elseif (isset($_POST['login'])) {

		ob_end_clean();
		header("Location: Login.php");
		die();

	}

 ?>