<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php'; // File koneksi database

// Cek apakah pengguna memiliki akses
if (!isset($_SESSION['role'])) {
    header("Location: ../template/index.php");
    exit;
}

$role = $_SESSION['role'];
$nim_id = $_SESSION['id'];

if ($role === 'Admin') {
    $query = "SELECT * FROM proposal"; // Query untuk admin
} else {
    $query = "SELECT * FROM proposal WHERE nim_id = '$nim_id'";
}
$result = mysqli_query($conn, $query);

$proposals = [];
if ($result && mysqli_num_rows($result) > 0) {
    $proposals = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$hasProposal = count($proposals) > 0;
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Proposal</h1>
        <?php if ($role !== 'Admin' && !$hasProposal): ?>
        <a href="upload.php" class="btn btn-primary">Upload Proposal</a>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($proposals)): ?>
                        <?php foreach ($proposals as $pp): ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header d-flex justify-content-between">
                                            <a href="../assets/proposals/<?= $pp['proposal_mhs']; ?>" target="_blank">
                                                Open
                                            </a>
                                            <a class="btn btn-sm btn-info mr-10" 
                                               href="edit_proposal.php?id=<?= ($pp['id']); ?>">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h4><?= ($pp['proposal_mhs']); ?></h4>
                                            <p><strong>Pengguna:</strong> <?= $pp['nim_id']; ?></p>
                                        </div>
                                        <div class="card-footer">
                                            <p><?= ($pp['catatan']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center">
                            <p>Belum ada proposal yang diunggah.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
