<?php
require_once '../layout/top.php';
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Management Akun</h1>
        <a href="../auth/register.php" class="btn btn-primary">Tambah Akun</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Email</h4>
                                    </div>
                                    <div class="card-body">
                                        <h4>Nama</h4>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <a class="btn btn-sm btn-danger mb-md-0 mb-1" href="delete">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </a>
                                        <a class="btn btn-sm btn-info" href="">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                    </div>
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
