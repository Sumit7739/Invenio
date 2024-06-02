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
            <form action="insert_inventory.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"><br><br>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br><br>

                <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
                <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Black
                    Loose <span id="toggleIcon">▼</span></label><br>
                <div id="blackLooseSection" class="container">

                    <label for="bl5">5-inch BL:</label>
                    <input type="number" step="0.01" id="bl5" name="bl5">
                    <select id="bl5_unit" name="bl5_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bl5_unit_default" value="NULL">
                    <br>


                    <label for="bl6">6-inch BL:</label>
                    <input type="number" step="0.01" id="bl6" name="bl6">
                    <select id="bl6_unit" name="bl6_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bl6_unit_default" value="NULL">

                    <label for="bl7">7-inch BL:</label>
                    <input type="number" step="0.01" id="bl7" name="bl7">
                    <select id="bl7_unit" name="bl7_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bl7_unit_default" value="NULL">

                    <label for="bl9">9-inch BL:</label>
                    <input type="number" step="0.01" id="bl9" name="bl9">
                    <select id="bl9_unit" name="bl9_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bl9_unit_default" value="NULL">


                </div>
                <hr>

                <label for="starPacketToggle" onclick="toggleStarPacket()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">Star Packet <span id="toggleIcon">▼</span></label><br>
                <div id="starPacketSection" class="container">

                    <!-- Repeat this block for each SP unit (e.g., sp5, sp6, sp7, sp9) -->
                    <label for="sp5">5-inch SP:</label>
                    <input type="number" step="0.01" id="sp5" name="sp5">
                    <select id="sp5_unit" name="sp5_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="sp5_unit_default" value="NULL">

                    <br>

                    <label for="sp6">6-inch SP:</label>
                    <input type="number" step="0.01" id="sp6" name="sp6">
                    <select id="sp6_unit" name="sp6_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="sp6_unit_default" value="NULL">
                    <br>

                    <label for="sp7">7-inch SP:</label>
                    <input type="number" step="0.01" id="sp7" name="sp7">
                    <select id="sp7_unit" name="sp7_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="sp7_unit_default" value="NULL">
                    <br>

                    <label for="sp9">9-inch SP:</label>
                    <input type="number" step="0.01" id="sp9" name="sp9">
                    <select id="sp9_unit" name="sp9_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="sp9_unit_default" value="NULL">
                    <br><br>

                </div>
                <hr>

                <label for="wlToggle" class="toggle-label" onclick="toggleWhiteLoose()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">White Loose <span id="wlToggleIcon">▼</span></label><br>
                <div id="whiteLooseSection" class="container">

                    <label for="wl5">5-inch WL:</label>
                    <input type="number" step="0.01" id="wl5" name="wl5">
                    <select id="wl5_unit" name="wl5_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="wl5_unit_default" value="NULL">
                    <br>

                    <label for="wl6">6-inch WL:</label>
                    <input type="number" step="0.01" id="wl6" name="wl6">
                    <select id="wl6_unit" name="wl6_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="wl6_unit_default" value="NULL">
                    <br>

                    <label for="wl7">7-inch WL:</label>
                    <input type="number" step="0.01" id="wl7" name="wl7">
                    <select id="wl7_unit" name="wl7_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="wl7_unit_default" value="NULL">
                    <br>

                    <label for="wl9">9-inch WL:</label>
                    <input type="number" step="0.01" id="wl9" name="wl9">
                    <select id="wl9-unit" name="wl9_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select><br>
                    <input type="hidden" name="wl9_unit_default" value="NULL">
                    <br>

                </div>
                <hr>

                <label for="ldSomaToggle" class="toggle-label" onclick="toggleLDSoma()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">L/D SOMA <span id="ldSomaToggleIcon">▼</span></label><br>
                <div id="ldSomaSection" class="container">

                    <label for="ld8">8-inch LD:</label>
                    <input type="number" step="0.01" id="ld8" name="ld8">
                    <select id="ld8_unit" name="ld8_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="ld8_unit_default" value="NULL">

                    <label for="ld9">9-inch :-</label>
                    <input type="number" step="0.01" id="ld9" name="ld9">
                    <select id="ld9_unit" name="ld9_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="ld9_unit_default" value="NULL">
                    <br>

                    <label for="ld11">11 inch:</label>
                    <input type="number" step="0.01" step="0.01" id="ld11" name="ld11">
                    <select id="ld11_unit" name="ld11_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="ld11_unit_default" value="NULL">
                    <br>

                    <label for="dld">DLD : &nbsp; &nbsp;</label>
                    <input type="number" step="0.01" id="dld" name="dld">
                    <select id="dld_unit" name="dld_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="dld_unit_default" value="NULL">
                    <br>

                    <label for="pp">PP : &nbsp; &nbsp; &nbsp;</label>
                    <input type="number" step="0.01" id="pp" name="pp">
                    <select id="pp_unit" name="pp_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="pp_unit_default" value="NULL">
                    <br>
                    <br>

                </div>
                <hr>

                <label for="cupsToggle" class="toggle-label" onclick="toggleCups()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">CUPS <span id="cupsToggleIcon">▼</span></label><br>
                <div id="cupsSection" class="container">

                    <label for="cups50">50 ml:</label>
                    <input type="number" step="0.01" id="cups50" name="cups50">
                    <select id="cups50_unit" name="cups50_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups50_unit_default" value="NULL">
                    <br>

                    <label for="cups60">60 ml :-</label>
                    <input type="number" step="0.01" id="cups60" name="cups60">
                    <select id="cups60_unit" name="cups60_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups60_unit_default" value="NULL">
                    <br>

                    <label for="cups80">80 ml :-</label>
                    <input type="number" step="0.01" id="cups80" name="cups80">
                    <select id="cups80_unit" name="cups80_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups80_unit_default" value="NULL">
                    <br>

                    <label for="cups100">100 ml:</label>
                    <input type="number" step="0.01" id="cups100" name="cups100">
                    <select id="cups100_unit" name="cups100_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups100_unit_default" value="NULL">
                    <br>

                    <label for="cups150">150 ml:</label>
                    <input type="number" step="0.01" id="cups150" name="cups150">
                    <select id="cups150_unit" name="cups150_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups150_unit_default" value="NULL">
                    <br>

                    <label for="cups210">210 ml:</label>
                    <input type="number" step="0.01" id="cups210" name="cups210">
                    <select id="cups210_unit" name="cups210_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups210_unit_default" value="NULL">
                    <br>

                    <label for="cups250">250 ml:</label>
                    <input type="number" step="0.01" id="cups250" name="cups250">
                    <select id="cups250_unit" name="cups250_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="Thousand">Thousand</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Dozen">Dozen</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cups250_unit_default" value="NULL">
                    <br><br>

                </div>
                <hr>

                <label for="blackDelhiToggle" class="toggle-label" onclick="toggleBlackDelhi()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">Black Delhi <span id="blackDelhiToggleIcon">▼</span></label><br>
                <div id="blackDelhiSection" class="container">

                    <label for="bd5">5-inch BD :</label>
                    <input type="number" step="0.01" id="bd5" name="bd5">
                    <select id="bd5_unit" name="bd5_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bd5_unit_default" value="NULL">
                    <br>

                    <label for="bd6">6-inch BD :</label>
                    <input type="number" step="0.01" id="bd6" name="bd6">
                    <select id="bd6_unit" name="bd6_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bd6_unit_default" value="NULL">
                    <br>

                    <label for="bd7">7-inch BD :</label>
                    <input type="number" step="0.01" id="bd7" name="bd7">
                    <select id="bd7_unit" name="bd7_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="bd7_unit_default" value="NULL">
                    <br>
                    <br>

                </div>
                <hr>

                <label for="coverToggle" class="toggle-label" onclick="toggleCover()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">COVER <span id="coverToggleIcon">▼</span></label><br>
                <div id="coverSection" class="container">

                    <label for="cp5">5-inch:</label>
                    <input type="number" step="0.01" id="cp5" name="cp5">
                    <select id="cp5_unit" name="cp5_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cp5_unit_default" value="NULL">
                    <br>

                    <label for="cp6">6-inch:</label>
                    <input type="number" step="0.01" id="cp6" name="cp6">
                    <select id="cp6_unit" name="cp6_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cp6_unit_default" value="NULL">
                    <br>

                    <label for="cp7">7-inch:</label>
                    <input type="number" step="0.01" id="cp7" name="cp7">
                    <select id="cp7_unit" name="cp7_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cp7_unit_default" value="NULL">
                    <br>

                    <label for="cp9">9-inch:</label>
                    <input type="number" step="0.01" id="cp9" name="cp9">
                    <select id="cp9_unit" name="cp9_unit" required class="unit">
                        <option value="NULL">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="default" style="display:none;">Default (not inserted)</option>
                    </select>
                    <input type="hidden" name="cp9_unit_default" value="NULL">
                    <br><br>

                </div>
                <hr>

                <input type="submit" value="Submit">
            </form>
            <a href="sales.php">Go To Sales</a>
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