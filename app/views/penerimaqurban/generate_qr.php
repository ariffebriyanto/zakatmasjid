<?php
require_once '../../lib/phpqrcode/qrlib.php';

if (isset($_GET['data'])) {
    QRcode::png($_GET['data']);
}
?>
