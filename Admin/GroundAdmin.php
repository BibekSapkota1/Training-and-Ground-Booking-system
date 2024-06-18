<?php
// Include the database connection file
@include '../dbConnect.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../pageNotFound.php');
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form submission
    if (isset($_POST['delete_ground_id'])) {
        // Handle delete operation
        $ground_id = $_POST['delete_ground_id'];
        $sql = "DELETE FROM ground WHERE ID='$ground_id'"; // Updated column name
        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page after successful deletion
            header("Location: {$_SERVER['PHP_SELF']}");
            exit; // Ensure no further code execution after redirection
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Load all records
$sql = "SELECT * FROM ground";
$result = $conn->query($sql);
$grounds = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grounds[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Manage Ground Details</title>
</head>

<body>

    <?php @include 'NavbarAdmin.php'; ?>

    <div class="container">
        <h1 class="text-center mt-3">Manage Ground Details</h1>
        <div class="container-slide">
            <table id="groundTable">
                <tr>
                    <th>ID</th>
                    <th>Ground Name</th>
                    <th>Price</th>
                    <th>Time</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Lights</th>
                    <th>Scoreboard</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($grounds as $ground): ?>
                    <tr>
                        <td><?php echo $ground['ID']; ?></td>
                        <td><?php echo $ground['groundName']; ?></td>
                        <td><?php echo $ground['price']; ?></td>
                        <td><?php echo $ground['time']; ?></td>
                        <td><?php echo $ground['width']; ?></td>
                        <td><?php echo $ground['length']; ?></td>
                        <td class="<?php echo $ground['lights'] ? 'available' : 'not-available'; ?>">
                            <?php echo $ground['lights'] ? 'Available' : 'Not-Available'; ?>
                        </td>
                        <td class="<?php echo $ground['scoreboard'] ? 'available' : 'not-available'; ?>">
                            <?php echo $ground['scoreboard'] ? 'Available' : 'Not-Available'; ?>
                        </td>
                        <td>
                            <a class="bluebutton" href="edit_ground.php?id=<?php echo $ground['ID']; ?>">Edit</a>
                            <form id="deleteForm" style="display: inline-block;" method="POST"
                                action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" id="delete_ground_id" name="delete_ground_id" value="">
                                <button type="button" class="redbutton"
                                    onclick="confirmDelete(<?php echo $ground['ID']; ?>)">Delete</button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <a href="edit_ground.php" id="addNewGroundBtn">Add New Ground</a>

    </div>

    <script src="../Javascript/GroundAdmin.js"></script>
</body>

</html>