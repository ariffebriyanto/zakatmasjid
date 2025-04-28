<h2>Tambah Donatur ke Kelompok Qurban</h2>

<form action="<?= BASEURL; ?>/Qurban/aksi_tambah_banyak" method="post" style="margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; border-radius: 8px;">

    <?php foreach ($data['kelompok'] as $k) : ?>
        <input type="hidden" name="kelompok_ids[]" value="<?= $k['id']; ?>">
        <input type="hidden" name="jenis_hewan[]" value="<?= $k['jenis_hewan']; ?>">
        <input type="hidden" name="nama_kelompoks[]" value="<?= $k['nama_kelompok']; ?>">

        <h4>Kelompok: <?= $k['nama_kelompok']; ?> (<?= ucfirst($k['jenis_hewan']); ?>)</h4>

        <label><strong>Pilih Donatur:</strong></label><br>

        <?php if (!empty($data['donatur'])) : ?>
            <table border="1" cellpadding="8" cellspacing="0" style="margin-bottom: 20px; width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>Pilih</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Handphone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['donatur'] as $d) : ?>
                        <tr>
                            <td style="text-align: center;">
                                <input type="checkbox" name="donatur_ids[<?= $k['id']; ?>][]" value="<?= $d['id']; ?>">
                            </td>
                            <td><?= $d['nama']; ?></td>
                            <td><?= $d['alamat']; ?></td>
                            <td><?= $d['handphone']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p style="color: red;">Belum ada donatur terdaftar.</p>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Tombol Simpan sekarang di luar foreach -->
    <button type="submit" style="margin-top: 10px;">Simpan</button>

</form>
