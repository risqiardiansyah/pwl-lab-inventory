<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Inventori</title>
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
                    <li><a href="../lokasi">Lokasi</a></li>
                    <li class="active"><a href="#">Inventori</a></li>
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
        <form class="basic-form" method="post" id="submitData">
            <h2 id="titlePage">Edit Inventori</h2>
            <input name="id" id="id" type="hidden">
            <div class="form-group">
                <label for="nomor_inventaris">No Inventaris</label>
                <input type="text" id="nomor_inventaris" name="nomor_inventaris" placeholder="Contoh: ABC-123" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Barang</label>
                <input type="text" id="nama" name="nama" placeholder="Contoh: Monitor" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori">
                    <option value="">-- Pilih Kategori --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <select name="lokasi" id="lokasi">
                    <option value="">-- Pilih Lokasi --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select name="kondisi" id="kondisi">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <div class="form-buttons">
                <button type="submit" class="primary-btn">Simpan</button>
                <a href="index.php" class="btn default-btn">Batal</a>
            </div>
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            getDataKategori()
            getDataLokasi()

            var action = getUrlVars()['action'] || ''
            var id = getUrlVars()['id'] || ''
            if (action == 'edit') {
                getDataEdit(id)

                $("#titlePage").text('Edit Pengguna')
            }
        });

        function getDataEdit(id) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: `data.php?id=${id}`,
                success: function(response, status, xhr) {
                    console.log(response.data);
                    if (response.status == 200) {
                        $("#id").val(response.data.id)
                        $("#nomor_inventaris").val(response.data.nomor_inventaris)
                        $("#nama").val(response.data.nama)
                        $("#kategori").val(response.data.kategori_id).change()
                        $("#lokasi").val(response.data.lokasi_id).change()
                        $("#kondisi").val(response.data.kondisi).change()
                        $("#id").val(response.data.id)
                    }
                }
            });
        }

        function getDataKategori(str) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: '../api/kategori.php',
                success: function(response, status, xhr) {
                    if (response.data.length > 0) {
                        response?.data?.forEach(element => {
                            $("#kategori").append(`<option value="${element.id}">${element.nama_kategori}</option>`);
                        });
                    }
                }
            });
        }

        function getDataLokasi(str) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: '../api/lokasi.php',
                success: function(response, status, xhr) {
                    if (response.data.length > 0) {
                        response?.data?.forEach(element => {
                            $("#lokasi").append(`<option value="${element.id}">${element.nama_lokasi}</option>`);
                        });
                    }
                }
            });
        }

        $("#submitData").submit(function(e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: "POST",
                url: 'data.php',
                data: form.serialize(),
                success: function(data) {
                    window.location.href = '/tugas2/home/inventori/'
                }
            });
        });

        function getUrlVars() {
            var vars = [],
                hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
    </script>
</body>

</html>