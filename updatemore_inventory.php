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

      

        $sql = "UPDATE moreinventory_item
        JOIN moreinventory_unit ON moreinventory_item.id = moreinventory_unit.item_id
        SET moreinventory_item.date = ?,
            moreinventory_item.py8 = ?, moreinventory_unit.payal8_unit = ?,
            moreinventory_item.py9 = ?, moreinventory_unit.payal9_unit = ?
        WHERE moreinventory_item.id = ?";

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
