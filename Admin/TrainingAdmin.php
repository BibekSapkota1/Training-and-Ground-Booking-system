<?php
@include '../dbConnect.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../pageNotFound.php');
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form submission
    if (isset($_POST['delete_training_id'])) {
        // Handle delete operation
        $training_id = $_POST['delete_training_id'];
        $sql = "DELETE FROM training_sessions WHERE ID='$training_id'";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page after successful deletion
            header("Location: {$_SERVER['PHP_SELF']}");
            exit; // Ensure no further code execution after redirection
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // Handle update or insertion operation
        // Retrieve form data
        $training_id = $_POST['training_id'];
        $training_duration = $_POST['training_duration'];
        $training_time = $_POST['training_time'];
        $starting_date = $_POST['starting_date'];
        $description = $_POST['description'];

        // Prepare SQL statement based on whether it's an update or insertion
        if ($training_id) {
            // Update existing record
            $sql = "UPDATE training SET 
                trainingDurations='$training_duration', 
                tranningTime='$training_time', 
                startingDate='$starting_date', 
                description='$description' 
                WHERE ID='$training_id'";
        } else {
            // Insert new record
            $sql = "INSERT INTO training (trainingDurations, tranningTime, startingDate, description) 
                VALUES ('$training_duration', '$training_time', '$starting_date', '$description')";
        }

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page after successful update or insertion
            header("Location: {$_SERVER['PHP_SELF']}");
            exit; // Ensure no further code execution after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Manage Training Sessions</title>
</head>

<body>

    <?php @include 'NavbarAdmin.php'; ?>

    <div class="container">
        <h1 class="text-center mt-3">Manage Training Sessions</h1>
        <div class="container-slide">
            <table id="trainingTable">
                <tr>
                    <th>ID</th>
                    <th>Training Durations</th>
                    <th>Training Time</th>
                    <th>Starting Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                    <th>CreatedAt</th>
                </tr>
                <?php
                // Load all records
                $sql = "SELECT * FROM training";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['trainingDurations']; ?></td>
                            <td><?php echo $row['tranningTime']; ?></td>
                            <td><?php echo $row['startingDate']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td>
                                <button class="bluebutton"
                                    onclick="editTraining(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</button>
                                <button class="redbutton" onclick="confirmDelete(<?php echo $row['ID']; ?>)">Delete</button>
                            </td>
                            <td><?php echo $row['createdAt']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                ?>
            </table>
        </div>

        <a href="#" id="addNewTrainingBtn" onclick="addNewTraining()">Add New Training Session</a>

        <form class="TrainingForm" action="" method="POST" id="editForm" style="display: none;">
            <h2 id="formHeading"></h2>
            <input type="hidden" id="training_id" name="training_id">
            <label for="training_duration">Training Durations:</label>
            <input type="text" id="training_duration" name="training_duration" required><br>

            <label for="training_time">Training Time:</label>
            <input type="text" id="training_time" name="training_time" required><br>

            <label for="starting_date">Starting Date:</label>
            <input type="date" id="starting_date" name="starting_date" required><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br>

            <button class="bluebutton" id="submit" type="submit">Save Training Session</button>

            <button type="button" class="redbutton" id="cancel" onclick="cancelEdit()">Cancel</button>
        </form>

        <form id="deleteForm" action="" method="POST" style="display: none;">
            <input type="hidden" id="delete_training_id" name="delete_training_id">
        </form>

        <script src="../Javascript/TrainingAdmin.js"></script>
    </div>

</body>

</html>