<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Pengguna</title>
    <link rel="stylesheet" href="../styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        <header>
            <h1>Pengguna</h1>
            <a href="tambah.php?action=tambah" class="btn primary-btn">+ Tambah</a>
        </header>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableData">
                <!-- Data -->
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            getData()
        });

        function getData() {
            resetTable();

            const user_id = localStorage.getItem('user_id')

            $.ajax({
                type: 'GET',
                dataType: "json",
                url: 'data.php?user_id=' + user_id,
                success: function(response, status, xhr) {
                    if (response.status == 200 && response.data.length > 0) {
                        var i = 1;
                        response?.data?.forEach(element => {
                            $("#tableData").append(
                                `
                                <tr>
                                    <td>${i}</td>
                                    <td>${element.username}</td>
                                    <td>
                                        <a href="tambah.php?action=edit&id=${element.id}" class="btn secondary-btn">Edit</a>
                                        <a onclick="hapusData(${element.id})" class="btn danger-btn">Hapus</a>
                                    </td>
                                </tr>
                            `);

                            i++
                        });
                    } else {
                        $("#tableData").append(
                            `
                            <tr>
                                <td colspan="7" class="text-center">Data Kosong</td>
                            </tr>
                        `);
                    }
                }
            });
        }

        function hapusData(id) {
            if (confirm('Yakin hapus data ini ?') == true) {
                $.ajax({
                    type: 'DELETE',
                    dataType: "json",
                    url: 'data.php',
                    data: {
                        id: id
                    },
                    success: function(response, status, xhr) {
                        getData();
                    }
                });
            }
        }

        function resetTable() {
            $("#tableData").empty();
        }
    </script>
</body>

</html>