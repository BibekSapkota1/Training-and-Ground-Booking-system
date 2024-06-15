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
        $sql = "DELETE FROM grounds WHERE id='$ground_id'";
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
        $ground_id = $_POST['ground_id'];
        $ground_name = $_POST['ground_name'];
        $price = $_POST['price'];
        $times = $_POST['times'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $lights = isset($_POST['lights']) ? 1 : 0;
        $scoreboard = isset($_POST['scoreboard']) ? 1 : 0;

        // Prepare SQL statement based on whether it's an update or insertion
        if ($ground_id) {
            // Update existing record
            $sql = "UPDATE grounds SET 
                ground_name='$ground_name', 
                price='$price', 
                times='$times', 
                width='$width',  
                length='$length', 
                lights='$lights', 
                scoreboard='$scoreboard' 
                WHERE id='$ground_id'";
        } else {
            // Insert new record
            $sql = "INSERT INTO grounds (ground_name, price, times, width, length, lights, scoreboard) 
VALUES ('$ground_name', '$price', '$times', '$width', '$length', '$lights', '$scoreboard')";

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
    <title>Admin Panel - Manage Ground Details</title>
</head>

<body>

    <?php
    @include 'NavbarAdmin.php';
    ?>


    <?php
    // @include 'NavbarAdmin.php';
    ?>
    <div class="container">
        <h1 class="text-center mt-3">Manage Ground Details</h1>
        <div class="container-slide">
            <table id="groundTable">
                <tr>
                    <th>ID</th>
                    <th>Ground Name</th>
                    <th>Price</th>
                    <th>Times</th>
                    <th>Width</th>
                    <th>Length</th>
                    <th>Lights</th>
                    <th>Scoreboard</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Load all records
                $sql = "SELECT * FROM grounds";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['ground_name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['times']; ?></td>
                            <td><?php echo $row['width']; ?></td>
                            <td><?php echo $row['length']; ?></td>
                            <td class="<?php echo $row['lights'] ? 'available' : 'not-available'; ?>">
                                <?php echo $row['lights'] ? 'Available' : 'Not-Available'; ?>
                            </td>
                            <td class="<?php echo $row['scoreboard'] ? 'available' : 'not-available'; ?>">
                                <?php echo $row['scoreboard'] ? 'Available' : 'Not-Available'; ?>
                            </td>
                            <td>
                                <button class="bluebutton"
                                    onclick="editGround(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</button>
                                <button class="redbutton" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No data found</td></tr>";
                }
                ?>
            </table>
        </div>

        <a href="#" id="addNewGroundBtn" onclick="addNewGround()">Add New Ground</a>

        <form class="Groundform" action="" method="POST" id="editForm" style="display: none;">
            <h2 id="formHeading"></h2>
            <input type="hidden" id="ground_id" name="ground_id">
            <label for="ground_name">Ground Name:</label>
            <input type="text" id="ground_name" name="ground_name" required><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required><br>

            <label for="times">Times:</label>
            <input type="text" id="times" name="times" required><br>

            <label for="width">Width:</label>
            <input type="text" id="width" name="width"><br>

            <label for="length">Length:</label>
            <input type="text" id="length" name="length"><br>

            <label for="lights">Lights:</label>
            <input type="checkbox" id="lights" name="lights"><br>

            <label for="scoreboard">Scoreboard:</label>
            <input type="checkbox" id="scoreboard" name="scoreboard"><br>

            <button class="bluebutton" id="submit" type="submit">Save Ground</button>

            <button type="button" class="redbutton" id="cancel" onclick="cancelEdit()">Cancel</button>
        </form>

        <form id="deleteForm" action="" method="POST" style="display: none;">
            <input type="hidden" id="delete_ground_id" name="delete_ground_id">
        </form>



        <script src="../Javascript/GroundAdmin.js"></script>
    </div>

</body>

</html>