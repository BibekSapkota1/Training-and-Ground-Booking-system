<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:pageNotFound.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available Training Sessions</title>
    <style>
        /* body {
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
            margin-top: 100px;
        }

        .training-card {
            width: calc(33.33% - 20px);
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
            }
        }

        @media screen and (max-width: 480px) {
            .training-card {
                width: 100%;
            }
        }

        .message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        } */
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
        $sql = "SELECT ID, trainingDurations, tranningTime, startingDate, description FROM training";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="training-card">
                    <div class="training-card-header">
                        <h3 class="training-card-title"><?php echo $row["trainingDurations"]; ?></h3>
                    </div>
                    <div class="training-card-body">
                        <p>Training Time: <?php echo $row["tranningTime"]; ?></p>
                        <p>Starting Date: <?php echo $row["startingDate"]; ?></p>
                        <p class="training-card-description" style="text-align: justify;"><?php echo $row["description"]; ?></p>
                        <form method="post" action="">
                            <input type="hidden" name="training_id" value="<?php echo $row['ID']; ?>">
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

            $check_sql = "SELECT * FROM registration WHERE userId = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo 'You are already enrolled in a training session.';
            } else {
                // Enroll the user
                $insert_sql = "INSERT INTO registration (userId, tranningId) VALUES (?, ?)";
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

    </div>

</body>

</html>