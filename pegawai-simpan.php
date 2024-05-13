<?php
include "koneksi.php";
$namaBaru 	    = date('dmYHis');
echo $nama_pegawai		= $_POST['nama_pegawai'];
echo $jenis_kelamin 	= $_POST['jenis_kelamin'];
echo $alamat 	      = $_POST['alamat'];
echo $telp 	        = $_POST['telp'];
echo $jabatan 	      = $_POST['jabatan'];
echo $photo 		      = $_FILES['photo']['name'];
if($photo !=""){$photo = $namaBaru.$_FILES['photo']['name'];};
$temp				    = $namaBaru.$_FILES['photo']['tmp_name'];

$sql = "INSERT INTO tbl_pegawai(nama_pegawai, jenis_kelamin, alamat, telp, jabatan) VALUES('$nama_pegawai', '$jenis_kelamin', '$alamat', '$telp', '$jabatan')";
echo $hsl = mysqli_query($koneksi, $sql);
if($hsl==1){
  move_uploaded_file($_FILES['photo']['tmp_name'], "photo/".$photo);
  header("location:pegawai.php?hasil=1");
}elseif($hsl==4){
  header("location:pegawai.php?hasil=4");
}else{
  echo "<br>";
  echo "BUG!!";
}
?>