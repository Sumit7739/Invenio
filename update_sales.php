<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('config.php');
    // var_dump($_POST);
    // Check if all required fields are filled
    if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['date'])) {
        // Retrieve form data
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $date = isset($_POST['date']) ? $_POST['date'] : null;

        $bl5 = isset($_POST['bl5']) ? $_POST['bl5'] : null;
        $bl5_unit = isset($_POST['bl5_unit']) ? $_POST['bl5_unit'] : null;

        $bl6 = isset($_POST['bl6']) ? $_POST['bl6'] : null;
        $bl6_unit = isset($_POST['bl6_unit']) ? $_POST['bl6_unit'] : null;

        $bl7 = isset($_POST['bl7']) ? $_POST['bl7'] : null;
        $bl7_unit = isset($_POST['bl7_unit']) ? $_POST['bl7_unit'] : null;

        $bl9 = isset($_POST['bl9']) ? $_POST['bl9'] : null;
        $bl9_unit = isset($_POST['bl9_unit']) ? $_POST['bl9_unit'] : null;

        $sp5 = isset($_POST['sp5']) ? $_POST['sp5'] : null;
        $sp5_unit = isset($_POST['sp5_unit']) ? $_POST['sp5_unit'] : null;

        $sp6 = isset($_POST['sp6']) ? $_POST['sp6'] : null;
        $sp6_unit = isset($_POST['sp6_unit']) ? $_POST['sp6_unit'] : null;

        $sp7 = isset($_POST['sp7']) ? $_POST['sp7'] : null;
        $sp7_unit = isset($_POST['sp7_unit']) ? $_POST['sp7_unit'] : null;

        $sp9 = isset($_POST['sp9']) ? $_POST['sp9'] : null;
        $sp9_unit = isset($_POST['sp9_unit']) ? $_POST['sp9_unit'] : null;

        $wl5 = isset($_POST['wl5']) ? $_POST['wl5'] : null;
        $wl5_unit = isset($_POST['wl5_unit']) ? $_POST['wl5_unit'] : null;

        $wl6 = isset($_POST['wl6']) ? $_POST['wl6'] : null;
        $wl6_unit = isset($_POST['wl6_unit']) ? $_POST['wl6_unit'] : null;

        $wl7 = isset($_POST['wl7']) ? $_POST['wl7'] : null;
        $wl7_unit = isset($_POST['wl7_unit']) ? $_POST['wl7_unit'] : null;

        $wl9 = isset($_POST['wl9']) ? $_POST['wl9'] : null;
        $wl9_unit = isset($_POST['wl9_unit']) ? $_POST['wl9_unit'] : null;

        $ld8 = isset($_POST['ld8']) ? $_POST['ld8'] : null;
        $ld8_unit = isset($_POST['ld8_unit']) ? $_POST['ld8_unit'] : null;

        $ld9 = isset($_POST['ld9']) ? $_POST['ld9'] : null;
        $ld9_unit = isset($_POST['ld9_unit']) ? $_POST['ld9_unit'] : null;

        $ld11 = isset($_POST['ld11']) ? $_POST['ld11'] : null;
        $ld11_unit = isset($row['ld11_unit']) ? $row['ld11_unit'] : null;

        $dld = isset($_POST['dld']) ? $_POST['dld'] : null;
        $dld_unit = isset($_POST['dld_unit']) ? $_POST['dld_unit'] : null;

        $pp = isset($_POST['pp']) ? $_POST['pp'] : null;
        $pp_unit = isset($_POST['pp_unit']) ? $_POST['pp_unit'] : null;

        $cups50 = isset($_POST['cups50']) ? $_POST['cups50'] : null;
        $cups50_unit = isset($_POST['cups50_unit']) ? $_POST['cups50_unit'] : null;

        $cups60 = isset($_POST['cups60']) ? $_POST['cups60'] : null;
        $cups60_unit = isset($_POST['cups60_unit']) ? $_POST['cups60_unit'] : null;

        $cups80 = isset($_POST['cups80']) ? $_POST['cups80'] : null;
        $cups80_unit = isset($_POST['cups80_unit']) ? $_POST['cups80_unit'] : null;

        $cups100 = isset($_POST['cups100']) ? $_POST['cups100'] : null;
        $cups100_unit = isset($row['cups100_unit']) ? $row['cups100_unit'] : null;

        $cups150 = isset($_POST['cups150']) ? $_POST['cups150'] : null;
        $cups150_unit = isset($_POST['cups150_unit']) ? $_POST['cups150_unit'] : null;

        $cups210 = isset($_POST['cups210']) ? $_POST['cups210'] : null;
        $cups210_unit = isset($_POST['cups210_unit']) ? $_POST['cups210_unit'] : null;

        $cups250 = isset($_POST['cups250']) ? $_POST['cups250'] : null;
        $cups250_unit = isset($_POST['cups250_unit']) ? $_POST['cups250_unit'] : null;

        $bd5 = isset($_POST['bd5']) ? $_POST['bd5'] : null;
        $bd5_unit = isset($_POST['bd5_unit']) ? $_POST['bd5_unit'] : null;

        $bd6 = isset($_POST['bd6']) ? $_POST['bd6'] : null;
        $bd6_unit = isset($row['bd6_unit']) ? $row['bd6_unit'] : null;

        $bd7 = isset($_POST['bd7']) ? $_POST['bd7'] : null;
        $bd7_unit = isset($_POST['bd7_unit']) ? $_POST['bd7_unit'] : null;

        $cp5 = isset($_POST['cp5']) ? $_POST['cp5'] : null;
        $cp5_unit = isset($_POST['cp5_unit']) ? $_POST['cp5_unit'] : null;

        $cp6 = isset($_POST['cp6']) ? $_POST['cp6'] : null;
        $cp6_unit = isset($row['cp6_unit']) ? $row['cp6_unit'] : null;

        $cp7 = isset($_POST['cp7']) ? $_POST['cp7'] : null;
        $cp7_unit = isset($_POST['cp7_unit']) ? $_POST['cp7_unit'] : null;

        $cp9 = isset($_POST['cp9']) ? $_POST['cp9'] : null;
        $cp9_unit = isset($_POST['cp9_unit']) ? $_POST['cp9_unit'] : null;


        $sql = "UPDATE sales_item
        JOIN sales_unit ON sales_item.id = sales_unit.item_id
        SET sales_item.name = ?, sales_item.date = ?,
            sales_item.bl5 = ?, sales_unit.bl5_unit = ?,
            sales_item.bl6 = ?, sales_unit.bl6_unit = ?,
            sales_item.bl7 = ?, sales_unit.bl7_unit = ?,
            sales_item.bl9 = ?, sales_unit.bl9_unit = ?,
            sales_item.sp5 = ?, sales_unit.sp5_unit = ?,
            sales_item.sp6 = ?, sales_unit.sp6_unit = ?,
            sales_item.sp7 = ?, sales_unit.sp7_unit = ?,
            sales_item.sp9 = ?, sales_unit.sp9_unit = ?,
            sales_item.wl5 = ?, sales_unit.wl5_unit = ?,
            sales_item.wl6 = ?, sales_unit.wl6_unit = ?,
            sales_item.wl7 = ?, sales_unit.wl7_unit = ?,
            sales_item.wl9 = ?, sales_unit.wl9_unit = ?,
            sales_item.ld8 = ?, sales_unit.ld8_unit = ?,
            sales_item.ld9 = ?, sales_unit.ld9_unit = ?,
            sales_item.ld11 = ?, sales_unit.ld11_unit = ?,
            sales_item.dld = ?, sales_unit.dld_unit = ?,
            sales_item.pp = ?, sales_unit.pp_unit = ?,
            sales_item.cups50 = ?, sales_unit.cups50_unit = ?,
            sales_item.cups60 = ?, sales_unit.cups60_unit = ?,
            sales_item.cups80 = ?, sales_unit.cups80_unit = ?,
            sales_item.cups100 = ?, sales_unit.cups100_unit = ?,
            sales_item.cups150 = ?, sales_unit.cups150_unit = ?,
            sales_item.cups210 = ?, sales_unit.cups210_unit = ?,
            sales_item.cups250 = ?, sales_unit.cups250_unit = ?,
            sales_item.bd5 = ?, sales_unit.bd5_unit = ?,
            sales_item.bd6 = ?, sales_unit.bd6_unit = ?,
            sales_item.bd7 = ?, sales_unit.bd7_unit = ?,
            sales_item.cp5 = ?, sales_unit.cp5_unit = ?,
            sales_item.cp6 = ?, sales_unit.cp6_unit = ?,
            sales_item.cp7 = ?, sales_unit.cp7_unit = ?,
            sales_item.cp9 = ?, sales_unit.cp9_unit = ?
        WHERE sales_item.id = ?";

        // Repeat this pattern for other fields

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param(
                "ssdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsi",
                $name,
                $date,
                $bl5,
                $bl5_unit,
                $bl6,
                $bl6_unit,
                $bl7,
                $bl7_unit,
                $bl9,
                $bl9_unit,
                $sp5,
                $sp5_unit,
                $sp6,
                $sp6_unit,
                $sp7,
                $sp7_unit,
                $sp9,
                $sp9_unit,
                $wl5,
                $wl5_unit,
                $wl6,
                $wl6_unit,
                $wl7,
                $wl7_unit,
                $wl9,
                $wl9_unit,
                $ld8,
                $ld8_unit,
                $ld9,
                $ld9_unit,
                $ld11,
                $ld11_unit,
                $dld,
                $dld_unit,
                $pp,
                $pp_unit,
                $cups50,
                $cups50_unit,
                $cups60,
                $cups60_unit,
                $cups80,
                $cups80_unit,
                $cups100,
                $cups100_unit,
                $cups150,
                $cups150_unit,
                $cups210,
                $cups210_unit,
                $cups250,
                $cups250_unit,
                $bd5,
                $bd5_unit,
                $bd6,
                $bd6_unit,
                $bd7,
                $bd7_unit,
                $cp5,
                $cp5_unit,
                $cp6,
                $cp6_unit,
                $cp7,
                $cp7_unit,
                $cp9,
                $cp9_unit,
                $id
            );


            // Repeat this pattern for other fields

            if ($stmt->execute()) {
                // Redirect to another page
                header("Location: sales_success.php?id=$insertedItemId");
                exit(); // Make sure to call exit after the header to prevent further execution
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
