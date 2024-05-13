<?php
include('phpqrcode/qrlib.php');
include "koneksi.php";
// Data to encode
$data = "https://habibisiregar-programmer79.000webhostapp.com/";
// Generate QR code
QRcode::png($data, 'Testing.png', QR_ECLEVEL_L, 10, 5);

echo '<h1>Testing.png</h1>';
echo '<img src="Testing.png" alt="QR Code">';
