<?php session_start();

// if (isset($_SESSION['admin_name'])) {
//     header('Location:../admin_page.php');
//     exit; // Stop executing the rest of the code
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="Css/navbarUser.css" rel="stylesheet">
    <!-- <style>
        body,
        .navbar,
        .nav-link {
            font-family: 'Poppins', sans-serif;
        }



        body {
            padding-top: 0px;
        }

        .navbar {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
        }

        .nav-link {
            position: relative;
            color: rgba(0, 0, 0, 0.7) !important;
            transition: color 0.2s ease-in-out;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 5px;
            width: 100%;
            height: 3px;
            background-color: green;
            transform: scaleX(0);
            transition: transform 0.2s ease-in-out;
            transform-origin: bottom right;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .nav-link:hover {
            color: rgba(0, 0, 0, 0.7) !important;
            background-color: transparent !important;
        }

        .navbar-brand:hover {
            background-color: transparent !important;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:hover {
            background-color: transparent !important;
        }

        .nav-item {
            margin-right: 10px;
        }

        .navbar-brand img {
            max-width: 125px;
            height: auto;
        }
    </style> -->
</head>

<body>

    <?php

    // //   Check if a specific session variable is set
    // if (isset($_SESSION['admin_name'])) {
    //     // Admin session is active
    //     echo "Admin session is active";
    // } elseif (isset($_SESSION['user_name'])) {
    //     //   User session is active
    //     echo "User session is active";
    // } else {
    //     //  No session is active
    //     echo "No session is active";
    // }
    ?>





    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" aria-controls="navbarExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php" style="color: black;">Home</a>
                    </li>

                    <?php if (isset($_SESSION['user_name'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Booking.php" style="color: black;">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Booking_Details.php" style="color: black;">Booking Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Registration.php" style="color: black;">Registration</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                aria-haspopup="true" aria-expanded="false" style="color: black;">
                                My Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profile.php" style="color: black;">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="change-password.php" style="color: black;">Change
                                    Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="userAuth/logout.php" style="color: black;">Logout</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="UserAuth/login.php" class="btn btn-outline-dark ml-lg-3 mt-lg-0 mt-3 mb-lg-0 mb-3">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toggler = document.querySelector('.navbar-toggler');
            var navbarCollapse = document.querySelector('#navbarExample');

            toggler.addEventListener('click', function () {
                navbarCollapse.classList.toggle('collapse');
                navbarCollapse.classList.toggle('show');
            });

            // Custom dropdown
            var dropdown = document.querySelector('.dropdown-toggle');
            var dropdownMenu = document.querySelector('.dropdown-menu');

            dropdown.addEventListener('click', function () {
                dropdownMenu.classList.toggle('show');
            });
        });
    </script>
</body>

</html>