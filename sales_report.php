<?php
// Include database connection code here (not shown in this example)
include('config.php');

// Initialize variables to hold the sum of each category
$inventoryBLData = [
    'bl5' => 0,
    'bl6' => 0,
    'bl7' => 0,
    'bl9' => 0
];
$inventorySPData = [
    'sp5' => 0,
    'sp6' => 0,
    'sp7' => 0,
    'sp9' => 0
];
$inventoryWLData = [
    'wl5' => 0,
    'wl6' => 0,
    'wl7' => 0,
    'wl9' => 0
];
$inventoryLDData = [
    'ld8' => 0,
    'ld9' => 0,
    'ld11' => 0,
    'dld' => 0,
    'pp' => 0
];
$inventoryCupsData = [
    'cups50' => 0,
    'cups60' => 0,
    'cups80' => 0,
    'cups100' => 0,
    'cups150' => 0,
    'cups210' => 0,
    'cups250' => 0
];
$inventoryBDData = [
    'bd5' => 0,
    'bd6' => 0,
    'bd7' => 0
];
$inventoryCPData = [
    'cp5' => 0,
    'cp6' => 0,
    'cp7' => 0,
    'cp9' => 0
];

// Fetch data from the inventory_item table for all categories
$sqlInventory = "SELECT * FROM sales_item";
$resultInventory = $conn->query($sqlInventory);

if ($resultInventory->num_rows > 0) {
    // Iterate through all rows and sum the data
    while ($row = $resultInventory->fetch_assoc()) {
        $inventoryBLData['bl5'] += $row['bl5'];
        $inventoryBLData['bl6'] += $row['bl6'];
        $inventoryBLData['bl7'] += $row['bl7'];
        $inventoryBLData['bl9'] += $row['bl9'];

        $inventorySPData['sp5'] += $row['sp5'];
        $inventorySPData['sp6'] += $row['sp6'];
        $inventorySPData['sp7'] += $row['sp7'];
        $inventorySPData['sp9'] += $row['sp9'];

        $inventoryWLData['wl5'] += $row['wl5'];
        $inventoryWLData['wl6'] += $row['wl6'];
        $inventoryWLData['wl7'] += $row['wl7'];
        $inventoryWLData['wl9'] += $row['wl9'];

        $inventoryLDData['ld8'] += $row['ld8'];
        $inventoryLDData['ld9'] += $row['ld9'];
        $inventoryLDData['ld11'] += $row['ld11'];
        $inventoryLDData['dld'] += $row['dld'];
        $inventoryLDData['pp'] += $row['pp'];

        $inventoryCupsData['cups50'] += $row['cups50'];
        $inventoryCupsData['cups60'] += $row['cups60'];
        $inventoryCupsData['cups80'] += $row['cups80'];
        $inventoryCupsData['cups100'] += $row['cups100'];
        $inventoryCupsData['cups150'] += $row['cups150'];
        $inventoryCupsData['cups210'] += $row['cups210'];
        $inventoryCupsData['cups250'] += $row['cups250'];

        $inventoryBDData['bd5'] += $row['bd5'];
        $inventoryBDData['bd6'] += $row['bd6'];
        $inventoryBDData['bd7'] += $row['bd7'];

        $inventoryCPData['cp5'] += $row['cp5'];
        $inventoryCPData['cp6'] += $row['cp6'];
        $inventoryCPData['cp7'] += $row['cp7'];
        $inventoryCPData['cp9'] += $row['cp9'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style_main.css">
    <!-- <link rel="stylesheet" href="sales_report.css"> -->
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* overflow: hidden; */
        }


        /* Container for the chart */
        .chart-container {
            width: 100%;
            /* margin-top: 60px; */
            margin-left: 130px;
            /* Use full width of the viewport */
            max-width: 1710px;
            /* Ensures chart doesn't get too wide */
            height: 100%;
            /* Occupy most of the screen height */
            /* max-height: 800px; */
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        /* Canvas styling for the chart */
        canvas {
            flex-grow: 1;
            margin: 0 auto;
            width: 100% !important;
            height: 100% !important;
        }

        /* Optional title styling */
        .chart-title {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Improve font size for axis labels */
        .chart-labels,
        .chart-description {
            font-size: 20px;
        }

        .submenu .active {
            color: rgb(43, 255, 0);
        }
    </style>
</head>

<body>
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
                        <a href="sales_report.php" class="active">Sales Report</a>
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

    <div class="chart-container">
        <h2 class="chart-title">Sales Overview</h2>
        <canvas id="verticalChart"></canvas>
    </div>


    <script>
        // Convert PHP data to JavaScript variables
        const inventoryBLData = <?php echo json_encode($inventoryBLData); ?>;
        const inventorySPData = <?php echo json_encode($inventorySPData); ?>;
        const inventoryWLData = <?php echo json_encode($inventoryWLData); ?>;
        const inventoryLDData = <?php echo json_encode($inventoryLDData); ?>;
        const inventoryCupsData = <?php echo json_encode($inventoryCupsData); ?>;
        const inventoryBDData = <?php echo json_encode($inventoryBDData); ?>;
        const inventoryCPData = <?php echo json_encode($inventoryCPData); ?>;
    </script>
    <script src="sales_report.js"></script>
</body>

</html>