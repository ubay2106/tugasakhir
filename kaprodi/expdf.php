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
            width: 100px;
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
            <h1>LAPORAN PESERTA</h1>
            <h2>TUGAS AKHIR</h2>
        </div>
        <table>
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
