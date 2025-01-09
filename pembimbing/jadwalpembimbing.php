<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../template/index.php");
    exit;
}

// Cek role dari sesi login
if ($_SESSION['role'] === 'Admin') {
    // Jika admin, ambil semua data penentuan
    $penentuan = query(
        "SELECT 
            penentuan.id AS penentuan_id,
            users1.nim AS nim,
            mahasiswa.nama AS mahasiswa_nama,
            mahasiswa.judul AS judul,
            users2.nidn AS nidn_pembimbing,
            dosen1.nama AS dosen_pembimbing,
            penentuan.jadwal_bim
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id;"
    );
} elseif ($_SESSION['role'] === 'Pembimbing') {
    $nidn = mysqli_real_escape_string($conn, $_SESSION['nidn']);
    $penentuan = query(
        "SELECT 
            penentuan.id AS penentuan_id,
            users1.nim AS nim,
            mahasiswa.nama AS mahasiswa_nama,
            mahasiswa.judul AS judul,
            users2.nidn AS nidn_pembimbing,
            dosen1.nama AS dosen_pembimbing,
            penentuan.jadwal_bim
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        WHERE users2.nidn = '$nidn';"
    );
} else {
    // Jika bukan admin atau pembimbing, redirect
    header("Location: ../template/index.php");
    exit;
}
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Bimbingan</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                                    <th>Jadwal Bimbingan</th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach ($penentuan as $row): ?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['mahasiswa_nama'] ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['nidn_pembimbing'] ?></td>
                                    <td><?= $row['dosen_pembimbing'] ?></td>
                                    <td>
                                    <?php if ($row['jadwal_bim']): ?>
                                            <span class="badge badge-success"><?= date('d-m-Y', strtotime($row['jadwal_bim'])) ?></span>
                                        <?php else: ?>
                                            <a class="btn btn-sm btn-primary mb-md-0 mb-1" href="edit.php?penentuan_id=<?= $row['penentuan_id'] ?>">
                                                <i class="fas fa-calendar-plus fa-fw"></i>
                                            </a>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            </tbody>
                            <?php $i++; endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
