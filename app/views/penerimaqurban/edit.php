<h2>Edit Penerima Kurban</h2>
<form action="<?= BASEURL; ?>/penerimaqurban/edit/<?= $data['penerima']['id']; ?>" method="post">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= $data['penerima']['nama']; ?>" required><br>
    
    <label>Alamat</label>
    <textarea name="alamat" required><?= $data['penerima']['alamat']; ?></textarea><br>

    <label>Handphone</label>
    <input type="text" name="handphone" value="<?= $data['penerima']['handphone']; ?>" required><br>
<div style="display:none;">
        <label>Status</label>
        <select name="status">
            <option value="belum" <?= $data['penerima']['status'] == 'belum' ? 'selected' : ''; ?>>Belum</option>
            <option value="ditukar" <?= $data['penerima']['status'] == 'ditukar' ? 'selected' : ''; ?>>Ditukar</option>
        </select><br>
    </div>
    <button type="submit">Update</button>
</form>
