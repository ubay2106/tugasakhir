<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

if (isset($_GET['action']) && isset($_GET['nim_id'])) {
    $id = $_GET['nim_id'];
    $action = $_GET['action'];

    if ($action === 'approve') {
        if (updateStatus($id, 'disetujui')) {
            echo "<script>
                alert('Pengajuan berhasil disetujui');
                document.location.href = 'mahasiswa.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menyetujui pengajuan');
                document.location.href = 'mahasiswa.php';
            </script>";
        }
    } elseif ($action === 'reject') {
        if (updateStatus($id, 'ditolak')) {
            echo "<script>
                alert('Pengajuan berhasil ditolak');
                document.location.href = 'mahasiswa.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menolak pengajuan');
                document.location.href = 'mahasiswa.php';
            </script>";
        }
    }
}

$mahasiswa = query('SELECT *FROM mahasiswa INNER JOIN users ON mahasiswa.nim_id = users.id');
$cek = query("SELECT COUNT(*) AS jumlah
                FROM mahasiswa");
$cek1 = $cek[0]['jumlah'] > 0;
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>List Mahasiswa</h1>
        <a href="../kaprodi/expdf.php" class="btn btn-primary"><i class="fas fa-file-pdf"></i>Cetak</a>
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
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Judul</th>
                                    <th style="width: 150">Aksi</th>
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
                                    <td>
                                        <?php if ($row['pengajuan'] === 'disetujui'): ?>
                                        <span class="badge badge-success">Disetujui</span>
                                        <?php elseif ($row['pengajuan'] === 'ditolak'): ?>
                                        <span class="badge badge-danger">Ditolak</span>
                                        <?php else: ?>
                                        <a class="btn btn-sm btn-info mb-md-0 mb-1"
                                            href="mahasiswa.php?action=approve&nim_id=<?= $row['nim_id'] ?>">
                                            <i class="fas fa-check-square"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger"
                                            href="mahasiswa.php?action=reject&nim_id=<?= $row['nim_id'] ?>">
                                            <i class="fas fa-window-close"></i>
                                        </a>
                                        <?php endif; ?>
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
