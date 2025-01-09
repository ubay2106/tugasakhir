<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

$nim = query("SELECT * FROM users WHERE role = 'Mahasiswa'");
$uji = query("SELECT * FROM users WHERE role = 'Penguji'");
$bimbing = query("SELECT * FROM users WHERE role = 'Pembimbing'");
$mhs = query('SELECT * FROM mahasiswa');
$pembimbing = query("SELECT dosen.id AS dosen_id, dosen.nama AS dosen_nama, dosen.nidn_id, users.id AS user_id
FROM dosen
INNER JOIN users ON dosen.nidn_id = users.id
WHERE users.role = 'Pembimbing';"
);
$penguji = query("SELECT dosen.id AS dosen_id, dosen.nama AS dosen_nama, dosen.nidn_id, users.id AS user_id
FROM dosen
INNER JOIN users ON dosen.nidn_id = users.id
WHERE users.role = 'Penguji';"
);


if (isset($_POST['submit'])) {
    if (manage($_POST) > 0) {
        echo "
            <script>
                alert('SUKSES MANAGE');
                document.location.href = 'penentuan.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('GAGAL MANAGE');
                document.location.href = 'form_penentuan.php';
            </script>
        ";
    }
}

?>

<section class="section">
    <div class="section-header">
        <h1>Manage Data</h1>
    </div>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nim_id">NIM</label>
            <select class="form-control" id="nim_id" name="nim_id" required>
                <option value="" disabled selected>Pilih NIM</option>
                <?php foreach( $nim as $row):?>
                <option value="<?= $row['id'] ?>"><?= $row['id']. $row['nim'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mahasiswa_id">Mahasiswa</label>
            <select class="form-control" id="mahasiswa_id" name="mahasiswa_id" required>
                <option value="" disabled selected>Pilih Mahasiswa</option>
                <?php foreach( $mhs as $row):?>
                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="judul_id">Judul</label>
            <select class="form-control" id="judul_id" name="judul_id" required>
                <option value="" disabled selected>Pilih Judul</option>
                <?php foreach( $mhs as $row):?>
                <option value="<?= $row['id'] ?>"><?= $row['judul'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nidn_idbim">NIDN</label>
            <select class="form-control" id="nidn_idbim" name="nidn_idbim" required>
                <option value="" disabled selected>Pilih NIDN</option>
                <?php foreach( $bimbing as $row):?>
                <option value="<?= $row['id'] ?>"><?= $row['nidn'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="pembimbing_id">Pembimbing</label>
            <select class="form-control" id="pembimbing_id" name="pembimbing_id" required>
                <option value="" disabled selected>Pilih Pembimbing</option>
                <?php foreach( $pembimbing as $row):?>
                <option value="<?= $row['dosen_id'] ?>"><?= $row['dosen_nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nidn_iduji">NIDN</label>
            <select class="form-control" id="nidn_iduji" name="nidn_iduji" required>
                <option value="" disabled selected>Pilih NIDN</option>
                <?php foreach( $uji as $row):?>
                <option value="<?= $row['id'] ?>"><?= $row['nidn'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="penguji_id">Penguji</label>
            <select class="form-control" id="penguji_id" name="penguji_id" required>
                <option value="" disabled selected>Pilih Penguji</option>
                <?php foreach( $penguji as $row):?>
                <option value="<?= $row['dosen_id'] ?>"><?= $row['dosen_nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>

<?php
include '../layout/bottom.php';
?>
