<?php
    session_start();
	include('config.php');
	
    if (isset($_POST['signin'])) {

		/* Get filled out form info */
		$username = $_POST['username'];
		$password = $_POST['password'];

		/* If username not registered and no errors then we can go ahead and register */
		if ($query->rowCount() == 0 and count($issues) == 0) {
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
