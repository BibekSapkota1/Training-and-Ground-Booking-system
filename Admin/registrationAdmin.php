<?php
@include '../dbConnect.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../pageNotFound.php');
    exit;
}


// Fetch registration data from the database
$sql = "SELECT * FROM registration";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Data</title>
</head>

<body>

    <?php @include 'NavbarAdmin.php'; ?>

    <div class="container">
        <h1 class="text-center mt-3">Registration Data</h1>
        <div class="container-slide">
            <table id="registrationTable">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Training ID</th>
                    <th>Enroll Date</th>
                    <!-- Add more columns as per your registration table structure -->
                </tr>
                <?php
                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['userId']; ?></td>
                            <td><?php echo $row['tranningId']; ?></td>
                            <td><?php echo $row['enrollDate']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No registration data found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>