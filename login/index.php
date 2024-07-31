<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="../../assets/favicon.ico">
    <title>Login - Tugas 2 PWL, Risqi Ardiansyah</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../home/styles.css">
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <div class="image-container">
                <img src="../assets/logo.png" alt="Bird" width="450">
            </div>
        </div>
        <div class="login-right">
            <div class="login-form">
                <div class="image-container left-logo">
                    <img src="../assets/logo-primary.png" alt="Bird" width="350">
                </div>
                <h2>Selamat Datang</h2>
                <form id="submitData" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="" placeholder="Masukkan Username..." required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" placeholder="*****" required>
                    <button type="submit" class="sign-in">Sign in</button>
                </form>

                <div class="alert alert-danger mt-20 d-none" role="alert" id="alert">
                    Gagal
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            if (localStorage.getItem('user_id') != null) {
                window.location.href = '/tugas2/home/kategori/'
            }
        });

        $("#submitData").submit(function(e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: "POST",
                url: 'proses_login.php',
                data: form.serialize(),
                success: function(response) {
                    localStorage.setItem('user_id', response.data.id)

                    window.location.href = '/tugas2/home/kategori/'
                },
                error: (error) => {
                    $('#alert').html(error.responseJSON.status_message || '')
                    $('#alert').removeClass('d-none')
                }
            });
        });
    </script>
</body>

</html>