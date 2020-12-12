<?php
    include('processing/config.php');
    session_start();
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

    <header>
        <div>
            <div class="titleBar">
                <div class="leftTitleBar">
                    <a href="find.php"><h4 class="menuItem inactiveMenuItem">Find</h4></a>
                    <a href="matches.php"><h4 class="menuItem activeMenuItem">Matches</h4></a>
                </div>
                <div class="middleTitleBar">
                    <a href="../index.php"><h3 class="titleBrand">NYUMeet</h3></a>
                </div>
                <div class="rightTitleBar">
                    <a href="edit.php"><h4 class="menuItem inactiveMenuItem">Profile</h4></a>
                    <a href="signout.php"><h4 class="menuItem inactiveMenuItem">Sign Out</h4></a>
                </div>
            </div>
        </div>
    </header>

    <body>
        <div class="findSection">
            <h1 class="title">Your Matches</h1>
            <div class="peopleSection">
                <?php
                    $matchesQuery = $connection->prepare("SELECT FirstName, LastName, Username, Bio, Instagram, Snapchat FROM Matches INNER JOIN Users ON Matches.UserId2 = Users.UserId WHERE Matches.UserId1 = :UserId");
                    $matchesQuery->bindParam("UserId", $_SESSION['UserId'], PDO::PARAM_INT);
                    $matchesQuery->execute();
                    $matchesResult = $matchesQuery->fetchAll(PDO::FETCH_ASSOC);
                    if ($matchesQuery->rowCount() == 0) {
                        echo '<h2 class="error">No matches yet</h2>';
                    }
                    foreach($matchesResult as $matchesRow) {
                    ?>
                        <div class="personContainer">
                            <img class="personImage" src="https://images.unsplash.com/photo-1584799235813-aaf50775698c?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&dl=zheka-boychenko-vPkTWyTgk8E-unsplash.jpg"/>
                            <div class="personInfoContainer">
                                <div class="titleContainer">
                                    <h2 class="itemTitle"><?php echo $matchesRow['FirstName']?> <?php echo $matchesRow['LastName'] ?></h2>
                                </div>
                                <p class="personBio"><?php echo $matchesRow['Bio']?></p>
                                <h3 class="itemTitle">Contact Info</h3>
                                <p class="personBio"><?php echo 'Snapchat:', $matchesRow['Snapchat']?><br>
                                    <?php echo 'Instagram:', $matchesRow['Instagram']?><br>
                                    <?php echo 'Zoom:', $matchesRow['Zoom']?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </body>
</html>