<?php
require_once '../layout/top.php';
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
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>NIDN</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Jenis Kelamin</th>
                  <th>Status</th>
                  <th style="width: 150">Aksi</th>
                </tr>
              </thead>
              <tbody>
                  <input type="hidden" name="id" value="">
                  <tr class="text-center">
                    <td>1</td>
                    <td>21212</td>
                    <td>Ahmad</td>
                    <td>Aemail</td>
                    <td>Laki-laki</td>
                    <td>Penguji</td>
                    <td>
                      <a class="btn btn-sm btn-danger mb-md-0 mb-1" href="">
                        <i class="fas fa-trash fa-fw"></i>
                      </a>
                      <a class="btn btn-sm btn-info" href="edit_dosen.php">
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
