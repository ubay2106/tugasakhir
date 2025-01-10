<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

$dosen = query('SELECT *FROM dosen
                    INNER JOIN users ON dosen.nidn_id = users.id
                    INNER JOIN users AS role_user ON dosen.status = role_user.id;');

$cek = query("SELECT COUNT(*) AS jumlah
                FROM dosen");
$cek1 = $cek[0]['jumlah'] > 0;
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>List Dosen</h1>
        <a href="../kaprodi/tambah_dosen.php" class="btn btn-primary">Tambah Data</a>
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
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                    <th style="width: 150">Aksi</th>
                                </tr>
                            </thead>
                            <?php $i=1; foreach( $dosen as $row):?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nidn'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['role'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" href="edit_dosen.php">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </a>
                                    </td>
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
