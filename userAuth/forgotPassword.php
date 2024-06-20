<?php
@include '../dbConnect.php';

if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Check if the user exists with the provided email and phoneNumber
        $select = "SELECT * FROM users WHERE email = ? AND phoneNumber = ?";
        $stmt = $conn->prepare($select);
        $stmt->bind_param("ss", $email, $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the user's password
            $update = "UPDATE users SET password = ? WHERE email = ? AND phoneNumber = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("sss", $hashed_password, $email, $phoneNumber);
            $stmt->execute();

            $success = "Password updated successfully!";
            header('Location: login.php');
        } else {
            $error[] = "Invalid email or phone number!";
        }
    } else {
        $error[] = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../Css/login.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Reset Password</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $errorMsg) {
                    echo '<span class="error-msg">' . $errorMsg . '</span>';
                }
            }
            if (isset($success)) {
                echo '<span class="success-msg">' . $success . '</span>';
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="text" name="phoneNumber" required placeholder="Enter your phone number">
            <input type="password" name="new_password" required placeholder="Enter new password">
            <input type="password" name="confirm_password" required placeholder="Confirm new password">
            <input type="submit" name="reset" value="Reset Password" class="form-btn">
        </form>
    </div>
</body>

</html>