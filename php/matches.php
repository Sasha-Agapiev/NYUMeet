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
                    <h4 class="menuItem inactiveMenuItem">Sign out</h4>
                </div>
            </div>
        </div>
    </header>

    <body>
        <div class="findSection">
            <h1 class="title">Your Matches</h1>
            <?php
                include('processing/config.php');
                session_start();
                if(!isset($_SESSION['UserId'])){
                    header('Location: signin.php');
                    exit;
                }
                $thisUserId = $_SESSION['UserId'];
                $sql1 = "SELECT UserId1 FROM matches WHERE UserId2 = :thisUserId";
                $stmt1 = $connection->prepare($sql1);
                $stmt1->bind_param("thisUserId", $thisUserId);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                if($result1->num_rows() > 0){
                    while($row = $result1->fetch_assoc()){
                        $matchId = $row["userId1"];
                        $sql2 = "SELECT FirstName, LastName, Username, Bio, Instagram, Snapchat FROM users WHERE UserId = :matchId ";
                        $stmt2 = $connection->prepare($sql2);
                        $stmt2->bind_param("matchId", $matchId);
                        $stmt2->execute();
                        $result2 = $stmt1->get_results();
                        $row2 = $result2->fetch_assoc(); 
                        echo "<tr><td>".$row2["FirstName"]."</td><td>".$row2["LastName"]."</td><td>".$row2["Username"]."</td><td>".$row2["Bio"]."</td><td>".$row2["Instagram"]."</td><td>".$row2["
                        Snapchat"]."</td><td>";
                    }
                    echo "</table>";
                }
                else{
                    echo "No matches at this time :(";
                }
            ?>
            <div class="peopleSection">
                <div class="personContainer">
                    <img class="personImage" src="https://images.unsplash.com/photo-1584799235813-aaf50775698c?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&dl=zheka-boychenko-vPkTWyTgk8E-unsplash.jpg"/>
                    <div class="personInfoContainer">
                        <div class="titleContainer">
                            <h2 class="itemTitle">Eric</h2>
                        </div>
                        <p class="personBio">About me: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vehicula, augue et vehicula facilisis, elit nunc molestie nulla, a convallis mauris mauris sed quam. Etiam vulputate eros eu sapien accumsan, et dignissim magna venenatis. Praesent purus nisi, laoreet id lorem.</p>
                        <h3 class="itemTitle">Contact Info</h3>
                        <p class="personBio">Snapchat: eee012 <br>
                            Instagram: eee012 <br>
                            Zoom: eee012
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
