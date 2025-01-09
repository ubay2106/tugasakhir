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
        // Ambil tanggal dari form
        $jadwal_bim = mysqli_real_escape_string($conn, $_POST['jadwal_bim']);
        
        // Update tabel penentuan dengan jadwal_bim
        $updatequery = "UPDATE penentuan SET jadwal_bim = '$jadwal_bim' WHERE id = '$penentuan_id'";
        
        if (mysqli_query($conn, $updatequery)) {
            // Jika update berhasil, tampilkan alert dan redirect
            echo "<script>
                    alert('Jadwal berhasil ditambahkan');
                    window.location.href = '../pembimbing/jadwalpembimbing.php';
                  </script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Data tidak ditemukan.";
    exit;
}

?>

<section class="section">
    <div class="section-header">
        <h1>Edit Jadwal Bimbingan</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="jadwal_bim">Tanggal Bimbingan</label>
                            <input type="date" name="jadwal_bim" id="jadwal_bim" class="form-control" required value="<?= $penentuan[0]['jadwal_bim'] ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../layout/bottom.php';
?>
