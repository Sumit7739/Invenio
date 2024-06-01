<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}

include('config.php');

$userID = $_SESSION['id'];

// Fetch user's name
$sql = "SELECT name FROM users WHERE id = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
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
    <link rel="stylesheet" href="style_main.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>PPWALA</h1>
            <div class="icon-container">
                <a href="view_query.php">
                    <i class="fas fa-comment" id="query-icon"></i>
                    <?php if ($queryCount > 0) : ?>
                        <span class="icon-count"><?php echo $queryCount; ?></span>
                    <?php endif; ?>
                </a>
            </div>
            <div class="notification-icon-container">
                <i class="fas fa-bell" id="notification-icon"></i>
                <?php if ($notificationCount > 0) : ?>
                    <span id="notification-count"><?php echo $notificationCount; ?></span>
                <?php endif; ?>
                </i>
            </div>
        </header>

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
        <div class="content">
            <h3>Welcome <?php echo $name; ?></h3>
            <p>Welcome to your inventory management system. It help businesses organize and track their inventory
                efficiently.</p>
            <div class="features">
                <div class="feature-box">
                    <i class="fas fa-box"></i>
                    <h3>Manage Inventory</h3>
                    <p>Easily add, update, and track your inventory items.</p>
                    <div class="feature-row">
                        <div class="small-box">
                            <a href="add_inventory.php">Add Inventory</a>
                            <p>Quickly enter new inventory items.</p>
                        </div>
                        <div class="small-box">
                            <a href="addmore_inventory.php">Add More Items</a>
                            <p>Quickly enter more new inventory items.</p>
                        </div>
                        <div class="small-box">
                            <a href="view_inventory.php">View Inventory</a>
                            <p>Access and view your inventory details.</p>
                        </div>
                        <div class="small-box">
                            <a href="view_moreinventory.php">View 2nd Inventory</a>
                            <p>Access and view your inventory details.</p>
                        </div>
                    </div>
                </div>
                <div class="feature-box">
                    <i class="fas fa-dollar-sign"></i>
                    <h3>Manage Sales</h3>
                    <p>Easily add, update, and track your sales records.</p>
                    <div class="feature-row">
                        <div class="small-box">
                            <a href="sales.php">Add Sales</a>
                            <p>Quickly enter new sales records.</p>
                        </div>
                        <div class="small-box">
                            <a href="moresales.php">Add More Sales</a>
                            <p>Quickly enter new sales records.</p>
                        </div>
                        <div class="small-box">
                            <a href="view_sales.php">View Sales</a>
                            <p>Access and view your sales details.</p>
                        </div>
                        <div class="small-box">
                            <a href="view_moresales.php">View More Sales</a>
                            <p>Access and view your sales details.</p>
                        </div>
                    </div>
                </div>
                <div class="feature-box">
                    <i class="fas fa-chart-line"></i>
                    <h3>Stock Tables</h3>
                    <p>Get detailed reports and insights into your Stocks.</p>
                    <div class="small-box">
                        <a href="stock.php">Stock Table</a>
                        <p>Quickly view new Stocks reports.</p>
                    </div>
                    <div class="small-box">
                        <a href="more_stock.php">2nd Stock Table</a>
                        <p>Quickly view new Stocks reports.</p>
                    </div>
                </div>
                <div class="feature-box">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Generate Reports</h3>
                    <p>Get detailed reports and insights into your inventory performance.</p>
                    <div class="feature-row">
                        <div class="small-box">
                            <a href="sales_report.php">Sales Report</a>
                            <p>Quickly enter new sales records.</p>
                        </div>
                        <div class="small-box">
                            <a href="more_sales_report.php">2nd Sales Report</a>
                            <p>Quickly enter new sales records.</p>
                        </div>
                        <div class="small-box">
                            <a href="inventory_report.php">Inventory Report</a>
                            <p>Access and view your sales details.</p>
                        </div>
                        <div class="small-box">
                            <a href="more_inventory_report.php">2nd Inventory Report</a>
                            <p>Access and view your sales details.</p>
                        </div>
                    </div>
                </div>
                <div class="feature-box">
                    <i class="fas fa-table"></i>
                    <h3>Tables</h3>
                    <p>Get detailed reports and insights into your Sales performance.</p>
                    <div class="small-box">
                        <a href="sales_table.php">Sales Table</a>
                        <p>Quickly view new sales records.</p>
                    </div>
                    <div class="small-box">
                        <a href="more_sales_table.php">2nd Sales Table</a>
                        <p>Quickly view new sales records.</p>
                    </div>
                    <div class="small-box">
                        <a href="inventory_table.php">Inventory Table</a>
                        <p>Access and view your Inventory details.</p>
                    </div>
                    <div class="small-box">
                        <a href="more_inventory_table.php">Inventory Table</a>
                        <p>Access and view your Inventory details.</p>
                    </div>
                </div>
                <div class="feature-box">
                    <i class="fas fa-box"></i>
                    <h3>Extra Tools</h3>
                    <p>Access additional features and tools to enhance your inventory management experience</p>
                    <div class="small-box">
                        <a href="PPWALA.apk" class="logout-bt" download>
                            <i class="fas fa-file-download"></i> Download APP
                        </a>
                        <p>Download the APP.</p>
                    </div>
                    <div class="small-box">
                        <a href="users.php" class="logout-bt">
                            <i class="fas fa-user"></i> See Users
                        </a>
                        <p>Quickly view users record.</p>
                    </div>
                    <div class="small-box">
                        <a href="game.html" class="logout-bt">
                            <i class="fas fa-gamepad"></i> Play Game
                        </a>
                        <p>Play simple games to pass time.</p>
                    </div>
                    <div class="small-box">
                        <a href="logout.php" class="logout-bt">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <p>Logout from the session</p>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>Created by <a href="submitupdates.html">Sumit</a> </p>
            <p class="footer-text">© 2024 Inventory Management System. All rights reserved.</p>
        </footer>


        <script src="manage_system.js"></script>
</body>

</html>