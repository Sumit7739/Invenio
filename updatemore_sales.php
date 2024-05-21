<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('config.php');
    var_dump($_POST);
    // Check if all required fields are filled
    if (!empty($_POST['id']) && !empty($_POST['date'])) {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $py8 = filter_var($_POST['py8'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal8_unit = filter_var($_POST['payal8_unit'], FILTER_SANITIZE_STRING);
        $py9 = filter_var($_POST['py9'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal9_unit = filter_var($_POST['payal9_unit'], FILTER_SANITIZE_STRING);

      

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
