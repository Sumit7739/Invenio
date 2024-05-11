<?php
session_start();

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $phoneNumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    include('config.php');

    $token = bin2hex(random_bytes(16));
    // Check if the user already exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already exists
        $error = "User already exists";
    } else {

        // Insert the new user into the database
        $sql = "INSERT INTO users (name, email, password, tokenn) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $token);
        $stmt->execute();

        // Check if the user was successfully inserted
        if ($stmt->affected_rows > 0) {
            // User created successfully
            $_SESSION['id'] = $stmt->insert_id;
            $stmt->close();

            // Function to generate a random 6-digit OTP
            function generateOTP()
            {
                $otp = "";
                for ($i = 0; $i < 6; $i++) {
                    $otp .= mt_rand(0, 9);
                }
                return $otp;
            }

            // Retrieve the recipient email from the form
            $recipientEmail = $_POST['email'];

            // Generate OTP
            $otp = generateOTP();

            // Initialize PHPMailer
            $mail = new PHPMailer();

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'srisinhasumit10@gmail.com'; // Your Gmail email address
            $mail->Password = 'ggtbuofjfdmqcohr'; // Your Gmail password

            // Sender and recipient
            $mail->setFrom('ppwala@mail.com', 'PPWALA'); // Sender email and name
            $mail->addAddress($recipientEmail); // Recipient email

            // Save the OTP in the database
            $sql = "UPDATE users SET otp = '$otp' WHERE email = '$recipientEmail'";

            if ($conn->query($sql) === TRUE) {
                // Send email
                $mail->isHTML(true);
                $mail->Subject = 'OTP Verification';
                $mail->Body = 'Your OTP for account verification is: ' . $otp;

                if ($mail->send()) {
                    // Redirect to OTP verification page
                    header('Location: otp_verification.php?email=' . $recipientEmail);
                    exit();
                } else {
                    $error = 'Error sending email: ' . $mail->ErrorInfo;
                }
            } else {
                $error = 'Error updating OTP: ' . $conn->error;
            }

            $conn->close();
        } else {
            $error = "Failed to create user";
        }
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
    <title>Signup</title>
    <link rel="stylesheet" href="stylesignup.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .error-msg {
            position: relative;
            color: red;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 10px;
            font-size: 20px;
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
            z-index: 9999;
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

        .checkbox {
            color: #fff;
        }

        .log h4 {
            color: white;
            font-size: 12px;
            font-weight: 400;
        }

        .log a {
            /* text-decoration: none; */
            color: #fff;
            font-size: 18px;
            margin-left: 80px;
        }

        #loaderOverlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 9999;
        }

        .loader {
            /* Loader styles */
            display: inline-block;
            width: 80px;
            height: 80px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 40%;
            left: 40%;
            transform: translate(-50%, -50%);
        }

        .loading {
            display: inline-block !important;
            /* Override display property */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 360px) {
            .login-box {
                width: 100vh;
                height: 100vh;
                border: none;
                border-radius: 0;
            }

            .input-box {
                width: 290px;
            }
        }

        .nav .h2 {
            font-size: 2em;
            color: #fff;
            text-align: left;
        }

        .error-msg {
            position: relative;
            color: red;
            font-size: 20px;
            margin-top: 5px;
            margin-left: 68px;
        }
    </style>
</head>

<body>
    <a href="index.html" class="toggle-buttons">
        <i id="homeIcon" class="fas fa-home"></i>
    </a>
    <section>
        <div class="login-box">
            <div id="loaderOverlay">
                <div id="loader" class="loader"></div>
            </div>
            <form method="POST">
                <h2>Signup</h2>
                <?php if (isset($error)) { ?>
                    <p class="error-msg">
                        <?php echo $error; ?>
                    </p>
                <?php } ?>
                <div class="input-box">
                    <input type="text" id="name" name="name" required>
                    <label for="name">Name</label>
                </div>
                <div class="input-box">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" required maxlength="8">
                    <label for="password">Password</label>
                </div>
                <div class="input-box">
                    <input type="password" id="confirm_password" name="password" required maxlength="8">
                    <label for="confirm_password">Confirm Password</label>
                </div>
                <p id="password-error" style="color: red;"></p>
                <div class="checkbox">
                    <input type="checkbox"> I agree to the terms and condition.
                </div>
                <button type="submit" id="submit" name="submit">Signup</button>

                <div class="log">
                    <h4>Already have an account?
                        <a href="login.php">SignIn</a>
                    </h4>
                </div>
            </form>
        </div>
    </section>

    <script>
        // Get references to the password and confirm password input fields
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirm_password");

        // Get references to the error message element and submit button
        const passwordError = document.getElementById("password-error");
        const submitButton = document.getElementById("submit");

        // Add an input event listener to the confirm password field
        confirmPasswordInput.addEventListener("input", function() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Compare the passwords
            if (password === confirmPassword) {
                // Passwords match, clear the error message
                passwordError.textContent = "";
                submitButton.disabled = false; // Enable the submit button
            } else {
                // Passwords don't match, display an error message
                passwordError.textContent = "Passwords do not match!";
                submitButton.disabled = true; // Disable the submit button
            }
        });

        const submit = document.getElementById('submit');
        const emailField = document.getElementById('email');
        const loaderOverlay = document.getElementById('loaderOverlay');

        submit.addEventListener('click', function() {
            const emailValue = emailField.value.trim();

            if (emailField.checkValidity()) {
                loaderOverlay.style.display = 'block'; // Show overlay

                // Simulate asynchronous task (e.g., AJAX request)
                setTimeout(function() {}, 2000); // Simulated delay of 2 seconds
            } else {
                emailField.reportValidity();
            }
        });
    </script>
</body>

</html>