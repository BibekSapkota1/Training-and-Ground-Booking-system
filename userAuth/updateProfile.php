<?php
include '../dbConnect.php';
session_start();

// Check if user ID is set in session
if (!isset($_SESSION['user_name'])) {
    header('location:../pageNotFound.php');
    exit;
}

// User ID from session
$userID = $_SESSION['user_name'];

// Get form data
$name = mysqli_real_escape_string($conn, $_POST['userName']);
$address = mysqli_real_escape_string($conn, $_POST['userAddress']);
$phoneNumber = mysqli_real_escape_string($conn, $_POST['userPhone']);
$dateOfBirth = mysqli_real_escape_string($conn, $_POST['userDOB']);
$sex = mysqli_real_escape_string($conn, $_POST['userSex']);

// Update user data query with prepared statement to prevent SQL injection
$sql = "UPDATE users SET name = ?, address = ?, phoneNumber = ?, dateOfBirth = ?, sex = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $name, $address, $phoneNumber, $dateOfBirth, $sex, $userID);

if ($stmt->execute()) {
    header('location: ../Profile.php'); // Redirect back to the profile page
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>