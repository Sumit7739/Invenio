<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start-date']) && isset($_POST['end-date'])) {
    // Get start and end dates from the form
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];

    // Your database connection code (e.g., include('config.php');)
    include('config.php');

    // Example SQL query (replace with your actual query)
    $sql = "SELECT id, date, bl5, bl6, bl7, bl9, sp5, sp6, sp7, sp9, wl5, wl6, wl7, wl9, ld8, ld9, ld11, dld, pp, cups50, cups60, cups80, cups100, cups150, cups210, cups250, bd5, bd6, bd7, cp5, cp6, cp7, cp9 FROM inventory_item WHERE date BETWEEN '$startDate' AND '$endDate'";

    // $sql = "SELECT * FROM your_table WHERE date_column BETWEEN '$startDate' AND '$endDate'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data from database
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Date: " . $row["date"] . "<br>";
        }
    } else {
        echo "No results found.";
    }

    // Close database connection
    $conn->close();
} else {
    // Redirect or display error if form not submitted properly
    header("Location: your_form_page.php"); // Replace with the actual page URL
    exit();
}
