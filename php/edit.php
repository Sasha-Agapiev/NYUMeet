<?php include('processing/config.php') ?>
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
        <link rel="stylesheet" href="../css/form.css">

        <!-- Favicon and Site Title -->
        <title>NYUMeet</title>
    </head>

    <header>
        <div>
            <div class="titleBar">
                <div class="leftTitleBar">
                </div>
                <div class="middleTitleBar">
                    <a href="../index.php"><h3 class="titleBrand">NYUMeet</h3></a>
                </div>
                <div class="rightTitleBar">
                    <h4 class="menuItem activeMenuItem">Sign Out</h4>
                </div>
            </div>
        </div>
    </header>

    <body>
        <div class="formSection">
            <?php
                $query = $connection->prepare("SELECT Questions.QuestionId, Questions.QuestionText FROM Questions GROUP BY Questions.QuestionId");

                $query->execute();
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {?>
                    <h4 class="text"><?php echo $row['QuestionText']; ?></h4>
                    <select name="q1" id="q1">
                        <option disabled selected value/>
                        <?php
                            $options = $connection->prepare("SELECT AnswerOptions.AnswerOptionId, AnswerOptions.AnswerOptionText FROM AnswerOptions WHERE AnswerOptions.QuestionId = :QuestionId");
                            $options->bindParam("QuestionId", $row['QuestionId'], PDO::PARAM_STR);
                            $options->execute();
                            while ($optionRow = $options->fetch(PDO::FETCH_ASSOC)) {?>
                                <option value=1> <?php echo $optionRow["AnswerOptionText"] ?> </option>
                            <?php } ?>
                    </select>
                <?php } ?>
    
            <h4 class="text">Give a quick bio about yourself</h4>
            <textarea maxlength=512 cols=100 rows=8 id="bio" name="bio" placeholder="Tell others about yourself! Some things to talk about are your interests, what you want in a friendship, your favorite tv show, or your favorite activity!"></textarea>

            <h4 class="text">Snapchat Username</h4>
            <input type="text" placeholder="Enter Snapchat Username" name="snap" required>

            <h4 class="text">Zoom Username</h4>
            <input type="text" placeholder="Enter Zoom Username" name="zoom" required>

            <h4 class="text">Instagram Username</h4>
            <input type="text" placeholder="Enter Instagram Username" name="instagram" required>

            <button class="buttonSubmit">Submit</button>
        </div>
    </body>
</html>