<?php
// Include the database connection file
include '../dbConnect.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../pageNotFound.php');
    exit;
}

$edit_mode = false;
$ground = [
    'ID' => '',
    'groundName' => '',
    'price' => '',
    'time' => '',
    'width' => '',
    'length' => '',
    'lights' => 0,
    'scoreboard' => 0
];

// Check if ID parameter exists in the URL for editing existing ground
if (isset($_GET['id'])) {
    $ground_id = $_GET['id'];
    $edit_mode = true;

    // Fetch the ground record to edit
    $sql = "SELECT * FROM ground WHERE ID='$ground_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $ground = $result->fetch_assoc();
    } else {
        // If no record found with the given ID, redirect back to manage grounds page
        header('location:GroundAdmin.php');
        exit;
    }
}

// Handle form submission for both adding new ground and updating existing ground
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ground_id']) && !empty($_POST['ground_id'])) {
        // Update existing ground
        $ground_id = $_POST['ground_id'];
        $ground_name = $_POST['ground_name'];
        $price = $_POST['price'];
        $time = $_POST['time'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $lights = isset($_POST['lights']) ? 1 : 0;
        $scoreboard = isset($_POST['scoreboard']) ? 1 : 0;

        // Prepare SQL statement for updating ground
        $sql = "UPDATE ground SET 
                    groundName='$ground_name', 
                    price='$price', 
                    time='$time', 
                    width='$width',  
                    length='$length', 
                    lights='$lights', 
                    scoreboard='$scoreboard' 
                    WHERE ID='$ground_id'";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to manage grounds page after successful operation
            header("Location: GroundAdmin.php");
            exit;
        } else {
            echo "Error updating ground: " . $conn->error;
        }
    } else {
        // Add new ground
        $ground_name = $_POST['ground_name'];
        $price = $_POST['price'];
        $time = $_POST['time'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $lights = isset($_POST['lights']) ? 1 : 0;
        $scoreboard = isset($_POST['scoreboard']) ? 1 : 0;

        // Prepare SQL statement for inserting new ground
        $sql = "INSERT INTO ground (groundName, price, time, width, length, lights, scoreboard) 
                    VALUES ('$ground_name', '$price', '$time', '$width', '$length', '$lights', '$scoreboard')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to manage grounds page after successful operation
            header("Location: GroundAdmin.php");
            exit;
        } else {
            echo "Error adding new ground: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $edit_mode ? 'Edit Ground' : 'Add New Ground'; ?> - Admin Panel</title>
</head>

<body>

    <?php
    @include 'NavbarAdmin.php';
    ?>

    <div class="container">
        <h1 class="text-center mt-3"><?php echo $edit_mode ? 'Edit Ground' : 'Add New Ground'; ?></h1>

        <form class="Groundform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php if ($edit_mode): ?>
                <input type="hidden" id="ground_id" name="ground_id" value="<?php echo $ground['ID']; ?>">
            <?php endif; ?>

            <label for="ground_name">Ground Name:</label>
            <input type="text" id="ground_name" name="ground_name" value="<?php echo $ground['groundName']; ?>"
                required><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $ground['price']; ?>" required><br>

            <label for="time">Time:</label>
            <input type="text" id="time" name="time" value="<?php echo $ground['time']; ?>" required><br>

            <label for="width">Width:</label>
            <input type="text" id="width" name="width" value="<?php echo $ground['width']; ?>"><br>

            <label for="length">Length:</label>
            <input type="text" id="length" name="length" value="<?php echo $ground['length']; ?>"><br>

            <label for="lights">Lights:</label>
            <input type="checkbox" id="lights" name="lights" <?php echo $ground['lights'] ? 'checked' : ''; ?>><br>

            <label for="scoreboard">Scoreboard:</label>
            <input type="checkbox" id="scoreboard" name="scoreboard" <?php echo $ground['scoreboard'] ? 'checked' : ''; ?>><br>

            <button class="bluebutton" type="submit"><?php echo $edit_mode ? 'Save Ground' : 'Add Ground'; ?></button>
            <a href="GroundAdmin.php" class="redbutton">Cancel</a>
        </form>
    </div>

</body>

</html>