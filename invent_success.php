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
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .countdown {
            margin-top: 20px;
            font-size: 18px;
            color: #777;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Success!</h1>
        <h2>Inventory Form Submitted Successfully</h2>
        <p><a href="manage_system.php">Go back to the homepage</a></p>
        <div class="countdown" id="countdown">Redirecting in 3 seconds...</div>
        <div class="loader"></div>

    </div>

    <script>
        // Countdown timer for redirection
        var countdownElement = document.getElementById('countdown');
        var countdown = 3;
        var timer = setInterval(function() {
            countdown--;
            countdownElement.textContent = 'Redirecting in ' + countdown + ' seconds...';
        }, 1000);

        setTimeout(function() {
            window.location.href = 'inventory_data.php?id=<?php echo $itemId; ?>';
        }, 3000);
    </script>
</body>

</html>