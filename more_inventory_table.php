<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="sales_table.css">
    <title>Sales Table</title>
</head>

<body>
    <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
    <h1>Sales Tables</h1>
    <h2>Select Date Range</h2>
    <form id="calendar_container" method="post">
        <label for="start-date">Start Date:</label>
        <input type="date" id="start-date" name="start-date" required>
        <a href="inventory_table.php"><button type="button" id="search-btn">clear</button></a> <br>
        <label for="end-date">End Date:</label>
        <input type="date" id="end-date" name="end-date" required>
        <button id="search-btn" type="submit">Fetch Data</button>
    </form>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start-date']) && isset($_POST['end-date'])) {
        // var_dump($total_bl5);
        $items = []; // Store decimal numbers
        $units = [];
        // Get start and end dates from the form
        $startDate = $_POST['start-date'];
        $endDate = $_POST['end-date'];

        // Your database connection code (e.g., include('config.php');)
        include('config.php');

        // Example SQL query (replace with your actual query)
        $sql = "SELECT id, date, py8, py9 FROM moreinventory_item WHERE date BETWEEN ? AND ?";
        // Prepare the SQL query
        $stmt = $conn->prepare($sql);
        // Bind parameters to the prepared statement
        $stmt->bind_param("ss", $startDate, $endDate);
        // Execute the prepared statement
        $stmt->execute();
        // Get the result of the query
        $result = $stmt->get_result();

        // Check if there are rows returned
        if ($result->num_rows > 0) {
            // Output data from database
            echo "<h2>Results:</h2>";
            echo "<table border='1'>";

            while ($row = $result->fetch_assoc()) {
                // Store item data in the $items array
                $items[$row['id']] = $row;
            }

            echo "</table>";

            // Example SQL query for inventory_unit (replace with your actual query)
            $sql_units = "SELECT item_id, payal8_unit, payal9_unit FROM moreinventory_unit WHERE item_id IN (" . implode(',', array_keys($items)) . ")";

            // Prepare the SQL query for inventory_unit
            $stmt_units = $conn->prepare($sql_units);
            // Execute the prepared statement for inventory_unit
            $stmt_units->execute();
            // Get the result of the query for inventory_unit
            $result_units = $stmt_units->get_result();

            if ($result_units->num_rows > 0) {
                // Fetch data and store in arrays for inventory_unit
                while ($row_units = $result_units->fetch_assoc()) {
                    $units[$row_units['item_id']] = $row_units; // Store the entire row
                }
            } else {
                echo "No rows found in inventory_unit.";
            }

            // Close the prepared statement for inventory_unit
            $stmt_units->close();

            // Initialize variables for total sums

            $total_bl5 = 0;
            $total_bl6 = 0;

            // Loop through items to calculate total sums
            foreach ($items as $item_id => $item_data) {
                $unit_data = $units[$item_id];

                // Update total sums based on the type of item
                @$total_bl5 += ($unit_data['payal8_unit'] === 'kg' ? $item_data['py8'] * 1000 : $item_data['py8']);
                @$total_bl6 += ($unit_data['payal9_unit'] === 'kg' ? $item_data['py9'] * 1000 : $item_data['py9']);
                // Update other total sums similarly for SP, WL, LD, DLD, PP, CUPS, BD, CP

            }

            // Close the database connection
            $conn->close();
        } else {
            echo "No results found.";
        }
    } else {
        echo "Please select a date range.";
    }
    ?>

    <div id="inventory-table" style="overflow-x: auto;" class="table hidden">
        <table>
            <tr>
                <th>Item</th>
                <th>Total Weight</th>
            </tr>
            <!-- BL rows -->
            <tr class="bl-row">
                <td>PY8</td>
                <td><?php echo (@$total_bl5 >= 1000 ? (@$total_bl5 / 1000) . " kg" : @$total_bl5 . " g"); ?></td>
            </tr>
            <tr class="bl-row">
                <td>PY9</td>
                <td><?php echo (@$total_bl6 >= 1000 ? @($total_bl6 / 1000) . " kg" : @$total_bl6 . " g"); ?></td>
            </tr>
        </table>
    </div>
</body>

</html>