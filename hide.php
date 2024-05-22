<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['notification_id'])) {
        $notificationID = $_POST['notification_id'];
        $userID = $_SESSION['id'];

        // Get the current state of the notification
        $sql = "SELECT showupdates FROM updates WHERE id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $notificationID, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $currentState);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Toggle the state
        $newState = $currentState == 1 ? 0 : 1;

        // Update the showupdates column to the new state for the specified notification
        $sql = "UPDATE updates SET showupdates = ? WHERE id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $newState, $notificationID, $userID);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true, 'newState' => $newState]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => false, 'error' => 'Notification ID not provided']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

mysqli_close($conn);
?>
