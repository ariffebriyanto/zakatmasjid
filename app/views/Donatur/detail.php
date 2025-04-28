<div class="container mt-4">
    <h3>Detail Donatur</h3>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td><?= htmlspecialchars($data['donatur']['nama']); ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= htmlspecialchars($data['donatur']['alamat']); ?></td>
        </tr>
    </table>
    <a href="<?= BASEURL; ?>/Donatur" class="btn btn-secondary">Kembali ke Daftar</a>
</div>
