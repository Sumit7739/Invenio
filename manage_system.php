<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}

include('config.php');

$userID = $_SESSION['id'];

// Fetch user's name
$sql = "SELECT name, role FROM users WHERE id = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $role = $row['role'];
} else {
    $name = "User";
}

// Fetch the number of unresolved queries
$sqlQueryCount = "SELECT COUNT(*) as count FROM query WHERE status = 0";
$resultQueryCount = $conn->query($sqlQueryCount);
$queryCount = 0;
if ($resultQueryCount->num_rows > 0) {
    $row = $resultQueryCount->fetch_assoc();
    $queryCount = $row['count'];
}

// Fetch unread updates for the user
$updatesSql = "SELECT id, update_text, timestamp FROM updates WHERE readtext = 0 ORDER BY timestamp DESC";
$updatesResult = $conn->query($updatesSql);

$updates = [];
if ($updatesResult->num_rows > 0) {
    while ($updateRow = $updatesResult->fetch_assoc()) {
        $updates[] = $updateRow;
    }
}

// Count the number of updates
$notificationCount = count($updates);

// Fetch today's and this week's entries for Inventory and Sales
$today = date('Y-m-d');  // Current date
$lastWeek = date('Y-m-d', strtotime('-1 week'));  // Date for last week

// Query for inventory entries today
$query_inventory_today = "SELECT COUNT(*) FROM inventory_item WHERE DATE(date) = '$today'";
$result_inventory_today = mysqli_query($conn, $query_inventory_today);
$inventoryToday = mysqli_fetch_assoc($result_inventory_today)['COUNT(*)'];

// Query for inventory entries in the last week
$query_inventory_week = "SELECT COUNT(*) FROM inventory_item WHERE DATE(date) BETWEEN '$lastWeek' AND '$today'";
$result_inventory_week = mysqli_query($conn, $query_inventory_week);
$inventoryThisWeek = mysqli_fetch_assoc($result_inventory_week)['COUNT(*)'];

// Query for 2nd table of inventory entries today
$query_moreinventory_today = "SELECT COUNT(*) FROM moreinventory_item WHERE DATE(date) = '$today'";
$result_moreinventory_today = mysqli_query($conn, $query_moreinventory_today);
$moreinventoryToday = mysqli_fetch_assoc($result_moreinventory_today)['COUNT(*)'];

// Query for inventory entries in the last week
$query_moreinventory_week = "SELECT COUNT(*) FROM moreinventory_item WHERE DATE(date) BETWEEN '$lastWeek' AND '$today'";
$result_moreinventory_week = mysqli_query($conn, $query_moreinventory_week);
$moreinventoryThisWeek = mysqli_fetch_assoc($result_moreinventory_week)['COUNT(*)'];

// Query for sales entries today
$query_sales_today = "SELECT COUNT(*) FROM sales_item WHERE DATE(date) = '$today'";
$result_sales_today = mysqli_query($conn, $query_sales_today);
$salesToday = mysqli_fetch_assoc($result_sales_today)['COUNT(*)'];

// Query for sales entries in the last week
$query_sales_week = "SELECT COUNT(*) FROM sales_item WHERE DATE(date) BETWEEN '$lastWeek' AND '$today'";
$result_sales_week = mysqli_query($conn, $query_sales_week);
$salesThisWeek = mysqli_fetch_assoc($result_sales_week)['COUNT(*)'];

// Query for 2nd sales entries today
$query_moresales_today = "SELECT COUNT(*) FROM moresales_item WHERE DATE(date) = '$today'";
$result_moresales_today = mysqli_query($conn, $query_moresales_today);
$moresalesToday = mysqli_fetch_assoc($result_moresales_today)['COUNT(*)'];

// Query for 2nd sales entries in the last week
$query_moresales_week = "SELECT COUNT(*) FROM moresales_item WHERE DATE(date) BETWEEN '$lastWeek' AND '$today'";
$result_moresales_week = mysqli_query($conn, $query_moresales_week);
$moresalesThisWeek = mysqli_fetch_assoc($result_moresales_week)['COUNT(*)'];

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style_main.css">
</head>

