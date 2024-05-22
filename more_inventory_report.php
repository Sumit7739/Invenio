<?php
include('config.php');

$sqlInventoryPY = "SELECT py8, py9 FROM moreinventory_item";
$resultInventoryPY = $conn->query($sqlInventoryPY);

$inventoryPYData = [];

if ($resultInventoryPY->num_rows > 0) {
    $inventoryPYData = $resultInventoryPY->fetch_assoc();
} else {
    $inventoryPYData = ['py8' => 0, 'py9' => 0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="more_sales_report.css">
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
    <div class="container">
        <h1 style="text-align: center;">Inventory Report</h1>

        <div class="chart-container">
            <h2 class="chart-title">PAYAL LD Items Distribution</h2>
            <canvas id="inventoryPYChart"></canvas>
            <p class="chart-description">Insights: This chart shows the distribution of <strong> PY </strong> in the inventory.</p>
        </div>
    </div>
    <script>
        const inventoryPyData = <?php echo json_encode($inventoryPYData); ?>;
    </script>
    <script src="more_sales_report.js"></script>
</body>

</html>