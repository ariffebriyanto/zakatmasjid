<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Breadcome start -->
<div class="breadcome-area mg-b-30 small-dn">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="breadcome-heading">&nbsp;</div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="breadcome-menu">
                                <li><a href="<?= BASEURL; ?>/home_index">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Penerimaan Zakat</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breadcome for Desktop -->
<div class="breadcome-area mg-b-30 des-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list map-mg-t-40-gl shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="breadcome-heading">&nbsp;</div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="breadcome-menu">
                                <li><a href="<?= BASEURL; ?>/home_index">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Penerimaan Zakat</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Static Table Start -->
<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="sparkline13-list shadow-reset">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Tabel <span class="table-project-n">Data</span> Penerimaan Zakat</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <p align="left">
                            <a href="<?= BASEURL; ?>/Penerimaan/tambah" class="btn btn-primary">Tambah Penerimaan Zakat</a>
                        </p>
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table"
                                data-toggle="table"
                                data-pagination="true"
                                data-search="true"
                                data-show-columns="true"
                                data-show-pagination-switch="true"
                                data-show-refresh="true"
                                data-key-events="true"
                                data-show-toggle="true"
                                data-resizable="true"
                                data-cookie="true"
                                data-cookie-id-table="saveId"
                                data-click-to-select="true"
                                data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="no">No</th>
        <th data-field="tgl_penerimaan">Tanggal Penerimaan</th>
        <th data-field="nama_penerima">Nama Penerima</th>
        <th data-field="jumlah_penerimaan_uang">Jumlah Penerimaan Uang (Rp)</th>
        <th data-field="jumlah_penerimaan_beras">Jumlah Penerimaan Beras (Kg)</th>
        <th data-field="nama_amil">Nama Amil</th>
        <th data-field="aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data['pnr'] as $pnr) : ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $pnr['tgl_penerimaan']; ?></td>
                                            <td><?= $pnr['nama_penerima']; ?></td>
                                            <td><?= number_format($pnr['jumlah_penerimaan_uang'], 0, ',', '.'); ?></td>
                                            <td><?= $pnr['jumlah_penerimaan_beras']; ?></td>
                                            <td><?= $pnr['nama_amil']; ?></td>
                                            <td>
                                                <a href="<?= BASEURL; ?>/Penerimaan/form_edit/<?= $pnr['id_penerimaan'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- Total Penerimaan -->
                            <?php if (!empty($data['total'])): 
                                $ttl = $data['total']; ?>
                                <div class="row" style="margin-top: 30px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Total Beras</label>
                                            <input type="text" readonly class="form-control total-beras" value="<?= $ttl['jumlah_beras']; ?> Kg" style="text-align: right;">

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Total Uang</label>
                                           <input type="text" readonly class="form-control total-uang" value="Rp. <?= number_format($ttl['jumlah_uang'], 0, ',', '.'); ?>,-" style="text-align: right;">
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Static Table End -->
<script>
    const allData = <?= json_encode($data['pnr']); ?>;
</script>
<script>
    function updateTotalPenerimaan() {
    let totalUang = 0;
    let totalBeras = 0;

    // Ambil semua data yang ada di hasil filter (bukan hanya yang tampil di halaman)
    const allVisibleData = $('#table').bootstrapTable('getData'); // tanpa useCurrentPage

    allVisibleData.forEach(function (row) {
        let uang = parseFloat(row.jumlah_penerimaan_uang) || 0;
        let beras = parseFloat(row.jumlah_penerimaan_beras) || 0;

        totalUang += uang;
        totalBeras += beras;
    });

    $('.total-beras').val(totalBeras.toLocaleString('id-ID') + ' Kg');
    $('.total-uang').val('Rp. ' + totalUang.toLocaleString('id-ID') + ',-');
}





  $(document).ready(function () {
    $('#table').on('post-body.bs.table search.bs.table', function () {
        updateTotalPenerimaan();
    });

    updateTotalPenerimaan(); // saat awal load
});


</script>
