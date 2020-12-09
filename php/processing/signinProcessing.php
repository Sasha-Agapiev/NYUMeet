<?php
    session_start();
	include('config.php');
	
    if (isset($_POST['signin'])) {

		/* Get filled out form info */
		$username = $_POST['username'];
		$password = $_POST['password'];

		/* Check if we got any issues with the filled out form */

		if (empty($username)) { array_push($issues, "Username is needed"); }

		if (empty($password)) { array_push($issues, "Password is needed"); }

		if(count($issues) > 0) {
			foreach ($issues as $issue) {
				echo '<p class="issue">Error: ' . $issue . ' </p>';
			}
		}
		
		/* If everything is okay we can go ahead and sign in */
		elseif ($query->rowCount() == 0 and count($issues) == 0) {
			$hashed = password_hash($password, PASSWORD_BCRYPT);
			
			$query = $connection->prepare("SELECT * FROM users WHERE username=:username");
            $query->bindParam("username", $username, PDO::PARAM_STR);

			$query->execute();
			
			$result = $query->fetch(PDO::FETCH_ASSOC);
			
			if (!$result) {
                echo '<p class="success">Error: Wrong username password combo</p>';
            } else {
				if (password_verify($password, $result['password'])) {
					$_SESSION['user_id'] = $result['id'];
					echo '<p class="success">Success!</p>';
				} else {
					echo '<p class="error">Error: Wrong username password combo</p>';
				}
            }
        }
    }
?>
