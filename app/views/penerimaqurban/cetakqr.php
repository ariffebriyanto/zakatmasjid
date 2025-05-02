<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kupon Qurban - 4 Kolom</title>
    <style>
        body {
            margin: 0;
            padding: 1cm;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .row-kupon {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .kupon {
            width: 24%;
            border: 1px dashed black;
            padding: 10px;
            text-align: center;
            font-size: 11px;
            box-sizing: border-box;
            page-break-inside: avoid;
        }

        .qrcode img {
            width: 60px;
            height: 60px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0.5cm;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!empty($data['kuponData'])): ?>
        <?php $chunks = array_chunk($data['kuponData'], 4); ?>
        <?php foreach ($chunks as $rowGroup): ?>
            <div class="row-kupon">
                <?php foreach ($rowGroup as $row): ?>
                    <div class="kupon">
                        <p><strong>Kupon: <?= htmlspecialchars($row['kupon']); ?></strong></p>
                        <div class="qrcode">
                            <img src="<?= BASEURL; ?>/assets/qrcode/<?= htmlspecialchars($row['kupon']); ?>.png" alt="QR Code">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada kupon tersedia.</p>
    <?php endif; ?>
</div>

</body>
</html>
