<?php
include('config.php');

$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();

echo json_encode($users);
?>
