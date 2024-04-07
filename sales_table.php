<?php
if (!isset($_GET['selectedDate'])) {
    // If the date is not provided, display the form to enter the date
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Select Date</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                margin: 0;
                padding: 20px;
            }

            #selectedDate {
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
        </style>
    </head>

    <body>
        <h1>Select Date to View Sales Data</h1>
        <form action="sales_table.php" method="GET">
            <label for="selectedDate">Select Date:</label>
            <input type="date" id="selectedDate" name="selectedDate" required>
            <button id="search-btn" type="submit">Submit</button>
        </form>
    </body>

    </html>

    <?php
    // if (isset($_GET['selectedDate'])) {
} else {    // Include your database connection file
    include 'db_connection.php';

    // Get the selected date from the form
    $selectedDate = $_GET['selectedDate'];

    // Prepare a SQL query to fetch data from the selected date
    $sql = "SELECT id, bl5, bl6, bl7, bl9, sp5, sp6, sp7, sp9, wl5, wl6, wl7, wl9, ld8, ld9, ld11, dld, pp, cups50, cups60, cups80, cups100, cups150, cups210, cups250, bd5, bd6, bd7, cp5, cp6, cp7, cp9 FROM sales_item WHERE date = '$selectedDate'";

    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <title>Sales Data</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    margin: 0;
                    padding: 20px;
                }

                .back-icon {
                    position: absolute;
                    right: 0;
                    margin-right: 22px;
                    margin-top: 10px;
                    color: #333;
                    font-size: 30px;
                    cursor: pointer;
                }

                .table {
                    padding: 20px 10px;
                    margin-bottom: 20px;
                    border-radius: 8px;
                    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
                    overflow-x: auto;
                    /* Enable horizontal scrolling */
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th,
                td {
                    padding: 8px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }

                th {
                    background-color: #f2f2f2;
                    color: #333;
                }

                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                tr:hover {
                    background-color: #f1f1f1;
                }

                #selectedDate {
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
            </style>
        </head>

        <body>
            <a href="index.html" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
            <br>
            <br>
            <hr>
            <h1>Select Date to View Sales Data</h1>
            <form action="sales_table.php" method="GET">
                <label for="selectedDate">Select Date:</label>
                <input type="date" id="selectedDate" name="selectedDate" required>
                <button id="search-btn" type="submit">Submit</button>
            </form>
            <h2>Sales Data</h2>
            <div class="table">
                <table>
                    <tr>
                        <th>Item</th>
                        <th>Total Weight</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>BL5</td>
                            <?php echo "<td>" . $row['bl5'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BL6</td>
                            <?php echo "<td>" . $row['bl6'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BL7</td>
                            <?php echo "<td>" . $row['bl7'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BL9</td>
                            <?php echo "<td>" . $row['bl9'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP5</td>
                            <?php echo "<td>" . $row['sp5'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP6</td>
                            <?php echo "<td>" . $row['sp6'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP7</td>
                            <?php echo "<td>" . $row['sp7'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP9</td>
                            <?php echo "<td>" . $row['sp9'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL5</td>
                            <?php echo "<td>" . $row['wl5'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL6</td>
                            <?php echo "<td>" . $row['wl6'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL7</td>
                            <?php echo "<td>" . $row['wl7'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL9</td>
                            <?php echo "<td>" . $row['wl9'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>LD8</td>
                            <?php echo "<td>" . $row['ld8'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>LD9</td>
                            <?php echo "<td>" . $row['ld9'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>LD11</td>
                            <?php echo "<td>" . $row['ld11'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>DLD</td>
                            <?php echo "<td>" . $row['dld'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>PP</td>
                            <?php echo "<td>" . $row['pp'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS50</td>
                            <?php echo "<td>" . $row['cups50'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS60</td>
                            <?php echo "<td>" . $row['cups60'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS80</td>
                            <?php echo "<td>" . $row['cups80'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS100</td>
                            <?php echo "<td>" . $row['cups100'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS150</td>
                            <?php echo "<td>" . $row['cups150'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS210</td>
                            <?php echo "<td>" . $row['cups210'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS250</td>
                            <?php echo "<td>" . $row['cups250'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BD5</td>
                            <?php echo "<td>" . $row['bd5'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BD6</td>
                            <?php echo "<td>" . $row['bd6'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BD7</td>
                            <?php echo "<td>" . $row['bd7'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP5</td>
                            <?php echo "<td>" . $row['cp5'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP6</td>
                            <?php echo "<td>" . $row['cp6'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP7</td>
                            <?php echo "<td>" . $row['cp7'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP9</td>
                            <?php echo "<td>" . $row['cp9'] . "</td>"; ?>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </body>

        </html>
        <<?php
        } else {
        $errorMessage = "No data found for the selected date.";
        header("Location: error.php?message=" . urlencode($errorMessage));
        exit();
        }

        // Close the database connection
        $conn->close();
    }
            ?>