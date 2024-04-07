<?php
// Include database connection file
include 'db_connection.php';

// SQL query to fetch all data from sales_item and sales_unit
$sql = "SELECT ii.*, iu.*
        FROM sales_item AS ii
        INNER JOIN sales_unit AS iu ON ii.id = iu.item_id";

// Prepare and execute the SQL query
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Access columns from both tables
        $item_id = $row['id'];
        $item_name = $row['name'];
        $item_date = $row['date'];
        $bl5 = $row["bl5"];
        $bl5_unit = $row["bl5_unit"];
        $bl6 = $row["bl6"];
        $bl6_unit = $row["bl6_unit"];
        $bl7 = $row["bl7"];
        $bl7_unit = $row["bl7_unit"];
        $bl9 = $row["bl9"];
        $bl9_unit = $row["bl9_unit"];
        $sp5 = $row["sp5"];
        $sp5_unit = $row["sp5_unit"];
        $sp6 = $row["sp6"];
        $sp6_unit = $row["sp6_unit"];
        $sp7 = $row["sp7"];
        $sp7_unit = $row["sp7_unit"];
        $sp9 = $row["sp9"];
        $sp9_unit = $row["sp9_unit"];
        $wl5 = $row["wl5"];
        $wl5_unit = $row["wl5_unit"];
        $wl6 = $row["wl6"];
        $wl6_unit = $row["wl6_unit"];
        $wl7 = $row["wl7"];
        $wl7_unit = $row["wl7_unit"];
        $wl9 = $row["wl9"];
        $wl9_unit = $row["wl9_unit"];
        $ld8 = $row["ld8"];
        $ld8_unit = $row["ld8_unit"];
        $ld9 = $row["ld9"];
        $ld9_unit = $row["ld9_unit"];
        $ld11 = $row["ld11"];
        $ld11_unit = $row["ld11_unit"];
        $dld = $row["dld"];
        $dld_unit = $row["dld_unit"];
        $pp = $row["pp"];
        $pp_unit = $row["pp_unit"];
        $cups50 = $row["cups50"];
        $cups50_unit = $row["cups50_unit"];
        $cups60 = $row["cups60"];
        $cups60_unit = $row["cups60_unit"];
        $cups80 = $row["cups80"];
        $cups80_unit = $row["cups80_unit"];
        $cups100 = $row["cups100"];
        $cups100_unit = $row["cups100_unit"];
        $cups150 = $row["cups150"];
        $cups150_unit = $row["cups150_unit"];
        $cups210 = $row["cups210"];
        $cups210_unit = $row["cups210_unit"];
        $cups250 = $row["cups250"];
        $cups250_unit = $row["cups250_unit"];
        $bd5 = $row["bd5"];
        $bd5_unit = $row["bd5_unit"];
        $bd6 = $row["bd6"];
        $bd6_unit = $row["bd6_unit"];
        $bd7 = $row["bd7"];
        $bd7_unit = $row["bd7_unit"];
        $cp5 = $row["cp5"];
        $cp5_unit = $row["cp5_unit"];
        $cp6 = $row["cp6"];
        $cp6_unit = $row["cp6_unit"];
        $cp7 = $row["cp7"];
        $cp7_unit = $row["cp7_unit"];
        $cp9 = $row["cp9"];
        $cp9_unit = $row["cp9_unit"];
        // Access other columns as needed...

        // Display or process the data as required
        echo "Item ID: $item_id, Name: $item_name, Date: $item_date<br>";
        // Display or process other columns as needed...
    }
} else {
    echo "No results found.";
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>