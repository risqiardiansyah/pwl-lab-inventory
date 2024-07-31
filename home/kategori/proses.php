<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'tambah') {
    $nama_kategori = $_POST['nama_kategori'];

    if (strlen($nama_kategori) < 3) {
        $errorMsg = "Nama harus terdiri dari minimal 3 karakter.";
    }

    if (!isset($errorMsg) && empty($errorMsg)) {
        $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";

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
    $nama_kategori = $_POST['nama_kategori'];

    if (strlen($nama_kategori) < 3) {
        $errorMsg = "Nama harus terdiri dari minimal 3 karakter.";
    }

    if (!isset($errorMsg) && empty($errorMsg)) {
        $sql = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id=$id";

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
    $sql = "DELETE FROM kategori WHERE id=$id";

    $conn->query($sql);

    header("Location: index.php");
    $conn->close();
}
