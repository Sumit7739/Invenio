<?php
// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    // You can use $itemId to fetch and display specific data related to the inserted item
} else {
    // Handle the case where the ID parameter is missing
    echo "Error: Item ID not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="invent_success.css">
</head>

<body>
    <div class="container">
        <h1>Success!</h1>
        <h2>Inventory Form Submitted Successfully</h2>
        <p><a href="manage_system.php">Go back to the homepage</a></p>
        <div class="countdown" id="countdown">Redirecting in 3 seconds...</div>
        <div class="loader"></div>

    </div>

    <script src="invent_success.js"></script>
</body>

</html>