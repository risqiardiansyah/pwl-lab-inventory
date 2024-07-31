<?php
include '../../koneksi.php';

header("Content-Type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $inventory_id = $_GET['inventory_id'] ?? '';
    $id = $_GET['id'] ?? '';

    if (!empty($id)) {
        $sql = "SELECT * FROM peminjaman WHERE inventory_id = $inventory_id AND id = $id";

        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        if (!empty($data)) {
            response(200, "Success", $data);
        } else {
            response(400, "Invalid Request", ['id' => $id]);
        }
    } else {
        $sql = "SELECT * FROM peminjaman WHERE inventory_id = $inventory_id AND status='dipinjam'";

        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        if (empty($data)) {
            response(200, "Success", $data);
        } else {
            response(400, "Invalid Request", []);
        }
    }
}
