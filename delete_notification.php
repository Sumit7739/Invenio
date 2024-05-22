<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

include('config.php');

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $notificationId = $data['id'];

    // Delete the notification from the database
    $sql = "DELETE FROM updates WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $notificationId, $_SESSION['id']);

    if (mysqli_stmt_execute($stmt)) {
        // Notification deleted successfully
        echo json_encode(['success' => true]);
    } else {
        // Error deleting notification
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid input
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

mysqli_close($conn);
?>
