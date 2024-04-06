<?php
// Check if the form is submitted

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define database connection credentials
    include 'db_connection.php';
    

    // Prepare and bind SQL statement for inventory_items table
    $stmt_items = $conn->prepare("INSERT INTO inventory_item (name, date, bl5, bl6, bl7, bl9, sp5, sp6, sp7, sp9, wl5, wl6, wl7, wl9, ld8, ld9, ld11, dld, pp, cups50, cups60, cups80, cups100, cups150, cups210, cups250, bd5, bd6, bd7, cp5, cp6, cp7, cp9)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_items->bind_param("ssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii", $name, $date, $bl5, $bl6, $bl7, $bl9, $sp5, $sp6, $sp7, $sp9, $wl5, $wl6, $wl7, $wl9, $ld8, $ld9, $ld11, $dld, $pp, $cups50, $cups60, $cups80, $cups100, $cups150, $cups210, $cups250, $bd5, $bd6, $bd7, $cp5, $cp6, $cp7, $cp9);

    // Set parameters and execute SQL statement for inventory_items table
    $name = $_POST["name"];
    $date = $_POST["date"];
    $bl5 = $_POST["bl5"];
    $bl6 = $_POST["bl6"];
    $bl7 = $_POST["bl7"];
    $bl9 = $_POST["bl9"];
    $sp5 = $_POST["sp5"];
    $sp6 = $_POST["sp6"];
    $sp7 = $_POST["sp7"];
    $sp9 = $_POST["sp9"];
    $wl5 = $_POST["wl5"];
    $wl6 = $_POST["wl6"];
    $wl7 = $_POST["wl7"];
    $wl9 = $_POST["wl9"];
    $ld8 = $_POST["ld8"];
    $ld9 = $_POST["ld9"];
    $ld11 = $_POST["ld11"];
    $dld = $_POST["dld"];
    $pp = $_POST["pp"];
    $cups50 = $_POST["cups50"];
    $cups60 = $_POST["cups60"];
    $cups80 = $_POST["cups80"];
    $cups100 = $_POST["cups100"];
    $cups150 = $_POST["cups150"];
    $cups210 = $_POST["cups210"];
    $cups250 = $_POST["cups250"];
    $bd5 = $_POST["bd5"];
    $bd6 = $_POST["bd6"];
    $bd7 = $_POST["bd7"];
    $cp5 = $_POST["cp5"];
    $cp6 = $_POST["cp6"];
    $cp7 = $_POST["cp7"];
    $cp9 = $_POST["cp9"];
    $stmt_items->execute();

    // Get the last inserted item ID for use in inventory_units table
    $item_id = $conn->insert_id;

    // Prepare and bind SQL statement for inventory_units table
    $stmt_units = $conn->prepare("INSERT INTO inventory_unit (item_id, bl5_unit, bl6_unit, bl7_unit, bl9_unit, sp5_unit, sp6_unit, sp7_unit, sp9_unit, wl5_unit, wl6_unit, wl7_unit, wl9_unit, ld8_unit, ld9_unit, ld11_unit, dld_unit, pp_unit, cups50_unit, cups60_unit, cups80_unit, cups100_unit, cups150_unit, cups210_unit, cups250_unit, bd5_unit, bd6_unit, bd7_unit, cp5_unit, cp6_unit, cp7_unit, cp9_unit)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_units->bind_param("isssssssssssssssssssssssssssssss", $item_id, $bl5_unit, $bl6_unit, $bl7_unit, $bl9_unit, $sp5_unit, $sp6_unit, $sp7_unit, $sp9_unit, $wl5_unit, $wl6_unit, $wl7_unit, $wl9_unit, $ld8_unit, $ld9_unit, $ld11_unit, $dld_unit, $pp_unit, $cups50_unit, $cups60_unit, $cups80_unit, $cups100_unit, $cups150_unit, $cups210_unit, $cups250_unit, $bd5_unit, $bd6_unit, $bd7_unit, $cp5_unit, $cp6_unit, $cp7_unit, $cp9_unit);

    // Set parameters and execute SQL statement for inventory_units table
    $bl5_unit = $_POST["bl5_unit"];
    $bl6_unit = $_POST["bl6_unit"];
    $bl7_unit = $_POST["bl7_unit"];
    $bl9_unit = $_POST["bl9_unit"];
    $sp5_unit = $_POST["sp5_unit"];
    $sp6_unit = $_POST["sp6_unit"];
    $sp7_unit = $_POST["sp7_unit"];
    $sp9_unit = $_POST["sp9_unit"];
    $wl5_unit = $_POST["wl5_unit"];
    $wl6_unit = $_POST["wl6_unit"];
    $wl7_unit = $_POST["wl7_unit"];
    $wl9_unit = $_POST["wl9_unit"];
    $ld8_unit = $_POST["ld8_unit"];
    $ld9_unit = $_POST["ld9_unit"];
    $ld11_unit = $_POST["ld11_unit"];
    $dld_unit = $_POST["dld_unit"];
    $pp_unit = $_POST["pp_unit"];
    $cups50_unit = $_POST["cups50_unit"];
    $cups60_unit = $_POST["cups60_unit"];
    $cups80_unit = $_POST["cups80_unit"];
    $cups100_unit = $_POST["cups100_unit"];
    $cups150_unit = $_POST["cups150_unit"];
    $cups210_unit = $_POST["cups210_unit"];
    $cups250_unit = $_POST["cups250_unit"];
    $bd5_unit = $_POST["bd5_unit"];
    $bd6_unit = $_POST["bd6_unit"];
    $bd7_unit = $_POST["bd7_unit"];
    $cp5_unit = $_POST["cp5_unit"];
    $cp6_unit = $_POST["cp6_unit"];
    $cp7_unit = $_POST["cp7_unit"];
    $cp9_unit = $_POST["cp9_unit"];
    $stmt_units->execute();

    // Close statements and connection
    $stmt_items->close();
    $stmt_units->close();
    $conn->close();

    // Redirect after successful insertion
    header("Location: success.html");
    exit;
}
