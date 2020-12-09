/*Process for signup page*/
<?php
$mysqli = new mysqli('localhost', 'root', ' ', 'demo') or die(mysqli_error($mysqli));

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirm'];
	$mysqli->query("INSERT INTO user (username, password) VALUES('$username', '$location')") or die($mysqli->error);
}
?>