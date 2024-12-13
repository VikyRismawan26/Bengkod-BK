<?php
// Include koneksi database
include('koneksi.php');

// Validasi data sebelum diproses
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Tambah Data Obat
if (isset($_POST['tambah'])) {
    $nama_obat = validate_input($_POST['nama_obat']);
    $kemasan = validate_input($_POST['kemasan']);
    $harga = validate_input($_POST['harga']);

    if (empty($nama_obat) || empty($kemasan) || empty($harga)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', '$harga')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data obat berhasil ditambahkan');</script>";
            echo "<script>location='index.php?halaman=kelolaobat';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data obat: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}

// Update Data Obat
if (isset($_POST['ubah'])) {
    $id = $_POST['id'];
    $nama_obat = validate_input($_POST['nama_obat']);
    $kemasan = validate_input($_POST['kemasan']);
    $harga = validate_input($_POST['harga']);

    if (empty($nama_obat) || empty($kemasan) || empty($harga)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        $query = "UPDATE obat SET nama_obat='$nama_obat', kemasan='$kemasan', harga='$harga' WHERE id='$id'";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data obat berhasil diubah');</script>";
            echo "<script>location='index.php?halaman=kelolaobat';</script>";
        } else {
            echo "<script>alert('Gagal mengubah data obat: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}

// Hapus Data Obat
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']); // Validasi ID sebagai integer

    // Cek apakah ID obat ada di database
    $query_check = "SELECT * FROM obat WHERE id='$id'";
    $result_check = mysqli_query($koneksi, $query_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Jika ID ditemukan, hapus data obat
        $query_delete = "DELETE FROM obat WHERE id='$id'";
        if (mysqli_query($koneksi, $query_delete)) {
            echo "<script>alert('Data obat berhasil dihapus');</script>";
            echo "<script>location='index.php?halaman=kelolaobat';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data obat: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('Data obat tidak ditemukan');</script>";
        echo "<script>location='index.php?halaman=kelolaobat';</script>";
    }
}
?>

<h2>Kelola Obat</h2>
<hr>

<!-- Tombol Tambah Obat -->
<button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">Tambah Obat</button>
<br><br>

<!-- Tabel Data Obat -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Kemasan</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM obat";
        $result = mysqli_query($koneksi, $query);
        $no = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama_obat'] . "</td>";
            echo "<td>" . $row['kemasan'] . "</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "<td>";
            echo "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#modalUbah" . $row['id'] . "'>Ubah</button> ";
            echo "<a href='index.php?halaman=kelolaobat&hapus=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' class='btn btn-danger btn-sm'>Hapus</a>";
            echo "</td>";
            echo "</tr>";
            ?>
            <!-- Modal Edit Obat -->
            <div class="modal fade" id="modalUbah<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Obat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama_obat" class="form-control" value="<?php echo $row['nama_obat']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Kemasan</label>
                                    <input type="text" name="kemasan" class="form-control" value="<?php echo $row['kemasan']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" class="form-control" value="<?php echo $row['harga']; ?>" required>
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

<!-- Modal Tambah Obat -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kemasan</label>
                        <input type="text" name="kemasan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>
