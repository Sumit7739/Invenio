<?php
// Start the session
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}

// Include the database connection file
include('config.php');

// Get the user ID from the session
$userID = $_SESSION['id'];

// Get the update text from the form
$updateText = $_POST['updates'];

// Escape the update text to prevent SQL injection attacks
$updateText = mysqli_real_escape_string($conn, $updateText);

// Prepare the SQL query to insert the update
$sql = "INSERT INTO updates (user_id, update_text) VALUES (?, ?)";

// Prepare the statement
$stmt = mysqli_prepare($conn, $sql);

// Bind the parameters
mysqli_stmt_bind_param($stmt, "is", $userID, $updateText);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    // Update was successful
    header("Location: success.html");
        exit;
    // var_dump($userID);
    // var_dump($updateText);
} else {
    // Update failed
    echo "Error submitting update: " . mysqli_error($conn);
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>