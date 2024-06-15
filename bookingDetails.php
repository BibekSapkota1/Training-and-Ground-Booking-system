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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Bookings</title>
    <link rel="stylesheet" href="Css/style.css">
    <style>
        /* body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .container {
            padding: 0 15px;
        }

        .containe {
            max-width: 1000px;
            margin: 80px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            white-space: nowrap;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9e9e9;
        }

        tr td:first-child {
            text-align: center;
        }

        @media (max-width: 768px) {
            .containe {
                margin: 70px auto;
                padding: 10px;
            }

            th,
            td {
                padding: 8px;
            }

            table,
            th,
            td {
                font-size: 14px;
            }

            h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .containe {
                margin: 100px auto;
                padding: 5px;
            }

            table,
            th,
            td {
                font-size: 12px;
            }

            h2 {
                font-size: 20px;
            }
        } */
    </style>
</head>

<body>
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