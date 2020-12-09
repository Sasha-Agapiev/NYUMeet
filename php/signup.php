<?php
    include('processing/config.php');
    include('processing/signupProcessing.php');
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
                </div>
            </div>
        </div>
    </header>

    <body>
        <form method="post" action="signup.php" name="signupForm" class="formSection">
            <h1 class="title">Sign-up</h1>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="firstName"><b>First Name</b></label>
            <input type="text" placeholder="Confirm First Name" name="firstName" required>

            <label for="lastName"><b>Last Name</b></label>
            <input type="text" placeholder="Confirm Last Name" name="lastName" required>

            <label for="password" maxlength="32"><b>Password</b></label>
            <input type="password" placeholder="Enter password" name="password" required>

            <label for="confirm"><b>Confirm Password</b></label>
            <input type="text" placeholder="Confirm password" name="confirm" required>

            <button type="submit" name="register" value="register" class="buttonSubmit">Submit</button>
        </form>
    </body>
</html>