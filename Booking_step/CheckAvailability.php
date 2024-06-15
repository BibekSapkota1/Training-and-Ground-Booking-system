<?php
include '../dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $category = htmlspecialchars($_POST['category']);
    $ground = htmlspecialchars($_POST['ground']);
    $booking_date = htmlspecialchars($_POST['booking_date_select']);

    // Cheking if already booked or not
    $sql = "SELECT * FROM booking WHERE category = ? AND groundName = ? AND bookingDate = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $category, $ground, $booking_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingBooking = $result->fetch_assoc();

    if ($existingBooking) {
        // Date is already booked, redirect back with an error message
        header("Location: Datebooking.php?category=$category&ground=$ground&error=1");
        exit();
    } else {
        // Date is available, redirect to confirmation page
        header("Location: confirmation.php?category=$category&ground=$ground&booking_date=$booking_date");
        exit();
    }
}
?>