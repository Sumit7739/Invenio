<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_invent.css">
    <title>Toggleable Container</title>
</head>

<body>
    <div class="content-row">
        <button type="button" class="toggle-btn"><a href="addmore_inventory.php">CREATE NEW</a></button>
        <a href="manage_system.php" class="toggle-buttons">
            <i id="homeIcon" class="fas fa-home"></i>
        </a>
        <br>
    </div>
    <input type="date" id="calendar" required>
    <button id="search-btn">Search</button>
    <button type="button" class="clear-btn"><a href="view_moreinventory.php">Clear</a></button>
    <button class="sort-btn" onclick="toggleSorting()">Sort <i id="sortIcon" class="fas fa-sort"></i></button>
    <hr>

    <section id="dataSection">
        <?php

        include('config.php');


        // SQL query to fetch data in descending order based on the date
        $sql = "SELECT id, date, py8, py9
        FROM moreinventory_item 
        ORDER BY date DESC";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // Inside the while loop for fetching data
            while ($row = $result->fetch_assoc()) {
                $containerId = "container_" . $row["id"]; // Assuming "id" is the unique identifier in your database
                echo "<div class='container' id='$containerId'>"; // Use the container ID here
                echo "<div class='content-row'>";
                echo "<h3 id='date_$containerId' onclick='toggleContainer(\"$containerId\")'>Date - " . $row["date"] . "</h3>"; // Append container ID to date element ID
                echo "<a href='viewinventory_data.php?id=" . $row["id"] . "'>View</a>";
                echo "</div>";
                // echo "<h3 class='hidden'>Name - " . $row["name"] . "</h3>";
                // Rest of the code


                // Count the number of items with non-null or non-zero values
                $itemCount = 0;
                $columns = array("py8", "py9");
                foreach ($columns as $col) {
                    if (!empty($row[$col]) && $row[$col] != "0") {
                        $itemCount++;
                    }
                }

                echo "<h3 class='hidden'>Items - " . $itemCount . " of 2</h3>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        // Close connection
        $conn->close();
        ?>
    </section>
    <script src="script_invent.js"></script>
</body>

</html>