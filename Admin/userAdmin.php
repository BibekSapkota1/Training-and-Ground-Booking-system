<?php
@include '../dbConnect.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../pageNotFound.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <?php
    @include 'NavbarAdmin.php';
    ?>

    <div class="container">
        <h1 class="header-title  mt-3">List of Users</h1>
        <div class="container-slide">
            <?php


            $sql = "SELECT ID, name, address, email, phoneNumber, dateOfBirth, sex, password, userType, createdAt FROM users WHERE userType = 'user'";
            $result = $conn->query($sql);
            ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date Of Birth</th>
                        <th>Sex</th>
                        <th>User Type</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row["ID"]); ?></td>
                                <td><?= htmlspecialchars($row["name"]); ?></td>
                                <td><?= htmlspecialchars($row["address"]); ?></td>
                                <td><?= htmlspecialchars($row["email"]); ?></td>
                                <td><?= htmlspecialchars($row["phoneNumber"]); ?></td>
                                <td><?= htmlspecialchars($row["dateOfBirth"]); ?></td>
                                <td><?= htmlspecialchars($row["sex"]); ?></td>
                                <td><?= htmlspecialchars($row["userType"]); ?></td>
                                <td>
                                    <?php
                                    $createdAt = $row["createdAt"];
                                    $timestamp = strtotime($createdAt);
                                    if ($timestamp === false) {
                                        echo "Invalid date";
                                    } else {
                                        echo htmlspecialchars(date("Y-m-d H:i:s", $timestamp));
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9">0 results</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    $conn->close();
    ?>

</body>

</html>