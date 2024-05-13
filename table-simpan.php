<?php
include "koneksi.php";
$nama_table = mysqli_escape_string($koneksi, $_POST['nama_table']);
$sql = "INSERT INTO tbl_table(nama_table) VALUES ('$nama_table')";

$query   = mysqli_query($koneksi, $sql);
if ($query) {
    header("location:table.php?hasil=1");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
