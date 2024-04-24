<?php
// Include database connection code here (not shown in this example)
include('config.php');

// Fetch data from inventory_item table for BL, SP, and WL categories
$sqlInventoryBL = "SELECT bl5, bl6, bl7, bl9 FROM inventory_item";
$resultInventoryBL = $conn->query($sqlInventoryBL);
$inventoryBLData = $resultInventoryBL->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventorySP = "SELECT sp5, sp6, sp7, sp9 FROM inventory_item";
$resultInventorySP = $conn->query($sqlInventorySP);
$inventorySPData = $resultInventorySP->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryWL = "SELECT wl5, wl6, wl7, wl9 FROM inventory_item";
$resultInventoryWL = $conn->query($sqlInventoryWL);
$inventoryWLData = $resultInventoryWL->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryLD = "SELECT ld8, ld9, ld11, dld, pp FROM inventory_item";
$resultInventoryLD = $conn->query($sqlInventoryLD);
$inventoryLDData = $resultInventoryLD->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryCups = "SELECT cups50, cups60, cups80, cups100, cups150, cups210, cups250 FROM inventory_item";
$resultInventoryCups = $conn->query($sqlInventoryCups);
$inventoryCupsData = $resultInventoryCups->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryBD = "SELECT bd5, bd6, bd7 FROM inventory_item";
$resultInventoryBD = $conn->query($sqlInventoryBD);
$inventoryBDData = $resultInventoryBD->fetch_assoc(); // Assuming only one row in inventory table

$sqlInventoryCP = "SELECT cp5, cp6, cp7, cp9 FROM inventory_item";
$resultInventoryCP = $conn->query($sqlInventoryCP);
$inventoryCPData = $resultInventoryCP->fetch_assoc(); // Assuming only one row in inventory table

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .back-icon {
            position: absolute;
            right: 0;
            padding: 20px;
            margin-right: 30px;
            margin-top: 10px;
            margin-bottom: 50px;
            color: #333;
            font-size: 65px;
            cursor: pointer;
        }

        h1 {
            margin-top: 150px;
            font-size: 60px;
        }

        .container {
            width: 100%;
            height: 80vh;
            padding: 10px;
            box-sizing: border-box;
        }

        .chart-container {
            width: 100%;
            height: 60vh;
            max-width: 1000px;
            /* Increased max-width */
            margin: 10px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chart-title {
            font-size: 35px;
            /* Increased font size */
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            background-color: #007bff;
            color: #fff;
            margin: 0;
        }

        .chart-labels {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .chart-description {
            font-size: 28px;
            /* Increased font size */
            text-align: center;
            padding: 10px;
            margin: 0;
        }

        /* Increased font size for tooltips */
        .chartjs-tooltip {
            font-size: 26px;
            font-family: Arial, sans-serif;
        }

        /* @media only screen and (min-width: 768px) {
            .chart-container {
                max-width: 800px;
            }
        } */
    </style>
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
    <div class="container">
        <h1 style="text-align: center;">Inventory Report</h1>

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

        // Define labels arrays
        const labelsBL = ['bl5', 'bl6', 'bl7', 'bl9'];
        const labelsSP = ['sp5', 'sp6', 'sp7', 'sp9'];
        const labelsWL = ['wl5', 'wl6', 'wl7', 'wl9'];
        const labelsLD = ['ld8', 'ld9', 'ld11', 'dld', 'pp'];
        const labelsCups = ['cups50', 'cups60', 'cups80', 'cups100', 'cups150', 'cups210', 'cups250'];
        const labelsBD = ['bd5', 'bd6', 'bd7'];
        const labelsCP = ['cp5', 'cp6', 'cp7', 'cp9'];

        Chart.defaults.font.size = 35;
        const options = {
            // Other chart options
            plugins: {
                tooltip: {
                    bodyFont: {
                        size: 30 // Increase tooltip body font size (default is 12)
                    },
                    titleFont: {
                        size: 40 // Increase tooltip title font size (default is 16)
                    }
                }
            }
        };

        const inventoryBLChartCtx = document.getElementById('inventoryBLChart').getContext('2d');
        const inventoryBLChart = new Chart(inventoryBLChartCtx, {
            type: 'pie',
            data: {
                labels: labelsBL,
                datasets: [{
                    label: 'Inventory BL Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventoryBLData)
                }]
            },
            options: options // Use the defined options object here
        });

        // Repeat for all other charts using the same options object

        const inventorySPChartCtx = document.getElementById('inventorySPChart').getContext('2d');
        const inventorySPChart = new Chart(inventorySPChartCtx, {
            type: 'pie',
            data: {
                labels: labelsSP,
                datasets: [{
                    label: 'Inventory SP Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventorySPData)
                }]
            }
        });

        const inventoryWLChartCtx = document.getElementById('inventoryWLChart').getContext('2d');
        const inventoryWLChart = new Chart(inventoryWLChartCtx, {
            type: 'pie',
            data: {
                labels: labelsWL,
                datasets: [{
                    label: 'Inventory WL Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventoryWLData)
                }]
            }
        });

        const inventoryLDChartCtx = document.getElementById('inventoryLDChart').getContext('2d');
        const inventoryLDChart = new Chart(inventoryLDChartCtx, {
            type: 'pie',
            data: {
                labels: labelsLD,
                datasets: [{
                    label: 'Inventory LD Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventoryLDData)
                }]
            }
        });

        const inventoryCupsChartCtx = document.getElementById('inventoryCupsChart').getContext('2d');
        const inventoryCupsChart = new Chart(inventoryCupsChartCtx, {
            type: 'pie',
            data: {
                labels: labelsCups,
                datasets: [{
                    label: 'Inventory Cups Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventoryCupsData)
                }]
            }
        });

        const inventoryBDChartCtx = document.getElementById('inventoryBDChart').getContext('2d');
        const inventoryBDChart = new Chart(inventoryBDChartCtx, {
            type: 'pie',
            data: {
                labels: labelsBD,
                datasets: [{
                    label: 'Inventory BD Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventoryBDData)
                }]
            }
        });

        const inventoryCPChartCtx = document.getElementById('inventoryCPChart').getContext('2d');
        const inventoryCPChart = new Chart(inventoryCPChartCtx, {
            type: 'pie',
            data: {
                labels: labelsCP,
                datasets: [{
                    label: 'Inventory CP Quantities',
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    data: Object.values(inventoryCPData)
                }]
            }
        });
    </script>
</body>

</html>