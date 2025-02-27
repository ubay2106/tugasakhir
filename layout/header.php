<?php
if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

?>

<div class="navbar-bg">
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class=""></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                            class=""></i></a>
                </li>
            </ul>
        </form>
        <div class="marquee-container">
            <marquee class="marquee-message">Selamat datang</marquee>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <form action="../auth/logout.php" method="POST">
                        <?php if ($_SESSION['role'] === 'Admin'):?>
                        <a class="dropdown-item has-icon text-danger" href="../auth/register.php"><i
                                class="fas fa-user"></i>Register</a>
                        <?php endif; ?>
                        <?php if ($_SESSION['role'] === 'Mahasiswa'):?>
                        <a class="dropdown-item has-icon text-danger" href="../auth/password_user.php"><i
                                class="fas fa-key"></i>Ganti Password</a>
                        <?php else: ?>
                        <a class="dropdown-item has-icon text-danger" href="../auth/password.php"><i
                                class="fas fa-key"></i>Ganti Password</a>
                        <?php endif; ?>
                        <button type="submit" name="logout" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
