<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Form Pendaftaran Pasien</h2>
        <form action="proses_daftar_pasien.php" method="POST">
            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required>
            </div>
            
            <!-- Tanggal Lahir -->
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label><br>
                <input type="radio" name="jenis_kelamin" value="L" required> Laki-laki
                <input type="radio" name="jenis_kelamin" value="P" required> Perempuan
            </div>

            <!-- No. HP -->
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP" required>
            </div>
            
            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            
            <!-- Poli -->
            <div class="mb-3">
                <label for="id_poli" class="form-label">Poli</label>
                <select class="form-select" id="id_poli" name="id_poli" required>
                    <option value="" selected disabled>Pilih Poli</option>
                    <!-- Daftar poli dari tabel poli -->
                    <?php
                    include('koneksi.php');
                    $query_poli = "SELECT * FROM poli";
                    $result_poli = mysqli_query($koneksi, $query_poli);
                    while ($poli = mysqli_fetch_assoc($result_poli)) {
                        echo "<option value='" . $poli['id'] . "'>" . $poli['nama_poli'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar Pasien</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
