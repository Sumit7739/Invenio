<?php
session_start();

// Database connection parameters
include 'config.php';

// Check if the request is an AJAX request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Check if the required parameters are received
    if (isset($_POST['user_id'], $_POST['access_level'])) {
        $userId = $_POST['user_id'];
        $accessLevel = $_POST['access_level'];

        // Attempt database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the current user is an admin or developer
        $currentUserId = $_SESSION['id'];
        $sqlCurrentUserRole = "SELECT role FROM users WHERE id = $currentUserId";
        $resultCurrentUserRole = $conn->query($sqlCurrentUserRole);

        if ($resultCurrentUserRole->num_rows > 0) {
            $currentRow = $resultCurrentUserRole->fetch_assoc();
            $currentUserRole = $currentRow['role'];

            if ($currentUserRole !== 'admin' && $currentUserRole !== 'developer') {
                echo json_encode(["success" => false, "message" => "You do not have permission to change user access levels."]);
                exit; // Stop further execution
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error: Current user role not found."]);
            exit;
        }

        // Check if the target user is an admin or developer
        $sqlCheckRole = "SELECT role FROM users WHERE id = $userId";
        $resultRole = $conn->query($sqlCheckRole);

        if ($resultRole->num_rows > 0) {
            $row = $resultRole->fetch_assoc();
            $userRole = $row['role'];

            // Prevent changing the access level of an admin or developer
            if ($userRole == 'admin' || $userRole == 'developer') {
                echo json_encode(["success" => false, "message" => "You cannot change the access level of an admin or developer."]);
                exit; // Stop further execution
            }
        }

        // Update the user's access level
        $sqlUpdate = "UPDATE users SET access = '$accessLevel' WHERE id = $userId";

        if ($conn->query($sqlUpdate) === TRUE) {
            echo json_encode(["success" => true, "message" => "Access level updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating access level: " . $conn->error]);
        }

        $conn->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid parameters."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
