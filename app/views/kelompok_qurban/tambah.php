<!-- File: views/kelompok_qurban/tambah.php -->
<div class="container">
    <h2><?= $data['judul']; ?></h2>
    <form action="<?= BASEURL; ?>/KelompokQurban/aksi_tambah" method="POST">
	 <div class="form-group">
            <label for="tahun">Nama Kelompok</label>
            <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" value="" required>
        </div>
        <div class="form-group">
            <label for="jenis_hewan">Jenis Hewan</label>
            <select class="form-control" id="jenis_hewan" name="jenis_hewan">
                <option value="kambing">Kambing</option>
                <option value="sapi">Sapi</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="<?= date('Y'); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
