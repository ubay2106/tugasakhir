<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sarjana Komputer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="../assets/img/avatar/sarjana.png" alt="logo" width="170">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
            </div>
            <?php if (isset($_SESSION['role'])): ?>
            <a href="../home/index.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Dashboard<i
                    class="fa fa-arrow-right ms-3"></i></a>
            <?php else: ?>
            <a href="../auth/login_user.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Login<i
                    class="fa fa-arrow-right ms-3"></i></a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Welcome</h5>
                                <h1 class="display-3 text-white animated slideInDown">Calon Sarjana Komputer</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Universitas Bahaudin Mudhary Madura</p>
                                <?php if (!isset($_SESSION['role'])): ?>
                                <a href="../auth/register_user.php"
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Register</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">The Best Student</h5>
                                <h1 class="display-3 text-white animated slideInDown">Fortis Fortuna Adiuvat</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Universitas Bahaudin Mudhary Madura</p>
                                <?php if (!isset($_SESSION['role'])): ?>
                                <a href="../auth/register_user.php"
                                    class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Register</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3 h-100">
                        <div class="p-4 h-100">
                            <i class="fa fa-3x fa-upload text-primary mb-4"></i>
                            <h5 class="mb-3">Proposal Submission</h5>
                            <p>Aplikasi ini memungkinkan Anda untuk mengunggah dan mengirimkan proposal skripsi untuk
                                disetujui oleh pihak fakultas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3 h-100">
                        <div class="p-4 h-100">
                            <i class="fa fa-3x fa-users text-primary mb-4"></i>
                            <h5 class="mb-3">Supervisor & Examiner Assignment</h5>
                            <p>Penentuan pembimbing dan penguji untuk skripsi Anda akan dilakukan secara otomatis sesuai
                                dengan bidang keahlian dan ketersediaan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3 h-100">
                        <div class="p-4 h-100">
                            <i class="fa fa-3x fa-book text-primary mb-4"></i>
                            <h5 class="mb-3">Thesis Defense</h5>
                            <p>Konsultasi bimbingan proposal dan persiapan sidang skripsi dengan pembimbing serta
                                penguji dilakukan secara online.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3 h-100">
                        <div class="p-4 h-100">
                            <i class="fa fa-3x fa-star text-primary mb-4"></i>
                            <h5 class="mb-3">Thesis Evaluation</h5>
                            <p>Aplikasi menyediakan penilaian proposal dari pembimbing serta memberikan feedback untuk
                                perbaikan jika diperlukan danterdapat penilaian sidang dari penguji.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/about.jpg" alt=""
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to Sistem Pendaftaran Skripsi</h1>
                    <p class="mb-4">Selamat datang di platform Pendaftaran Skripsi, solusi sistematis untuk membantu
                        mahasiswa dalam mendaftarkan dan menyelesaikan skripsi mereka dengan lebih terstruktur dan
                        efisien. Aplikasi kami dirancang khusus untuk mendukung setiap tahapan pendaftaran dan
                        pengerjaan skripsi, mulai dari pengisian proposal, penentuan pembimbing, hingga persiapan sidang
                        skripsi.</p>
                    <p class="mb-4">Dengan sistem yang terintegrasi, Anda dapat dengan mudah mengajukan proposal,
                        memilih pembimbing, dan mendaftar untuk sidang skripsi melalui platform ini. Dilengkapi dengan
                        fitur bimbingan online, pengingat otomatis, serta akses ke berbagai panduan akademik, aplikasi
                        ini memastikan bahwa seluruh proses berjalan dengan lancar dan tepat waktu.</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Pendaftaran Proposal
                                Skripsi</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Penentuan Pembimbing
                                dan Penguji</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Sidang Skripsi</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Penilaian dan
                                Feedback</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Dokumentasi Skripsi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">The best</h6>
                <h1 class="mb-5">Our Lecturers</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/avatar.png"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Akhmad Tajuddin Tholaby MS S.Kom., M.Kom</h5>
                    <p>Dosen</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Fakultas: Sains dan Teknologi
                            Mata Kuliah: Object Oriented Programming
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/avatar.png"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Zeinor Rahman S.pd., M.pd</h5>
                    <p>Dosen</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Fakultas: Sains dan Teknologi
                            Mata Kuliah: Databases
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/avatar.png"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Desi Anggraini S.Kom., M.Kom</h5>
                    <p>Dosen</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Fakultas: Sains dan Teknologi
                            Mata Kuliah: Design Method
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="img/avatar.png"
                        style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Masdarwiyono S.Kom</h5>
                    <p>Dosen</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">Fakultas: Sains dan Teknologi
                            Mata Kuliah: Web Programming
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="nav-white dropdown col-md-1 text-center text-md-start mb-3 mb-md-3">
                <?php if (isset($_SESSION['role'])): ?>
                <a href="../home/index.php" class="nav-link">Dashboard</a>
                <?php else: ?>
                <a href="../auth/login.php" class="nav-link">Admin</a>
                <?php endif; ?>
            </div>

            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy;
                        Designed By <a class="border-bottom" href="">Kelompok Settong</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
