<?php
session_start();
require_once '../layout/top.php';


if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}
?>

<section class="section">
    <div class="section-header">
        <h1>Edit Peserta Tugas Akhir</h1>
    </div>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="nidn" name="nidn" required>
        </div>
        <div class="form-group">
            <label for="name">NIM</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="gender">Jenis Kelamin</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <!-- <div class="form-group">
            <label for="status">Pengajuan</label>
            <select class="form-control" id="status" name="status" required>
                <option value="" disabled selected>Pilih Status</option>
                <option value="Laki-laki">Pending</option>
                <option value="Perempuan">Disetujui</option>
            </select>
        </div> -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
