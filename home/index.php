<?php
session_start();

if(!isset($_SESSION['role'])){
  header("Location: ../auth/login.php");
  exit;
}

require_once '../layout/top.php';
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
              99
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
              99
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
              99
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