<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'tambah') {
    $nama_lokasi = $_POST['nama_lokasi'];

    if (strlen($nama_lokasi) < 3) {
        $errorMsg = "Nama harus terdiri dari minimal 3 karakter.";
    }

    if (!isset($errorMsg) && empty($errorMsg)) {
        $sql = "INSERT INTO lokasi (nama_lokasi) VALUES ('$nama_lokasi')";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
        } else {
            $errorMsg = "Error: " . $sql . "<br>" . $conn->error;

            header("Location: tambah.php");
        }
    }
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $nama_lokasi = $_POST['nama_lokasi'];

    if (strlen($nama_lokasi) < 3) {
        $errorMsg = "Nama harus terdiri dari minimal 3 karakter.";
    }

    if (!isset($errorMsg) && empty($errorMsg)) {
        $sql = "UPDATE lokasi SET nama_lokasi='$nama_lokasi' WHERE id=$id";

        if ($conn->query($sql) === true) {
            header("Location: index.php");
        } else {
            $errorMsg = "Error: " . $sql . "<br>" . $conn->error;

            header("Location: tambah.php");
        }
    }
    $conn->close();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM lokasi WHERE id=$id";

    $conn->query($sql);

    header("Location: index.php");
    $conn->close();
}
