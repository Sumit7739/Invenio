<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}

// Fetch user data from the database
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
$userId = $_SESSION['id'];
$sql = "SELECT access FROM users WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userAccess = $row['access'];
} else {
    // Handle the case where the user is not found in the database
    $errorMessage = "Error: User not found.";
}

// Check if the user has write access
if (isset($userAccess) && $userAccess !== 'rw') {
    // Display an error message
    $errorMessage = "You do not have permission to add inventory.";
    $errorMessage2 = "Contact your administrator for more information .";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       .error-box {
            position: absolute;
            top: 25%;
            left: 2%;
            width:90%;
            border: 1px solid #ff0000;
            background-color: #ffe6e6;
            color: #ff0000;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
<?php if (isset($errorMessage)) : ?>
        <div class="error-box">
            <?php echo $errorMessage; ?> <br> <br>
            <?php echo $errorMessage2; ?>
            <a href="manage_system.php">Go Back</a>
        </div>
    <?php else : ?>
    <div class="form-container">
        <button class="toggle-button" onclick="toggleMode()">
            <i id="darkModeIcon" class="fas fa-moon"></i>
        </button>
        <a href="manage_system.php" class="toggle-buttons">
            <i id="homeIcon" class="fas fa-home"></i>
        </a>


        <h1>Inventory</h1>
        <h2>Enter Items</h2>
        <form action="insertmore_inventory.php" method="POST">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>

            <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
            <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Payal LD <span id="toggleIcon">▼</span></label><br>
            <div id="blackLooseSection" class="container">

                <label for="py6">6 Inch:</label>
                <input type="number" step="0.01" id="py6" name="py6">
                <select id="payal6_unit" name="payal6_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="payal6_unit_default" value="NULL">
                <br>
                <label for="py8">8 Inch:</label>
                <input type="number" step="0.01" id="py8" name="py8">
                <select id="payal8_unit" name="payal8_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="payal8_unit_default" value="NULL">
                <br>

                <label for="py9">9 Inch:</label>
                <input type="number" step="0.01" id="py9" name="py9">
                <select id="payal9_unit" name="payal9_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="payal9_unit_default" value="NULL">
                <br>

                <label for="py11">11 Inch:</label>
                <input type="number" step="0.01" id="py11" name="py11">
                <select id="payal11_unit" name="payal11_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="payal11_unit_default" value="NULL">
                <br>
            </div>

            <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
            <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Zip Lock <span id="toggleIcon">▼</span></label><br>
            <div id="blackLooseSection" class="container">

                <label for="3x4yzl">3x4 YZL:</label>
                <input type="number" step="0.01" id="3x4yzl" name="3x4yzl">
                <select id="3x4yzl_unit" name="3x4yzl_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="3x4yzl_unit_default" value="NULL">
                <br>

                <label for="4x5yzl">4x5 YZL:</label>
                <input type="number" step="0.01" id="4x5yzl" name="4x5yzl">
                <select id="4x5yzl_unit" name="4x5yzl_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="4x5yzl_unit_default" value="NULL">
                <br>

                <label for="3x4wzl">3x4 WZL:</label>
                <input type="number" step="0.01" id="3x4wzl" name="3x4wzl">
                <select id="3x4wzl_unit" name="3x4wzl_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="3x4wzl_unit_default" value="NULL">
                <br>

                <label for="4x5wzl">4x5 WZL:</label>
                <input type="number" step="0.01" id="4x5wzl" name="4x5wzl">
                <select id="4x5wzl_unit" name="4x5wzl_unit" required class="unit">
                    <option value="NULL">Select Unit</option>
                    <option value="kg">kg</option>
                    <option value="g">g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select>
                <input type="hidden" name="4x5wzl_unit_default" value="NULL">
                <br>
            </div>

            <input type="submit" value="Submit">
        </form>
        <a href="moresales.php">Go To Sales</a>
    </div>
    <?php endif; ?>
    <script>
        window.onload = function() {
            const unitSelects = document.querySelectorAll("select.unit");

            for (const select of unitSelects) {
                if (select.value === "NULL") {
                    const correspondingHiddenField = document.querySelector(`input[name="${select.id}_default"]`);
                    correspondingHiddenField.value = "NULL";
                }
            }
        };
    </script>
    <script src="script.js"></script>
</body>

</html>