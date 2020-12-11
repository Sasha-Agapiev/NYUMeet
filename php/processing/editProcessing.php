<?php
    if (isset($_POST['submit'])) {
        $bio = $_POST['bio'];
        $bio = $_Post['snap'];
        $bio = $_Post['zoom'];
        $bio = $_Post['instagram'];

        $userId = $_SESSION['UserId'];

        $query = $connection->prepare(
            "UPDATE Users SET Bio = :bio, Snapchat = :snap, Zoom = :zoom, Instagram = :instagram WHERE UserId = :userId"
        );
        $query->bindParam("bio", $bio, PDO::PARAM_STR);
        $query->bindParam("snap", $snap, PDO::PARAM_STR);
        $query->bindParam("zoom", $zoom, PDO::PARAM_STR);
        $query->bindParam("instagram", $instagram, PDO::PARAM_STR);
        $query->bindParam("userId", $userId, PDO::PARAM_STR);

        $result = $query->execute();

        if (!$result) {
            echo '<p class="error">Please try again later</p>';
        }
    }
?>
