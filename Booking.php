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
$sql = "SELECT * FROM ground";
$result = mysqli_query($conn, $sql);

?>


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
                echo '<h3>' . $row['groundName'] . '</h3>';
                echo '<p>Price: ' . $row['price'] . '</p>';
                echo '<p>Time: ' . $row['time'] . '</p>';
                echo '<p>Width: ' . $row['width'] . '</p>';
                echo '<p>Length: ' . $row['length'] . '</p>';
                echo '<p>Lights: ' . ($row['lights'] ? 'Available' : 'Not Available') . '</p>';
                echo '<p>Scoreboard: ' . ($row['scoreboard'] ? 'Available' : 'Not Available') . '</p>';
                echo '</div>';
                echo '<a href="Booking_step/DateBooking.php?category=GroundBooking&ground=' . urlencode($row['groundName']) . '" class="select-button">BOOK</a>';
                echo '</div>';
            }
            ?>
        </div>
        <div id="privateCoachingSelection" class="appointment-form" style="display: none;">
            <h2>Private Coaching Available Soon...</h2>
        </div>
    </div>
</div>

<script src="Javascript/booking.js"></script>


</body>

</html>