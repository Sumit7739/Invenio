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
    include('config.php');

    // Get the selected date from the form or URL parameter
    $selectedDate = $_GET['selectedDate']; // Assuming it's coming from a GET request

    // Use prepared statements to avoid SQL injection
    $sql = "SELECT si.id, si.bl5,su.bl5_unit, si.bl6, su.bl6_unit, si.bl7, su.bl7_unit, si.bl9, su.bl9_unit, si.sp5, su.sp5_unit, si.sp6, su.sp6_unit, si.sp7, su.sp7_unit, si.sp9, su.sp9_unit, si.wl5, su.wl5_unit, si.wl6, su.wl6_unit, si.wl7, su.wl7_unit, si.wl9, su.wl9_unit, si.ld8, su.ld8_unit, si.ld9, su.ld9_unit, si.ld11, su.ld11_unit, si.dld, su.dld_unit, si.pp, su.pp_unit, si.cups50, su.cups50_unit, si.cups60, su.cups60_unit, si.cups80, su.cups80_unit, si.cups100, su.cups100_unit, si.cups150, su.cups150_unit, si.cups210, su.cups210_unit, si.cups250, su.cups250_unit, si.bd5, su.bd5_unit, si.bd6, su.bd6_unit, si.bd7, su.bd7_unit, si.cp5, su.cp5_unit, si.cp6, su.cp6_unit, si.cp7, su.cp7_unit, si.cp9, su.cp9_unit 
            FROM sales_item si
            INNER JOIN sales_unit su ON si.id = su.id
            WHERE si.date = ?";

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
            <a href="manage_system.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
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