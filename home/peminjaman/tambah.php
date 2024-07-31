<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Peminjaman</title>
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
                    <li><a href="../inventori">Inventori</a></li>
                    <li class="active"><a href="index.php">Peminjaman</a></li>
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
            <h2 id="titlePage">Edit Peminjaman</h2>
            <input name="id" id="id" type="hidden">
            <div class="form-group">
                <label for="inventory">Inventori</label>
                <select name="inventory" id="inventory" onchange="checkBarang()" required>
                    <option value="">-- Pilih Barang --</option>
                </select>
                <small class="d-none text-danger" id="info_barang">Barang Sudah Dipinjam</small>
            </div>
            <div class="form-group">
                <label for="nama_peminjam">Nama Peminjam</label>
                <input type="text" id="nama_peminjam" name="nama_peminjam" placeholder="Contoh: Suherman" required>
            </div>
            <div class="form-group">
                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
            </div>
            <div class="form-group d-none" id="input_status">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="dipinjam">Dipinjam</option>
                    <option value="dikembalikan">Dikembalikan</option>
                </select>
            </div>
            <div class="form-group d-none" id="input_pengembalian">
                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian">
                <small class="d-none text-danger" id="required_pengembalian">Wajib Diisi</small>
            </div>
            <div class="form-buttons">
                <button type="submit" class="primary-btn">Simpan</button>
                <a href="index.php" class="btn default-btn">Batal</a>
            </div>
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var edit = false;
        $(document).ready(function() {
            getDataInventory()

            $("#status").on("change", function() {
                if ($(this).val() == 'dikembalikan') {
                    $("#input_pengembalian").removeClass('d-none')
                } else {
                    $("#input_pengembalian").addClass('d-none')
                }
            });
        });

        function getDataEdit(id) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: `data.php?id=${id}`,
                success: function(response, status, xhr) {
                    if (response.status == 200) {
                        $("#input_status").removeClass('d-none')

                        $("#id").val(response.data.id)
                        $("#inventory").val(response.data.inventory_id).change()
                        $("#nama_peminjam").val(response.data.nama_peminjam)
                        $("#tanggal_peminjaman").val(response.data.tanggal_peminjaman).change()
                        $("#tanggal_pengembalian").val(response.data.tanggal_pengembalian).change()
                        $("#status").val(response.data.status).change()
                    }
                }
            });
        }

        function getDataInventory(str) {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: '../api/inventory.php',
                success: function(response, status, xhr) {
                    if (response.data.length > 0) {
                        response?.data?.forEach(element => {
                            $("#inventory").append(`<option value="${element.id}">${element.nomor_inventaris + ' - ' + element.nama}</option>`);
                        });
                    }

                    var action = getUrlVars()['action'] || ''
                    var id = getUrlVars()['id'] || ''
                    if (action == 'edit') {
                        getDataEdit(id)
                        edit = true

                        $("#titlePage").text('Edit Peminjaman')
                    }
                }
            });
        }

        $("#submitData").submit(function(e) {
            e.preventDefault();

            if (edit) {
                const tanggal_pengembalian = $('#tanggal_pengembalian').val();
                if (!Date.parse(tanggal_pengembalian)) {
                    $("#required_pengembalian").removeClass('d-none')

                    return;
                } else {
                    $("#required_pengembalian").addClass('d-none')
                }
            }

            var form = $(this);

            $.ajax({
                type: "POST",
                url: 'data.php',
                data: form.serialize(),
                success: function(data) {
                    window.location.href = '/tugas2/home/peminjaman/'
                }
            });
        });

        function checkBarang() {
            const id = getUrlVars()['id'] || ''
            const value = $('#inventory').val();
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: `../api/peminjaman.php?inventory_id=${value}&id=${id}`,
                success: function(response, status, xhr) {
                    $("#info_barang").addClass('d-none')

                    $("#simpanBtn").removeAttr('disabled')
                    $("#simpanBtn").removeClass('disabled-btn')
                    $("#simpanBtn").addClass('primary-btn')
                },
                error: function(error) {
                    $("#info_barang").removeClass('d-none')

                    $("#simpanBtn").attr('disabled', true)
                    $("#simpanBtn").removeClass('primary-btn')
                    $("#simpanBtn").addClass('disabled-btn')
                }
            });
        }

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