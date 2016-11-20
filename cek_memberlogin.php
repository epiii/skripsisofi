<?php
include "config/koneksi.php";
include "config/library.php";
function anti_injection($data){
  // $filter = mysqli_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  // $x=stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  // $filter = mysqli_real_escape_string($x);
  // return $filter;
  return $data;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));
// vd($username);

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}else{
  // $login=mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
  $s='SELECT
        l.id_login,
        l.username,
        l.id_login,
        m.kategori,
        m.foto,
        m.nama_lengkap
      FROM
        login l
      JOIN member m ON m.id_login = l.id_login
      WHERE
        l.username = "'.$username.'"
        AND  l.`password` = "'.$pass.'"';
// vd($s);
  $login  =mysqli_query($con,$s);
  $ketemu =mysqli_num_rows($login);
  $r      =mysqli_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  include "adminpage/timeout.php";
  
  $_SESSION['namauser']    = $r['username'];
  $_SESSION['namalengkap'] = $r['nama_lengkap'];
  // $_SESSION['passuser']    = $r['password'];
  $_SESSION['leveluser']   = $r['kategori'];
  // $_SESSION['leveluser']    = $r['level'];
  $_SESSION['poto']  = $r['foto'];
 
  
  // session timeout
  $_SESSION['login'] = 1;
  timer();
	$sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();

  // mysqli_query($con,"UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
  // mysqli_query($con,"UPDATE login SET id_session='$sid_baru' WHERE username='$username'");
  $ss='UPDATE login SET id_session="'.$sid_baru.'"  WHERE id_login='.$r['id_login'];
  // vd($ss);
  mysqli_query($con,$ss);
  header('location:member.html');
}
else{
  include "adminpage/error-login.php";
}
}
?>
