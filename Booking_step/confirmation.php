<?php
session_start(); // Start the session

// Include the database connection file
include '../dbConnect.php';

// Check if the connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $booking_name = $_POST['booking_name'] ?? '';
    $category = $_POST['category'] ?? '';
    $ground = $_POST['ground'] ?? '';
    $booking_date = $_POST['booking_date'] ?? '';

    // Check if user is logged in and retrieve user_id from session
    if (isset($_SESSION['user_name'])) {
        $user_id = $_SESSION['user_name'];

        // Debugging - Check retrieved data
        echo "<pre>";
        echo "Booking Name: $booking_name\n";
        echo "Category: $category\n";
        echo "Ground: $ground\n";
        echo "Booking Date: $booking_date\n";
        echo "User ID: $user_id\n";
        echo "</pre>";

        // Check if all required data is available
        if ($booking_name && $category && $ground && $booking_date) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO bookings (booking_name, category, ground, booking_date, user_id) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssssi", $booking_name, $category, $ground, $booking_date, $user_id);
                $stmt->execute();
                $stmt->close();
                // Redirect to recent bookings page with a success message
                echo '<script>alert("Booking confirmed successfully!"); window.location.href = "../Booking_Details.php";</script>';
                exit; // Terminate script execution after redirection
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: Missing form data.";
        }
    } else {
        echo "Error: User not logged in.";
    }
} else {
    // Retrieve GET data for initial display
    $category = $_GET['category'] ?? '';
    $ground = $_GET['ground'] ?? '';
    $booking_date = $_GET['booking_date'] ?? '';
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="../css/Booking.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="margins">
        <div class="container">
            <div class="steps">
                <div class="step">Choose Appointment</div>
                <div class="step">Date Booking</div>
                <div class="step active">Confirmation</div>
            </div>
            <div class="confirmation">
                <h2>Confirm Your Booking</h2>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($category); ?></p>
                <p><strong>Ground:</strong> <?php echo htmlspecialchars($ground); ?></p>
                <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking_date); ?></p>
                <form action="" method="POST">
                    <label for="booking_name"><strong>Alternative Booking Name:</strong></label>
                    <input type="text" id="booking_name" name="booking_name" required>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                    <input type="hidden" name="ground" value="<?php echo htmlspecialchars($ground); ?>">
                    <input type="hidden" name="booking_date" value="<?php echo htmlspecialchars($booking_date); ?>">
                    <div class="button-container">
                        <button type="submit" class="confirm-button">Confirm Booking</button>

                        <a href="../Booking.php" class="cancel-button">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>