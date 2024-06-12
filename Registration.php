<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: userAuth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available Training Sessions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }

        .trainings-heading {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .trainings-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .training-card {
            width: calc(33.33% - 20px);
            /* Three cards in a row */
            margin: 10px;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .training-card-header {
            background-color: #f2f2f2;
            padding: 10px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .training-card-body {
            padding: 20px;
        }

        .training-card-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .training-card-description {
            margin-bottom: 10px;
        }

        .training-card-enroll {
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .training-card-enroll:hover {
            background-color: #4cae4c;
        }

        @media screen and (max-width: 768px) {
            .training-card {
                width: calc(50% - 20px);
                /* Two cards in a row on smaller screens */
            }
        }

        @media screen and (max-width: 480px) {
            .training-card {
                width: 100%;
                /* One card in a row on extra small screens */
            }
        }

        .message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1 class="trainings-heading">Trainings</h1>

    <div class="trainings-container">
        <?php
        @include 'dbConnect.php';
        @include 'includes/navbar.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data
        $sql = "SELECT id, training_duration, training_time, starting_date, description FROM training_sessions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="training-card">
                    <div class="training-card-header">
                        <h3 class="training-card-title"><?php echo $row["training_duration"]; ?></h3>
                    </div>
                    <div class="training-card-body">
                        <p>Training Time: <?php echo $row["training_time"]; ?></p>
                        <p>Starting Date: <?php echo $row["starting_date"]; ?></p>
                        <p class="training-card-description" style="text-align: justify;"><?php echo $row["description"]; ?></p>
                        <form method="post" action="">
                            <input type="hidden" name="training_id" value="<?php echo $row['id']; ?>">
                            <button class="training-card-enroll" type="submit" name="enroll">Enroll</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <div class="message">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll'])) {
            @include 'dbConnect.php';

            $training_id = $_POST['training_id'];
            $user_id = $_SESSION['user_name'];

            $check_sql = "SELECT * FROM registration WHERE user_id = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo 'You are already enrolled in a training session.';
            } else {
                // Enroll the user
                $insert_sql = "INSERT INTO registration (user_id, training_id) VALUES (?, ?)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bind_param("ii", $user_id, $training_id);

                if ($stmt->execute()) {
                    echo 'Congratulations, you are enrolled!';
                } else {
                    echo 'There was an error processing your request.';
                }
            }

            $stmt->close();
            $conn->close();

            // header("Location: " . $_SERVER['PHP_SELF']);
            // exit();
        }
        ?>

        <?php
        //Start the session
        // Check if the user is logged in
        if (isset($_SESSION['user_name'])) {
            // User is logged in, retrieve user_id from session
            $user_id = $_SESSION['user_name'];
            echo "User ID: $user_id";

        } elseif (isset($_SESSION['admin_name'])) {
            // User is logged in, retrieve user_id from session
            $user_id = $_SESSION['admin_name'];
            echo "User ID: $user_id";


        } else {
            // User is not logged in
            echo "User is not logged in.";
        }
        ?>
    </div>

</body>

</html>