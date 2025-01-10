<?php
session_start();
require_once '../layout/top.php';
require '../database/koneksi.php';

if (isset($_POST['submit'])) {
    if (changeUser($_POST) > 0) {
        echo "
            <script>
                alert('SUKSES GANTI PASSWORD');
                document.location.href = '../home/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('GAGAL GANTI PASSWORD');
                document.location.href = 'password.php';
            </script>
        ";
    }
}

?>


<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Ganti Password</h1>
    </div>
    <form method="POST" action="">
        <div class="form-group">
            <input type="hidden" name="nim" value="<?= $_SESSION['nim'] ?>">
        </div>
        <div class="form-group">
            <input type="hidden" name="role" value="<?= $_SESSION['role'] ?>">
        </div>
        <div class="form-group">
            <label>Password Lama</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Password Baru:</label>
            <input class="form-control" type="password" name="new_password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Ganti Password</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
