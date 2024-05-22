<?php
// Database connection parameters
include('config.php');

try {
    // Attempt database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Initialize arrays to store summed data and units
    $attributes = array(
        'bl5' => 'kg', 'bl6' => 'kg', 'bl7' => 'kg', 'bl9' => 'kg',
        'sp5' => 'kg', 'sp6' => 'kg', 'sp7' => 'kg', 'sp9' => 'kg',
        'wl5' => 'kg', 'wl6' => 'kg', 'wl7' => 'kg', 'wl9' => 'kg',
        'ld8' => 'kg', 'ld9' => 'kg', 'ld11' => 'kg', 'dld' => 'kg',
        'pp' => 'kg', 'cups50' => 'k', 'cups60' => 'k', 'cups80' => 'k',
        'cups100' => 'k', 'cups150' => 'k', 'cups210' => 'k', 'cups250' => 'k',
        'bd5' => 'kg', 'bd6' => 'kg', 'bd7' => 'kg', 'cp5' => 'kg',
        'cp6' => 'kg', 'cp7' => 'kg', 'cp9' => 'kg'
    );

    // Initialize arrays to store summed data
    $inventory_sums = array();
    $sales_sums = array();
    $remaining_quantities = array();

    // Fetch units from inventory_units table
    $inventory_units_sql = "SELECT * FROM inventory_unit";
    $inventory_units_result = $conn->query($inventory_units_sql);
    $inventory_units = array();
    if ($inventory_units_result->num_rows > 0) {
        while ($row = $inventory_units_result->fetch_assoc()) {
            $inventory_units[$row['item_id']] = $row;
        }
    }

    // Fetch units from sales_units table
    $sales_units_sql = "SELECT * FROM sales_unit";
    $sales_units_result = $conn->query($sales_units_sql);
    $sales_units = array();
    if ($sales_units_result->num_rows > 0) {
        while ($row = $sales_units_result->fetch_assoc()) {
            $sales_units[$row['item_id']] = $row;
        }
    }

    // Sum up inventory data
    foreach ($attributes as $attribute => $unit) {
        $sql = "SELECT SUM($attribute) AS total FROM inventory_item";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $inventory_sums[$attribute] = $row['total'];
    }

    // Sum up sales data
    foreach ($attributes as $attribute => $unit) {
        $sql = "SELECT SUM($attribute) AS total FROM sales_item";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sales_sums[$attribute] = $row['total'];
    }

    // Calculate remaining quantities and store data with units
    foreach ($attributes as $attribute => $unit) {
        $remaining_quantities[$attribute] = $inventory_sums[$attribute] - $sales_sums[$attribute];
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="stock.css">
    <title>Inventory and Sales Data</title>
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
    <h2>Stock Table</h2>
    <div class="table">
        <table>
            <tr>
                <th>Item Name</th>
                <th>Inventory Quantity</th>
                <th>Sales Quantity</th>
                <th>Remaining Quantity</th>
            </tr>
            <?php foreach ($attributes as $attribute => $unit) : ?>
                <tr>
                    <td><?php echo $attribute; ?></td>
                    <td><?php echo $inventory_sums[$attribute] . ' ' . $unit; ?></td>
                    <td><?php echo $sales_sums[$attribute] . ' ' . $unit; ?></td>
                    <td><?php echo $remaining_quantities[$attribute] . ' ' . $unit; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>