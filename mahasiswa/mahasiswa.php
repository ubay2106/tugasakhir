<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if(!isset($_SESSION['role'])){
    header("Location: ../template/index.php");
    exit;
  }

  if ($_SESSION['role'] === 'Admin') {
    // Jika admin, ambil semua data mahasiswa
    $mahasiswa = query("SELECT * FROM mahasiswa INNER JOIN users ON mahasiswa.nim_id = users.id");
} else {
    // Jika mahasiswa, ambil hanya data mahasiswa sesuai NIM yang login
    $nim = mysqli_real_escape_string($conn, $_SESSION['nim']);
    $mahasiswa = query("SELECT * FROM mahasiswa INNER JOIN users ON mahasiswa.nim_id = users.id WHERE users.nim = '$nim'");

    $cek_tugas_akhir = query("SELECT COUNT(*) AS jumlah, MAX(pengajuan) AS pengajuan 
    FROM mahasiswa 
    WHERE nim_id = (SELECT id FROM users WHERE nim = '$nim')");
    $tugas_akhir_sudah_ada = ($cek_tugas_akhir[0]['jumlah'] > 0);
    $status_pengajuan = $cek_tugas_akhir[0]['pengajuan'];
}

?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Data Peserta</h1>
        <?php if ($_SESSION['role'] === 'Admin' || (!$tugas_akhir_sudah_ada || $status_pengajuan == 'ditolak')): ?>
        <a href="../mahasiswa/tambah_mahasiswa.php" class="btn btn-primary">Daftar Tugas Akhir</a>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <?php if (!empty($tugas_akhir_sudah_ada)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped w-100" id="table-1">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Judul</th>
                                    <th>Pengajuan</th>
                                </tr>
                            </thead>
                            <?php $i=1; foreach( $mahasiswa as $row):?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['tanggal_lahir'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><span class="badge badge-success"><?= $row['pengajuan'] ?></span></td>
                                </tr>
                            </tbody>
                            <?php $i++; endforeach; ?>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="text-center">
                            <p>Silahkan daftar terlebih dahulu.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
</section>

<?php
require_once '../layout/bottom.php';
?>