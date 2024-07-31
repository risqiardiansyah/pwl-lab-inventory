<?php
include '../../koneksi.php';

header("Content-Type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'] ?? '';
    if (!empty($id)) {
        $sql = "SELECT * FROM inventory WHERE id=$id";

        $result = $conn->query($sql);
        

        $data = $row = $result->fetch_object();
    } else {
        $sql = "SELECT
            i.*,
            k.nama_kategori,
            l.nama_lokasi
        FROM
            inventory i
        JOIN
            kategori k ON i.kategori_id = k.id
        JOIN
            lokasi l ON i.lokasi_id = l.id;
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

    $nomor_inventaris = $_POST['nomor_inventaris'];
    $nama = $_POST['nama'];
    $kategori = (int)$_POST['kategori'];
    $lokasi = (int)$_POST['lokasi'];
    $kondisi = $_POST['kondisi'];

    if (!empty($id)) {
        $sql = "UPDATE inventory SET nomor_inventaris='$nomor_inventaris',nama='$nama',kategori_id=$kategori,lokasi_id=$lokasi,kondisi='$kondisi' WHERE id=$id";
    } else {
        $sql = "INSERT INTO inventory (nomor_inventaris,nama,kategori_id,lokasi_id,kondisi) VALUES ('$nomor_inventaris','$nama','$kategori','$lokasi','$kondisi')";
    }
    $result = $conn->query($sql);

    response(200, "Success", []);
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents('php://input'), $_DELETE);

    $id = $_DELETE['id'];
    $sql = "DELETE FROM inventory WHERE id=$id";
    $result = $conn->query($sql);

    response(200, "Success Delete", []);
} else {
    response(400, "Invalid Request", null);
}
