<?php
// Check if the form is submitted

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['payal6_unit'])) {
        $py6Unit = $_POST['payal6_unit'];
        // Check if the selected unit is "none" and use the value from the hidden field if it is
        if ($py6Unit === "NULL") {
            $py6Unit = $_POST['payal6_unit_default']; // Use the value from the hidden field (NULL)
        }
    }
    if (isset($_POST['payal8_unit'])) {
        $py8Unit = $_POST['payal8_unit'];
        // Check if the selected unit is "none" and use the value from the hidden field if it is
        if ($py8Unit === "NULL") {
            $py8Unit = $_POST['payal8_unit_default']; // Use the value from the hidden field (NULL)
        }
    }

    if (isset($_POST['payal9_unit'])) {
        $py9Unit = $_POST['payal9_unit'];
        if ($py9Unit === "NULL") {
            $py9Unit = $_POST['payal9_unit_default'];
        }
    }

    if (isset($_POST['payal11_unit'])) {
        $py11Unit = $_POST['payal11_unit'];
        if ($py11Unit === "NULL") {
            $py11Unit = $_POST['payal11_unit_default'];
        }
    }

    if (isset($_POST['3x4yzl_unit'])) {
        $zip3x4yzlUnit = $_POST['3x4yzl_unit'];
        if ($zip3x4yzlUnit === "NULL") {
            $zip3x4yzlUnit = $_POST['3x4yzl_unit_default'];
        }
    }

    if (isset($_POST['4x5yzl_unit'])) {
        $zip4x5yzlUnit = $_POST['4x5yzl_unit'];
        if ($zip4x5yzlUnit === "NULL") {
            $zip4x5yzlUnit = $_POST['4x5yzl_unit_default'];
        }
    }

    if (isset($_POST['3x4wzl_unit'])) {
        $zip3x4wzlUnit = $_POST['3x4wzl_unit'];
        if ($zip3x4wzlUnit === "NULL") {
            $zip3x4wzlUnit = $_POST['3x4wzl_unit_default'];
        }
    }

    if (isset($_POST['4x5wzl_unit'])) {
        $zip4x5wzlUnit = $_POST['4x5wzl_unit'];
        if ($zip4x5wzlUnit === "NULL") {
            $zip4x5wzlUnit = $_POST['4x5wzl_unit_default'];
        }
    }



    // Define database connection credentials
    include('config.php');

    try {
        // Prepare and bind SQL statement for inventory_items table
        $stmt_items = $conn->prepare("INSERT INTO moreinventory_item (date, py6, py8, py9, py11, 3x4yzl, 4x5yzl, 3x4wzl, 4x5wzl)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_items->bind_param("sdddddddd", $date, $py6, $py8, $py9, $py11, $zip3x4yzl, $zip4x5yzl, $zip3x4wzl, $zip4x5wzl);

        // Set parameters and execute SQL statement for inventory_items table
        $date = $_POST["date"];
        $py6 = $_POST["py6"];
        $py8 = $_POST["py8"];
        $py9 = $_POST["py9"];
        $py11 = $_POST["py11"];
        $zip3x4yzl = $_POST["3x4yzl"];
        $zip4x5yzl = $_POST["4x5yzl"];
        $zip3x4wzl = $_POST["3x4wzl"];
        $zip4x5wzl = $_POST["4x5wzl"];

        $stmt_items->execute();

        // Get the last inserted item ID for use in inventory_units table
        $item_id = $conn->insert_id;


        // Prepare and bind SQL statement for inventory_units table
        $stmt_units = $conn->prepare("INSERT INTO moreinventory_unit (item_id, payal6_unit,  payal8_unit, payal9_unit, payal11_unit, 3x4yzl_unit, 4x5yzl_unit, 3x4wzl_unit, 4x5wzl_unit)

        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_units->bind_param("issssssss", $item_id, $py6_unit, $py8_unit, $py9_unit, $py11_unit, $zip3x4yzlUnit, $zip4x5yzlUnit, $zip3x4wzlUnit, $zip4x5wzlUnit);



        // Set parameters and execute SQL statement for inventory_units table
        $py6_unit = $_POST["payal6_unit"];
        $py8_unit = $_POST["payal8_unit"];
        $py9_unit = $_POST["payal9_unit"];
        $py11_unit = $_POST["payal11_unit"];
        $zip3x4yzlUnit = $_POST["3x4yzl_unit"];
        $zip4x5yzlUnit = $_POST["4x5yzl_unit"];
        $zip3x4wzlUnit = $_POST["3x4wzl_unit"];
        $zip4x5wzlUnit = $_POST["4x5wzl_unit"];

        $stmt_units->execute();

        $insertedItemId = $conn->insert_id;
        header("Location: success.html");
        exit;

        // $stmt_items->close();
        // $stmt_units->close();
        // $conn->close();
    } catch (Exception $e) {
        // Handle exceptions here, such as logging the error or displaying a message to the user
        echo "Error: " . $e->getMessage();
    }
}
