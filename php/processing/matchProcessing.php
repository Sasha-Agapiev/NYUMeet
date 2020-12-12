<?php
    /* Setup db and session */
    include('config.php');
    session_start();
    /* Redirect if not signed in */
    if(!isset($_SESSION['UserId'])){
        header('Location: signin.php');
        exit;
    }
?>
<html>
    <head>
        <!-- Page Info -->
        <meta charset="utf-8">
        <title>NYUMeet</title>
        <meta name="description" content="Meet other NYU students!">
        <meta name="author" content="NYUMeet team">

        <!-- Mobile Compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">   

        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/listings.css">

        <!-- Favicon and Site Title -->
        <title>NYUMeet</title>
    </head>

    <body>
        <?php
            $UserId1 = $_GET['id'];
            $UserId = $_SESSION['UserId'];

            /* Add match */
            $query = $connection->prepare(
                "INSERT INTO Matches(UserId1, UserId2) VALUES (:UserId1,:UserId)"
            );
            $query->bindParam("UserId", $UserId, PDO::PARAM_STR);
            $query->bindParam("UserId1", $UserId1, PDO::PARAM_STR);

            $queryRes = $query->execute();

            header('Location: ../find.php');
            exit;
        ?>
        <h1>Matched!</h1>
    </body>
</html>