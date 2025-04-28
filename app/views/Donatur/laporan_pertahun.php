<div class="container mt-4">
    <h3>Laporan Donatur per Tahun</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Nama Donatur</th>
                <th>Jenis Hewan</th>
                <th>Jumlah Qurban</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['laporan'] as $row): ?>
                <tr>
                    <td><?= $row['tahun']; ?></td>
                    <td><?= $row['nama_donatur']; ?></td>
                    <td><?= ucfirst($row['jenis_hewan']); ?></td>
                    <td><?= $row['jumlah_qurban']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<canvas id="grafikQurban"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikQurban').getContext('2d');
    const data = {
        labels: <?= json_encode(array_column($data['laporan'], 'tahun')); ?>,
        datasets: [{
            label: 'Jumlah Qurban',
            data: <?= json_encode(array_column($data['laporan'], 'jumlah_qurban')); ?>,
            backgroundColor: '#36A2EB'
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Qurban per Tahun'
                }
            }
        },
    };
    new Chart(ctx, config);
</script>
