<?php
require_once '../layout/top.php';
?>

<section class="section">
    <div class="section-header">
        <h1>Upload Proposal</h1>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fileUpload">Pilih File</label>
            <input type="file" name="fileUpload" id="fileUpload" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</section>

<?php
require_once '../layout/bottom.php';
?>
