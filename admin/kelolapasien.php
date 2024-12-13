<?php 
// Include koneksi database
include('koneksi.php');

// Validasi data sebelum diproses
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Tambah Data Pasien
if (isset($_POST['tambah'])) {
    $nama = validate_input($_POST['nama']);
    $alamat = validate_input($_POST['alamat']);
    $tanggal_lahir = validate_input($_POST['tanggal_lahir']);
    $jenis_kelamin = validate_input($_POST['jenis_kelamin']);
    $no_ktp = validate_input($_POST['no_ktp']);
    $no_hp = validate_input($_POST['no_hp']);
    $username = validate_input($_POST['username']);
    $password = password_hash(validate_input($_POST['password']), PASSWORD_BCRYPT);

    // Generate No RM
    $tahun_bulan = date('Ym');
    $query_count = "SELECT COUNT(*) as total FROM pasien WHERE no_rm LIKE '$tahun_bulan%'";
    $result_count = mysqli_query($koneksi, $query_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $urutan = $row_count['total'] + 1;
    $no_rm = $tahun_bulan . str_pad($urutan, 4, '0', STR_PAD_LEFT);

    if (empty($nama) || empty($alamat) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($no_ktp) || empty($no_hp) || empty($username) || empty($password)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        $query = "INSERT INTO pasien (nama, alamat, tanggal_lahir, jenis_kelamin, no_ktp, no_hp, no_rm, username, password)
                  VALUES ('$nama', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$no_ktp', '$no_hp', '$no_rm', '$username', '$password')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data pasien berhasil ditambahkan');</script>";
            echo "<script>location='index.php?halaman=kelolapasien';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data pasien: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}

// Update Data Pasien
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama = validate_input($_POST['nama']);
    $alamat = validate_input($_POST['alamat']);
    $tanggal_lahir = validate_input($_POST['tanggal_lahir']);
    $jenis_kelamin = validate_input($_POST['jenis_kelamin']);
    $no_ktp = validate_input($_POST['no_ktp']);
    $no_hp = validate_input($_POST['no_hp']);

    if (empty($nama) || empty($alamat) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($no_ktp) || empty($no_hp)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        $query = "UPDATE pasien SET nama='$nama', alamat='$alamat', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', no_ktp='$no_ktp', no_hp='$no_hp' WHERE id='$id'";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data pasien berhasil diubah');</script>";
            echo "<script>location='index.php?halaman=kelolapasien';</script>";
        } else {
            echo "<script>alert('Gagal mengubah data pasien: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}

// Hapus Data Pasien
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']); // Validasi ID sebagai integer

    // Cek apakah ID pasien ada di database
    $query_check = "SELECT * FROM pasien WHERE id='$id'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Jika ID ditemukan, hapus data pasien
        $query_delete = "DELETE FROM pasien WHERE id='$id'";
        if (mysqli_query($koneksi, $query_delete)) {
            echo "<script>alert('Data pasien berhasil dihapus');</script>";
            echo "<script>location='index.php?halaman=kelolapasien';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data pasien: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('Data pasien tidak ditemukan');</script>";
        echo "<script>location='index.php?halaman=kelolapasien';</script>";
    }
}
?>


<h2>Kelola Pasien</h2>
<hr>

<!-- Tombol Tambah Pasien -->
<button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Pasien</button>
<br><br>

<!-- Tabel Data Pasien -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No. KTP</th>
            <th>No. HP</th>
            <th>No. RM</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM pasien";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['tanggal_lahir'] . "</td>";
            echo "<td>" . ($row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') . "</td>";
            echo "<td>" . $row['no_ktp'] . "</td>";
            echo "<td>" . $row['no_hp'] . "</td>";
            echo "<td>" . $row['no_rm'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>";
            echo "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalUbah" . $row['id'] . "'>Ubah</button> ";
            echo "<a href='index.php?halaman=kelolapasien&hapus=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' class='btn btn-danger btn-sm'>Hapus</a>";
            echo "</td>";
            echo "</tr>";
            ?>
            <!-- Modal Edit Pasien -->
            <div class="modal fade" id="modalUbah<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Pasien</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $row['tanggal_lahir']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="L" <?php echo $row['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="P" <?php echo $row['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No. KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" value="<?php echo $row['no_ktp']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp']; ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </tbody>
</table>

<!-- Modal Tambah Pasien -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>   
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. KTP</label>
                        <input type="text" name="no_ktp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah Pasien</button>
                </div>
            </form>
        </div>
    </div>
</div>
