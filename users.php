<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>User Data</title>
    <style>
        /* Import Google Material Design styles */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        /* Set global font family */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Custom styles for Material Design */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .back-icon {
            position: absolute;
            right: 0;
            margin-right: 40px;
            margin-top: 20px;
            color: #333;
            font-size: 30px;
            cursor: pointer;
        }

        .user-card {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .user-info {
            margin-bottom: 10px;
        }

        .user-info h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .user-info p {
            margin: 0;
            color: #000;
            margin-bottom: 10px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .back-icon {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="material-icons back-icon">arrow_back</i></a>
    <div class="container">
        <h1>User Data</h1>
        <h2>Logged In Users</h2>
        <?php
        // Database connection parameters
        include('config.php');

        // Attempt database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from users table
        $sql = "SELECT id, name, email FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="user-card">';
                echo '<div class="user-info">';
                echo '<h3>ID: ' . $row["id"] . '</h3>';
                echo '<p>Name: ' . $row["name"] . '</p>';
                echo '<p>Email: ' . $row["email"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No data found</p>";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>