<!DOCTYPE html>
<html>
<head>
    <title>Scan QR Kupon</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
</head>
<body>
    <h2>Scan QR Kupon Qurban</h2>
    <div id="reader" style="width:300px;"></div>

    <script>
        function onScanSuccess(decodedText) {
            console.log("QR ditemukan: " + decodedText);

            // Kirim ke controller untuk update status kupon
            fetch("<?= BASEURL ?>/penerimaqurban/tukarqr", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "kupon=" + encodeURIComponent(decodedText)
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                window.location.reload();
            })
            .catch(error => {
                console.error("Gagal:", error);
            });
        }

        // Jalankan scanner kamera
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
