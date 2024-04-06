  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ppwala";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Check if the 'id' parameter exists in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare and execute the SQL query
        $sql = "SELECT ii.*, iu.*
                FROM inventory_item AS ii
                INNER JOIN inventory_unit AS iu ON ii.id = iu.item_id
                WHERE ii.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {

                $date = $row["date"];
                $name = $row["name"];
                $bl5 = $row["bl5"];
                $bl5_unit = $row["bl5_unit"];
                $bl6 = $row["bl6"];
                $bl6_unit = $row["bl6_unit"];
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
      </style>
  </head>

  <body>
      <a href="index.html" class="toggle-buttons">
          <i id="homeIcon" class="fas fa-home home-icon"></i>
      </a>
      <a href="viewinvent.php" class="toggle-button"><i class="fas fa-arrow-left back-icon"></i></a>
      <br><br>
      <hr>
      <div class="container1">
          <label for="date" id="date">Date: </label>
          <span id="date"><?php echo $date; ?></span>
          <br>
          <label for="name">Name :</label>
          <span id="name"><?php echo $name; ?></span>

          <i class="fas fa-edit edit-icon">edit</i>
      </div>

      <div class="container">
          <h3>Black Loose</h3>
          <div class="item">
              <label for="bl5">5-inch BL:</label>
              <span id="bl5"><?php echo $bl5; ?></span>
              <span id="bl5_unit"><?php echo $bl5_unit; ?></span>
          </div>
          <div class="item">
              <label for="bl6">6-inch BL:</label>
              <span id="bl6"><?php echo $bl6; ?></span>
              <span id="bl6_unit"><?php echo $bl6_unit; ?></span>
          </div>
          <div class="item">
              <label for="bl7">7-inch BL:</label>
              <span id="bl7">20</span>
              <span id="bl7_unit">kg</span>
          </div>
          <div class="item">
              <label for="bl9">9-inch BL:</label>
              <span id="bl9">25</span>
              <span id="bl9_unit">g</span>
          </div>
      </div>

      <div class="container">
          <h3>Star Packet</h3>
          <div class="item">
              <label for="sp5">5-inch SP:</label>
              <span id="sp5">30</span>
              <span id="sp5_unit">kg</span>
          </div>
          <div class="item">
              <label for="sp6">6-inch SP:</label>
              <span id="sp6">35</span>
              <span id="sp6_unit">g</span>
          </div>
          <div class="item">
              <label for="sp7">7-inch SP:</label>
              <span id="sp7">40</span>
              <span id="sp7_unit">kg</span>
          </div>
          <div class="item">
              <label for="sp9">9-inch SP:</label>
              <span id="sp9">45</span>
              <span id="sp9_unit">g</span>
          </div>
      </div>

      <div class="container">
          <h3>White Loose</h3>
          <div class="item">
              <label for="wl5">5-inch WL:</label>
              <span id="wl5">50</span>
              <span id="wl5_unit">kg</span>
          </div>
          <div class="item">
              <label for="wl6">6-inch WL:</label>
              <span id="wl6">55</span>
              <span id="wl6_unit">g</span>
          </div>
          <div class="item">
              <label for="wl7">7-inch WL:</label>
              <span id="wl7">60</span>
              <span id="wl7_unit">kg</span>
          </div>
          <div class="item">
              <label for="wl9">9-inch WL:</label>
              <span id="wl9">65</span>
              <span id="wl9_unit">g</span>
          </div>
      </div>

      <div class="container">
          <h3>L/D SOMA</h3>
          <div class="item">
              <label for="ld8">8-inch L/D:</label>
              <span id="ld8">70</span>
              <span id="ld8_unit">kg</span>
          </div>
          <div class="item">
              <label for="ld9">9-inch L/D:</label>
              <span id="ld9">75</span>
              <span id="ld9_unit">g</span>
          </div>
          <div class="item">
              <label for="ld11">11-inch L/D:</label>
              <span id="ld11">80</span>
              <span id="ld11_unit">kg</span>
          </div>
          <div class="item">
              <label for="dld">DLD:</label>
              <span id="dld">85</span>
              <span id="dld_unit">g</span>
          </div>
          <div class="item">
              <label for="pp">PP:</label>
              <span id="pp">90</span>
              <span id="pp_unit">kg</span>
          </div>
      </div>

      <div class="container">
          <h3>CUPS</h3>
          <div class="item">
              <label for="cups50">50 ml:</label>
              <span id="cups50">95</span>
              <span id="cups50_unit">kg</span>
          </div>
          <div class="item">
              <label for="cups60">60 ml:</label>
              <span id="cups60">100</span>
              <span id="cups60_unit">g</span>
          </div>
          <div class="item">
              <label for="cups80">80 ml:</label>
              <span id="cups80">105</span>
              <span id="cups80_unit">kg</span>
          </div>
          <div class="item">
              <label for="cups100">100 ml:</label>
              <span id="cups100">110</span>
              <span id="cups100_unit">g</span>
          </div>
          <div class="item">
              <label for="cups150">150 ml:</label>
              <span id="cups150">115</span>
              <span id="cups150_unit">kg</span>
          </div>
          <div class="item">
              <label for="cups210">210 ml:</label>
              <span id="cups210">120</span>
              <span id="cups210_unit">g</span>
          </div>
          <div class="item">
              <label for="cups250">250 ml:</label>
              <span id="cups250">125</span>
              <span id="cups250_unit">kg</span>
          </div>
      </div>

      <div class="container">
          <h3>Black Delhi</h3>
          <div class="item">
              <label for="bd5">5-inch BD:</label>
              <span id="bd5">130</span>
              <span id="bd5_unit">kg</span>
          </div>
          <div class="item">
              <label for="bd6">6-inch BD:</label>
              <span id="bd6">135</span>
              <span id="bd6_unit">g</span>
          </div>
          <div class="item">
              <label for="bd7">7-inch BD:</label>
              <span id="bd7">140</span>
              <span id="bd7_unit">kg</span>
          </div>
      </div>

      <div class="container">
          <h3>Cover</h3>
          <div class="item">
              <label for="cp5">5-inch Cover:</label>
              <span id="cp5">145</span>
              <span id="cp5_unit">kg</span>
          </div>
          <div class="item">
              <label for="cp6">6-inch Cover:</label>
              <span id="cp6">150</span>
              <span id="cp6_unit">g</span>
          </div>
          <div class="item">
              <label for="cp7">7-inch Cover:</label>
              <span id="cp7">155</span>
              <span id="cp7_unit">kg</span>
          </div>
          <div class="item">
              <label for="cp9">9-inch Cover:</label>
              <span id="cp9">160</span>
              <span id="cp9_unit">g</span>
          </div>
      </div>
      <hr>
  </body>

  </html>