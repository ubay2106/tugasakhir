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
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id;",
    );
    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan");
    $nilai = $cek[0]['jumlah'] > 0;
} elseif ($_SESSION['role'] === 'Mahasiswa') {
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
            penentuan.nilai_p,
            penentuan.nilai_s
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id
        WHERE users1.nim = '$nim';",
    );
    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan 
    WHERE nim_id = (SELECT id FROM users WHERE nim = '$nim')");
    $nilai = $cek[0]['jumlah'] > 0;
} else {
    // Jika bukan admin atau pembimbing, redirect
    header('Location: ../template/index.php');
    exit();
}

?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Nilai</h1>
    </div>
    <div class="car-body">
        <?php if (!empty($nilai)): ?>
        <div class="row">
            <?php foreach ($penentuan as $row): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Nilai Proposal</h4>
                            <h4><?= $row['mahasiswa_nama'] ?></h4>
                        </div>
                        <div class="card-body d-flex">
                            <div class="mr-5"><?= $row['nilai_p'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <?php foreach ($penentuan as $row): ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Nilai Sidang</h4>
                            <h4><?= $row['mahasiswa_nama'] ?></h4>
                        </div>
                        <div class="card-body d-flex">
                            <div class="mr-5"><?= $row['nilai_s'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center">
            <p>Belum ada nilai</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
