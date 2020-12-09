<?php
    session_start();
	include('config.php');
	
    if (isset($_POST['register'])) {

        $username = $_POST['username'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		
		if (empty($username)) { array_push($errors, "Username is needed"); }

		if (empty($password)) { array_push($errors, "Password is needed"); }

		if (empty($confirm)) { array_push($errors, "Confirm Password is needed"); }

		if ($password != $confirm) {
		  array_push($errors, "Your passwords do not match");
		}

		
    }
?>
