<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Fetch and set default units if necessary
    $units = ['payal6_unit', 'payal8_unit', 'payal9_unit', 'payal11_unit', '3x4yzl_unit', '4x5yzl_unit', '3x4wzl_unit', '4x5wzl_unit'];
    foreach ($units as $unit) {
        ${$unit} = isset($_POST[$unit]) && $_POST[$unit] !== "NULL" ? $_POST[$unit] : (isset($_POST[$unit . '_default']) ? $_POST[$unit . '_default'] : null);
    }

    // Include database configuration
    include('config.php');

    try {
        // Prepare and bind SQL statement for moresales_item table
        $stmt_items = $conn->prepare("INSERT INTO moresales_item (date, py6, py8, py9, py11, 3x4yzl, 4x5yzl, 3x4wzl, 4x5wzl)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Check if statement preparation was successful
        if (!$stmt_items) {
            throw new Exception("Prepare failed for moresales_item: " . $conn->error);
        }

        // Bind parameters
        $stmt_items->bind_param("sdddddddd", $date, $py6, $py8, $py9, $py11, $zip3x4yzl, $zip4x5yzl, $zip3x4wzl, $zip4x5wzl);

        // Set parameters and execute SQL statement for moresales_item table
        $date = $_POST["date"];
        $py6 = $_POST["py6"];
        $py8 = $_POST["py8"];
        $py9 = $_POST["py9"];
        $py11 = $_POST["py11"];
        $zip3x4yzl = $_POST["3x4yzl"];
        $zip4x5yzl = $_POST["4x5yzl"];
        $zip3x4wzl = $_POST["3x4wzl"];
        $zip4x5wzl = $_POST["4x5wzl"];
        
        if (!$stmt_items->execute()) {
            throw new Exception("Execute failed for moresales_item: " . $stmt_items->error);
        }

        // Get the last inserted item ID for use in moresales_units table
        $item_id = $conn->insert_id;

        // Prepare and bind SQL statement for moresales_units table
        $stmt_units = $conn->prepare("INSERT INTO moresales_unit (item_id, payal6_unit, payal8_unit, payal9_unit, payal11_unit, 3x4yzl_unit, 4x5yzl_unit, 3x4wzl_unit, 4x5wzl_unit)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Check if statement preparation was successful
        if (!$stmt_units) {
            throw new Exception("Prepare failed for moresales_unit: " . $conn->error);
        }

        // Bind parameters
        $stmt_units->bind_param("issssssss", $item_id, $payal6_unit, $payal8_unit, $payal9_unit, $payal11_unit, $zip3x4yzl_unit, $zip4x5yzl_unit, $zip3x4wzl_unit, $zip4x5wzl_unit);

        // Set parameters and execute SQL statement for moresales_units table
        $payal6_unit = $_POST["payal6_unit"];
        $payal8_unit = $_POST["payal8_unit"];
        $payal9_unit = $_POST["payal9_unit"];
        $payal11_unit = $_POST["payal11_unit"];
        $zip3x4yzl_unit = $_POST["3x4yzl_unit"];
        $zip4x5yzl_unit = $_POST["4x5yzl_unit"];
        $zip3x4wzl_unit = $_POST["3x4wzl_unit"];
        $zip4x5wzl_unit = $_POST["4x5wzl_unit"];

        if (!$stmt_units->execute()) {
            throw new Exception("Execute failed for moresales_unit: " . $stmt_units->error);
        }

        // Redirect to success page
        header("Location: success.html");
        exit;

    } catch (Exception $e) {
        // Handle exceptions here, such as logging the error or displaying a message to the user
        echo "Error: " . $e->getMessage();
    }
}
?>
