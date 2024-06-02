<?php
// Database connection parameters
include 'config.php';
session_start();

// Assuming you have stored the user's role in the session as 'role'
$currentUserRole = isset($_SESSION['role']) ? $_SESSION['role'] : 'default_role'; // Change 'default_role' to an appropriate default value

// Attempt database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from users table
$sql = "SELECT id, name, email, role, access FROM users";
$result = $conn->query($sql);

$usersData = [];

if ($result->num_rows > 0) {
    // Store data of each row in an array
    while ($row = $result->fetch_assoc()) {
        $usersData[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="users.css">
    <title>User Data</title>
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="material-icons back-icon">arrow_back</i></a>
    <div class="container">
        <h1>User Data</h1>
        <h2>Logged In Users</h2>

        <?php foreach ($usersData as $userData) : ?>
            <div class="user-card">
                <div class="user-info">
                    <h3>ID: <?php echo $userData['id']; ?></h3>
                    <p>Name: <?php echo $userData['name']; ?></p>
                    <p>Role: <?php echo $userData['role']; ?></p>
                    <p>Access Level: <?php echo $userData['access']; ?></p>
                    <p>Email: <?php echo $userData['email']; ?></p>
                </div>

                <div class="action-buttons">
                    <select onchange="changeAccess(this.value, <?php echo $userData['id']; ?>)">
                        <option value="default" <?php echo ($userData['access'] == 'default') ? 'selected' : ''; ?>>Select Access</option>
                        <option value="r" <?php echo ($userData['access'] == 'r') ? 'selected' : ''; ?>>Read Access</option>
                        <option value="rw" <?php echo ($userData['access'] == 'rw') ? 'selected' : ''; ?>>Read/Write Access</option>
                    </select>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        var currentUserRole = '<?php echo $currentUserRole; ?>';

        function changeAccess(accessLevel, userId) {
            if (currentUserRole !== 'admin') {
                alert('You do not have permission to change user access levels.');
                return;
            }

            console.log('Access Level:', accessLevel);
            console.log('User ID:', userId);
            // Send AJAX request to update access level
            $.ajax({
                type: 'POST',
                url: 'update_access.php',
                data: {
                    user_id: userId,
                    access_level: accessLevel
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Show success message
                        window.location.reload(); // Reload the page
                        // You can update the UI or perform additional actions here
                    } else {
                        alert(response.message); // Show error message
                        window.location.reload();
                    }
                },
                error: function() {
                    alert('Error: Unable to process your request.'); // Show generic error message
                }
            });
        }
    </script>
</body>

</html>