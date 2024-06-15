<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:pageNotFound.php');
    exit;
}

include 'dbConnect.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch ground details from the database
$sql = "SELECT * FROM grounds";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link rel="stylesheet" href="css/Booking.css">
    <script>
        function showGrounds(category) {
            const groundSelection = document.getElementById('groundSelection');

            // Change the header based on the category
            const header = document.getElementById('groundHeader');
            if (category === 'GroundBooking') {
                header.textContent = 'Available Grounds for Ground Booking';
                groundSelection.style.display = 'block'; // Ensure the groundSelection is visible
            } else if (category === 'PrivateCoaching') {
                header.textContent = 'Private Coaching Available Soon...';
                groundSelection.style.display = 'none'; // Hide the groundSelection
            }
        }
    </script>

</head>

<body>

    <?php
    @include 'includes/navbar.php';
    ?>
    <div class="margins">
        <div class="container">
            <div class="steps">
                <div class="step active">Choose Appointment</div>
                <div class="step">Your Info</div>
                <div class="step">Confirmation</div>
            </div>
            <div class="appointment-form">
                <h2>Choose a category...</h2>
                <button class="appointment-option" onclick="showGrounds('GroundBooking')">
                    <div class="option-text">Ground Booking</div>
                    <div class="select-button">SELECT</div>
                </button>
                <button class="appointment-option" onclick="showGrounds('PrivateCoaching')">
                    <div class="option-text">Private Coaching / 1 to 1</div>
                    <div class="select-button">SELECT</div>
                </button>
            </div>
            <div id="groundSelection" class="appointment-form" style="display: none;">
                <h2 id="groundHeader"></h2>
                <?php
                // Loop through each ground and display its information
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="ground-option">';
                    echo '<div class="option-text">';
                    echo '<h3>' . $row['ground_name'] . '</h3>';
                    echo '<p>Price: ' . $row['price'] . '</p>';
                    echo '<p>Time: ' . $row['times'] . '</p>';
                    echo '<p>Width: ' . $row['width'] . '</p>';
                    echo '<p>Length: ' . $row['length'] . '</p>';
                    echo '<p>Lights: ' . ($row['lights'] ? 'Available' : 'Not Available') . '</p>';
                    echo '<p>Scoreboard: ' . ($row['scoreboard'] ? 'Available' : 'Not Available') . '</p>';
                    echo '</div>';
                    echo '<a href="Booking_step/DateBooking.php?category=GroundBooking&ground=' . urlencode($row['ground_name']) . '" class="select-button">BOOK</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>