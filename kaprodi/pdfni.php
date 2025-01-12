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

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarjana Komputer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 800px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 80px;
            height: auto;
        }

        .header h1 {
            font-size: 18px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
        }

        .footer .signature {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="../assets/img/avatar/sarjana.png" alt="Logo Universitas">
            <h1>LAPORAN NILAI</h1>
            <h2>PROPOSAL DAN SIDANG</h2>
        </div>
        <table>
            <thead>
                <tr class="text-center">
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
            <?php foreach ($penentuan as $row): ?>
            <tbody>
                <tr class="text-center">
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['mahasiswa_nama'] ?></td>
                    <td><?= $row['nidn_pembimbing'] ?></td>
                    <td><?= $row['dosen_pembimbing'] ?></td>
                    <td>
                        <?php if ($row['nilai_p']): ?>
                        <span class="badge "><?= $row['nilai_p'] ?></span>
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
            <?php endforeach; ?>
        </table>

        <div class="footer">
            <div class="signature">
                <p>Sumenep, <?= date('d F Y') ?></p>
                <p>Mengetahui,</p>
                <p>Kepala Departemen Informatika</p>
                <br><br><br>
                <p><strong>ZEINOR RAHMAN</strong></p>
                <p>NIDN: 0706039601</p>
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>
