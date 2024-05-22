<?php
// Include database connection code here (not shown in this example)
include('config.php');

// Fetch data from inventory_item table for BL, SP, and WL categories
$sqlInventoryBL = "SELECT bl5, bl6, bl7, bl9 FROM sales_item";
$resultInventoryBL = $conn->query($sqlInventoryBL);
$inventoryBLData = $resultInventoryBL->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventorySP = "SELECT sp5, sp6, sp7, sp9 FROM sales_item";
$resultInventorySP = $conn->query($sqlInventorySP);
$inventorySPData = $resultInventorySP->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryWL = "SELECT wl5, wl6, wl7, wl9 FROM sales_item";
$resultInventoryWL = $conn->query($sqlInventoryWL);
$inventoryWLData = $resultInventoryWL->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryLD = "SELECT ld8, ld9, ld11, dld, pp FROM sales_item";
$resultInventoryLD = $conn->query($sqlInventoryLD);
$inventoryLDData = $resultInventoryLD->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryCups = "SELECT cups50, cups60, cups80, cups100, cups150, cups210, cups250 FROM sales_item";
$resultInventoryCups = $conn->query($sqlInventoryCups);
$inventoryCupsData = $resultInventoryCups->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryBD = "SELECT bd5, bd6, bd7 FROM sales_item";
$resultInventoryBD = $conn->query($sqlInventoryBD);
$inventoryBDData = $resultInventoryBD->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryCP = "SELECT cp5, cp6, cp7, cp9 FROM sales_item";
$resultInventoryCP = $conn->query($sqlInventoryCP);
$inventoryCPData = $resultInventoryCP->fetch_assoc(); // Assuming only one row in inventory table

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="sales_report.css">
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
    <div class="container">
        <h1 style="text-align: center;">Sales Report</h1>

        <div class="chart-container">
            <h2 class="chart-title">BL Items Distribution</h2>
            <canvas id="inventoryBLChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> BL </strong> in the inventory.</p>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">SP Items Distribution</h2>
            <canvas id="inventorySPChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> SP </strong> items in the inventory.</p>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">WL Items Distribution</h2>
            <canvas id="inventoryWLChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> WL </strong> items in the inventory.</p>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">LD Items Distribution</h2>
            <canvas id="inventoryLDChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> LD </strong> items in the inventory.</p>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">Cups Distribution</h2>
            <canvas id="inventoryCupsChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> CUPS </strong> items in the inventory.</p>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">BD Items Distribution</h2>
            <canvas id="inventoryBDChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> BD </strong> items in the inventory.</p>
        </div>

        <div class="chart-container">
            <h2 class="chart-title">CP Items Distribution</h2>
            <canvas id="inventoryCPChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> CP </strong> items in the inventory.</p>
        </div>
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