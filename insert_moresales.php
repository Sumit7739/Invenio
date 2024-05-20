<?php
// Check if the form is submitted

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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



    // Define database connection credentials
    include ('config.php');

    try {
        // Prepare and bind SQL statement for inventory_items table
        $stmt_items = $conn->prepare("INSERT INTO moresales_item (date, py8, py9)
        VALUES (?, ?, ?)");
        $stmt_items->bind_param("sdd", $date, $py8, $py9);

        // Set parameters and execute SQL statement for inventory_items table
        $date = $_POST["date"];
        $py8 = $_POST["py8"];
        $py9 = $_POST["py9"];
       
        $stmt_items->execute();

        // Get the last inserted item ID for use in inventory_units table
        $item_id = $conn->insert_id;


        // Prepare and bind SQL statement for inventory_units table
        $stmt_units = $conn->prepare("INSERT INTO moresales_unit (item_id,  payal8_unit, payal9_unit)
        VALUES (?, ?, ?)");
        $stmt_units->bind_param("iss", $item_id, $py8_unit, $py9_unit);



        // Set parameters and execute SQL statement for inventory_units table
        $py8_unit = $_POST["payal8_unit"];
        $py9_unit = $_POST["payal9_unit"];
        
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
