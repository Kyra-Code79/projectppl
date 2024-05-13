<?php
include "koneksi.php";
$username 		= htmlspecialchars($_POST['username']);
$password 		= htmlspecialchars($_POST['password']);
echo $id_pegawai = $_POST['id_pegawai'];

// $sql = "CALL pPetugasSimpan('$username', '$password', '$nama_petugas','$level')";
$sql = "INSERT INTO tbl_login(id_pegawai, username, password) VALUES('$id_pegawai', '$username', '$password')";
$hsl = mysqli_query($koneksi, $sql);
if($hsl==1){
  header("location:login.php?hasil=1");
}elseif($hsl==4){
  header("location:login.php?hasil=4");
}else{
  echo "Data gagal diinput!";
}

?>