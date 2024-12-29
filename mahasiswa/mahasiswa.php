<?php
require_once '../layout/top.php';
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Mahasiswa</h1>
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
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Pengajuan</th>
                                    <th style="width: 150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="id" value="">
                                <tr class="text-center">
                                    <td>1</td>
                                    <td>21212</td>
                                    <td>Ahmad</td>
                                    <td>Laki-laki</td>
                                    <td>Sudah</td>
                                    <td>
                                        <a class="btn btn-sm btn-info mb-md-0 mb-1" href="edit_mahasiswa.php">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
