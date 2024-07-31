<?php
include "proses.php";

$sql = "SELECT id,nama_kategori FROM kategori";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://unpkg.com/@sjmc11/tourguidejs/dist/css/tour.min.css">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
</head>

<body>
    <div class="sidebar">
        <div class="nav-section">
            <div class="profile">
                <img src="../../assets/logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <div data-tg-tour='<center>Selamat Datang 😊🙏 <br><br> Menu ini menggunakan php native</center>' data-tg-order="0">
                        <li class="active"><a href="#">Kategori</a></li>
                        <li><a href="../lokasi">Lokasi</a></li>
                    </div>
                    <div data-tg-tour='<center>Sedangkan menu ini menggunakan Ajax & JQuery</center>' data-tg-order="1">
                        <li><a href="../inventori">Inventori</a></li>
                        <li><a href="../peminjaman">Peminjaman</a></li>
                        <li><a href="../pengguna">Pengguna</a></li>
                    </div>
                </ul>
            </nav>
        </div>

        <nav data-tg-tour='<center>Dibuat oleh Risqi Ardiansyah, selengkapnya di menu ini</center>' data-tg-order="2">
            <ul>
                <li><a href="https://risqiardiansyah.web.app" target="_blank">Pembuat</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <h1>Kategori</h1>
            <a href="tambah.php?action=tambah" class="btn primary-btn">+ Tambah</a>
        </header>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
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
                            <td><?= $row['nama_kategori'] ?></td>
                            <td>
                                <a href="tambah.php?action=edit&id=<?= $row['id'] ?>&nama_kategori=<?= $row['nama_kategori'] ?>" class="btn secondary-btn">Edit</a>
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

    <script src="https://unpkg.com/@sjmc11/tourguidejs/dist/tour.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const tg = new tourguide.TourGuideClient({
            exitOnClickOutside: false,
            exitOnEscape: false,
            closeButton: false,
            showStepProgress: false
        })


        tg.start()
    </script>
</body>

</html>