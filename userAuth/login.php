<?php
@include '../dbConnect.php';

session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Select user with the provided email
    $select = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $row['password'])) {
            // Password is correct
            if ($row['userType'] == 'admin') {
                $_SESSION['admin_name'] = $row['ID'];
                $_SESSION['userType'] = 'admin'; // Setting user type
                header('location: ../Admin/indexAdmin.php');
                exit;
            } elseif ($row['userType'] == 'user') {
                $_SESSION['user_name'] = $row['ID'];
                $_SESSION['userType'] = 'user'; // Setting user type
                header('location: ../index.php');
                exit;
            }
        } else {
            // Password is incorrect
            $error[] = 'Incorrect email or password!';
        }
    } else {
        // No user found with the provided email
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
                foreach ($error as $errorMsg) {
                    echo '<span class="error-msg">' . $errorMsg . '</span>';
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