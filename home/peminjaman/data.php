<?php
include '../../koneksi.php';

header("Content-Type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'] ?? '';
    if (!empty($id)) {
        $sql = "SELECT * FROM peminjaman WHERE id=$id";

        $result = $conn->query($sql);
        

        $data = $row = $result->fetch_object();
    } else {
        $sql = "SELECT
            p.*,
            i.nomor_inventaris,
            i.nama AS nama_inventory
        FROM
            peminjaman p
        JOIN
            inventory i ON p.inventory_id = i.id
        ";
        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    response(200, "Success", $data);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];

    $inventory_id = $_POST['inventory'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = date('Y-m-d');
    $status = $_POST['status'] ?? '';

    if (!empty($id)) {
        if ($status == 'dikembalikan') {
            $sql = "UPDATE peminjaman SET inventory_id='$inventory_id',nama_peminjam='$nama_peminjam',tanggal_peminjaman='$tanggal_peminjaman',tanggal_pengembalian='$tanggal_pengembalian',status='$status' WHERE id=$id";
        } elseif ($status == 'dipinjam') {
            $sql = "UPDATE peminjaman SET inventory_id='$inventory_id',nama_peminjam='$nama_peminjam',tanggal_peminjaman='$tanggal_peminjaman',tanggal_pengembalian=NULL,status='$status' WHERE id=$id";
        }
    } else {
        $sql = "INSERT INTO peminjaman (inventory_id,nama_peminjam,tanggal_peminjaman) VALUES ('$inventory_id','$nama_peminjam','$tanggal_peminjaman')";
    }
    $result = $conn->query($sql);

    response(200, "Success", []);
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents('php://input'), $_DELETE);

    $id = $_DELETE['id'];
    $sql = "DELETE FROM peminjaman WHERE id=$id";
    $result = $conn->query($sql);

    response(200, "Success Delete", []);
} else {
    response(400, "Invalid Request", null);
}
