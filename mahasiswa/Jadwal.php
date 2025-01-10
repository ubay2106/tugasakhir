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
            users3.nidn AS nidn_penguji,
            dosen2.nama AS dosen_penguji,
            penentuan.jadwal_bim,
            penentuan.lap_jadbim,
            penentuan.lap_jaduji,
            penentuan.jadwal_uji
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id;"
    );
} elseif ($_SESSION['role'] === 'Mahasiswa') {
    // Jika pembimbing, ambil data sesuai nidn yang login
    $nim = mysqli_real_escape_string($conn, $_SESSION['nim']);
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
            penentuan.jadwal_bim,
            penentuan.lap_jadbim,
            penentuan.lap_jaduji,
            penentuan.jadwal_uji
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id
        WHERE users1.nim = '$nim';"
    );
    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan 
    WHERE nim_id = (SELECT id FROM users WHERE nim = '$nim')");
    $tugas = ($cek[0]['jumlah'] > 0);
} else {
    // Jika bukan admin atau pembimbing, redirect
    header("Location: ../template/index.php");
    exit;
}


?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Informasi Tugas Akhir</h1>
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
                                    <th>NIDN Pembimbing</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Jadwal Bimbingan</th>
                                    <th>Laporan Jadwal Bimbingan</th>
                                    <th>NIDN Penguji</th>
                                    <th>Dosen Penguji</th>
                                    <th>Jadwal Sidang</th>
                                    <th>Laporan Jadwal Sidang</th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach ($penentuan as $row): ?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nidn_pembimbing'] ?></td>
                                    <td><?= $row['dosen_pembimbing'] ?></td>
                                    <td>
                                    <?php if ($row['jadwal_bim']): ?>
                                            <span class="badge "><?= date('d-m-Y', strtotime($row['jadwal_bim'])) ?></span>
                                        <?php else: ?>
                                            <span class="badge ">Pending</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                    <?php if ($row['lap_jadbim']): ?>
                                            <span class="badge badge-success"><a class="text-white" href="../assets/proposals/<?= $row['lap_jadbim']; ?>" target="_blank">
                                                Open
                                            </a></span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['nidn_penguji'] ?></td>
                                    <td><?= $row['dosen_penguji'] ?></td>
                                    <td>
                                    <?php if ($row['jadwal_uji']): ?>
                                            <span class="badge "><?= date('d-m-Y', strtotime($row['jadwal_uji'])) ?></span>
                                        <?php else: ?>
                                            <span class="badge ">Pending</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                    <?php if ($row['lap_jaduji']): ?>
                                            <span class="badge badge-success"><a class="text-white" href="../assets/proposals/<?= $row['lap_jaduji']; ?>" target="_blank">
                                                Open
                                            </a></span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Pending</span>
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
