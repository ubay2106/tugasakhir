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
        <h1>Nilai Proposal</h1>
        <a href="tambah_nilaiproposal.php" class="btn btn-primary">Upload Nilai Proposal </a>
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
                                    <a class="btn btn-sm btn-info mr-10" href="edit_nilaiproposal.php">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
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
