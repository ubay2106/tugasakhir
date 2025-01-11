<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../template/index.php");
    exit;
}

// Cek role dari sesi login
if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Kaprodi') {
    // Jika admin, ambil semua data penentuan
    $penentuan = query(
        "SELECT 
            penentuan.id AS penentuan_id,
            users1.nim AS nim,
            mahasiswa.nama AS mahasiswa_nama,
            mahasiswa.judul AS judul,
            users2.nidn AS nidn_pembimbing,
            dosen1.nama AS dosen_pembimbing,
            users3.nidn AS nidn_penguji,
            dosen2.nama AS dosen_penguji,
            penentuan.nilai_p,
            penentuan.nilai_s
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id;"
    );
    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan");
    $tugas = $cek[0]['jumlah'] > 0;
} else {
    // Jika bukan admin atau pembimbing, redirect
    header("Location: ../template/index.php");
    exit;
}


?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Nilai Proposal Dan Sidang</h1>
        <a href="../kaprodi/pdfni.php" class="btn btn-primary"><i class="fas fa-file-pdf"></i>Cetak</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <?php if (!empty($tugas)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped w-100" id="table-1">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Mahasiswa</th>
                                    <th>NIDN Pembimbing</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Nilai Proposal</th>
                                    <th>NIDN Penguji</th>
                                    <th>Dosen Penguji</th>
                                    <th>Nilai Sidang</th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach ($penentuan as $row): ?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['mahasiswa_nama'] ?></td>
                                    <td><?= $row['nidn_pembimbing'] ?></td>
                                    <td><?= $row['dosen_pembimbing'] ?></td>
                                    <td>
                                    <?php if ($row['nilai_p']): ?>
                                            <span class="badge "><?= $row['nilai_p'] ?></span>
                                        <?php else: ?>
                                            <span class="badge ">Pending</span>
                                        <?php endif; ?>

                                    </td>
                                    <td><?= $row['nidn_penguji'] ?></td>
                                    <td><?= $row['dosen_penguji'] ?></td>
                                    <td>
                                    <?php if ($row['nilai_s']): ?>
                                            <span class="badge "><?= $row['nilai_s'] ?></span>
                                        <?php else: ?>
                                            <span class="badge ">Pending</span>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            </tbody>
                            <?php $i++; endforeach; ?>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                        <div class="text-center">
                            <p>Data belum tersedia silahkan tunggu</p>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
