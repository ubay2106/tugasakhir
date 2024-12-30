<?php
require_once '../layout/top.php';

require '../database/koneksi.php';

if (isset($_POST['submit'])) {
    if (tambah_dosen($_POST) > 0) {
        echo "
            <script>
                alert('SUKSES TAMBAH DOSEN');
                document.location.href = 'dosen.php';
            </script>
        ";
    } elseif (tambah_dosen($_POST) === -1) {
        echo "
            <script>
                alert('EMAIL TERDAFTAR');
                document.location.href = 'tambah_dosen.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('GAGAL TAMBAH DOSEN');
                document.location.href = 'tambah_dosen.php';
            </script>
        ";
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Tambah Data Dosen</h1>
    </div>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" class="form-control" id="nidn" name="nidn" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Dosen</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
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
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="" disabled selected>Pilih Status</option>
                <option value="Penguji">Penguji</option>
                <option value="Pembimbing">Pembimbing</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
