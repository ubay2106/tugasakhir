<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';


if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}

if (isset($_POST['submit'])) {
    if (daftar_mahasiswa($_POST) > 0) {
        echo "
            <script>
                alert('SUKSES DAFTAR TUGAS AKHIR');
                document.location.href = 'mahasiswa.php';
            </script>
        ";
    } elseif (daftar_mahasiswa($_POST) === -1) {
        echo "
            <script>
                alert('NIM TERDAFTAR');
                document.location.href = 'tambah_mahasiswa.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('GAGAL DAFTAR TUGAS AKHIR');
                document.location.href = 'tambah_mahasiswa.php';
            </script>
        ";
    }
}
?>

<section class="section">
    <div class="section-header">
        <h1>Daftar Tugas Akhir</h1>
    </div>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
