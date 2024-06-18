<?php
include 'dbConnect.php';
// Start session (if not already started)
session_start();

// Check if user ID is set in session
if (!isset($_SESSION['user_name'])) {
    header('location:pageNotFound.php');
    exit;
}

// User ID from session
$userID = $_SESSION['user_name'];

// Create connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data query with prepared statement to prevent SQL injection
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID); // "i" indicates the type of the parameter (integer)
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // Fetch associative array (associative array where key is the column name)
    $user = $result->fetch_assoc();
} else {
    die("User not found."); // Handle case where user ID does not exist
}

// Close statement and connection
$stmt->close();
$conn->close();

@include 'includes/navbar.php';
?>

<div class="container" id="user-profile">
    <h1 class="text-center mb-4">User Profile</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form>
                <div class="form-group">
                    <label for="userID">User ID</label>
                    <input type="text" class="form-control" id="userID" value="<?php echo $user['ID']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="userName">Name</label>
                    <input type="text" class="form-control" id="userName" value="<?php echo $user['name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="email" class="form-control" id="userEmail" value="<?php echo $user['email']; ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="userAddress">Address</label>
                    <input type="text" class="form-control" id="userAddress" value="<?php echo $user['address']; ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="userPhone">Phone Number</label>
                    <input type="tel" class="form-control" id="userPhone" value="<?php echo $user['phoneNumber']; ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="userDOB">Date of Birth</label>
                    <input type="text" class="form-control" id="userDOB" value="<?php echo $user['dateOfBirth']; ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="userSex">Sex</label>
                    <input type="text" class="form-control" id="userSex" value="<?php echo $user['sex']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="createdat">Created At</label>
                    <input type="text" class="form-control" id="userSex" value="<?php echo $user['createdAt']; ?>"
                        readonly>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>