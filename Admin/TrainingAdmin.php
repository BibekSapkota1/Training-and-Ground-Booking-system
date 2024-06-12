<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Training Form</title>
    <style>
    </style>
</head>

<body>

    <?php
    include '../dbConnect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO training_sessions (training_duration, training_time, starting_date, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $training_duration, $training_time, $starting_date, $description);

        // Set parameters and execute
        $training_duration = $_POST['training_duration'];
        $training_time = $_POST['training_time'];
        $starting_date = $_POST['starting_date'];
        $description = $_POST['description'];

        if ($stmt->execute()) {
            echo "<script>alert('Submission successful'); window.location.href='TrainingAdmin.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <?php
    @include 'NavbarAdmin.php';
    ?>
    <div class="container">
        <h1 class="header-title  mt-3">Add Training</h1>
        <div class="Training mt-5">
            <form action="" method="post">
                <label for="training_duration">Training Duration :</label><br>
                <input type="text" id="training_duration" name="training_duration" required><br><br>

                <label for="training_time">Training Time :</label><br>
                <input type="text" id="training_time" name="training_time" required
                    pattern="^[0-9]{1,2}-[0-9]{1,2}$"><br><br>

                <label for="starting_date">Starting Date:</label><br>
                <input type="date" id="starting_date" name="starting_date" required><br><br>

                <label for="description">Description:</label><br>
                <textarea id="description" name="description"></textarea><br><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>