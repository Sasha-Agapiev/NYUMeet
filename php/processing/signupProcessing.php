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

		/* Check if we got any issues with the filled out form */

		if (empty($username)) { array_push($issues, "Username is needed"); }

		if (empty($firstName)) { array_push($issues, "First Name is needed"); }

		if (empty($lastName)) { array_push($issues, "Last Name is needed"); }

		if (empty($password)) { array_push($issues, "Password is needed"); }

		if (empty($confirm)) { array_push($issues, "Confirm Password is needed"); }

		if ($password != $confirm) {
		  array_push($issues, "Your passwords do not match");
		}

		/* Check execute statement to find all users with same username */
		$query = $connection->prepare("SELECT * FROM Users WHERE username=:username");
		$query->bindParam("username", $username, PDO::PARAM_STR);
		$query->execute();

		/* If username already registered */
		if ($query->rowCount() > 0) {
            array_push($issues, "User already registered");
		}

		if(count($issues) > 0) {
			foreach ($issues as $issue) {
				echo '<p class="issue">Error: ' . $issue . ' </p>';
			}
		}
		
		/* If username not registered and no errors then we can go ahead and register */
		elseif ($query->rowCount() == 0 and count($issues) == 0) {
			$hashed = password_hash($password, PASSWORD_BCRYPT);
			
			$query = $connection->prepare("INSERT INTO Users(Username, Password, FirstName, LastName) VALUES (:username,:hashed,:firstName,:lastName)");
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
