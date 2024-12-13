# Sistem Informasi Poliklinik

Sistem Informasi Poliklinik adalah aplikasi berbasis web yang dirancang untuk mengelola data dan proses administrasi di poliklinik, termasuk pengelolaan data pasien, dokter, poli, jadwal pemeriksaan, dan obat. Sistem ini bertujuan untuk mempermudah proses operasional poliklinik sehingga lebih efisien dan terstruktur.

## Fitur Utama
1. **Kelola Pasien**:
   - Tambah, edit, dan hapus data pasien.
   - Data meliputi: nama, alamat, tanggal lahir, jenis kelamin, nomor KTP, nomor HP, nomor rekam medis (No. RM), username, dan password.
   - No. RM dihasilkan otomatis berdasarkan tahun dan bulan pendaftaran.

2. **Kelola Dokter**:
   - Tambah, edit, dan hapus data dokter.
   - Data meliputi: nama, alamat, nomor HP, poli yang dilayani, username, dan password.

3. **Kelola Poli**:
   - Tambah, edit, dan hapus data poli.
   - Data meliputi: nama poli dan deskripsi.

4. **Kelola Obat**:
   - Tambah, edit, dan hapus data obat.
   - Data meliputi: nama obat, kemasan, dan harga.

5. **Kelola Jadwal Pemeriksaan**:
   - Mengelola jadwal pemeriksaan berdasarkan dokter dan poli.

## Struktur Database
### Tabel Utama:
1. **Pasien**: Menyimpan data pasien, termasuk informasi pribadi dan nomor rekam medis.
2. **Dokter**: Menyimpan data dokter beserta poli yang dilayani.
3. **Poli**: Menyimpan data nama dan deskripsi poli.
4. **Obat**: Menyimpan data obat termasuk nama, kemasan, dan harga.
5. **Jadwal Pemeriksaan**: Menyimpan data jadwal pemeriksaan berdasarkan poli dan dokter.

## Teknologi yang Digunakan
- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP (Native)
- **Database**: MySQL
- **Server**: XAMPP (untuk pengembangan lokal)

## Instalasi
1. Clone repository ini ke komputer Anda:
   ```bash
   https://github.com/VikyRismawan26/Bengkod-BK.git
2. Pindahkan folder proyek ke dalam direktori root server lokal Anda (misalnya: htdocs pada XAMPP).
3. Buat database baru di phpMyAdmin dengan nama db_poliklinik.
4. Import file database:
   -Buka phpMyAdmin.
   - Pilih database db_poliklinik.
   - Klik tab Import dan unggah file db_poliklinik.sql.
5. Perbarui konfigurasi koneksi database di file koneksi.php:
   - $host = "localhost";
   - $user = "root";
   - $password = "";
   - $database = "db_poliklinik";
   - $koneksi = mysqli_connect($host, $user, $password, $database);
6. Jalankan server lokal melalui XAMPP dan akses aplikasi melalui browser

## Sturktur Folder
sistem-informasi-poliklinik/
- ├── admin/                 # Halaman admin (kelola pasien, dokter, poli, obat, dll.)
- ├── pasien/                # Halaman untuk pasien (registrasi, login, dll.)
- ├── assets/                # File CSS, JavaScript, dan gambar
- ├── db_poliklinik.sql      # File database
- ├── index.php              # Beranda aplikasi
- ├── koneksi.php            # Koneksi database
- └── README.md              # Dokumentasi proyek

## Kontak
- Viky Luffiandi Rismawan
- A11.2021.13392
- Kelas Bengkod WD003
