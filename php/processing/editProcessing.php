<?php
    session_start();
	include('config.php');
    
    /* If we are not logged in we redirect o login */
    if(!isset($_SESSION['UserId'])){
        header('Location: signin.php');
        exit;
    } else {
        /* If we are logged in we show users the page */
        $query = $connection->prepare(
            "SELECT Questions.QuestionId, Questions.QuestionText FROM Questions GROUP BY Questions.QuestionId;"
        );
        $query->execute();
        
        while ($row = mysqli_fetch_array($query)) {

        }
        /* 
        if (isset($_POST['submit'])) {
            $bio = $_POST['bio'];
            $userId = $_SESSION['UserId'];

            $query = $connection->prepare(
                "UPDATE Users SET Bio = :bio WHERE UserId = :userId"
            );
            $query->bindParam("bio", $bio, PDO::PARAM_STR);
            $query->bindParam("userId", $userId, PDO::PARAM_STR);

            $query->execute();
        } */
    }
?>
