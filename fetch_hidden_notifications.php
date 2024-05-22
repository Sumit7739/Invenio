<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

include('config.php');

$userID = $_SESSION['id'];

// Fetch hidden notifications
$sql = "SELECT * FROM updates WHERE showupdates = 1 ORDER BY timestamp DESC";
$result = $conn->query($sql);

// Array to store hidden notifications
$hiddenNotifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hiddenNotifications[] = $row;
    }
}

// Close the database connection
$conn->close();

echo json_encode(['success' => true, 'notifications' => $hiddenNotifications]);
?>
