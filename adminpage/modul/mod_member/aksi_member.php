<?php
  session_start();
  // if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  include "../../../config/koneksi.php";
  include "../../../config/library.php";
// vd($_POST);
  if (empty($_SESSION['namauser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/fungsi_thumb.php";
$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='member' AND $act=='delcon'){
	
  mysqli_query($con,"DELETE FROM member WHERE id_session='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input user
elseif ($module=='member' AND $act=='input'){
   $lokasi_file = $_FILES['fupload']['tmp_name'];
   $tipe_file   = $_FILES['fupload']['type'];
   $nama_file   = $_FILES['fupload']['name'];
   $pass        = md5($_POST['password']);
    if (!empty($lokasi_file)){
    	UploadBanner($nama_file);
      mysqli_query($con,"INSERT INTO member(username,
                                 password,
                                 nama_lengkap,
                                 alamat,
                                 email, 
                                 no_telp,
                                 foto,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[alamat]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                '$nama_file',
                                '$pass')"); 
header('location:../../media.php?module='.$module);
}

 else{
 	
mysqli_query($con,"INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,                                
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',                               
                                '$pass')");
  header('location:../../media.php?module='.$module); 	
}
}

// Update user
elseif ($module=='member' AND $act=='update'){
  echo'masuk sini';
   $lokasi_file = $_FILES['fupload']['tmp_name'];
   $tipe_file   = $_FILES['fupload']['type'];
   $nama_file   = $_FILES['fupload']['name'];
   $pass        =md5($_POST['password']);
   
  if ((empty($_POST['password']))AND(empty($lokasi_file))){  		
    mysqli_query($con,"UPDATE member SET 
                                  nama_lengkap     = '$_POST[nama_lengkap]',
                                  email            = '$_POST[email]',
                                  blokir           = '$_POST[blokir]',  
                                  no_telp          = '$_POST[no_telp]'                                    
                          WHERE  id_member = '$_POST[id]'");
header('location:../../media.php?module='.$module);
  }
  // Apabila password diubah
 elseif ((!empty($_POST['password']))AND(!empty($lokasi_file))){
    $pass=md5($_POST['password']);
 UploadBanner($nama_file);
    mysqli_query($con,"UPDATE member SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]',  
                                 blokir          = '$_POST[blokir]',  
                                 no_telp         = '$_POST[no_telp]',
                                 foto         = '$nama_file'
                           WHERE id_session      = '$_POST[id]'");
header('location:../../media.php?module='.$module);
  }
 elseif ((!empty($_POST['password']))AND(empty($lokasi_file))){
 	 $pass=md5($_POST[password]);
    mysqli_query($con,"UPDATE member SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]',  
                                 blokir          = '$_POST[blokir]',
                                 no_telp         = '$_POST[no_telp]' 
                           WHERE id_session      = '$_POST[id]'");
 header('location:../../media.php?module='.$module);
}
elseif ((empty($_POST[password]))AND(!empty($lokasi_file))){
  UploadBanner($nama_file);
    mysqli_query($con,"UPDATE users SET nama_lengkap = '$_POST[nama_lengkap]',
                                 email = '$_POST[email]',  
                                 blokir = '$_POST[blokir]',  
                                 no_telp = '$_POST[no_telp]',
                                 foto = '$nama_file' 
                                 WHERE id_session = '$_POST[id]'");
header('location:../../media.php?module='.$module);
}
                           
}
}

?>
