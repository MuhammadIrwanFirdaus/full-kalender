<?php

include "koneksi.php";

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

session_start();
// Ambil data dari formulir
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi data
if (empty($nama) || empty($email) || empty($password) || empty($konfirmasi_password)) {
    die("Semua field harus diisi.");
}

if ($password !== $konfirmasi_password) {
    die("Password dan konfirmasi password tidak cocok.");
}

// Hash password menggunakan MD5
$hashedPassword = md5($password);


// Siapkan query SQL untuk menyimpan data pengguna
$query = "INSERT INTO users (nama, email, password) VALUES (?, ?, ?)";

// Persiapkan statement SQL
$stmt = $koneksi->prepare($query);

// Ikat parameter ke statement
$stmt->bind_param("sss", $nama, $email, $hashedPassword);

// Eksekusi query untuk menyimpan data pengguna
if ($stmt->execute()) {
    header("Location: login.php");
    exit;
} else {
    echo "Terjadi kesalahan saat mendaftar: " . $stmt->error;
}

// Tutup statement dan koneksi database
$stmt->close();
$koneksi->close();
?>
