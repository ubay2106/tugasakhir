<?php
session_start();
require_once '../layout/top.php';


if(!isset($_SESSION['role'])){
  header("Location: ../template/index.php");
  exit;
}

?>
<section class="section">
    <div class="section-header">
        <h1>Edit Nilai Sidang</h1>
    </div>
    <form>
        <div class="form-group">
            <label for="fileUpload">Pilih File</label>
            <input type="file" name="fileUpload" id="fileUpload" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
