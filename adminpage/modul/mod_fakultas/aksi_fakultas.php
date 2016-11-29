<?php
session_start();
<<<<<<< HEAD
 // if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
if (empty($_SESSION['namauser'])){
=======
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
>>>>>>> 697c65df47b82fb473012b77cc791c885f19df87
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

<<<<<<< HEAD
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
=======
// Hapus Tag
if ($module=='tag' AND $act=='hapus'){
  mysqli_query($con,"DELETE FROM tag WHERE id_tag='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input tag
elseif ($module=='tag' AND $act=='input'){
  $tag_seo = seo_title($_POST['nama_tag']);
  mysqli_query($con,"INSERT INTO tag(nama_tag,tag_seo) VALUES('$_POST[nama_tag]','$tag_seo')");
  header('location:../../media.php?module='.$module);
}

// Update tag
elseif ($module=='tag' AND $act=='update'){
  $tag_seo = seo_title($_POST['nama_tag']);
  mysqli_query($con,"UPDATE tag SET nama_tag = '$_POST[nama_tag]', tag_seo='$tag_seo' WHERE id_tag = '$_POST[id]'");
>>>>>>> 697c65df47b82fb473012b77cc791c885f19df87
  header('location:../../media.php?module='.$module);
}
}
?>
