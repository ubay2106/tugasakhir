<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

$dosen = query('SELECT 
                    dosen.nidn_id AS dosen_nidn_id, 
                    dosen.nama AS dosen_nama, 
                    dosen.jenis_kelamin AS dosen_jk, 
                    dosen.id AS dosen_id, 
                    users.nidn AS nidn, 
                    dosen.status AS status
                FROM dosen
                INNER JOIN users ON dosen.nidn_id = users.id');


$cek = query("SELECT COUNT(*) AS jumlah
                FROM dosen");
$cek1 = $cek[0]['jumlah'] > 0;

if (isset($_GET['id'])) {
    $hapus_id = intval($_GET['id']); // Validasi agar ID hanya angka

    // Nonaktifkan foreign key check
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");

    // Hapus data dari tabel dosen
    $delete_query = "DELETE FROM dosen WHERE id = '$hapus_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>
                alert('Data dosen berhasil dihapus');
                window.location.href = 'dosen.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data.');
              </script>";
    }

    // Aktifkan kembali foreign key check
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
}


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
                                    <td><?= $row['dosen_nama'] ?></td>
                                    <td><?= $row['dosen_jk'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" href="dosen.php?id=<?= $row['dosen_id'] ?>">
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
