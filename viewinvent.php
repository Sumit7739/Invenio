<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Toggleable Container</title>
    <style>
        .container {
            height: auto;
            margin-top: 20px;
            padding: 5px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .container h3 {
            color: #333366;
            font-weight: 400;
            font-size: 16px;
        }

        .container a {
            text-decoration: none;
            color: #ff0000;
            font-weight: 600;
        }

        .hidden {
            display: none;
        }

        .content-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .content-row a {
            margin-right: 10px;
        }

        #date {
            cursor: pointer;
        }

        .toggle-buttons {
            position: absolute;
            top: 3%;
            right: 0;
            margin-right: 30px;
            width: 50px;
            cursor: pointer;
            font-size: 30px;
        }

        .toggle-btn {
            width: 60%;
            position: relative;
            margin: 0 auto;
            padding: 12px 16px;
            background-color: #007bff;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            margin-top: 65px;
            margin-bottom: 20px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .toggle-btn a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
        }

        .toggle-btn:hover {
            background-color: #0056b3;
        }

        #date,
        .toggle-buttons {
            cursor: pointer;
        }

        #calendar {
            width: 150px;
            height: 30px;
            padding: 3px 6px;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        #search-btn {
            padding: 8px 16px;
            background-color: #fff;
            color: #000;
            border: 1px solid #ccc;
            cursor: pointer;
            border-radius: 16px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        #search-btn:hover {
            background-color: #e2e2e2cb;
        }

        .clear-btn {
            padding: 8px 16px;
            background-color: #fff;
            color: #000;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .clear-btn a {
            text-decoration: none;
            color: #000;
        }

        .clear-btn:hover {
            background-color: #ccc;
        }

        /* Sorting button styles */
        .sort-btn {
            padding: 8px 16px;
            background-color: #fff;
            color: #000;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .sort-btn:hover {
            background-color: #ccc;
        }

        /* Sorting icon styles */
        .sort-icon {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .rotate {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <div class="content-row">
        <button type="button" class="toggle-btn"><a href="invent.html">CREATE NEW</a></button>
        <a href="index.html" class="toggle-buttons">
            <i id="homeIcon" class="fas fa-home"></i>
        </a>
        <br>
    </div>
    <input type="date" id="calendar" required>
    <button id="search-btn">Search</button>
    <button type="button" class="clear-btn"><a href="viewinvent.php">Clear</a></button>
    <button class="sort-btn" onclick="toggleSorting()">Sort <i id="sortIcon" class="fas fa-sort"></i></button>
    <hr>

    <section id="dataSection">
        <?php
        // Define database connection credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ppwala";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to fetch data in descending order based on the date
        $sql = "SELECT id, date, name, bl5, bl6, bl7, bl9, sp5, sp6, sp7, sp9, wl5, wl6, wl7, wl9, ld8, ld9, ld11, dld, pp, cups50, cups60, cups80, cups100, cups150, cups210, cups250, bd5, bd6, bd7, cp5, cp6, cp7, cp9 
        FROM inventory_item 
        ORDER BY date DESC";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            // Inside the while loop for fetching data
            while ($row = $result->fetch_assoc()) {
                $containerId = "container_" . $row["id"]; // Assuming "id" is the unique identifier in your database
                echo "<div class='container' id='$containerId'>"; // Use the container ID here
                echo "<div class='content-row'>";
                echo "<h3 id='date_$containerId' onclick='toggleContainer(\"$containerId\")'>Date - " . $row["date"] . "</h3>"; // Append container ID to date element ID
                echo "<a href='#'>View</a>";
                echo "</div>";
                echo "<h3 class='hidden'>Name - " . $row["name"] . "</h3>";
                // Rest of the code


                // Count the number of items with non-null or non-zero values
                $itemCount = 0;
                $columns = array("bl5", "bl6", "bl7", "bl9", "sp5", "sp6", "sp7", "sp9", "wl5", "wl6", "wl7", "wl9", "ld8", "ld9", "ld11", "dld", "pp", "cups50", "cups60", "cups80", "cups100", "cups150", "cups210", "cups250", "bd5", "bd6", "bd7", "cp5", "cp6", "cp7", "cp9");
                foreach ($columns as $col) {
                    if (!empty($row[$col]) && $row[$col] != "0") {
                        $itemCount++;
                    }
                }

                echo "<h3 class='hidden'>Items - " . $itemCount . " of 31</h3>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        // Close connection
        $conn->close();
        ?>
    </section>

    <script>
        function toggleContainer(containerId) {
            const nameSection = document.querySelector(`#${containerId} h3:nth-child(2)`); // Use container ID in the query selector
            const itemsSection = document.querySelector(`#${containerId} h3:nth-child(3)`); // Use container ID in the query selector

            nameSection.classList.toggle('hidden');
            itemsSection.classList.toggle('hidden');
        }

        let isAscending = false; // Initial sorting order

        function toggleSorting() {
            isAscending = !isAscending; // Toggle sorting order
            const sortIcon = document.getElementById('sortIcon');
            sortIcon.classList.toggle('rotate', isAscending); // Rotate the icon based on sorting order

            // Get all container elements
            const containers = document.querySelectorAll('.container');

            // Convert NodeList to an array for easier manipulation
            const containersArray = Array.from(containers);

            // Reorder the containers based on the sorting order
            const sortedContainers = containersArray.sort((a, b) => {
                const dateA = new Date(a.querySelector('h3').innerText.split(' - ')[1]);
                const dateB = new Date(b.querySelector('h3').innerText.split(' - ')[1]);

                return isAscending ? dateA - dateB : dateB - dateA;
            });

            // Clear the existing content in dataSection
            const dataSection = document.getElementById("dataSection");
            dataSection.innerHTML = '';

            // Append the sorted containers to dataSection
            sortedContainers.forEach(container => {
                dataSection.appendChild(container);
            });
        }

        document.getElementById('search-btn').addEventListener('click', function() {
            const inputDate = document.getElementById('calendar').value;
            const containers = document.querySelectorAll('.container');
            const resultsSection = document.getElementById('dataSection');

            // Format the input date to YYYY-MM-DD format
            const inputDateFormatted = formatDate(inputDate);

            // Filter containers based on inputDate
            const filteredContainers = Array.from(containers).filter(container => {
                const containerDate = container.querySelector('h3').textContent.split(' - ')[1].trim(); // Extract the date from the container's heading text
                return containerDate === inputDateFormatted;
            });

            // Reset previous search results
            resultsSection.innerHTML = '';

            // Display filtered containers or message if no results
            if (filteredContainers.length > 0) {
                filteredContainers.forEach(container => {
                    resultsSection.appendChild(container.cloneNode(true)); // Append the filtered containers to the results section
                });
            } else {
                const noResultsMessage = document.createElement('p');
                noResultsMessage.textContent = 'No data found for the selected date.';
                resultsSection.appendChild(noResultsMessage);
            }
        });

        // Function to format the date
        function formatDate(dateString) {
            const [year, month, day] = dateString.split('-');
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        }
    </script>

</body>

</html>