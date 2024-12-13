<?php
include('koneksi.php');

// Validasi data sebelum diproses
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fungsi untuk membuat No RM
function generate_no_rm($koneksi) {
    $tahun_bulan = date('Ym'); // Format: TahunBulan (contoh: 202412)
    $query = "SELECT COUNT(*) as total FROM pasien WHERE DATE_FORMAT(tanggal_lahir, '%Y%m') = '$tahun_bulan'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $urutan = $row['total'] + 1; // Tambahkan 1 untuk pasien yang baru mendaftar
    return $tahun_bulan . str_pad($urutan, 4, '0', STR_PAD_LEFT); // Format: TahunBulan + NomorUrut (contoh: 2024120001)
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = validate_input($_POST['nama']);
    $alamat = validate_input($_POST['alamat']);
    $tanggal_lahir = validate_input($_POST['tanggal_lahir']);
    $jenis_kelamin = validate_input($_POST['jenis_kelamin']);
    $no_hp = validate_input($_POST['no_hp']);
    $username = validate_input($_POST['username']);
    $password = password_hash(validate_input($_POST['password']), PASSWORD_BCRYPT);
    $id_poli = validate_input($_POST['id_poli']);

    // Generate No RM
    $no_rm = generate_no_rm($koneksi);

    if (empty($nama) || empty($alamat) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($no_hp) || empty($username) || empty($password) || empty($id_poli)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
        echo "<script>location='form_daftar_pasien.php';</script>";
    } else {
        $query = "INSERT INTO pasien (nama, alamat, tanggal_lahir, jenis_kelamin, no_hp, no_rm, username, password) 
                  VALUES ('$nama', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$no_hp', '$no_rm', '$username', '$password')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Pendaftaran berhasil! No RM Anda: $no_rm');</script>";
            echo "<script>location='loginpasien.php';</script>";
        } else {
            echo "<script>alert('Pendaftaran gagal: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>
