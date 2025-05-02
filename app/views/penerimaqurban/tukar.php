<h2>Scan / Input Manual Kupon Qurban</h2>

<form method="POST" action="<?= BASEURL; ?>/penerimaqurban/tukar" enctype="multipart/form-data">
    <label>Unggah Gambar QR Code:</label><br>
    <input type="file" name="qrimage" accept="image/*" capture="environment"><br><br>

    <label>Atau Masukkan Kode Kupon Manual:</label><br>
    <input type="text" name="kode_manual" placeholder="Misal: A000125"><br><br>

    <button type="submit">Verifikasi</button>
</form>
