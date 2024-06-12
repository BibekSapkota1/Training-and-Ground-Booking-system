<?php
// Start the session
// session_start();

// // Check if the user is logged in
// if (isset($_SESSION['user_name'])) {
//     // User is logged in, retrieve user_id from session
//     $user_id = $_SESSION['user_name'];
//     echo "User ID: $user_id";

// } elseif (isset($_SESSION['admin_name'])) {
//     // User is logged in, retrieve user_id from session
//     $user_id = $_SESSION['admin_name'];
//     echo "User ID: $user_id";


// } else {
//     // User is not logged in
//     echo "User is not logged in.";
// }
// ?>


<!-- <a class="dropdown-item" href="logout.php" style="color: black;">Logout</a> -->

<?php

@include 'dbConnect.php';

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
            header('location:index.php');
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
    <link rel="stylesheet" href="Css/registerUser.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



</head>

<body>
    <div class="wrapper" style="background-image: url('pictures/bg-registration-form-2.jpg');">
        <div class="container">
            <div class="form-container">
                <div class="where">
                    <form action="" method="post">
                        <h3 class="text-center">Login</h3>
                        <?php
                        if (isset($error)) {
                            foreach ($error as $error) {
                                echo '<span class="error-msg">' . $error . '</span>';
                            }
                        }
                        ?>
                        <div class="form-group">
                            <!-- <label for="">Email</label> -->
                            <input type="email" name="email" class="textbox" required placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <!-- <label for="">Email</label> -->
                            <input type="password" name="password" class="textbox" required
                                placeholder="Enter your email">
                        </div>
                        <!-- <input type="email" name="email" class="textbox" required placeholder="Enter your email">
                    <input type="password" name="password" class="textbox" required placeholder="Enter your password"> -->
                        <input type="submit" name="submit" class="button" value="Login Now" class="form-btn">
                        <p class="text-center mt-3">Don't have an account? <a href="UserAuth/register.php">Register
                                Now</a></p>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>