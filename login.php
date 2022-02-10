<?php

$error = NULL;
$success = NULL;

session_start();

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){
    header("Location:welcome.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connect = mysqli_connect('localhost', 'root', '', 'authentication');
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $user = mysqli_fetch_assoc($result);
        $success = "login successfully";
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location:welcome.php");
    } else {
        $error = "email or password maybe wrong";
    }
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
    <!-- signup form -->
    <div class="signup">
        <a href="index.php" class="log_btn">
            <i class='bx bx-log-in-circle'></i> signup
        </a>
        <form action="" method="POST">
            <h2>Login Now</h2>
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <button type="submit">submit</button>
            <?php

            if ($error) {

            ?>
                <div class="alert danger"><?php echo $error ?></div>
            <?php

            }

            ?>
            <?php

            if ($success) {

            ?>
                <div class="alert success"><?php echo $success ?></div>

            <?php
            }

            ?>
        </form>
    </div>
</body>

</html>