<body>
    <div class="containerr">
        <header class="header">
            <h1>PPWALA</h1>
            <div class="notification-icon-container">
                <i class="fas fa-bell" id="notification-icon"></i>
                <?php if ($notificationCount > 0) : ?>
                    <span id="notification-count"><?php echo $notificationCount; ?></span>
                <?php endif; ?>
                </i>
            </div>
        </header>

        <div id="notification-dropdown">
            <?php if (!empty($updates)) : ?>
                <?php foreach ($updates as $update) : ?>
                    <div class="notification-item">
                        <div>
                            <p><?php echo htmlspecialchars($update['update_text']); ?></p>
                            <small><?php echo htmlspecialchars($update['timestamp']); ?></small>
                        </div>
                        <input type="checkbox" class="mark-as-read" data-id="<?php echo $update['id']; ?>">
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No new notifications</p>
            <?php endif; ?>
            <a href="notifications.php" class="view-all-link">View All Notifications</a>
        </div>
        <!-- Sidebar structure -->
        <div class="sidebar">
            <div class="wrapper">
                <ul>
                    <!-- Home Link -->
                    <li>
                        <span class="icon material-icons">home</span>
                        <span class="text active">Home</span>
                    </li>

                    <!-- Inventory Section with Submenu -->
                    <li class="has-submenu">
                        <span class="icon material-icons">inventory</span>
                        <span class="text">Inventory</span>
                        <div class="submenu">
                            <a href="add_inventory.php">Add Inventory</a>
                            <a href="addmore_inventory.php">Add More Items</a>
                            <a href="view_inventory.php">View Inventory</a>
                            <a href="view_moreinventory.php">View 2nd Inventory</a>
                        </div>
                    </li>

                    <!-- Sales Section with Submenu -->
                    <li class="has-submenu">
                        <span class="icon material-icons">trending_up</span>
                        <span class="text">Sales</span>
                        <div class="submenu">
                            <a href="sales.php">Add Sales</a>
                            <a href="moresales.php">Add More Sales</a>
                            <a href="view_sales.php">View Sales</a>
                            <a href="view_moresales.php">View More Sales</a>

                        </div>
                    </li>

                    <!-- Stock Section (Placeholder for future use) -->
                    <li class="has-submenu">
                        <span class="icon material-icons">store</span>
                        <span class="text">Stock</span>
                        <div class="submenu">
                            <a href="stock.php">Stock Table</a>
                            <a href="more_stock.php">2nd Stock Table</a>

                        </div>
                    </li>

                    <!-- Reports Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">bar_chart</span>
                        <span class="text">Reports</span>
                        <div class="submenu">
                            <a href="sales_report.php">Sales Report</a>
                            <a href="more_sales_report.php">2nd Sales Report</a>
                            <a href="inventory_report.php">Inventory Report</a>
                            <a href="more_inventory_report.php">2nd Inventory Report</a>
                        </div>
                    </li>

                    <!-- Tables Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">table_chart</span>
                        <span class="text">Tables</span>
                        <div class="submenu">
                            <a href="sales_table.php">Sales Table</a>
                            <a href="more_sales_table.php">2nd Sales Table</a>
                            <a href="inventory_table.php">Inventory Table</a>
                            <a href="more_inventory_table.php">2nd Inventory Table</a>
                        </div>
                    </li>

                    <!-- Settings Section with Submenu -->
                    <li class="has-submenu">
                        <span class="icon material-icons">settings</span>
                        <span class="text">Settings</span>
                        <div class="submenu">
                            <a href="users.php">See Users</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>

                    <!-- Help Link -->
                    <li class="has-submenu">
                        <span class="icon material-icons">info</span>
                        <span class="text">Extra</span>
                        <div class="submenu">
                            <a href="notifications.php">Notifications</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <div class="content">
            <h3>Welcome <?php echo $name; ?></h3>
            <h4>Role - <?php echo $role; ?> </h4>
            <p>Welcome to your inventory management system. It help businesses organize and track their inventory
                efficiently.</p>
        </div>

        <div class="dashboard">
            <!-- Inventory Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Inventory</h4>
                </div>
                <div class="card-body">
                    <p><strong>Entries Today:</strong> <?php echo $inventoryToday; ?></p>
                    <p><strong>Total Entries This Week:</strong> <?php echo $inventoryThisWeek; ?></p>
                </div>
            </div>
            <!-- 2nd table -->
            <div class="card">
                <div class="card-header">
                    <h4>2nd Inventory Table</h4>
                </div>
                <div class="card-body">
                    <p><strong>Entries Today:</strong> <?php echo $moreinventoryToday; ?></p>
                    <p><strong>Total Entries This Week:</strong> <?php echo $moreinventoryThisWeek; ?></p>
                </div>
            </div>

            <!-- Sales Card -->
            <div class="card">
                <div class="card-header">
                    <h4>Sales</h4>
                </div>
                <div class="card-body">
                    <p><strong>Entries Today:</strong> <?php echo $salesToday; ?></p>
                    <p><strong>Total Entries This Week:</strong> <?php echo $salesThisWeek; ?></p>
                </div>
            </div>
            <!-- 2nd sales table -->
            <div class="card">
                <div class="card-header">
                    <h4>2nd Sales Table</h4>
                </div>
                <div class="card-body">
                    <p><strong>Entries Today:</strong> <?php echo $moresalesToday; ?></p>
                    <p><strong>Total Entries This Week:</strong> <?php echo $moresalesThisWeek; ?></p>
                </div>
            </div>
        </div>

        <h2>Quick Links Section</h2>
        <br>
        <div class="quick-links">
            <div class="link-item">
                <h4>Inventory</h4>
                <a href="add_inventory.php">Add Inventory</a>
                <a href="view_inventory.php">View Inventory</a>
            </div>
            <div class="link-item">
                <h4>Sales</h4>
                <a href="sales.php">Add Sales</a>
                <a href="view_sales.php">View Sales</a>
            </div>
        </div>

        <footer>
            <p>Created by <a href="submitupdates.html">Sumit</a> </p>
            <p class="footer-text">© 2024 Inventory Management System. All rights reserved.</p>
        </footer>


        <script src="manage_system.js"></script>
        <script>
            document.querySelectorAll('.has-submenu').forEach(item => {
                item.addEventListener('click', () => {
                    const submenu = item.querySelector('.submenu');
                    if (submenu.style.display === "block") {
                        submenu.style.display = "none";
                    } else {
                        submenu.style.display = "block";
                    }
                });
            });
        </script>
</body>

</html>