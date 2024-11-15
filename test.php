<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
    <script src="script.js" defer></script> <!-- Link to the external JavaScript file -->
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #111;
            color: #fff;
            padding: 10px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar-item {
            margin-bottom: 15px;
        }

        .sidebar-link {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 10px;
            cursor: pointer;
        }

        .sidebar-link:hover {
            background-color: #575757;
        }

        .submenu {
            display: none;
            margin-left: 20px;
        }

        .submenu a {
            font-size: 16px;
            padding: 8px 10px;
            color: #ddd;
            text-decoration: none;
        }

        .submenu a:hover {
            background-color: #575757;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 270px;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        header {
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .content-overview {
            display: flex;
            gap: 20px;
        }

        .overview-box {
            width: 48%;
            padding: 15px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content-details {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 220px;
            }

            .content-overview {
                flex-direction: column;
            }

            .overview-box {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-item">
            <a href="javascript:void(0);" class="sidebar-link" onclick="toggleSubmenu('inventory')">Inventory</a>
            <div id="inventory" class="submenu">
                <a href="add_inventory.html">Add Inventory</a>
                <a href="add_more_items.html">Add More Items</a>
                <a href="view_inventory.html">View Inventory</a>
            </div>
        </div>

        <div class="sidebar-item">
            <a href="javascript:void(0);" class="sidebar-link" onclick="toggleSubmenu('sales')">Sales</a>
            <div id="sales" class="submenu">
                <a href="add_sales.html">Add Sales</a>
                <a href="view_sales.html">View Sales</a>
            </div>
        </div>

        <div class="sidebar-item">
            <a href="javascript:void(0);" class="sidebar-link" onclick="toggleSubmenu('stock')">Stock</a>
            <div id="stock" class="submenu">
                <!-- Add stock-related links if any -->
            </div>
        </div>

        <div class="sidebar-item">
            <a href="reports.html">Reports</a>
        </div>

        <div class="sidebar-item">
            <a href="tables.html">Tables</a>
        </div>

        <div class="sidebar-item">
            <a href="javascript:void(0);" class="sidebar-link" onclick="toggleSubmenu('settings')">Settings</a>
            <div id="settings" class="submenu">
                <a href="see_users.html">See Users</a>
                <a href="logout.html">Logout</a>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div id="main-content" class="main-content">
        <header>
            <h1>Welcome to the Dashboard</h1>
            <p>Manage your data easily using the sidebar links.</p>
        </header>

        <section class="content-overview">
            <h2>Quick Overview</h2>
            <div class="overview-box">
                <h3>Recent Activity</h3>
                <p>Check out the latest updates from Inventory, Sales, and Stock.</p>
            </div>

            <div class="overview-box">
                <h3>Reports</h3>
                <p>Access and generate various reports.</p>
            </div>
        </section>

        <section class="content-details">
            <h2>Detailed Information</h2>
            <p>Use the sidebar to navigate to more detailed sections, like adding inventory, managing sales, and reviewing stock.</p>
        </section>
    </div>
    <script>
        function toggleSubmenu(id) {
            var submenu = document.getElementById(id);
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
            } else {
                submenu.style.display = "block";
            }
        }
    </script>
</body>

</html>