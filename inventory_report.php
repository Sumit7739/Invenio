<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Inventory Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .home-icon {
            margin-top: 10px;
            margin-left: 10px;
            width: 50px;
            cursor: pointer;
            font-size: 30px;
        }

        .back-icon {
            position: absolute;
            right: 0;
            margin-right: 22px;
            margin-top: 10px;
            color: #333;
            font-size: 30px;
            cursor: pointer;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h2 {
            color: #555;
        }

        .table {
            padding: 20px 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Style for rows with specific classes */
        .bl-row,
        .sp-row,
        .wl-row,
        .ld-row,
        .dld-row,
        .pp-row,
        .cups-row,
        .bd-row,
        .cp-row {
            border: 1px solid #ccc;
            border-radius: 15px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f2f2f2;
        }


        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Style for smaller screens */
        @media only screen and (max-width: 600px) {

            th,
            td {
                padding: 6px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <a href="index.html" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
    <br>
    <br>
    <hr>
    <h1>Inventory Report</h1>
    <?php
    // Include database connection file
    include 'db_connection.php';

    // Initialize arrays to store data
    $items = []; // Store decimal numbers
    $units = []; // Store units

    // SQL query to fetch all data from inventory_item table
    $sql_items = "SELECT id, bl5, bl6, bl7, bl9, sp5, sp6, sp7, sp9, wl5, wl6, wl7, wl9, ld8, ld9, ld11, dld, pp, cups50, cups60, cups80, cups100, cups150, cups210, cups250, bd5, bd6, bd7, cp5, cp6, cp7, cp9 FROM inventory_item";

    // Prepare and execute the SQL query for inventory_item
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();

    // Check if there are rows returned for inventory_item
    if ($result_items->num_rows > 0) {
        // Fetch data and store in arrays for inventory_item
        while ($row_items = $result_items->fetch_assoc()) {
            $items[$row_items['id']] = $row_items; // Store the entire row
        }
    } else {
        echo "No rows found in inventory_item.";
    }

    // Close the prepared statement for inventory_item
    $stmt_items->close();

    // SQL query to fetch all data from inventory_unit table
    $sql_units = "SELECT item_id, bl5_unit, bl6_unit, bl7_unit, bl9_unit, sp5_unit, sp6_unit, sp7_unit, sp9_unit, wl5_unit, wl6_unit, wl7_unit, wl9_unit, ld8_unit, ld9_unit, ld11_unit, dld_unit, pp_unit, cups50_unit, cups60_unit, cups80_unit, cups100_unit, cups150_unit, cups210_unit, cups250_unit, bd5_unit, bd6_unit, bd7_unit, cp5_unit, cp6_unit, cp7_unit, cp9_unit FROM inventory_unit";

    // Prepare and execute the SQL query for inventory_unit
    $stmt_units = $conn->prepare($sql_units);
    $stmt_units->execute();
    $result_units = $stmt_units->get_result();

    // Check if there are rows returned for inventory_unit
    if ($result_units->num_rows > 0) {
        // Fetch data and store in arrays for inventory_unit
        while ($row_units = $result_units->fetch_assoc()) {
            $units[$row_units['item_id']] = $row_units; // Store the entire row
        }
    } else {
        echo "No rows found in inventory_unit.";
    } // Close the prepared statement for inventory_unit

    $stmt_units->close();

    // Initialize variables for total sums
    $total_bl5 = 0;
    $total_bl6 = 0;
    $total_bl7 = 0;
    $total_bl9 = 0;
    $total_sp5 = 0;
    $total_sp6 = 0;
    $total_sp7 = 0;
    $total_sp9 = 0;
    $total_wl5 = 0;
    $total_wl6 = 0;
    $total_wl7 = 0;
    $total_wl9 = 0;
    $total_ld8 = 0;
    $total_ld9 = 0;
    $total_ld11 = 0;
    $total_dld = 0;
    $total_pp = 0;
    $total_cups50 = 0;
    $total_cups60 = 0;
    $total_cups80 = 0;
    $total_cups100 = 0;
    $total_cups150 = 0;
    $total_cups210 = 0;
    $total_cups250 = 0;
    $total_bd5 = 0;
    $total_bd6 = 0;
    $total_bd7 = 0;
    $total_cp5 = 0;
    $total_cp6 = 0;
    $total_cp7 = 0;
    $total_cp9 = 0;

    foreach ($items as $item_id => $item_data) {
        $unit_data = $units[$item_id];

        // Update total sums based on the type of item (e.g., BL5, BL6, etc.)
        $total_bl5 += ($unit_data['bl5_unit'] === 'kg' ? $item_data['bl5'] * 1000 : $item_data['bl5']);
        $total_bl6 += ($unit_data['bl6_unit'] === 'kg' ? $item_data['bl6'] * 1000 : $item_data['bl6']);
        $total_bl7 += ($unit_data['bl7_unit'] === 'kg' ? $item_data['bl7'] * 1000 : $item_data['bl7']);
        $total_bl9 += ($unit_data['bl9_unit'] === 'kg' ? $item_data['bl9'] * 1000 : $item_data['bl9']);
        $total_sp5 += ($unit_data['sp5_unit'] === 'kg' ? $item_data['sp5'] * 1000 : $item_data['sp5']);
        $total_sp6 += ($unit_data['sp6_unit'] === 'kg' ? $item_data['sp6'] * 1000 : $item_data['sp6']);
        $total_sp7 += ($unit_data['sp7_unit'] === 'kg' ? $item_data['sp7'] * 1000 : $item_data['sp7']);
        $total_sp9 += ($unit_data['sp9_unit'] === 'kg' ? $item_data['sp9'] * 1000 : $item_data['sp9']);
        $total_wl5 += ($unit_data['wl5_unit'] === 'kg' ? $item_data['wl5'] * 1000 : $item_data['wl5']);
        $total_wl6 += ($unit_data['wl6_unit'] === 'kg' ? $item_data['wl6'] * 1000 : $item_data['wl6']);
        $total_wl7 += ($unit_data['wl7_unit'] === 'kg' ? $item_data['wl7'] * 1000 : $item_data['wl7']);
        $total_wl9 += ($unit_data['wl9_unit'] === 'kg' ? $item_data['wl9'] * 1000 : $item_data['wl9']);
        $total_ld8 += ($unit_data['ld8_unit'] === 'kg' ? $item_data['ld8'] * 1000 : $item_data['ld8']);
        $total_ld9 += ($unit_data['ld9_unit'] === 'kg' ? $item_data['ld9'] * 1000 : $item_data['ld9']);
        $total_ld11 += ($unit_data['ld11_unit'] === 'kg' ? $item_data['ld11'] * 1000 : $item_data['ld11']);
        $total_dld += ($unit_data['dld_unit'] === 'kg' ? $item_data['dld'] * 1000 : $item_data['dld']);
        $total_pp += ($unit_data['pp_unit'] === 'kg' ? $item_data['pp'] * 1000 : $item_data['pp']);
        $total_cups50 += ($unit_data['cups50_unit'] === 'kg' ? $item_data['cups50'] * 1000 : $item_data['cups50']);
        $total_cups60 += ($unit_data['cups60_unit'] === 'kg' ? $item_data['cups60'] * 1000 : $item_data['cups60']);
        $total_cups80 += ($unit_data['cups80_unit'] === 'kg' ? $item_data['cups80'] * 1000 : $item_data['cups80']);
        $total_cups100 += ($unit_data['cups100_unit'] === 'kg' ? $item_data['cups100'] * 1000 : $item_data['cups100']);
        $total_cups150 += ($unit_data['cups150_unit'] === 'kg' ? $item_data['cups150'] * 1000 : $item_data['cups150']);
        $total_cups210 += ($unit_data['cups210_unit'] === 'kg' ? $item_data['cups210'] * 1000 : $item_data['cups210']);
        $total_cups250 += ($unit_data['cups250_unit'] === 'kg' ? $item_data['cups250'] * 1000 : $item_data['cups250']);
        $total_bd5 += ($unit_data['bd5_unit'] === 'kg' ? $item_data['bd5'] * 1000 : $item_data['bd5']);
        $total_bd6 += ($unit_data['bd6_unit'] === 'kg' ? $item_data['bd6'] * 1000 : $item_data['bd6']);
        $total_bd7 += ($unit_data['bd7_unit'] === 'kg' ? $item_data['bd7'] * 1000 : $item_data['bd7']);
        $total_cp5 += ($unit_data['cp5_unit'] === 'kg' ? $item_data['cp5'] * 1000 : $item_data['cp5']);
        $total_cp6 += ($unit_data['cp6_unit'] === 'kg' ? $item_data['cp6'] * 1000 : $item_data['cp6']);
        $total_cp7 += ($unit_data['cp7_unit'] === 'kg' ? $item_data['cp7'] * 1000 : $item_data['cp7']);
        $total_cp9 += ($unit_data['cp9_unit'] === 'kg' ? $item_data['cp9'] * 1000 : $item_data['cp9']);
    }
    // Close the database connection
    $conn->close();
    ?>
    <!-- <h2>Total Sums</h2> -->
    <div style="overflow-x: auto;" class="table">
        <table>
            <tr>
                <th>Item</th>
                <th>Total Weight</th>
            </tr>
            <!-- BL rows -->
            <tr class="bl-row">
                <td>BL5</td>
                <td><?php echo ($total_bl5 >= 1000 ? ($total_bl5 / 1000) . " kg" : $total_bl5 . " g"); ?></td>
            </tr>
            <tr class="bl-row">
                <td>BL6</td>
                <td><?php echo ($total_bl6 >= 1000 ? ($total_bl6 / 1000) . " kg" : $total_bl6 . " g"); ?></td>
            </tr>
            <tr class="bl-row">
                <td>BL7</td>
                <td><?php echo ($total_bl7 >= 1000 ? ($total_bl7 / 1000) . " kg" : $total_bl7 . " g"); ?></td>
            </tr>
            <tr class="bl-row">
                <td>BL9</td>
                <td><?php echo ($total_bl9 >= 1000 ? ($total_bl9 / 1000) . " kg" : $total_bl9 . " g"); ?></td>
            </tr>
            <!-- SP rows -->
            <tr class="sp-row">
                <td>SP5</td>
                <td><?php echo ($total_sp5 >= 1000 ? ($total_sp5 / 1000) . " kg" : $total_sp5 . " g"); ?></td>
            </tr>
            <tr class="sp-row">
                <td>SP6</td>
                <td><?php echo ($total_sp6 >= 1000 ? ($total_sp6 / 1000) . " kg" : $total_sp6 . " g"); ?></td>
            </tr>
            <tr class="sp-row">
                <td>SP7</td>
                <td><?php echo ($total_sp7 >= 1000 ? ($total_sp7 / 1000) . " kg" : $total_sp7 . " g"); ?></td>
            </tr>
            <tr class="sp-row">
                <td>SP9</td>
                <td><?php echo ($total_sp9 >= 1000 ? ($total_sp9 / 1000) . " kg" : $total_sp9 . " g"); ?></td>
            </tr>
            <!-- WL rows -->
            <tr class="wl-row">
                <td>WL5</td>
                <td><?php echo ($total_wl5 >= 1000 ? ($total_wl5 / 1000) . " kg" : $total_wl5 . " g"); ?></td>
            </tr>
            <tr class="wl-row">
                <td>WL6</td>
                <td><?php echo ($total_wl6 >= 1000 ? ($total_wl6 / 1000) . " kg" : $total_wl6 . " g"); ?></td>
            </tr>
            <tr class="wl-row">
                <td>WL7</td>
                <td><?php echo ($total_wl7 >= 1000 ? ($total_wl7 / 1000) . " kg" : $total_wl7 . " g"); ?></td>
            </tr>
            <tr class="wl-row">
                <td>WL9</td>
                <td><?php echo ($total_wl9 >= 1000 ? ($total_wl9 / 1000) . " kg" : $total_wl9 . " g"); ?></td>
            </tr>
            <!-- LD rows -->
            <tr class="ld-row">
                <td>LD8</td>
                <td><?php echo ($total_ld8 >= 1000 ? ($total_ld8 / 1000) . " kg" : $total_ld8 . " g"); ?></td>
            </tr>
            <tr class="ld-row">
                <td>LD9</td>
                <td><?php echo ($total_ld9 >= 1000 ? ($total_ld9 / 1000) . " kg" : $total_ld9 . " g"); ?></td>
            </tr>
            <tr class="ld-row">
                <td>LD11</td>
                <td><?php echo ($total_ld11 >= 1000 ? ($total_ld11 / 1000) . " kg" : $total_ld11 . " g"); ?></td>
            </tr>
            <!-- DLD row -->
            <tr class="dld-row">
                <td>DLD</td>
                <td><?php echo ($total_dld >= 1000 ? ($total_dld / 1000) . " kg" : $total_dld . " g"); ?></td>
            </tr>
            <!-- PP row -->
            <tr class="pp-row">
                <td>PP</td>
                <td><?php echo ($total_pp >= 1000 ? ($total_pp / 1000) . " kg" : $total_pp . " g"); ?></td>
            </tr>
            <!-- CUPS rows -->
            <tr class="cups-row">
                <td>CUPS50</td>
                <td><?php echo ($total_cups50 >= 1000 ? ($total_cups50 / 1000) . " kg" : $total_cups50 . " g"); ?></td>
            </tr>
            <tr class="cups-row">
                <td>CUPS60</td>
                <td><?php echo ($total_cups60 >= 1000 ? ($total_cups60 / 1000) . " kg" : $total_cups60 . " g"); ?></td>
            </tr>
            <tr class="cups-row">
                <td>CUPS80</td>
                <td><?php echo ($total_cups80 >= 1000 ? ($total_cups80 / 1000) . " kg" : $total_cups80 . " g"); ?></td>
            </tr>
            <tr class="cups-row">
                <td>CUPS100</td>
                <td><?php echo ($total_cups100 >= 1000 ? ($total_cups100 / 1000) . " kg" : $total_cups100 . " g"); ?></td>
            </tr>
            <tr class="cups-row">
                <td>CUPS150</td>
                <td><?php echo ($total_cups150 >= 1000 ? ($total_cups150 / 1000) . " kg" : $total_cups150 . " g"); ?></td>
            </tr>
            <tr class="cups-row">
                <td>CUPS210</td>
                <td><?php echo ($total_cups210 >= 1000 ? ($total_cups210 / 1000) . " kg" : $total_cups210 . " g"); ?></td>
            </tr>
            <tr class="cups-row">
                <td>CUPS250</td>
                <td><?php echo ($total_cups250 >= 1000 ? ($total_cups250 / 1000) . " kg" : $total_cups250 . " g"); ?></td>
            </tr>
            <!-- BD rows -->
            <tr class="bd-row">
                <td>BD5</td>
                <td><?php echo ($total_bd5 >= 1000 ? ($total_bd5 / 1000) . " kg" : $total_bd5 . " g"); ?></td>
            </tr>
            <tr class="bd-row">
                <td>BD6</td>
                <td><?php echo ($total_bd6 >= 1000 ? ($total_bd6 / 1000) . " kg" : $total_bd6 . " g"); ?></td>
            </tr>
            <tr class="bd-row">
                <td>BD7</td>
                <td><?php echo ($total_bd7 >= 1000 ? ($total_bd7 / 1000) . " kg" : $total_bd7 . " g"); ?></td>
            </tr>
            <!-- CP rows -->
            <tr class="cp-row">
                <td>CP5</td>
                <td><?php echo ($total_cp5 >= 1000 ? ($total_cp5 / 1000) . " kg" : $total_cp5 . " g"); ?></td>
            </tr>
            <tr class="cp-row">
                <td>CP6</td>
                <td><?php echo ($total_cp6 >= 1000 ? ($total_cp6 / 1000) . " kg" : $total_cp6 . " g"); ?></td>
            </tr>
            <tr class="cp-row">
                <td>CP7</td>
                <td><?php echo ($total_cp7 >= 1000 ? ($total_cp7 / 1000) . " kg" : $total_cp7 . " g"); ?></td>
            </tr>
            <tr class="cp-row">
                <td>CP9</td>
                <td><?php echo ($total_cp9 >= 1000 ? ($total_cp9 / 1000) . " kg" : $total_cp9 . " g"); ?></td>
            </tr>
        </table>
    </div>
</body>

</html>