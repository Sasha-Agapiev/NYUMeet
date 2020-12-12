<?php
    session_start();
	include('config.php');
	
    if (isset($_POST['signin'])) {

		/* Get filled out form info */
		$username = $_POST['username'];
		$password = $_POST['password'];
			
		/* Look for username  for user */
		$query = $connection->prepare("SELECT * FROM Users WHERE Username=:username");
		$query->bindParam("username", $username, PDO::PARAM_STR);

		$query->execute();
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		/* Finish up and display error if needed else, we save the user and go on */
		if (!$result) {
			echo '<p class="success">Error</p>';
		} else {
			/* Check password and save user if correct then redirect */
			if (password_verify($password, $result['Password'])) {
				$_SESSION['UserId'] = $result['UserId'];
				header('Location: find.php');
				exit;
			} else {
				echo '<p class="error">Error: Wrong username password combo</p>';
			}
		}
	}
?>
