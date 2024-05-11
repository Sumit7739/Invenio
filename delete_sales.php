<?php
// Check if the 'id' parameter exists in the URL and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // 'id' parameter is valid, proceed with deletion
    $itemId = $_GET['id'];

    // Assuming you have a database connection, you can perform the deletion here
    include('config.php');


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete associated records in inventory_unit table first
    $stmtDeleteUnits = $conn->prepare("DELETE FROM sales_unit WHERE item_id = ?");
    $stmtDeleteUnits->bind_param("i", $itemId);
    $stmtDeleteUnits->execute();
    $stmtDeleteUnits->close();

    // Prepare and execute the DELETE statement for inventory_item
    $stmtDeleteItem = $conn->prepare("DELETE FROM sales_item WHERE id = ?");
    $stmtDeleteItem->bind_param("i", $itemId);
    $stmtDeleteItem->execute();

    // Check if the deletion was successful
    if ($stmtDeleteItem->affected_rows > 0) {
        // Deletion successful
        header("Location: success.html"); // Redirect to success page
        exit();
    } else {
        // No rows affected, item may not exist or deletion failed
        header("Location: error.php"); // Redirect to error page
        exit();
    }

    // Close the statements and connection
    // $stmtDeleteItem->close();
    // $conn->close();
} else {
    // 'id' parameter is missing or invalid
    echo json_encode(['success' => false, 'message' => 'Invalid item ID.']);
}
