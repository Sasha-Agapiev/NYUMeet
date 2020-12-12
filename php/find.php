<?php
    /* Setup db and session */
    include('processing/config.php');
    session_start();
    /* Redirect if not signed in */
    if(!isset($_SESSION['UserId'])){
        header('Location: signin.php');
        exit;
    } else {
        /* See if user finished setting up account. This query just checks the finishedSetup bool in the db*/
        $finishedQuery = $connection->prepare("SELECT finishedSetup FROM Users WHERE UserId = :UserId");
        $finishedQuery->bindParam("UserId", $_SESSION['UserId'], PDO::PARAM_INT);
        $finishedQuery->execute();
        /* This just gets the first result, but we will only have one result no matter what anyhow */
        $finishedResult = $finishedQuery->fetch(PDO::FETCH_ASSOC);
        if (!$finishedResult['finishedSetup']) {
            header('Location: edit.php');
            exit;
        }
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
                    <a href="find.php"><h4 class="menuItem activeMenuItem">Find</h4></a>
                    <a href="matches.php"><h4 class="menuItem inactiveMenuItem">Matches</h4></a>
                </div>
                <div class="middleTitleBar">
                    <a href="../index.php"><h3 class="titleBrand">NYUMeet</h3></a>
                </div>
                <div class="rightTitleBar">
                    <a href="edit.php"><h4 class="menuItem inactiveMenuItem">Edit Profile</h4></a>
                    <a href="signout.php"><h4 class="menuItem inactiveMenuItem">Sign Out</h4></a>
                </div>
            </div>
        </div>
    </header>
    <body>
        <div class="findSection">
            <h1 class="title">Find New People</h1>
            <div class="peopleSection">
                <?php
                    /* Get page number */
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
                    
                    /* Info for pagination limits */
                    $recordLimit = 10;
                    $offset = ($pageno-1) * $recordLimit;

                    /* Get total items we have in db */
                    $totalQuery = $connection->prepare("SELECT COUNT(*) FROM Users");
                    $totalResult = $totalQuery->execute();
                    $total = ceil($totalResult / $recordLimit);

                    /* Get users with pagination */
                    $pageQuery = $connection->prepare("SELECT FirstName, LastName, Bio, UserId FROM Users ORDER BY RAND() LIMIT :offset, :recordLimit");
                    $pageQuery->bindParam("offset", $offset, PDO::PARAM_INT);
                    $pageQuery->bindParam("recordLimit", $recordLimit, PDO::PARAM_INT);
                    $pageResult = $pageQuery->execute();
                    /* Display users */
                    while ($findRow = $pageQuery->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="personContainer">
                            <img class="personImage" src="https://images.unsplash.com/photo-1584799235813-aaf50775698c?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&dl=zheka-boychenko-vPkTWyTgk8E-unsplash.jpg"/>
                            <div class="personInfoContainer">
                                <div class="titleContainer">
                                    <h2 class="itemTitle"><?php echo $findRow['FirstName']?> <?php echo $findRow['LastName'] ?></h2>
                                    <button class="matchButton">Match</button>
                                </div>
                                <p class="personBio"><?php echo $findRow['Bio']?></p>
                                <ul style="list-style-type:none;">
                                    <?php
                                        /* Get user answers to quiz */
                                        $quizQuery = $connection->prepare(
                                            "SELECT Questions.QuestionText, AnswerOptions.AnswerOptionText FROM Users 
                                                INNER JOIN UserAnswers ON Users.UserId = UserAnswers.UserID
                                                INNER JOIN Questions ON UserAnswers.QuestionId = Questions.QuestionId
                                                INNER JOIN AnswerOptions ON UserAnswers.AnswerOptionId = AnswerOptions.AnswerOptionId AND UserAnswers.QuestionId = AnswerOptions.QuestionId
                                                WHERE Users.UserId = :UserId
                                            ");
                                        $quizQuery->bindParam("UserId", $findRow['UserId'], PDO::PARAM_STR);
                                        $quizResult = $quizQuery->execute();

                                        /* Display quiz answers */
                                        while ($quizRow = $quizQuery->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                            <li><b><?php echo $quizRow['QuestionText']?>:</b> <?php echo $quizRow['AnswerOptionText']?></li>
                                        <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <ul style="list-style-type:none;">
                    <li style="<?php if($pageno <= 1){ /* Do not display if page is <= 1 */ echo 'display: none'; } ?>">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                    </li>
                    <li style="<?php if($pageno >= $total_pages){ /* Do not display if page is >= total */  echo 'display: none'; } ?>">
                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
    <footer>
        <div class="footerLinks">
            <a href="php/about.php">About</a>
            <a href="php/privacy.php">Privacy</a>
            <a href="php/tos.php">Terms of Use</a>
        </div>
    </footer>
</html>
