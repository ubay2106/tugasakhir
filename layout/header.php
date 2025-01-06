<?php

if (!isset($_SESSION['username'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<div class="navbar-bg">
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class=""></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class=""></i></a>
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
                <div class="d-sm-none d-lg-inline-block">Hi,</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <form action="../auth/logout.php" method="POST">
                    <button type="submit" name="logout" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
