<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}

include('config.php');

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $notificationId = $data['id'];
    
    // Update the notification to mark it as read
    $sql = "UPDATE updates SET readtext = 1 WHERE id = ? AND user_id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ii", $notificationId, $_SESSION['id']);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Success response
        echo json_encode(['success' => true]);
    } else {
        // Error response
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Invalid input response
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

// Close the database connection
mysqli_close($conn);
?>



