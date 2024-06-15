<?php
// Include database connection file
include '../dbConnect.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../pageNotFound.php');
    exit;
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if booking ID and confirmation status are set
    if (isset($_POST['booking_id']) && isset($_POST['confirmation_status'])) {
        // Sanitize inputs to prevent SQL injection
        $booking_id = $_POST['booking_id'];
        $confirmation_status = $_POST['confirmation_status'];

        // Prepare SQL statement to update confirmation status and confirmed_at timestamp
        $sql = "UPDATE bookings SET confirmation_status = ?, confirmed_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("si", $confirmation_status, $booking_id);
            if ($stmt->execute()) {
                // Redirect to avoid resubmission
                header("Location: {$_SERVER['PHP_SELF']}");
                exit;
            } else {
                // Error in execution
                echo "Error updating confirmation status: " . $conn->error;
            }
        } else {
            // Error in preparing statement
            echo "Error preparing statement: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Fetch all booking records from the database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Bookings</title>
    <link rel="stylesheet" href="../Css/Adminstyle.css"> <!-- You need to create this CSS file -->
       

</head>

<body>
    <?php
    @include 'NavbarAdmin.php';
    ?>

    <div class="container">
        <h1 class="text-center mt-3">Manage Bookings</h1>
        <div class="container-slide">
            <table>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Booking Name</th>
                    <th>Category</th>
                    <th>Ground</th>
                    <th>Booking Date</th>
                    <th>Booked At</th>
                    <th>Confirmation Status</th>
                    <th>Confirmed At</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]); ?></td>
                            <td><?= htmlspecialchars($row["user_id"]); ?></td>
                            <td><?= htmlspecialchars($row["booking_name"]); ?></td>
                            <td><?= htmlspecialchars($row["category"]); ?></td>
                            <td><?= htmlspecialchars($row["ground"]); ?></td>
                            <td><?= htmlspecialchars($row["booking_date"]); ?></td>
                            <td><?= htmlspecialchars($row["booked_at"]); ?></td>
                            <td>
                                <form id="Bookingform" action="" method="POST">
                                    <input type="hidden" name="booking_id" value="<?= $row["id"]; ?>">
                                    <select  name="confirmation_status">
                                        <option value="yet_to_confirm" <?= ($row["confirmation_status"] == "yet_to_confirm") ? "selected" : ""; ?>>Yet to Confirm</option>
                                        <option value="confirmed" <?= ($row["confirmation_status"] == "confirmed") ? "selected" : ""; ?>>
                                            Confirmed</option>
                                        <option value="canceled" <?= ($row["confirmation_status"] == "canceled") ? "selected" : ""; ?>>
                                            Canceled</option>
                                    </select>
                                    <button id="submit" type="submit">Update</button>
                                </form>
                            </td>
                            <td><?= htmlspecialchars($row["confirmed_at"]); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9">No bookings found</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>

<?php
// Close database connection
$conn->close();
?>