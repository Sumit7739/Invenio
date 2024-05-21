<?php
// Check if ID is passed in the URL
if (isset($_GET['id'])) {

    include('config.php');


    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the ID from the URL
    $id = $_GET['id'];

    // Prepare and execute the SQL query with a join operation to fetch data from two tables
    $sql = "SELECT item.*, unit.* FROM moresales_item AS item INNER JOIN moresales_unit AS unit ON item.id = unit.id WHERE item.id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Store fetched data into variables
        // $name = $row['name'];
        $date = $row['date'];
        $py8 = $row["py8"];
        $payal8_unit = $row["payal8_unit"];
        $py9 = $row["py9"];
        $payal9_unit = $row["payal9_unit"];
       

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "No data found for the provided ID.";
        exit;
    }
} else {
    echo "ID not provided in the URL.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sales</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="form-container">
        <button class="toggle-button" onclick="toggleMode()">
            <i id="darkModeIcon" class="fas fa-moon"></i>
        </button>
        <a href="manage_system.php" class="toggle-buttons">
            <i id="homeIcon" class="fas fa-home"></i>
        </a>


        <h1>Sales</h1>
        <h2>Edit Items</h2>
        <form action="updatemore_sales.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>

            <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
            <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Payal LD <span id="toggleIcon">▼</span></label><br>
            <div id="blackLooseSection" class="container">

                <label for="py8">8-inch:</label>
                <input type="number" step="0.01" id="py8" name="py8" value="<?php echo $py8; ?>">
                <select id="payal8_unit" name="payal8_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($payal8_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($payal8_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>


                <label for="py9">9-inch:</label>
                <input type="number" step="0.01" id="py9" name="py9" value="<?php echo $py9; ?>">
                <select id="payal9_unit" name="payal9_unit">
                    <option value="" selected disabled hidden>Select Unit</option>
                    <option value="kg" <?php if ($payal9_unit == 'kg') echo 'selected'; ?>>kg</option>
                    <option value="g" <?php if ($payal9_unit == 'g') echo 'selected'; ?>>g</option>
                    <option value="default" style="display:none;">Default (not inserted)</option>
                </select><br><br>
            </div>
            <hr>

            <input type="submit" value="Submit">
        </form>
        <a href="sales.php">Go To Sales</a>
    </div>
    <script src="script.js"></script>
</body>

</html>