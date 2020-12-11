<?php
    session_start();
	include('config.php');
    
    /* If we are not logged in we redirect o login */
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    } else {
        /* If we are logged in we show users the page */
        $query = $connection->prepare(
            "SELECT FirstName, LastName, Bio"
        );
    }
?>
