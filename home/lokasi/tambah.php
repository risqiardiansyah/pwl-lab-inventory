<?php include "proses.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Tambah Lokasi</title>
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
                    <li><a href="../kategori">Lokasi</a></li>
                    <li class="active"><a href="index.php">Lokasi</a></li>
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
        <?php if (isset($errorMsg) && !empty($errorMsg)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMsg ?>
            </div>
        <?php } ?>
        <form class="basic-form" method="post">
            <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') { ?>
                <h2>Edit Lokasi</h2>
            <?php } else { ?>
                <h2>Tambah Lokasi</h2>
            <?php } ?>
            <input name="id" type="hidden" value="<?= $_GET['id'] ?? '' ?>">
            <input name="action" type="hidden" value="<?= $_GET['action'] ?? '' ?>">
            <div class="form-group">
                <label for="nama_lokasi">Nama Lokasi</label>
                <input type="text" id="nama_lokasi" name="nama_lokasi" placeholder="Contoh: Gudang" value="<?= $_POST['nama_lokasi'] ?? $_GET['nama_lokasi'] ?? '' ?>" required>
            </div>
            <div class="form-buttons">
                <button type="submit" class="primary-btn">Simpan</button>
                <a href="index.php" class="btn default-btn">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>