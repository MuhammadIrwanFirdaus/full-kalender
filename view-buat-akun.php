<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Buat Akun</h2>
        <form action="buat-akun-koneksi.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="konfirmasi_password">Konfirmasi Password:</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Buat Akun</button>
            </div>
        </form>
    </div>
    <script>
        // Menambahkan event listener ke formulir
        document.getElementById("registrationForm").addEventListener("submit", function (e) {
            // Mengarahkan pengguna ke halaman login setelah pengiriman formulir
            window.location.href = "login.php";
        });
    </script>
</body>
</html>
