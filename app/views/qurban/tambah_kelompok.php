<div class="container">
    <h2>Tambah Kelompok Qurban</h2>
    <form action="<?= URLROOT ?>/qurban/tambahKelompok" method="POST">
        <div class="form-group">
            <label for="jenis_hewan">Jenis Hewan</label>
            <input type="text" name="jenis_hewan" class="form-control" value="<?= isset($data['jenis_hewan']) ? $data['jenis_hewan'] : '' ?>" required>
            <span class="text-danger"><?= $data['jenis_hewan_err'] ?? '' ?></span>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= isset($data['keterangan']) ? $data['keterangan'] : '' ?></textarea>
            <span class="text-danger"><?= $data['keterangan_err'] ?? '' ?></span>
        </div>
        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Kelompok</button>
    </form>
</div>
