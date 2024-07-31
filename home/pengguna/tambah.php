<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Pengguna</title>
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
                    <li><a href="../peminjaman">Peminjaman</a></li>
                    <li class="active"><a href="index.php">Pengguna</a></li>
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
            <h2 id="titlePage">Tambah Pengguna</h2>
            <input name="id" id="id" type="hidden">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Contoh: admin" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="****" required>
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
                        $("#username").val(response.data.username)
                        $("#password").val(response.data.password)
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
                    window.location.href = '/tugas2/home/pengguna/'
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