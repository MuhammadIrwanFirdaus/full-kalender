<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>

    <link rel="stylesheet" href="dist/css/login.css">
    <link rel="stylesheet" href="assets/bootstrap.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- <link rel="stylesheet" href="dist/css/sidebar.css">
    <link rel="stylesheet" href="dist/css/Konten.css"> -->

    <script src="assets/jquery.min.js"></script>
    <script src="assets/jquery-ui.min.js"></script>
    <script src="assets/moment.min.js"></script>
</head>
<body>
<div class="login-container">
    <h2 class="login-header">Login</h2>

    <?php
   session_start();
   // Cek apakah ada notifikasi error dari proses login sebelumnya
    if (isset($_SESSION['login_error'])) {
        echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>';
        unset($_SESSION['login_error']);

    }
    ?>

    <form class="login-form" action="login-koneksi.php" method="post">
        <input type="text" name="email" placeholder="Masukkan Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    <a href="view-buat-akun.php">buat akun</a>
</div>

</body>
</html>