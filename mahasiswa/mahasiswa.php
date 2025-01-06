<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}

$mahasiswa = query('SELECT *FROM mahasiswa');
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Data Peserta</h1>
        <a href="../mahasiswa/tambah_mahasiswa.php" class="btn btn-primary">Daftar Tugas Akhir</a>
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
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Pengajuan</th>
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
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['pengajuan'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info mb-md-0 mb-1" href="edit_mahasiswa.php">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
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