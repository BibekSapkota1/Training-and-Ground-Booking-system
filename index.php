<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            /* Light gray background */
        }


        /* Centered content with green background */
        .background-green {
            background-color: #4CAF50;
            /* Green background */
            color: #fff;
            /* White text */
            padding: 30px;

        }

        .background-green h1 {
            font-size: 2.5rem;
            /* Larger font size for heading */
            margin-bottom: 20px;
            /* Spacing below heading */
        }

        .background-green p {
            font-size: 1.1rem;
            /* Font size for paragraphs */
            line-height: 1.6;
            /* Line height for better readability */
        }

        .color-green {
            color: White;
            /* Green text color */
        }
    </style>
</head>

<body>
    <?php
    @include 'includes/navbar.php';
    @include 'includes/modal.php';
    @include 'includes/slider.php';
    ?>
    <div class="background-green">
        <div class="container">
            <div class="text-center mt-5 ">
                <h1 class="color-green">CLUB CRICKET ACADEMY</h1>
                <p>SUPPORTS YOUR CLUB</p>
                <p>Local clubs are the grass roots of cricket, setting many on their way to a long innings in the game!
                    We
                    are
                    proud to be partnering with many local clubs and as the academy prospers we reinvest in these
                    pivotal
                    relationships.</p>
            </div>
        </div>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright: Cricket Association
    </div>
</body>

</html>