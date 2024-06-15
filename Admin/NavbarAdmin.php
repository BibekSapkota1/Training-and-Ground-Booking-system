<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navbar</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../Css/Adminstyle.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Admin Dashboard</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="indexAdmin.php" class="sidebar-link">
                        <i class="bi bi-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="userAdmin.php" class="sidebar-link">
                        <i class="bi bi-person"></i>
                        <span>User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="GroundAdmin.php" class="sidebar-link">
                        <i class="bi bi-map"></i>
                        <span>Add Ground</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="BookingAdmin.php" class="sidebar-link">
                        <i class="bi bi-calendar-check"></i>
                        <span>View Booking</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="TrainingAdmin.php" class="sidebar-link">
                        <i class="bi bi-book"></i>
                        <span>Add Training</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="registrationAdmin.php" class="sidebar-link" data-target="view_registration.php">
                        <i class="bi bi-clipboard"></i>
                        <span>View Registration</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../userAuth/logout.php" class="sidebar-link" data-target="logout.php">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
        <script>
            // Toggle Sidebar
            const hamBurger = document.querySelector(".toggle-btn");
            hamBurger.addEventListener("click", function () {
                document.querySelector("#sidebar").classList.toggle("expand");
            });

        </script>
</body>

</html>