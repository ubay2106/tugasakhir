<?php
session_start();

if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}

require_once '../layout/top.php';
// Panggil file koneksi database
require_once '../database/koneksi.php';
require_once '../layout/top.php';

// Query untuk mendapatkan data
$queryDosen = "SELECT COUNT(*) as total FROM dosen";
$resultDosen = mysqli_query($conn, $queryDosen);
$totalDosen = mysqli_fetch_assoc($resultDosen)['total'] ?? 0;

$queryMahasiswa = "SELECT COUNT(*) as total FROM mahasiswa";
$resultMahasiswa = mysqli_query($conn, $queryMahasiswa);
$totalMahasiswa = mysqli_fetch_assoc($resultMahasiswa)['total'] ?? 0;

$queryAkun = "SELECT COUNT(*) as total FROM users";
$resultAkun = mysqli_query($conn, $queryAkun);
$totalAkun = mysqli_fetch_assoc($resultAkun)['total'] ?? 0;
?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="column">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Dosen</h4>
            </div>
            <div class="card-body">
            <?= $totalDosen; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-user-graduate"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Mahasiswa</h4>
            </div>
            <div class="card-body">
           <?= $totalMahasiswa ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Akun</h4>
            </div>
            <div class="card-body">
            <?= $totalAkun ?>
            </div>
          </div>
        </div>
      </div>
      </div>
  </div>
</section>

<?php
require_once '../layout/bottom.php';
?>