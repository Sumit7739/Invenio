<?php
session_start();

include('config.php');

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
                $expiryTime = time() + (86400 * 30); // Set cookie for 30 days
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
            $error = "Invalid password";
        }
    } else {
        $error = "Invalid user";
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
    <!-- <link rel="stylesheet" href="login.css"> -->
    <title>Login</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        a.toggle-buttons {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #4285f4;
            font-size: 24px;
            text-decoration: none;
        }

        .section-container {
            position: absolute;
            top: 10%;
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user-list {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 20px;
        }

        .user-container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-container:hover {
            background: #f1f1f1;
            transform: translateY(-5px);
        }

        .user-info {
            margin-bottom: 10px;
        }

        .user-info p {
            margin: 5px 0;
        }

        .password-form {
            display: none;
        }

        .user-container.expanded .password-form {
            display: block;
            margin-top: 10px;
        }

        button {
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #357ae8;
        }

        .fas.fa-home {
            position: absolute;
            margin-bottom: 50px;
            color: #000;
        }

        .fas.fa-home:hover {
            color: #4285f4;
        }

        .fas.fa-home:active {
            color: #357ae8;
        }

        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .password-form {
            display: none;
        }

        input[type="checkbox"]       {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-container label {
            font-size: 14px;
            color: #555;
        }

        .checkbox-container input[type="checkbox"] {
            margin-right: 5px;
        }

        .checkbox-container input[type="checkbox"]:checked {
            background-color: #4285f4;
            border-color: #4285f4;
        }

        /* Media Queries */
        /* @media screen and (max-width: 768px) {
            .user-list {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        } */


    </style>
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
</body>

</html>