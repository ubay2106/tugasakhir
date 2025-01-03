<?php
require_once '../layout/top.php';

?>

<section class="section">
  <div class="section-header">
    <h1>Edit Dosen</h1>
  </div>
  <form action="" method="POST">
  <div class="form-group">
      <label for="name">NIDN</label>
      <input type="text" class="form-control" id="nidn" name="nidn" required>
    </div>
    <div class="form-group">
      <label for="name">Nama Dosen</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="name">Email</label>
      <input type="email" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="gender">Jenis Kelamin</label>
      <select class="form-control" id="gender" name="gender" required>
      <option value="" disabled selected>Pilih Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
    <div class="form-group">
      <label for="status">Status</label>
      <select class="form-control" id="status" name="status" required>
      <option value="" disabled selected>Pilih Status</option>
        <option value="Laki-laki">Pembimbing</option>
        <option value="Perempuan">Penguji</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</section>

<?php
require_once '../layout/bottom.php';
?>