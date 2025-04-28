<h3>Grafik Distribusi Qurban</h3>
<canvas id="grafikQurban"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafikQurban').getContext('2d');
    const data = {
        labels: <?= json_encode(array_column($data['distribusi'], 'jenis_hewan')); ?>,
        datasets: [{
            label: 'Jumlah Qurban',
            data: <?= json_encode(array_column($data['distribusi'], 'jumlah')); ?>,
            backgroundColor: ['#36A2EB', '#FF6384']
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
                    text: 'Distribusi Qurban per Jenis Hewan'
                }
            }
        },
    };
    new Chart(ctx, config);
</script>
