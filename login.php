<?php
session_start();

// Check if the form was submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $enteredPassword = $_POST['password']; // Changed variable name to avoid confusion

    include('config.php');

    // Prepare and execute a SQL query to retrieve user data
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify the password
        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['password'];
        $verificationStatus = $row['verification_status'];

        if ($verificationStatus == 0) {
            // Redirect to a particular page when verification_status is 0
            header('Location: otp_verification.php?email=' . $email);
            exit();
        }

        // Verify the entered password against the stored hashed password
        if (password_verify($enteredPassword, $storedHashedPassword)) {
            // Password is correct, login successful
            $_SESSION['id'] = $row['id'];

            // Check if "Remember Me" is checked
            if (isset($_POST['remember_me']) && $_POST['remember_me'] == 'on') {
                $cookie_data = $email . ':' . $storedHashedPassword; // You can modify this data format as needed
                $cookie_expire = time() + (30 * 24 * 3600); // 30 days in seconds
                setcookie('remember_me_cookie', $cookie_data, $cookie_expire, '/');
            }

            $stmt->close();
            $conn->close();
            header("Location: welcome.php"); // Redirect to the success page
            exit();
        } else {
            // Invalid password
            $error = "Incorrect password";
        }
    } else {
        // User not found
        $error = "User not found";
    }

    // Error handling
    if (isset($error)) {
        echo "Error: " . $error;
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the database connection
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login</title>
    <style>
        .error-msg {
            position: relative;
            color: red;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 10px;
            font-size: 20px;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        header img {
            width: 250px;
        }

        .toggle-buttons {
            position: absolute;
            top: 5%;
            right: 0;
            margin-right: 30px;
            width: 50px;
            height: 40px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            outline: none;
            padding: 0;
            font-size: 30px;
            border-radius: 10px;
        }

        .toggle-buttons i {
            color: #fff;
            /* Adjust the color of the icon */
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            min-height: 100vh;
            background-color: #333;
            background-size: cover;
            background-position: center;
            animation: animateBg 5s linear infinite;
        }

        /* @keyframes animateBg {
            100% {
                filter: hue-rotate(360deg);
            }
        } */

        .login-box {
            width: 90%;
            max-width: 400px;
            height: auto;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(15px);
        }

        h2 {
            font-size: 2em;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .input-box {
            position: relative;
            margin: 20px 0;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 1em;
            color: #fff;
            pointer-events: none;
            transition: .5s;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: 0;
        }

        .input-box input {
            width: 100%;
            height: 40px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            color: #fff;
            padding-left: 10px;
            border-bottom: 2px solid #fff;
        }

        .checkbox {
            color: #fff;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .forpass a {
            text-decoration: none;
            color: #fff;
            margin-left: auto;
            display: block;
            text-align: right;
        }

        button {
            width: 100%;
            height: 40px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 1em;
            color: #000;
            font-weight: 500;
            margin-top: 20px;
        }

        .log {
            text-align: center;
            margin-top: 20px;
        }

        .log h4 {
            color: white;
            font-size: 14px;
            font-weight: 400;
        }

        .log a {
            color: #fff;
            font-size: 14px;
            margin-left: 10px;
        }

        @media(max-width: 480px) {
            .input-box label {
                left: 5px;
            }

            button {
                font-size: 0.9em;
            }

            .forpass a {
                margin-top: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <a href="index.html" class="toggle-buttons">
        <i id="homeIcon" class="fas fa-home"></i>
    </a>
    <section>
        <div class="login-box">
            <form method="POST">
                <h2>User Login</h2>
                <?php if (isset($error)) : ?>
                    <p class="error-msg">
                        <?php echo $error; ?>
                    </p>
                <?php endif; ?>
                <div class="input-box">
                    <input type="email" id="email" name="email" placeholder="Enter Email" required>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Enter Password" required maxlength="8">
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="remember_me"> Remember Me.
                </div>
                <div class="forpass">
                    <a href="send_otp.php">Forgot password?</a>
                </div>
                <button type="submit" name="submit">Login</button>
                <div class="log">
                    <h4>Don't have an account?
                        <a href="#">Create Account</a>
                    </h4>
                </div>
            </form>
        </div>
    </section>
</body>

</html>