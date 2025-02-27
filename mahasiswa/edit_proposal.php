<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (!isset($_SESSION['role'])) {
    header("Location: ../template/index.php");
    exit;
}

if (isset($_GET['penentuan_id'])) {
    $penentuan_id = $_GET['penentuan_id'];

    // Ambil data penentuan untuk penentuan_id
    $penentuan = query("SELECT * FROM penentuan WHERE id = '$penentuan_id'");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lap_mhs_file = $_FILES['lap_mhs'];

        // Jika file diunggah
        if ($lap_mhs_file['error'] === UPLOAD_ERR_OK) {
            // Validasi file
            $allowedExtensions = ['pdf', 'doc', 'docx'];
            $fileExtension = strtolower(pathinfo($lap_mhs_file['name'], PATHINFO_EXTENSION));

            if (!in_array($fileExtension, $allowedExtensions)) {
                echo "<script>alert('Hanya file dengan ekstensi PDF, DOC, atau DOCX yang diperbolehkan.');</script>";
            } else {
                // Simpan file
                $uploadDir = '../assets/proposals/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
                }

                // Validasi jika file dengan nama sama sudah ada
                $fileName = basename($lap_mhs_file['name']);
                $uploadPath = $uploadDir . $fileName;

                // Hapus file lama jika ada
                if (!empty($penentuan[0]['lap_mhs']) && file_exists($uploadDir . $penentuan[0]['lap_mhs'])) {
                    unlink($uploadDir . $penentuan[0]['lap_mhs']);
                }

                if (move_uploaded_file($lap_mhs_file['tmp_name'], $uploadPath)) {
                    // Update `lap_mhs` di database
                    $updatequery = "UPDATE penentuan SET lap_mhs = '$fileName' WHERE id = '$penentuan_id'";

                    if (mysqli_query($conn, $updatequery)) {
                        echo "<script>
                                alert('Laporan berhasil diunggah');
                                window.location.href = '../mahasiswa/proposal.php';
                              </script>";
                        exit;
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database.');</script>";
                    }
                } else {
                    echo "<script>alert('Gagal menyimpan file yang diunggah.');</script>";
                }
            }
        } else {
            echo "<script>alert('Tidak ada file yang diunggah atau terjadi kesalahan.');</script>";
        }
    }
} else {
    echo "Data tidak ditemukan.";
    exit;
}

?>

<section class="section">
    <div class="section-header">
        <h1>Upload Laporan Bimbingan</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="lap_mhs">Upload Laporan</label>
                            <input type="file" name="lap_mhs" id="lap_mhs" class="form-control" required>
                            <small>Hanya file PDF, DOC, atau DOCX yang diperbolehkan.</small>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
