<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="error.css">
</head>

<body>
    <div class="container">
        <h1>Error!</h1>
        <p>Something went wrong.</p>
        <?php
        // Check if the error message parameter exists in the URL
        if (isset($_GET['message'])) {
            // Get the error message from the URL
            $errorMessage = $_GET['message'];
            // Display the error message
            echo "<h3>" . htmlspecialchars($errorMessage) . "</h3>";
        } else {
            // Default error message if parameter is not provided
            echo "<p>An unknown error occurred.</p>";
        }
        ?>
        <p><a href="manage_system.php">Go back to the homepage</a></p>
        <div class="countdown" id="countdown">Redirecting in 1 seconds...</div>
    </div>

  <script src="error.js"></script>
</body>

</html>