<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['bl5_unit'])) {
        $bl5Unit = $_POST['bl5_unit'];

        if ($bl5Unit === "NULL") {
            $bl5Unit = $_POST['bl5_unit_default'];
        }
    }

    if (isset($_POST['bl6_unit'])) {
        $bl6Unit = $_POST['bl6_unit'];
        if ($bl6Unit === "NULL") {
            $bl6Unit = $_POST['bl6_unit_default'];
        }
    }

    if (isset($_POST['bl7_unit'])) {
        $bl7Unit = $_POST['bl7_unit'];
        if ($bl7Unit === "NULL") {
            $bl7Unit = $_POST['bl7_unit_default'];
        }
    }

    if (isset($_POST['bl9_unit'])) {
        $bl9Unit = $_POST['bl9_unit'];
        if ($bl9Unit === "NULL") {
            $bl9Unit = $_POST['bl9_unit_default'];
        }
    }
    if (isset($_POST['sp5_unit'])) {
        $sp5Unit = $_POST['sp5_unit'];
        if ($sp5Unit === "NULL") {
            $sp5Unit = $_POST['sp5_unit_default'];
        }
    }

    if (isset($_POST['sp6_unit'])) {
        $sp6Unit = $_POST['sp6_unit'];
        if ($sp6Unit === "NULL") {
            $sp6Unit = $_POST['sp6_unit_default'];
        }
    }

    if (isset($_POST['sp7_unit'])) {
        $sp7Unit = $_POST['sp7_unit'];
        if ($sp7Unit === "NULL") {
            $sp7Unit = $_POST['sp7_unit_default'];
        }
    }

    if (isset($_POST['sp9_unit'])) {
        $sp9Unit = $_POST['sp9_unit'];
        if ($sp9Unit === "NULL") {
            $sp9Unit = $_POST['sp9_unit_default'];
        }
    }

    if (isset($_POST['wl5_unit'])) {
        $wl5Unit = $_POST['wl5_unit'];
        if ($wl5Unit === "NULL") {
            $wl5Unit = $_POST['wl5_unit_default'];
        }
    }

    if (isset($_POST['wl6_unit'])) {
        $wl6Unit = $_POST['wl6_unit'];
        if ($wl6Unit === "NULL") {
            $wl6Unit = $_POST['wl6_unit_default'];
        }
    }

    if (isset($_POST['wl7_unit'])) {
        $wl7Unit = $_POST['wl7_unit'];
        if ($wl7Unit === "NULL") {
            $wl7Unit = $_POST['wl7_unit_default'];
        }
    }

    if (isset($_POST['wl9_unit'])) {
        $wl9Unit = $_POST['wl9_unit'];
        if ($wl9Unit === "NULL") {
            $wl9Unit = $_POST['wl9_unit_default'];
        }
    }

    if (isset($_POST['ld8_unit'])) {
        $ld8Unit = $_POST['ld8_unit'];
        if ($ld8Unit === "NULL") {
            $ld8Unit = $_POST['ld8_unit_default'];
        }
    }

    if (isset($_POST['ld9_unit'])) {
        $ld9Unit = $_POST['ld9_unit'];
        if ($ld9Unit === "NULL") {
            $ld9Unit = $_POST['ld9_unit_default'];
        }
    }

    if (isset($_POST['ld11_unit'])) {
        $ld11Unit = $_POST['ld11_unit'];
        if ($ld11Unit === "NULL") {
            $ld11Unit = $_POST['ld11_unit_default'];
        }
    }

    if (isset($_POST['dld_unit'])) {
        $dldUnit = $_POST['dld_unit'];
        if ($dldUnit === "NULL") {
            $dldUnit = $_POST['dld_unit_default'];
        }
    }
    if (isset($_POST['pp_unit'])) {
        $ppUnit = $_POST['pp_unit'];
        if ($ppUnit === "NULL") {
            $ppUnit = $_POST['pp_unit_default'];
        }
    }

    if (isset($_POST['cups50_unit'])) {
        $cups50Unit = $_POST['cups50_unit'];
        if ($cups50Unit === "NULL") {
            $cups50Unit = $_POST['cups50_unit_default'];
        }
    }

    if (isset($_POST['cups60_unit'])) {
        $cups60Unit = $_POST['cups60_unit'];
        if ($cups60Unit === "NULL") {
            $cups60Unit = $_POST['cups60_unit_default'];
        }
    }

    if (isset($_POST['cups80_unit'])) {
        $cups80Unit = $_POST['cups80_unit'];
        if ($cups80Unit === "NULL") {
            $cups80Unit = $_POST['cups80_unit_default'];
        }
    }

    if (isset($_POST['cups100_unit'])) {
        $cups100Unit = $_POST['cups100_unit'];
        if ($cups100Unit === "NULL") {
            $cups100Unit = $_POST['cups100_unit_default'];
        }
    }

    if (isset($_POST['cups150_unit'])) {
        $cups150Unit = $_POST['cups150_unit'];
        if ($cups150Unit === "NULL") {
            $cups150Unit = $_POST['cups150_unit_default'];
        }
    }

    if (isset($_POST['cups210_unit'])) {
        $cups210Unit = $_POST['cups210_unit'];
        if ($cups210Unit === "NULL") {
            $cups210Unit = $_POST['cups210_unit_default'];
        }
    }

    if (isset($_POST['cups250_unit'])) {
        $cups250Unit = $_POST['cups250_unit'];
        if ($cups250Unit === "NULL") {
            $cups250Unit = $_POST['cups250_unit_default'];
        }
    }

    if (isset($_POST['bd5_unit'])) {
        $bd5Unit = $_POST['bd5_unit'];
        if ($bd5Unit === "NULL") {
            $bd5Unit = $_POST['bd5_unit_default'];
        }
    }

    if (isset($_POST['bd6_unit'])) {
        $bd6Unit = $_POST['bd6_unit'];
        if ($bd6Unit === "NULL") {
            $bd6Unit = $_POST['bd6_unit_default'];
        }
    }

    if (isset($_POST['bd7_unit'])) {
        $bd7Unit = $_POST['bd7_unit'];
        if ($bd7Unit === "NULL") {
            $bd7Unit = $_POST['bd7_unit_default'];
        }
    }

    if (isset($_POST['cp5_unit'])) {
        $cp5Unit = $_POST['cp5_unit'];
        if ($cp5Unit === "NULL") {
            $cp5Unit = $_POST['cp5_unit_default'];
        }
    }

    if (isset($_POST['cp6_unit'])) {
        $cp6Unit = $_POST['cp6_unit'];
        if ($cp6Unit === "NULL") {
            $cp6Unit = $_POST['cp6_unit_default'];
        }
    }

    if (isset($_POST['cp7_unit'])) {
        $cp7Unit = $_POST['cp7_unit'];
        if ($cp7Unit === "NULL") {
            $cp7Unit = $_POST['cp7_unit_default'];
        }
    }

    if (isset($_POST['cp9_unit'])) {
        $cp9Unit = $_POST['cp9_unit'];
        if ($cp9Unit === "NULL") {
            $cp9Unit = $_POST['cp9_unit_default'];
        }
    }

    include('config.php');


    // Prepare and bind SQL statement for inventory_items table
    $stmt_items = $conn->prepare("INSERT INTO sales_item (name, date, bl5, bl6, bl7, bl9, sp5, sp6, sp7, sp9, wl5, wl6, wl7, wl9, ld8, ld9, ld11, dld, pp, cups50, cups60, cups80, cups100, cups150, cups210, cups250, bd5, bd6, bd7, cp5, cp6, cp7, cp9)
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

    // Prepare and bind SQL statement for invantory_units table
    $stmt_units = $conn->prepare("INSERT INTO sales_unit (item_id, bl5_unit, bl6_unit, bl7_unit, bl9_unit, sp5_unit, sp6_unit, sp7_unit, sp9_unit, wl5_unit, wl6_unit, wl7_unit, wl9_unit, ld8_unit, ld9_unit, ld11_unit, dld_unit, pp_unit, cups50_unit, cups60_unit, cups80_unit, cups100_unit, cups150_unit, cups210_unit, cups250_unit, bd5_unit, bd6_unit, bd7_unit, cp5_unit, cp6_unit, cp7_unit, cp9_unit)
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
