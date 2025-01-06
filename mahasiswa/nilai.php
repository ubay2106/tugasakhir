<?php
session_start();
require_once '../layout/top.php';


if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Laporan Nilai</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Nilai Proposal</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Nilai Sidang</h4>
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
