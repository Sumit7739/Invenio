<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding-top: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ff6347;
            /* Tomato color for error message */
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        h3 {
            color: #ff6347;
        }

        .countdown {
            margin-top: 20px;
            font-size: 18px;
            color: #777;
        }
    </style>
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
        <div class="countdown" id="countdown">Redirecting in 3 seconds...</div>
    </div>

    <script>
        // Countdown timer for redirection
        var countdownElement = document.getElementById('countdown');
        var countdown = 3;

        var timer = setInterval(function() {
            countdown--;
            countdownElement.textContent = 'Redirecting in ' + countdown + ' seconds...';
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = 'manage_system.php';
            }
        }, 1000);
    </script>
</body>

</html>