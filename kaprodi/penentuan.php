<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

$penentuan = query("SELECT 
    penentuan.id AS penentuan_id,
    users1.nim AS nim,
    mahasiswa.nama AS mahasiswa_nama,
    mahasiswa.judul AS judul,
    users2.nidn AS nidn_pembimbing,
    dosen1.nama AS dosen_pembimbing,
    users3.nidn AS nidn_penguji,
    dosen2.nama AS dosen_penguji
FROM 
    penentuan
-- Join dengan tabel users untuk nim_id
INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
-- Join dengan tabel mahasiswa untuk mahasiswa_id dan judul_id
INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
-- Join dengan tabel users untuk nidn_idbim
INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
-- Join dengan tabel dosen untuk pembimbing_id
INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
-- Join dengan tabel users untuk nidn_iduji
INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
-- Join dengan tabel dosen untuk penguji_id
INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id;");
$cek = query("SELECT COUNT(*) AS jumlah
                FROM penentuan");
$cek1 = $cek[0]['jumlah'] > 0;
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Management Data</h1>
        <a href="../kaprodi/form_penentuan.php" class="btn btn-primary">Manage</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($cek1)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped w-100" id="table-1">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Mahasiswa</th>
                                    <th>Judul</th>
                                    <th>NIDN Pembimbing</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>NIDN Penguji</th>
                                    <th>Dosen Penguji</th>
                                </tr>
                            </thead>
                            <?php $i=1; foreach( $penentuan as $row):?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['mahasiswa_nama'] ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['nidn_pembimbing'] ?></td>
                                    <td><?= $row['dosen_pembimbing'] ?></td>
                                    <td><?= $row['nidn_penguji'] ?></td>
                                    <td><?= $row['dosen_penguji'] ?></td>
                                </tr>
                            </tbody>
                            <?php $i++; endforeach; ?>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="text-center">
                        <p>Belum ada data</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
