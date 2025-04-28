
<!-- Your form -->
<div class="container mt-4">
  <h3>Tambah Qurban</h3>
  <form action="<?= BASEURL; ?>/Qurban/aksi_tambah" method="post">
    <!-- Hidden input kelompok ID -->
    <input type="hidden" name="kelompok_id" value="<?= $data['kelompok']['id']; ?>">

    <div class="mb-3">
      <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
      <select class="form-control" id="jenis_hewan_display" disabled>
        <option value="kambing" <?= $data['kelompok']['jenis_hewan'] == 'kambing' ? 'selected' : '' ?>>Kambing</option>
        <option value="sapi" <?= $data['kelompok']['jenis_hewan'] == 'sapi' ? 'selected' : '' ?>>Sapi</option>
      </select>
      <!-- Hidden input agar tetap dikirim -->
      <input type="hidden" name="jenis_hewan" value="<?= $data['kelompok']['jenis_hewan']; ?>">
    </div>
	

    <div class="mb-3">
      <label for="donatur_id" class="form-label">Donatur</label>
	  <input type="text" id="searchInput" placeholder="Search...">
      <select class="form-control" id="donatur_id" name="donatur_id" required>
        <option value="">Pilih Donatur</option>
        <?php foreach ($data['donatur'] as $donatur): ?>
          <option value="<?= $donatur['id']; ?>"><?= $donatur['nama']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= BASEURL; ?>/KelompokQurban" class="btn btn-secondary">Batal</a>
  </form>
</div>
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
  var filter = this.value.toUpperCase();
  var select = document.getElementById('donatur_id');
  var options = select.options;
  for (var i = 0; i < options.length; i++) {
    var txtValue = options[i].textContent || options[i].innerText;
    options[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? '' : 'none';
  }
});
</script>

