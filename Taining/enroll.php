<?php
@include 'dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $training_id = $_POST['training_id'];
    $user_id = 1; // Replace this with the actual user ID, typically retrieved from session data.

    // Check if the user is already enrolled
    $check_sql = "SELECT * FROM user_enrollments WHERE user_id = ? AND training_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $training_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'You have already enrolled in this training session.']);
    } else {
        // Enroll the user
        $insert_sql = "INSERT INTO user_enrollments (user_id, training_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ii", $user_id, $training_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Congratulations, you are enrolled!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'There was an error processing your request.']);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
