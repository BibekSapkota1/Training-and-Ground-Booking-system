<?php

@include '../dbConnect.php';

session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = ($_POST['password']);

    $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['id'];
            $_SESSION['user_type'] = 'admin'; // Setting user type
            header('location:../Admin/NavbarAdmin.php');

        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['id'];
            $_SESSION['user_type'] = 'user'; // Setting user type
            header('location:../index.php');
        }


    } else {
        $error[] = 'Incorrect email or password!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../Css/login.css">


</head>

<body>

    <div class="form-container">

        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register.php">Register Now</a></p>
        </form>

    </div>


</body>

</html>