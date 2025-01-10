<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php'; // File koneksi database

// Cek apakah pengguna memiliki akses
if (!isset($_SESSION['role']) || !isset($_SESSION['id'])) {
    header('Location: ../template/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['nilai_p'])) {
    $nim_id = $_SESSION['id'];
    $file = $_FILES['nilai_p'];

    uploadProposal($nim_id, $file);
}

function uploadProposal($nim_id, $file)
{
    global $conn; // Gunakan koneksi database

    // Validasi file
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengunggah file.</div>";
        return;
    }

    // Periksa ekstensi file
    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "<div class='alert alert-danger'>Hanya file dengan ekstensi PDF, DOC, atau DOCX yang diperbolehkan.</div>";
        return;
    }

    // Simpan file ke folder tertentu menggunakan nama asli
    $uploadDir = '../assets/proposals/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
    }

    $uploadPath = $uploadDir . basename($file['name']); // Menggunakan nama asli file

    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        echo "<div class='alert alert-danger'>Gagal memindahkan file yang diunggah.</div>";
        return;
    }

    // Masukkan data ke database
    $nilai = basename($file['name']);
    $query = "INSERT INTO nilai (nim_id, nilai_p) VALUES ('$nim_id', '$nilai')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Berhasil Upload File');
                document.location.href = 'nilai_proposal.php';
            </script>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat menyimpan data ke database.</div>";
    }
}
?>

<section class="section">
    <div class="section-header">
        <h1>Upload Proposal</h1>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <!-- nim_id diambil otomatis dari session -->
            <input type="hidden" name="nim_id" value="<?= $_SESSION['id'] ?>">
        </div>
        <div class="form-group">
            <label for="nilai_p">Pilih File</label>
            <input type="file" name="nilai_p" id="nilai_p" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
