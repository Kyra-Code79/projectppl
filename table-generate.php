<?php
include('phpqrcode/qrlib.php');

$id_table = $_GET['id'];
$data = "http://localhost:81/Polmed/semester4/PPL/Last/QRCode/order.php?table=";
$link = $data . $id_table;

// Generate QR code and get image data
ob_start(); // Start output buffering to capture image data
QRcode::png($link, null, QR_ECLEVEL_L, 10, 5);
$imageData = ob_get_contents(); // Get the image data from the output buffer
ob_end_clean(); // End output buffering and clear buffer

// Convert image data to base64
$base64Image = base64_encode($imageData);

// Upload base64 image data to database
$pdo = new PDO('mysql:host=localhost;dbname=qr_cafe', 'root', '');
$query = "INSERT INTO tbl_table (id, QRCode) VALUES (:id, :QRCode) ON DUPLICATE KEY UPDATE QRCode = :QRCode";
$statement = $pdo->prepare($query);
$statement->execute(['id' => $id_table, 'QRCode' => $base64Image]);

echo 'Image uploaded to database successfully!';
