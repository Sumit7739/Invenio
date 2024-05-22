<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>View Queries</title>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 1000;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 300px;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .query-form-container {
            text-align: center;
        }

        .input-group {
            margin: 15px 0;
        }


        .query-cards-container {
            /* max-width: 100%; */
            /* margin: 50px 0; */

            /* flex-wrap: wrap; */
            /* justify-content: space-between; */
            /* padding: 0 20px; */
        }

        .query-card {
            width: calc(100% - 10px);
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .query-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .query-card-content {
            padding: 20px;
            margin-bottom: 10px;
        }

        button {
            background-color: transparent;
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 5px 10px;
            color: #000;
            background-color: #fff;
            cursor: pointer;
            font-size: 14px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        button:hover {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        button a{
            text-decoration: none;
            color: #000;
        }

        button a:hover{
            text-decoration: none;
            color: #000;
        }
        .mark-resolved-btn,
        .delete-btn {
            margin: 5px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .mark-resolved-btn {
            background-color: #4caf50;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <header>

        <button id="raise-query-btn">Raise Query</button>
       <button> <a href="manage_system.php">HOME</a></button>
    </header>
    <div class="query-cards-container">
        <h1>View Queries</h1>

        <div id="popup-overlay" class="overlay"></div>


        <div id="popup-container" class="popup">
            <div class="query-form-container">
                <h1>Raise Query</h1>
                <p>Note: Enter your problems here</p>
                <form id="query-form" action="process_query.php" method="POST">
                    <div class="input-group">
                        <label for="query">Enter your query:</label><br><br>
                        <input type="text" id="query" name="query" required><br><br>
                    </div>
                    <input type="submit" value="Submit" id="btn">
                    <button type="button" id="close-popup">Close</button>
                </form>
            </div>
        </div>

        <?php
        session_start();
        include('config.php');


        if (!isset($_SESSION['id'])) {

            header('Location: login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['query_id'])) {
                $queryID = $_POST['query_id'];
                $status = isset($_POST['status']) ? $_POST['status'] : null;

                if ($status !== null) {

                    $sql = "UPDATE query SET status = '$status' WHERE id = '$queryID'";
                    if ($conn->query($sql) === TRUE) {
                    } else {

                        echo "Error updating query: " . $conn->error;
                    }
                } elseif (isset($_POST['delete'])) {

                    $sql = "DELETE FROM query WHERE id = '$queryID'";
                    if ($conn->query($sql) === TRUE) {
                    } else {

                        echo "Error deleting query: " . $conn->error;
                    }
                }
            }
        }

        $userID = $_SESSION['id'];
        $sql = "SELECT id, query_text, created_at, status FROM query ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $queryID = $row['id'];
                $queryText = $row['query_text'];
                $queryDate = $row['created_at'];
                $status = $row['status'] == 1 ? 'Resolved' : 'Not Solved';
                $statusColor = $row['status'] == 1 ? 'green' : 'red';

                echo "<div class='query-card' style='border-color: $statusColor;'>
                    <div class='query-card-content'>
                        <p>Query ID: $queryID</p>
                        <p>Query: $queryText</p>
                        <p>Created At: $queryDate</p>
                        <p>Status: $status</p>
                        <form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" style='display: inline;'>
                            <input type=\"hidden\" name=\"query_id\" value=\"$queryID\">
                            <input type=\"hidden\" name=\"status\" value=\"" . ($row['status'] == 1 ? 0 : 1) . "\">";

                if ($row['status'] == 1) {
                    echo "<button type=\"submit\" class=\"mark-resolved-btn\">Mark as Unresolved</button>";
                } else {
                    echo "<button type=\"submit\" class=\"mark-resolved-btn\">Mark as Resolved</button>";
                }

                echo "</form>
                  <form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\" style='display: inline;'>
                        <input type=\"hidden\" name=\"query_id\" value=\"$queryID\">
                        <input type=\"hidden\" name=\"delete\" value=\"1\">
                        <button type=\"submit\" class=\"delete-btn\">Delete</button>
                  </form>
                  </div>
                  </div>";
            }
        } else {
            echo "<br><br>";
            echo "<h3 style='color: red;'>No queries found.</h3>";
        }

        $conn->close();
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const popupOverlay = document.getElementById('popup-overlay');
            const popupContainer = document.getElementById('popup-container');
            const raiseQueryPopupBtn = document.getElementById('raise-query-btn');
            const closePopupBtn = document.getElementById('close-popup');

            raiseQueryPopupBtn.addEventListener('click', () => {
                popupOverlay.style.display = 'block';
                popupContainer.style.display = 'block';
            });

            closePopupBtn.addEventListener('click', () => {
                popupOverlay.style.display = 'none';
                popupContainer.style.display = 'none';
            });


            popupOverlay.addEventListener('click', () => {
                popupOverlay.style.display = 'none';
                popupContainer.style.display = 'none';
            });
        });
    </script>
</body>

</html>