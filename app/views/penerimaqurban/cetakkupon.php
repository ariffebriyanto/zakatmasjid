<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kupon Qurban</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: grid;
            flex-wrap: wrap;
            padding: 1cm;
        }

        .kupon {
            width: 48%;
            margin: 1%;
            background: #0B6623; /* Hijau tua */
            color: white;
            padding: 1cm;
            border: 2px dashed #ccc;
            box-sizing: border-box;
            position: relative;
            page-break-inside: avoid;
			
        }

        .header {
            background: #FFE4B5;
            color: black;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            font-weight: bold;
        }

        .header span {
            color: red;
            font-size: 20px;
        }

        .nama-box {
            background: #fef4df;
            border: 2px dashed #555;
            color: black;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }

        .info {
            margin: 10px 0;
            font-size: 14px;
        }

        .lokasi {
            font-weight: bold;
            font-size: 14px;
        }

        .kupon-no {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: #B0E0E6;
            color: black;
            padding: 5px 10px;
            font-weight: bold;
        }

        .ilustrasi {
            position: absolute;
            bottom: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }

        .ilustrasi img {
            height: 40px;
        }

        .logo {
            text-align: center;
            margin-bottom: 5px;
        }

        .logo img {
            height: 40px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .kupon {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!empty($data['kuponData'])): ?>
        <?php foreach ($data['kuponData'] as $row): ?>
            <div class="kupon">
                
                <div class="header">
                    KUPON PENGAMBILAN<br><span>Daging Qurban</span>
                </div>
                <div class="nama-box">
                    <?= htmlspecialchars($row['nama']); ?>
                </div>
                <div class="info">
                    <strong>13.00 — 15.00 WIB</strong><br>
                    <span class="lokasi">Masjid AL-AMIN<br>Jl. Simorejo Sari B GG VIII No.8</span>
                </div>
                <div class="kupon-no">
                    No. Kupon: <?= htmlspecialchars($row['kupon']); ?>
                </div>
                <div class="qrcode">
                    <img src="<?= BASEURL; ?>/assets/qrcode/<?= htmlspecialchars($row['kupon']); ?>.png" alt="QR Code" width="80">
                </div>
                <div class="ilustrasi">
                    <img width=10%; src="<?= BASEURL ?>/assets/icons/sapi.png" alt="Sapi">
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada kupon yang ditemukan untuk tahun ini.</p>
    <?php endif; ?>
</div>

</body>
</html>
