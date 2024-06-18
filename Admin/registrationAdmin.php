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

// Check if the delete_id parameter is set
if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    // Prepare and execute delete query
    $sql_delete = "DELETE FROM registration WHERE ID = '$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {
        // Redirect to the registration.php page after successful deletion
        header("Location: registrationAdmin.php");
        exit;
    } else {
        // Error in deletion
        echo "Error deleting record: " . $conn->error;
    }
}
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
                    <th>Actions</th>
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
                            <td>
                                <form method="POST" action="registrationAdmin.php" id="deleteForm">
                                    <input type="hidden" name="delete_id" id="delete_id" value="">
                                    <button type="button" class="redbutton"
                                        onclick="confirmDelete(<?php echo $row['ID']; ?>)">Remove</button>
                                </form>
                            </td>
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

    <script src="../Javascript/RegistrationAdmin.js"></script>

</body>

</html>