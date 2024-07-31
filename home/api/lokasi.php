<?php
include '../../koneksi.php';

header("Content-Type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM lokasi";
    $result = $conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    response(200, "Success", $data);
} else {
    response(400, "Invalid Request", null);
}


