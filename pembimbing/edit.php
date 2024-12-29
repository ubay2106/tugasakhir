<?php
require_once '../layout/top.php';

?>
<section class="section">
    <div class="section-header">
        <h1>UPLOAD PROPOSAL</h1>
    </div>
    <form>
        <div class="form-group">
            <label for="fileUpload">Pilih File</label>
            <input type="file" name="fileUpload" id="fileUpload" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name">Catatan</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
