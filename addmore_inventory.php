<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
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
</head>

<body>
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
</div>

                <input type="submit" value="Submit">
        </form>
        <a href="moresales.php">Go To Sales</a>
    </div>
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