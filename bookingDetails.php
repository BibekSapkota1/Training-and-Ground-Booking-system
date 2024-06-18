<?php
include 'dbConnect.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:pageNotFound.php');
    exit;
}

// Check if the connection is established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the logged-in user's ID from the session
$user_id = $_SESSION['user_name'];

// Query to fetch recent bookings from the database for the logged-in user
$sql = "SELECT * FROM booking WHERE userId = ? ORDER BY id DESC LIMIT 15";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any bookings
$has_bookings = mysqli_num_rows($result) > 0;

?>

<?php @include 'includes/Navbar.php'; ?>
<div class="container">
    <div class="containe">
        <h2>Recent Bookings</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Category</th>
                        <th>Alternative Name</th>
                        <th>Booked Date</th>
                        <th>Booked Ground</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // If there are bookings, loop through and display them
                    if ($has_bookings) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['ID'] . '</td>';
                            echo '<td>' . $row['category'] . '</td>';
                            echo '<td>' . $row['bookingName'] . '</td>';
                            echo '<td>' . $row['bookingDate'] . '</td>';
                            echo '<td>' . $row['groundName'] . '</td>';
                            echo '<td>' . $row['confirmationStatus'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        // If no bookings found, display a single row with a message
                        echo '<tr><td colspan="6" style="text-align:center;">No bookings found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>