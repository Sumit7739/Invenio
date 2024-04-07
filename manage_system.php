<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}
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
            <h1>PPWALA <br>Inventory Management System</h1>
        </header>
        <div class="content">
            <p>Welcome to our inventory management system. We help businesses organize and track their inventory
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
                            <a href="view_inventory.php">View Inventory</a>
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
                            <a href="view_sales.php">View Sales</a>
                            <p>Access and view your sales details.</p>
                        </div>
                    </div>
                </div>
                <div class="feature-box">
                    <i class="fas fa-chart-bar"></i>
                    <h3>Generate Reports</h3>
                    <p>Get detailed reports and insights into your inventory performance.</p>
                    <div class="feature-row">
                        <div class="small-box">
                            <a href="product_sales_report.php">Sales Report</a>
                            <p>Quickly enter new sales records.</p>
                        </div>
                        <div class="small-box">
                            <a href="inventory_report.php">Inventory Report</a>
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
                        <a href="inventory_table.php">Inventory Table</a>
                        <p>Access and view your Inventory details.</p>
                    </div>
                </div>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    <footer>
        <p>Created by Sumit and Sahil</p>
        <p class="footer-text">© 2024 Inventory Management System. All rights reserved.</p>
    </footer>
</body>

</html>