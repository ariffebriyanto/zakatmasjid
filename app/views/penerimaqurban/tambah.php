<h2>Tambah Penerima Kurban</h2>
<form action="<?= BASEURL; ?>/penerimaqurban/tambah" method="post">
    <label>Nama</label>
    <input type="text" name="nama" required><br>
    
    <label>Alamat</label>
    <textarea name="alamat" required></textarea><br>

    <label>Handphone</label>
    <input type="text" name="handphone" required><br>

    <button type="submit">Tambah</button>
</form>
