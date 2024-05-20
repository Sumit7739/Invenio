<?php

include('config.php');

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT ii.*, iu.*
            FROM moreinventory_item AS ii
            INNER JOIN moreinventory_unit AS iu ON ii.id = iu.item_id
            WHERE ii.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            $date = $row["date"];
            // $name = $row["name"];
            $py8 = $row["py8"];
            $payal8_unit = $row["payal8_unit"];
            $py9 = $row["py9"];
            $payal9_unit = $row["payal9_unit"];
           
        }
    } else {
        echo "0 results";
    }

    $stmt->close();
} else {
    echo "Invalid ID provided.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <title>Display Data</title>
  <style>
      .container1 {
          height: auto;
          margin-top: 20px;
          padding: 15px 15px 20px;
          border: 1px solid #ccc;
          border-radius: 10px;
          box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
          font-family: 'Poppins', sans-serif;
      }

      .container1 #date {
          font-size: 18px;
          font-weight: 700;
      }

      .container {
          height: auto;
          margin-top: 20px;
          margin-bottom: 20px;
          padding: 5px 25px 25px;
          border: 1px solid #ccc;
          border-radius: 10px;
          box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
          font-family: 'Poppins', sans-serif;
      }

      .item {
          margin-top: 10px;
      }

      .home-icon {
          margin-top: 10px;
          margin-left: 10px;
          width: 50px;
          cursor: pointer;
          font-size: 30px;
      }

      .container label {
          color: #333366;
          font-weight: 400;
          font-size: 16px;
      }

      .container .item .data {
          position: absolute;
          right: 0;
          margin-right: 140px;
          font-size: 16px;
          font-weight: 600;
          color: blue;
      }

      .container .item .unit {
          position: absolute;
          right: 0;
          margin-right: 35px;
          font-size: 16px;
          font-weight: 600;
          color: green;
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

      .edit-icon {
          position: absolute;
          margin-top: -30px;
          right: 0;
          margin-right: 20px;
          color: #333;
          font-size: 18px;
          cursor: pointer;
      }

        .delete-icon {
        position: absolute;
        margin-top: 15px;
        right: 0;
        margin-right: 25px;
        color: #333;
        font-size: 18px;
        cursor: pointer;
    }

    .delete-icon:active {
        color: red;
    }
        
      .toggle-btn {
          margin-top: 20px;
          width: 10%;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s ease;
      }
.popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        padding: 30px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 10px;
        z-index: 1000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .popup h2 {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .popup button {
        width: 130px;
        margin-right: 10px;
        padding: 15px 10px;
        background-color: #ff0000;
        border-radius: 8px;
        color: white;
        border: none;
        cursor: pointer;
    }

    .popup button:hover {
        background-color: #0056b3;
    }

    .popup button:last-child {
        background-color: #0056b3;
    }

    .popup button:last-child:hover {
        background-color: #0057b3c3;
    }

      .primary-btn {
          background-color: #007bff;
          color: #fff;
      }

      .primary-btn:hover {
          background-color: #0056b3;
      }
  </style>
</head>

<body>
  <a href="manage_system.php" class="toggle-buttons">
      <i id="homeIcon" class="fas fa-home home-icon"></i>
  </a>
  <a href="view_moreinventory.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
  <br>
  <hr>
  <div class="container1">
      <label for="date" id="date">Date: </label>
      <span id="date"><?php echo $date; ?></span>
            <br>
      <a href='edit_moreinventory.php?id=<?php echo $_GET['id']; ?>'><i class="fas fa-edit edit-icon"></i></a>
      <a href="#" class="toggle-buttons">
        <i class="fas fa-trash-alt delete-icon" id="deleteButton"></i>
    </a>
  </div>
  <div class="popup" id="popup">
    <h2>Are you sure you want to delete this item?</h2>
    <button onclick="confirmDelete()">Yes, delete</button>
    <button onclick="closePopup()">Cancel</button>
</div>
  <button type="button" class="toggle-btn primary-btn" onclick="toggleAllSections()"><i class="fas fa-toggle-on"></i></button>
  <br>
  <br>
  <label for="blackLooseToggle" onclick="toggleBlackLoose()" style="color:#ff7300; font-weight: bold; font-size: 20px; cursor: pointer;">Payal LD<span id="toggleIcon">▼</span></label><br>
  <div id="blackLooseSection" class="container">
      <h3>Payal LD</h3>
      <div class="item">
          <label for="bl5">8-inch :</label>
          <span class="data"><?php echo $py8 ?></span>
          <span class="unit"><?php echo $payal8_unit; ?></span>
      </div>
      <div class="item">
          <label for="bl6">9-inch :</label>
          <span class="data"><?php echo $py9; ?></span>
          <span class="unit"><?php echo $payal9_unit; ?></span>
      </div>
     
  </div>
  <hr>
   <script>
    const deleteButton = document.getElementById('deleteButton');
    const popup = document.getElementById('popup');

    deleteButton.addEventListener('click', function() {
        popup.style.display = 'block';
    });

    function confirmDelete() {
        // Add your delete logic here
        alert('Item deleted!');
        closePopup();
    }

    function closePopup() {
        popup.style.display = 'none';
    }

    function confirmDelete() {
        // Check if the 'id' parameter exists in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const itemId = urlParams.get('id');

        if (itemId !== null && !isNaN(itemId)) {
            // 'itemId' is a valid numeric value
            // Forward to delete_item.php with the item ID in the URL
            window.location.href = `delete_moreitem.php?id=${itemId}`;
        } else {
            // 'id' parameter is missing or invalid
            alert('Invalid item ID.');
        }
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
</script>
  <script src="script.js"></script>
</body>

</html>