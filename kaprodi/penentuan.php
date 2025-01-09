<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}

?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Management Data</h1>
        <a href="../kaprodi/form_penentuan.php" class="btn btn-primary">Manage</a>
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
                                    <th>NIDN Penguji</th>
                                    <th>Dosen Penguji</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
