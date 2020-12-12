<?php
    session_start();
	include('config.php');
	
    if (isset($_POST['register'])) {

		/* Get filled out form info */
		$username = $_POST['username'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];

		/* We have a required keyword in the html so we don't need to check for empty fields */

		if ($password != $confirm) {
		  array_push($issues, "Your passwords do not match");
		}

		/* Check execute statement to find all users with same username */
		$query = $connection->prepare("SELECT * FROM Users WHERE username=:username");
		$query->bindParam("username", $username, PDO::PARAM_STR);
		$query->execute();

		/* If username already registered */
		if ($query->rowCount() > 0) {
            echo '<p class="error">Error: User already registered</p>';
		}
		/* If username not registered and no errors then we can go ahead and register */
		elseif ($query->rowCount() == 0 and count($issues) == 0) {
			$hashed = password_hash($password, PASSWORD_BCRYPT);
			
			$query = $connection->prepare("INSERT INTO Users(Username, Password, FirstName, LastName, finishedSetup) VALUES (:username,:hashed,:firstName,:lastName, False)");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("hashed", $hashed, PDO::PARAM_STR);
			$query->bindParam("firstName", $firstName, PDO::PARAM_STR);
			$query->bindParam("lastName", $lastName, PDO::PARAM_STR);

            $result = $query->execute();
			
			if ($result) {
                echo '<p class="success">Success!</p>';
            } else {
                echo '<p class="error">Please try again later</p>';
            }
        }
    }
?>
