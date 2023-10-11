<?php
// Fungsi untuk memeriksa kata sandi
function checkPassword($password, $hashedPassword) {
    return md5($password) === $hashedPassword;
}

// Fungsi untuk mendapatkan data pengguna berdasarkan email
function getUserByEmail($email) {
    // Gantilah ini dengan koneksi ke database dan query SQL yang sesuai
    include "koneksi.php";

    if (mysqli_connect_errno()) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $stmt->close();
        $koneksi->close();
        return $user;
    } else {
        $stmt->close();
        $koneksi->close();
        return null;
    }
}

// Ambil data dari formulir login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cari pengguna berdasarkan email
    $user = getUserByEmail($email);

    if ($user) {
        $hashedPassword = $user['password'];

        // Periksa kata sandi
        session_start();
        if (checkPassword($password, $hashedPassword)) {
            // Kata sandi cocok, pengguna berhasil login
            header("Location: index.php");
            exit;
        } else {
                    $_SESSION['login_error'] = 'email atau Password salah.';
    // Jika kredensial salah, kembali ke halaman login dengan pesan error
    header('Location: login.php?error=1');
    exit();
        }
    } else {
        // Pengguna tidak ditemukan
        $_SESSION['login_error'] = 'Pengguna Tidak Ditemukan.';
        header('Location: login.php?error=1');
        exit();
    }
}
?>



