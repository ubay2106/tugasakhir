<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
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
            penentuan.catatan,
            penentuan.lap_mhs
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id;",
    );
    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan ");
    $cek1 = $cek[0]['jumlah'] > 0;

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
            penentuan.catatan,
            penentuan.lap_mhs
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        WHERE users2.nidn = '$nidn';",
    );

    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan 
    WHERE nidn_idbim = (SELECT id FROM users WHERE nidn = '$nidn')");
    $cek1 = $cek[0]['jumlah'] > 0;
} else {
    // Jika bukan admin atau pembimbing, redirect
    header('Location: ../template/index.php');
    exit();
}
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Proposal</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($cek1)): ?>
                    <?php foreach ($penentuan as $row): ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4 class="mb-2"><?= $row['mahasiswa_nama'] ?></h4>
                                </div>
                                <div class="card-body">
                                <?php if ($row['lap_mhs']): ?>
                                    <span class="badge badge-success"><a class="text-white"
                                            href="../assets/proposals/<?= $row['lap_mhs'] ?>" target="_blank">
                                            Open
                                        </a></span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Pending</span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer">
                                    <span class="d-flex">Catatan : <?= $row['catatan'] ?></span>
                                    <a class="btn btn-sm btn-primary mb-md-0 mb-1 mt-3"
                                        href="catatan.php?penentuan_id=<?= $row['penentuan_id'] ?>">Catatan
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="text-center">
                        <p>Belum ada proposal yang diunggah.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
