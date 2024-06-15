<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Booking</title>
    <!-- <link rel="stylesheet" href="../css/Booking.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* .date-selection {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        .date-selection h2 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        } */
    </style>
</head>

<body>

    <div class="margins">
        <div class="container">
            <div class="steps">
                <div class="step">Choose Appointment</div>
                <div class="step active">Date Booking</div>
                <div class="step">Confirmation</div>
            </div>
            <div class="date-selection">
                <h2>Select a date for your booking</h2>
                <form id="bookingForm" action="CheckAvailability.php" method="POST">
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($_GET['category']); ?>">
                    <input type="hidden" name="ground" value="<?php echo htmlspecialchars($_GET['ground']); ?>">
                    <label for="booking_date">Choose a date:</label>
                    <select id="booking_date_select" name="booking_date_select">
                        <?php
                        $today = strtotime('today');
                        for ($i = 0; $i < 7; $i++) {
                            $date = strtotime("+$i day", $today);
                            echo "<option value='" . date('Y-m-d', $date) . "'>" . date('F j, Y', $date) . "</option>";
                        }
                        ?>
                    </select>
                    <div class="button-container">
                        <button type="submit" class="confirm-button">Book Bate</button>

                        <a href="../Booking.php" class="cancel-button">Cancel</a>
                    </div>
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='error-message'>This ground is already booked for the specific date. Please choose another date or another ground.</div>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>