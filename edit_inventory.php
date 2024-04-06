<?php
// Check if ID is passed in the URL
if (isset($_GET['id'])) {

    include 'db_connection.php';


    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the ID from the URL
    $id = $_GET['id'];

    // Prepare and execute the SQL query with a join operation to fetch data from two tables
    $sql = "SELECT item.*, unit.* FROM inventory_item AS item INNER JOIN inventory_unit AS unit ON item.id = unit.id WHERE item.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store fetched data into variables
        $name = $row['name'];
        $date = $row['date'];
        $bl5 = $row['bl5'];
        $bl5_unit = $row['bl5_unit'];
        $bl6 = $row["bl6"];
        $bl6_unit = $row["bl6_unit"];
        $bl7 = $row["bl7"];
        $bl7_unit = $row["bl7_unit"];
        $bl9 = $row["bl9"];
        $bl9_unit = $row["bl9_unit"];
        $sp5 = $row["sp5"];
        $sp5_unit = $row["sp5_unit"];
        $sp6 = $row["sp6"];
        $sp6_unit = $row["sp6_unit"];
        $sp7 = $row["sp7"];
        $sp7_unit = $row["sp7_unit"];
        $sp9 = $row["sp9"];
        $sp9_unit = $row["sp9_unit"];
        $wl5 = $row["wl5"];
        $wl5_unit = $row["wl5_unit"];
        $wl6 = $row["wl6"];
        $wl6_unit = $row["wl6_unit"];
        $wl7 = $row["wl7"];
        $wl7_unit = $row["wl7_unit"];
        $wl9 = $row["wl9"];
        $wl9_unit = $row["wl9_unit"];
        $ld8 = $row["ld8"];
        $ld8_unit = $row["ld8_unit"];
        $ld9 = $row["ld9"];
        $ld9_unit = $row["ld9_unit"];
        $ld11 = $row["ld11"];
        $ld11_unit = $row["ld11_unit"];
        $dld = $row["dld"];
        $dld_unit = $row["dld_unit"];
        $pp = $row["pp"];
        $pp_unit = $row["pp_unit"];
        $cups50 = $row["cups50"];
        $cups50_unit = $row["cups50_unit"];
        $cups60 = $row["cups60"];
        $cups60_unit = $row["cups60_unit"];
        $cups80 = $row["cups80"];
        $cups80_unit = $row["cups80_unit"];
        $cups100 = $row["cups100"];
        $cups100_unit = $row["cups100_unit"];
        $cups150 = $row["cups150"];
        $cups150_unit = $row["cups150_unit"];
        $cups210 = $row["cups210"];
        $cups210_unit = $row["cups210_unit"];
        $cups250 = $row["cups250"];
        $cups250_unit = $row["cups250_unit"];
        $bd5 = $row["bd5"];
        $bd5_unit = $row["bd5_unit"];
        $bd6 = $row["bd6"];
        $bd6_unit = $row["bd6_unit"];
        $bd7 = $row["bd7"];
        $bd7_unit = $row["bd7_unit"];
        $cp5 = $row["cp5"];
        $cp5_unit = $row["cp5_unit"];
        $cp6 = $row["cp6"];
        $cp6_unit = $row["cp6_unit"];
        $cp7 = $row["cp7"];
        $cp7_unit = $row["cp7_unit"];
        $cp9 = $row["cp9"];
        $cp9_unit = $row["cp9_unit"];
        // Repeat this for other fields you want to fetch

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "No data found for the provided ID.";
        exit;
    }
} else {
    echo "ID not provided in the URL.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="form-container">
        <button class="toggle-button" onclick="toggleMode()">
            <i id="darkModeIcon" class="fas fa-moon"></i>
        </button>
        <a href="index.html" class="toggle-buttons">
            <i id="homeIcon" class="fas fa-home"></i>
        </a>


        <h1>Inventory</h1>
        <h2>Edit Items</h2>
        <form action="update_inventory.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>

            <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
            <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Black
                Loose <span id="toggleIcon">▼</span></label><br>
            <div id="blackLooseSection" class="container">

                <label for="bl5">5-inch BL:</label>
                <input type="number" step="0.01" id="bl5" name="bl5" value="<?php echo $bl5; ?>">
                <select id="bl5_unit" name="bl5_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bl5_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bl5_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>


                <!-- Repeat this pattern for other fields -->
                <label for="bl6">6-inch BL:</label>
                <input type="number" step="0.01" id="bl6" name="bl6" value="<?php echo $bl6; ?>">
                <select id="bl6_unit" name="bl6_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bl6_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bl6_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="bl7">7-inch BL:</label>
                <input type="number" step="0.01" id="bl7" name="bl7" value="<?php echo $bl7; ?>">
                <select id="bl7_unit" name="bl7_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bl7_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bl7_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="bl9">9-inch BL:</label>
                <input type="number" step="0.01" id="bl9" name="bl9" value="<?php echo $bl9; ?>">
                <select id="bl9_unit" name="bl9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bl9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bl9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <label for="starPacketToggle" onclick="toggleStarPacket()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">Star Packet <span id="toggleIcon">▼</span></label><br>
            <div id="starPacketSection" class="container">

                <!-- Repeat this pattern for Star Packet fields -->
                <label for="sp5">5-inch SP:</label>
                <input type="number" step="0.01" id="sp5" name="sp5" value="<?php echo $sp5; ?>">
                <select id="sp5_unit" name="sp5_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($sp5_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($sp5_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="sp6">6-inch SP:</label>
                <input type="number" step="0.01" id="sp6" name="sp6" value="<?php echo $sp6; ?>">
                <select id="sp6_unit" name="sp6_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($sp6_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($sp6_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="sp7">7-inch SP:</label>
                <input type="number" step="0.01" id="sp7" name="sp7" value="<?php echo $sp7; ?>">
                <select id="sp7_unit" name="sp7_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($sp7_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($sp7_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="sp9">9-inch SP:</label>
                <input type="number" step="0.01" id="sp9" name="sp9" value="<?php echo $sp9; ?>">
                <select id="sp9_unit" name="sp9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($sp9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($sp9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <label for="wlToggle" class="toggle-label" onclick="toggleWhiteLoose()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">White Loose <span id="wlToggleIcon">▼</span></label><br>
            <div id="whiteLooseSection" class="container">
                <!-- Repeat this pattern for White Loose fields -->
                <label for="wl5">5-inch WL:</label>
                <input type="number" step="0.01" id="wl5" name="wl5" value="<?php echo $wl5; ?>">
                <select id="wl5_unit" name="wl5_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($wl5_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($wl5_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="wl6">6-inch WL:</label>
                <input type="number" step="0.01" id="wl6" name="wl6" value="<?php echo $wl6; ?>">
                <select id="wl6_unit" name="wl6_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($wl6_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($wl6_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="wl7">7-inch WL:</label>
                <input type="number" step="0.01" id="wl7" name="wl7" value="<?php echo $wl7; ?>">
                <select id="wl7_unit" name="wl7_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($wl7_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($wl7_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="wl9">9-inch WL:</label>
                <input type="number" step="0.01" id="wl9" name="wl9" value="<?php echo $wl9; ?>">
                <select id="wl9_unit" name="wl9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($wl9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($wl9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <label for="ldSomaToggle" class="toggle-label" onclick="toggleLDSoma()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">L/D SOMA <span id="ldSomaToggleIcon">▼</span></label><br>
            <div id="ldSomaSection" class="container">

                <!-- Repeat this pattern for L/D SOMA fields -->
                <label for="ld8">8-inch L/D SOMA:</label>
                <input type="number" step="0.01" id="ld8" name="ld8" value="<?php echo $ld8; ?>">
                <select id="ld8_unit" name="ld8_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($ld8_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ld8_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="ld9">9-inch L/D SOMA:</label>
                <input type="number" step="0.01" id="ld9" name="ld9" value="<?php echo $ld9; ?>">
                <select id="ld9_unit" name="ld9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($ld9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ld9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="ld11">11-inch L/D SOMA:</label>
                <input type="number" step="0.01" id="ld11" name="ld11" value="<?php echo $ld11; ?>">
                <select id="ld11_unit" name="ld11_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($ld11_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ld11_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="dld">DLD L/D SOMA:</label>
                <input type="number" step="0.01" id="dld" name="dld" value="<?php echo $dld; ?>">
                <select id="dld_unit" name="dld_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($dld_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($dld_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="pp">PP L/D SOMA:</label>
                <input type="number" step="0.01" id="pp" name="pp" value="<?php echo $pp; ?>">
                <select id="pp_unit" name="pp_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($pp_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($pp_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <label for="cupsToggle" class="toggle-label" onclick="toggleCups()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">CUPS <span id="cupsToggleIcon">▼</span></label><br>
            <div id="cupsSection" class="container">

                <!-- Repeat this pattern for Cups fields -->
                <label for="cups50">50 ml Cups:</label>
                <input type="number" step="0.01" id="cups50" name="cups50" value="<?php echo $cups50; ?>">
                <select id="cups50_unit" name="cups50_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups50_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups50_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cups60">60 ml Cups:</label>
                <input type="number" step="0.01" id="cups60" name="cups60" value="<?php echo $cups60; ?>">
                <select id="cups60_unit" name="cups60_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups60_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups60_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cups80">80 ml Cups:</label>
                <input type="number" step="0.01" id="cups80" name="cups80" value="<?php echo $cups80; ?>">
                <select id="cups80_unit" name="cups80_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups80_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups80_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cups100">100 ml Cups:</label>
                <input type="number" step="0.01" id="cups100" name="cups100" value="<?php echo $cups100; ?>">
                <select id="cups100_unit" name="cups100_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups100_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups100_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cups150">150 ml Cups:</label>
                <input type="number" step="0.01" id="cups150" name="cups150" value="<?php echo $cups150; ?>">
                <select id="cups150_unit" name="cups150_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups150_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups150_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cups210">210 ml Cups:</label>
                <input type="number" step="0.01" id="cups210" name="cups210" value="<?php echo $cups210; ?>">
                <select id="cups210_unit" name="cups210_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups210_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups210_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cups250">250 ml Cups:</label>
                <input type="number" step="0.01" id="cups250" name="cups250" value="<?php echo $cups250; ?>">
                <select id="cups250_unit" name="cups250_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cups250_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cups250_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <label for="blackDelhiToggle" class="toggle-label" onclick="toggleBlackDelhi()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">Black Delhi <span id="blackDelhiToggleIcon">▼</span></label><br>
            <div id="blackDelhiSection" class="container">

                <!-- Repeat this pattern for Black Delhi fields -->
                <label for="bd5">5-inch Black Delhi:</label>
                <input type="number" step="0.01" id="bd5" name="bd5" value="<?php echo $bd5; ?>">
                <select id="bd5_unit" name="bd5_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bd5_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bd5_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="bd6">6-inch Black Delhi:</label>
                <input type="number" step="0.01" id="bd6" name="bd6" value="<?php echo $bd6; ?>">
                <select id="bd6_unit" name="bd6_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bd6_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bd6_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="bd7">7-inch Black Delhi:</label>
                <input type="number" step="0.01" id="bd7" name="bd7" value="<?php echo $bd7; ?>">
                <select id="bd7_unit" name="bd7_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($bd7_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($bd7_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <label for="coverToggle" class="toggle-label" onclick="toggleCover()" style=" font-weight: bold; font-size: 20px; cursor: pointer;">COVER <span id="coverToggleIcon">▼</span></label><br>
            <div id="coverSection" class="container">

                <!-- Repeat this pattern for Cover fields -->
                <label for="cp5">5-inch Cover:</label>
                <input type="number" step="0.01" id="cp5" name="cp5" value="<?php echo $cp5; ?>">
                <select id="cp5_unit" name="cp5_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cp5_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cp5_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cp6">6-inch Cover:</label>
                <input type="number" step="0.01" id="cp6" name="cp6" value="<?php echo $cp6; ?>">
                <select id="cp6_unit" name="cp6_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cp6_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cp6_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cp7">7-inch Cover:</label>
                <input type="number" step="0.01" id="cp7" name="cp7" value="<?php echo $cp7; ?>">
                <select id="cp7_unit" name="cp7_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cp7_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cp7_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

                <label for="cp9">9-inch Cover:</label>
                <input type="number" step="0.01" id="cp9" name="cp9" value="<?php echo $cp9; ?>">
                <select id="cp9_unit" name="cp9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($cp9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($cp9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>

            </div>
            <hr>

            <input type="submit" value="Submit">
        </form>
        <a href="sales.html">Go To Sales</a>
    </div>
    <script src="script.js"></script>
</body>

</html>