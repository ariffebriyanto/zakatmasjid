<div class="container mt-4">
    <h3>Tambah Peserta</h3>
    <form action="<?= BASEURL; ?>/Donatur/aksi_tambah" method="POST">
        <div class="form-group mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group mb-2">
            <label>Handphone</label>
            <input type="text" name="handphone" class="form-control" required>
        </div>

        <!-- Dropdown untuk memilih jenis hewan -->
        <div class="form-group mb-2">
            <label>Jenis Qurban</label>
            <select name="jenis_qurban" class="form-control" required>
                <option value="">Pilih Jenis Qurban</option>
                <option value="kambing">Kambing</option>
                <option value="sapi">Sapi</option>
                <option value="sapi patungan">Sapi Patungan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= BASEURL; ?>/Donatur" class="btn btn-secondary">Kembali</a>
    </form>
</div>
