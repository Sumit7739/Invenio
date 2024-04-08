<?php

if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}
if (!isset($_GET['selectedDate'])) {
    // If the date is not provided, display the form to enter the date
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <title>Select Date</title>
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
        <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
        <h1>Select Date to View Inventory Data</h1>
        <form action="inventory_table.php" method="GET">
            <label for="selectedDate">Select Date:</label>
            <input type="date" id="selectedDate" name="selectedDate" required>
            <button id="search-btn" type="submit">Submit</button>
        </form>
    </body>

    </html>

    <?php
    // if (isset($_GET['selectedDate'])) {
} else {    // Include your database connection file
    include('config.php');

    // Get the selected date from the form or URL parameter
    $selectedDate = $_GET['selectedDate']; // Assuming it's coming from a GET request

    // Use prepared statements to avoid SQL injection
    $sql = "SELECT i.id, i.bl5, i.bl6, i.bl7, i.bl9, i.sp5, i.sp6, i.sp7, i.sp9, i.wl5, i.wl6, i.wl7, i.wl9, i.ld8, i.ld9, i.ld11, i.dld, i.pp, i.cups50, i.cups60, i.cups80, i.cups100, i.cups150, i.cups210, i.cups250, i.bd5, i.bd6, i.bd7, i.cp5, i.cp6, i.cp7, i.cp9,
                    u.bl5_unit, u.bl6_unit, u.bl7_unit, u.bl9_unit, u.sp5_unit, u.sp6_unit, u.sp7_unit, u.sp9_unit, u.wl5_unit, u.wl6_unit, u.wl7_unit, u.wl9_unit, u.ld8_unit, u.ld9_unit, u.ld11_unit, u.dld_unit, u.pp_unit, u.cups50_unit, u.cups60_unit, u.cups80_unit, u.cups100_unit, u.cups150_unit, u.cups210_unit, u.cups250_unit, u.bd5_unit, u.bd6_unit, u.bd7_unit, u.cp5_unit, u.cp6_unit, u.cp7_unit, u.cp9_unit 
            FROM inventory_item i
            JOIN inventory_unit u ON i.id = u.item_id
            WHERE i.date = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $selectedDate);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <title>Inventory Data</title>
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
            <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
            <br>
            <br>
            <hr>
            <h1>Select Date to View Inventory Data</h1>
            <form action="inventory_table.php" method="GET">
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
                            <?php echo "<td>" . $row['bl5'] . $row['bl5_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BL6</td>
                            <?php echo "<td>" . $row['bl6'] . $row['bl6_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BL7</td>
                            <?php echo "<td>" . $row['bl7'] . $row['bl7_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BL9</td>
                            <?php echo "<td>" . $row['bl9'] . $row['bl9_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP5</td>
                            <?php echo "<td>" . $row['sp5'] . $row['sp5_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP6</td>
                            <?php echo "<td>" . $row['sp6'] . $row['sp6_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP7</td>
                            <?php echo "<td>" . $row['sp7'] . $row['sp7_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>SP9</td>
                            <?php echo "<td>" . $row['sp9'] . $row['sp9_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL5</td>
                            <?php echo "<td>" . $row['wl5'] . $row['wl5_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL6</td>
                            <?php echo "<td>" . $row['wl6'] . $row['wl6_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL7</td>
                            <?php echo "<td>" . $row['wl7'] . $row['wl7_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>WL9</td>
                            <?php echo "<td>" . $row['wl9'] . $row['wl9_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>LD8</td>
                            <?php echo "<td>" . $row['ld8'] . $row['ld8_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>LD9</td>
                            <?php echo "<td>" . $row['ld9'] . $row['ld9_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>LD11</td>
                            <?php echo "<td>" . $row['ld11'] . $row['ld11_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>DLD</td>
                            <?php echo "<td>" . $row['dld'] . $row['dld_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>PP</td>
                            <?php echo "<td>" . $row['pp'] . $row['pp_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS50</td>
                            <?php echo "<td>" . $row['cups50'] . $row['cups50_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS60</td>
                            <?php echo "<td>" . $row['cups60'] . $row['cups60_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS80</td>
                            <?php echo "<td>" . $row['cups80'] . $row['cups80_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS100</td>
                            <?php echo "<td>" . $row['cups100'] . $row['cups100_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS150</td>
                            <?php echo "<td>" . $row['cups150'] . $row['cups150_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS210</td>
                            <?php echo "<td>" . $row['cups210'] . $row['cups210_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CUPS250</td>
                            <?php echo "<td>" . $row['cups250'] . $row['cups250_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BD5</td>
                            <?php echo "<td>" . $row['bd5'] . $row['bd5_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BD6</td>
                            <?php echo "<td>" . $row['bd6'] . $row['bd6_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>BD7</td>
                            <?php echo "<td>" . $row['bd7'] . $row['bd7_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP5</td>
                            <?php echo "<td>" . $row['cp5'] . $row['cp5_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP6</td>
                            <?php echo "<td>" . $row['cp6'] . $row['cp6_unit'] .  "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP7</td>
                            <?php echo "<td>" . $row['cp7'] . $row['cp7_unit'] . "</td>"; ?>
                        </tr>
                        <tr>
                            <td>CP9</td>
                            <?php echo "<td>" . $row['cp9'] . $row['cp9_unit'] . "</td>"; ?>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </body>

        </html>
<?php
    } else {
        $errorMessage = "No data found for the selected date.";
        header("Location: error.php?message=" . urlencode($errorMessage));
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>