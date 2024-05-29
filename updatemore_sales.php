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
        $py6 = filter_var($_POST['py6'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal6_unit = filter_var($_POST['payal6_unit'], FILTER_SANITIZE_STRING);
        $py8 = filter_var($_POST['py8'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal8_unit = filter_var($_POST['payal8_unit'], FILTER_SANITIZE_STRING);
        $py9 = filter_var($_POST['py9'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal9_unit = filter_var($_POST['payal9_unit'], FILTER_SANITIZE_STRING);
        $py11 = filter_var($_POST['py11'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $payal11_unit = filter_var($_POST['payal11_unit'], FILTER_SANITIZE_STRING);
        $zip3x4yzl = filter_var($_POST['3x4yzl'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $zip3x4yzlUnit = filter_var($_POST['3x4yzl_unit'], FILTER_SANITIZE_STRING);
        $zip4x5yzl = filter_var($_POST['4x5yzl'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $zip4x5yzlUnit = filter_var($_POST['4x5yzl_unit'], FILTER_SANITIZE_STRING);
        $zip3x4wzl = filter_var($_POST['3x4wzl'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $zip3x4wzlUnit = filter_var($_POST['3x4wzl_unit'], FILTER_SANITIZE_STRING);
        $zip4x5wzl = filter_var($_POST['4x5wzl'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $zip4x5wzlUnit = filter_var($_POST['4x5wzl_unit'], FILTER_SANITIZE_STRING);


        $sql = "UPDATE moresales_item
        JOIN moresales_unit ON moresales_item.id = moresales_unit.item_id
        SET moresales_item.date = ?,
           moresales_item.py6 = ?, moresales_unit.payal6_unit = ?,
            moresales_item.py8 = ?, moresales_unit.payal8_unit = ?,
            moresales_item.py9 = ?, moresales_unit.payal9_unit = ?,
           moresales_item.py11 = ?, moresales_unit.payal11_unit = ?,
            moresales_item.3x4yzl = ?, moresales_unit.3x4yzl_unit = ?,             
            moresales_item.4x5yzl = ?, moresales_unit.4x5yzl_unit = ?,
            moresales_item.3x4wzl = ?, moresales_unit.3x4wzl_unit = ?,
            moresales_item.4x5wzl = ?, moresales_unit.4x5wzl_unit = ?
        WHERE moresales_item.id = ?";

        // Repeat this pattern for other fields

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param(
                "sdsdsdsdsdsdsdsdsi",
                $date,
                $py6,
                $payal6_unit,
                $py8,
                $payal8_unit,
                $py9,
                $payal9_unit,
                $py11,
                $payal11_unit,
                $zip3x4yzl,
                $zip3x4yzlUnit,
                $zip4x5yzl,
                $zip4x5yzlUnit,
                $zip3x4wzl,
                $zip3x4wzlUnit,
                $zip4x5wzl,
                $zip4x5wzlUnit,
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
