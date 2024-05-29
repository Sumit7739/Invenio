<?php
// Check if ID is passed in the URL
if (isset($_GET['id'])) {

    include('config.php');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the ID from the URL
    $id = $_GET['id'];

    // Prepare and execute the SQL query with a join operation to fetch data from two tables
    $sql = "SELECT item.*, unit.* FROM moreinventory_item AS item INNER JOIN moreinventory_unit AS unit ON item.id = unit.item_id WHERE item.id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store fetched data into variables
        $date = $row['date'];
        $py6 = $row["py6"];
        $payal6_unit = $row["payal6_unit"];
        $py8 = $row["py8"];
        $payal8_unit = $row["payal8_unit"];
        $py9 = $row["py9"];
        $payal9_unit = $row["payal9_unit"];
        $py11 = $row["py11"];
        $payal11_unit = $row["payal11_unit"];

        $zip3x4yzl = $row["3x4yzl"];
        $zip3x4yzlUnit = $row["3x4yzl_unit"];

        $zip4x5yzl = $row["4x5yzl"];
        $zip4x5yzlUnit = $row["4x5yzl_unit"];

        $zip3x4wzl = $row["3x4wzl"];
        $zip3x4wzlUnit = $row["3x4wzl_unit"];

        $zip4x5wzl = $row["4x5wzl"];
        $zip4x5wzlUnit = $row["4x5wzl_unit"];

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
        <a href="manage_system.php" class="toggle-buttons">
            <i id="homeIcon" class="fas fa-home"></i>
        </a>

        <h1>Inventory</h1>
        <h2>Edit Items</h2>
        <form action="updatemore_inventory.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required><br><br>

            <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
            <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Payal LD <span id="toggleIcon">▼</span></label><br>
            <div id="blackLooseSection" class="container">

                <label for="py6">6-inch:</label>
                <input type="number" step="0.01" id="py6" name="py6" value="<?php echo htmlspecialchars($py6); ?>">
                <select id="payal6_unit" name="payal6_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($payal6_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($payal6_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>

                <label for="py8">8-inch:</label>
                <input type="number" step="0.01" id="py8" name="py8" value="<?php echo htmlspecialchars($py8); ?>">
                <select id="payal8_unit" name="payal8_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($payal8_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($payal8_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>

                <label for="py9">9-inch:</label>
                <input type="number" step="0.01" id="py9" name="py9" value="<?php echo htmlspecialchars($py9); ?>">
                <select id="payal9_unit" name="payal9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($payal9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($payal9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>

                <label for="py11">11-inch:</label>
                <input type="number" step="0.01" id="py11" name="py11" value="<?php echo htmlspecialchars($py11); ?>">
                <select id="payal11_unit" name="payal11_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($payal11_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($payal11_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>


            </div>
            <hr>

            <!-- <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button> -->
            <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Zip Lock <span id="toggleIcon">▼</span></label><br>
            <div id="blackLooseSection" class="container">

                <label for="3x4yzl">3x4 YZL:</label>
                <input type="number" step="0.01" id="3x4yzl" name="3x4yzl" value="<?php echo htmlspecialchars($zip3x4yzl); ?>">
                <select id="3x4yzl_unit" name="3x4yzl_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ( $zip3x4yzlUnit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ $zip3x4yzlUnit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>
                
                <label for="4x5yzl">4x5 YZL:</label>
                <input type="number" step="0.01" id="4x5yzl" name="4x5yzl" value="<?php echo htmlspecialchars($zip4x5yzl); ?>">
                <select id="4x5yzl_unit" name="4x5yzl_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ( $zip4x5yzlUnit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ $zip4x5yzlUnit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>
                
                <label for="3x4wzl">3x4 WZL:</label>
                <input type="number" step="0.01" id="3x4wzl" name="3x4wzl" value="<?php echo htmlspecialchars($zip3x4wzl); ?>">
                <select id="3x4wzl_unit" name="3x4wzl_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ( $zip3x4wzlUnit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ $zip3x4wzlUnit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>
                
                <label for="4x5wzl">4x5 WZL:</label>
                <input type="number" step="0.01" id="4x5wzl" name="4x5wzl" value="<?php echo htmlspecialchars($zip4x5wzl); ?>">
                <select id="4x5wzl_unit" name="4x5wzl_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ( $zip4x5wzlUnit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($ $zip4x5wzlUnit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br>
            </div>

            <input type="submit" value="Submit">
        </form>
        <a href="sales.php">Go To Sales</a>
    </div>
    <script src="script.js"></script>
</body>

</html>