<?php
session_start();


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $enteredPassword = $_POST['password'];
    include('config.php');


    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $storedHashedPassword = $row['password'];
        $verificationStatus = $row['verification_status'];

        if ($verificationStatus == 0) {

            header('Location: otp_verification.php?email=' . $email);
            exit();
        }

        if (password_verify($enteredPassword, $storedHashedPassword)) {

            $_SESSION['id'] = $row['id'];
            $stmt->close();
            $conn->close();
            header("Location: welcome.php");
            exit();
        } else {

            $error = "Incorrect password";
        }
    } else {

        $error = "User not found";
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
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
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
                    <input type="email" id="email" name="email" required>
                    <label for="email">Enter Your Email</label>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" required maxlength="8">
                    <label for="password">Enter Your Password</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox"> Remember Me.
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