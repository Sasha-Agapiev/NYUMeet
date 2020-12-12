<?php
    if (isset($_POST['edit'])) {
        /* Get info from forms */
        $bio = $_POST['bio'];
        $snap = $_POST['snap'];
        $zoom = $_POST['zoom'];
        $instagram = $_POST['instagram'];
        
        $userId = $_SESSION['UserId'];

        /* Update user info */
        $userQuery = $connection->prepare(
            "UPDATE Users SET Bio = :bio, Snapchat = :snap, Zoom = :zoom, Instagram = :instagram, finishedSetup = True WHERE UserId = :userId"
        );
        $userQuery->bindParam("bio", $bio, PDO::PARAM_STR);
        $userQuery->bindParam("snap", $snap, PDO::PARAM_STR);
        $userQuery->bindParam("zoom", $zoom, PDO::PARAM_STR);
        $userQuery->bindParam("instagram", $instagram, PDO::PARAM_STR);
        $userQuery->bindParam("userId", $userId, PDO::PARAM_STR);

        $userResult = $userQuery->execute();

        /* For each question we check if the user had previously answered it */
        $UserId = $_SESSION['UserId'];
        foreach($questionResults as $questionRow) {
            /* Query to see if answer exists */
            $answerExistsQuery = $connection->prepare("SELECT * FROM UserAnswers WHERE UserId=:UserId AND QuestionId=:QuestionId");
            $answerExistsQuery->bindParam("UserId", $UserId, PDO::PARAM_STR);
            $answerExistsQuery->bindParam("QuestionId", $questionRow['QuestionId'], PDO::PARAM_STR);
            $answerExistsResult = $answerExistsQuery->execute();

            /* if answer does not exist then insert a new answer */
            if ($answerExistsQuery->rowCount() == 0) {
                $addAnswerQuery = $connection->prepare("INSERT INTO UserAnswers(UserId, QuestionId, AnswerOptionId) VALUES (:UserId, :QuestionId, :AnswerOptionId)");
                $addAnswerQuery->bindParam("UserId", $UserId, PDO::PARAM_STR);
                $addAnswerQuery->bindParam("QuestionId", $questionRow['QuestionId'], PDO::PARAM_STR);
                $addAnswerQuery->bindParam("AnswerOptionId", $_POST[$questionRow['QuestionId']], PDO::PARAM_STR);
                $addAnswerResult = $addAnswerQuery->execute();
            } else {
                /* Else update existing answer */
                $addAnswerQuery = $connection->prepare("UPDATE UserAnswers SET AnswerOptionId = :AnswerOptionId WHERE UserId = :UserId AND QuestionId = :QuestionId");
                $addAnswerQuery->bindParam("UserId", $UserId, PDO::PARAM_STR);
                $addAnswerQuery->bindParam("QuestionId", $questionRow['QuestionId'], PDO::PARAM_STR);
                $addAnswerQuery->bindParam("AnswerOptionId", $_POST[$questionRow['QuestionId']], PDO::PARAM_STR);
                $addAnswerResult = $addAnswerQuery->execute();
            }
        }
        
        /* Display errors if needed */
        if (!$userResult or !$addAnswerResult or !$answerExistsResult) {
            echo '<p class="error">Please try again later</p>';
        }
    }
?>
