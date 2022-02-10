<?php

$connection = mysqli_connect('localhost', 'root', '', 'authentication');

$success = NULL;
$error = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $phone = $_REQUEST['phone'];
    $converted_phone = (int)$phone;
    $avatar = $_FILES['avatar'];
    $avatar_name = $avatar['name'];

    if ($username == NULL) {
        $error = "username is required !!";
    } else if ($email == NULL) {
        $error = "email is required !!";
    } else if ($password == NULL) {
        $error = "password is required !!";
    } else if ($phone == NULL) {
        $error = "phone is required !!";
    } else {
        $query = "INSERT INTO `users`(`username`, `email`, `password`, `phone`,`avatar`) VALUES ('$username','$email','$password','$converted_phone','$avatar_name')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $target_dir = 'avatars/';
            $target_file = $target_dir . basename($avatar['name']);
            move_uploaded_file($avatar['tmp_name'], $target_file);
            $success = "signup successfull !!";
        } else {
            $error = "signup failed due to some reason !!";
        }
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
        <a href="login.php" class="log_btn">
            <i class='bx bx-log-in-circle'></i> login
        </a>
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Signup Now</h2>
            <input name="username" type="text" placeholder="Username">
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <input name="phone" type="tel" placeholder="Phone">
            <input type="file" name="avatar" id="avatar" hidden>
            <label for="avatar"><i class='bx bxs-camera'></i> <span>select a photo</span></label>
            <button name="submit" type="submit">submit</button>
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

                header("Location:login.php");
            }

            ?>
        </form>
    </div>
</body>

</html>