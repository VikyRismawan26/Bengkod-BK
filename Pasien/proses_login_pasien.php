<?php
session_start();
include('koneksi.php');

// Validasi input
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    // Cek apakah username dan password cocok
    $query = "SELECT * FROM pasien WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);
    $pasien = mysqli_fetch_assoc($result);

    if ($pasien && password_verify($password, $pasien['password'])) {
        // Login berhasil
        $_SESSION['id_pasien'] = $pasien['id'];
        $_SESSION['nama_pasien'] = $pasien['nama'];
        echo "<script>alert('Login berhasil! Selamat datang, {$pasien['nama']}');</script>";
        echo "<script>location='index.php';</script>";
    } else {
        // Login gagal
        echo "<script>alert('Username atau password salah!');</script>";
        echo "<script>location='loginpasien.php';</script>";
    }
}
?>
