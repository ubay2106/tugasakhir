<?php
require_once '../layout/top.php';
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Jadwal Sidang</h1>
        <a href="upload_penguji.php" class="btn btn-primary">Upload Jadwal Sidang</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Jadwal</h4>
                                </div>
                                <div class="card-body d-flex justify-content-between">
                                    <h4>Nama</h4>
                                    <a class="btn btn-sm btn-info mr-10" href="edit_penguji.php">
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