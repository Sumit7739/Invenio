<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('config.php');
    
    // Debugging statement to inspect POST data
    // var_dump($_POST);
    
    // Check if all required fields are filled
    if (!empty($_POST['id']) && !empty($_POST['date'])) {
        // Retrieve and sanitize form data
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $py8 = filter_var($_POST['py8'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal8_unit = filter_var($_POST['payal8_unit'], FILTER_SANITIZE_STRING);
        $py9 = filter_var($_POST['py9'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal9_unit = filter_var($_POST['payal9_unit'], FILTER_SANITIZE_STRING);

        // SQL query to update records
        $sql = "UPDATE moreinventory_item
                JOIN moreinventory_unit ON moreinventory_item.id = moreinventory_unit.item_id
                SET moreinventory_item.date = ?,
                    moreinventory_item.py8 = ?, moreinventory_unit.payal8_unit = ?,
                    moreinventory_item.py9 = ?, moreinventory_unit.payal9_unit = ?
                WHERE moreinventory_item.id = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param(
                "sdsdsi",
                $date,
                $py8,
                $payal8_unit,
                $py9,
                $payal9_unit,
                $id
            );

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to another page on success
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
?>
