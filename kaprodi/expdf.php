<?php
session_start();
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

$mahasiswa = query('SELECT *FROM mahasiswa INNER JOIN users ON mahasiswa.nim_id = users.id');
$cek = query("SELECT COUNT(*) AS jumlah
                FROM mahasiswa");
$cek1 = $cek[0]['jumlah'] > 0;
?>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sarjana Komputer</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="../assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/modules/izitoast/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <section class="section">
        <div class="section-header">
            <h1>Laporan Peserta Tugas Akhir</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($cek1)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped w-100" id="table-1" border="1">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Judul</th>
                                        <th style="width: 150">Aksi</th>
                                    </tr>
                                </thead>
                                <?php $i=1; foreach( $mahasiswa as $row):?>
                                <tbody>
                                    <tr class="text-center">
                                        <td><?= $i ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nim'] ?></td>
                                        <td><?= $row['tanggal_lahir'] ?></td>
                                        <td><?= $row['jenis_kelamin'] ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td>
                                            <?php if ($row['pengajuan'] === 'disetujui'): ?>
                                            Disetujui
                                            <?php elseif ($row['pengajuan'] === 'ditolak'): ?>
                                            Ditolak
                                            <?php else: ?> ($row['pengajuan'] === 'pending'): ?>
                                            Pending
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php $i++; endforeach; ?>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="text-center">
                            <p>Belum ada data</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </section>
</body>
<script>
    window.print();
</script>
