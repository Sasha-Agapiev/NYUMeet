<?php
    if (isset($_POST['edit'])) {
        $bio = $_POST['bio'];
        $snap = $_POST['snap'];
        $zoom = $_POST['zoom'];
        $instagram = $_POST['instagram'];
        
        $userId = $_SESSION['UserId'];

        $bioQuery = $connection->prepare(
            "UPDATE Users SET Bio = :bio, Snapchat = :snap, Zoom = :zoom, Instagram = :instagram, finishedSetup = True WHERE UserId = :userId"
        );
        $bioQuery->bindParam("bio", $bio, PDO::PARAM_STR);
        $bioQuery->bindParam("snap", $snap, PDO::PARAM_STR);
        $bioQuery->bindParam("zoom", $zoom, PDO::PARAM_STR);
        $bioQuery->bindParam("instagram", $instagram, PDO::PARAM_STR);
        $bioQuery->bindParam("userId", $userId, PDO::PARAM_STR);

        $bioResult = $bioQuery->execute();

        $UserId = $_SESSION['UserId'];
        foreach($questionResults as $questionRow) {
            $answerExistsQuery = $connection->prepare("SELECT * FROM UserAnswers WHERE UserId=:UserId AND QuestionId=:QuestionId");
            $answerExistsQuery->bindParam("UserId", $UserId, PDO::PARAM_STR);
            $answerExistsQuery->bindParam("QuestionId", $questionRow['QuestionId'], PDO::PARAM_STR);
            $answerExistsResult = $answerExistsQuery->execute();

            if ($answerExistsQuery->rowCount() == 0) {
                $addAnswerQuery = $connection->prepare("INSERT INTO UserAnswers(UserId, QuestionId, AnswerOptionId) VALUES (:UserId, :QuestionId, :AnswerOptionId)");
                $addAnswerQuery->bindParam("UserId", $UserId, PDO::PARAM_STR);
                $addAnswerQuery->bindParam("QuestionId", $questionRow['QuestionId'], PDO::PARAM_STR);
                $addAnswerQuery->bindParam("AnswerOptionId", $_POST[$questionRow['QuestionId']], PDO::PARAM_STR);
                $addAnswerResult = $addAnswerQuery->execute();
            } else {
                $addAnswerQuery = $connection->prepare("UPDATE UserAnswers SET AnswerOptionId = :AnswerOptionId WHERE UserId = :UserId AND QuestionId = :QuestionId");
                $addAnswerQuery->bindParam("UserId", $UserId, PDO::PARAM_STR);
                $addAnswerQuery->bindParam("QuestionId", $questionRow['QuestionId'], PDO::PARAM_STR);
                $addAnswerQuery->bindParam("AnswerOptionId", $_POST[$questionRow['QuestionId']], PDO::PARAM_STR);
                $addAnswerResult = $addAnswerQuery->execute();
            }
        }
        if (!$bioResult or !$addAnswerResult or !$answerExistsResult) {
            echo '<p class="error">Please try again later</p>';
        }
    }
?>
