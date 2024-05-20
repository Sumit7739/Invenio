<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('config.php');
    var_dump($_POST);
    // Check if all required fields are filled
    if (!empty($_POST['id']) && !empty($_POST['date'])) {
        // Retrieve form data
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        
        $date = isset($_POST['date']) ? $_POST['date'] : null;

        $py8 = isset($_POST['py8']) ? $_POST['py8'] : null;
        $payal8_unit = isset($_POST['payal8_unit']) ? $_POST['payal8_unit'] : null;

        $py9 = isset($_POST['py9']) ? $_POST['py9'] : null;
        $payal9_unit = isset($_POST['payal9_unit']) ? $_POST['payal9_unit'] : null;

      

        $sql = "UPDATE moresales_item
        JOIN moresales_unit ON moresales_item.id = moresales_unit.item_id
        SET moresales_item.date = ?,
            moresales_item.py8 = ?, moresales_unit.payal8_unit = ?,
            moresales_item.py9 = ?, moresales_unit.payal9_unit = ?
        WHERE moresales_item.id = ?";

        // Repeat this pattern for other fields

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param(
                "sdsdsi",
                $date,
                $py8,
                $payal8_unit,
                $py9,
                $payal9_unit,
                $id
            );


            // Repeat this pattern for other fields

            if ($stmt->execute()) {
                // Redirect to another page
                header("Location: success.html");
                exit();
            } else {
                echo "Error updating records: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "All fields are required!";
    }
    $conn->close();
} else {
    echo "Form not submitted!";
}
