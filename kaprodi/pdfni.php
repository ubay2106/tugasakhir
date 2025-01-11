<?php
session_start();
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header('Location: ../template/index.php');
    exit();
}

// Cek role dari sesi login
if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Kaprodi') {
    // Jika admin, ambil semua data penentuan
    $penentuan = query(
        "SELECT 
            penentuan.id AS penentuan_id,
            users1.nim AS nim,
            mahasiswa.nama AS mahasiswa_nama,
            mahasiswa.judul AS judul,
            users2.nidn AS nidn_pembimbing,
            dosen1.nama AS dosen_pembimbing,
            users3.nidn AS nidn_penguji,
            dosen2.nama AS dosen_penguji,
            penentuan.nilai_p,
            penentuan.nilai_s
        FROM 
            penentuan
        INNER JOIN users AS users1 ON penentuan.nim_id = users1.id
        INNER JOIN mahasiswa ON penentuan.mahasiswa_id = mahasiswa.id
        INNER JOIN users AS users2 ON penentuan.nidn_idbim = users2.id
        INNER JOIN dosen AS dosen1 ON penentuan.pembimbing_id = dosen1.id
        INNER JOIN users AS users3 ON penentuan.nidn_iduji = users3.id
        INNER JOIN dosen AS dosen2 ON penentuan.penguji_id = dosen2.id;",
    );
    $cek = query("SELECT COUNT(*) AS jumlah
    FROM penentuan");
    $tugas = $cek[0]['jumlah'] > 0;

} else {
    // Jika bukan admin atau pembimbing, redirect
    header('Location: ../template/index.php');
    exit();
}
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
            <h1>Laporan Nilai Tugas Akhir</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($tugas)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped w-100" id="table-1" border="1">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Mahasiswa</th>
                                        <th>NIDN Pembimbing</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Nilai Proposal</th>
                                        <th>NIDN Penguji</th>
                                        <th>Dosen Penguji</th>
                                        <th>Nilai Sidang</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; foreach ($penentuan as $row): ?>
                                <tbody>
                                    <tr class="text-center">
                                        <td><?= $i ?></td>
                                        <td><?= $row['nim'] ?></td>
                                        <td><?= $row['mahasiswa_nama'] ?></td>
                                        <td><?= $row['nidn_pembimbing'] ?></td>
                                        <td><?= $row['dosen_pembimbing'] ?></td>
                                        <td>
                                        <?php if ($row['nilai_p']): ?>
                                            <span class="badge "><?= $row['nilai_'] ?></span>
                                        <?php else: ?>
                                            <span class="badge ">Pending</span>
                                        <?php endif; ?>

                                        </td>
                                        <td><?= $row['nidn_penguji'] ?></td>
                                        <td><?= $row['dosen_penguji'] ?></td>
                                        <td>
                                        <?php if ($row['nilai_s']): ?>
                                            <span class="badge "><?= $row['nilai_s'] ?></span>
                                        <?php else: ?>
                                            <span class="badge ">Pending</span>
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
