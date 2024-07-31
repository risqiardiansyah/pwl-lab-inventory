<?php
include '../../koneksi.php';

header("Content-Type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_GET['user_id'] ?? '';
    $id = $_GET['id'] ?? '';
    if (!empty($id)) {
        $sql = "SELECT * FROM pengguna WHERE id=$id";

        $result = $conn->query($sql);
        

        $data = $row = $result->fetch_object();
    } else {
        $sql = "SELECT * FROM pengguna WHERE id != $user_id";
        $result = $conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    response(200, "Success", $data);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];

    $username = $_POST['username'];
    $password = $_POST['password'] ?? '123';

    if (!empty($id)) {
        $sql = "UPDATE pengguna SET username='$username',password='$password' WHERE id=$id";
    } else {
        $sql = "INSERT INTO pengguna (username,password) VALUES ('$username','$password')";
    }
    $result = $conn->query($sql);

    response(200, "Success", []);
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents('php://input'), $_DELETE);

    $id = $_DELETE['id'];
    $sql = "DELETE FROM pengguna WHERE id=$id";
    $result = $conn->query($sql);

    response(200, "Success Delete", []);
} else {
    response(400, "Invalid Request", null);
}
