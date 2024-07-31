<?php
include "proses.php";

$sql = "SELECT id,nama_lokasi FROM lokasi";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Lokasi</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="sidebar">
        <div class="nav-section">
            <div class="profile">
                <img src="../../assets/logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="../kategori">Kategori</a></li>
                    <li class="active"><a href="#">Lokasi</a></li>
                    <li><a href="../inventori">Inventori</a></li>
                    <li><a href="../peminjaman">Peminjaman</a></li>
                    <li><a href="../pengguna">Pengguna</a></li>
                </ul>
            </nav>
        </div>

        <nav>
            <ul>
                <li><a href="https://risqiardiansyah.web.app" target="_blank">Pembuat</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <h1>Lokasi</h1>
            <a href="tambah.php?action=tambah" class="btn primary-btn">+ Tambah</a>
        </header>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['nama_lokasi'] ?></td>
                            <td>
                                <a href="tambah.php?action=edit&id=<?= $row['id'] ?>&nama_lokasi=<?= $row['nama_lokasi'] ?>" class="btn secondary-btn">Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ini??')" href="proses.php?action=delete&id=<?= $row['id'] ?>" class="btn danger-btn">Hapus</a>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">Data Kosong</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>