<?php

session_start();

if (!isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== true) {
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="welcome">
        <a href="logout.php" class="logout">
            <i class='bx bx-log-out-circle'></i> logout
        </a>
        <div class="welcome_banner">
            <img src="./images/welcome.svg" alt="">
            <h1>Hello , <span><?php echo $_SESSION['username'] ?></span></h1>
        </div>
    </div>
</body>

</html>