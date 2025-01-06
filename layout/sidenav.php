<?php


if(!isset($_SESSION['role'])){
  header("Location: ../auth/login.php");
  exit;
}
?>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php">
                <img src="../assets/img/avatar/sarjana.png" alt="logo" width="170">
            </a>
        </div>
        <ul class="sidebar-menu mt-3">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="../home/index.php"><i class="fas fa-fire"></i> <span>Home</span></a></li>
            
            <!-- Show only for 'kaprodi' or 'admin' -->
            <?php if ($_SESSION['role'] == 'Kaprodi' || $_SESSION['role'] == 'admin'): ?>
                <li class="menu-header">Main Feature</li>
                <li><a class="nav-link" href="../kaprodi/akun.php"><i class="fas fa-bars"></i> <span>Management akun</span></a></li>
                <li><a class="nav-link" href="../kaprodi/dosen.php"><i class="fas fa-users"></i> <span>List Dosen</span></a></li>
                <li><a class="nav-link" href="../kaprodi/mahasiswa.php"><i class="fas fa-user-graduate"></i> <span>Data Mahasiswa</span></a></li>
            <?php endif; ?>

            <!-- Show only for 'pembimbing' or 'admin' -->
            <?php if ($_SESSION['role'] == 'Pembimbing' || $_SESSION['role'] == 'admin'): ?>
                <li class="menu-header">Main Feature</li>
                <li><a class="nav-link" href="../pembimbing/jadwalpembimbing.php"><i class="fas fa-calendar-plus"></i> <span>Jadwal Bimbingan</span></a></li>
                <li><a class="nav-link" href="../pembimbing/proposal.php"><i class="fas fa-book-open"></i> <span>Proposal</span></a></li>
                <li><a class="nav-link" href="../pembimbing/nilai_proposal.php"><i class="fas fa-graduation-cap"></i> <span>Nilai</span></a></li>
            <?php endif; ?>

            <!-- Show only for 'penguji' or 'admin' -->
            <?php if ($_SESSION['role'] == 'Penguji' || $_SESSION['role'] == 'admin'): ?>
                <li class="menu-header">Main Feature</li>
                <li><a class="nav-link" href="../penguji/jadwalpenguji.php"><i class="fas fa-calendar-plus"></i> <span>Jadwal Sidang</span></a></li>
                <li><a class="nav-link" href="../penguji/nilai_sidang.php"><i class="fas fa-graduation-cap"></i> <span>Nilai</span></a></li>
            <?php endif; ?>

            <!-- Show only for 'mahasiswa' -->
            <?php if ($_SESSION['role'] == 'Mahasiswa'): ?>
                <li class="menu-header">Main Feature</li>
                <li><a class="nav-link" href="../mahasiswa/mahasiswa.php"><i class="fas fa-chalkboard"></i> <span>Tugas Akhir</span></a></li>
                <li><a class="nav-link" href="../mahasiswa/jadwal.php"><i class="fas fa-calendar"></i> <span>Jadwal Proposal Dan Sidang</span></a></li>
                <li><a class="nav-link" href="../mahasiswa/proposal.php"><i class="fas fa-book"></i> <span>Proposal</span></a></li>
                <li><a class="nav-link" href="../mahasiswa/nilai.php"><i class="fas fa-graduation-cap"></i> <span>Nilai</span></a></li>
            <?php endif; ?>
        </ul>
    </aside>
</div>
