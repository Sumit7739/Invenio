<?php
session_start();

include('config.php');

$error = ''; // Initialize the error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];
    $enteredPassword = $_POST['password'];
    $rememberMe = isset($_POST['remember']);

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['password'];
        $verificationStatus = $row['verification_status'];

        if ($verificationStatus == 0) {
            header('Location: otp_verification.php?email=' . $row['email']);
            exit();
        }

        if (password_verify($enteredPassword, $storedHashedPassword)) {
            session_regenerate_id(true);
            $_SESSION['id'] = $row['id'];

            if ($rememberMe) {
                $token = bin2hex(random_bytes(16)); // Generate a secure token
                $expiryTime = time() + (86400 * 30); // cookie for 30 days
                setcookie('remember_me', $token, $expiryTime, "/", "", true, true); // Secure, HttpOnly flag

                // Store the token in the database
                $updateTokenSql = "UPDATE users SET remember_token = ? WHERE id = ?";
                $updateStmt = $conn->prepare($updateTokenSql);
                $updateStmt->bind_param("si", $token, $row['id']);
                $updateStmt->execute();
                $updateStmt->close();
            }

            $stmt->close();
            $conn->close();
            header("Location: welcome.php");
            exit();
        } else {
            $error = "Invalid password"; // Set the error message
        }
    } else {
        $error = "Invalid user"; // Set the error message
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>
    <a href="index.html" class="toggle-buttons">
        <i id="homeIcon" class="fas fa-home"></i>
    </a>
    <div class="section-container">
        <div class="user-list" id="users-list">
            <!-- User containers will be dynamically added here -->
        </div>
    </div>
    <div class="popup-container" id="errorPopup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <p id="errorMessage"><?php echo $error; ?></p> <!-- Display error message here -->
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('fetch_users.php')
                .then(response => response.json())
                .then(users => {
                    const usersList = document.getElementById('users-list');
                    users.forEach(user => {
                        const userContainer = document.createElement('div');
                        userContainer.classList.add('user-container');
                        userContainer.innerHTML = `
                            <div class="user-info">
                                <h3><strong>Name:</strong> ${user.name}</h3>
                                <h3><strong>Role:</strong> ${user.role}</h3>
                            </div>
                            <br>
                            <form class="password-form" method="POST" action="login.php">
                                <input type="hidden" name="user_id" value="${user.id}">
                                <div class="input-box">
                                    <input type="password" name="password" placeholder="Password"  required maxlength="8">
                                </div>
                                <br>
                                <div class="checkbox-container">
                                    <input type="checkbox" name="remember" id="remember_${user.id}">
                                    <label for="remember_${user.id}">Remember Me</label>
                                </div>
                                <br>
                                <button type="submit" name="submit">Login</button>
                            </form>
                        `;
                        userContainer.addEventListener('click', function() {
                            document.querySelectorAll('.user-container').forEach(container => {
                                container.classList.remove('expanded');
                            });
                            userContainer.classList.add('expanded');
                        });
                        usersList.appendChild(userContainer);
                    });
                })
                .catch(error => console.error('Error fetching users:', error));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to show the error popup
            function showErrorPopup() {
                document.getElementById('errorPopup').style.display = 'block';
            }

            // Function to close the error popup
            function closePopup() {
                document.getElementById('errorPopup').style.display = 'none';
            }

            // Check if there's an error message and show the popup
            <?php if ($error !== '') : ?>
                showErrorPopup();
            <?php endif; ?>
        });

        // Define closePopup outside the DOMContentLoaded event listener
        function closePopup() {
            document.getElementById('errorPopup').style.display = 'none';
        }
    </script>
</body>

</html>