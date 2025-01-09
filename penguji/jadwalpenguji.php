<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../template/index.php");
    exit;
}

if ($_SESSION['role'] === 'Admin') {
    $penentuan = query(
        "SELECT 
            penentuan.id AS penentuan_id,
            users1.nim AS nim,
            mahasiswa.nama AS mahasiswa_nama,
            mahasiswa.judul AS judul,
            users3.nidn AS nidn_penguji,
            dosen2.nama AS dosen_penguji,
            penentuan.jadwal_uji
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id;"
    );
} elseif ($_SESSION['role'] === 'Penguji') {
    $nidn = mysqli_real_escape_string($conn, $_SESSION['nidn']);
    $penentuan = query(
        "SELECT 
            penentuan.id AS penentuan_id,
            users1.nim AS nim,
            mahasiswa.nama AS mahasiswa_nama,
            mahasiswa.judul AS judul,
            users3.nidn AS nidn_penguji,
            dosen2.nama AS dosen_penguji,
            penentuan.jadwal_uji
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id
        WHERE users3.nidn = '$nidn';"
    );
} else {
    header("Location: ../template/index.php");
    exit;
}
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Sidang</h1>
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
                                    <th>NIDN Penguji</th>
                                    <th>Dosen Penguji</th>
                                    <th>Jadwal Sidang</th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach ($penentuan as $row): ?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $i ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['mahasiswa_nama'] ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['nidn_penguji'] ?></td>
                                    <td><?= $row['dosen_penguji'] ?></td>
                                    <td>
                                    <?php if ($row['jadwal_uji']): ?>
                                            <span class="badge badge-success"><?= date('d-m-Y', strtotime($row['jadwal_uji'])) ?></span>
                                        <?php else: ?>
                                            <a class="btn btn-sm btn-primary mb-md-0 mb-1" href="edit_penguji.php?penentuan_id=<?= $row['penentuan_id'] ?>">
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
