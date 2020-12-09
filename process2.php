/*Process2 is the process for the signin page*/
<?php
$mysqli = new mysqli('localhost', 'root', ' ', 'demo') or die(mysqli_error($mysqli));

if(isset($_POST['submit'])){
	$inputusername= $_POST['username'];
	$inputpassword= $_POST['password'];
	if(empty($username)){
		$username_err = "Please enter a username.";
	}
	else{
		$username = $inputusername;
	}
	if(empty($password)){
		$password_err = "Please enter a password.";
	}
	else{
		$password = $inputpassword;
	}
	if(empty($username_err) && empty($password_err)){
		/*check if username in the user DB. If it is, check if the passwords match then allow them into the site, else reject + send some message */
		$sql= "SELECT * FROM User WHERE username='".$username."'AND password='".$password."' limit 1"; 
		$result=mysql_query($sql);
		if(mysql_num_row($result)==1){
			echo "Successfully logged into NYU Meet";
			exit();
		}
		else{
			echo "Incorrect password or username inputted";
			exit(); 
		}
	}
	
}
?>
