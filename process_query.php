<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or handle unauthorized access
    header('Location: login.php');
    exit();
}

include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID from the session
    $userID = $_SESSION['id'];

    // Get the query text from the form
    $queryText = $_POST['query'];

    // Escape the query text to prevent SQL injection attacks
    $queryText = mysqli_real_escape_string($conn, $queryText);

    // Insert the query into the database with status 0 (not solved)
    $sql = "INSERT INTO query (user_id, query_text, status) VALUES (?, ?, 0)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $userID, $queryText);

    if (mysqli_stmt_execute($stmt)) {
        // Query inserted successfully
        header("Location: success.html");
        exit;
    } else {
        // Error inserting query
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt);
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

mysqli_close($conn);
