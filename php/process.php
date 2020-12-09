<?php
require_once "config.php";
$username = $password = $confirmpassword = "";
$username_err = $password_err = $confirmpassword_err = "";
if(isset($_POST['submit'])){
	$inputusername= $_POST['username'];
	$inputpassword= $_POST['password'];
	$inputconfirmpassword= $_POST['confirm'];
	if(empty($inputusername)){
		$username_err = "Please enter a username.";
	}
	else{
		$username = $inputusername;
	}
	if(empty($inputpassword)){
		$password_err = "Please enter a password.";
	}
	else{
		$password = $inputpassword;
	}
	if(empty($inputconfirmpassword)){
		$confirmpassword_err = "Please confirm your password.";
	}
	else{
		$confirmpassword = $inputconfirmpassword;
	}
	if($password != $confirmpassword){
		$confirmpassword_err = "Make sure your passwords match.";
	}
	
	$mysqli->query("INSERT INTO user (username, password) VALUES('$username', '$location')") or die($mysqli->error);
}
?>
