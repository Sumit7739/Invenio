<?php

include('config.php');

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query
    $sql = "SELECT ii.*, iu.*
            FROM moresales_item AS ii
            INNER JOIN moresales_unit AS iu ON ii.id = iu.item_id
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
  <link rel="stylesheet" href="moresales_data.css">
  <title>Display Data</title>
</head>

<body>
  <a href="manage_system.php" class="toggle-buttons">
      <i id="homeIcon" class="fas fa-home home-icon"></i>
  </a>
  <a href="view_moresales.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
  <br>
  <hr>
  <div class="container1">
      <label for="date" id="date">Date: </label>
      <span id="date"><?php echo $date; ?></span>
            <br>
      <a href='edit_moresales.php?id=<?php echo $_GET['id']; ?>'><i class="fas fa-edit edit-icon"></i></a>
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
   <script src="moresales_data.js"></script>
  <script src="script.js"></script>
</body>

</html>