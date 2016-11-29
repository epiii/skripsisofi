<?php
session_start();
 // if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
if (empty($_SESSION['namauser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus sub menu
if ($module=='fakultas' AND $act=='hapus'){
  $menu=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM fakultas WHERE id_fakultas='$_GET[id]'"));
  mysqli_query($con,"DELETE FROM fakultas WHERE id_fakultas='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input menu utama
elseif ($module=='fakultas' AND $act=='input'){
  mysqli_query($con,"INSERT INTO fakultas(fakultas) VALUES('$_POST[fakultas]')");
  header('location:../../media.php?module='.$module);
}

// Update menu utama
elseif ($module=='fakultas' AND $act=='update'){
  mysqli_query($con,"UPDATE fakultas SET fakultas='$_POST[fakultas]'
               WHERE id_fakultas = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
