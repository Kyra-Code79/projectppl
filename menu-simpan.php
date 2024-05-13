<?php
include "koneksi.php";

function uploadImage($fieldName)
{
  if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === 0) {
    $imageData = file_get_contents($_FILES[$fieldName]['tmp_name']);
    $base64Image = base64_encode($imageData);
    return $base64Image;
  } else {
    return false; // File upload error
  }
}

$photo = uploadImage('foto-menu');
if ($photo) {
  $id_pegawai = mysqli_escape_string($koneksi, $_POST['id_pegawai']);
  $nama_menu = mysqli_escape_string($koneksi, $_POST['nama_menu']);
  $id_jenis_menu = mysqli_escape_string($koneksi, $_POST['id_jenis_menu']);
  $harga = str_replace(',', '', mysqli_escape_string($koneksi, $_POST['harga']));

  $sql = "INSERT INTO tbl_menu(nama_menu, photo, id_jenis_menu, harga, id_pegawai) VALUES('$nama_menu', '$photo', '$id_jenis_menu', '$harga', '$id_pegawai')";

  $query   = mysqli_query($koneksi, $sql);
  if ($query) {
    header("location:menu.php?hasil=1");
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
} else {
  echo "Error uploading image.";
}
