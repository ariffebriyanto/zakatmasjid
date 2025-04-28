<div class="container mt-4">
  <h3>Edit Qurban</h3>
  <form action="<?= BASEURL; ?>/Qurban/aksi_update" method="post">
    <input type="hidden" name="id" value="<?= $data['qurban']['id']; ?>">
    
    <div class="mb-3">
      <label for="kelompok_id" class="form-label">Kelompok Qurban</label>
      <select class="form-control" id="kelompok_id" name="kelompok_id" disabled>
        <option value="">Pilih Kelompok Qurban</option>
        <?php foreach ($data['kelompok_qurban'] as $kelompok): ?>
          <option value="<?= $kelompok['id']; ?>" <?= ($kelompok['id'] == $data['qurban']['kelompok_id']) ? 'selected' : ''; ?>>
            <?= $kelompok['jenis_hewan']; ?> - Tahun: <?= $kelompok['tahun']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
 <!-- Hidden input agar tetap dikirim -->
      <input type="hidden" name="kelompok_id" value="<?= $data['qurban']['kelompok_id']; ?>">
    <div class="mb-3">
      <label for="donatur_id" class="form-label">Donatur</label>
      <select class="form-control" id="donatur_id" name="donatur_id" required>
        <option value="">Pilih Donatur</option>
        <?php foreach ($data['donatur'] as $donatur): ?>
          <option value="<?= $donatur['id']; ?>" <?= ($donatur['id'] == $data['qurban']['donatur_id']) ? 'selected' : ''; ?>>
            <?= $donatur['nama']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="jenis_hewan" class="form-label">Jenis Hewan</label>
      <select class="form-control" id="jenis_hewan" name="jenis_hewan" disabled>
        <option value="kambing" <?= ($data['qurban']['jenis_hewan'] == 'kambing') ? 'selected' : ''; ?>>Kambing</option>
        <option value="sapi" <?= ($data['qurban']['jenis_hewan'] == 'sapi') ? 'selected' : ''; ?>>Sapi</option>
      </select>
    </div>
      <input type="hidden" name="jenis_hewan" value="<?= $data['qurban']['jenis_hewan']; ?>">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= BASEURL; ?>/Qurban" class="btn btn-secondary">Batal</a>
  </form>
</div>
