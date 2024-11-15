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
    $errorMessage = "You do not have permission to add Sales.";
    $errorMessage2 = "Contact your administrator for more information .";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sales</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .error-box {
            position: absolute;
            top: 25%;
            left: 2%;
            width: 90%;
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
        <div class="sidebar">
            <div class="wrapper">
                <ul>
                    <!-- Home Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">home</span>
                        <span class="text">Home</span>
                        <div class="submenu">
                            <a href="manage_system.php">Go to Home</a>
                        </div>
                    </li>

                    <!-- Inventory Section with Submenu -->
                    <li class="has-submenu">
                        <span class="icon material-icons">inventory</span>
                        <span class="text">Inventory</span>
                        <div class="submenu">
                            <a href="add_inventory.php">Add Inventory</a>
                            <a href="addmore_inventory.php">Add More Items</a>
                            <a href="view_inventory.php">View Inventory</a>
                            <a href="view_moreinventory.php">View 2nd Inventory</a>
                        </div>
                    </li>

                    <!-- Sales Section with Submenu -->
                    <li class="has-submenu">
                        <span class="icon material-icons">trending_up</span>
                        <span class="text">Sales</span>
                        <div class="submenu">
                            <a href="sales.php">Add Sales</a>
                            <a href="moresales.php">Add More Sales</a>
                            <a href="view_sales.php">View Sales</a>
                            <a href="view_moresales.php">View More Sales</a>

                        </div>
                    </li>

                    <!-- Stock Section (Placeholder for future use) -->
                    <li class="has-submenu">
                        <span class="icon material-icons">store</span>
                        <span class="text">Stock</span>
                        <div class="submenu">
                            <a href="stock.php">Stock Table</a>
                            <a href="more_stock.php">2nd Stock Table</a>

                        </div>
                    </li>

                    <!-- Reports Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">bar_chart</span>
                        <span class="text">Reports</span>
                        <div class="submenu">
                            <a href="sales_report.php">Sales Report</a>
                            <a href="more_sales_report.php">2nd Sales Report</a>
                            <a href="inventory_report.php">Inventory Report</a>
                            <a href="more_inventory_report.php">2nd Inventory Report</a>
                        </div>
                    </li>

                    <!-- Tables Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">table_chart</span>
                        <span class="text">Tables</span>
                        <div class="submenu">
                            <a href="sales_table.php">Sales Table</a>
                            <a href="more_sales_table.php">2nd Sales Table</a>
                            <a href="inventory_table.php">Inventory Table</a>
                            <a href="more_inventory_table.php">2nd Inventory Table</a>
                        </div>
                    </li>

                    <!-- Settings Section with Submenu -->
                    <li class="has-submenu">
                        <span class="icon material-icons">settings</span>
                        <span class="text">Settings</span>
                        <div class="submenu">
                            <a href="users.php">See Users</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>

                    <!-- Help Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">info</span>
                        <span class="text">Extra</span>
                        <div class="submenu">
                            <a href="notifications.php">Notifications</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="form-container">
            <button class="toggle-button" onclick="toggleMode()">
                <i id="darkModeIcon" class="fas fa-moon"></i>
            </button>
            <a href="manage_system.php" class="toggle-buttons">
                <i id="homeIcon" class="fas fa-home"></i>
            </a>


            <h1>Sales</h1>
            <h2>Enter Items</h2>
            <form action="insert_moresales.php" method="POST">
                <div class="inp">
                    <label for="date"></label>
                    <input type="date" id="date" name="date" required><br><br>
                </div>

                <div class="wrapperr">
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