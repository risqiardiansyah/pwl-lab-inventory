<?php
include '../koneksi.php';

header("Content-Type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = (int)$_POST['username'];
    $password = (int)$_POST['password'];

    $sql = "SELECT * FROM pengguna WHERE username=$username AND password=$password";

    $result = $conn->query($sql);

    $data = $row = $result->fetch_object();

    if (!empty($data)) {
        response(200, "Success", $data);
    } else {
        response(400, "Username atau Password Salah", []);
    }

} else {
    response(400, "Invalid Request", null);
}
