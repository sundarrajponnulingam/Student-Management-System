<?php

	ob_start();
	session_start();

	require 'DB_Connect.php';

	if (isset($_POST['login'])) {
		
		$user_name = trim($_POST['username']);
		$user_password = trim(md5($_POST['password']));

		$sql = " SELECT users_id, COUNT(users_id) AS count FROM table_users
				WHERE users_name = '$user_name' ";

		$result = mysqli_query($connection, $sql);

		$data = mysqli_fetch_assoc($result);

		$user_id = $data['users_id'];
		$user_exists = $data['count'];

		if ($user_exists) {
			
			$sql = " SELECT users_password FROM table_users 
					WHERE users_id = '$user_id' ";

			$result = mysqli_query($connection, $sql);

			$data = mysqli_fetch_assoc($result);

			$password = $data['users_password'];

			if ($user_password == $password) {
				
				$sql = " SELECT users_role FROM table_users 
						WHERE users_id = '$user_id' ";

				$result = mysqli_query($connection, $sql);

				$data = mysqli_fetch_assoc($result);

				$user_role = $data['users_role'];

				session_start();

				$_SESSION['user_name'] = $user_name;
				$_SESSION['user_role'] = $user_role;

				if (isset($_SESSION) && !empty($_SESSION)) {
					
					ob_end_clean();		
					header("Location: Dashboard.php");
					exit();
				
				}
				else{

					ob_end_clean();
					header("Location: Login.php?message=Please Login");
					exit();
					
				}

			}
			else{

				ob_end_clean();
				header("Location: Login.php?message=Wrong Password");
				exit();				

			}

		}
		else{

			ob_end_clean();
			header("Location: Login.php?message=No User Found");
			exit();

		}

	}
	elseif (isset($_POST['signup'])) {

		ob_end_clean();		
		header("Location: Signup.php");
		exit();

	}
	
 ?>